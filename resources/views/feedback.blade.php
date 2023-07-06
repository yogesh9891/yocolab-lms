@extends('layouts.app')
@section('title','Yocolab')
@section('content')


	<section class="inner_page_breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 offset-xl-3 text-center">
					<div class="breadcrumb_content">
						<h4 class="breadcrumb_title">Feedback Form</h4>
						<ol class="breadcrumb">
						    <li class="breadcrumb-item"><a href="#">Home</a></li>
						    <li class="breadcrumb-item active" aria-current="page">Feedback Form</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</section>

<section class="feedback-form-sec">
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-6" >
            <div class="feed-form">
                
            
            <h4 style="font-size:18px"> Did you get disconnected from your class and would like to join back? </h4>

            

            <a href="{{url('/class/'.$course->slug)}}" class="btn btn-primary-custom btn-primary-custom-border" >Return to Class</a>
         <form role="form" action="{{route('feedback')}}" method="post">
           
                       <h5><u>  {{$course->title}} By <strong>{{$course->user->name}}</strong></u></h5>
                      
                   
              
                
                    	@csrf
                    	@method('post')
                        <div class="row mt-4">

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
		                   
                            <div class="col-12">
                                <input type="hidden" name="teacher_id" value="{{$course->user->id}}">
                                <input type="hidden" name="course_id" value="{{$course->id}}">
                                <div class="form-group">
                                    <label>Do you want to leave a review for your instructor? 
</label>
                                    <!-- <div class="input-group">
                                        <input type="radio" name="star" class="form-control" value="1" required=""><i class="fa fa-star"></i>
                                        <input type="radio" name="star" class="form-control" value="2" required="">2
                                        <input type="radio" name="star"class="form-control" value="3" required="">3
                                        <input type="radio" name="star"class="form-control" value="4" required="">4
                                        <input type="radio" name="star"class="form-control" value="5" required="">5
                                    </div> -->
                                    <div class="stars">
                                    <input class="star star-5" id="star-5" type="radio" name="star"/ value="5">
                                      <label class="star star-5" for="star-5"></label>
                                      <input class="star star-4" id="star-4" type="radio" name="star"/ value="4">
                                      <label class="star star-4" for="star-4"></label>
                                      <input class="star star-3" id="star-3" type="radio" name="star"/ value="3">
                                      <label class="star star-3" for="star-3"></label>
                                      <input class="star star-2" id="star-2" type="radio" name="star"/value="2">
                                      <label class="star star-2" for="star-2"></label>
                                      <input class="star star-1" id="star-1" type="radio" name="star"/value="1">
                                      <label class="star star-1" for="star-1"></label>
                                  </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3">

                                <div class="form-group">
                                    <label>FeedBack</label>
                                    <div class="input-group">
                                        <textarea name="description" class="form-control" rows="5" required=""></textarea>
                                        
                                    </div>
                                </div>
                            </div>


                        </div>
                     
                         
                     
            
                
                
                    <div class="row">
                        <div class="col-12">
                            <!-- <input class="btn btn-warning btn-lg btn-block" type="submit" value="Submit"> -->
                            <input type="submit" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border sub-btn" value="Submit">
                        </div>
                    </div>
                <br>
       <h4 style="font-size:15px">Report inappropriate behaviour? <span><a href="Javacript:void(0)" data-toggle="modal" data-target="#report"> Click below.</a></span></h4>
            
        </form>
        </div>
    </div>
    </div>
</div>


</section>

<script>
    var logID = 'log',
  log = $('<div id="'+logID+'"></div>');
$('body').append(log);
  $('[type*="radio"]').change(function () {
    var me = $(this);
    log.html(me.attr('value'));
  });
</script>


@endsection

@section('afterScript')

<div class="modal fade" id="report" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{url('user/report')}}" method="post" enctype="multipart/form-data"> 
                                                            @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Report inappropriate behaviour</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                              <h4>{{$course->title}}</h4>
                                                                <input type="hidden" name="id" value="{{$course->id}}">
                                                              <textarea rows="5" class="form-control" name="description" required=""> </textarea>
                                                              <br>
                                                              <input type="file" name="image">
                                                            </div>
                                                            <div class="modal-footer">
                                                              
                                                                <button type="submit" class="btn btn-danger btn-ok btn-primary-custom-round">Submit</button>
                                                               
                                                            </div>
                                                        </div>
                                                    </form>
  </div>
</div>

@endsection