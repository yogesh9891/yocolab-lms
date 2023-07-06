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
						
						 @if(!$teachers->isEmpty())
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">#Id</th>
                                        <th>Name</th>
                                        <th class="d-none d-sm-table-cell">Email</th>
                                        <th class="d-none d-sm-table-cell">Phone</th>
                                        <th class="d-none d-sm-table-cell"> Date & Time</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teachers as $user)
                                    <tr>
                                        @php  $teach = teacherDetail($user->id); @endphp
                                        <td class="text-center">{{$user->id}}</td>
                                        <td class="font-w600">{{$user->name}}</td>
                                        <td class="d-none d-sm-table-cell">
                                            {{$user->email}}
                                        </td>
                                        <td class="font-w600">{{$user->phone}}</td>
                                        <td class="font-w600">{{$teach?$teach->date:''}}</td>
                                        
                                          <td class="text-center">
                                           <div class="btn-group">
                                            @if($user->status == 1)
                                                <a href="{{url('admin/user/'.$user->id.'/block')}}" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Block Instructor">
                                                <i class="far fa-user"></i> </a>
                                            @else
                                             <a href="{{url('admin/user/'.$user->id.'/unblock')}}" class="btn btn-sm btn-danger js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Unblock Instructor">
                                                <i class="fa fa-user-times"></i> </a>
                                            @endif
                                            @if($teach)
                                              <form action="{{url('admin/teacher/'.$teach->id.'/delete')}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                <button type ="submit" class="btn btn-sm btn-danger js-tooltip-enabled ml-2" data-toggle="tooltip" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this teacher ?');">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                        </div>
                                        </td> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                          
                                             
                                     <strong class="ml-5">No Users</strong>
                                               
                               
                            @endif
						  
				
					</div>
					
				</div>
			</div>
		</div>
	</div>

	@endsection