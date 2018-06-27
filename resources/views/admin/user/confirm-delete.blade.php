@extends('admin.layouts.master')

@section('content-header')
    <h1>
        Delete User: {{ $user->name }}
    </h1>
@stop

@push('breadcrumbs')
<li><a href="{{ route('admin.user.index') }}">Users</a></li>
<li class="active"><a href="{{ route('admin.user.edit', $user) }}">Edit: {{ $user->name }}</a></li>
<li class="active"><a href="{{ route('admin.user.confirm-delete', $user) }}">Delete</a></li>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="box">
                <div class="box-body">
                    <form action="{{ route('admin.user.destroy', $user) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}

                        <p>Are you sure you want to delete this user?</p>

                        <div class="form-group">
                            <button class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop