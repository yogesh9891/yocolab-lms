@extends('layouts.backend')
@section('content')
<div class="our-dashbord dashbord">
		<div class="dashboard_main_content">
			<div class="container-fluid">
				<div class="main_content_container">
					<div class="row">
				      @if ($errors->any())
	                                          <div class="alert alert-danger">
                               					 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                                               @foreach ($errors->all() as $error)
	                                                <strong>* {{$error}}</strong>
	                                                @endforeach
	                                            </div>
	                       @endif
						<div class="col-lg-12">
							<nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
								<h4 class="title float-left"> Edit Material</h4>
								<a href="{{route('material.index')}}" class="btn btn-warning float-right"><i class="fas fa-arrow-left"> </i> Back</a>
							</nav>
						</div>

						<div class="col-lg-12">
									<div class="my_course_content_container">
										<div class="my_setting_content mb30">
											<div class="my_setting_content_header">
												<div class="my_sch_title">
													<h4 class="m0">Edit Material</h4>
												</div>
											</div>

									
											<form action="{{route('material.update',$data->id)}}" method="post" enctype="multipart/form-data">
												@csrf
												@method('put')
												<div class="row my_setting_content_details pb0">
													<div class="col-xl-12">
														<div class="row">
															<div class="col-xl-6">
																<div class="my_profile_setting_input form-group">
															    	<label for="formGroupExampleInput1">Title</label>
															    	<input type="text" class="form-control" name="title" placeholder="Title" value="{{$data->title}}">
																</div>
															
															</div>
															

																
															</div>
															<div class="col-md-6">
																<div class=" form-group">
															    	<label for="formGroupExampleInput3">File</label>
															    	<input type="file" class="form-control" name="file" >
																</div>
																
															</div>
															 @if($data->file)
																<div class="col-md-6">
																<h4>
					                                            <a href="{{asset('storage/material/'.$data->file)}}" download>
					                                                  Download File
					                                                </a>
					                                            </h4>
					                                          															
															</div>
															  @endif	

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