@extends('layouts.backend')
@section('content')
<div class="our-dashbord dashbord">
		<div class="dashboard_main_content">
			<div class="container-fluid">
				<div class="main_content_container">
					<div class="row">
				
						<div class="col-lg-12">
							<nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
								<h4 class="title float-left">Category</h4>
									<a href="{{route('category.index')}}" class="btn btn-warning float-right"><i class="fas fa-arrow-left"> </i> Back</a>
							</nav>
						</div>

						<div class="col-lg-12">
									<div class="my_course_content_container">
										<div class="my_setting_content mb30">
											<div class="my_setting_content_header">
												<div class="my_sch_title">
													<h4 class="m0">Add Category</h4>
												</div>
											</div>
											<form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
												@csrf
												@method('post')
												<div class="row my_setting_content_details pb0">
													<div class="col-xl-12">
														<div class="row">
															<div class="col-xl-6">
																<div class="my_profile_setting_input form-group">
															    	<label for="formGroupExampleInput1">Name</label>
															    	<input type="text" class="form-control" name="name" placeholder="Category">
																</div>
															
															</div>
															

																<div class="col-xl-6">
																	<div class="my_profile_setting_input form-group">
															    	<label for="formGroupExampleInput2">Category</label>
															    		<select class="selectpicker form-control" name="parent_id">
																			
																			<option value="0">None</option>
																			 @foreach($categories as $cat )
																			  <option value="{{$cat->id}}" >{{$cat->name}}</option>
																			 @endforeach
																		</select>
																</div>
																
															</div>
															<div class="col-md-6">
																<div class=" form-group">
															    	<label for="formGroupExampleInput3">Category Image</label>
															    	<input type="file" class="form-control" name="image" >
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