<option value="{{ $cate->id }}">{{ $each }}{{ $cate->name }}</option>
@if($cate->children)
    @php
        $each .= "-";
    @endphp

    @foreach($cate->children as $child)

        <x-category-select :cate="$child" :each="$each"/>
    @endforeach

@endif
