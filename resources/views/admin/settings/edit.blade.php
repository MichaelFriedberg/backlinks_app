@extends('admin.layouts.master')

@section('content-header')
    <h1>
        Settings
    </h1>
@stop

@push('breadcrumbs')
<li><a href="{{ route('admin.settings.edit') }}">Settings</a></li>
@endpush

@section('content')
    <div class="box">
        <div class="box-body ">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{ old('email', $admin->email) }}" class="form-control">

                    @if ($errors->has('email'))
                        <div class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Update Password</label>
                    <input type="password" name="password" value="{{ old('password') }}" class="form-control">

                    @if ($errors->has('password'))
                        <div class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">

                    @if ($errors->has('password_confirmation'))
                        <div class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="form-group text-right">
                    <button class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
@stop