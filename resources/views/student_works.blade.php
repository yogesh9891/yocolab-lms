@extends('layouts.app')

@section('content')
    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title">How it works</h4>
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
            <p class="wrk-nme">Three Simple Steps to join your favorite class</p>
        </div>

    <div class="col-12 mt-5">
            <div class="work d-flex justify-content-end flex-wrap mobile-s-work">
               <div class="work-cont">
                <div class="box">
                    <h4>Step 1 : Explore your class</h4>
                    <p>Browse through the categories and find the most suitable class as per your need. You can either look for a free class or a paid class from our talented instructors</p>
                </div>
                <div class="box">
                    <h4>Step 2 : ENROLL</h4>
                    <p>For free class, click on “Enroll” and you are done. For paid class, click on “Enroll” and key in your payment details.</p>
                </div>
                <div class="box">
                    <h4>Step 3 : JOIN</h4>
                    <p>“Join” the class at its scheduled start time. Happy Learning.</p>
                </div>
            </div> 

            <div class="work-img">
                <img src="{{asset('front_assets/images/how-student.jpg')}}" alt="">
            </div>
            </div>

    </div>
     

    </div>
</div>
</section>
@endsection