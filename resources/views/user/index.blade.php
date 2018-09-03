@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">Users</h4>

                @if(auth()->user()->can("create-users"))
                    <a class="btn btn-success" href="{{ route('user.create') }}">
                        <i class="fas fa-plus"></i>
                        Add new
                    </a>
                @endif
            </div>
            <div class="card-body">
                <table class="table" id="user-table-js">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles[0]->display_name }}</td>
                                <td>
                                    @if(auth()->user()->can("delete-users"))
                                        <button type="button" class="btn btn-sm btn-danger" data-user-id="{{ $user->id }}" data-toggle="modal" data-target="#deleteUserModal">
                                            <i class="far fa-trash-alt"></i>
                                            Delete
                                        </button>
                                    @endif

                                    @if(auth()->user()->can("update-users"))
                                        <a class="btn btn-sm btn-warning" href="{{ route('user.edit', ['id' => $user->id]) }}">
                                            <i class="far fa-edit"></i>
                                            Edit
                                        </a>
                                    @endif

                                    @if(auth()->user()->can("read-users"))
                                        <a class="btn btn-sm btn-info" href="{{ route('user.show', ['id' => $user->id]) }}">
                                            <i class="far fa-eye"></i>
                                            View
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('extra')
    <!-- Delete User Modal -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('user.destroy', ['id' => 0]) }}" method="post" id="deleteUserForm">
                        @csrf @method('delete')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
