@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="content-box-header">
                <div class="panel-title">User Settings</div>

            </div>
            <div class="content-box-large box-with-header">
                <form action="{{ route('user.update') }}" method="POST">
                    {!! csrf_field() !!}

                    {{-- Name --}}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">

                        @if ($errors->has('name'))
                            <div class="help-block">{{ $errors->first('name') }}</div>
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

                    {{-- Paypal Email --}}
                    <div class="form-group{{ $errors->has('paypal_email') ? ' has-error' : '' }}">
                        <label for="paypal_email" class="control-label">PayPal Email</label>
                        <input type="text" class="form-control" name="paypal_email" value="{{ old('paypal_email', $user->paypal_email) }}">

                        @if ($errors->has('paypal_email'))
                            <div class="help-block">{{ $errors->first('paypal_email') }}</div>
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

                    <div class="form-group">
                        <button class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
