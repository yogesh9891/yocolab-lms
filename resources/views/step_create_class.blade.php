@extends('layouts.app')

@section('content')
    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title">Step Create To Class</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Step Create To Class</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section class="how-works-page">
    
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-12 mt-5">
            <div class="work d-flex justify-content-end flex-wrap mobile-create-1">
               <div class="work-cont">
                <div class="box">
                    <h4>STEP 1 : Choose class type</h4>
                    <p>Choose your class type whether free or paid, add your payment details for class payouts</p>
                </div>
                <div class="box">
                    <h4>STEP 2 : Fill in class details</h4>
                    <p>1. Class Title <br>
2. Choose your native language <br>
3. Select max students <br>
4. Select category & sub category <br>
5. Add tags for better search</p>
                </div>
                <div class="box">
                    <h4>STEP 3 : Add Class Description</h4>
                    <p>1. About your class <br> 
                        2. Class highlights and what to expect <br>
                    3. Pre-requisites for the class</p>
                </div>
            </div> 

            <div class="work-img">
                <img src="{{asset('front_assets/images/second-how.jpg')}}" alt="">
            </div>
            </div>

    </div>

    <div class="col-12 mt-5">
            <div class="work d-flex justify-content-start flex-wrap mobile-create-2">
                <div class="work-img">
                    <img src="{{asset('front_assets/images/third-how.jpg')}}" alt="">
                </div>
               <div class="work-cont2">
                <div class="box">
                    <h4>STEP 4 : Set class schedule</h4>
                   <p>1. Mention class fee & any applicable discounts<br>
2. Pick date, time and duration<br>
3. Add multiple time slots for your class<br>

                </div>
                <div class="box">
                    <h4>STEP 5 : Showcase your class</h4>
                    <p>1. Upload relevant study material <br>
2. Upload attractive cover image for class<br>
3. Upload or Add an introductory video to showcase your area of expertise <br>
</p>
                </div>
                
            </div> 

            
            </div>

    </div>

    
</div>
</div>
</section>

@endsection