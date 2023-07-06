@extends('layouts.app')

@section('content')
    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title">Login</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Login</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card-body">
                        <div class="login_form login_form_custom inner_page">
                            @if(Session::has('verified'))
                                                        <div class="alert alert-success">
                                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                                                            <div class="icon hidden-xs">
                                                              <i class="fa fa-check"></i>
                                                            </div>
                                                            <strong>Success</strong>
                                                            <Br /> {{Session::get('verified')}}
                                                          </div>
                                            @endif

                                              @if(Session::has('error'))
                                                         <div class="alert alert-danger">
                                                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                                                                <div class="icon hidden-xs">
                                                                  <i class="fa fa-ban"></i>
                                                                </div>
                                                                <strong>Danger</strong>
                                                                <Br /> {{Session::get('error')}}
                                                              </div>
                                            @endif
                            <div class="heading">
                                <h3 class="text-center">Login to your account</h3>
                                <p class="text-center">Don't have an account? <a class="text-thm" href="page-register.html">Sign Up!</a></p>
                            </div>
                             <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email Address">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                                @if (Route::has('password.request'))
                                <a class="tdu btn-fpswd float-right" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>

                            <div class="r-btn">
                                
                                    <button type="submit" class="btn btn-primary-custom ">{{ __('Login') }}</button>        
                                
                            </div>

                            
                            
                            <div class="divide">
                                <span class="lf_divider">Or</span>
                                <hr>
                            </div>
                            <div class="row mt40">
                               {{--  <div class="col-lg">
                                    <button type="submit" class="btn btn-block color-white bgc-fb mb0"><i class="fa fa-facebook float-left mt5"></i> Facebook</button>
                                </div> --}}
                                <div class="col-lg">
                                    <button type="submit" class="btn btn2 btn-block color-white bgc-gogle mb0"><i class="fa fa-google float-left mt5"></i> Google</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
