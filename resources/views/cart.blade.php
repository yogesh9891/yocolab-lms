@extends('layouts.app')
@section('title','Yocolab')
@section('content')

	<!-- Inner Page Breadcrumb -->
	<section class="inner_page_breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 offset-xl-3 text-center">
					<div class="breadcrumb_content">
						<h4 class="breadcrumb_title">Cart</h4>
						<ol class="breadcrumb">
						    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						    <li class="breadcrumb-item active" aria-current="page">Cart</li>
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
				<div class="col-md-12 col-lg-8 col-xl-8">
				
					<div class="cart_page_form" id="res_cart_table">
							@php   
							$curr = currency_convert($course);

							;$total = 0; $fee= 0; 

							 $timezone = timezone($course);
                                                        
                               $c_date1 = $timezone->date;  
                               $c_time1 = $timezone->time;

                              @endphp


					
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
					

					{{-- <div class="checkout_form">
						<div class="checkout_coupon ui_kit_button">
							<form class="form-inline">
						    	<input class="form-control" type="search" placeholder="Coupon Code" aria-label="Search">
						    	<button type="button" class="btn btn2">Apply Coupon</button>
						    	<button type="button" class="btn btn3">Update Cart</button>
						    </form>
						</div>
					</div> --}}
				</div>
				<div class="col-lg-4 col-xl-4">
					<div class="order_sidebar_widget mb30 cart-new">
						<h4 class="title">Order Summary</h4>
						<ul>
							
								@php 
								$subtotal = $curr->price;
								 //	$cent = currency(0.50, 'SGD',  $curr->currency->code,$format = false);
								$fee =  ($subtotal*6)/100  ;  
											$total = $subtotal + $fee;
											$symbol = $curr->currency->symbol;
											

										 @endphp
									<li class="subtitle"><p>Class Fee <span class="float-right">{!! $curr->html !!} </span> </p></li>
									<li class="subtitle"><p>Processing Fee  <span class="float-right">{{$symbol}} {{round($fee,2)}} </span></p></li>
									<li class="subtitle"><p>Total Amount <span class="float-right totals color-orose">{{$symbol}} {{round($total,2)}} </span></p></li>
						</ul>
						<a href="{{url('/checkout')}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" style="display: block;">Proceed To Checkout</a>
					</div>
					<!-- <div class="payment_widget_btn">
						<a href="{{url('/checkout')}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" style="display: block;">Proceed To Checkout</a>
					</div> -->
				</div>
			</div>
		</div>
	</section>

@endsection