@extends('master.backend-clean')

@section('title', 'Footer Branches')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Footer Branches</h2>
        <a href="{{ route('admin.footer-branches.create') }}" class="btn btn-primary">Add New Branch</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($footerBranches as $branch)
                    <tr>
                        <td>{{ $branch->id }}</td>
                        <td>{{ $branch->name }}</td>
                        <td>{{ $branch->address }}</td>
                        <td>{{ $branch->phone }}</td>
                        <td>{{ $branch->email }}</td>
                        <td>{{ $branch->order }}</td>
                        <td>
                            <span class="badge {{ $branch->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $branch->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.footer-branches.edit', $branch) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.footer-branches.destroy', $branch) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No footer branches found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $footerBranches->links() }}
</div>
@endsection