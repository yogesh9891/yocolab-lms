@extends('layouts.app')

@section('content')
    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title">Blogs</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blogs</li>
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
                        <div class="row">
                            @if($blogs)
                                @foreach($blogs as $blog)
                                <div class="col-sm-6 col-lg-6 col-xl-6">
                                    <div class="blog_grid_post mb30">
                                        <a href="{{url('blog/'.$blog->slug)}}">
                                        <div class="thumb">
                                            <img class="img-fluid" src="{{asset('storage/blog/'.$blog->image)}}" alt="bg1.jpg">
                                            <div class="tag">{{$blog->category?$blog->category->name:''}}</div>
                                            @php $date=date_create($blog->created_at);  @endphp
                                            <div class="post_date"><h2>{{date_format($date,"d")}}</h2> <span>{{date_format($date,"M")}}</span></div>
                                        </div>
                                    </a>
                                        <div class="details">
                                            <h3><a href="{{url('blog/'.$blog->slug)}}">{{$blog->title}}</a></h3>
                                            <ul class="post_meta">
                                                <li><a href="#"><span class="flaticon-profile"></span></a></li>
                                                <li><a href="#"><span>{{$blog->author?$blog->author:'Yocolab'}}</span></a></li>
                                                {{-- <li><a href="#"><span class="flaticon-comment"></span></a></li>
                                                <li><a href="#"><span>7 comments</span></a></li> --}}
                                            </ul>
                                            <p>{!! substr($blog->description, 0,150) !!}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                          
                            @else
                            <h3>No Blog Found</h3>
                            @endif
                        </div>
                   {{--      <div class="row">
                            <div class="col-lg-12">
                                <div class="mbp_pagination mt20">
                                    <ul class="page_navigation">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true"> <span class="flaticon-left-arrow"></span> Prev</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item active" aria-current="page">
                                            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                                        <li class="page-item"><a class="page-link" href="#">14</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next <span class="flaticon-right-arrow-1"></span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3 pl10 pr10">
                    <div class="main_blog_post_widget_list">
                        {!! $blogs->links() !!}
                        {{-- <diva class="blog_search_widget">
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
                                   <a href="{{url('/blogs')}}"> All</a> <span class="float-right">{{count($blogs)}}</span>
                                </li>
                                
                            </ul>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection