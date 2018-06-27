@extends('layouts.app')

@section('content')
    <div class="row">
      
		<!--col-md-6 col-md-offset-3 -->
  <div class="full-inline" >
        
<div class="login-wrapper lefthalf"><div class="box" style="background: rgba(255, 255, 255, 0.37);">
                    <div class="content-wrap">
                        
<h6>Webmasters can earn monthly recurring income from unused ad space.</h6>
As a Webmaster/Owner, you can earn monthly recurring revenue for every link that our advertiser chooses to purchase on your site(s).
From there, you will continue to earn recurring revenue for each link every month, as long as the link(s) are active.
The amount of revenue you can earn per link is based on the Domain Authority of your site… so the more authority your site has, the more recurring money you will make!
 
<h6>To Start Earning Monthly, Reoccurring, Passive Income Click Here:</h6>
With generous payouts and new Advertisers every day, this is the easiest way to earn monthly passive revenue from your unused ad space.
It’s as easy as “Set It &amp; Forget It”…
Once we validate your site… Then our system will automatically add/edit/remove any purchased links, and deposit money into your PayPal account.
Huge Demand for Quality Sites… 
Our advertisers are looking for quality sites in all niches (Sorry, no adult sites), all languages (primarily English), and with all levels of Domain Authority.
</div>
                </div></div>

    <div class="login-wrapper righthalf">
                <div class="box">
                    <div class="content-wrap">
				  <h6>Become a Publisher!</h6>

 			 <p>To learn more and or to register and create your free account click here.</p>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            {{-- Name --}}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Password --}}
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

                            {{-- Password Confirmation--}}
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="action">
                                <button class="btn btn-primary signup">Register</button>
                            </div>
                        </form>
			<div class="already">
                   		 <p>Have an account already?</p>
                 		   <a href="{{ url('/login') }}">Login</a>
                	</div>                   
 		       </div>
                </div>

            </div>
        </div>
    </div>
@endsection
