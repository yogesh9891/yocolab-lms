<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Teacher;
use App\Models\FollowTeacher;
use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use App\Models\SaveCards;
use App\Models\StudentCourse;
use App\Models\Prefrence;
use App\Models\Feedback;
use App\Models\VideoClass;
use App\Models\Faq;
use App\Models\Charge;
use App\Models\Language;
use App\Models\Country;
use App\Models\RequestClass;
use App\Models\Blog;

use App\Notifications\SendNotification;

use DB,Hash;
use stdClass;
use Session;
use DateTime;
use Mail,Notification;

use Spatie\Permission\Models\Role;
use Auth ;
use Razorpay\Api\Api;

class FrontController extends Controller
{
    
    public function timezone(Request $request)
    {
      Session::put('timezone',  $request->timezone);
      // / session()->put('timezone',);
    }



    public function index()

    { 
    
      $courses =Course::with('category','video_class')->whereHas('video_class', function($query) {
                  $query->where('status', '!=', 'end');
             })->where('status',1)->where('date','>=',date('Y-m-d'))->orderBy('date','asc')->get();

      $category = Category::with('subcategory')->where(['top'=>1,'status'=>1])->get();
      $teachers = Teacher::with('user')->where('status',1)->orderBy('created_at','DESC')->take(8)->get();


    	return view('index',compact('category','teachers','courses'));
      
    }

   
    public function course($id)
    {
        $follow ='';
        $course = Course::with('teacher','user','video_class','category')->where('id',$id)->where('type','Live')->first();
        if(!$course){
            abort(404);
        }

         $shareComponent = \Share::page((url('/course/'.$id)))
       ->facebook()
    ->twitter()
    ->linkedin('Extra linkedin summary can be passed here')
    ->whatsapp()
    ->getRawLinks();


         $stu_enrolled = StudentCourse::where('course_id',$course->id)->where('status','done')->count();
         $teacher_course = Course::whereStatus(1)->where('user_id',$course->user_id)->where('date','>=',date('Y-m-d H:i:s'))->where('id','!=',$id)->take(3)->get();
      
        $stu_course = '';
        if(Auth::user()) {
                   $follow = FollowTeacher::where('user_id',Auth::user()->id)->where('teacher_id',$course->user->id)->first();
         $stu_course = StudentCourse::where('user_id',Auth::user()->id)->where('course_id',$course->id)->where('status','done')->first();

           if($stu_course){
           return view('student.course',compact('course','stu_course','stu_enrolled','teacher_course','follow','shareComponent'));
         } 

        }
      
       return view('course-details',compact('course','stu_course','stu_enrolled','teacher_course','follow','shareComponent'));
    }

       public function course_slug($slug)
    {
        $follow ='';
        $course = Course::with('teacher','user','video_class','category')->where('slug',$slug)->where('type','Live')->first();
        if(!$course){
            abort(404);
        }
         $stu_enrolled = StudentCourse::where('course_id',$course->id)->where('status','done')->count();
         $teacher_course = Course::whereStatus(1)->where('user_id',$course->user_id)->where('date','>=',date('Y-m-d H:i:s'))->where('slug','!=',$course->slug)->take(3)->get();
      
        $stu_course = '';
        if(Auth::user()) {
                   $follow = FollowTeacher::where('user_id',Auth::user()->id)->where('teacher_id',$course->user->id)->first();
         $stu_course = StudentCourse::where('user_id',Auth::user()->id)->where('course_id',$course->id)->where('status','done')->first();

           if($stu_course){
           return view('student.course',compact('course','stu_course','stu_enrolled','teacher_course','follow'));
         } 

        }
                  
       return view('course-details',compact('course','stu_course','stu_enrolled','teacher_course','follow'));
    }

    public function teacher_profile($name,$t_id)
    {
        
        $follow = ''; 

        $teacher = Teacher::with('user')->where('teacher_id',$t_id)->first();
        if(!$teacher){
            abort(404);
        }
        $courses =Course::with('category','video_class')->whereHas('video_class', function($query) {
                  $query->where('status', '!=', 'end');
             })->where('status',1)->where('user_id',$teacher->user_id)->where('date','>=',date('Y-m-d'))->orderBy('date','asc')->get();
            $followers = FollowTeacher::where('teacher_id',$teacher->id)->count();

    
        if(Auth::user()){
             $follow = FollowTeacher::where('user_id',Auth::user()->id)->where('teacher_id',$teacher->user_id)->first();
          if(Auth::user()->id == $teacher->user_id){
           $teacher->self = 1 ;
        }
          
        } else {
           $teacher->self = 0 ;
        }
       
            $students = StudentCourse::where('teacher_id',$teacher->id)->distinct('user_id')->where('status','done')->count('user_id');
        return view('teacher.profile',compact('teacher','follow','courses','students','followers'));

    }


   

    public function fetchSubcategory(Request $request)
    {
    	 $id = $request->id;
       
         $subcategory = Category::where(['parent_id'=>$id,'status'=>1])->get();
          return response()->json($subcategory);

    }

    public function courseAll(Request $request)
    {
    

    $path = '?';
    $cat_id = [];
    $sub_id = [];
    $cat_slug = [];
    $sub_slug = [];
      $courses =Course::with('category','video_class')->whereHas('video_class', function($query) {
                  $query->where('status', '!=', 'end');
             })->where('status',1)->where('date','>=',date('Y-m-d'));
      $all_courses = Course::with('category','video_class')->whereHas('video_class', function($query) {
                  $query->where('status', '!=', 'end');
             })->where('status',1)->where('date','>=',date('Y-m-d'))->orderBy('date','asc')->get();

       if($request->q){
         $key = $request->q;
         $category =[];
          $courses->with('category')->where('title','LIKE','%'.$key.'%');
         
          $path .='q='.$key.'&';
       
         // $data =  Course::with('user','category','video_class')->whereHas('video_class', function($query) {
         //          $query->where('status', '=', 'start');
         //     })->where('status',1)
         // ->where('date','>=',date('Y-m-d H:i:s'))
         // ->where('title','LIKE','%'.$key.'%')
         // ->orderBy('date','asc')->orderBy('time','asc')->get();
         
       
       }

       if($request->cat){
             
            $key =  explode(',', $request->cat);
             $category = Category::with('courses','subcategory')->whereIn('slug',$key)->get();
           
            
            foreach ($category as  $val) {
                        array_push($cat_id, $val->id);
                        array_push($cat_slug, $val->slug);
                            foreach ($val->subcategory as $value) {
                           array_push($cat_id, $value->id);
                         }
            }

        $courses->with('category')->whereIn('category_id',$cat_id);
         $cat_string = implode(',',$cat_slug);
          $path .='cat='.$cat_string.'&';


         
       }

        if($request->sub){
              $key =  explode(',', $request->sub);
              $category = Category::with('courses','subcategory')->whereIn('slug',$key)->get();
              foreach ($category as  $val) {
                        array_push($sub_id, $val->id);
                        array_push($sub_slug, $val->slug);
                          
            }

          $courses->with('category')->whereIn('category_id',$sub_id);
         $sub_string = implode(',',$sub_slug);
          $path .='sub='.$sub_string.'&';
             

       }


        if($request->price){


          $courses->where('price_type','=',$request->price);
           $path .='price_type='.$request->price.'&';

       

       } else
             if($request->type){

        if($request->type == 'Live'){
          $type = 'Live';
          $courses->where('type',$request->type);
           $path .='type='.$request->type.'&';

        } elseif($request->type =='Recorded') {

          $type = 'Recorded';
           $courses->where('type',$request->type);
            $path .='type='.$request->type.'&';
         
        }  else {
       
           // $courses->where('type','Live')->orWhere('type','Recorded');
        }

       }


       if($request->level){
          $level = array_values(array_unique($request->level));
           $courses->whereIn('level',$level);
             $level_string = implode(',',$request->level);
          $path .='level='.$level_string.'&';
       }
    
     if($request->date){
          $date = $request->date;
           $courses->where('date','>=',$date);
             $path .='date='.$date.'&';

     
       }

        if($request->language){
          $language = array_values(array_unique($request->language));
           $courses->whereIn('language',$language);
             $language_string = implode(',',$request->language);
          $path .='language='.$language_string.'&';
       }



      $data =    $courses->orderBy('date','asc')->paginate(7);
            $data->withPath($path);


       // $category = Category::where('parent_id',0)->whereHas('courses', function ($query) {
       //                        $query->where('date','>=', date('Y-m-d'))->where('status',1);
       //                    })->get();
      $category = Category::with('courses')->where('parent_id',0)->where('status',1)->get();
      $subcategory = Category::with('courses')->where('parent_id','!=',0)->where('status',1)->get();
      $level = Course::select('level', \DB::raw("count(id) as total"))->groupBy('level')->get();
    




      return view('courses',compact('data','category','subcategory','level','all_courses'));


    }

    public function getCategoryCourse(Request $request)
    {


    $all_courses = Course::with('category','video_class')->whereHas('video_class', function($query) {
                  $query->where('status', '!=', 'end');
             })->where('status',1)->where('date','>=',date('Y-m-d'))->orderBy('date','asc')->get();
   

      $check = $request->chk ;
      $data = '';
      $html = '';
      $subcat_id = [];
      $cat_slug = [];
      $sub_slug = [];
    
      $cat_id = $request->cat_id;
      $type = 'all';
      $path= '?';

      $courses = Course::with('category','video_class')->whereHas('video_class', function($query) {
                  $query->where('status', '!=', 'end');
             })->where('status',1)->where('date','>=',date('Y-m-d'));

      if($request->cat_id){

    
          $subcategory = Category::with('courses')->whereIn('parent_id',$cat_id)->get();
           $slug_category =  Category::whereIn('id',$cat_id)->get();
        

         foreach ($slug_category as $value) {
               array_push($cat_slug, $value->slug);
         }


         
          if($request->sub){
             if(count($subcategory) > 0) {

        foreach ($subcategory as $item) {
          array_push($cat_id, $item->id);
         ;
          
         $html .= ' <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input get_subcategory_course" id="customCheck'.$item->id.'" value="'.$item->id.'" onclick="fetchSubcategory(this)">
                          <label class="custom-control-label" for="customCheck'.$item->id.'">'.$item->name.' <span class="float-right"></span></label>
                        </div>';
        }


          }
        }


            $cat_id = array_values(array_unique($cat_id));

      

         $courses = $courses->with('category')->whereIn('category_id',$cat_id);
          $cat_string = implode(',',$cat_slug);
          $path .='cat='.$cat_string.'&';


       }



       if($request->subcat_id){


         $subcat_id = array_values(array_unique($request->subcat_id));
           $scategory =  Category::whereIn('id',$subcat_id)->get();
        

         foreach ($scategory as $value) {
               array_push($sub_slug, $value->slug);
         }


        $courses =  $courses->with('category')->whereIn('category_id',$subcat_id);

          $subcat_string = implode(',',$sub_slug);
          $path .='sub='.$subcat_string.'&';
       }

    
      if($request->price){


          $courses->where('price_type','=',$request->price);
           $path .='price_type='.$request->price.'&';

       

       }

           if($request->type){

        if($request->type == 'Live'){
          $type = 'Live';
          $courses->where('type',$request->type);
           $path .='type='.$request->type.'&';

        } elseif($request->type =='Recorded') {

          $type = 'Recorded';
           $courses->where('type',$request->type);
            $path .='type='.$request->type.'&';
         
        }  else {
       
           // $courses->where('type','Live')->orWhere('type','Recorded');
        }

       }

    if($request->q != null){

            $key = $request->q;
        
             $category =[];
           
              $courses->where('title','LIKE','%'.$key.'%')->where('date','>=', date('Y-m-d'))
         ->orWhere('desciption','LIKE','%'.$key.'%')
         ->orWhere('tags','LIKE','%'.$key.'%')
         ->orWhere('price_type','=',$key)
         ->orWhere('type','=',$key)
         ->orderBy('created_at','DESC')->get();


        
       }

       if($request->level){
          $level = array_values(array_unique($request->level));
           $courses->whereIn('level',$level);
             $level_string = implode(',',$request->level);
          $path .='level='.$level_string.'&';
       }
    
     if($request->date){
          $date = $request->date;
           $courses->where('date','>=',$date);
             $path .='date='.$date.'&';

     
       }

        if($request->language){
          $language = array_values(array_unique($request->language));
           $courses->whereIn('language',$language);
             $language_string = implode(',',$request->language);
          $path .='language='.$language_string.'&';
       }

      $res =    $courses->orderBy('date','desc')->paginate(7);
            $res->withPath($path);






        if(count($res) > 0 ) {

          $data  .= '<div class="row courses_list_heading">
            <div class="col-xl-4 p0">
              <div class="instructor_search_result style2">
                <p class="mt10 fz15"><span class="color-dark pr10"> </span>  <span class="color-dark pr10">'.count($res).'</span>  All Classes</p>
              </div>
            </div>
            <div class="col-xl-8 p0">
              <div class="candidate_revew_select style2 text-right" >
                <ul class="mb0">
               
                  <li class="list-inline-item">
                    <div class="candidate_revew_search_box course fn-520">
                      <form class="form-inline my-2 my-lg-0" action="'.url('/courses').'">
                          <input class="form-control mr-sm-2" type="search" placeholder="Search all classes" aria-label="Search" name="q" value="'.app('request')->input('q').'">
                          <button class="btn my-2 my-sm-0" type="submit"><span class="flaticon-magnifying-glass"></span></button>
                        </form>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row courses_container">';

            foreach( $res as $course ) {

                        $t = teacherDetail($course->user_id);
                        $timezone = timezone($course);
                          $c_date = $timezone->date;  
                          $c_time = $timezone->time;
                        
                          

         
         $data  .= '<div class="col-lg-12 p0">
              <div class="courses_list_content">
                <a href="'.url('class/'.$course->slug).'">
                  <div class="top_courses list">
                  <div class="thumb">
                              <img class="img-whp" src="'.asset('storage/course/'.$course->image).'"  style="width: 320px !important" alt="t1.jpg">
                <div class="overlay"></div>
                   
                  </div>';
                // <div class="top_courses list">
                //   <div class="thumb">';
                //           if(Auth::user()){
                //               if(!$my_course){
                //                 $data .='<a class="whishlist-link" href="#!" id="addToCart" data-id="'.$course->id.'"></a>';
                //               }
                //           }
                //             else{
                //                 $data .=' <a class="whishlist-link" href="#!" data-toggle="modal" data-target="#exampleModalCenter"></a>';
                //             }
                           
                // $data .=' <a href="'.url('course/'.$course->id).'"> <img class="img-whp" src="'.asset('storage/course/'.$course->image).'" alt="t1.jpg"></a>
                //     <div class="overlay">
                //       <div class="icon"><span class="flaticon-like"></span></div>
                //       <a class="tc_preview_course" href="'.url('course/'.$course->id).'">Preview Course</a>
                //     </div>
                //   </div>
                 $data .='<div class="details">
                 <div class="tc_content">
                      <p> '.$t->user->name;
                      if($t->rating > 0){

                     $data .='   <ul class="tc_review">';
                          for($i=1;$i<=$t->rating;$i++){

                         $data .=' <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>';
                          }
                          
                        
                          $data  .='<li class="list-inline-item"><a href="#">'.($t->rating).'</a></li> </ul>';
                       
                      } else {
                         $data .='   <ul class="tc_review">';
                          for($i=1;$i<=5;$i++){

                         $data .=' <li class="list-inline-item"><a href="#"><i class="fa fa-star text-secondary"></i></a></li>';
                          }
                          
                        
                          $data  .='<li class="list-inline-item"><a href="#">(0)</a></li> </ul>';
                      }
                    


                     $data .= '</p>
                        <div class="tc_price float-right fn-414">
                        <h5><span class="class-live">
                          <i class="fa fa-circle" ></i>  '.$course->type.'
                        </span></h5>
                        
                      </div>
                      <h5>'.$course->title.'</h5>';
                      if($course->category){
                        $data .= '<p>'.$course->category->name.'</p>';
                      }
                   $data .=   '<p>'.substr($course->desciption,0,150)."..".'</p>
                    </div>
                    <div class="tc_footer">
                      <ul class="tc_meta float-left fn-414">
                      <li class="list-inline-item"><a href="#"><i class="flaticon-profile"></i></a></li>
                                <li class="list-inline-item"><a href="#">'.studentEnrolled($course->id).'</a></li>
                                <li class="list-inline-item"><a href="#"><i class="flaticon-clock"></i></a></li>
                                <li class="list-inline-item"><a href="#">'.$c_time.'</a></li>
                                <li class="list-inline-item"><a href="#"><i class="flaticon-calendar-1"></i></a></li>
                                <li class="list-inline-item"><a href="#">'.$c_date.'</a></li>
                      </ul>
                      <div class="tc_price float-right fn-414">'
                        .userPriceText($course->id);
                        
                       
                    $data .=  '</div>
                     
                    </div>
                  </div>
                </div>
              </div></a>
            </div>';


}
            
         $data .= $res->links('vendor.pagination.bootstrap-4');
         $data  .='</div>';

          } else { 

            $data .= '

              <div class="row courses_list_heading">
            <div class="col-xl-4 p0">
              <div class="instructor_search_result style2">
                <p class="mt10 fz15"><span class="color-dark pr10"> </span>  <span class="color-dark pr10">0</span> All Classes</p>
              </div>
            </div>
            <div class="col-xl-8 p0">
              <div class="candidate_revew_select style2 text-right" >
                <ul class="mb0">
               
                  <li class="list-inline-item">
                    <div class="candidate_revew_search_box course fn-520">
                      <form class="form-inline my-2 my-lg-0" action="'.url('/courses').'">
                          <input class="form-control mr-sm-2" type="search" placeholder="Search all classes" aria-label="Search"  name="q" value="'.app('request')->input('q') .'">
                           <button class="btn my-2 my-sm-0" type="submit"><span class="flaticon-magnifying-glass"></span></button>
                        </form>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>


            <div class="candidate_revew_search_box course no-result-found">
            <form class="form-inline my-2 my-lg-0" action="'.url('/prefrence').'" method="post"><h3> We observed there are no suitable classes'
            ;if(app('request')->input('q')) { ; 



           $data .=  ' for '.app('request')->input('q') ;

            }  
             $data .= ' </h3>
              <input type="hidden" name="_token"'.csrf_token().'>
              <p>We will be happy to look for'; if(app('request')->input('q'))  { $data .= app('request')->input('q'); } $data .=' classes. Click submit and we will find a class for you at our earliest..</p>
             <div class="d-flex mt-2 w-50">
                <input class="form-control mr-sm-2 course-input" type="search" placeholder="" aria-label="Search"  name="q" value="'.app('request')->input('q').'">
                  <button class="btn btn-primary-custom" type="submit" style="background-color: #fd6003">Submit</button>  
              </div>
              </form>
          </div>
            
            <h3 class="mt-4 mb-5 text-center">View All Our Classes</h3>
          
          
          <div class="row courses_container">';
            foreach( $all_courses->take(7) as $course ){
                    $t = teacherDetail($course->user_id);
                    $time2 = date('H:i',  strtotime($course->time) + $course->duration*3600);
                          
                $date=date_create($course->date);
                $date =date_format($date,"Y-m-d");
                $dat = new DateTime($date.' '.$time2);
                                                    
                           if(session('timezone'))
                                                    {
                                                            $timezone = timezone($course);
                                                        
                                                                $c_date = $timezone->date;  
                                                                $c_time = $timezone->time;
                                                                
                                                            
                                              }
                  if(new DateTime('now') <= $dat ){                          
           $data  .= '<div class="col-lg-12 p0">
              <div class="courses_list_content">
                  <a href="'.url('class/'.$course->slug).'">
                  <div class="top_courses list">
                  <div class="thumb">
                  
                              <img class="img-whp" src="'.asset('storage/course/'.$course->image).'"  style="width: 320px !important" alt="t1.jpg">
                         
                <div class="overlay"></div>
                   
                  </div>
                  <div class="details">
                    <div class="tc_content">
                     <p> '.$t->user->name;
                      if($t->rating > 0){

                     $data .='   <ul class="tc_review">';
                          for($i=1;$i<=$t->rating;$i++){

                         $data .=' <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>';
                          }
                          
                        
                          $data  .='<li class="list-inline-item"><a href="#">'.($t->rating).'</a></li> </ul>';
                       
                      }
                      $data .='  <div class="tc_price float-right fn-414">
                        <h5><span class="class-live">
                          <i class="fa fa-circle" ></i>  '.$course->type.'
                        </span></h5>
                        
                      </div>
                      <h5>'.$course->title.'</h5>';
                      if($course->category){
                        $data .= '<p>'.$course->category->name.'</p>';
                      }
                   $data .=   '<p>'.substr($course->desciption,0,150)."..".'</p>
                    </div>
                    <div class="tc_footer">
                      <ul class="tc_meta float-left fn-414">
                      <li class="list-inline-item"><a href="#"><i class="flaticon-profile"></i></a></li>
                                <li class="list-inline-item"><a href="#">'.studentEnrolled($course->id).'</a></li>
                                <li class="list-inline-item"><a href="#"><i class="flaticon-clock"></i></a></li>
                                <li class="list-inline-item"><a href="#">'.$c_time.'</a></li>
                                <li class="list-inline-item"><a href="#"><i class="flaticon-calendar-1"></i></a></li>
                                <li class="list-inline-item"><a href="#">'.$c_date.'</a></li>
                      </ul>
                      <div class="tc_price float-right fn-414">'.userPriceText($course->id);
                        
                       
                    $data .=  '</div>
                     
                    </div>
                  </div>
                </div>
              </div></a>
            </div>';
           }
         }

         $data .= '</div>';
            
          }
          
      
  

return response()->json(['course'=>$data,'sub'=>$html,'success'=>true]);
  
    }


 public function instructors(Request $request)
    {
    

    $path = '?';
    $cat_id = [];
    $sub_id = [];
    $cat_slug = [];
    $sub_slug = [];
   
      $teacher = Teacher::with('user','category');

     //   if($request->q){
     //     $key = $request->q;
     //     $category =[];
     //      $courses->with('category')->where('title','LIKE','%'.$key.'%');
         
     //      $path .='q='.$key.'&';
       
     //     // $data =  Course::with('user','category','video_class')->whereHas('video_class', function($query) {
     //     //          $query->where('status', '=', 'start');
     //     //     })->where('status',1)
     //     // ->where('date','>=',date('Y-m-d H:i:s'))
     //     // ->where('title','LIKE','%'.$key.'%')
     //     // ->orderBy('date','asc')->orderBy('time','asc')->get();
         
       
     //   }

     //   if($request->cat){
             
     //        $key =  explode(',', $request->cat);
     //         $category = Category::with('courses','subcategory')->whereIn('slug',$key)->get();
           
            
     //        foreach ($category as  $val) {
     //                    array_push($cat_id, $val->id);
     //                    array_push($cat_slug, $val->slug);
     //                        foreach ($val->subcategory as $value) {
     //                       array_push($cat_id, $value->id);
     //                     }
     //        }

     //    $courses->with('category')->whereIn('category_id',$cat_id);
     //     $cat_string = implode(',',$cat_slug);
     //      $path .='cat='.$cat_string.'&';


         
     //   }
   if($request->language){
          $language = array_values(array_unique($request->language));
           $teacher->whereIn('language',$language);
             $language_string = implode(',',$request->language);
          $path .='language='.$language_string.'&';
       }

       if($request->country){
          $country = array_values(array_unique($request->country));
           $teacher->whereIn('country',$country);
             $country_string = implode(',',$request->country);
          $path .='country='.$country_string.'&';
       }

         if($request->experience){
          $experience = array_values(array_unique($request->experience));
           $teacher->whereIn('experience',$experience);
             $experience_string = implode(',',$request->experience);
          

           }
     
      $data =    $teacher->orderBy('id','asc')->paginate(7);
            $data->withPath($path);


       // $category = Category::where('parent_id',0)->whereHas('courses', function ($query) {
       //                        $query->where('date','>=', date('Y-m-d'))->where('status',1);
       //                    })->get();
      $category = Category::with('courses')->where('parent_id',0)->where('status',1)->get();
      $country = Country::whereStatus(1)->get();
      $language = Language::whereStatus(1)->get();

      return view('teacher',compact('data','category','country','language'));


    }


    public function get_instructor(Request $request)
    {
        $check = $request->chk ;
      $data = '';
      $html = '';
      $subcat_id = [];
      $cat_slug = [];
      $sub_slug = [];
    
      $cat_id = $request->cat_id;
      $type = 'all';
      $path= '?';

      $teacher = Teacher::with('user','category');
      if($request->cat_id){

      if(count($request->cat_id) > 0){
          $cat_id = array_values(array_unique($cat_id));
          $teacher->whereIn('category_id',$cat_id);
          foreach($cat_id as $val){
            $cate = Category::find($val);
            array_push($cat_slug, $cate->slug);
          }
            $cat_string = implode(',',$cat_slug);
          $path .='cat='.$cat_string.'&';
        }
      }

   if($request->language){
          $language = array_values(array_unique($request->language));
           $teacher->whereIn('language',$language);
             $language_string = implode(',',$request->language);
          $path .='language='.$language_string.'&';
       }

       if($request->country){
          $country = array_values(array_unique($request->country));
           $teacher->whereIn('country',$country);
             $country_string = implode(',',$request->country);
          $path .='country='.$country_string.'&';
       }

         if($request->experience){
          $experience = array_values(array_unique($request->experience));
           $teacher->whereIn('experience',$experience);
             $experience_string = implode(',',$request->experience);
          $path .='experience='.$experience_string.'&';
       }
      $res = $teacher->orderBy('id','desc')->paginate(7);
       $res->withPath($path);

      $data .= '<div class="row courses_list_heading">
                        <div class="col-xl-4 p0">
                            <div class="instructor_search_result style2">
                                <p class="mt10 fz15"><span class="color-dark pr10"> </span>  <span class="color-dark pr10"></span>All Classes</p>
                            </div>
                        </div>
                        <div class="col-xl-8 p0">
                            <div class="candidate_revew_select style2 text-right" >
                                <ul class="mb0">
                            
                                    <li class="list-inline-item">
                                        <div class="candidate_revew_search_box course fn-520">
                                            <form class="form-inline my-2 my-lg-0" action="'.url('/courses').'">
                                                <input class="form-control mr-sm-2" type="search" placeholder="Search all classes" aria-label="Search"  name="q" value="'.app('request')->input('q').'">
                                                <button class="btn my-2 my-sm-0" type="submit"><span class="flaticon-magnifying-glass"></span></button>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row courses_container">';

        if(count($res) > 0 ) {

      
                        foreach($res as $teacher )
                        {
                            
                             $teach_det = teacherDetail($teacher->user_id); 
                        
                            $data .= '<div class="col-lg-12 p0">
                            <div class="courses_list_content">
                            <a href="'.url('profile/'.str_slug($teach_det->user?$teach_det->user->name:'').'/'.$teacher->teacher_id).'">
                                    <div class="top_courses list">
                                      <div class="thumb">
                                          <img class="img-whp" src="'.asset('storage/teacher/'.$teacher->image).'"  style="width: 320px !important" alt="t1.jpg">
                                                     
                                          <div class="overlay">
                                              
                                          
                                          </div>
                                      </div>

                                     <div class="details">
                                          <div class="tc_content">
                                            <h5 style="min-height: 20px;">'.$teach_det->user->name.'</h5>';
                                              
                                              if($teach_det->rating > 0){

                                                     $data .='<ul class="tc_review">';
                                                        for($i=1;$i<=$teach_det->rating;$i++){
                                                     $data .= '<li class="list-inline-item">
                                                          <span>
                                                            <i class="fa fa-star"></i>
                                                          </span>
                                                        </li>';
                                                     
                                                      }
                                                        $data .='<li class="list-inline-item">'.$teach_det->rating.'  </li></ul>';
                                                  }  

                                           $data .= ' <p><b>'.$teacher->expert.' , '.$teacher->experience.' Experience</b></p>';
                                            if($teacher->category){ $data .='<p>'.$teacher->category->name.'</p>'; }
                                            $data .='<p>'.substr($teacher->about,0,150)."..".'</p>
                                        </div>
                                          <div class="tc_footer">
                                              <ul class="tc_meta float-left fn-414">
                                                        <li class="list-inline-item"><i class="fa fa-list"></i></li>
                                                        <li class="list-inline-item">'.$teacher->expert.'</li>
                                                        <li class="list-inline-item">
                                                          <i class="flaticon-global"></i>'.$teacher->language.' , '.$teacher->country.'</li>
                                                          
                                                      
                                                      
                                                    </ul>
                                                  <div class="tc_price float-right fn-414">';
                                                  if(Auth::id() ==$teacher->user_id){

                                                  } else{

                                                     $data .='<a href="#!" class="btn btn-primary-custom btn-primary-custom-round " onclick="requestClass(this)" data-id="'.$teacher->teacher_id.'" data-name="'.$teach_det->user->name.'">Request Class</a>';

                                                  }
                                                
                                                $data .='</div>
                                        
                                          </div>
                                   </div>
                                 
                                </div>
                            </a>
                        </div>
                        </div>';
                    }
                    $data .= $res->links('vendor.pagination.bootstrap-4') ;
                        
                 $data .='</div>';

} else {
  $data .= '<h4 class="text-center">Comming Soon</h4>';
}


return response()->json(['teacher'=>$data,'sub'=>$html,'success'=>true]);

    }



public function my_cards()
{
  
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
            return view('cards',compact('customer_cards'));

}

public function delete_card($cardId,$custId)
{
   $api_secret = env('STRIPE_SECRET');
         $api_key = env('STRIPE_KEY');
    $saved_cards = SaveCards::where('user_id',Auth::user()->id)->first();
        \Stripe\Stripe::setApiKey ($api_secret);

         $stripe = new \Stripe\StripeClient($api_secret);
         
    $card =      $stripe->customers->deleteSource($custId,$cardId);

      $customer =$stripe->customers->retrieve($saved_cards->customer_id);
            $customer_cards = $customer->sources;
            if(count($customer_cards->data) ==0){
              $data =  SaveCards::where('customer_id',$custId)->first();
              SaveCards::destroy($data->id);
            }
    

      return redirect()->back()->with('flash_success','Card is Deleted');
}


 public function privacy()
 {
   return view('privacy');
 }

 public function terms()
 {
   return view('term');
 } 
 public function cancellation_policy()
 {
   return view('cancellation_policy');
 } 

 public function payout_policy()
 {
   return view('payment_policy');
 }

public function teacher_demo()
{
   $follow = ''; 

        $teacher = Teacher::with('user')->where('teacher_id','1625556837vUB6ohaeL8')->first();
        if(!$teacher){
            abort(404);
        }
        $courses =Course::where('status',1)->where('user_id',$teacher->user_id)->where('date','>=',date('Y-m-d H:i:s'))->orderBy('date','asc')->take(10)->get();
            $followers = FollowTeacher::where('teacher_id',$teacher->id)->count();

    
        if(Auth::user()){
             $follow = FollowTeacher::where('user_id',Auth::user()->id)->where('teacher_id',$teacher->user_id)->first();
          if(Auth::user()->id == $teacher->user_id){
           $teacher->self = 1 ;
        }
          
        } else {
           $teacher->self = 0 ;
        }
       
            $students = StudentCourse::where('teacher_id',$teacher->id)->distinct('user_id')->where('status','done')->count('user_id');
        return view('teacher.teacher_demo',compact('teacher','follow','courses','students','followers'));
  
}

 public function test_mail(){

// $code ='789654';
// dd(now()->toDateTimeString());
// $mail = ['code' => $code];
//        Mail::send('mail.code', $mail, function($message) {
//              $message->to('yogesh@ebslon.com')->subject
//                 ('Email verification');

//         });

 $data = [
          'subject' => 'Request for class ',   
          'name' => 'Yogesh',   
          'date' => '27/05/2021 ',   
          'time' => '13:50 ',   
          'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",   
            ];

   Mail::send('mail.request_class', $data, function($message) {
             $message->to('yogesh@ebslon.com')->subject
                ('test');
           
          });
            dd('sent');




  $user = User::find(Auth::id());
  $user->assignRole('student');
  $user->update();
  dd('d');
  $cat_id = 42;
$course = Course::find(348);
      $timezone = timezone($course);
           $curr = currency_convert($course);
  
          $c_date = $timezone->date;
            $c_time = $timezone->time;
            $d =  teacherDetail($course->user_id);
            $category = Category::with('parentCategory')->find($cat_id);
$cat_name = '';
if($category){
  if($category->parent_id== null){

    $cat_id = $category->id;
    $cat_name = $category->name;

  } else {

    $cat_id= $category->parent_id;
    $cat_name =$category->parentCategory->name;

  }
}

    $details = [
        'subject' => 'New Course Arrived in '.$cat_name.'! Yocolab',
        'heading'=>'New Class on Yocolab!',
        'description'=>ucfirst($cat_name).' class. You can enroll for this class if it helps.',
        'id'=>$course->id,
        'instructor'=>Auth::user()->name,
        'title'=>$course->title,
        'image'=>$course->image,
        'date'=>$c_date,
        'time'=>$c_time,
        'rating'=>intval($d->rating),
        'price'=>$curr->html,
        'btn'=>'Enroll Now',
        'url'=>url('class/'.$course->slug),
        
    ];
$users = User::where('interest','like','%'.$cat_id.'%')->get();

     foreach ($users as $item) {
      


           \Mail::to('yogesh@ebslon.com')->send(new \App\Mail\FollowCourseMail($details));
          
            }

  $data = [
          'test' => 'test',   
            ];
            dd('sent');

   Mail::send('mail.invoice', $data, function($message) {
             $message->to('yogesh@ebslon.com')->subject
                ('test');
           
          });
   dd('send');
   Mail::send('mail.invoice', $data, function($message) {
             $message->to('Aman.popli@ebslon.com', 'Bhanu@yocolab.com')->subject
                ('test');
             $message->from('Bhanu@yocolab.com','test');
             $message->with('details', $this->details);
          });
   
 Mail::send('mail.general', $data, function($message) {
             $message->to('Aman.popli@ebslon.com', 'Bhanu@yocolab.com')->subject
                ('test');
             $message->from('Bhanu@yocolab.com','test');
          });
         
  Mail::send('mail.class', $data, function($message) {
             $message->to('Aman.popli@ebslon.com', 'Bhanu@yocolab.com')->subject
                ('test');
             $message->from('Bhanu@yocolab.com','test');
          });
  /*Mail::send('mail.class', $data, function($message) {
             $message->to('shrishti.sharma@ebslon.com')->subject
                ('test');
             $message->from('shrishti.sharma@ebslon.com','test');
          });*/
 }

  public function verified()
    {
          Auth::logout();
     
         Session::put('verified','Your Email is Verified Please login');
         return   redirect()->route('login')->with('verified','Your Email is Verified Please login');
    }




    public function card(Request $request)
    {

      $api_secret = env('STRIPE_SECRET');
      $api_key = env('STRIPE_KEY');

       $teacher = Teacher::where('user_id',Auth::user()->id)->first();
        \Stripe\Stripe::setApiKey ($api_secret);

        $stripe = new \Stripe\StripeClient($api_secret);






      if($request->isMethod('post')){

              try {
                $saved_cards = SaveCards::where('user_id',Auth::user()->id)->first();
                if($saved_cards){
                  $customer =$stripe->customers->createSource($saved_cards->customer_id,  ['source' =>$request->stripeToken]);
                } else {
                 $customer = \Stripe\Customer::create(array("source" => $request->stripeToken, "description" => Auth::user()->name." Teacher is added"));
                        $card = new SaveCards;
                        $card->user_id = Auth::user()->id;
                        $card->customer_id = $customer->id;
                        $card->save();
                }
                       return redirect('teacher/create-course')->with('success','We have added your card. You can create the class now! ');

        } catch ( \Exception $e ) {
          dd($e);
        }
        
         if($teacher->account_id){

           $acount_id = $teacher->account_id;

           $stripe->accounts->createExternalAccount(
                  $acount_id,
                  ['external_account' => $request->stripeToken]
                );

           return redirect()->back();

         } else {

            try {

            $account = \Stripe\Account::create([
                    'country' => 'SG',
                    'type' => 'express',
                    'email' => Auth::user()->email,
                    'capabilities' => [
                      'card_payments' => [
                        'requested' => true,
                      ],
                      'transfers' => [
                        'requested' => true,
                      ],
                    ],
                  ]);


          $acount_id = $account->id;
           session()->put('account', $acount_id);
   // dd($request->stripeToken);
           // $stripe->accounts->createExternalAccount(
           //        'acct_1IU8PYQhIMw3u0WB',
           //        ['external_account' => $request->stripeToken]
           //      );
          

                  } catch ( \Exception $e ) {
       
   
               return redirect()->back()->with( 'flash_error', $e );
            }
             return redirect()->back();

         }
      }
      return view('teacher.debit_card');
    }

    public function prefrence(Request $request)
    {
        $q = $request->q;
        $data =  new Prefrence;
        $data->search = $q;
        $data->save();
         return redirect()->back()->with('success','Your Query is submitted');

    }

        public function setCookie(Request $request) {
    
      $minutes = 42000000;
      $response = new \Illuminate\Http\Response($this->index());
    $response->withCookie(cookie('cookie', 'Cookie set', $minutes));

 	 return $response;

   }

    public function getCookie(Request $request) {
     
      $value = $request->cookie('cookie');
      echo $value;
   }

    public function readNotification($id){
     
       
       auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        return 1;
    }
    

    public function about()
    {
      return view('about');
    }


     public function contact()
    {
      return view('contact');
    }


  

     public function student_works()
    {
      return view('student_works');
    }


     public function student_faq()
    {
      $faqs = Faq::where('type','0')->where('status',1)->get();
     
      return view('student_faq',compact('faqs'));
    }

     public function instructor_works()
    {
      return view('instructor_works');
    }

     public function step_create_class()
    {
      return view('step_create_class');
    }

     public function instructor_faq()
    {
      $faqs = Faq::where('type','1')->where('status',1)->get();
      return view('instructor_faq',compact('faqs'));
    }

     public function become_instructor()
    {
      return view('become_instructor');
    }

    
         public function password(Request $request)
    {
        
        if($request->isMethod('post')){

 
            $request->validate([
                'new_pass' => 'required',
                'confirm_pass' => 'same:new_pass',
            ],['confirm_pass.same'=>'The confirm password and new password must match.']);;

            if(Hash::check($request->old_password, Auth::user()->password)) {
                $user = User::find(Auth::id());
               $user->password = Hash::make($request->new_pass);
               $user->update();

                // User::find(Auth::id())->update(['password' => Hash::make($request->new_pass)]);

                return redirect()->back()->with('success', 'Password is change successfully');
            }
            else {

                return redirect()->back()->with('error', 'Old password is worng');
            }
        }

        return view('password');
    }

