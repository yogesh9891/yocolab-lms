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
						    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						    <li class="breadcrumb-item active" aria-current="page">Password</li>
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
						<div class="heading text-center">
							<h3>Change Password</h3>
						</div>
						<div class="details">
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
							<form action="{{url('/password')}}" method="post" enctype="multipart/form-data" >
								@if ($errors->any())
    <div class="alert alert-danger">
    	  <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
															    <div class="icon hidden-xs">
															      <i class="fa fa-ban"></i>
															    </div>
															     <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
       
    </div>
@endif
								@csrf
								@method('POST')
								<div class="form-group">
									<h5>Email</h5>
							    	<input type="email" class="form-control" value="{{Auth::user()->email}}" required="" readonly="true" disabled="true">
								</div>
								<div class="form-group">
									<h5>Old Password</h5>
							    	<input type="password" class="form-control" required=""  name="old_password">
								</div>

								<div class="form-group">
									<h5>New Password</h5>
							    	<input type="password" class="form-control"  required="" name="new_pass" >
								</div>

								<div class="form-group">
									<h5>Confirm Password</h5>
							    	<input type="password" class="form-control"  required=""  name="confirm_pass">
								</div>

								
							
								<button type="submit" class="btn btn-primary-custom ">Update</button>
							
							
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection