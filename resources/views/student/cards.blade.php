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
                            <div class="my_course_content mb30">
                                <div class="my_course_content_header">
                                    <div class="col-xl-4">
                                        <div class="instructor_search_result style2">
                                            <h4 class="mt10">My cards</h4>
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
                        
                                  @if(count($customer_cards) > 0)
                                    <div class="my_setting_content_details pb0">
                                        <div class="cart_page_form style2">
                                            <form action="#">
                                                <table class="table table-responsive">
                                                    <thead>
                                                        <tr class="carttable_row">
                                                            <th class="cartm_title">Card Name</th>
                                                            <th class="cartm_title">Card Number</th>
                                                           
                                                             <th class="cartm_title">Action</th> 
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table_body">
                                                     		@foreach($customer_cards->data as $card)
													    <tr>
													    	
													    	<td>{{$card->brand}}</td>
													    	<td>XXXX-XXXX-XXXX-{{$card->last4}}</td>
													    	<td>
													    		@hasrole('teacher')
														    		@if(count($customer_cards->data) > 1 )

														    		<a class="btn btn-danger btn-sm" href="{{url('delete-card/'.$card->id.'/'.$card->customer)}}" onclick="return confirm('Are you sure?')"  > Delete</a>
														    		@endif
														    		@else
														    			<a class="btn btn-danger btn-sm" href="{{url('delete-card/'.$card->id.'/'.$card->customer)}}" onclick="return confirm('Are you sure?')"  > Delete</a>
														    		@endhasrole
													    		
													    	</td>
													    	{{-- <td class="cart_total">$259.00</td> --}}
													    	{{-- <td class="text-thm tdu">Receipt</td> --}}
													    </tr>
													    @endforeach
                                                       
                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>
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