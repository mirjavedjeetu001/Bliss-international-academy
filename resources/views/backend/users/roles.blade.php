@extends('master.backend-clean')

@section('title', 'Manage Roles')

@section('content')
<div class="container mt-4">
    <h2>Roles Management</h2>
    <form action="{{ route('admin.roles.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="row g-2 align-items-end">
            <div class="col-auto">
                <input type="text" name="name" class="form-control" placeholder="Role Name" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Add Role</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this role?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
