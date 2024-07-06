@extends('admin.layouts.master')

@section('content')
    <h1>Categories</h1>
    <a href="{{ route('admin.categories.create') }}"><button class="btn btn-primary">Add</button></a>
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Is Active</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach($categories as $category)
                @php
                    $each = "";
                @endphp
                <x-category-table :category="$category" :each="$each" />
            @endforeach
        </tbody>
    </table>
@endsection