    public function mail(Request $request)
{
    // dd($request->all());
      // return view('mail.invoice');
    return view('white_board');
}

public function page_400()
{
     return view('errors.404');
}

public function page_500()
{
     return view('errors.500');
}

function room(Request $request)
{

    return view('button');
$user =Auth::user();
      $c = Course::find(300);
        $timezone = timezone($c);
        $curr = currency_convert($c);
  $amount = $curr->price;
  $c_date = $timezone->date;
   $c_time = $timezone->time;
  $data =  teacherDetail(Auth::id());
 $symbol = $curr->currency->symbol;
  $d =  teacherDetail($c->user_id);
    $details = [
                            'subject' => 'New Course Arrived By'.$user->name.'! Yocolab',
                            'heading'=>'New Class on Yocolab!',
                            'description'=>'Your instructor '.ucfirst(Auth::user()->name).' has created a class. You can enroll for this class if it helps.',
                            'id'=>$c->id,
                            'instructor'=>Auth::user()->name,
                            'title'=>$c->title,
                            'image'=>$c->image,
                            'date'=>$c_date,
                            'time'=>$c_time,
                            'rating'=>intval($d->rating),
                            'price'=>$curr->html,
                            'btn'=>'Enroll Now',
                            'url'=>url('class/'.$c->slug),
                            
                        ];
   \Mail::to('yogesh@ebslon.com')->send(new \App\Mail\FollowCourseMail($details));
                                       // \Mail::to('yogesh@ebslon.com')->send(new \App\Mail\StudentCancel($details));
                                    
dd('send');

  // $details = [
  //                                           'subject' => 'Class Joined',
  //                                           'id'=>$course->id,
  //                                           'title'=>$course->title,
  //                                           'image'=>$course->image,
  //                                           'date'=>$data->created_at,
  //                                           'user'=>$user->name,
                                      
  //                                       ];
                                       
  //                                       \Mail::to('yogesh@ebslon.com')->send(new \App\Mail\CourseJoinedMail($details));

    //      $details = [
    //     'subject' => 'New Course Arrived By'.$user->name.'! Yocolab',
    //     'heading'=>'New Class on Yocolab!',
    //     'description'=>'Your instructor '.ucfirst(Auth::user()->name).' has created a class. You can enroll for this class if it helps.',
    //     'id'=>$data->id,
    //     'instructor'=>Auth::user()->name,
    //     'title'=>$data->title,
    //     'image'=>$data->image,
    //     'date'=>$c_date,
    //     'time'=>$c_time,
    //     'rating'=>$data->rating,
    //     'btn'=>'Enroll Now',
    //     'url'=>url('course/'.$data->id),
        
    // ];;


       // \Mail::to('yogesh@ebslon.com')->send(new \App\Mail\FollowCourseMail($details));
 //      $mail = [
 //        'subject' => ucfirst(Auth::user()->name).' has cancelled the enrollment for '.$course->title,
 //        'heading'=>'Oops !',
 //        'description'=>ucfirst(Auth::user()->name).' has decided to opt out of your class'.$course->title,
 //        'quote'=>'',
  
 //    ];


 // \Mail::to('yogesh@ebslon.com')->send(new \App\Mail\SendEmailTest($mail));
// $teacher_amount=0;
//    $t_total = round(($amount)/100,2);
//        $tfee = round((25*$amount)/100,2);
//        $teacher_amount = round((75*$teacher_amount*2)/100,2);
//     $details = [
//         'subject' => ' Earnings  For '.$course->title.' | Yocolab ',
//         'heading'=>' Awesome! Your class '.$course->title.' is successfully completed. Find your earnings below. ',
//         'description'=>'You have successfully completed class hosted by '.ucfirst(Auth::user()->name),
//         'id'=>$course->id,
//         'title'=>$course->title,
//         'image'=>$course->image,
//         'date'=>$c_date,
//         'time'=>$c_time,
//         'qty'=>2,
//         'amount'=>$t_total,
//         'cfee'=>$tfee,
//         'total'=>$teacher_amount,

        
//     ];
//     \Mail::to('yogesh@ebslon.com')->send(new \App\Mail\Earning($details));

   // $details = [
   //          'n_title' => 'Welcome to Yocolab',
   //          'title' => 'Congratulations '.$user->name.' ! You are an Instructor now!',
   //          'message' => 'Thank you for using yocolab.com!',
   //          'actionURL' => url('teacher/profile/'),
   //      ];
  
 
   //       \Mail::to('yogesh@ebslon.com')->send(new \App\Mail\BecomeTeacher );
    //        $details = [
    //     'subject' => 'Congrats! You have enrolled for '.$course->title.'! Yocolab',
    //     'heading'=>'Well Done '.ucfirst(Auth::user()->name).'!',
    //     'description'=>'You are successfully enrolled for this class hosted by '.ucfirst($course->user->name),
    //     'id'=>$course->id,
    //     'title'=>$course->title,
    //     'image'=>$course->image,
    //     'date'=>$c_date,
    //     'time'=>$c_time,
    //     'btn'=>'Join Class',
    //     'url'=>url('course/'.$course->id),
        
    // ];

    //     $mail = [
    //     'subject' => 'Your valuable feedback is important to us ',
    //     'heading'=>'Well Done '.ucfirst($user->name).'!',
    //     'description'=>'You have successfully completed class hosted by '.ucfirst(Auth::user()->name),
    //     'id'=>$course->id,
    //     'title'=>$course->title,
    //     'image'=>$course->image,
    //     'date'=>$c_date,
    //     'time'=>$c_time,
    //     'btn'=>'Leave Feedback',
    //     'url'=>url('/feedback/'.$course->video_class->id),
    //     'fee'=>$curr->html,
        
    // ];

    //    $mail = [
    //     'subject' => ucfirst(Auth::user()->name).'has cancelled the enrollment for '.$course->title,
    //     'heading'=>'Oops !',
    //     'description'=>'We are sorry,'.ucfirst(Auth::user()->name).' has cancelled his enrollment.',
    //     'quote'=>'',
  
    // ];
   // $details = [
   //      'subject' => ' Class Cancellation Summary for  '.$course->title.' | Yocolab ',
   //      'heading'=>'Below is your cancellation summary. ',
   //      'id'=>$course->id,
   //      'title'=>$course->title,
   //      'image'=>$course->image,
   //      'date'=>$c_date,
   //      'time'=>$c_time,
   //      'qty'=>2,
   //      'cfee'=>1,
   //      'total'=>0.50,
   //      'price'=>5,

        
   //  ];
   //  \Mail::to('yogesh@ebslon.com')->send(new \App\Mail\TeacherCancelMail($details));

// \Mail::to('aman.popli@ebslon.com')->send(new \App\Mail\SendEmailTest($mail));
     // \Mail::to('aman.popli@ebslon.com')->send(new \App\Mail\StudentCancel($details));
 // \Mail::to('aman.popli@ebslon.com')->send(new \App\Mail\FeedbackMail($mail));
   
    // \Mail::to($user->email)->send(new \App\Mail\StudentCancel($details));
   // return view('mail.teacher_cancel',compact('details'));
}


public function demo()
{
 return view('demo');
$name = Auth::user()->name;
    $course = Course::with('video_class')->where('id',184)->first();
    $key = $course->video_class->id; 
    $secret ='yocolab';
$course->url = url('/feedback/'.$course->video_class->id);
http://development.yocolab.com/feedback/189
    $payload = [
        'iss' => $key,
        'access' => 'student',
        'url' => $course->url,
        'exp' => strtotime('+24 hour'),
    ];
    $token =  \Firebase\JWT\JWT::encode($payload, $secret, 'HS256');
 $url = 'https://yocolab2.ebslon.com:8123/room/'.$course->title.'?token='.$token.'&id='.$course->video_class->id.'&name='.$name;

 return redirect()->away($url);


}

public function mobile_class()
{
    return view('mobile_course');
}


public function request_class(Request $request)
{
  $validated = $request->validate([
        'name' => 'required',
        'email' => 'email',
        'date' => 'date_format:d/m/Y',
        'time' => 'date_format:H:i',
    ]);

  $data = new RequestClass;
  $d = Teacher::with('user')->where('teacher_id',$request->teacher_id)->first();

  if(!$d){
    abort(404);
  }


  $data->name = $request->name;
  $data->teacher_id = $d->user_id;
  $data->email = $request->email;
  $data->description = $request->description;
  $data->date = $request->date;
  $data->time = $request->time;
  $data->save();

  $data = [
          'subject' => 'Request for class ',   
          'name' => $request->name,   
          'date' => $request->email,   
          'time' => $request->time,   
          'description' => $request->description,   
            ];

   Mail::send('mail.request_class', $data, function($message ) use ($d) {
             $message->to($d->user->email)->subject
                ('Request for class');
           
          });


     $details = [
            'n_title' => 'Welcome to Yocolab',
            'title' => 'Request for class',
            'message' => $request->name.' has requested a class',
            'actionURL' => url('teacher/request-class'),
        ];
  
        Notification::send($d->user, new SendNotification($details));
  return redirect()->back()->with('success','We have received your request and will add the relevant class for request');
}

public function blogs()
{ 

  $blogs = Blog::with('category')->whereStatus(1)->orderBy('created_at','desc')->paginate(4);
  return view('blogs',compact('blogs'));
}

public function category_blog($category_slug)
{ 

  $category = Category::where('slug',$category_slug)->where('parent_id',0)->first();

  if(!$category){
    abort(404);
  }

  $tblogs = Blog::with('category')->whereStatus(1)->get();
  $blogs = Blog::with('category')->where('category_id',$category->id)->paginate(4);
  return view('blogs',compact('blogs','tblogs'));
}

public function single_blog($slug)
{
    $blog= Blog::with('category')->where('slug',$slug)->first();
    if(!$blog){
      abort(404);
    }
    
  $tblogs = Blog::with('category')->whereStatus(1)->get();

    return view('single_blog',compact('blog','tblogs'));
}


public function become_an_instructor()
{

    return view('landing_instructor');
}





}



