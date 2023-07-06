@extends('layouts.app')
@section('title','Yocolab')
@section('content')

	<!-- Inner Page Breadcrumb -->
	<section class="inner_page_breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 offset-xl-3 text-center">
					<div class="breadcrumb_content">
						<h4 class="breadcrumb_title">Instructor </h4>
						<ol class="breadcrumb">
						    <li class="breadcrumb-item"><a href="#">Home</a></li>
						    <li class="breadcrumb-item active" aria-current="page">Instructor</li>
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
							<h3 class="text-center">Edit Instructor</h3>
							{{-- <p class="text-center">Have an account? <a class="text-thm" href="#!">Login</a></p> --}}
							  @if (Session::has('flash_message'))
                        <div class="container">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('flash_message') }}
                            </div>
                        </div>
                    @endif
						</div>
						<div class="details">
							<form @if($teacher) action="{{url('teacher/edit')}}" @else action="{{route('teacher-register')}}" @endif method="post" enctype="multipart/form-data" >
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
									<h5>Email</h5>
							    	<input type="text" class="form-control" id="your_experties"  value="{{Auth::user()->email}}" readonly="">
								</div>
								<div class="form-group">
									<h5>Name</h5>
							    	<input type="text" class="form-control" id="your_experties" name="name"  required="" value="{{Auth::user()->name}}">
								</div>
								<div class="form-group">
									<h5>Your Expertise</h5>
							    	<input type="text" class="form-control" id="your_experties" name="expert" placeholder="What is my Expertise (Yoga Trainer Etc.)" required="" @if($teacher) value="{{$teacher->expert}}" @endif>
								</div>
								<div class="form-group">
									<h5>Your Qualification</h5>
							    	<input type="text" class="form-control" id="your_Qqualification" name="qualification" placeholder="What is my Qualifications (Qualification/Certification)" required="" @if($teacher) value="{{$teacher->qualification}}" @endif>
								</div>
								<div class="form-group ">
									<h5>Select Your Class Category</h5>
							    	<div class="ui_kit_select_search">
										<select name="category_id" class="selectpicker mb-0" data-live-search="true" data-width="100%" required=""> 
										@foreach(categories() as $category)
													<option value="{{$category->id}}" @if($teacher->category_id == $category->id)  selected="" @endif>{{$category->name}}</option>
													@endforeach
										</select>
									</div>
								</div>
								<div class="form-group ">
									<h5>Select Your Class Currency</h5>
							    	<div class="ui_kit_select_search">
										<select name="currency" class="selectpicker mb-0" data-live-search="true" data-width="100%" required=""> 
										@foreach(currency()->getCurrencies() as $currency)
													<option value="{{$currency['code']}}" @if($teacher->currency == $currency['code'])  selected="" @endif>{{$currency['name']}}</option>
													@endforeach
										</select>
									</div>
								</div>	
								<div class="form-group ">
									@php $price = explode('-',$teacher->price)  @endphp
									<h5>Class Price Range</h5>
									<div class="d-flex">
							    	<input type="number" class="form-control mr-3 " id="your_Qqualification" name="price1" placeholder="10" required="" value="{{$price[0]}}" min="0" style="width: 65px"><span class="mr-3 mt-3">To</span> 
							    	<input type="number" class="form-control" id="your_Qqualification"  name="price2" value="{{$price[1]}}" placeholder="50" required="" style="width: 65px">
							   		 </div>
								</div>
								<div class="form-group">
									<h5>Your Experience In Years</h5>
									
							    	<div class="ui_kit_select_search">
										<select class="selectpicker mb-0" data-live-search="true" name="experience" data-width="100%" >
											<option value="1+ Year" @if($teacher->experience == '1+ Year') selected="" @endif>1+ Year</option>
			                    			<option value="2+ Years" @if($teacher->experience == '2+ Years') selected="" @endif>2+ Years</option>
			                    			<option value="3+ Years" @if($teacher->experience == '3+ Years') selected="" @endif>3+ Years</option>
			                    			<option value="4+ Years" @if($teacher->experience == '4+ Years') selected="" @endif>4+ Years</option>
			                    			<option value="5+ Years" @if($teacher->experience == '5+ Years') selected="" @endif>5+ Years</option>

			                    			<option value="6+ Years" @if($teacher->experience == '6+ Years') selected="" @endif>6+ Years</option>
			                    			<option value="7+ Years" @if($teacher->experience == '7+ Years') selected="" @endif>7+ Years</option>
			                    			<option value="8+ Years" @if($teacher->experience == '8+ Years') selected="" @endif>8+ Years</option>
			                    			<option value="9+ Years" @if($teacher->experience == '9+ Years') selected="" @endif>9+ Years</option>
			                    			<option value="10+ Years" @if($teacher->experience == '10+ Years') selected="" @endif>10+ Years</option>
			                    			<option value="11+ Years" @if($teacher->experience == '11+ Years') selected="" @endif>11+ Years</option>
			                    			<option value="12+ Years" @if($teacher->experience == '12+ Years') selected="" @endif>12+ Years</option>
			                    			<option value="13+ Years" @if($teacher->experience == '13+ Years') selected="" @endif>13+ Years</option>
			                    			<option value="14+ Years" @if($teacher->experience == '14+ Years') selected="" @endif>14+ Years</option>
			                    			<option value="15+ Years" @if($teacher->experience == '15+ Years') selected="" @endif>15+ Years</option>
			                    			<option value="16+ Years" @if($teacher->experience == '16+ Years') selected="" @endif>16+ Years</option>
			                    			<option value="17+ Years" @if($teacher->experience == '17+ Years') selected="" @endif>17+ Years</option>
			                    			<option value="18+ Years" @if($teacher->experience == '18+ Years') selected="" @endif>18+ Years</option>
			                    			<option value="19+ Years" @if($teacher->experience == '19+ Years') selected="" @endif>19+ Years</option>
			                    			<option value="20+ Years" @if($teacher->experience == '20+ Years') selected="" @endif>20+ Years</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<h5>Select Your Country</h5>
							    	<div class="ui_kit_select_search">
										<select class="selectpicker mb-0" data-live-search="true" data-width="100%" name="country" > 

										 
										 @foreach($country as $item)
										   <option value="{{$item->value}}" @if($teacher->country==$item->value) selected=""  @endif >{{$item->name}}</option>
										   @endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
									<h5>Language</h5>
							    	<div class="ui_kit_select_search">
										<select class="selectpicker mb-0" data-live-search="true" data-width="100%" required="" name="language">
											@foreach($language as $item)
										   <option value="{{$item->name}}"  @if($teacher->language==$item->name) selected=""  @endif>{{$item->name}}</option>
										   @endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
                        			<h5>About Me</h5>
                        			<textarea class="form-control" id="about" rows="5" cols="10" name="about"  placeholder="Something about yourself" required="">@if($teacher) {!! strip_tags($teacher->about) !!} @endif</textarea>
                        		</div>
                        		<div class="form-group">
                        			<img src="{{asset('storage/teacher/'.$teacher->image)}}" width="100px" height="100px">
                        		</div>
								<div class="form-group file-upload-block p-0">
                        			<h5>Upload Profile Pic</h5>
                        			<input type="file" accept=".jpg,.png" / name="image" >
                        		</div>
								
								<div class="button-wrapepr">
									<button type="submit" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-block">Update</button>
									<a href="{{url('teacher/profile')}}" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-block">Cancel</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
