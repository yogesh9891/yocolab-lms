@extends('layouts.app')
@section('title','Yocolab')
@section('content')

<style type="text/css">
	.hide{
		display: none;
	}

</style>
	<section class="inner_page_breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 offset-xl-3 text-center">
					<div class="breadcrumb_content">
						<h4 class="breadcrumb_title">Checkout</h4>
						<ol class="breadcrumb">
						    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Shop Checkouts Content -->
	<section class="shop-checkouts">
		<div class="container">
			 <form action="{{route('checkout.store')}}"  method="POST" id="payment-form">
					<div class="row">
						<div class="col-md-12 col-lg-8 col-xl-8">
							<div class="checkout_form">
								<div class="heading text-center">
									<!-- <p>Have a coupon? <span class="text-thm6">Click here to enter your code</span></p> -->
								</div>
								<div class="checkout_coupon ui_kit_button">
									<!-- <form class="form-inline form1">
								    	<input class="form-control mr-sm-4" type="search" placeholder="Coupon Code" aria-label="Search">
								    	<button type="button" class="btn">Apply Coupon</button>
								    </form> -->
								   <!--  @if($customer_cards)
								    <h4 class="mb15">Saved cards</h4>
								     <div class='form-row row'>
								     	@foreach($customer_cards->data as $card)
		                         
		                            <div class='col-4 form-group '>
		                                 <a href="javascript:void(0)"  class="applyCard" id="{{$card->id}}" cust="{{$card->customer}}"> <p>{{$card->brand}}</p>
		                                <p>xxxx-xxxx-xxxx - {{$card->last4}}</p>
		                                 {{-- <input name="card_holder"  class='form-control' size='4' type='text' > --}}
		                      			  </a>	
		                      			  @hasrole('teacher')
											 @if(count($customer_cards->data) > 1 )
		                      			  <h4><a href="{{url('delete-card/'.$card->id.'/'.$card->customer)}}"  class="text-danger" onclick="return confirm('Are you sure?')" > <i class="fa fa-trash"></i></a></h4>
		                      			  @endif
											@else
		                      			   <h4><a href="{{url('delete-card/'.$card->id.'/'.$card->customer)}}"  class="text-danger" onclick="return confirm('Are you sure?')" > <i class="fa fa-trash"></i></a></h4>
		                      			   		@endhasrole
		                            </div>
		                            @endforeach

		                            <button class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" type="button" id="new_card">New Card</button>
		                        </div>
								    @endif -->
						
		                    @csrf
		                    <h2>Billing Details</h2>

		                    <div class="form-group">
		                        <label for="email">Email Address</label>
		                        @if (auth()->user())
		                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
		                        @else
		                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
		                        @endif
		                    </div>

		                    @if($customer_cards)
								    <h2 class="mb-3 mt-5">Saved cards</h2>

		                    <div class="table-responsive custom-table-responsive mb-5">
                                                <table class="table custom-table mt-4">
                                                
                                                <tbody>
                                                   @foreach($customer_cards->data as $card)
                                                  
                                                        <tr>
                                                            <td>
                                                                <a href="javascript:void(0)"  class="applyCard d-flex align-items-center" id="{{$card->id}}" cust="{{$card->customer}}"> <input type="radio" > <p class="mb-0 ml-3"><img src="{{asset('front_assets/images/'.$card->brand.'.jpg')}}" alt="icon"width="50"> {{$card->brand}}</p>
                                                                </a>
                                                            </td>

                                                            <td>
                                                               <a href="javascript:void(0)" > <p class="mb-0"> xxxx-xxxx-xxxx - {{$card->last4}}</p></a>
                                                           </td>
                                                           	 <td>{{$card->exp_month}} / {{$card->exp_year}}</td>

                                                            
                                                            
                                                       </tr>


                                                       

                                                    <tr class="spacer"><td colspan="100"></td></tr>

                                                    @hasrole('teacher')
											 @if(count($customer_cards->data) > 1 )
		                      			  <h4><a href="{{url('delete-card/'.$card->id.'/'.$card->customer)}}"  class="text-danger" onclick="return confirm('Are you sure?')" > <i class="fa fa-trash"></i></a></h4>
		                      			  @endif
											@else
		                      			   <h4><a href="{{url('delete-card/'.$card->id.'/'.$card->customer)}}"  class="text-danger" onclick="return confirm('Are you sure?')" > <i class="fa fa-trash"></i></a></h4>
		                      			   		@endhasrole
                                                
                                                	
                                                   @endforeach
                                                  
                                                   
                                                
                                                
                                                </tbody>
                                                </table>

                                                <button class="btn btn-primary-custom  btn-primary-custom-border mb-4 svd-crd " type="button" id="new_card" style="display:none !important;">Add  Card</button>
                                                </div>
                                                @endif
		                
		                    <div class="spacer"></div>
		         			<div id="paymentDetail">
		                    <h2>Payment Details</h2>

		          
		  					
		                        <div class='form-row row'>
		                            <div class='col-12 form-group required'>
		                                <label class='control-label'>Name on Card</label>
		                                 <input name="card_holder"  class='form-control' size='4' type='text' >
		                            </div>
		                        </div>
		  
		                        <div class='form-row row'>
		                            <div class='col-12 form-group card required'>
		                                <label class='control-label'>Card Number</label> <input
		                                    autocomplete='off' class='form-control card-num' size='20'
		                                    type='text' name="card_number" >
		                            </div>
		                        </div>
		  
		                        <div class='form-row row'>
		                            <div class='col-12 col-md-4 form-group expiration required'>
		                                <label class='control-label'>Expiration Month</label> <input
		                                    class='form-control card-expiry-month' placeholder='MM' size='2'
		                                    type='text' name="expirey_date">
		                            </div>
		                            <div class='col-12 col-md-4 form-group expiration required'>
		                                <label class='control-label'>Expiration Year</label> <input
		                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
		                                    type='text' name="expiraion_year" >
		                            </div>
		                            <div class='col-12 col-md-4 form-group cvc required'>
		                                <label class='control-label'>CVC</label> 
		                                <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 415' size='4'
		                                    type='text' name="cvc">
		                            </div>
		                        </div>
		  
		                        <div class='form-row row'>
		                            <div class='col-md-12 hide error form-group'>
		                                <div class='alert-danger alert'>Fix the errors before you begin.</div>
		                            </div>
		                        </div>

		                         <div class='form-row row'>
		                            <div class='col-md-12  form-group'>
		                                  <input type="checkbox" name="remember">
		                                  <label class='control-label'>Remember this card</label>
		                            </div>
		                        </div>
		  
		                      </div>
		                          
		                 
		                      	</div>

		             
								
							</div>
						</div>
						<div class="col-lg-4 col-xl-4">
							<div class="order_sidebar_widget mb30 cart-news">
								<h4 class="title">Your Order</h4>
								<ul>
									@php
									$curr = currency_convert($course);
									 $fee =0;
									 $total =0;
									   @endphp
								

								
									<li class="subtitle"><p>Class Fee  <span class="float-right">	{!! $curr->html !!}</span></p></li>

									
									
										@php 	

											$subtotal = $curr->price;
								 //	$cent = currency(0.50, 'SGD',  $curr->currency->code,$format = false);
								$fee =  ($subtotal*6)/100  ;  
											$total = $subtotal + $fee;
											$symbol = $curr->currency->symbol;
										$total = round($total,2);
										$fee = round($fee,2);
										 @endphp
									{{-- <li class="subtitle"><p>Subtotal <span class="float-right">{{$subtotal}} {{$symbol}} </span></p></li> --}}
									<li class="subtitle"><p>Processing Fee  <span class="float-right">{{$fee}} {{$symbol}}</span></p></li>
									<li class="subtitle"><p>Total Amount <span class="float-right totals color-orose" id="OrderTotal">{{$total}} {{$symbol}}</span></p></li>

									<input type="hidden" name="pay" value="{{$total}}">
									
								</ul>
								<input type="submit" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" style="display: block;width: 100%;" id="pay" value="Pay Now">
							</div>
							
		                        <!-- <div class="payment_widget_btn">
		                                <input type="submit" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" style="display: block;width: 100%;" id="pay" value="Pay Now">
		                          	</div> -->

						</div>
					</div>
				</form>
		</div>
	</section>

