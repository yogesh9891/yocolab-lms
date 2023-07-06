<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="./src/css/landing_style.css">
    <link rel="stylesheet" href="./src/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/style.css')}}">
                <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/site.css')}}">
                        <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/custom.css')}}">
                    <style type="text/css">
                        ul.list-unstyled {
 
    color: #6f7074 !important;
   }

   .footer_social_widget .list-inline-item a {
    color: #969696 !important;
   }
   .copyright-widget p {
    color: #6f7074 !important;
   }
                    </style>
    <title>YOCOLAB</title>

		<script src='https://www.google.com/recaptcha/api.js'></script>
		<!--Start of Tawk.to Script-->
<script type="application/x-javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/60ebff2e649e0a0a5ccbbcf0/1factpk3j';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->



<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-K5BLQMS');</script>
<!-- End Google Tag Manager -->

		{{-- {!! NoCaptcha::renderJs() !!} --}}
		<!-- Title -->

		<title>Yocolab - Online Classes For Everything </title>
		<!-- Favicon -->
		<link href="{{asset('front_assets/images/favicon.ico')}}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
		<link href="{{asset('front_assets/images/favicon.ico')}}" sizes="128x128" rel="shortcut icon" />
		@yield('before_body')
			 @livewireStyles
	
	</head>
<body class="instructor-landing-page">
		<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K5BLQMS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
		<div ng-app="">
		</div>
		
			
			@yield('content')
		
			@include('layouts.footer')
		
		<a class="scrollToHome" href="#"><i class="flaticon-up-arrow-1"></i></a>

	    <!-- Modal -->
<div class="modal fade" id="cookieModal" tabindex="-1" role="dialog" aria-labelledby="cookieModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cookieModal"> Cookie Policy</h5>
     
      </div>
      <div class="modal-body">
        This website uses cookies to personalize content and analyse traffic in order to offer you a better experience.
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-primary" id="setCookie">OK</button>
      </div>
    </div>
  </div>
</div>
	<!-- Wrapper End -->
