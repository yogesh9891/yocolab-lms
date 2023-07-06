<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Cart;
use App\Models\User;
use App\Models\StudentCourse;
use App\Models\VideoClass;
use App\Models\SaveCards;
use App\Models\Charge;

use App\Notifications\StudentNotification;
use App\Notifications\SendNotification;
use App\Notifications\BecomeTeacher;

use App\Jobs\TestJob;
use App\Jobs\TestMail;
use App\Jobs\TeacherPayment;
use App\Jobs\UpcompingCourse;
use App\Jobs\TeacherAttendClass;

use App\Mail\SendEmailTest;
use Razorpay\Api\Api;

use Slim\Http\Response;
use Carbon\Carbon;
use Stripe\Stripe;
use Notification;
use Mail;
use Auth;

class CartController extends Controller
{
		 

		   public function add_to_cart($id)
		   {
		   	
		   		$course = Course::find($id);
		   		if($course){

		   			$cart = session()->get('cart');


		   			   if(!$cart) {

					            $cart = [
					                    $id => [
					                    	'id'=>$id,
					                        "title" => $course->title,
					                      	"image" => $course->image,
					                      	"type" => $course->type,
					                      	"price" => $course->price,
					                      	"discount" => $course->discount,
					                      	"date" => $course->date,
					                      	"time" => $course->time,
					                      	"image" => $course->image,
					                      	"currency" => $course->currency,
					                       
					                    ]
					            ];

					          session()->put('cart', $cart);
					        
					         	 if(Auth::user()){
					         	 	$user_cart = Cart::where('course_id',$id)->where('user_id',Auth::id())->first();
					         	 	
					         	 	if(!$user_cart){									    
										  
					         	 		$user_cart = new Cart;
					         	 		$user_cart->user_id = Auth::user()->id;
					         	 		$user_cart->course_id = $id;
					         	 		$user_cart->save();
					         	 	return response()->json(['res'=>true]);
									} else {
										return response()->json(['res'=>false]);
									}


					         }
					           
					        }

					         if(isset($cart[$id])) {   
					         	
					         	 if(Auth::user()){
					         	 	$user_cart = Cart::where('course_id',$id)->where('user_id',Auth::id())->first();
					         	 
					         	 	if(!$user_cart)	{

					         	 	$user_cart = new Cart;
					         	 		$user_cart->user_id = Auth::user()->id;
					         	 		$user_cart->course_id = $id;
					         	 		$user_cart->save();							    
					         		return response()->json(['res'=>true]);
										  
					         	 	
									} else {

					         		return response()->json(['res'=>false]);
									}
					         }
					     }
					         	else {

					         		 $cart[$id] = [		'id'=>$id,
											           "title" => $course->title,
								                      	"image" => $course->image,
								                      	"type" => $course->type,
								                      	"price" => $course->price,
								                      	"discount" => $course->discount,
								                      	"date" => $course->date,
								                      	"time" => $course->time,
								                      	"image" => $course->image,
								                      	"currency" => $course->currency,
											        ];

										 session()->put('cart', $cart);
										 
					         	 if(Auth::user()){
					         	 	$user_cart = Cart::where('course_id',$id)->where('user_id',Auth::id())->first();
					         	 	if(!$user_cart)	{
					         	 		$user_cart = new Cart;
					         	 		$user_cart->user_id = Auth::user()->id;
					         	 		$user_cart->course_id = $id;
					         	 		$user_cart->save();
					         	 			return response()->json(['res'=>true]);
					         	 	} else {
					         	 		return response()->json(['res'=>false]);
					         	 	}								    
										  
					         	 		
									}


					         	}

		   		

				
		   }
}


