@extends('layouts.homepage')

@section('content')
<div class="container">
   
        <div class="col-md-8">
            <div class="new">
                <div class="header"><h2>{{ __('Login here!') }}</h2></div>

                <div class="new-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ ('E-Mail Address') }}</label>

                            <div class="col-md-5">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-5">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--<div class="form-group row">
                            <div class="col-md-2 offset-md-0">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                       Remember
                                    </label>

                                </div>
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-2 offset-md-0">
                                <button type="submit" class="w3-btn">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a  href="{{ route('password.request') }}">
                               <!--    <b>  <u> Forgot Your Password? </u> </b></a><br><br> -->
                                   
                                    <b>   Not registered?  <a style="color:blue;" href="{{ route('register') }}"> <u>Create an account </u> </a> </b>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
</div>
@include('layouts.partial.footer')
@endsection
