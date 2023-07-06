@extends('layouts.backend')
@section('content')
<div class="our-dashbord dashbord">
		<div class="dashboard_main_content">
			<div class="container-fluid">
				<div class="main_content_container">
					<div class="row">
				
						<div class="col-lg-12">
							<nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
								<h4 class="title float-left">Faq</h4>
									<a href="{{route('faq.index')}}" class="btn btn-warning float-right"><i class="fas fa-arrow-left"> </i> Back</a>
							</nav>
						</div>

						<div class="col-lg-12">
									<div class="my_course_content_container">
										<div class="my_setting_content mb30">
											<div class="my_setting_content_header">
												<div class="my_sch_title">
													<h4 class="m0">Add Faq</h4>
												</div>
											</div>
											<form action="{{route('faq.store')}}" method="post" enctype="multipart/form-data">
												@csrf
												@method('post')
												<div class="row my_setting_content_details pb0">
													
															<div class="my_profile_setting_input form-group col-md-12">
															    	<label for="formGroupExampleInput2">Type</label>
															    		<select class="selectpicker form-control" name="type">
																			
																			<option value="0">Student</option>
																			<option value="1">Instructor</option>
																		
																		</select>
																</div>
																
														
															
																<div class="my_profile_setting_input form-group col-md-12">
															    	<label for="formGroupExampleInput1">Question</label>
															    	<input type="text" class="form-control" name="question" placeholder="Question">
																</div>
															
														
															
														
																<div class="my_profile_setting_input form-group col-md-12">
															    	<label for="formGroupExampleInput1">Answer</label>
															    	<textarea name="answer" class="form-control" placeholder="Answer"></textarea>
																</div>
															
														


												
														
													    <div class="col-md-12 my_profile_setting_input form-group">
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