<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
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
        return view(self::PATH_VIEW . __FUNCTION__);
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
        $dataProduct['is_active']       ??= 0;
        $dataProduct['is_hot_deal']     ??= 0;
        $dataProduct['is_good_deal']    ??= 0;
        $dataProduct['is_new']          ??= 0;
        $dataProduct['is_show_home']    ??= 0;
        $dataProduct['product_slug'] = Str::slug($dataProduct['product_name']) . '-' . $dataProduct['product_sku'];
        $dataProductTags = $request->tags;
        $dataProductGalleries = $request->product_galleries ?:[];
        $dataProductVariants = $request->product_variants;
        try {
            DB::beginTransaction();
            if ($dataProduct['product_image']){
                $dataProduct['product_image'] = Storage::put('products', $dataProduct['product_image']);
            }
            $product = Product::query()->create($dataProduct);


            foreach ($dataProductVariants as $key => $dataProductVariant) {
                $valueIds = explode('-', $key);
                array_pop($valueIds);
                $dataProductVariant['product_id'] = $product->id;
                if ($dataProductVariant['product_variant_image']){
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
        }catch (\Exception $exception){
            DB::rollBack();
            dd($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
