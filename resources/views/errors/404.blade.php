@extends('layouts.app')

@section('content')
    

<section class="about-page error_page">
    
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-12 align-items-center error_content text-center">
              <h1 class="text-center"> 404</h1> 
              <p>The Page you are looking for might have been removed, had its name changed, or is temporarily unavailabe.</p>
                <a href="{{url('/')}}" class="btn btn-secondary error_btn">Back</a>
                <div class="error_social_links mt-3">
                   <ul>
                          <li class="list-inline-item"><a href="https://www.facebook.com/yocolabsg" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="https://twitter.com/yocolabsg" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="https://www.instagram.com/yocolabsg/?hl=en" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="https://www.linkedin.com/company/yocolab" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            
                        </ul>
                </div>
        </div>
    </div>
</div>
</section>

@endsection