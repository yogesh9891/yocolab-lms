@extends('layouts.backend')
@section('content')
<div class="our-dashbord dashbord">
        <div class="dashboard_main_content">
            <div class="container-fluid">
                <div class="main_content_container">
                    <div class="row">
                      @if (Session::has('flash_message'))
                        <div class="container">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('flash_message') }}
                            </div>
                        </div>
                    @endif
                        <div class="col-lg-12">

                            <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
                                <h4 class="title float-left">Teachers</h4>  
                        
                            </nav>
                        
                         @if($courses)
                             
                            <table class="table table-bordered table-striped " id="myTable">
                                                <thead>
                                                <tr>
                                                
                                                    
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Instructor</th>
                                               
                                                                                                    
                                                    <th scope="col">
                                                        
                                                            Date & Time

                                                        

                                                    </th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Student Enrolled</th>
                                                    <th scope="col">Teacher Earning</th>
                                                    
                                                
                                                
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($courses as $course)
                                                        @php $t = App\Models\User::find($course->user_id);
                                                        $earning = 0;
                                                        if(session('timezone')){
                                                        $timezone = timezone($course);
                                                        $c_date = $timezone->date;
                                                        $c_time = $timezone->time;
                                                        date_default_timezone_set(session('timezone'));
                                                        }
                                                        else
                                                        {
                                                            $timestamp = strtotime($course->date);
                                                            // Creating new date format from that timestamp
                                                            $c_date = date("d M Y", $timestamp);
                                                            $c_time = date("H:i", $timestamp);
                                                        }
                                                        $stu_enrolled = \App\Models\StudentCourse::where('course_id',$course->id)->where('status','done')->count();
                                                        @endphp 
                                                  
                                                        <tr>
                                                            <td>
                                                                {{$course->title}} 
                                                                @if($course->status == 1)
                                                                @if($course->type=='Live')
                                                                <span class="badge badge-primary">Live</span>
                                                                @else
                                                                <span class="badge badge-info">Recorded</span>
                                                                @endif
                                                                @else
                                                                <span class="badge badge-danger">Cancelled</span>
                                                                @endif</td>
                                                                <td>{{$t->name?$t->name:''}}</td>
                                                            <td>
                                                                @if($course->type == 'Live')
                                                                {{$c_date}} {{$c_time}} 
                                                              
                                                                @else
                                                                <p>{{date("d M Y", strtotime($course->created_at))}}</p>
                                                                <p class="time-display">{{$course->duration}} hrs </p>
                                                                @endif</td>
                                                            <td>
                                                                @php $curr = currency_convert($course);
                                                                $price= 0;
                                                                if($course->price_type=='paid'){
                                                                if($course->discount){
                                                               
                                                                $price = $course->price - ($course->price*$course->discount)/100;
                                                                }
                                                                else
                                                                {
                                                                    $price = $course->price;
                                                                }
                                                                $earning = ($price*$stu_enrolled*75)/100;
                                                                echo $price.' '.$course->currency;
                                                                }
                                                                else
                                                                {
                                                                    echo 'Free';
                                                                }
                                                                @endphp
                                                            </td>
                                                            <td>{{$stu_enrolled}}</td>
                                                            <td> @if($course->price)
                                                               {{$earning}} {{$course->currency}}
                                                               @else
                                                               Free
                                                               @endif</td>
                                                            
                                                       </tr>
                                                       

                                                
                                                
                                                
                                                   @endforeach
                                                
                                                
                                                </tbody>
                                                </table>
                                        
                                    @endif
                          
                
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    @endsection