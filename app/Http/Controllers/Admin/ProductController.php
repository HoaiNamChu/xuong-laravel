<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Models\ProductGallery;
use App\Models\ProductTag;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;

class ProductController extends Controller
{

    const PATH_VIEW = 'admin.products.';
    const PATH_UPLOAD = 'products';

    public function index()
    {
        $products = Product::query()->with('category')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        $productTags = ProductTag::query()->get();
        $productAttributes = ProductAttribute::query()->with('productAttributeValues')->get();
        $productVariants = $this->generateCombinations($productAttributes);
        return view(self::PATH_VIEW . __FUNCTION__, compact('categories', 'productTags', 'productVariants'));
    }

    private function generateCombinations($productAttributes)
    {
        $arrays = [];
        foreach ($productAttributes as $productAttribute) {
            $values = $productAttribute->productAttributeValues;
            $arrays[] = $values;
        }

        $results = [[]];
        foreach ($arrays as $propertyValues) {
            $newResults = [];
            foreach ($results as $result) {
                foreach ($propertyValues as $value) {
                    $newResults[] = array_merge($result, [$value]);
                }
            }
            $results = $newResults;
        }

        return $results;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataProduct = $request->except('product_variants', 'tags', 'product_galleries');
        $dataProduct['product_is_active'] ??= 0;
        $dataProduct['product_is_hot_deal'] ??= 0;
        $dataProduct['product_is_good_deal'] ??= 0;
        $dataProduct['product_is_new'] ??= 0;
        $dataProduct['product_is_show_home'] ??= 0;
        $dataProduct['product_slug'] = Str::slug($dataProduct['product_name']) . '-' . $dataProduct['product_sku'];
        $dataProductTags = $request->tags;
        $dataProductGalleries = $request->product_galleries ?: [];
        $dataProductVariants = $request->product_variants;
        try {
            DB::beginTransaction();
//            $dataProduct['product_image']
//                ? $dataProduct['product_image'] = Storage::put('products', $dataProduct['product_image'])
//                : $dataProduct['product_image'] = null;
            $dataProduct['product_image'] ??= null;
            if ($dataProduct['product_image']) {
                $dataProduct['product_image'] = Storage::put('products', $dataProduct['product_image']);
            }
            $product = Product::query()->create($dataProduct);


            foreach ($dataProductVariants as $key => $dataProductVariant) {
                $valueIds = explode('-', $key);
                array_pop($valueIds);
                $dataProductVariant['product_id'] = $product->id;
                $dataProductVariant['product_variant_image'] ??= null;
                if ($dataProductVariant['product_variant_image']) {
                    $dataProductVariant['product_variant_image'] = Storage::put('products', $dataProductVariant['product_variant_image']);
                }
                $productVariant = ProductVariant::query()->create($dataProductVariant);
                $productVariant->productAttributeValues()->attach($valueIds);


            }


            $product->tags()->attach($dataProductTags);

            foreach ($dataProductGalleries as $image) {
                ProductGallery::query()->create([
                    'product_id' => $product->id,
                    'product_gallery_image' => Storage::put('products', $image)
                ]);
            }
            DB::commit();
            return redirect()->route('admin.products.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load([
            'category',
            'productVariants',
            'tags',
            'galleries',
        ]);
        $productVariantIds = $product->productVariants()->pluck('id')->toArray();

        $attributeValues = ProductAttributeValue::query()->whereRelation('productVariants', function ($query) use ($productVariantIds) {
            $query->whereIn('id', $productVariantIds);
        })->get();

        $attributeValueIds = ProductAttributeValue::query()->whereRelation('productVariants', function ($query) use ($productVariantIds) {
            $query->whereIn('id', $productVariantIds);
        })->pluck('id')->toArray();

        $attributes = ProductAttribute::query()->whereRelation('productAttributeValues', function ($query) use ($attributeValueIds) {
            $query->whereIn('id', $attributeValueIds);
        })->get();
//        dd($attributeValues);
        return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'attributeValues', 'attributes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product->load([
            'category',
            'tags',
            'productVariants.productAttributeValues',
            'galleries',
        ]);
        $productTags = ProductTag::query()->get();
        $categories = Category::query()->with('children')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'productTags', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $dataProduct = request()->except('product_variants', 'tags', 'product_galleries', 'product_galleries_old', 'product_image_old');
        $dataProduct['product_is_active'] ??= 0;
        $dataProduct['product_is_hot_deal'] ??= 0;
        $dataProduct['product_is_good_deal'] ??= 0;
        $dataProduct['product_is_new'] ??= 0;
        $dataProduct['product_is_show_home'] ??= 0;
        $dataProduct['product_slug'] = Str::slug($dataProduct['product_name']) . '-' . $dataProduct['product_sku'];
        $productImageOld = $product->product_image;
        $dataTags = request()->tags;

        $dataProductVariants = request()->product_variants;
        $dataProductGalleries = request()->product_galleries;
        $dataProductGalleryOlds = request()->product_galleries_old;
        try {
            DB::beginTransaction();
            $dataProduct['product_image'] ??= $productImageOld;
            if ($request->hasFile('product_image')) {
                $dataProduct['product_image'] = Storage::put(self::PATH_UPLOAD, $dataProduct['product_image']);
            }
            $product->update($dataProduct);

            foreach ($dataProductVariants as $key => $dataProductVariant) {
                $dataProductVariant['product_variant_image'] ??= $dataProductVariant['product_variant_image_old'];
                if ($dataProductVariant['product_variant_image'] != $dataProductVariant['product_variant_image_old']) {
                    $dataProductVariant['product_variant_image'] = Storage::put(self::PATH_UPLOAD, $dataProductVariant['product_variant_image']);
                }
                unset($dataProductVariant['product_variant_image_old']);
                ProductVariant::query()->where('id', $key)->update($dataProductVariant);
            }

            $product->tags()->sync($dataTags);

            if (!empty($dataProductGalleries)) {
                foreach ($dataProductGalleries as $image) {
                    ProductGallery::query()->updateOrCreate([
                        'product_id' => $product->id,
                        'product_gallery_image' => Storage::put('products', $image)
                    ]);
                }
            }



            DB::commit();
            if ($dataProduct['product_image'] != $productImageOld && !empty($productImageOld) && Storage::exists($productImageOld)) {
                Storage::delete($productImageOld);
            }

            if (!empty($dataProductGalleries)){
                foreach ($dataProductGalleryOlds as $key => $dataProductGalleryOld) {
                    ProductGallery::query()->where('id', $key)->delete();
                }
            }

            foreach ($dataProductVariants as $dataProductVariant) {
                $dataProductVariant['product_variant_image'] ??= null;
                if ($dataProductVariant['product_variant_image']){
                    Storage::delete($dataProductVariant['product_variant_image_old']);
                }
            }
            return back()->with('success', 'Thao tác thành công!');

        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            DB::transaction(function () use ($product) {
                $product->tags()->sync([]);
                $galleries = $product->galleries;
                $product->galleries()->delete();
                foreach ($product->galleries as $gallery) {
                    if ($galleries && Storage::exists($gallery->product_gallery_image)) {
                        Storage::delete($gallery->product_gallery_image);
                    }
                }

                foreach ($product->productVariants as $variant) {
                    $variant->productAttributeValues()->sync([]);
                }

                $product->productVariants()->delete();
                foreach ($product->productVariants as $variant) {
                    if ($variant->product_variant_image && Storage::exists($variant->product_variant_image)) {
                        Storage::delete($variant->product_variant_image);
                    }
                }
                $product->delete();
                if ($product->product_image && Storage::exists($product->product_image)) {
                    Storage::delete($product->product_image);
                }
            }, 3);
            return back();
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
