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
		

						$('.close_notification').on('click', function(){
					
					let count = $('#total_noti').text();
					count -= 1;
					if(count == 0){
						$('#total_noti').remove();
					} else {
						$('#total_noti').text(count)
					}
					let id =$(this).attr('id');
					$(this).parent().remove();

		          $.ajax({
		            type: 'get',
		            url: '/read-notification/'+id,
		            headers: {
		                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		             },
		          
		            success: function(data) {
		            
		            }
		          });
		        });

	        

			
		})







function makesvg(t,a=""){var e=Math.abs(t).toString(),r=t.toString(),n='<svg class="circle-chart" viewbox="0 0 33.83098862 33.83098862" xmlns="http://www.w3.org/2000/svg"><circle class="circle-chart__background" cx="16.9" cy="16.9" r="15.9" /><circle class="circle-chart__circle '+(t<0?"danger-stroke circle-chart__circle--negative":t>0&&t<=30?"warning-stroke":"success-stroke")+'"stroke-dasharray="'+e+',100"    cx="16.9" cy="16.9" r="15.9" /><g class="circle-chart__info">   <text class="circle-chart__percent" x="17.9" y="15.5">'+r+"%</text>";return a&&(n+='<text class="circle-chart__subline" x="16.91549431" y="22">'+a+"</text>"),n+=" </g></svg>"}function openNav(){document.getElementById("mySidenav").style.width="300px",document.getElementById("mySidenav").style.marginLeft="0px",document.getElementById("main").style.marginLeft="0",document.body.style.backgroundColor="rgba(250,250,250,0.4)"}function closeNav(){document.getElementById("mySidenav").style.width="0",document.getElementById("mySidenav").style.marginLeft="-30px",document.getElementById("main").style.marginLeft="0",document.body.style.backgroundColor="white"}!function(t){jQuery.fn.progressBar=function(a){var e=t.extend({},{height:"30",backgroundColor:"#E0E0E0",barColor:"#F97352",targetBarColor:"#CCC",percentage:!0,shadow:!1,border:!1,animation:!1,animateTarget:!1},a);return this.each(function(){var a=t(this);t.fn.replaceProgressBar(a,e)})},t.fn.replaceProgressBar=function(a,e){var r=a.text(),n=a.data("width"),s=a.data("target"),c=" ",o="",i="background-color:"+e.backgroundColor+";height:"+e.height+"px;";e.shadow&&(c+="shadow"),e.border&&(c+=" border"),e.animation&&(o=" animate");var l='<div class="sonny_progressbar'+o+'" data-width="'+n+'">';l+='<p class="title">'+r+"</p>",l+='<div class="bar-container'+c+'" style="'+i+'">',l+='<span class="backgroundBar"></span>',s&&(e.animateTarget?l+='<span class="targetBar loader" style="width:'+s+"%;background-color:"+e.targetBarColor+';"></span>':l+='<span class="targetBar" style="width:'+s+"%;background-color:"+e.targetBarColor+';"></span>'),e.animation?l+='<span class="bar" style="background-color:'+e.barColor+';"></span>':l+='<span class="bar" style="width:'+n+"%;background-color:"+e.barColor+';"></span>',e.percentage&&(l+='<span class="progress-percent" style="line-height:'+e.height+'px;">'+n+"%</span>"),l+="</div></div>",t(a).replaceWith(l)};t(window).scroll(function(){var a;t(".sonny_progressbar.animate").length<1||(a=t(window).height(),t(".sonny_progressbar.animate").each(function(){var e=t(this).offset().top;if(t(window).scrollTop()+a-60>e){var r=t(this).data("width")+"%";t(this).removeClass("animate"),t(this).find(".bar").css("opacity","0.1"),t(this).find(".bar").animate({width:r,opacity:1},3e3)}}))})}(jQuery),function(t){t.fn.circlechart=function(){return this.each(function(){var a=t(this).data("percentage"),e=t(this).text();t(this).html(makesvg(a,e))}),this}}(jQuery);


/* ----- Job List V3 Page On Click SIdebar ----- */
function openNav() {  
document.getElementById("mySidenav").style.width = "300px";
    document.getElementById("mySidenav").style.marginLeft = "0px";  
    document.getElementById("main").style.marginLeft = "0";  
    document.body.style.backgroundColor = "rgba(250,250,250,0.4)";
}
function closeNav() {  
document.getElementById("mySidenav").style.width = "0";
    document.getElementById("mySidenav").style.marginLeft= "-30px";
    document.getElementById("main").style.marginLeft= "0";
    document.body.style.backgroundColor = "white";
}


	function removeItemCart(id) {
		
				let course_id = id;
				

				swal({
						  title: "Are you sure ?",
						  icon: "warning",
						  buttons: true,
						  dangerMode: true,
						})
						.then((willDelete) => {
						  if (willDelete) {
										  	 $.ajax({
								type:'post',
				                url: "/remove_cart_item",
				                headers: {
				                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				                },
				                data:{id:course_id},
				                success: function (result) {
						         swal(" Your Item  has been deleted!", {
								      icon: "success",
						    });
				               		showHeaderCart();
				               		 shoCartTable();
				                }
				            });
						  
						  }
						});
				
		    
	}


		function showHeaderCart() {
		
		    $.ajax({

                url: "/show-header-cart",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
               		$('#total_cart').html('<span>'+result.total+'</span>');
               		$('#res_cart_header').html(result.html);
               	
                }
            });
	}


			function shoCartTable() {
		
		    $.ajax({

                url: "/show-cart-table",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
               		$('#cart_total').text(result.subtotal);
               		
               		$('#res_cart_table').html(result.html);
                }
            });
	}


	





function addToWishlist(e) {
	let course_id = $(e).attr('data-id');

		
		
		     $.ajax({

                url: "/add_to_cart/"+course_id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {

                if(result.res == true){
                	swal({
						  title: "Good job!",
						  text: "Your class is added to wishlist",
						  icon: "success",
						  button: "Ok!",
						});
               		showHeaderCart();
                } else {
                	swal("Ohh !!!", "Your class is removed from the wishlist!", "warning");
                
               		
                }
                }
            });



	}