 public function remove_cart_item(Request $request)
    {

    $id = $request->id;
        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {

					         	 if(Auth::user()){
					         	 	$user_cart = Cart::where('course_id',$id)->where('user_id',Auth::user()->id)->first();
					         	 	if($user_cart)									    
										  
					         	 		
					         	 		$user_cart->destroy($user_cart->id);
									}
                unset($cart[$id]);
                session()->put('cart', $cart);
            }

            if($request->ajax()){
            	return response()->json(true);
            } else {
            	return redirect()->back()->with('success','Your Item is removed form wishlist');
            }
        }
    }

		   public function cartPage($slug)
		   {

		   	 $course = Course::where('slug',$slug)->where('status',1)->first();
		   	 if(!$course){
		   	 	abort(404);
		   	 }
		   	  session()->put('cid', $course->id);
		   	  	$teacher = teacherDetail($course->user_id);

		   	  $curr = currency_convert($course);
		   	 $subtotal = 0;
		   	if($course->price_type=='paid'){

		   			if($teacher->country != 'IN'){

				     	return view('cart',compact('course'));

				     } else {
				     	$customer_cards  = '';
				     	return view('india_checkout',compact('course','customer_cards'));
				     }

		     	// return view('cart',compact('course'));
		   	 
		   	 } 

		   	 else{

		   	 		$course_exists = StudentCourse::where('user_id',Auth::user()->id)->where('course_id',$course->id)->where('status','done')->first();
					if(!$course_exists){



					$data = new StudentCourse;
					$data->user_id = Auth::user()->id;
					$data->teacher_id =$course->user_id;
					$data->course_id=$course->id;
					$data->name = $course->title;
					$data->type =$course->type ;
					$data->des = $course->desciption;
					$data->status = 'done';
					$data->progress = 0;
					$data->save();
					$video = VideoClass::where('course_id',$course->id)->first();
					if($video->student_id){

						$s = explode(';', $video->student_id);
						array_push($s, Auth::user()->id);
						$s = implode(';', $s);
					} else {
						$arrayName = array(0 =>Auth::user()->id );
						$s = implode(';', $arrayName);
					}

						$video->student_id = $s;
					$video->save();
										$user = Auth::user();
         $teacher = User::find($course->user_id);
						   $detail = [
								            'n_title' => 'Hi Yocolab',
								            'title' => 'Enrolled Class',
								            'message' => ' You have enrolled for '.$course->title,
								            'actionURL' =>  url('class/'.$course->slug),
								        ];;
  
      Notification::send($user, new SendNotification($detail));

$user =Auth::user();
      
        $timezone = timezone($course);
  
  $c_date = $timezone->date;
   $c_time = $timezone->time;
        $d =  teacherDetail($course->user_id);

   
           $details = [
        'subject' => 'Congrats! You have enrolled for '.$course->title,
        'heading'=>'Well Done '.ucfirst(Auth::user()->name).'!',
        'description'=>'You are successfully enrolled for class titled  '.$course->title,
        'id'=>$course->slug,
        'instructor'=>Auth::user()->name,
        'title'=>$course->title,
        'image'=>$course->image,
        'date'=>$c_date,
        'time'=>$c_time,
        'desc'=>$course->desciption,
        'btn'=>'Join Class',
          'rating'=>intval($d->rating),
        'price'=>$curr->html,
        'url'=>url('class/'.$course->slug),
        
    ];
   
    \Mail::to($user->email)->send(new \App\Mail\StudentCancel($details));



      $detail = [
									            'n_title' => 'Welcome to Yocolab',
									            'title'=>'Class Joined',
									            'message' => 'Congrats ! '.$user->name.' has enrolled for '.$course->title,
									            'actionURL' =>  url('class/'.$course->slug),
									        ];
									  
  
        Notification::send($teacher, new SendNotification($detail));
    
           $mail = [
        'subject' => 'Congratulation ! Course Enrolled by student | Yocolab',
        'id'=>$course->slug,
        'title'=>$course->title,
        'image'=>$course->image,
        'date'=>$data->created_at,
        'user'=>$user->name,
  
    ];
   
   $u = User::find($course->user->id);
    \Mail::to($teacher->email)->send(new \App\Mail\CourseJoinedMail($mail));
   
				}

             	   return   redirect('/class/'.$course->slug)->with('success','Congratulations! You have successfully enrolled for class titled “ '.$course->title.' “. ');
		   	 }

		   	
		   }


		   public function show_cart_header()
		   {  	$html = '';
			   $subtotal = 0;
			   $count =0;
		   	
		   			 if(session('cart')){
		   			 	$count = count(session('cart'));
		   			 	
		   			
										 	 foreach(session('cart') as $id => $details){
      								      $subtotal += $details['price']- ($details['price']*$details['discount']/100 );   

												$c = Course::find($details['id']);
										$html .= '<li class="list_content">
											<a href="'.url('class/'.$c->slug).'">
												<img class="float-left" src="'.asset('storage/course/'.$details['image']).'" alt="50x50" height="50" width="50">
												<p>'.$details['title'].'</p>';
      								      		$curr =  currency_convert($c);

												
													
													$html .= '<small>'.$curr->html.'</small>
												<a href="javascript:void(0)" onclick="removeItemCart('.$id.')"><span class="close_icon float-right"><i class="fa fa-plus"></i></span></a>
											</a>
										</li>';
									}
										
									$html .=	'<li class="list_content">';
										if(Auth::user()){

											$html  .='<a href="'.url('/user/my-bookmarks').'" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" >My Wishlist</a>';
										}
										else {

											$html .= '<a href="#" class="btn btn-primary-custom btn-primary-custom-round btn-primary-custom-border" data-toggle="modal" data-target="#exampleModalCenter">My Wishlist</a>';
										}
									
										$html .='</li>';
									} else {

										$html .=  '	<li class="list_content">
										
													<p>
Classes you like appears here. <br><br>
Find your favourite classes and add them to your Wishlist.
</p>
										
										</li>';

									}


								return response()->json(['html'=>$html,'total'=>$count]);

		   }


		   public function show_cart_table()
		   {
		   		$html = '';
		   		  $subtotal = 0;$total = 0;  
		   			  if(session('cart')) {

		   			 
						  $html  .='<form action="#">
							<table class="table table-responsive">
							  	<thead>
								    <tr class="carttable_row">
								    	<th class="cartm_title">Course</th>
								    	<th class="cartm_title">Date</th>
								    	<th class="cartm_title">Type</th>
								    	
								    	<th class="cartm_title">Total</th>
								    </tr>
							  	</thead>';
							 
							  	 $html  .='<tbody class="table_body">';
							  	
      								      foreach(session('cart') as $id => $details) {
      								   $subtotal += $details['price']- ($details['price']*$details['discount']/100 );  
      								   	$c = Course::find($details['id']);
								$html .='<tr>
								    	<th scope="row">
								    		<ul class="cart_list">
								    			<li class="list-inline-item pr15"><a href="javascript:void(0);" onclick="removeItemCart('.$id.')"><img src="'.asset('front_assets/images/shop/close.png').'" alt="close.png" ></a></li>
								    			<li class="list-inline-item pr20"><a href="'.url('class/'.$c->slug).'"><img src="'.asset('storage/course/'.$details['image']).'"width="120" height="90" alt="cart1.png"></a></li>
								    			<li class="list-inline-item"><a class="cart_title" href="'.url('class/'.$c->slug).'">'.$details['title'].'</a></li>
								    		</ul>
								    	</th>
								    	<td>';
								    		if($details['date']){
								    			$html .=  $details['date'].'<br>'.$details['time'];
								    		} else{
								    			$html .='---';
								    		}
								    		
								   
								    	
								    	$html .='</td>
								    	<td>'.$details['type'].' </td>
								    
								    	<td class="cart_total">';

								    		if($details['price']){

								    			$dis = $details['price'] -(($details['price']*$details['discount'])/100);

								    			$html .= ' <del>'.$details['price'].'</del>';
													 } else {
														$html .='Free';
													}
													
													
											$html .='</td>
														    </tr>';

								  }
								  
							  $html.= '	</tbody>
							</table>
						</form>';
						} else {
						
						$html .= '<h2 class="p-5"><font color="red"> No Course Found</font></h2>';

						return response()->json(['html'=>$html,'subtotal'=>$subtotal ]);

					}
						
		   }


		   public function checkout()
		   {

		   		$id = session('cid');
		   		 $course = Course::find($id);
		   		  $api_secret = env('STRIPE_SECRET');
     		 $api_key = env('STRIPE_KEY');
		

		   	\Stripe\Stripe::setApiKey ($api_secret);

     	   $stripe = new \Stripe\StripeClient($api_secret);

		   	
		   		 $customer_cards = '';
		   		 $saved_cards = SaveCards::where('user_id',Auth::user()->id)->first();
		   		 if($saved_cards){

		   		 $customer =$stripe->customers->retrieve($saved_cards->customer_id);
		   		 $customer_cards = $customer->sources;
		   		 }


		     return view('checkout',compact('course','customer_cards'));
		   }

		   public function checkoutSrore(Request $request)
		   {
		 	    $api_secret = env('STRIPE_SECRET');
     			 $api_key = env('STRIPE_KEY');
			   	\Stripe\Stripe::setApiKey ($api_secret);
	     	  	 $stripe = new \Stripe\StripeClient($api_secret);

	     	  	 $buy ='';
   	if($request->pay > 0 )
   	{
		   					
		   	 			   // \Stripe\Stripe::setApiKey ( 'sk_test_51HBMxwH8ZLByqdG3klDodZzcqDFtELYtwRABtRPuNhhRj89qeKIYqIytjQPEVhcRpqY0Ac7XvFLTteLoFY3BMnGN00PX4NuVO5' );
						     $id = session('cid');
						     $course =Course::find($id);
						     $curr = currency_convert($course);
						     $currency = $curr->currency->code;
						     // if($course->date >= date('Y-m-d H:i:s')){
				   	   			 // $app = new \Slim\App;
						     
		 try 
		 {

				    		$pay = round($request->pay,2);
				    		$remember = $request->remember;

		
		if($request->card_id)

			{
						   $charge = \Stripe\Charge::create(array(
												    "amount" =>$pay*100 ,
												    "currency" =>$currency,
												    "customer" => $request->cust_id,
												   "source" => $request->card_id,                          
												));

									             if($charge){

									             $ch = new Charge;
									             $ch->charge_id = $charge->id;
									              $ch->course_id = $id;
									             $ch->amount = $charge->amount;
									             $ch->customer_id = $charge->customer;
									             $ch->user_id = Auth::user()->id;
									             $ch->currency = $charge->currency;
									             $ch->save();
									             $buy = $ch->id;

									             }


			} 
			 else 
			{

				    
				if($remember)

				{
				    		$saved_cards = SaveCards::where('user_id',Auth::user()->id)->first();
				    		   $customer = \Stripe\Customer::create(array("source" => $request->stripeToken, "description" => Auth::user()->name."Customer"));
				    			      $card = new SaveCards;
				    			      $card->user_id = Auth::user()->id;
				    			      $card->customer_id = $customer->id;
				    			      $card->save();

      							$charge =  \Stripe\Charge::create(array("amount" => $pay*100, "currency" => $currency, "customer" => $customer->id));

		      								 if($charge){

									             $ch = new Charge;
									             $ch->charge_id = $charge->id;
									             $ch->amount = $charge->amount;
									              $ch->course_id = $id;
									             $ch->customer_id = $customer->id;
									             $ch->user_id = Auth::user()->id;
									             $ch->currency = $charge->currency;
									             $ch->save();
									               $buy = $ch->id;
									             
									             }	
				
						    		// }
				    }
				     else 
				    {
				    	if($request->stripeToken){

				    	 	$customer = \Stripe\Customer::create(array("source" => $request->stripeToken, "description" => Auth::user()->name."Customer Pay"));
				    			     

      								$charge =  \Stripe\Charge::create(array("amount" => $pay*100, "currency" => $currency, "customer" => $customer->id));

      								 if($charge){

							             $ch = new Charge;
							             $ch->charge_id = $charge->id;
							             $ch->amount = $charge->amount;
							              $ch->course_id = $id;
							             $ch->customer_id = $customer->id;
							             $ch->user_id = Auth::user()->id;
							             $ch->currency = $charge->currency;
							             $ch->save();
							               $buy = $ch->id;
							             
							             }	
				    	}


				    }


			 }

				       // echo 'Payment done successfully !';
					 $course_exists = StudentCourse::where('user_id',Auth::user()->id)->where('course_id',$id)->where('status','done')->first();
							if(!$course_exists && $buy !=" ")
							{


									$data = new StudentCourse;
									$data->user_id = Auth::user()->id;
									$data->teacher_id =$course->user_id;
									$data->course_id=$course->id;
									$data->name = $course->title;
									$data->type =$course->type ;
									$data->des = $course->desciption;
									$data->status = 'done';
									$data->progress = 0;
									$data->save();


									$user = Auth::user();
								         $teacher = User::find($course->user_id);
													   $detail = [
								            'n_title' => 'Hi Yocolab',
								            'title' => 'Enrolled Class',
								            'message' => ' You have successfully enrolled for “ '.$course->title.' “',
								            'actionURL' =>  url('class/'.$course->slug),
								        ];
				  
				      				  Notification::send($user, new SendNotification($detail));


										      
    								    $timezone = timezone($course);
      
  
										  $c_date = $timezone->date;
										   $c_time = $timezone->time;
										    $d =  teacherDetail($course->user_id);

										   
										           $details = [
										        'subject' => 'Congrats! You have enrolled for '.$course->title,
										        'heading'=>'Well Done '.ucfirst(Auth::user()->name).'!',
										        'description'=>'You are successfully enrolled for class titled  '.$course->title,
										        'id'=>$course->slug,
										        'instructor'=>Auth::user()->name,
										        'title'=>$course->title,
										        'image'=>$course->image,
										        'date'=>$c_date,
										        'time'=>$c_time,
										        'desc'=>$course->desciption,
										        'btn'=>'Join Class',
										          'rating'=>intval($d->rating),
										        'price'=>$curr->html,
										        'url'=>url('class/'.$course->slug),
										        
										    ];
   
   										 \Mail::to($user->email)->send(new \App\Mail\StudentCancel($details));
    									   $teacher = User::find($course->user_id);
									          $detail = [
									            'n_title' => 'Welcome to Yocolab',
									            'title'=>'Class Joined',
									            'message' => 'Congratulations! “ '.$user->name.'“ has enrolled for class titled “ '.$course->title.'“',
									            'actionURL' =>  url('class/'.$course->slug),
									        ];
									  
									        Notification::send($teacher, new SendNotification($detail));
									    
									           $details = [
									        'subject' => 'Class Joined',
									        'id'=>$course->slug,
									        'title'=>$course->title,
									        'image'=>$course->image,
									        'date'=>$data->created_at,
									        'user'=>$user->name,
									  
									    ];
									   
									    \Mail::to($teacher->email)->send(new \App\Mail\CourseJoinedMail($details));


											$course_id = $id;
											$s ='';

											$video = VideoClass::where('course_id',$course_id)->first();
											if($video)
											{
											//dd($video);
														if($video->student_id){

															$s = explode(';', $video->student_id);
															array_push($s, Auth::user()->id);
															$s = implode(';', $s);
														} else {
															$arrayName = array(0 =>Auth::user()->id );
															$s = implode(';', $arrayName);
														}

													$video->student_id = $s;
													$video->save();
											}
							}


								session()->forget('cid');
								session()->forget('subtotal');
								return redirect('/class/'.$course->slug)->with('success','You have successfully enrolled for "'.$course->title. '"  class. <br>Class Fee Charged: <b> '.$pay.' '.$currency.' </b>.');

								  echo 'Payment done successfully !<br><a href="/home">home</a>';

				     // return redirect()->back()->( 'success-message', 'Payment done successfully !' );
   } catch ( \Exception $e ) {
				     
				       return redirect()->back()->with ( 'error', $e->message );
				    }

				} 
		   }


public function demo(Request $request)
{



	
$course =Course::find(249);

TeacherAttendClass::dispatch($course);
        echo "Bulk mail send successfully in the background...";

}

		   public function create(Request $request)
		   {

   	$url  = env('APP_URL');
 // return view('teacher.bank');
 \Stripe\Stripe::setApiKey ( 'sk_test_51HBMxwH8ZLByqdG3klDodZzcqDFtELYtwRABtRPuNhhRj89qeKIYqIytjQPEVhcRpqY0Ac7XvFLTteLoFY3BMnGN00PX4NuVO5' );
 $stripe = new \Stripe\StripeClient(
  'sk_test_51HBMxwH8ZLByqdG3klDodZzcqDFtELYtwRABtRPuNhhRj89qeKIYqIytjQPEVhcRpqY0Ac7XvFLTteLoFY3BMnGN00PX4NuVO5'
);

					     try {
$customerResponse = \Stripe\Customer::create(array(
  "source" => $_POST['stripeToken'],
  "description" => "Saurabh Bank1"
));

// // verify the account
// $result = $bank_account->verify(array('amounts' => array(32, 45)));
// echo '<tt><pre>'; echo var_export($result,TRUE); echo '</pre></tt>';

dd($customerResponse);
$customers = $stripe->customers->updateBalanceTransaction(
  'cus_J7lQdDq8teOFcl',
  'cbtxn_1IVW0NH8ZLByqdG3vl4k64QZ',
  ['metadata' => ['order_id' => '6735']]
);


		      } catch ( \Exception $e ) {
				      dd($e);
				       // return redirect()->back()->with ( 'fail-message', "Error! Please Try again." );
				    }

		// 		    }
		 return view('teacher.bank');
		   }



		

		   function room(Request $request,$id)
{

$course = Course::find($id);
$customer_cards ='';


 

  return view('india_checkout',compact('course','customer_cards'));
}

