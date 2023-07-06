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
								<h4 class="title float-left">Course Related Query</h4>  
						
							</nav>
						
						 @if(!$datas->isEmpty())
                            <table class="table table-bordered table-striped " id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">#Id</th>
                                        <th>Query</th>
                                      
                                    
              
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datas as $data)
                                    <tr>
                                        <td class="text-center">{{$data->id}}</td>
                                        <td class="text-center">{{$data->search}}</td>
                                 
                                      
                                    
                                       <td class="text-center">
                                           <div class="btn-group">
                                              
                                                <form action="{{url('admin/course_query')}}" method="post">
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