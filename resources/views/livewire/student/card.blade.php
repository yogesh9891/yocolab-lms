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
                                
                                </div>
                                <div class="my_course_content_list">
                        
                                  @if(count($data['customer_cards']) > 0)
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
                                                     		@foreach($data['customer_cards']->data as $card)
													    <tr>
													    	
													    	<td>{{$card->brand}}</td>
													    	<td>XXXX-XXXX-XXXX-{{$card->last4}}</td>
													    	<td>
													    		@hasrole('teacher')
														    		@if(count($data['customer_cards']->data) > 1 )

														    		<a class="btn btn-danger btn-sm" href="{{url('delete-card/'.$card->id.'/'.$card->customer)}}" onclick="return confirm('Are you sure?')"  > Delete</a>
														    		@endif
														    		@else
														    			<a class="btn btn-danger btn-sm" href="{{url('delete-card/'.$card->id.'/'.$card->customer)}}" onclick="return confirm('Are you sure?')"  > Delete</a>
														    		@endhasrole
													    		
													    	</td>
													    	
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