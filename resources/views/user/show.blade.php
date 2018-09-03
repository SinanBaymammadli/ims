@extends('layouts.app')

@section('content')
    @php
        $is_me = auth()->user() ? auth()->user()->id == $user->id : false;
    @endphp

    <div class="container">
        <div class="card">
            <div class="card-header">
                About

                @if ($is_me)
                    <a class="btn btn-sm btn-primary" href="{{ route('user.edit', ['id' => auth()->user()->id]) }}">
                        Edit profile
                    </a>
                @endif
            </div>
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <h6 class="card-subtitle mb-4 text-muted">{{ $user->email }}</h6>

                        @if(auth()->user() && auth()->user()->can("delete-users"))
                            <button type="button" class="btn btn-sm btn-danger" data-user-id="{{ $user->id }}" data-toggle="modal" data-target="#deleteUserModal">
                                <i class="far fa-trash-alt"></i>Delete
                            </button>
                        @endif

                        @if(auth()->user() && auth()->user()->can("update-users"))
                            <a class="btn btn-sm btn-warning" href="{{ route('user.edit', ['id' => $user->id]) }}">
                                <i class="far fa-edit"></i>Edit
                            </a>
                        @endif
                    </div>
                </div>
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
