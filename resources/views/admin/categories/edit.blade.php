@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Edit Category</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Edit Category</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Edit Category</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row gy-4 mb-3">
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="category" class="form-label">Tên danh mục</label>
                                        <input type="text" class="form-control" value="{{ $category->name }}" name="name" id="category">
                                    </div>
                                </div>
                            </div>

                            <div class="row gy-4">
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label>Thư mục cha</label>
                                        <select class="form-select mb-3" name="parent_id">
                                            <option value="" selected>Trống</option>
                                            @foreach($categories as $cate)
                                                @php( $each = "")
                                                @include('admin.categories.category-edit-select',['cate'=>$cate,'each'=>$each,'category'=>$category])
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row gy-4 mb-3">
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="image" class="form-label">Ảnh</label>
                                        <input class="form-control" name="image" type="file" id="image">
                                    </div>
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($category->image) }}" alt="" width="70px" height="70px">
                                </div>
                                <!--end col-->
                            </div>

                            <div class="row gy-4 mb-3">
                                <div class="col-xxl-6 col-md-6">
                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="is_active" @if($category->is_active) checked @endif value="1">
                                        <label class="form-check-label" for="customSwitchsizelg">Is Active</label>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>

                            <div class="row gy-4">
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <button type="submit" class="btn btn-primary">Sửa</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection

@section('libs-script')
    <!-- prismjs plugin -->
    <script src="{{ asset('theme/admin/assets/libs/prismjs/prism.js') }}"></script>
@endsection
