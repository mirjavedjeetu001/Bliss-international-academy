@extends('master.backend-clean')

@section('title', 'Footer Links')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Footer Links</h2>
        <a href="{{ route('admin.footer-links.create') }}" class="btn btn-primary">Add New Link</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Order</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($footerLinks as $link)
                            <tr>
                                <td>{{ $link->id }}</td>
                                <td>{{ $link->title }}</td>
                                <td>
                                    <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">
                                        {{ $link->url }}
                                    </a>
                                </td>
                                <td>{{ $link->order }}</td>
                                <td>
                                    @if($link->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.footer-links.edit', $link) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.footer-links.destroy', $link) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this link?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No footer links found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection