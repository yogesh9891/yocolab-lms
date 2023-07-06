<?php 
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use App\Models\Studymaterial;
use App\Models\SaveCards;
use App\Models\VideoClass;
use App\Models\Charge;
use App\Models\StudentCourse;
use App\Models\FollowTeacher;
use App\Models\ZoomId;
use App\Models\Feedback;
use App\Models\Earning;
use App\Models\Country;
use App\Models\Blog;


function categories()
{
	$c = Category::with('subcategory')->where('parent_id',0)->where('status',1)->get();
	return $c;
}

 function timezone($course)
{
			
		$timezone = new  stdClass();

		
		if(!session('timezone')){
			
		$r = my_timezone();
		session()->put('timezone', $r->timezone);
		}

		// $utc_date = DateTime::createFromFormat('Y-m-d H:i:s',$course->date,new DateTimeZone('UTC'));
		// $acst_date = clone $utc_date; // we don't want PHP's default pass object by reference here
		// $acst_date->setTimeZone(new DateTimeZone(session('timezone')));


 		$course_time = new DateTime($course->date);
		$user_time_zone = new DateTimeZone(session('timezone'));
		$course_time->setTimezone($user_time_zone);
		$timezone->date = $course_time->format('d M Y ');
		$timezone->time = $course_time->format('H:i');

		return $timezone;
}

 function api_timezone($course,$time_zone)
{
			
		$timezone = new  stdClass();

	

		// $utc_date = DateTime::createFromFormat('Y-m-d H:i:s',$course->date,new DateTimeZone('UTC'));
		// $acst_date = clone $utc_date; // we don't want PHP's default pass object by reference here
		// $acst_date->setTimeZone(new DateTimeZone(session('timezone')));


 		$course_time = new DateTime($course->date);
		$user_time_zone = new DateTimeZone($time_zone);
		$course_time->setTimezone($user_time_zone);
		$timezone->date = $course_time->format('d M Y ');
		$timezone->time = $course_time->format('H:i');

		return $timezone;
}

function my_currency_convert($from,$amount){
		$ip = geoip()->getLocation(my_ip());
		$amount_arry = explode('-',$amount);
		$to = $ip->currency;
		$price_num1 = round(currency($amount_arry[0],$from,$to,$format = false));
		$price_num2 = round(currency($amount_arry[1],$from,$to,$format = false));
		$my_curreny = currency()->find($to);

		return $my_curreny->symbol.' '.$price_num1.' - '.$price_num2;
}
  function currency_convert($course)
 {  

 	$response  = new  stdClass();
 	$html = '';
 	$ip = geoip()->getLocation(my_ip());

 		
 		if($course->price){
 			$from = $course->currency;
			 	$to = $ip->currency;
			 	$price = currency($course->price,$from,$to);
 				$response->status = 1;
 				$price_num = currency($course->price,$from,$to,$format = false);
 			if($course->discount){
 			
 				$dis_price = $price_num-(($price_num*$course->discount)/100);

 			$html =	currency_format($dis_price,$to).'  <del style="font-size: 14px !important">' . $price.'</del>';
 				$response->currency =currency()->find($to);
 				$response->price = round($dis_price,2);
 			} else {
 				$html = $price;
 				$dis_price = round($price_num,2);
 				$response->currency = currency()->find($to);
 				$response->price = $dis_price;
 			}

 		} else{
 				$response->status = 0;
 			$html = 'Free';
 		}


 		$response->html = $html;
														
 		return $response;
 }


function my_timezone()
{
	$response  = new  stdClass();
 
 	$ip = geoip()->getLocation(my_ip());
 		$response = $ip;
 		return $response;
}

function my_ip()
{
	 foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED') as $key){
        if (array_key_exists($key, $_SERVER) === true){
            foreach (explode(',', $_SERVER[$key]) as $ip){
                $ip = trim($ip); // just to be safe
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                    return $ip;
                }
            }
        }
    }
    return request()->ip();
}

 function category_courses($cat_id)
{
	$cat_ids = [$cat_id];
	$category = Category::where('parent_id',$cat_id)->where('status',1)->get();

	foreach ($category as $cat) {
		array_push($cat_ids, $cat->id);
	};


	$total_course = 0;
	$courses = Course::whereIn('category_id',$cat_ids)->whereHas('video_class', function($query) {
                  $query->where('status', '=', 'start');
             })->where('status',1)->where('date','>=',date('Y-m-d H:i:s'))->orderBy('date','asc')->get();
	   foreach ($courses as $key => $value) {
        
         $c = timezone($value);
            if($c->date < date('d M Y')){
              unset($courses[$key]);
            } else {
              if($c->date ==date('d M Y') ){

        
                if($c->time <=date('H:i')){
                  unset($courses[$key]);
                }
              }
            }
          
        }

        $total_course = count($courses);
	return $total_course;

}

function getCookie(Request $request) {
      $value = $request->cookie('cookie');
      echo $value;
   }


function checkMObileDevice()
{
   $useragent=request()->server('HTTP_USER_AGENT');

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
    return true;
} else {
    return false;
}

}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString.time();
}

function studentEnrolled($id)
{ 
	$stu_enrolled = 0;
	 $stu_enrolled = StudentCourse::where('course_id',$id)->where('status','done')->count();
	 if(!$stu_enrolled){
	 	$stu_enrolled = 0;
	 }
	 return $stu_enrolled;
}

function userPriceText($id)
{
	$my_course = '';
	$html = '';
	$course = Course::find($id);
		
	$curr = currency_convert($course);

	if(Auth::user()) {

			if($course->user_id == Auth::id()){
				$html = 'Go to class';
			} else {
			  $my_course = StudentCourse::where('course_id',$id)->where('user_id',Auth::id())->where('status','done')->first();
			  if($my_course){

			  $html = 'Join Now';
			  } else {

				$html = $curr->html;
			  }

			}
	} else {
		$html = $curr->html;
	}

	  return $html;
}

function userCourse($id)
{
	$my_course = "";
	 $my_course = StudentCourse::where('course_id',$id)->where('user_id',Auth::id())->where('status','done')->first();
	 return $my_course;
}

function  categorySlug($id)
{

	$course = Course::with('category')->find($id);
	$cat_slug ='';
	if($course->category->parent_id > 0)
	{
		$cat_id = $course->category->parent_id;
		$catg = Category::find($cat_id);
		$cat_slug = $catg->slug;
			 									
	}

	return $cat_slug;
}


function teacherDetail($t_id)
{
	$data =  Teacher::where('user_id',$t_id)->first();
	if($data){
	$user =  User::find($t_id);
		$data->user = $user;
	$country = Country::where('value',$data->country)->first();

	$rating = 0;
	$min_price = 1;
		$symbol = '';
		$currency = '';
	$r  = Feedback::where('teacher_id',$t_id)->avg('star');
	if($r){
		$rating = $r;
	}

	if($data->country =='IN'){

		$min_price = 1;
		$symbol = '₹';
		$currency = 'INR';
		$min_price =  currency(5.00, 'SGD', 'INR',false);


	} else {
		 $api_secret = env('STRIPE_SECRET');
		$stripe = new \Stripe\StripeClient($api_secret);
		 $account =$stripe->accounts->retrieve($data->account_id,);
		 $min_price_symbol =  currency(5.00, 'SGD', $account->default_currency);
		 $min_price =  currency(5.00, 'SGD', $account->default_currency,false);
		 $currency = $account->default_currency;
		 $symbol = 	currency()->find($account->default_currency)->symbol;
		 $min_price = $min_price;
	} 
	$data->rating  = round($rating);
	$data->min_price  = $min_price;
	$data->currency  = $currency;
	$data->symbol  = $symbol;
	$data->show_country  = $country->name;
	$data->country  = $data->country;
	$date=date_create($data->created_at);
      $data->date =  date_format($date,"d/M/Y H:i");

}
	return $data;
}

 function is_Live($id)
{
	$live  = VideoClass::where('course_id',$id)->where('status','inprogress')->first();
	return $live;
}


function teaherStudents($id)
{
  return	$student = StudentCourse::where('teacher_id',$id)->distinct('user_id')->count('user_id');
}


function pendingAmount()
{
	$reports = Earning::where('type',1)->where('status','pending')->get();
	$total = 0;
	foreach ($reports as  $value) {
		
		$total += $value->total;
	}

	return $total;
}


function teacher_profile($t_id)
{
	$data = new stdClass;
	  $data->students = StudentCourse::where('teacher_id',$t_id)->distinct()->count('user_id');
	  $data->followers = FollowTeacher::where('teacher_id',$t_id)->distinct()->count('user_id');
	  $data->reviewa = Feedback::where('teacher_id',$t_id)->distinct()->count('course_id');
	  $data->course = Course::where('user_id',$t_id)->where('status',1)->count();
	  $data->rating = Feedback::where('teacher_id',$t_id)->avg('star');
	

	 return $data;
}

 function blog_count($cat_id)
{
	return $blog = Blog::where('category_id',$cat_id)->count();

}

