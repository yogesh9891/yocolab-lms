@extends('layouts.app')
@section('title','Yocolab')
@section('content')

	<!-- Inner Page Breadcrumb -->
	<section class="inner_page_breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 offset-xl-3 text-center">
					<div class="breadcrumb_content">
						<h4 class="breadcrumb_title">Instructor Register</h4>
						<ol class="breadcrumb">
						    <li class="breadcrumb-item"><a href="#">Home</a></li>
						    <li class="breadcrumb-item active" aria-current="page">Instructor-Register</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Our LogIn Register -->
	<section class="our-log-reg bgc-fa">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-6 offset-lg-3">
					<div class="sign_up_form inner_page">
						<div class="heading">
							<h3 class="">Fill This Form To Become An Instructor</h3>
							{{-- <p class="text-center">Have an account? <a class="text-thm" href="#!">Login</a></p> --}}
						</div>
						<div class="details">
							<form action="{{route('teacher-register')}}" method="post" enctype="multipart/form-data" >
								@if ($errors->any())
									 <div class="alert alert-danger">
															    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
															    <div class="icon hidden-xs">
															      <i class="fa fa-ban"></i>
															    </div>
															    <strong>Error</strong>
															    <ul>
															      @foreach ($errors->all() as $error)
														                <li>{{ $error }}</li>
														            @endforeach
															   </ul>
															  </div>
								   
								@endif
							     @if(Session::has('success'))
						                            	<div class="alert alert-success">
														    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
														    <div class="icon hidden-xs">
														      <i class="fa fa-check"></i>
														    </div>
														    <strong>Congratulations!</strong>
														    <Br /> {{Session::get('success')}}
														  </div>
                				  @endif
								@csrf
								@method('post')
								<div class="form-group">
									<h5>Your Expertise</h5>
							    	<input type="text" class="form-control" id="your_experties" name="expert" placeholder="What is my Expertise (Yoga Trainer Etc.)" required="">
								</div>
								<div class="form-group">
									<h5>Your Qualification</h5>
							    	<input type="text" class="form-control" id="your_Qqualification" name="qualification" placeholder="What is my Qualifications (Qualification/Certification)" required="">
								</div>
								<div class="form-group ">
									<h5>Select Your Class Category</h5>
							    	<div class="ui_kit_select_search">
										<select name="category_id" class="selectpicker mb-0" data-live-search="true" data-width="100%" required=""> 
										@foreach(categories() as $category)
													<option value="{{$category->id}}" >{{$category->name}}</option>
													@endforeach
										</select>
									</div>
								</div>
								<div class="form-group ">
									<h5>Select Your Class Currency</h5>
							    	<div class="ui_kit_select_search">
										<select name="currency" class="selectpicker mb-0" data-live-search="true" data-width="100%" required=""> 
										@foreach(currency()->getCurrencies() as $currency)
													<option value="{{$currency['code']}}"  >{{$currency['name']}}</option>
													@endforeach
										</select>
									</div>
								</div>
								<div class="form-group ">
									<h5>Class Price Range</h5>
									<div class="d-flex">
							    	<input type="number" class="form-control mr-3 " id="your_Qqualification" name="price1" placeholder="10" required="" min="0" style="width: 65px"> <span class="mr-3 mt-3">To</span>
							    	<input type="number" class="form-control" id="your_Qqualification"  name="price2" placeholder="50" required="" style="width: 65px">
							   		 </div>
								</div>
								<div class="form-group">
									<h5>Your Experience In Years</h5>
									
							    	<div class="ui_kit_select_search">
										<select class="selectpicker mb-0" data-live-search="true" name="experience" data-width="100%" required="">
											<option selected value="1+ Years">1+ Years</option>
			                    			<option value="2+ Years">2+ Years</option>
			                    			<option value="3+ Years">3+ Years</option>
			                    			<option value="4+ Years">4+ Years</option>
			                    			<option value="5+ Years">5+ Years</option>
			                    			<option value="6+ Years">6+ Years</option>
			                    			<option value="7+ Years">7+ Years</option>
			                    			<option value="8+ Years">8+ Years</option>
			                    			<option value="9+ Years">9+ Years</option>
			                    			<option value="10+ Years">10+ Years</option>
			                    			<option value="11+ Years">11+ Years</option>
			                    			<option value="12+ Years">12+ Years</option>
			                    			<option value="13+ Years">13+ Years</option>
			                    			<option value="14+ Years">14+ Years</option>
			                    			<option value="15+ Years">15+ Years</option>
			                    			<option value="16+ Years">16+ Years</option>
			                    			<option value="17+ Years">17+ Years</option>
			                    			<option value="18+ Years">18+ Years</option>
			                    			<option value="19+ Years">19+ Years</option>
			                    			<option value="20+ Years">20+ Years</option>
										</select>
									</div>
								</div>
								<div class="form-group country-dropdown">
									<h5>Select Your Country</h5>
							    	<div class="ui_kit_select_search">
										<select name="country" class="selectpicker mb-0" data-live-search="true" data-width="100%" name="country" required=""> 
											@foreach($country as $item)
										   <option value="{{$item->value}}">{{$item->name}}</option>
										   @endforeach
										 
										</select>
									</div>
								</div>
								<div class="form-group">
									<h5>Language</h5>
							    	<div class="ui_kit_select_search">
										<select class="selectpicker mb-0" data-live-search="true" data-width="100%" required="" name="language">
												@foreach($language as $item)
										   <option value="{{$item->name}}">{{$item->name}}</option>
										   @endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
                        			<h5>About Me</h5>
                        		<textarea class="form-control" rows="5" name="about"   placeholder="Something about yourself" required=""></textarea> 

                        		</div>
								<div class="form-group file-upload-block p-0">
                        			<h5>Upload Profile Pic</h5>
                        			<input type="file" accept=".jpg,.png" / name="image" required="">
                        		</div>
								<div class="form-group custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="exampleCheck3" required="">
									<label class="custom-control-label" for="exampleCheck3">Accept </label> <span data-toggle="modal" data-target="#tnc_modal" class="tnc-txt-link">terms and conditions</span>
								</div>
								<div class="form-group custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="exampleCheck15" required="">
									<label class="custom-control-label" for="exampleCheck15">Accept </label> <span data-toggle="modal" data-target="#payment_modal" class="tnc-txt-link">Payment policy</span>
								</div>
								<button type="submit" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-block">Register</button>
							
							
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

