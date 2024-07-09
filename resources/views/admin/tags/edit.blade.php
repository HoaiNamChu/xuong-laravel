@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Create Product Tag</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Create Product Tag</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <form action="{{ route('admin.productTags.update', $productTag) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-tag-name">Name</label>
                            <input type="text" class="form-control" name="product_tag_name"
                                   id="product-tag-name" value="{{ $productTag->product_tag_name }}">
                        </div>
                        <div class="text-start mb-3">
                            <button type="submit" class="btn btn-success w-sm">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


