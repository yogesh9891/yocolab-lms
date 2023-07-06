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
                                <h4 class="title float-left">Stripe Reports</h4>  
                                
                            </nav>
                        
                         @if(!$reports->isEmpty())
                            <table class="table table-bordered table-striped " id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                    
                                        <th class="d-none d-sm-table-cell">    Date & Time</th>
                                        <th class="d-none d-sm-table-cell">Currency</th>
                                    
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Student Enrolled</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Earning</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reports as $val)
                                      @php $course = App\Models\Course::find($val->course_id);
                                                        $earning = 0;
                                                      
                                                        $timezone = timezone($course);
                                                        $c_date = $timezone->date;
                                                        $c_time = $timezone->time;
                                                        
                                                    
                                                       
                                                        @endphp 
                                    
                                                        <tr>
                                                            <td>
                                                                {{$val->title}} </td>
                                                              
                                                           <td>
                                                              
                                                                <p>{{$c_date}}</p>
                                                                <p class="time-display">{{$c_time}} </p>
                                                             
                                                            </td>
                                                            <td>{{$val->currency}}</td>
                                                            <td>
                                                                  {{$val->price}}
                                                            </td>
                                                            <td>{{$val->students}}</td>
                                                             
                                                             <td> @if($val->status=='complete')

                                                                    <span class="badge badge-primary">Complete</span>
                                                                    @else
                                                                    
                                                                    <span class="badge badge-danger">{{$val->status}}</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{$val->total}}</td>
                                                            
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

    @section('afterScript')
    <script type="text/javascript">
        

          $(".faqStatus").on('click',function() {
               var id = $(this).attr('data-id');

               $.ajax({
                    type: "POST",
                    url: "/admin/faqStatus",
                    headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       },
                    data: {
                        id: id
                    },
                    success: function (msg) {
                        // console.log(msg)
                    }
                });
           });




</script>
  
    @endsection