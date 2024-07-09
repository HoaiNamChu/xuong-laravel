<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductAttributeController extends Controller
{

    const PATH_VIEW = 'admin.attributes.';

    public function index()
    {
        $productAttributes = ProductAttribute::query()->with('productAttributeValues')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('productAttributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ProductAttribute::query()->create($request->all());

        return redirect()->route('admin.productAttributes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductAttribute $productAttribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductAttribute $productAttribute)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('productAttribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductAttribute $productAttribute)
    {
        $productAttribute->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductAttribute $productAttribute)
    {
        try {
            DB::transaction(function () use ($productAttribute) {

                $productAttribute->productAttributeValues()->delete();

                $productAttribute->delete()
                ;
            }, 3);

            return back();
        } catch (\Exception $exception) {
            return back();
        }
    }
}
