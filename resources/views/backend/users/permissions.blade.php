@extends('master.backend-clean')

@section('title', 'Manage Permissions')

@section('content')
<div class="container mt-4">
    <h2>Permissions Management</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('admin.permissions.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="row g-2 align-items-end">
            <div class="col-auto">
                <input type="text" name="name" class="form-control" placeholder="Permission Name" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Add Permission</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Permission</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>
                        <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this permission?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Assign Permissions to Roles</h3>
    <form action="{{ route('admin.permissions.assign') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="role_id" class="form-label">Role</label>
            <select name="role_id" id="role_id" class="form-control" required>
                <option value="">Select Role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Permissions</label>
            <div class="row">
                @foreach($permissions as $permission)
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm_{{ $permission->id }}">
                            <label class="form-check-label" for="perm_{{ $permission->id }}">{{ $permission->name }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-success">Assign Permissions</button>
    </form>
</div>
@endsection
