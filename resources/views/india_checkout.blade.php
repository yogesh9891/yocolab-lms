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
			<div class="row">
			
				<div class="col-md-8 ">
						{{-- 	<div class="checkout_form">
								<div class="heading text-center">
								
						
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

                                                <button class="btn btn-primary-custom  btn-primary-custom-border mb-4 svd-crd d-block" type="button" id="new_card">Add  Card</button>
                                                </div>
                                                @endif
		                
		                    <div class="spacer"></div>
		         			
		                 
		                      	</div>

		             
								
							</div> --}}



									<div class="cart_page_form" id="res_cart_table">
											@php   
											$curr = currency_convert($course);
											 $timezone = timezone($course);
                                                        
                               $c_date1 = $timezone->date;  
                               $c_time1 = $timezone->time;

											;$total = 0; $fee= 0;  @endphp
									
										<form action="#">

											<div class="table-responsive custom-table-responsive">
				                                                <table class="table custom-table">
				                                                <thead>
				                                                <tr>
				                                                
				                                                    
				                                                    <th scope="col">Class</th>
				                                               
				                                                                                                    
				                                                    <th scope="col">
				                                                        
				                                                            Title

				                                                        

				                                                    </th>
				                                                    <th scope="col">Date</th>
				                                                    <th scope="col">Type</th>
				                                                    <th scope="col">Total</th>
				                                                    
				                                                
				                                                
				                                                </tr>
				                                                </thead>
				                                                <tbody>
				                                                     
				                                                  
				                                                        <tr>
				                                                            <td>
				                                                                <a href="{{url('course/'.$course->id)}}"><img src="{{asset('storage/course/'.$course->image)}}"width="120" height="90" alt="cart1.png"></a>
				                                                            </td>
				                                                            <td>
				                                                                <a class="cart_title" href="{{url('course/'.$course->id)}}">{{$course->title}}</a>
				                                                            </td>
				                                                            <td>
																				@if($course->date)
																	    		{{$c_date1}}<br>{{$c_time1}}
																	    		@else
																	    		---
																	    		@endif
				                                                            </td>
				                                                            <td>{{$course->type}}</td>
				                                                            <td> {!!$curr->html !!}</td>
				                                                            
				                                                       </tr>
				                                                       

				                                                    <tr class="spacer"><td colspan="100"></td></tr>
				                                                
				                                                
				                                                
				                                                
				                                                
				                                                </tbody>
				                                                </table>
				                                                </div>
											
										</form>
										
										
									</div>
						</div>
						<div class="col-md-4 col-xl-4">
							<div class="order_sidebar_widget mb30 cart-news">
								<h4 class="title">Order Summary</h4>

								<ul>
									@php
									$curr = currency_convert($course);
									 $fee =0;
									 $total =0;
									   @endphp
								

								
									<li class="subtitle"><p>{{$course->title}}  <span class="float-right">	{!! $curr->html !!}</span></p></li>

									
									
										@php 	

											$subtotal = $curr->price;
								 	// $cent = currency(0.50, 'SGD',  $curr->currency->code,$format = false);
								$fee =  ($subtotal*6)/100  ;  
											$total = $subtotal + $fee;
											$symbol = $curr->currency->symbol;
										$total = round($total,2);
										$fee = round($fee,2);
								 	$cent = currency($total, 'INR',  $curr->currency->code,$format = false);
										 @endphp
									{{-- <li class="subtitle"><p>Subtotal <span class="float-right">{{$subtotal}} {{$symbol}} </span></p></li> --}}
									<li class="subtitle"><p>Processing Fee  <span class="float-right">{{$fee}} {{$symbol}}</span></p></li>
									<li class="subtitle"><p>Total Amount <span class="float-right totals color-orose" id="OrderTotal">{{$total}} {{$symbol}}</span></p></li>

									
								</ul>
								    <form action="{{ url('india_checkout') }}" method="POST" >
								    	<input type="hidden" name="course_id" value="{{$course->id}}">
									<input type="hidden" name="pay" value="{{$total}}">
                                    @csrf
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                            data-key="{{ env('RAZORPAY_KEY') }}"
                                            data-amount="{{$total*100}}"
                                            data-buttontext="Pay Now"
                                            data-currency='{{$curr->currency->code}}'
                                            data-name="yocolab"
                                            data-description="{{$course->title}}"
                                            data-image="{{asset('front_assets/images/yocolab-logo-2.png')}}"
                                            data-prefill.name="{{Auth::user()->name}}"
                                            data-prefill.email="{{Auth::user()->email}}"
                                            data-theme.color="#ff7529"
                                            data.class="btn btn-primary-custom ">
                                    </script>
                                </form>
							</div>
							
		                        <!-- <div class="payment_widget_btn">
		                                <input type="submit" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" style="display: block;width: 100%;" id="pay" value="Pay Now">
		                          	</div> -->

						</div>
					</div>
					</div>
				
						</div>
	</section>

@endsection

