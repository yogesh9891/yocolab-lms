@extends('layouts.backend')
@section('content')
<div class="our-dashbord dashbord">
		<div class="dashboard_main_content">
			<div class="container-fluid">
				<div class="main_content_container">
					<div class="row">
				
						<div class="col-lg-12">
							<nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
								<h4 class="title float-left">Zoom Id</h4>
									<a href="{{route('zoomId.index')}}" class="btn btn-warning float-right"><i class="fas fa-arrow-left"> </i> Back</a>
							</nav>
						</div>

						<div class="col-lg-12">
									<div class="my_course_content_container">
										<div class="my_setting_content mb30">
											<div class="my_setting_content_header">
												<div class="my_sch_title">
													<h4 class="m0">Edit ZoomId</h4>
												</div>
											</div>
											<form action="{{route('zoomId.update',$data->id)}}" method="post" enctype="multipart/form-data">
												@csrf
												@method('put')
												<div class="row my_setting_content_details pb0">
													<div class="col-xl-12">
														<div class="row">
															<div class="col-xl-6">
																<div class="my_profile_setting_input form-group">
															    	<label for="formGroupExampleInput1">Zoom email</label>
															    	<input type="email" class="form-control" name="email" placeholder="Zoom Email" value="{{$data->email}}">
																</div>
															
															</div>

															<div class="col-xl-6">
																<div class="my_profile_setting_input form-group">
															    	<label for="formGroupExampleInput1">Zoom App Id</label>
															    	<input type="text" class="form-control" name="app_id" placeholder="App Id" value="{{$data->app_id}}">
																</div>
															
															</div>

															<div class="col-xl-6">
																<div class="my_profile_setting_input form-group">
															    	<label for="formGroupExampleInput1">Zoom App Secret</label>
															    	<input type="text" class="form-control" name="secret" placeholder="App Secret" value="{{$data->secret}}">
																</div>
															
															</div>


														</div>

															
												<div class="row my_setting_content_details">
													
												    <div class="col-lg-12">
														<button type="submit" class="my_setting_savechange_btn btn btn-thm">Save </button>
												    </div>
												</div>
											</form>
										</div>
									</div>
								</div>
				
					</div>
					
				</div>
			</div>
		</div>
	</div>
	@endsection