- 

    <!-- Scripts -->
    <script src="./src/js/jquery.js"></script>
    <script src="./src/js/jquery.min.js"></script>
    <script src="./src/js/popper.min.js"></script>
    <script src="./src/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/8aa71aba32.js " crossorigin="anonymous"></script>
    <script src="./src/js/script.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"  ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"  ></script>
	<script src="https://www.google.com/recaptcha/api.js?render=6Leh3IIaAAAAABC0BJZz1BoJfgLqHQSyz9nPM8MO" async ></script>

	<!-- Hotjar Tracking Code for www.yocolab.com -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:2500588,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>


	<script type="application/x-javascript">
    
		function CheckPassword(inputtxt)
	{
	var paswd =  /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9!@#$%^&*.]+){8,15}$/;
	if(inputtxt.match(paswd))
	{
	return true;
	}
	else
	{
	$('#registerError').text('Password should be 8-16 characters and one number should exists')
		$('#registerBtn').text('Register');
	return false;
	}
	}

		function CheckText(inputtxt)
	{
	var paswd =  /^[A-Za-z]+$/;
	if(inputtxt.match(paswd))
	{
	return true;
	}
	else
	{

	return false;
	}
	}

			
			function copyText() {
			/* Get the text field */
			var copyText = document.getElementById("myInput");
			var copy = document.getElementById("copied");
			copy.textContent = '';
			/* Select the text field */
			copyText.select();
			copyText.setSelectionRange(0, 99999); /* For mobile devices */
			/* Copy the text inside the text field */
			document.execCommand("copy");
			/* Alert the copied text */
			copy.textContent = 'Url copied';
			// alert("Copied the text: " + copyText.value);
	}
	function onClick(e) {
	e.preventDefault();
	grecaptcha.ready(function() {
	grecaptcha.execute('6Leh3IIaAAAAAFDD4oZNHycdgXgxMyZaOjONo2Do', {action: 'submit'}).then(function(token) {
	// Add your logic to submit to your backend server here.
	console.log(token);
	});
	});
	}
		$(document).ready(function () {

			
			
		 let url = '{{ request()->segment(1)}}';
				let toogle = $('#toggle_switch:checked').val();
			console.log(url);
			if(url !='teacher'){
					$('#teacher').removeClass('active');
					$('#student').addClass('active');
					$('#teacher-tab').removeClass('active');
					$('#student-tab').addClass('active');
			} else {
				
					$('#student').removeClass('active');
					$('#teacher').addClass('active');
					$('#student-tab').removeClass('active');
					$('#teacher-tab').addClass('active');
			}
			
			
			$('#registerBtn').click(function (e) {
				e.preventDefault();
				$('#registerBtn').text('Please Wait...');
						var form = $('#registerForm')[0]; // You need to use standard javascript object here
						var formData = new FormData(form);
						console.log(formData);
			
				let name = $('#registerName').val();
				let lname = $('#LastName').val();
				let email = $('#registerEmail').val();
				let phone = $('#registerPhone').val();
				let reg = /^\d{10}$/;
			
				let password = $('#registerPassword').val();
				let password2 = $('#registerPassword2').val();
				
				let timezone = moment.tz.guess();
				
				if(email !="" && password !="" && name!= ""){

					if(!CheckText(name)){ 
							$('#registerError').text('First name must be alphabet characters only or greater than 3 digits')
							$('#registerBtn').text('Register');
					}
					if(!CheckText(lname)){

							$('#registerError').text('Last Name must be alphabet characters only or greater than 3 digits')
							$('#registerBtn').text('Register');
					}



			if ($('#toi').is(':checked')) {

					if(password != password2){
						$('#registerError').text('Password does not match')
						$('#registerPassword').val('');
							$('#registerPassword2').val('');
								grecaptcha.reset();
							$('#registerBtn').text('Register');
										
			}  else
					{
									if(CheckPassword(password))
									{

													$.ajax({
														headers: {
															'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
															},
															url:"/register",
															method:'post',
															data:$('#registerForm').serialize(),
															success:function (response) {
																console.log(response)
																	//xlocation.reload();
																if(response.success ==false){
																	$('#registerError').text(response.message);
																	$('#registerBtn').text('Register');
																	$('#registerForm')[0].reset();
																	grecaptcha.reset();
																} else{
																	$('#exampleModalCenter').modal('hide');
																	
																	$('#registerForm')[0].reset();
																	$('#alertModal').modal('show');

																	//location.reload();
																}
															},
															error: function (request, status, error) {

															let res = JSON.parse(request.responseText);
																		if(  res.errors['g-recaptcha-response']){

																			res.errors['g-recaptcha-response'].forEach(function (item) {
																					$('#registerError').text(item)
																				$('#registerBtn').text('Register');
																					});
																		}

																		if(  res.errors['email']){
																			res.errors['email'].forEach(function (item) {
																						$('#registerError').text(item)
																					});
																					$('#registerForm')[0].reset();
																					grecaptcha.reset();
																				$('#registerBtn').text('Register');
																		}
														}
												})
								
								}
				}
		}  else {
								$('#registerError').text('Please check the terms and conditions box ')
										grecaptcha.reset();
							$('#registerBtn').text('Register');
							$('exampleModalCenter').animate({scrollTop:$('#myTabContent').position().top}, 'slow');
					

				}
			}  else {
					$('#registerError').text('Please fill all the fields ')
					grecaptcha.reset();
							$('#registerBtn').text('Register');
			}
			})
			$('#loginBtn').click(function (e) {
				e.preventDefault();
				$('#loginBtn').text('Please Wait...');
				$(this).attr('disabled',true);
				let email = $('#loginEmail').val();
				let password = $('#loginPassword').val();
				let timezone = moment.tz.guess();
				if(email !="" && password !="null"){
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						url:"/login",
						method:'post',
						data:{email:email,password:password,timezone:timezone},
						success:function (response) {
							if(response.success ==false){
								$('#loginError').text(response.message)
								$('#loginBtn').text('Login');
								$('#loginEmail').val('');
								 $('#loginPassword').val('');
								 	$('#loginBtn').attr('disabled',false);
					$(this).text('Login');
							} else if(response.success == 'notverified'){
								location.href="/email/verify";
							}
							else {
								let data = response.message;
								if(data.is_admin== 1 ){
									location.href = '/admin';
								}else{
										location.reload();
								}
							}
						}
				})
		} else {
					$('#loginError').text('Please fill all the fields ')
				$('#loginBtn').attr('disabled',false);
					$(this).text('Login');

		}
			})
		


	        

			
		})
	</script>
	<script type="application/x-javascript">
		$(document).ready(function () {



			$('#setCookie').click(function(){
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						url:"/cookie",
						method:'post',
						data:{},
						success:function (response) {
							$('#cookieModal').modal('hide');
						}
				})
				sessionStorage.setItem("timezone", moment.tz.guess());
			})

			let cookie = '{{request()->cookie('cookie')}}';
			console.log(cookie);
	
			if(!cookie){
				console.log('sdfd')
				
					$('#cookieModal').modal('show');	
			
			}
		
		});






    
 



	</script>



	
</body>
</html>