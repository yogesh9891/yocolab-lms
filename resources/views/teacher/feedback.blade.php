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
                                            <h4 class="mt10">My Feedbacks</h4>
                                        </div>
                                    </div>
                               
                                </div>
                                <div class="my_course_content_list">
                                  
                           
                                  @if(count($feedbacks) > 0) 
                                    <div class="my_setting_content_details">
                                        <div class="cart_page_form style2 in-st">
                                            <form action="#">

                                                <div class="table-responsive custom-table-responsive text-left">
                                                <table class="table custom-table">
                                                <thead>
                                                <tr>
                                                
                                                    
                                                    <th scope="col">Name</th>
                                               
                                                                                                    
                                                    <th scope="col">
                                                        
                                                            Date & Time

                                                        

                                                    </th>
                                                    <th scope="col">Feedback</th>
                                                    <th scope="col">Apporved</th>
                                                    <th scope="col">Star</th>
                                                    
                                                
                                                
                                                </tr>
                                                </thead>
                                                <tbody>
                                                 @foreach($feedbacks as $f)
                                                 @if($f->course)
                                                        @php $t = App\Models\User::find($f->course->user_id);
                                                        $earning = 0;
                                                      
                                                        $timezone = timezone($f->course);
                                                        $c_date = $timezone->date;
                                                        $c_time = $timezone->time;
                                                        date_default_timezone_set(session('timezone'));
                                                        
                                                       
                                                        @endphp 
                                                        <tr>
                                                            <td>@if($f->course) {{$f->course->title}}@else none @endif</td>
                                                            <td>@if($f->course) {{$c_date}}   {{$c_time}} @else none @endif</td>
                                                            <td>{{$f->feedback}}</td>
                                                            <td>{{$f->star}}</td>
                                                            
                                                       </tr>
                                                       

                                                    <tr class="spacer"><td colspan="100"></td></tr>
                                                    @endif
                                                @endforeach
                                                
                                                
                                                
                                                
                                                </tbody>
                                                </table>
                                                </div>
                                           
                                            {!! $feedbacks->links() !!}
                                            </form>
                                        </div>
                                    </div>
                                    @else
                               <h2 class="no-classes ">No Feedback Available</h2>
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