public function indCheckout(Request $request)
{
		 if($request->isMethod('post')){

   $input = $request->all();

   $id = $request->course_id;
   $course = Course::find($id);
   $pay =$request->pay;
    $curr = currency_convert($course);
  
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        
  
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
            	if($payment['status'] =='captured'){
            		return redirect('course/'.$id)->with('error2','You already enrolled this class');
            	}
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
       // dd($response);
       			   $course_exists = StudentCourse::where('user_id',Auth::user()->id)->where('course_id',$id)->where('status','done')->first();
							if(!$course_exists)
							{


									$data = new StudentCourse;
									$data->user_id = Auth::user()->id;
									$data->teacher_id =$course->user_id;
									$data->course_id=$course->id;
									$data->name = $course->title;
									$data->type =$course->type ;
									$data->des = $course->desciption;
									$data->status = 'done';
									$data->progress = 0;
									$data->save();

										 if($response->status =='captured'){

							             $ch = new Charge;
							             $ch->charge_id = $response->id;
							             $ch->amount = $response->amount;
							              $ch->course_id = $id;
							             
							             $ch->user_id = Auth::user()->id;
							             $ch->currency = $response->currency;
							             $ch->save();
							             
							             }	

							             		$user = Auth::user();
								         $teacher = User::find($course->user_id);
													   $detail = [
								            'n_title' => 'Hi Yocolab',
								            'title' => 'Enrolled Class',
								            'message' => ' You have successfully enrolled for “ '.$course->title.' “',
								            'actionURL' =>  url('class/'.$course->slug),
								        ];
				  
				      				  Notification::send($user, new SendNotification($detail));


										      
    								    $timezone = timezone($course);
      
  
										  $c_date = $timezone->date;
										   $c_time = $timezone->time;
										    $d =  teacherDetail($course->user_id);

										   
										           $details = [
										        'subject' => 'Congrats! You have enrolled for '.$course->title,
										        'heading'=>'Well Done '.ucfirst(Auth::user()->name).'!',
										        'description'=>'You are successfully enrolled for class titled  '.$course->title,
										        'id'=>$course->slug,
										        'instructor'=>Auth::user()->name,
										        'title'=>$course->title,
										        'image'=>$course->image,
										        'date'=>$c_date,
										        'time'=>$c_time,
										        'desc'=>$course->desciption,
										        'btn'=>'Join Class',
										          'rating'=>intval($d->rating),
										        'price'=>$curr->html,
										        'url'=>url('class/'.$course->slug),
										        
										    ];
   
   										 \Mail::to($user->email)->send(new \App\Mail\StudentCancel($details));
    									   $teacher = User::find($course->user_id);
									          $detail = [
									            'n_title' => 'Welcome to Yocolab',
									            'title'=>'Class Joined',
									            'message' => 'Congratulations! “ '.$user->name.'“ has enrolled for class titled “ '.$course->title.'“',
									            'actionURL' =>  url('class/'.$course->slug),
									        ];
									  
									        Notification::send($teacher, new SendNotification($detail));
									    
									           $details = [
									        'subject' => 'Class Joined',
									        'id'=>$course->slug,
									        'title'=>$course->title,
									        'image'=>$course->image,
									        'date'=>$data->created_at,
									        'user'=>$user->name,
									  
									    ];
									   
									    \Mail::to($teacher->email)->send(new \App\Mail\CourseJoinedMail($details));


											$course_id = $id;
											$s ='';

											$video = VideoClass::where('course_id',$course_id)->first();
											if($video)
											{
											//dd($video);
														if($video->student_id){

															$s = explode(';', $video->student_id);
															array_push($s, Auth::user()->id);
															$s = implode(';', $s);
														} else {
															$arrayName = array(0 =>Auth::user()->id );
															$s = implode(';', $arrayName);
														}

													$video->student_id = $s;
													$video->save();
											}
							}


								session()->forget('cid');
								session()->forget('subtotal');
						
								return redirect('/class/'.$course->slug)->with('success','You have successfully enrolled for "'.$course->title. '"  class. <br>Class Fee Charged:  '.$pay.' '.$response->currency.' .');

  
            } catch (Exception $e) {
               
                // Session::put('error',$e->getMessage());
                return redirect()->back()->with('error',$e->getMessage());
            }
        }
          
               return redirect()->back();
    }
}

}
