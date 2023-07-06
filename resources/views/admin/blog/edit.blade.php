@extends('layouts.backend')
@section('content')
<div class="our-dashbord dashbord">
		<div class="dashboard_main_content">
			<div class="container-fluid">
				<div class="main_content_container">
					<div class="row">
				
						<div class="col-lg-12">
							<nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
								<h4 class="title float-left">Blog</h4>
									<a href="{{route('blog.index')}}" class="btn btn-warning float-right"><i class="fas fa-arrow-left"> </i> Back</a>
							</nav>
						</div>

						<div class="col-lg-12">
									<div class="my_course_content_container">
										<div class="my_setting_content mb30">
											<div class="my_setting_content_header">
												<div class="my_sch_title">
													<h4 class="m0">Add Blog</h4>
												</div>
											</div>
											<form action="{{route('blog.update',$data->id)}}" method="post" enctype="multipart/form-data">
												@csrf
												@method('put')
												<div class="row my_setting_content_details pb0">
													<div class="col-xl-12">
														<div class="row">
															<div class="col-xl-6">
																<div class="my_profile_setting_input form-group">
															    	<label for="formGroupExampleInput1">Title</label>
															    	<input type="text" class="form-control" name="title" placeholder="Blog title" value="{{$data->title}}">
																</div>
															
															</div>
															

																<div class="col-xl-6">
																	<div class="my_profile_setting_input form-group">
															    	<label for="formGroupExampleInput2">Category</label>
															    		<select class="selectpicker form-control" name="category_id">
																			
																	
																			 @foreach($categories as $cat )
																			  <option value="{{$cat->id}}" @if($data->category_id==$cat->id) selected="" @endif >{{$cat->name}}</option>
																			 @endforeach
																		</select>
																</div>
																
															</div>
															<div class="col-xl-6">
																<div class="my_profile_setting_input form-group">
															    	<label for="formGroupExampleInput1">Author</label>
															    	<input type="text" class="form-control" name="author" placeholder="Blog" value="{{$data->author}}">
																</div>
															
															</div>
															<div class="col-md-6">
																<div class=" form-group">
															    	<label for="formGroupExampleInput3">Blog Image</label>
															    	<input type="file" class="form-control" name="image" >
																</div>
																@if($data->image)
																<img src="{{asset('storage/blog/'.$data->image)}}" width="100" width="100">
																@endif
															</div>

																<div class="col-md-12">
																<div class=" form-group">
															    	<label for="formGroupExampleInput3">Blog Description</label>
															    	
															    	<textarea class="form-control" name="description" id="editor1">{!! $data->description !!}</textarea>
																</div>
																
															</div>

																<div class="col-md-12">
																<div class="my_profile_setting_input form-group">
															    	<label for="formGroupExampleInput1">Meta title</label>
															    	<input type="text" class="form-control" name="meta_title" placeholder="Blog" value="{{$data->meta_title}}">
																</div>
															
															</div>

														</div>
															<div class="col-md-12">
																<div class="my_profile_setting_input form-group">
															    	<label for="formGroupExampleInput1">Meta Keyword</label>
															    	<input type="text" class="form-control" name="meta_keword" placeholder="Blog" value="{{$data->meta_keword}}">
																</div>
															
															</div>

																<div class="col-md-12">
																<div class=" form-group">
															    	<label for="formGroupExampleInput3">Meta Description</label>
															    	
															    	<textarea class="form-control" name="meta_description" >{{$data->meta_description}}</textarea>
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
	@section('afterScript')

	 <script>
                        CKEDITOR.replace( 'editor1' );
                </script>
	@endsection