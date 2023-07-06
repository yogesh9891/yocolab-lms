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
						
						 @if(!$datas->isEmpty())
                        <table class="table table-bordered table-striped " id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">#Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Title</th>
                                        <th class="d-none d-sm-table-cell">File</th>
              
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datas as $data)
                                    <tr>
                                        <td class="text-center">{{$data->id}}</td>
                                        <td class="font-w600">{{$data->teacher->name}}</td>
                                        <td class="font-w600">{{$data->teacher->email}}</td>
                                      
                                        <td class="font-w600">{{$data->title}}</td>
                                        <td class="font-w600">
                                          <a href="{{asset('storage/material/'.$data->file)}}" download>
                                                  Download
                                                </a>

                                        </td>
                                     {{--   <!--  <td class="d-none d-sm-table-cell">

                                         <input type="checkbox" @if($category->status == 1) checked @endif class="categoryStatus check_box" data-id="{{ $category->id }}"> 
                                        </td> --> --}}
                                       <td class="text-center">
                                           <div class="btn-group">
                                                <a href="{{route('material.edit',$data->id)}}" class="btn btn-sm btn-primary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                                <i class="far fa-edit"></i>

                                                </a>
                                                <form action="{{route('material.destroy',$data->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
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