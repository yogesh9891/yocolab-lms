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
                                <h4 class="title float-left">Cancel Class Reports</h4>  
                            
                            </nav>
                        
                         @if(!$reports->isEmpty())
                            <table class="table table-bordered table-striped " id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                    
                                        <th class="d-none d-sm-table-cell">    Date & Time</th>
                                        <th class="d-none d-sm-table-cell">Currency</th>
                                    
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Students</th>
                                       
                                        <th class="text-center">Earning</th>
                                        <th class="text-center">Penality</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reports as $val)
                                      @php 
                                                        $timezone = timezone($val);
                                                         $earning =  $val->price;
                                                         if($val->discount){
                                                            $earning = round($earning - $earning*($val->discount/100),2);
                                                         }
                                                        $students = 0;
                                                        $penality = 0;
                                                        $price = $earning;
                                                        if($val->earning){
                                                            $students = $val->earning->students;
                                                            $penality = $val->earning->total;
                                                        }
                                                      
                                                        $c_date = $timezone->date;
                                                        $c_time = $timezone->time;
                                                        $fee =  round(($price*6)/100,2) ;  
                                                        $total = $price + $fee;
                                                       
                                                        $earning = $total*$students;
                                                    
                                                       
                                                        @endphp 
                                    
                                                        <tr>
                                                            <td>
                                                                {{$val->title}} <br> By {{$val->user->name}}</td>
                                                              
                                                           <td>
                                                              
                                                                <p>{{$c_date}}</p>
                                                                <p class="time-display">{{$c_time}} </p>
                                                             
                                                            </td>
                                                            <td>{{$val->currency}}</td>
                                                            <td>
                                                                  {{$price}}
                                                            </td>
                                                            <td>{{$students}}</td>
                                                             
                                                            
                                                                <td>{{$earning}}</td>
                                                                <td>{{$penality}}</td>
                                                            
                                                       </tr>
                                                       

                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <span class="alert-info d-block mb-15 p-15" role="alert">
                                             
                                     <strong>No Data</strong>
                                               
                                </span>
                            @endif
                          
                
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @endsection

