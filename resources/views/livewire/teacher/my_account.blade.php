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
                                      
                              
                                </div>
                                <div class="my_course_content_list">
                                     <div class="my_setting_content_details pt-3">
                                        @if($data['bank_account'])
                                        <h5>Bank Details</h5>
                                        <div class="cart_page_form in-st">
                                            <div class="table-responsive custom-table-responsive">
                                                <table class="table custom-table">
                                                <thead>
                                                    @if($data['teacher']->country != 'IN')
                                                <tr>
                                                
                                                    
                                                    <th scope="col">Acount Holder  Name</th>
                                               
                                                                                                    
                                                    <th scope="col">
                                                        
                                                            Account Type

                                                        

                                                    </th>
                                                    <th scope="col">Bank Name</th>
                                                    <th scope="col">Account Number</th>
                                                    <th scope="col">Country</th>
                                                    
                                                
                                                
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  
                                                        <tr>
                                                            <td>{{$data['bank_account']->account_holder_name}}</td>
                                                            <td>{{$data['bank_account']->account_holder_type}}</td>
                                                            <td>{{$data['bank_account']->bank_name}}</td>
                                                            <td>XXX-XXXX-{{$data['bank_account']->last4}}</td>
                                                            <td>{{$data['bank_account']->country}}</td>
                                                            
                                                       </tr>
                                                       

                                                    <tr class="spacer"><td colspan="100"></td></tr>
                                                
                                                
                                                
                                                
                                                
                                                </tbody>
                                                @else
                                                 <tr>
                                                
                                                    
                                                    <th scope="col">Acount Holder  Name</th>
                                               
                                                                                                    
                                                    <th scope="col">
                                                        
                                                     IFSC code

                                            
                                                    </th>
                                                    <th scope="col">Bank Name</th>
                                                    <th scope="col">Account Number</th>
                                                    <th scope="col">Country</th>
                                                    
                                                
                                                
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  
                                                        <tr>
                                                            <td>{{$data['bank_account']['bank_account']['name']}}</td>
                                                            <td>{{$data['bank_account']['bank_account']['ifsc']}}</td>
                                                            <td>{{$data['bank_account']['bank_account']['bank_name']}}</td>
                                                            <td>{{$data['bank_account']['bank_account']['account_number']}}</td>
                                                            <td>India</td>
                                                            
                                                       </tr>
                                                       

                                                    <tr class="spacer"><td colspan="100"></td></tr>
                                                
                                                
                                                
                                                
                                                
                                                </tbody>
                                                @endif
                                                </table>
                                                </div>
                                            
                                   </div>

                                     @if(!$data['bank_account']['bank_account'])  
                                        <a href="{{url('teacher/update-bank')}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" target="_blank">
                                        Update Bank Details</a>
                                        @endif
                                        
                                        @else

                                        <a href="{{url('teacher/bank-details')}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border">Add Bank Details</a>
                                    @endif
                                     @if(!$data['customer_cards'])
                                       <a href="{{url('/add_card')}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border"> Add Card </a>
                                       @endif
                                    </div>
                                  @if($data['customer_cards'])
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
                                                  @foreach($data['customer_cards']->data as $card)
                                                        <tr>
                                                            <td><img src="{{asset('front_assets/images/'.$card->brand.'.jpg')}}" alt="icon"width="50px">  &nbsp; {{$card->brand}}</td>
                                                            <td>XXXX-XXXX-XXXX-{{$card->last4}}</td>
                                                            <td>{{$card->exp_month}} / {{$card->exp_year}}</td>
                                                            <td>
                                                                @hasrole('teacher')
                                                                    @if(count($data['customer_cards']->data) > 1 )

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