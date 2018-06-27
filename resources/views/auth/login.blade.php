@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="login-wrapper">
                <div class="box">
                    <div class="content-wrap">
                        <h6>Sign In</h6>

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="action">
                                <button class="btn btn-primary signup">Login</button>
                            </div>

                            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                        </form>
	        	     <div class="already">
        	            <p>Don't have an account yet?</p>
                   	 <a href="{{ url('/register') }}">Sign Up</a>
               		 </div>
        </div>
                </div>

            </div>
        </div>
    </div>
@endsection
