@extends('layouts.app')
@section('title','Yocolab')
@section('content')
@section('before_body')
<style>
    .cc-img {
        margin: 0 auto;
    }
    .hide {
        display: none;
    }
</style>
@endsection

    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title">Add Bank</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Bank</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-4 offset-md-4">
         <form role="form" id="payment-form" method="post" action="{{route('add_bank')}}">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                       
                        <img class="img-fluid cc-img" src="{{asset('front_assets/images/stripe.png')}}">
                    </div>
                </div>
                <div class="card-block">
                        @csrf
                        @method('post')
                        <div class="row">

                                
                                       @if(Session::has('error'))
                                                         <div class="alert alert-danger">
                                                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                                                                <div class="icon hidden-xs">
                                                                  <i class="fa fa-ban"></i>
                                                                </div>
                                                                <strong>Error</strong>
                                                                <br /> {{Session::get('error')}}
                                                              </div>
                                            @endif
                                    
                                 @if(Session::has('success'))
                                                        <div class="alert alert-success">
                                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                                                            <div class="icon hidden-xs">
                                                              <i class="fa fa-check"></i>
                                                            </div>
                                                            <strong>Congratulations!</strong>
                                                            <Br /> {{Session::get('success')}}
                                                          </div>
                                            @endif
                       
    
                              
                            <div class="col-12">

                                <div class="form-group">
                                    <label>Account Holder Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control card-num" placeholder="Enter your name" / name="name" required="">
                                  
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Acoount Number</label>
                                    <input type="tel" class="form-control" placeholder="765432123456789" name="account" required="" />
                                </div>
                            </div>    
                              <div class="col-12">
                                <div class="form-group">
                                    <label>IFSC code</label>
                                    <input type="text" class="form-control" placeholder="HDFC0000053" name="ifsc" required="" />
                                </div>
                            </div>
                        </div>
                        
                       
            
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <input class="btn btn-primary-custom btn-primary-custom-round w-100" type="submit" value="Add Bank">
                        </div>
                    </div>
                </div>
       
            </div>
        </form>
        </div>
    </div>
</div>


@endsection
