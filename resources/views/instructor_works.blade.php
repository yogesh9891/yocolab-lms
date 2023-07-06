@extends('layouts.app')

@section('content')
    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title"> How it works</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">How it works</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>


<section class="how-works-page">
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <p class="wrk-nme">Three Simple Steps to create, schedule & start your class</p>
        </div>
        <div class="col-12 mt-5">
            <div class="work d-flex justify-content-end flex-wrap mobile-t-work">
               <div class="work-cont">
                <div class="box">
                    <h4>Step 1 : Become an Instructor</h4>
                    <p>Create your instructor profile and get ready to impart your knowledge</p>
                </div>
                <div class="box">
                    <h4>Step 2 : Create a class</h4>
                    <p>Create the class on your subject in 5 easy steps. <br>
Host unlimited free class up to 30 min! <br>
Host unlimited paid class with no time limits!</p>
                </div>
                <div class="box">
                    <h4> Step 3 : Start Live Class</h4>
                    <p>Start interacting with your students on our live interactive tool at your scheduled start time</p>
                </div>
            </div> 

            <div class="work-img">
                <img src="{{asset('front_assets/images/how.jpg')}}" alt="">
            </div>
            </div>

    </div>

    
</div>
</div>
</section>

@endsection