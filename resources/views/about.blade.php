@extends('layouts.app')

@section('content')
    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title">About Us</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">About Us</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section class="about-page">
    
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-7">
            
     {{-- <h1> About Us:</h1> --}}
     <div class="abt-content">
         
<p>We believe, learning is a continuous process. Anyone, Anytime, Anywhere should have access to the learning platform. At Yocolab, our mission is to improve lives with real time learning experience. We will achieve this by creating an Instructor-Student community. Our virtual training rooms add the human touch which is an essential element for a holistic learning experience. </p>
<br>

<h2>Vision </h2>
<p>Build online marketplace which connects instructors and students to facilitate exchange of knowledge & skills </p>
<br>
<h2>What is Yocolab</h2>
<p>A global marketplace for instructors to share knowledge without any geographical boundaries and helping students to upgrade, learn new skills and pursue their dreams.</p>
<br>
<h2>We bring value for:</h2>
<p><strong><u>Instructors</u></strong> by extending the reach beyond their personal network to conduct online sessions on an easy to use collaboration platform</p>

<p><strong><u>Learners</u></strong> by finding relevant sessions from a variety of instructors with option of group or one-to-one setup at their convenient schedule</p>
	
    </div>


        </div>

        <div class="col-12 col-md-4">
            <div class="abt-img">
                
            <img src="{{asset('front_assets/images/about-img.jpg')}}" alt="">
            </div>
        </div>

    </div>
</div>
</section>

@endsection