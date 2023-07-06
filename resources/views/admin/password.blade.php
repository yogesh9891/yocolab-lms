@extends('layouts.backend')
@section('content')
<div class="our-dashbord dashbord">
		<div class="dashboard_main_content">
			<div class="container-fluid">
				<div class="main_content_container">
					<div class="row">
				
						<div class="col-lg-12">
							<nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
								<h4 class="title float-left">Password</h4>
					
							</nav>
						</div>

						<div class="col-lg-12">
									<div class="my_course_content_container">
										<div class="my_setting_content mb30">
											<div class="my_setting_content_header">
												<div class="my_sch_title">
													<h4 class="m0">Change Password</h4>
												</div>
											</div>
					
								<form action="{{url('admin/password')}}" method="post" enctype="multipart/form-data">
									 @if(Session::has('success'))
						                            	<div class="alert alert-success">
														    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
														    <div class="icon hidden-xs">
														      <i class="fa fa-check"></i>
														    </div>
														    <strong>Success</strong>
														    <Br /> {{Session::get('success')}}
														  </div>
                						    @endif

                						      @if(Session::has('error'))
						                            	 <div class="alert alert-danger">
															    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
															    <div class="icon hidden-xs">
															      <i class="fa fa-ban"></i>
															    </div>
															    <strong>Danger</strong>
															    <Br /> {{Session::get('error')}}
															  </div>
												@endif

																							@if ($errors->any())
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
												@csrf
												@method('post')
												<div class="row my_setting_content_details pb0">
													<div class="col-xl-12">
														<div class="row">
															<div class="col-xl-6">
																<div class="my_profile_setting_input form-group">
															    	<label for="formGroupExampleInput1">Old Password</label>
															    	<input type="password" class="form-control" name="old_password" placeholder="Old Password" required="">
																</div>
															
															</div>

															<div class="col-xl-6">
																<div class="my_profile_setting_input form-group">
															    	<label for="formGroupExampleInput1">New Password</label>
															    	<input type="password" class="form-control" name="new_pass" placeholder="New Password" required="">
																</div>
															
															</div>

															<div class="col-xl-6">
																<div class="my_profile_setting_input form-group">
															    	<label for="formGroupExampleInput1">Confirm password</label>
															    	<input type="password" class="form-control" name="confirm_pass" placeholder="Confirm password" required="">
																</div>
															
															</div>


														</div>

															
												<div class="row my_setting_content_details">
													
												    <div class="col-lg-12">
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