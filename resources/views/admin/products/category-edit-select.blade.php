<option value="{{ $category->id }}"
    @if($category->id == $product->category_id) selected @endif
>{{ $each }}{{ $category->name }}</option>
@if($category->children)
    @php
        $each .= "-";
    @endphp

    @foreach($category->children as $child)

        @include('admin.categories.category-edit-select',['category'=>$child,'each'=>$each, 'product'=>$product])
    @endforeach

@endif
