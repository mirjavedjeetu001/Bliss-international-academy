@extends('master.backend-clean')

@section('title', 'Menu Management')

@section('content')
<div class="container mt-4">
    <h2>Menu Management</h2>
    <a href="{{ route('admin.menus.create') }}" class="btn btn-primary mb-3">Add Menu Item</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>URL</th>
                <th>Page</th>
                <th>Parent</th>
                <th>Order</th>
                <th>Show in Nav</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
                <tr>
                    <td>{{ $menu->title }}</td>
                    <td>{{ $menu->url }}</td>
                    <td>{{ $menu->page_id }}</td>
                    <td>{{ $menu->parent ? $menu->parent->title : '-' }}</td>
                    <td>{{ $menu->order }}</td>
                    <td>{{ $menu->show_in_nav ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this menu item?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @foreach($menu->children as $child)
                    <tr>
                        <td>— {{ $child->title }}</td>
                        <td>{{ $child->url }}</td>
                        <td>{{ $child->page_id }}</td>
                        <td>{{ $child->parent ? $child->parent->title : '-' }}</td>
                        <td>{{ $child->order }}</td>
                        <td>{{ $child->show_in_nav ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="{{ route('admin.menus.edit', $child->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.menus.destroy', $child->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this menu item?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endsection
