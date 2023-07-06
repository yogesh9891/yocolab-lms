@extends('layouts.app')

@section('before_body')

<style>
    
    .abt-content ul{
        list-style: disc;
        margin: 0 20px;
    }

    .about-page .abt-content ul li p {
    color: #000000;
    font-size: 15px;
    font-weight: 400;
    letter-spacing: 0.5px;
    margin-bottom: 0px;
}

.abt-content ul:last-child{margin-bottom: 20px;}
</style>
@endsection

@section('content')
    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title">Become Instructor</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Become Instructor</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{-- 
<div class="container">
    <div class="row justify-content-center">
     <h1> Become Instructor</h1>

Grow your Instructor Business
Empower students to achieve their goals
Join Yocolab community today
Create a free profile
Secure more students
Yocolab gives you access to thousands of students who are looking to enhance their skills
Yocolab’s marketplace
Every month, millions of new students and parents come to Yocolab to learn.
Instructors listed on Yocolab have a great chance to earn from wherever they are
Instructors from any field, be it academics, workouts, languages & lot more, are all invited to come and host their classes

Get Paid
Yocolab offers fast, hassle-free payment

Hassle-free pay
Choose your own hourly rate.
Wyzant helps resolve billing issues and ensures you receive payment for your time.
Receive fast, easy payment from Yocolab directly to your bank account.
Chance to earn a handsome salary from wherever you are.




    </div>
</div> --}}



<section class="about-page">
    
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-7">
     <div class="abt-content">

<h2>Grow your Instructor Business </h2>
<ul>
    <li><p class="">Empower students to achieve their goals <br> Join Yocolab community today</p></li>
    <li><p class="">Create a free profile</p></li>
    <li><p class="">Secure more students</p></li>
</ul>

<p>Yocolab gives you access to thousands of students who are looking to enhance their skills</p>  
<h2>Vision </h2>
<p>Build online marketplace which connects instructors and students to facilitate exchange of knowledge & skills </p>

<h2>Yocolab’s marketplace</h2>
<ul>
    <li><p class="">Every month, millions of new students and parents come to Yocolab to learn.</p></li>
    <li><p class="">Instructors listed on Yocolab have a great chance to earn from wherever they are</p></li>
    <li><p class="">Instructors from any field, be it academics, workouts, languages & lot more, are all invited to come and host their classes</p></li>
    <li><p class="">Get Paid <br>Yocolab offers fast, hassle-free payment</p></li>
</ul>

<h2>Hassle-free pay</h2>
<ul>
    <li><p class="">Choose your own hourly rate.</p></li>
    <li><p class="">Wyzant helps resolve billing issues and ensures you receive payment for your time.</p></li>
    <li><p class="">Receive fast, easy payment from Yocolab directly to your bank account.</p></li>
    <li><p class="">Chance to earn a handsome salary from wherever you are.</p></li>
</ul>
    
    </div>


        </div>

        <div class="col-12 col-md-4">
            <div class="abt-img">
                
            <img src="{{asset('front_assets/images/insta.jpg')}}" alt="">
            </div>
        </div>

    </div>
</div>
</section>



@endsection