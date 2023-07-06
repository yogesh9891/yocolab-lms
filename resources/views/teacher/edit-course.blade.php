@extends('layouts.app')
@section('title','Yocolab')
@section('content')
@section('before_body')

<link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/bootstrap-tagsinput.css')}}">



    <style type="text/css">
        .bootstrap-tagsinput{
            width: 100%;
        }
        .label-info{
            background-color: #fd6003;
            padding: 10px!important;

        }
        .label {
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,
            border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
    </style>
@endsection
<style type="text/css">
	.inner_page_breadcrumb{height: auto;padding: 60px 0 27px 0;}
	.inner_page_breadcrumb>.container{display: none;}
</style>
	<!-- Inner Page Breadcrumb -->
	<section class="inner_page_breadcrumb">
		<div class="container">
			<div class="row" id="formTop">
				<div class="col-xl-6 offset-xl-3 text-center">
					<div class="breadcrumb_content">
						<h4 class="breadcrumb_title">Edit Course</h4>
						<ol class="breadcrumb">
						    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
						    <li class="breadcrumb-item active" aria-current="page">Edit Course</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Shop Checkouts Content -->
	<section class="create-course-wrapper">
		<!-- MultiStep Form -->
		<div class="container-fluid" id="grad1">
		    <div class="row justify-content-center mt-0">
		        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
		            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
		                <div class="form-header-block">
			                <a href="{{ url()->previous() }}" class="back-link"><i class="fa fa-times"></i></a>
			                <h2><strong>Create Course</strong></h2>
			                @if(Session::has('success'))
			                	<div class="alert alert-success">
			                		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                		<strong>{{ Session::get('success') }}</strong>
	                            </div>
	                        @endif
			                <p>Fill all form field to go to next step</p>
		                </div>
		                <div class="row">
		                    <div class="col-md-12 mx-0">
		                        <form id="msform" action="{{route('editCourse',$course->id)}}" enctype="multipart/form-data"    method="post">
		                        @csrf
		                        @method('post')
		                            <!-- progressbar -->
		                            <ul id="progressbar">
		                                <li class="active" id="account"><strong>Step 1</strong></li>
		                                <li id="personal"><strong>Step 2</strong></li>
		                                <li id="payment"><strong>Step 3</strong></li>
		                                <li id="payment"><strong>Step 4</strong></li>
		                                <li id="confirm"><strong>Step 5</strong></li>
		                            </ul> <!-- fieldsets -->
		                            <fieldset>
		                            	<div class="form-card">
		                            		<label>Please Choose Class Type <font color="red">(Not Editable)</font></label>
		                            			<br><font color="red" id="paid"> </font>
		                            		<div class="radio-wrapper mb-3 bdr-b" >

			                            		<div class="radio mr-5">

													<input id="radio_one" name="paid" type="radio" class="form-control" value="free"  @if($course->price ==null) checked=""  @endif disabled="true">
													<label for="radio_one"><span class="radio-label"></span><p class="class_type_title"> Free Class</p></label>
												</div>
												<div class="radio mr-5">
													<input id="radio_two" name="paid" type="radio" class="form-control" value="paid"  @if($course->price != null) checked="" @endif disabled="true">
													<label for="radio_two"><span class="radio-label"></span> Paid Course</label>
												</div>
											</div>
											<input id="radio_live" name="type" type="radio" class="form-control" value="Live" checked="" style="display:none">
											{{-- <label>Please Choose Class Type</label>
											<br><font color="red" id="type"> </font>
		                            		<div class="radio-wrapper">
			                            		<div class="radio mr-5">
													<input id="radio_live" name="type" type="radio" class="form-control" value="Live"  @if($course->type == 'Live') checked="" @endif disabled="true">
													<label for="radio_live"><span class="radio-label"></span> Live Class</label>
												</div>
												<div class="radio mr-5">
													<input id="radio_recorded" name="type" type="radio" class="form-control" value="Recorded" @if($course->type == 'Recorded') checked="" @endif disabled="true">
													<label for="radio_recorded"><span class="radio-label"></span> Recorded Class</label>
												</div>
											</div> --}}
		                            	</div>
		                            	<input type="button" name="next" class=" btn btn-primary-custom btn-primary-custom-round" value="Next" style="width: auto;color: #fff;padding: 15px 35px;" id="step1"/>
		                            </fieldset>
		                            <fieldset>
		                            	<div class="form-card">
		                            		<div class="form-group">
		                            			<label>Title</label>
		                            				<br><font color="red" id="title_error"> </font>
		                            			<input type="text" class="form-control h50" id="course-title" name="title" placeholder="e.g. Yoga Class" @if($course->title)  value="{{$course->title}}" @endif>
		                            		</div>
		                            		<div class="ui_kit_select_search">
		                            			<label>Class Level </label>

		                            			<br><font color="red" id="level_error"> </font>
												<select class="selectpicker" data-live-search="true" data-width="100%" name="level" id="level">
													{{-- <option value="{{$course->level}}" selected="">{{$course->level}}</option> --}}
					                    			<option value="Beginners">Beginners</option>
					                    			<option value="intermediate">Intermediate</option>
					                    			<option value="Advance">Advance</option>
												</select>
											</div>
											<div class="ui_kit_select_search mt-4">
												<label>In What language will you teach?</label>
												<br><font color="red" id="language_error"> </font>
												<select class="selectpicker" data-live-search="true" data-width="100%" name="language" id="language">
													{{-- <option value="{{$course->language}}" selected="">{{$course->language}}</option> --}}
					                    			<	@foreach($language as $item)
										   <option value="{{$item->name}}">{{$item->name}}</option>
										   @endforeach>
												</select>
											</div>
											<div class="form-group mt-4" id="no_students" id="students">
		                            			<label>Maximum Students</label>
		                            			<br><font color="red" id="students_error"> </font>
		                            			<input type="number" class="form-control h50" id="number_of_students" name="students" placeholder="e.g. 30" @if($course->students)  value="{{$course->students}}" @endif min="1">
		                            		</div>
											<div class="ui_kit_select_search mt-4">
													<label>Class  Category</label>												<br><font color="red" id="cat_error"> </font>
												<select class="selectpicker" data-live-search="true" data-width="100%" name="cat_id" id="cat_id">
													@foreach($category as $item)
													<option value="{{$item->id}}" >{{$item->name}}</option>
													@endforeach
												</select>
											</div>
											<div class="ui_kit_select_search mt-4">
												<label>Class Subject</label>
												<br><font color="red" id="sub_error"> </font>
												<select class="selectpicker" data-live-search="true" data-width="100%" name="sub_id
												" id="sub_id">
												@if($subcategory)
													@foreach($subcategory as $item)
													<option value="{{$item->id}}" >{{$item->name}}</option>
													@endforeach
												@else
													<option  value="0">None</option>
												@endif
					                    			
												</select>
											</div>
											<div class="form-group mt-4 tag-holder">
		                            				<label>Tags (Maximum 6 tags)</label>
		                            			<br><font color="red" id="tag_error"> </font>
		                            		<input type="text" value="" data-role="tagsinput"  name="tags"  class="tags"  placeholder="Maximum 6 tags" value="dfgfd" />
		                            		</div>
		                            	</div>
		                            	<input type="button" name="previous" class="previous btn btn-primary-custom btn-primary-custom-round" value="Previous" style="width: auto;color: #fff;padding: 15px 35px;" />
		                            	<input type="button" name="next" class=" btn btn-primary-custom btn-primary-custom-round" value="Next" style="width: auto;color: #fff;padding: 15px 35px;" id="step2" />
		                            </fieldset>
		                            <fieldset>
		                                <div class="form-card">
		                                    <div class="form-group">
		                            		<label>Class Description</label>
		                            				<br><font color="red" id="des_error"> </font>
		                            			<textarea class="form-control" id="course_description" name="decription">{{strip_tags($course->desciption)}}</textarea>
		                            		</div>
		                            		<div class="form-group">
		                            			<label>What you'll learn</label>
		                            				<br><font color="red" id="learn_error"> </font>
		                            			<div class="btn-txt-group-wrapper" id="resLearn">
		                            				@php $l = explode(';',$course->learn)  ;
		                            				 @endphp 
		                            				@foreach($l as $learn)
		                            			
			                            			<div class="btn-txt-group learn_div" >
			                            				<input type="text" class="form-control h50" id="learn" placeholder="e.g. Become a UX designer" name="learn[]" value="{{$learn}}">
			                            				<a href="javascript:void(0)" class="btn-lnk" onclick="addLearn(this)"><i class="fa fa-plus"></i></a>
			                            			</div>
			                            			@endforeach
			                            			
		                            			</div>
		                            		</div>
		                            		<div class="form-group">
		                            			<label>Requirements</label>
		                            			<font color="red" id="req_error"> </font>
		                            			<div class="btn-txt-group-wrapper req_div" id="resReq">
		                            				@php $r = explode(';',$course->requirement) ;  @endphp 
		                            					@foreach($l as $req)

			                            			<div class="btn-txt-group">
			                            				<input type="text" class="form-control h50" id="requirements" name="requirement[]" placeholder="e.g. You will need a copy of..." value="{{$req}}">
			                            				<a href="javascript:void(0)" class="btn-lnk" onclick="addReq(this)"><i class="fa fa-plus"></i></a>
			                            			</div>
			                            			@endforeach
			                            			
		                            			</div>
		                            		</div>
		                                </div>
		                                <button type="button" n class="previous btn btn-primary-custom btn-primary-custom-round"  style="width: auto;color: #fff;padding: 15px 35px;" />Previous</button>
										<button type="button"  class=" btn btn-primary-custom btn-primary-custom-round" value="Next" style="width: auto;color: #fff;padding: 15px 35px;"  id="step3" />Next</button>
		                            </fieldset>
		                            <fieldset>
		                                <div class="form-card" id="resPrice" >
		                                	<font color="red">*Not Editable</font>
		                                	<div  id="hidePrice">
		                            	
		                            		</div>
		                            		@if($course->price ==null )

		                            			@if($course->type=='Live')
		                            				<div id="timeDiv">
		                            				<div class="duration-time-repeater-wrapper" id="resHtml">
						                            		<div class="duration-time-repeater mb-4">
						                            			<div class="duration-time-holder">
							                            			<h5>Pick Date</h5>
							                            			<input type="text" class="form-control" value="{{$course->date}}" readonly="" disabled="true">
						                            			</div>
						                            			<div class="duration-time-holder">
							                            			<h5>Pick Time</h5>
							                            			<input type="time"    value="{{$course->time}}"  readonly=""  disabled="true" />
						                            			</div>
						                            			
						                            		</div>
						                            		
					                            		</div>

					                            		
					                            	</div>
		                            			@else
		                            			<div class="form-group"><h5>Duration</h5><br><font color="red" id="title_error"> </font><input type="text"  class=" form-control" readonly="" disabled="true" placeholder="e.g. 45" value="{{$course->duration}}" readonly="" disabled="true"></div>
		                            			@endif
		                            		@else

		                            			<div  id="hidePrice" class="row">
		                                		<div class="col-md-4 form-group mt-4">
		                            			<label>Select Currency</label>
		                                		
		                                		<input type="text" name="currency" value="{{strtoupper($course->currency)}}" readonly="true"  class="form-control h50" >
		                            	{{-- 	<div class="ui_kit_select_search">
												<select class="selectpicker" data-live-search="true" data-width="100%" name="currency" id="currency">

													@foreach(currency()->getCurrencies() as $currency)
													<option value="{{$currency['code']}}"  @if(my_timezone()['currency']) selected=""  @endif>{{$currency['name']}}</option>
													@endforeach
													<option value="EUR">Euro</option>
													<option value="GBP">United Kingdom Pounds</option>
													<option value="DZD">Algeria Dinars</option>
													<option value="ARP">Argentina Pesos</option>
													<option value="AUD">Australia Dollars</option>
													<option value="ATS">Austria Schillings</option>
													<option value="BSD">Bahamas Dollars</option>
													<option value="BBD">Barbados Dollars</option>
													<option value="BEF">Belgium Francs</option>
													<option value="BMD">Bermuda Dollars</option>
													<option value="BRR">Brazil Real</option>
													<option value="BGL">Bulgaria Lev</option>
													<option value="CAD">Canada Dollars</option>
											ss		<option value="CLP">Chile Pesos</option>
													<option value="CNY">China Yuan Renmimbi</option>
													<option value="CYP">Cyprus Pounds</option>
													<option value="CSK">Czech Republic Koruna</option>
													<option value="DKK">Denmark Kroner</option>
													<option value="NLG">Dutch Guilders</option>
													<option value="XCD">Eastern Caribbean Dollars</option>
													<option value="EGP">Egypt Pounds</option>
													<option value="FJD">Fiji Dollars</option>
													<option value="FIM">Finland Markka</option>
													<option value="FRF">France Francs</option>
													<option value="DEM">Germany Deutsche Marks</option>
													<option value="XAU">Gold Ounces</option>
													<option value="GRD">Greece Drachmas</option>
													<option value="HKD">Hong Kong Dollars</option>
													<option value="HUF">Hungary Forint</option>
													<option value="ISK">Iceland Krona</option>
													<option value="INR">India Rupees</option>
													<option value="IDR">Indonesia Rupiah</option>
													<option value="IEP">Ireland Punt</option>
													<option value="ILS">Israel New Shekels</option>
													<option value="ITL">Italy Lira</option>
													<option value="JMD">Jamaica Dollars</option>
													<option value="JPY">Japan Yen</option>
													<option value="JOD">Jordan Dinar</option>
													<option value="KRW">Korea (South) Won</option>
													<option value="LBP">Lebanon Pounds</option>
													<option value="LUF">Luxembourg Francs</option>
													<option value="MYR">Malaysia Ringgit</option>
													<option value="MXP">Mexico Pesos</option>
													<option value="NLG">Netherlands Guilders</option>
													<option value="NZD">New Zealand Dollars</option>
													<option value="NOK">Norway Kroner</option>
													<option value="PKR">Pakistan Rupees</option>
													<option value="XPD">Palladium Ounces</option>
													<option value="PHP">Philippines Pesos</option>
													<option value="XPT">Platinum Ounces</option>
													<option value="PLZ">Poland Zloty</option>
													<option value="PTE">Portugal Escudo</option>
													<option value="ROL">Romania Leu</option>
													<option value="RUR">Russia Rubles</option>
													<option value="SAR">Saudi Arabia Riyal</option>
													<option value="XAG">Silver Ounces</option>
													<option value="SGD">Singapore Dollars</option>
													<option value="SKK">Slovakia Koruna</option>
													<option value="ZAR">South Africa Rand</option>
													<option value="KRW">South Korea Won</option>
													<option value="ESP">Spain Pesetas</option>
													<option value="XDR">Special Drawing Right (IMF)</option>
													<option value="SDD">Sudan Dinar</option>
													<option value="SEK">Sweden Krona</option>
													<option value="CHF">Switzerland Francs</option>
													<option value="TWD">Taiwan Dollars</option>
													<option value="THB">Thailand Baht</option>
													<option value="TTD">Trinidad and Tobago Dollars</option>
													<option value="TRL">Turkey Lira</option>
													<option value="VEB">Venezuela Bolivar</option>
													<option value="ZMK">Zambia Kwacha</option>
													<option value="EUR">Euro</option>
													<option value="XCD">Eastern Caribbean Dollars</option>
													<option value="XDR">Special Drawing Right (IMF)</option>
													<option value="XAG">Silver Ounces</option>
													<option value="XAU">Gold Ounces</option>
													<option value="XPD">Palladium Ounces</option>
													<option value="XPT">Platinum Ounces</option>
												</select>
											</div> --}}
											</div>
		                                    <div class="form-group col-md-4 mt-4">
		                            			<label>Class  Fee</label>
		                            			<font color="red" id="price_error"> </font>
		                            			<input type="number" class="form-control h50" id="price" name="price" placeholder="$0" value="{{$course->price}}" readonly="">
		                            		</div>
		                                    <div class="form-group mt-4 percentage-icon col-md-4">
		                            			<label>Discount</label>
		                            			<input type="number" class="form-control h50" id="discount" name="discount" placeholder="e.g. 35" value="{{$course->discount}}" readonly="">
		                            		</div>
		                                		
		                                		{{-- <font class="text-warning">Minimum amount {{round($min_price)}} to create course</font> --}}
		                            		</div>

		                            		@endif

		                            	
		                            	
		                          

		                                </div>
		                                <button type="button"  class="previous btn btn-primary-custom btn-primary-custom-round" value="Previous" style="width: auto;color: #fff;padding: 15px 35px;" />Previous</button>
										<button type="button"  class="next btn btn-primary-custom btn-primary-custom-round" value="Next" style="width: auto;color: #fff;padding: 15px 35px;" id="step4" />Next</button>
		                            </fieldset>
		                            <fieldset>
		                            	<div class="form-card">
		                            	
	                            			<div class="form-row">
	                            				<div class="form-group col-md-12 file-upload-block">
			                            			<label>Have any study material to share with students? </label> <br>
											        {{-- <input type="file" accept=".jpg,.jpeg.,.gif,.png, .doc, .pdf" /> --}}
											       <button type="button" class="btn btn-primary-custom btn-primary-custom-round" data-toggle="modal" data-target="#exampleModal" style="background: none;color: #fd6100;padding: 12px 20px;">
											        	Upload
											        </button>
			                            		</div>
			                            		<br>
			                            		<div class="form-group col-md-10">
				                            		<div class="shortcode_widget_multiselect">
				                            			<label>Study Material</label>
				                            			<div class="ui_kit_multi_select_box">
				                            				@php $m = explode(';',$course->material_id);  @endphp
				                            				<select class="selectpicker" multiple name="material[]" id="material" >
				                            					@foreach($material as $item)
				                            					<option value="{{$item->id}}" @if(in_array($item->id,$m))   selected="" @endif  >{{$item->title}}</option>
				                            					@endforeach
				                            				</select>
				                            			</div>
				                            		</div>
			                            		</div>
			                            		<br>
			                            		
		                            		</div>
		                            		<div class="form-row mt-3 ">
			                            		<div class="form-group col-md-10 file-upload-block">
			                            			@if($course->image)
			                            			<img src="{{asset('storage/course/'.$course->image)}}" width="200" height="100">
			                            			<br>
			                            			<br>
			                            			@endif
			                            			<label>Upload Class Image</label>
											        <input type="file" accept=".jpg,.jpeg.,.gif,.png,.mov,.mp4"  name="image"  />
			                            		</div>
		                            		</div>
		                            		<div class="form-row mt-3">
		                            			<div class="col-md-12">
		                            				<label >Add an introductory video of yours</label>
		                            				<p style="color: #000;font-size: 13px;">This is your chance to showcase your style of teaching, the topic of your class and any relevant information about your class which you will like students to see in the class description. You can either upload your video on Youtube and add a link here for students to see or upload your video directly on Yocolab.</p>
		                            				<br>
	                            				</div>
	                            			</div>
		                            		<div class="form-row mt-3 align-items-center">
			                            		<div class="form-group col-md-5 file-upload-block">
			                            			<label>Add Youtube URL</label>
											        <input type="text" class="form-control h50" id="video_url" name="video_url" placeholder="Add Video URL" name="preview_url" size="10">
			                            		</div>
			                            		<div class="form-group col-md-2 text-center mb-0 mt-3">
			                            			<label></label>
			                            			<span style="font-size: 20px;">OR</span>
			                            		</div>
			                            		<div class="form-group col-md-5 file-upload-block">
			                            			<label>Upload Preview Course Video</label>
			                            				@if($course->video)
			                            			<video width="200" height="100" controls>
												  <source src="{{asset('storage/video/'.$course->video)}}" type="video/mp4">
												 
												  Your browser does not support the video tag.
												</video>
			                            			@endif
											        <input type="file" accept=".mov,.mp4" / name="preview_video" placeholder="Upload Video"> 
			                            		</div>
		                            		</div>
		                            		<div class="form-row " id="video">
			                            		<div class="form-group col-md-12 file-upload-block">
			                            			<label>Upload video on Yocolab</label>
											        <input type="file" accept=".mov,.mp4"  name="video"  />
			                            		</div>
		                            		</div>
		                            	</div>
	                            			
		                            	
		                            	<input type="button" name="previous" class="previous btn btn-primary-custom btn-primary-custom-round" value="Previous" style="width: auto;color: #fff;padding: 15px 35px;" />
										<input type="submit" name="next" class="btn btn-primary-custom btn-primary-custom-round" value="Submit" style="width: auto;color: #fff;padding: 15px 35px;" id="step5"/>
		                            </fieldset>
		                        </form>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	<!-- /.MultiStep Form -->
	</section>
@endsection

@section('afterScript')
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Study Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form id="data" method="post" enctype="multipart/form-data">
      	<div class="form-group">
      	<label> Title</label>
      	<input type="text" name="title" class="form-control" id="material-title" />
      </div>
      <div class="form-group">
      	<label>File</label>
      	<input type="file" accept=".jpg,.jpeg.,.gif,.png, .doc, .pdf" name="file"  id="material-file" />
      </div>
      <div class="form-group">
      	<button class="btn btn-primary btn-sm" id="upload"> Upload</button>
      </div>
      </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="{{asset('front_assets/js/bootstrap-tagsinput.js')}}"></script>
    <script type="text/javascript">
    	function remove(e) {
		$(e).parent().remove();
	}

	function addLearn() {
	$('#resLearn').append('<div class="btn-txt-group learn_div"><input type="text" class="form-control h50" id="learn" name="learn[]" placeholder="e.g. Become a UX designer"><a href="javascript:void(0)" onclick="addLearn(this)"  class="btn-lnk"><i class="fa fa-plus"></i></a><a href="javascript:void(0)" onclick="remove(this)" class="btn-lnk delete"><i class="fa fa-minus"></i></a></div>');

 $('#resLearn ').animate({
        scrollTop: $('#resLearn .learn_div:last-child').position().top
    }, 'slow');
}

function addReq() {
	$('#resReq').append('<div class="btn-txt-group req_div"><input type="text" class="form-control h50" id="learn" name="requirement[]" placeholder="e.g. Become a UX designer"><a href="javascript:void(0)" onclick="addReq(this)"  class="btn-lnk"><i class="fa fa-plus"></i></a><a href="javascript:void(0)" onclick="remove(this)" class="btn-lnk delete"><i class="fa fa-minus"></i></a></div>');
	$('#resReq ').animate({
        scrollTop: $('#resReq .req_div:last-child').position().top
    }, 'slow');
}

function scrollElementToTop(){
   $(window).scrollTop($('#formTop').offset().top);
}
    </script>
<script type="text/javascript">

		var current_fs, next_fs, previous_fs; //fieldsets
	var opacity;

	let paid,type,titlem,level,language,students,tags,c_id,s_id,description,learn,requirement;

	$(document).ready(function(){

		$('#cat_id').on('change', function(e){
			let id  = $('#cat_id option:selected').val();
			console.log(id);
			 var $select1 = $('#sub_id');
				

			let html = '';

	 $.ajax({
	 	 headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
           method: "POST",
           url: '/subcategory',
           data: {id:id}, // serializes the form's elements.
           success: function(response)
           {

           
           	      	 $select1.html('');
    // cada array del parametro tiene un elemento index(concepto) y un elemento value(el  valor de concepto)
      if(response.length > 0){
    $.each(response, function(index, value) {
    	
      // darle un option con los valores asignados a la variable select
      $select1.append('<option value="' + value.id + '">' + value.name + '</option>');
    });
} else {
      $select1.append('<option value="0">None</option>');

}
              $('#sub_id').selectpicker('refresh');
            

           }
         });



	  //   $('#level').val('{{$course->level}}');
	  // $('#level').selectpicker('refresh');
});


	
		$('#addBtn').click(function (argument) {
			$('#resHtml').append('<div class="duration-time-repeater mb-4"><div class="duration-time-holder"><h5>Pick Date</h5><input type="text" data-toggle="datepicker" name="date[]" class="datepicker newdate"></div><div class="duration-time-holder"><h5>Pick Time</h5><input type="time" class="timepicker"  name="time[]" /></div><div class="duration-time-holder"><h5>Course Duration</h5>	<select class="form-control"  name="duration[]" ><option value="0.5" selected="">00:30</option><option value="1">01:00</option>option value="1.5">01:30</option><option value="2">02:00</option><option value="2.5">02:30</option><option value="3">03:00</option><option value="3.5">03:30</option><option value="4">04:00</option></select></div></div>');
			$('.newdate').datepicker({format: 'dd/mm/yy' , });
		})

		$('#removeLast').click(function () {
			$('#resHtml').find('.duration-time-repeater').last().remove();
		})

	$("#step1").click(function(e){
		e.preventDefault();

	current_fs = $(this).parent();
	
	next_fs = $(this).parent().next();
	previous_fs = $(this).parent().prev();
	paid = $(this).parent().find('input[name="paid"]:checked').val();
	type = $(this).parent().find('input[name="type"]:checked').val();


$('#level').selectpicker('val', '{{$course->level}}');
$('#cat_id').selectpicker('val', '{{$course->category_id}}');
$('#sub_id').selectpicker('val', '{{$course->category->id}}');
$('#cat_id').selectpicker('refresh');
$('#sub_id').selectpicker('refresh');


	if(type == 'Recorded'){
	
$('#no_students').hide();
$('#video').hide();
}
else {
	$('#no_students').show();
	$('#video').hide();
		
}



if(paid == 'free'){
		console.log(type)
		console.log(paid)
$('#hidePrice').hide();

	
		if(type == 'Recorded'){
	
				$('#timeDiv').hide()
					$('#durationText').html('<div class="form-group"><h5>Duration</h5><br><font color="red" id="title_error"> </font><select class="form-control" data-live-search="true" data-width="100%" name="duration[]" ><option value="0.5" selected="">00:30</option><option value="1">01:00</option>option value="1.5">01:30</option><option value="2">02:00</option><option value="2.5">02:30</option><option value="3">03:00</option><option value="3.5">03:30</option><option value="4">04:00</option></select></div>')
				
			}
			else {
				$('#durationText').html('')
				$('#timeDiv').show()
			}

}
else {
console.log(type)
console.log(paid)
$('#hidePrice').show();
		if(type == 'Recorded'){
	
				$('#durationDiv').hide()
				$('#timeDiv').hide()
						$('#durationText').html('<div class="form-group"><h5>Duration</h5><br><font color="red" id="title_error"> </font><select class="form-control" data-live-search="true" data-width="100%" name="duration[]" ><option value="0.5" selected="">00:30</option><option value="1">01:00</option>option value="1.5">01:30</option><option value="2">02:00</option><option value="2.5">02:30</option><option value="3">03:00</option><option value="3.5">03:30</option><option value="4">04:00</option></select></div>')
				

			}
			else {
				
				$('#timeDiv').show()
				$('#durationText').html('')
					
			}

	
	

}



	if(!paid){

		$('#paid').text('pleae fil course type');
		setTimeout(function(){$('#paid').text('') }, 3000);

	} else if(!type){

		$('#type').text('pleae fil course type');
		setTimeout(function(){$('#type').text('') }, 3000);
	}
	 else{
	 	// $('input[name="paid"]').prop('checked', true);
	 	// $('input[name="type"]').prop('checked', true);

	 		//Add Class Active
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

	//show the next fieldset
	next_fs.show();
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
	step: function(now) {
	// for making fielset appear animation
	opacity = 1 - now;

	current_fs.css({
	'display': 'none',
	'position': 'relative'
	});
	next_fs.css({'opacity': opacity});
	},
	duration: 600
	});

	}


	
scrollElementToTop();
$('#language').selectpicker('val', '{{$course->language}}');



	});



		$("#step2").click(function(){

	current_fs = $(this).parent();
	
	next_fs = $(this).parent().next();
	previous_fs = $(this).parent().prev();

title = $(this).parent().find('input[name="title"]').val();
students = $(this).parent().find('input[name="students"]').val();
level = $('#level').val();
language =$('#language').val();
c_id = $('#cat_id').val();
s_id = $('#sub_id').val();
tags = $('.tags').val();

if(!title){

		$('#title_error').text('pleae fil title ');
		setTimeout(function(){$('#title_error').text('') }, 5000);

	}  if(!level){

		$('#level_error').text('pleae select level');
		setTimeout(function(){$('#level_error').text('') }, 5000);
	}
	 if(!language){

		$('#language_error').text('pleae select language');
		setTimeout(function(){$('#language_error').text('') }, 5000);
	}

	 if(!c_id){

		$('#cat_error').text('pleae select category');
		setTimeout(function(){$('#cat_error').text('') }, 5000);
	}
	 if(!s_id){

		$('#sub_error').text('pleae select subcategory ');
		setTimeout(function(){$('#sub_error').text('') }, 5000);
	}
	 if(!tags){

		$('#tag_error').text('pleae fill  tags');
		setTimeout(function(){$('#tag_error').text('') }, 5000);
	} 

	if(!students){

		$('#students_error').text('pleae fll student');
		setTimeout(function(){$('#students_error').text('') }, 5000);
	}

	if(title && level &&language && c_id && s_id && tags){
		

			//Add Class Active
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

	//show the next fieldset
	next_fs.show();
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
	step: function(now) {
	// for making fielset appear animation
	opacity = 1 - now;

	current_fs.css({
	'display': 'none',
	'position': 'relative'
	});
	next_fs.css({'opacity': opacity});
	},
	duration: 600
	});

	} 


scrollElementToTop();

	});


$("#step3").click(function(){

	current_fs = $(this).parent();
	
	next_fs = $(this).parent().next();

description = $(this).parent().find('textarea[name="decription"]').val();
learn = $(this).parent().find('input[name="learn[]"]').map(function(){return $(this).val();}).get();
requirement = $(this).parent().find('input[name="requirement[]"]').map(function(){return $(this).val();}).get();

console.log(learn['1'])
console.log(learn)
console.log(requirement.length)
if(!description){

		$('#des_error').text('pleae fil description ');
		setTimeout(function(){$('#des_error').text('') }, 5000);

	}  if(learn['1'] == "" ){

		$('#learn_error').text('pleae fill learn');
		setTimeout(function(){$('#learn_error').text('') }, 5000);
	}

if(requirement[1] == "" ){

		$('#req_error').text('pleae fill requirement');
		setTimeout(function(){$('#req_error').text('') }, 5000);
	}



	if(!description){

		console.log(description,learn,requirement)

	}
	else {
			// //Add Class Active
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

	//show the next fieldset
	next_fs.show();
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
	step: function(now) {
	// for making fielset appear animation
	opacity = 1 - now;

	current_fs.css({
	'display': 'none',
	'position': 'relative'
	});
	next_fs.css({'opacity': opacity});
	},
	duration: 600
	});
	}
