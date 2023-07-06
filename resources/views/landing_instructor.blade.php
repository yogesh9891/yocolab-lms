@extends('layouts.landing')
@section('content')

    <section class="banner" style="background-image: url('{{asset('images/landbg3.jpg')}}');">
        <div class="container-fluid">
            <div class="banner-logo">
                <a href="{{url('/')}}">
                <img src="src/images/yocolab-logo.png" alt="">
            </a>
            </div>
            <div class="row">
                <div class="banner-content">
                    <span>Talented Instructors, you're invited</span>
                    <h2>Be among the first to join as a Yocolab Instructor</h2>
                    <ul>
                        <li>
                            <i class="fas fa-home"></i>
                            <p>Start teaching in comfort of your location</p>
                        </li>
                        <li>
                            <i class="fas fa-search-dollar"></i>
                            <p>generate income</p>
                        </li>
                        <li>
                            <i class="fas fa-users-cog"></i>
                            <p>upskill students</p>
                        </li>
                    </ul>
                    <p>Let's build this community together</p>
                               @auth
                                @hasrole('teacher')
                                <a href="{{url('teacher/create-course')}}" class="btn yoco-btn btn-rht">become instructor</a>
                                @else
                                <a href="{{url('/teacher/teacher-register')}}" class="btn yoco-btn btn-rht">become instructor</a>
                                @endhasrole

                                @else
                                <a href="#!"  data-toggle="modal" data-target="#exampleModalCenter"class="btn yoco-btn btn-rht">become instructor</a>
                                @endauth
                    {{-- <a href="#" class="btn yoco-btn">become instructor</a> --}}
                </div>
            </div>
        </div>
    </section>

    <section class="classes">
        <div class="container">
            <h1 class="heading2">Host Classes in Minutes</h1>
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="class-inner">
                        <p class="num">1</p>
                        <h4>Prepare Class Material</h4>
                        <p class="class-text">For every great class, a presentation always matters. Be creative and prepare some amazing content to teach</p>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="class-inner">
                        <p class="num">2</p>
                        <h4>Create Class</h4>
                        <p class="class-text">Let your students know what will you be teaching. Schedule your class. It's as simple as it can get.</p>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="class-inner">
                        <p class="num">3</p>
                        <h4>Start Live Class</h4>
                        <p class="class-text">It's time to upskill your students, get interactive with live video classes, ensure your students are up to speed</p>
                    </div>
                </div>
            </div>
            <a href="{{url('/steps-to-create-class')}}" class="btn yoco-btn">How to create class</a>
        </div>
    </section>

    <section class="sec_3">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <img src="src/images/image-000.jpg" alt="">
                </div>
                <div class="col-12 col-lg-5">
                    <div class="sec_3_inner">
                        <p class="sec_3_text">&quot;Being able to host online classes and getting paid to my bank is a luxury&quot;</p>
                        <p class="fee">{{-- <i class="fas fa-chevron-left"></i> --}}Chess Basics<br>Class Fee: $10</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

