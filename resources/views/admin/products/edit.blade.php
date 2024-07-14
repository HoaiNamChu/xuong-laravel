@extends('admin.layouts.master')

@section('links')
    <!-- Plugins css -->
    {{--    <link href="{{ asset('theme/admin/assets/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css"/>--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Edit Product</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-name">Product Name</label>
                            <input type="text" class="form-control" name="product_name"
                                   value="{{ $product->product_name }}" id="product-name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="product-sku">SKU</label>
                            <input type="text" class="form-control" name="product_sku" id="product-sku"
                                   value="{{ $product->product_sku }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="product-material">Product Material</label>
                            <input type="text" class="form-control" value="{{ $product->product_material }}"
                                   name="product_material" id="product-material">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="product-user-manual">Product User Manual</label>
                            <input type="text" class="form-control" value="{{ $product->product_user_manual }}"
                                   name="product_user_manual" id="product-user-manual">
                        </div>
                        <div>
                            <label>Product Description</label>
                            <textarea name="product_content" value="{{ $product->product_content }}"
                                      id="ckeditor-classic"></textarea>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab"
                                   href="#addproduct-general-info" role="tab">
                                    Product Variants
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- end card header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                @foreach($product->productVariants as $productVariant)
                                    <div class="row mb-3">
{{--                                        @php--}}
{{--                                            $attributeValueId = '';--}}
{{--                                        @endphp--}}
                                        @foreach($productVariant->productAttributeValues as $item)
{{--                                            @php--}}
{{--                                                $attributeValueId.=$item->id.'-';--}}
{{--                                            @endphp--}}
                                            <div class="col-1">
                                                <b>{{ $item->product_attribute_value_name }}</b>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="sku-input">SKU</label>
                                                <input type="text" class="form-control"
                                                       id="sku-input"
                                                       name="product_variants[{{ $productVariant->id }}][product_variant_sku]"
                                                       placeholder="Enter SKU"
                                                       value="{{ $productVariant->product_variant_sku }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="t">Image</label>
                                                <input type="file" class="form-control"
                                                       name="product_variants[{{ $productVariant->id }}][product_variant_image]"
                                                       id="manufacturer-brand-input"
                                                       placeholder="Enter manufacturer brand">
                                                <input type="text" hidden
                                                       name="product_variants[{{ $productVariant->id }}][product_variant_image_old]" value="{{ $productVariant->product_variant_image }}">
                                                <img src="{{ \Illuminate\Support\Facades\Storage::url($productVariant->product_variant_image) }}" width="70px" height="70px" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row">
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="quantity-input">Quantity</label>
                                                <input type="text" class="form-control" id="quantity-input"
                                                       placeholder="Stocks"
                                                       value="{{ $productVariant->product_variant_quantity }}"
                                                       name="product_variants[{{ $productVariant->id }}][product_variant_quantity]">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label"
                                                       for="product-price-input">Price</label>
                                                <div class="input-group has-validation mb-3">
                                                                            <span class="input-group-text"
                                                                                  id="product-price-addon">$</span>
                                                    <input type="text" class="form-control"
                                                           id="product-price-input"
                                                           value="{{ $productVariant->product_variant_price }}"
                                                           name="product_variants[{{ $productVariant->id }}][product_variant_price]"
                                                           placeholder="Enter price"
                                                           aria-label="Price"
                                                           aria-describedby="product-price-addon">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label"
                                                       for="product-discount-input">Price Sale</label>
                                                <div class="input-group mb-3">
                                                                            <span class="input-group-text"
                                                                                  id="product-discount-addon">$</span>
                                                    <input type="text" class="form-control"
                                                           id="product-discount-input"
                                                           value="{{ $productVariant->product_variant_price_sale }}"
                                                           name="product_variants[{{ $productVariant->id }}][product_variant_price_sale]"
                                                           placeholder="Enter discount" aria-label="discount"
                                                           aria-describedby="product-discount-addon">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                        <!-- end tab content -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Short Description</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">Add short description for product</p>
                        <textarea class="form-control"
                                  value="{{ $product->product_description }}"
                                  name="product_description"
                                  placeholder="Must enter minimum of a 100 characters"
                                  rows="3"></textarea>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Publish</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch form-switch-secondary">
                            <input class="form-check-input" type="checkbox" role="switch" name="product_is_active" value="1"
                                   id="is-active" @if($product->product_is_active == 1) checked @endif>
                            <label class="form-check-label" for="is-active">Is Active</label>
                        </div>
                        <div class="form-check form-switch form-switch-success">
                            <input class="form-check-input" type="checkbox" name="product_is_hot_deal" value="1" role="switch"
                                   id="is-hot-deal" @if($product->product_is_hot_deal == 1) checked @endif>
                            <label class="form-check-label" for="is-hot-deal">Is Hot Deal</label>
                        </div>
                        <div class="form-check form-switch form-switch-warning">
                            <input class="form-check-input" type="checkbox" name="product_is_good_deal" value="1" role="switch"
                                   id="is-good-deal" @if($product->product_is_good_deal == 1) checked @endif>
                            <label class="form-check-label" for="is-good-deal">Is Good Deal</label>
                        </div>
                        <div class="form-check form-switch form-switch-danger">
                            <input class="form-check-input" type="checkbox" name="product_is_new" value="1" role="switch"
                                   id="is-new" @if($product->product_is_new == 1) checked @endif>
                            <label class="form-check-label" for="is-new">Is New</label>
                        </div>
                        <div class="form-check form-switch form-switch-info">
                            <input class="form-check-input" type="checkbox" name="product_is_show_home" value="1" role="switch"
                                   id="is-show-home" @if($product->product_is_show_home == 1) checked @endif>
                            <label class="form-check-label" for="is-show-home">Is Show Home</label>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Image</h5>
                    </div>
                    <!-- end card body -->
                    <div class="card-body">
                        <div>
                            <input type="file" name="product_image" id="product-image">
                        </div>
                        <div>
                            <input type="text" hidden name="product_image_old" value="{{ $product->product_image }}">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($product->product_image) }}" alt=""
                                 width="70px" height="70px">
                        </div>
                    </div>
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Gallery</h5>
                    </div>
                    <!-- end card body -->
                    <div class="card-body">
                        <div>
                            <input type="file" name="product_galleries[]" id="product-gallery" multiple>
                        </div>
                        @foreach($product->galleries as $gallery)
                            <div class="d-inline-block">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($gallery->product_gallery_image) }}" width="70px" height="70px" alt="">
                                <input type="text" hidden value="{{$gallery->product_gallery_image}}" name="product_galleries_old[{{ $gallery->id }}][]">
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Categories</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2"><a href="{{ route('admin.categories.create') }}"
                                                      class="float-end text-decoration-underline">Add
                                New</a>Select product category</p>
                        <select class="form-select" name="category_id">
                            <option value="" selected>Trống</option>
                            @foreach($categories as $category)
                                @php
                                    $each = "";
                                @endphp
                                @include('admin.products.category-edit-select',['category'=>$category,'each'=>$each, 'product'=>$product])
                            @endforeach
                        </select>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Tags</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2"><a href="{{ route('admin.productTags.create') }}"
                                                      class="float-end text-decoration-underline">Add
                                New</a>Select product tag</p>
                        <select class="js-example-basic-multiple" name="tags[]" multiple>
                            @php($productTagIds = $product->tags()->pluck('id')->all())
                            @foreach($productTags as $productTag)

                                <option value="{{ $productTag->id }}" @selected(in_array($productTag->id, $productTagIds))>{{ $productTag->product_tag_name }}</option>

                            @endforeach

                        </select>

                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <div class="text-start mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </form>
@endsection

@section('libs-script')
    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('theme/admin/assets/js/pages/select2.init.js') }}"></script>

    <!-- ckeditor -->
    <script src="{{ asset('theme/admin/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

    <!-- dropzone js -->
    {{--    <script src="{{ asset('theme/admin/assets/libs/dropzone/dropzone-min.js') }}"></script>--}}

    <script src="{{ asset('theme/admin/assets/js/pages/ecommerce-product-create.init.js') }}"></script>
@endsection
