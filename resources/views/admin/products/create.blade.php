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
                <h4 class="mb-sm-0">Create Product</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Create Product</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-name">Product Name</label>
                            <input type="text" class="form-control" name="product_name" id="product-name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="product-sku">SKU</label>
                            <input type="text" class="form-control" name="product_sku" id="product-sku">
                        </div>
                        <div>
                            <label>Product Description</label>
                            <textarea name="product_content" id="ckeditor-classic"></textarea>
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
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Manufacturer
                                                Name</label>
                                            <input type="text" class="form-control"
                                                   id="manufacturer-name-input"
                                                   placeholder="Enter manufacturer name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-brand-input">Manufacturer
                                                Brand</label>
                                            <input type="text" class="form-control"
                                                   id="manufacturer-brand-input"
                                                   placeholder="Enter manufacturer brand">
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">Stocks</label>
                                            <input type="text" class="form-control" id="stocks-input"
                                                   placeholder="Stocks" required>
                                            <div class="invalid-feedback">Please Enter a product stocks.
                                            </div>
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
                                                       id="product-price-input" placeholder="Enter price"
                                                       aria-label="Price"
                                                       aria-describedby="product-price-addon" required>
                                                <div class="invalid-feedback">Please Enter a product
                                                    price.
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                   for="product-discount-input">Discount</label>
                                            <div class="input-group mb-3">
                                                                            <span class="input-group-text"
                                                                                  id="product-discount-addon">%</span>
                                                <input type="text" class="form-control"
                                                       id="product-discount-input"
                                                       placeholder="Enter discount" aria-label="discount"
                                                       aria-describedby="product-discount-addon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="orders-input">Orders</label>
                                            <input type="text" class="form-control" id="orders-input"
                                                   placeholder="Orders" required>
                                            <div class="invalid-feedback">Please Enter a product orders.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->
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
                        <textarea class="form-control" name="product_description"
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
                            <input class="form-check-input" type="checkbox" role="switch" name="is_active" value="1"
                                   id="is-active" checked>
                            <label class="form-check-label" for="is-active">Is Active</label>
                        </div>
                        <div class="form-check form-switch form-switch-success">
                            <input class="form-check-input" type="checkbox" name="is_hot_deal" value="1" role="switch"
                                   id="is-hot-deal">
                            <label class="form-check-label" for="is-hot-deal">Is Hot Deal</label>
                        </div>
                        <div class="form-check form-switch form-switch-warning">
                            <input class="form-check-input" type="checkbox" name="is_good_deal" value="1" role="switch"
                                   id="is-good-deal">
                            <label class="form-check-label" for="is-good-deal">Is Good Deal</label>
                        </div>
                        <div class="form-check form-switch form-switch-danger">
                            <input class="form-check-input" type="checkbox" name="is_new" value="1" role="switch"
                                   id="is-new">
                            <label class="form-check-label" for="is-new">Is New</label>
                        </div>
                        <div class="form-check form-switch form-switch-info">
                            <input class="form-check-input" type="checkbox" name="is_show_home" value="1" role="switch"
                                   id="is-show-home">
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
                            @foreach($categories as $cate)
                                @php
                                    $each = "";
                                @endphp
                                <x-category-select :cate="$cate" :each="$each"/>
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

                            @foreach($productTags as $productTag)

                                <option value="{{ $productTag->id }}">{{ $productTag->product_tag_name }}</option>

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
