@extends('admin.layout.app')

@section('content')
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .card-header {
        font-size: 1.25rem;
        font-weight: bold;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        text-transform: uppercase;
    }

    .table {
        border-collapse: collapse;
    }

    .table th {
        background-color: var(--secondary-color);
        color: var(--primary-color);
        text-transform: uppercase;
        font-size: 0.9rem;
        font-weight: bold;
    }

    .table td {
        vertical-align: middle;
        font-size: 0.9rem;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .badge {
        font-size: 0.8rem;
        padding: 0.5rem 0.8rem;
        border-radius: 5px;
    }

    .btn {
        border-radius: 5px;
        font-size: 0.85rem;
    }

    .btn-sm {
        padding: 0.3rem 0.6rem;
    }

    .btn-light {
        color: #333;
    }

    .btn-warning {
        color: #ffffff;
    }

    .btn-danger {
        background-color: #e94560;
        border-color: #e94560;
    }

    .btn-danger:hover {
        background-color: #d63050;
    }

    .text-muted {
        font-size: 0.85rem;
        font-weight: 400;
    }

    .text-center {
        text-align: center !important;
    }

    .text-white {
        color: #ffffff !important;
    }
</style>
<style>
    .btn-warning {
        background-color: #f7b731;
        border: none;
        color: #fff;
        font-weight: bold;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .btn-warning:hover {
        background-color: #e68a00;
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
    }

    .btn-warning:focus {
        outline: none;
        box-shadow: 0 0 10px rgba(255, 193, 7, 0.5);
    }
    .form{padding: 1.5rem 2rem;
    }
</style>

<div class="container-fluid">
    <h2 class="text-center my-4">User List</h2>
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <span>User Management</span>
                <a href="{{ route('users.create') }}" class="btn btn-light btn-sm">+ Add New User</a>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover align-middle text-center">
                <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->user_id }}</td>
                        <td>{{ $user->user_name }}</td>
                        <td>{{ $user->user_role }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge {{ $user->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <div class="form">
                                    <a href="{{ route('users.edit', $user->user_id) }}" class="btn btn-warning btn-sm mx-1">Edit</a>
                                </div>

                                <form action="{{ route('users.destroy', $user->user_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mx-1" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                                <form action="{{ route('users.toggle-status', $user->user_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm mx-1 {{ $user->status === 'active' ? 'btn-secondary' : 'btn-success' }}">
                                        {{ $user->status === 'active' ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center">
            <p class="text-muted">Total Users: {{ $users->count() }}</p>
        </div>
    </div>
</div>
@endsection
