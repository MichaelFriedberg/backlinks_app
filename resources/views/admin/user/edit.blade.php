@extends('admin.layouts.master')

@section('content-header')
    <h1>
        Edit User
    </h1>
@stop

@push('breadcrumbs')
<li><a href="{{ route('admin.user.index') }}">Users</a></li>
<li class="active"><a href="{{ route('admin.user.edit', $user) }}">Edit: {{ $user->name }}</a></li>
@endpush

@section('content')
    <div class="box">
        <div class="box-body ">
            <form action="{{ route('admin.user.update', $user) }}" method="POST">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                {{-- Name --}}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">

                    @if ($errors->has('name'))
                        <div class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </div>
                    @endif
                </div>

                {{-- Email --}}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Email</label>
                    <input type="text" class="form-control" name="email" value="{{ old('email', $user->email) }}">

                    @if ($errors->has('email'))
                        <div class="help-block">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                {{-- Password --}}
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Update Password</label>
                    <input type="password" name="password" value="" class="form-control">

                    @if ($errors->has('password'))
                        <div class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif
                </div>

                {{-- Password Confirmation --}}
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" value="" class="form-control">

                    @if ($errors->has('password_confirmation'))
                        <div class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="form-group text-right">
                    <a href="{{ route('admin.user.confirm-delete', $user) }}" class="btn btn-danger">Delete</a>
                    <button class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
@stop