@endsection

@section('afterScript')
    <script src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
$(function() {
	// $('#new_card').hide();

let card = '';
$('.applyCard').click(function () {
	$('.applyCard').css('color','#000');
	$(this).css('color','#fd6003');
	$(this).children(0).attr('checked',true);

	let card_id = $(this).attr('id');
	let cust_id = $(this).attr('cust');
	$('#new_card').show();
	$('#paymentDetail').hide();
	    $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='card_id' value='" + card_id + "'/>");
            $form.append("<input type='hidden' name='cust_id' value='" + cust_id + "'/>");
            // $form.get(0).submit();
            card = 'apply';
})

$('#new_card').click(function () {
	$('#paymentDetail').show();
	


	$('.applyCard').css('color','#000');
	$('.applyCard').children(0).attr('checked',false);
	  $('#new_card').toggle();
	  document.getElementById("new_card").style.display = "none !important";;
	 // $(this).css('display','none');
	// $(this).css('color','#fd6003');
})




 let orderTotal = $('#OrderTotal').text();
  if(orderTotal  == 0){
  	$('#paymentDetail').hide();
   }

   var $form   = $("#payment-form");
  
 $('#payment-form').submit(function (e) {
    e.preventDefault(0);

    if(!card){

let Stripe_key = "{{env('STRIPE_KEY')}}"
    let stripe =  Stripe.setPublishableKey(Stripe_key);
      Stripe.createToken({
        number: $('.card-num').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeHandleResponse);

//       stripe.confirmCardPayment('pi_1IT5xHH8ZLByqdG3n4BUlxqG', {
//     payment_method: {
//       card: card,
//       billing_details: {
//         name: 'Jenny Rosen'
//       }
//     }
//   }).then(function(result) {
//     if (result.error) {
//       // Show error to your customer (e.g., insufficient funds)
//       console.log(result.error.message);
//     } else {
//       // The payment has been processed!
//       if (result.paymentIntent.status === 'succeeded') {
//         // Show a success message to your customer
//         // There's a risk of the customer closing the window before callback
//         // execution. Set up a webhook or plugin to listen for the
//         // payment_intent.succeeded event that handles any business critical
//         // post-payment actions.
//         	$form.get(0).submit();
//       }
//     }
// });
    
  } else {
  
  	$form.get(0).submit();

 // $('body').html('<div class="text-center"><img src="{{asset('front_assets/images/loader.gif')}}" alt=""></div>');
 $('#pay').val('Processing...');
 $('#pay').attr('disabled','disabled');

  }
  });
  
  function stripeHandleResponse(status, response) {
  	console.log('he')
        if (response.error) {
        	 console.log(response.error.message)
            $('.error').removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {

             var token = response['id'];
               
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
             $('#pay').hide();
        }
    }
  
});
</script>
  
@endsection