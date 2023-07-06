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
								<h4 class="title float-left">Request Class Query</h4>  
						
							</nav>
					
						 @if(!$datas->isEmpty())
                            <table class="table table-bordered table-striped table-vcenter " id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">#Id</th>
                                        <th>Teacher</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Description</th>
                                      
                                    
              
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datas as $data)
                                    <tr>
                                        @php  $teacher_det = teacherDetail($data->teacher_id); @endphp
                                        <td class="text-center">{{$data->id}}</td>
                                        <td class="">
                                            @if($teacher_det)
                                            <a href="{{url('/profile/'.str_slug($teacher_det->user->name).'/'.$teacher_det->teacher_id)}}" class="text-info">{{$teacher_det->user->name}}</a>
                                            @endif
                                        </td>
                                     
                                        <td class="text-center">{{$data->name}}</td>
                                        <td class="text-center">{{$data->email}}</td>
                                        <td class="text-center">{{$data->date}}</td>
                                        <td class="text-center">{{$data->time}}</td>
                                        <td class="text-center">{{$data->description}}</td>
                                 
                                      
                                    
                                       <td class="text-center">
                                           <div class="btn-group">
                                              
                                                <form action="{{url('admin/request-class')}}" method="post">
                                                    @csrf
                                                    @method('post')
                                                    <input type="hidden" name="id" value="{{$data->id}}" > 
                                                <button type ="submit" class="btn btn-sm btn-danger js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this item?');">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                            </div>
                                        </td> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                          
                                             
                                     <strong class="ml-5">No Data</strong>
                                               
                               
                            @endif
						  
				
					</div>
					
				</div>
			</div>
		</div>
	</div>

	@endsection