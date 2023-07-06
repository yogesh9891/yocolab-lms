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
								<h4 class="title float-left"> Faq</h4>
								<a href="{{route('faq.index')}}" class="btn btn-warning float-right"><i class="fas fa-arrow-left"> </i> Back</a>
							</nav>
						</div>

						<div class="col-lg-12">
									<div class="my_course_content_container">
										<div class="my_setting_content mb30">
											<div class="my_setting_content_header">
												<div class="my_sch_title">
													<h4 class="m0">Edit Faq</h4>
												</div>
											</div>

									
											<form action="{{route('faq.update',$data->id)}}" method="post" enctype="multipart/form-data">
												@csrf
												@method('put')
												<div class="row my_setting_content_details pb0">
													
															<div class="my_profile_setting_input form-group col-md-12">
															    	<label for="formGroupExampleInput2">Type</label>
															    		<select class="selectpicker form-control" name="type">
																			
																			<option value="0" @if($data->type==0) selected="" @endif >Student</option>
																			<option value="1"  @if($data->type==1) selected="" @endif>Instructor</option>
																		
																		</select>
																</div>
																
														
															
																<div class="my_profile_setting_input form-group col-md-12">
															    	<label for="formGroupExampleInput1">Question</label>
															    	<input type="text" class="form-control" name="question" placeholder="Question" value="{{$data->question}}">
																</div>
															
														
															
														
																<div class="my_profile_setting_input form-group col-md-12">
															    	<label for="formGroupExampleInput1">Answer</label>
															    	<textarea name="answer" class="form-control" placeholder="Answer">{{$data->answer}}</textarea>
																</div>
															
														


												
														
													    <div class="col-md-12 my_profile_setting_input form-group">
															<button type="submit" class="my_setting_savechange_btn btn btn-thm">Update </button>
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