scrollElementToTop();

	});


$("#step4").click(function(){

	current_fs = $(this).parent();
	
	next_fs = $(this).parent().next();

currency = $('#currency').val();
price = $(this).parent().find('textarea[name="price"]').val();
discount = $(this).parent().find('textarea[name="discount"]').val();
date = $(this).parent().find('input[name="date[]"]').map(function(){return $(this).val();}).get();
time = $(this).parent().find('input[name="time[]"]').map(function(){return $(this).val();}).get();
duration = $(this).parent().find('input[name="duration[]"]').map(function(){return $(this).val();}).get();




			// //Add Class Active
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

	//show the next fieldset
	next_fs.show();
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
	step: function(now) {
	// for making fielset appear animation
	opacity = 1 - now;

	current_fs.css({
	'display': 'none',
	'position': 'relative'
	});
	next_fs.css({'opacity': opacity});
	},
	duration: 600
	});
	


	});

	$(".previous").click(function(){

	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();

	//Remove class active
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

	//show the previous fieldset
	previous_fs.show();

	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
	step: function(now) {
	// for making fielset appear animation
	opacity = 1 - now;

	current_fs.css({
	'display': 'none',
	'position': 'relative'
	});
	previous_fs.css({'opacity': opacity});
	},
	duration: 600
	});
	scrollElementToTop();
	});

	$('.radio-group .radio').click(function(){
	$(this).parent().find('.radio').removeClass('selected');
	$(this).addClass('selected');
	});

	$(".submit").click(function(){
	return false;
	})

	

	});
</script>
<script type="text/javascript">
	$('.timepicker').wickedpicker();
	$('[data-toggle="datepicker"]').datepicker({
	  autoPick:true
	});


	$('.tags').tagsinput({
		  maxTags: 6,
});
@php $d = explode(';', $course->tags);  @endphp
@foreach($d as $tag)
	$('.tags').tagsinput('add', '{{$tag}}');
@endforeach


	$("form#data").submit(function(e) {
		e.preventDefault();
		$('#upload').attr('disabled','disabled');
		    var formData = new FormData($(this)[0]);
		     var $select = $('#material');
		   $.ajax({
	 	 headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
           type: "POST",
           url: '/material',
           data: formData, // serializes the form's elements.
           success: function(response)
           {

           	 $select.html('');
    // cada array del parametro tiene un elemento index(concepto) y un elemento value(el  valor de concepto)
    $.each(response, function(index, value) {
      // darle un option con los valores asignados a la variable select
      $select.append('<option id="' + value.id + '">' + value.title + '</option>');
    });
    $('#material').selectpicker('refresh');
    $('#data').trigger("reset");
        	


        	$('#exampleModal').modal('hide');

           },
             cache: false,
        contentType: false,
        processData: false
         });
	})
	
</script>


@endsection