{{--     <section class="sec_4">
        <div class="container">
            <div class="row">
                <div class="col-5 col-lg-8"></div>
                <div class="col-7 col-lg-4">
                    <h1 class="heading">Learn how to create a Class</h1>
                    <span>YOCOLAB</span>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="host_class">
        <div class="container">
            <h1 class="heading2">WE HAVE MADE IT EASY FOR YOU TO HOST A CLASS</h1>
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="host_class-inner host_1">
                        <h4><i class="fas fa-hand-point-right"></i>Decide class fee</h4>
                        <p class="class-text">It's entirely up to you to set the class fee. You are the boss, you decide.</p>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="host_class-inner host_2">
                        <h4><i class="fas fa-hand-point-right"></i>Get notified</h4>
                        <p class="class-text">Do not miss any of your classes. We will remind you before your class starts</p>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="host_class-inner host_3">
                        <h4><i class="fas fa-hand-point-right"></i>Get paid quickly</h4>
                        <p class="class-text">We want to comfort you. Your class fee will directly be credited to your bank account
                        </p>
                    </div>
                </div>
            </div>
             @auth
                                @hasrole('teacher')
                                <a href="{{url('teacher/create-course')}}" class="btn yoco-btn">BECOME INSTRUCTOR</a>
                                @else
                                <a href="{{url('/teacher/teacher-register')}}" class="btn yoco-btn">BECOME INSTRUCTOR</a>
                                @endhasrole

                                @else
                                <a href="#!"  data-toggle="modal" data-target="#exampleModalCenter"class="btn yoco-btn">BECOME INSTRUCTOR</a>
                                @endauth
            
        </div>
    </section>

    <section class="sec_6">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <div class="sec_6_inner">
                        <p class="sec_6_text">&quot;Hosting online french classes was super easy. I am enjoying this whole process&quot;</p>
                        <p class="fee">Chess Basics<br>Class Fee: $10{{-- <i class="fas fa-chevron-right"></i> --}}</p>
                    </div>
                </div>
                <div class="col-12 col-lg-7">
                    <img src="{{asset('images/landbg1.jpg')}}" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="sec_7">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <h2>About Yocolab</h2>
                    <img src="src/images/image-002.jpg" alt="">
                </div>
                <div class="col-12 col-lg-5">
                    <p>We believe, learning is a continuous process. Anyone, Anywhere, Anytime should have access to the learning platform. At Yocolab, our mission is to improve lives with real time learning experience. By connecting students and learning
                        enthusiasts with relevant instructors,Yocolab is helping individuals to upgrade, learn new skills and pursue their dreams. Our virtual training room adds the human touch which is an essential element for a holistic learning experience.</p>
                                @auth
                                <a href="#" class="btn yoco-btn">Register Now</a>
                               @else
                                <a href="#!"  data-toggle="modal" data-target="#exampleModalCenter"class="btn yoco-btn">Register Now</a>
                                @endauth
                    {{-- <a href="#" class="btn yoco-btn">Register Now</a> --}}
                </div>
            </div>
        </div>
    </section>

    <section class="sec_8">
        <div class="container">
            <h1 class="heading2">need help?</h1>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        How is money credited to my account?
                                    </button>
                                </h2>
                                <div class="plus-minus"></div>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    Once the class is successfully completed, the Instructor will receive a payment to the registered account in 7-10 working days.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        How much does it cost to register?
                                    </button>
                                </h2>
                                <div class="plus-minus"></div>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                   Registration on Yocolab is absolutely free.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                       Can the Instructor find students on their own?
                                    </button>
                                </h2>
                                <div class="plus-minus"></div>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    Yes, visit the Yocolab community section.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingfour">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="true" aria-controls="collapseOne">
                                        What is payment scheme?
                                    </button>
                                </h2>
                                <div class="plus-minus"></div>
                            </div>

                            <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordionExample">
                                <div class="card-body">
                                 Yocolab pays the instructor on a per class basis.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingfive">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapseTwo">
                                        Can I host a free trial class?
                                    </button>
                                </h2>
                                <div class="plus-minus"></div>
                            </div>
                            <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordionExample">
                                <div class="card-body">
                                   Yes, Instructor can always choose a free class and can use it as an introductory class.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingsix">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapseThree">
                                      Can you refund money back to the student?
                                    </button>
                                </h2>
                                <div class="plus-minus"></div>
                            </div>
                            <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordionExample">
                                <div class="card-body">
                                   Yes, money can be refunded to students. Do refer to Yocolab T&C for more details.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{url('/teacher/faqs')}}" class="btn yoco-btn">More FAQ</a>
        </div>
    </section>

    <section class="sec_9">
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="sec_9_inner">
                    <p class="sec_9_text heading2">ready to host classes?</p>
                           @auth
                                @hasrole('teacher')
                                <a href="{{url('teacher/create-course')}}" class="btn yoco-btn">BECOME INSTRUCTOR</a>
                                @else
                                <a href="{{url('/teacher/teacher-register')}}" class="btn yoco-btn">BECOME INSTRUCTOR</a>
                                @endhasrole

                                @else
                                <a href="#!"  data-toggle="modal" data-target="#exampleModalCenter"class="btn yoco-btn">BECOME INSTRUCTOR</a>
                                @endauth
                </div>
            </div>
            <div class="col-12 col-lg-7">
                <img src="{{asset('images/landbg2.jpg')}}" alt="">
            </div>
        </div>
    </section>

  @endsection 


