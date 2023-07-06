@extends('layouts.app')
@section('title','Yocolab')
@section('content')

	<!-- Inner Page Breadcrumb -->
	<section class="inner_page_breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 offset-xl-3 text-center">
					<div class="breadcrumb_content">
						<h4 class="breadcrumb_title">Profile</h4>
						<ol class="breadcrumb">
						    <li class="breadcrumb-item"><a href="#">Home</a></li>
						    <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
							
						</div>
						<div class="details">
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
                				   
							<form action="{{url('user/profile')}}" method="post" enctype="multipart/form-data" >
								@csrf
								@method('post')
								<div class="form-group">
									<h5>Email</h5>
							    	<input type="email" class="form-control" value="{{Auth::user()->email}}" required="" readonly="true" disabled="true">
								</div>
								<div class="form-group">
									@php  $name = explode(' ',Auth::user()->name);   @endphp
									<h5> First Name</h5>
							    	<input type="text" class="form-control" id="your_Qqualification" name="fname"  value="{{$name[0]}}" required="">
								</div>
									<div class="form-group">
									
									<h5> Last Name</h5>
							    	<input type="text" class="form-control" id="your_Qqualification" name="lname"  @if(count($name) > 1) value="{{$name[1]}}" @endif required="">
								</div>
								<div class="form-group">
									<h5>Phone</h5>
							    	<input type="text" class="form-control" value="{{Auth::user()->phone}}" name="phone" >
								</div>
							
								<button type="submit" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-block">Update</button>
							
							
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection