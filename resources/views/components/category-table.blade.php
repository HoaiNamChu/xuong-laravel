

<tr>
    <td> {{ $category->id }}</td>
    <td> {{$each}}{{ $category->name }}</td>
    <td><img src="{{ \Illuminate\Support\Facades\Storage::url($category->image) }}" alt="" width="70px" height="70px"></td>
    <td> {{ $category->is_active }}</td>
    <td> {{ $category->created_at }}</td>
    <td> {{ $category->updated_at }}</td>
    <td>
        <a href="{{ route('admin.categories.show', $category) }}"><button class="btn btn-info">Show</button></a>
        <a href="{{ route('admin.categories.edit', $category) }}"><button class="btn btn-warning">Edit</button></a>
        <form action="{{ route('admin.categories.destroy', $category) }}" class="d-inline-block" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Delete</button>
        </form>
    </td>
    @if($category->children->count())
            @php
                $each .= "-";
            @endphp
        <tr>
            @foreach($category->children as $child)

                <x-category-table :category="$child" :each="$each" />
            @endforeach
        </tr>
    @endif
</tr>
