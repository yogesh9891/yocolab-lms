@extends('layouts.app')

@section('content')

    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title">Login</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Login</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div class="container">
    <div class="row justify-content-center my-5">
    	<div class="col-md-6">
										<a href="{{ url('auth/facebook') }}" class="btn btn-block color-white bgc-fb"><i class="fa fa-facebook float-left mt10"></i> Facebook</a>

<fb:login-button 
  scope="public_profile,email"
  onlogin="checkLoginState();">
</fb:login-button>
		</div>
    	</div>
    </div>

@endsection

@section('afterScript')


<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '837946990402685',
      cookie     : true,
      xfbml      : true,
      version    : 'v11.0'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

function getFbUserData(){
    FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
    function (response) {
    console.log(response)
    });
}


function checkLoginState() {
  FB.getLoginStatus(function(response) {
    console.log(response)
    getFbUserData();
    // statusChangeCallback(response);
  });
}
</script>

@endsection