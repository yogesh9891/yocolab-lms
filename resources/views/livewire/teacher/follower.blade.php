  <div class="row">
                   <div class="col-lg-12">
                        <div class="my_course_content_container">
                            <div class="my_course_content mb30 pt-0">
                                <div class="my_course_content_header py-2">
                                    <div class="col-md-4">
                                        <div class="instructor_search_result style2">
                                            <h4 class="mt10">My Followers</h4>
                                        </div>
                                    </div>
                               
                                </div>
                                <div class="my_course_content_list">
                                  
                           
                                  @if(count($data['followers']) > 0) 
                                    <div class="my_setting_content_details">
                                        <div class="cart_page_form style2 in-st">
                                            <form action="#">

                                                <div class="table-responsive custom-table-responsive text-left">
                                                <table class="table custom-table">
                                                <thead>
                                                <tr>
                                                
                                                    
                                                    <th scope="col">Name</th>
                                               
                                               
                                                    
                                                
                                                
                                                </tr>
                                                </thead>
                                                <tbody>
                                                 @foreach($data['followers'] as $f)
                                                 @if($f->user)
                                                     
                                                        <tr>
                                                            <td> {{$f->user->name}}</td>
                                                          
                                                            
                                                       </tr>
                                                       

                                                    <tr class="spacer"><td colspan="100"></td></tr>
                                                    @endif
                                                @endforeach
                                                
                                                
                                                
                                                
                                                </tbody>
                                                </table>
                                                </div>
                                           
                                             <button class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-borde" wire:click="load({{$view}})"> Load more</button>
                                            </form>
                                        </div>
                                    </div>
                                    @else
                               <h2 class="no-classes ">No Followers Available</h2>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>