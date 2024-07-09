@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Create Product Attribute</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Create Product Attribute</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <form action="{{ route('admin.productAttributes.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-attribute-name">Name</label>
                            <input type="text" class="form-control" name="product_attribute_name"
                                   id="product-attribute-name">
                        </div>
                        <div class="text-start mb-3">
                            <button type="submit" class="btn btn-success w-sm">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Values</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                        @foreach($productAttributes as $productAttribute)
                            <tr>
                                <td>{{ $productAttribute->id }}</td>
                                <td>{{ $productAttribute->product_attribute_name }}</td>
                                <td>
                                    @foreach($productAttribute->productAttributeValues as $value)
                                        {{ $value->product_attribute_value_name}},
                                    @endforeach
                                </td>
                                <td>{{ $productAttribute->created_at }}</td>
                                <td>{{ $productAttribute->updated_at }}</td>
                                <td>
                                    <a href="{{ route('admin.productAttributes.edit', $productAttribute) }}"><button class="btn btn-warning">Edit</button></a>
                                    <form action="{{ route('admin.productAttributes.destroy', $productAttribute) }}" class="d-inline-block" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
