<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductTag;
use Illuminate\Http\Request;

class ProductTagController extends Controller
{

    const PATH_VIEW = 'admin.tags.';

    public function index()
    {
        $tags = ProductTag::query()->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ProductTag::query()->create($request->all());
        return redirect()->route('admin.productTags.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductTag $productTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductTag $productTag)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('productTag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductTag $productTag)
    {
        $productTag->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductTag $productTag)
    {
        $productTag->delete();
        return back();
    }
}
