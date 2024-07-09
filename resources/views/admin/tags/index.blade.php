@extends('admin.layouts.master')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Create Product Tags</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Create Product Tags</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <form action="{{ route('admin.productTags.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-tag-name">Name</label>
                            <input type="text" class="form-control" name="product_tag_name"
                                   id="product-tag-name">
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
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                        @foreach($tags as $productTag)
                            <tr>
                                <td>{{ $productTag->id }}</td>
                                <td><span class="badge badge-gradient-info">{{ $productTag->product_tag_name }}</span></td>
                                <td>{{ $productTag->created_at }}</td>
                                <td>{{ $productTag->updated_at }}</td>
                                <td>
                                    <a href="{{ route('admin.productTags.edit', $productTag) }}">
                                        <button class="btn btn-warning">Edit</button>
                                    </a>
                                    <form action="{{ route('admin.productTags.destroy', $productTag) }}"
                                          class="d-inline-block" method="post">
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

