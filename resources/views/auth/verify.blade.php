@extends('layouts.app')

@section('content')
    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title">Verify Your Email Address</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Verify Your Email Address</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 my-5 py-2">
            <div class="card">
         

                <div class="card-body">
                    @if (session('resent'))

                    <div class="alert alert-success">
                                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                                                            <div class="icon hidden-xs">
                                                              <i class="fa fa-check"></i>
                                                            </div>
                                                            <strong>Success</strong>
                                                            <Br />   {{ __('A fresh verification link has been sent to your email address.') }}
                                                          </div>
                       
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
