<option value="{{ $cate->id }}"
    @if($cate->id == $category->parent_id) selected @endif
>{{ $each }}{{ $cate->name }}</option>
@if($cate->children)
    @php
        $each .= "-";
    @endphp

    @foreach($cate->children as $child)

        @include('admin.categories.category-edit-select',['cate'=>$child,'each'=>$each,'category'=>$category])
    @endforeach

@endif
