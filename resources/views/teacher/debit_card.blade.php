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
						<h4 class="breadcrumb_title">Card Details</h4>
						<ol class="breadcrumb">
						    <li class="breadcrumb-item"><a href="#">Home</a></li>
						    <li class="breadcrumb-item active" aria-current="page">Card Details</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</section>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-4 offset-md-4">
         <form role="form" id="payment-form" method="post">
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

		                        
		                             @if(Session::has('flash_error'))
		                               <div class='col-md-12  error form-group'>
		                                <div class='alert-danger alert'>{{Session::get('flash_error')}}</div>
		                            </div>
		                            @endif
                                     @if(Session::has('success'))
                                       <div class='col-md-12   form-group'>
                                        <div class='alert-success alert'>{{Session::get('success')}}</div>
                                    </div>
                                    @endif
		               
                                    <div class='col-md-12 hide error form-group'>
                                        <div class='alert-danger alert'>Fix the errors before you begin.</div>
                                    </div>
                              
                            <div class="col-12">

                                <div class="form-group">
                                    <label>CARD NUMBER</label>
                                    <div class="input-group">
                                        <input type="tel" class="form-control card-num" placeholder="Valid Card Number" / id="cardNumber">
                                        {{-- <span class="input-group-addon"><span class="fa fa-credit-card"></span></span> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-md-4">
                                <div class="form-group">
                                    <label><span class="visible-xs-inline">EXP</span> MONTH</label>
                                    <input type="tel" class="form-control card-expiry-month" placeholder="MM " />
                                </div>
                            </div>
                            <div class="col-xs-4 col-md-4">
                                <div class="form-group">
                                    <label><span class="visible-xs-inline">EXP</span> YEAR</label>
                                    <input type="tel" class="form-control card-expiry-year" placeholder=" YY" />
                                </div>
                            </div>
                            <div class=" col-md-4 float-xs-right">
                                <div class="form-group">
                                    <label>CV CODE</label>
                                    <input type="tel" class="form-control card-cvc" placeholder="CVC" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>CARD OWNER</label>
                                    <input type="text" class="form-control" placeholder="Card Owner Name" />
                                </div>
                            </div>
                        </div>
            
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <input class="btn btn-primary-custom btn-primary-custom-round w-100" type="submit" value="Add Card">
                        </div>
                    </div>
                </div>
       
            </div>
        </form>
        </div>
    </div>
</div>


@endsection

@section('afterScript')
<script src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
	var $form   = $("#payment-form");

    $('#cardNumber').on('keyup', function(e){
    var val = $(this).val();
    var newval = '';
    val = val.replace(/\s/g, '');
    for(var i=0; i < val.length && val.length <=16; i++) {
        if(i%4 == 0 && i > 0) newval = newval.concat(' ');
        newval = newval.concat(val[i]);
    }
    $(this).val(newval);
});
  
 $('#payment-form').submit(function (e) {
    e.preventDefault(0);

    let pk = "{{env('STRIPE_KEY')}}";
    let stripe =  Stripe.setPublishableKey(pk);
      Stripe.createToken({
        number: $('.card-num').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val(),
        currency:'SGD',
      }, stripeHandleResponse);


  
  function stripeHandleResponse(status, response) {

        if (response.error) {
        	 console.log(response.error.message)
        	 $form[0].reset();
            $('.error').removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {

             var token = response['id'];
               console.log(response);
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
  
});
</script>

@endsection