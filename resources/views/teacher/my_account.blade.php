@extends('layouts.app')
@section('title','Yocolab')
@section('content')

<div class="custom-dashboard-wrapper">
					@include('student.nav')


	 <div class="content-wrapper">
            <div class="content">
                <div class="row">
                   <div class="col-lg-12">
                        <div class="my_course_content_container">
                            <div class="my_course_content mb30 pt-0">
                                <div class="my_course_content_header py-2">
                                    <div class="col-md-4">
                                        <div class="instructor_search_result style2">
                                            <h4 class="mt10">My Account</h4>

                                        </div>
                                    </div>
                                      
                                  {{--   <div class="col-xl-8">
                                        <div class="candidate_revew_select style2 text-right">
                                            <ul class="mb0">
                                                <li class="list-inline-item">
                                                    <select class="selectpicker show-tick">
                                                        <option>Newly published</option>
                                                        <option>Recent</option>
                                                        <option>Old Review</option>
                                                    </select>
                                                </li>
                                                <li class="list-inline-item">
                                                    <div class="candidate_revew_search_box course fn-520">
                                                        <form class="form-inline my-2 my-lg-0">
                                                            <input class="form-control mr-sm-2" type="search" placeholder="Search our instructors" aria-label="Search">
                                                            <button class="btn my-2 my-sm-0" type="submit"><span class="flaticon-magnifying-glass"></span></button>
                                                        </form>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="my_course_content_list">
                                     <div class="my_setting_content_details pt-3">
                                        @if($bank_account)
                                        <h5>Bank Details</h5>
                                        <div class="cart_page_form in-st">
                                            <div class="table-responsive custom-table-responsive">
                                                <table class="table custom-table">
                                                <thead>
                                                <tr>
                                                
                                                    @if($bank_account->account_holder_name)
                                                    <th scope="col">Acount Holder  Name</th>
                                                    @endif
                                                    @if($bank_account->account_holder_type)                                              
                                                    <th scope="col"> Account Type</th>
                                                    @endif
                                                    <th scope="col">Bank Name</th>
                                                    <th scope="col">Account Number</th>
                                                    <th scope="col">Country</th>
                                                    
                                                
                                                
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  
                                                        <tr>
                                                         @if($bank_account->account_holder_name)                                              
                                                             <td>{{$bank_account->account_holder_name}}</td>
                                                          @endif
                                                         @if($bank_account->account_holder_type)                                              
                                                             <td>{{$bank_account->account_holder_type}}</td>
                                                        @endif
                                                        
                                                            <td>{{$bank_account->bank_name}}</td>
                                                            <td>@if($bank_account->ifsc) {{$bank_account->no}}  @else XXX-XXXX-{{$bank_account->last4}} @endif</td>
                                                            <td>{{$bank_account->country}}</td>
                                                            
                                                       </tr>
                                                       

                                                    <tr class="spacer"><td colspan="100"></td></tr>
                                                
                                                
                                                
                                                
                                                
                                                </tbody>
                                                </table>
                                                </div>
                                            
                                          </div>

                                        @if($bank_account->account_holder_name)  
                                        <a href="{{url('teacher/update-bank')}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" target="_blank">
                                        Update Bank Details</a>
                                        @endif
                                        @else
                                        <a href="{{url('teacher/bank-details')}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border">Add Bank Details</a>
                                    @endif
                                     @if(!$customer_cards)
                                       <a href="{{url('/add_card')}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border"> Add Card </a>
                                       @endif
                                    </div>
                                  @if($customer_cards)
                                    <div class="my_setting_content_details">
                                        <h5>Card Details</h5>
                                        <div class="cart_page_form style2 in-st">
                                            <form action="#">

                                                <div class="table-responsive custom-table-responsive">
                                                <table class="table custom-table">
                                                <thead>
                                                <tr>
                                                
                                                    
                                                    <th scope="col">Card Type</th>
                                               
                                                                                                    
                                                    <th scope="col">  Card Number </th>
                                                    <th scope="col">  Expiry month/year </th>
                                                    <th scope="col">Action</th>
                                                    
                                                
                                                
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  @foreach($customer_cards->data as $card)
                                                        <tr>
                                                            <td><img src="{{asset('front_assets/images/'.$card->brand.'.jpg')}}" alt="icon"width="50px">  &nbsp; {{$card->brand}}</td>
                                                            <td>XXXX-XXXX-XXXX-{{$card->last4}}</td>
                                                            <td>{{$card->exp_month}} / {{$card->exp_year}}</td>
                                                            <td>
                                                                @hasrole('teacher')
                                                                    @if(count($customer_cards->data) > 1 )

                                                                    <a class="icon-button del-icon btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" href="{{url('delete-card/'.$card->id.'/'.$card->customer)}}" onclick="return confirm('Are you sure?')"  ><i class="fa fa-times"></i></a>
                                                                    @endif
                                                                    @else
                                                                        <a class="icon-button del-icon btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" href="{{url('delete-card/'.$card->id.'/'.$card->customer)}}" onclick="return confirm('Are you sure?')"  ><i class="fa fa-times"></i></a>
                                                                    @endhasrole</td>
                                                            
                                                       </tr>
                                                       

                                                    <tr class="spacer"><td colspan="100"></td></tr>
                                                
                                                
                                                @endforeach
                                                
                                                
                                                </tbody>
                                                </table>
                                                </div>
                                                <!-- <table class="table table-responsive">
                                                    <thead>
                                                        <tr class="carttable_row">
                                                            <th class="cartm_title" style="width: 45%;">Card Name</th>
                                                            <th class="cartm_title" style="width: 45%;">Card Number</th>
                                                            <th class="cartm_title" style="width: 10%;">Action</th> 
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table_body">
                                                     		@foreach($customer_cards->data as $card)
													    <tr>
													    	
													    	<td style="width: 75%;padding: 15px 31px;">{{$card->brand}}</td>
													    	<td style="width: 75%;padding: 15px 31px;">XXXX-XXXX-XXXX-{{$card->last4}}</td>
													    	<td style="width: 75%;padding: 15px 31px;">
													    		@hasrole('teacher')
														    		@if(count($customer_cards->data) > 1 )

														    		<a class="icon-button del-icon btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" href="{{url('delete-card/'.$card->id.'/'.$card->customer)}}" onclick="return confirm('Are you sure?')"  ><i class="fa fa-times"></i></a>
														    		@endif
														    		@else
														    			<a class="icon-button del-icon btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" href="{{url('delete-card/'.$card->id.'/'.$card->customer)}}" onclick="return confirm('Are you sure?')"  ><i class="fa fa-times"></i></a>
														    		@endhasrole
													    		
													    	</td>
													    	{{-- <td class="cart_total">$259.00</td> --}}
													    	{{-- <td class="text-thm tdu">Receipt</td> --}}
													    </tr>
													    @endforeach
                                                       
                                                    </tbody>
                                                </table> -->
                                            </form>
                                        </div>
                                        <a href="{{url('/add_card')}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border mb-2"> Add Card </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>

@endsection