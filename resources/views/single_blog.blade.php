@extends('layouts.app')
@section('og')
<!-- Site Name, Title, and Description to be displayed -->
  <meta name="description" content="{{$blog->meta_description}}">
  <meta name="keywords" content="{{$blog->meta_keword}}">
  <meta property="og:site_name" content="Yocolab">
<meta property="og:title" content="{{$blog->meta_title}}">
<meta property="og:keyword" content="{{$blog->meta_keword}}">
<meta property="og:description" content="{{$blog->meta_description}}">

<meta property="og:image" content="{{secure_asset('storage/blog/'.$blog->image)}}">
<meta property="og:image" itemprop="image" content="{{secure_asset('storage/blog/'.$blog->image)}}" />
<meta property="og:image:width" content="300">
<meta property="og:image:height" content="300">

@endsection
@section('content')
    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title">Blog Detail</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog-Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Blog Post Content -->
    <section class="blog_post_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-9">
                    <div class="main_blog_post_content">
                        <div class="mbp_thumb_post">
                            <div class="thumb">
                                <img class="img-fluid" src="{{asset('/storage/blog/'.$blog->image)}}" alt="12.jpg">
                                <div class="tag">{{$blog->category?$blog->category->name:''}}</div>
                                 @php $date=date_create($blog->created_at);  @endphp
                                 <div class="post_date"><h2>{{date_format($date,"d")}}</h2> <span>{{date_format($date,"M")}}</span></div>
                            </div>
                            <div class="details">
                                <h3>{{$blog->title}}</h3>
                                <ul class="post_meta">
                                    <li><a href="#"><span class="flaticon-profile"></span></a></li>
                                      <li><a href="#"><span>{{$blog->author?$blog->author:'Yocolab'}}</span></a></li>
                                   {{--  <li><a href="#"><span class="flaticon-comment"></span></a></li>
                                    <li><a href="#"><span>7 comments</span></a></li> --}}
                                </ul>
                               
                                <p>{!! $blog->description !!}.</p>
                            </div>
                            <ul class="blog_post_share">
                                <li><p>Share</p></li>
                                
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google"></i></a></li>
                            </ul>
                        </div>
                  
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3 pl10 pr10">
                    <div class="main_blog_post_widget_list">
                       {{--  <div class="blog_search_widget">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search Here" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"><span class="flaticon-magnifying-glass"></span></button>
                                </div>
                            </div>
                        </div> --}}
                        <div class="blog_category_widget">
                            <ul class="list-group">
                                 <h4 class="title">Category</h4>
                                @php $categories = categories() ; @endphp
                                @foreach($categories as $category)
                               <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{url('/blog/'.$category->slug.'/category')}}">{{$category->name}} </a><span class="float-right">{{blog_count($category->id)}}</span>
                                </li>
                                @endforeach
                                   <li class="list-group-item d-flex justify-content-between align-items-center">
                                   <a href="{{url('/blogs')}}"> All</a> <span class="float-right">{{count($tblogs)}}</span>
                                </li>
                            </ul>
                        </div>
                      {{--   <div class="blog_recent_post_widget media_widget">
                            <h4 class="title">Recent Posts</h4>
                            <div class="media">
                                <img class="align-self-start mr-3" src="images/blog/s1.jpg" alt="s1.jpg">
                                <div class="media-body">
                                    <h5 class="mt-0 post_title">Half of What We Know About Coffee</h5>
                                    <a href="#">October 25, 2019.</a>
                                </div>
                            </div>
                            <div class="media">
                                <img class="align-self-start mr-3" src="images/blog/s2.jpg" alt="s2.jpg">
                                <div class="media-body">
                                    <h5 class="mt-0 post_title">The Best Places to Start Your Travel</h5>
                                    <a href="#">October 25, 2019.</a>
                                </div>
                            </div>
                            <div class="media">
                                <img class="align-self-start mr-3" src="images/blog/s3.jpg" alt="s3.jpg">
                                <div class="media-body">
                                    <h5 class="mt-0 post_title">The Top 25 London</h5>
                                    <a href="#">October 25, 2019.</a>
                                </div>
                            </div>
                        </div>
                        <div class="blog_tag_widget">
                            <h4 class="title">Tags</h4>
                            <ul class="tag_list">
                                <li class="list-inline-item"><a href="#">Photoshop</a></li>
                                <li class="list-inline-item"><a href="#">Sketch</a></li>
                                <li class="list-inline-item"><a href="#">Beginner</a></li>
                                <li class="list-inline-item"><a href="#">UX/UI</a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection