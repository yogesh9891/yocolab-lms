<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


use App\Http\Controllers\FrontController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherFrontController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\VideoClassContoller;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\StudyMaterialController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\ZoomIdController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\BlogController;



use Illuminate\Foundation\Auth\EmailVerificationRequest;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|





if(checkMObileDevice()){
    if(url()->current() == url('/')){

    Route::get('/', [FrontController::class,'demo']);
    } else {

     Route::any('{query}', 
function() { return view('mobile_course'); })
->where('query', '.*');


    }
} else {

*/

Auth::routes(['verify' => true]);




Route::get('/', [FrontController::class,'index'])->name('home');
Route::get('/courses', [App\Http\Controllers\FrontController::class, 'courseAll']);
Route::get('course/{id}', [FrontController::class,'course']);
Route::get('class/{slug}', [FrontController::class,'course_slug'])->name('course');
Route::get('profile/{name}/{teacher_id}', [FrontController::class,'teacher_profile']);
Route::get('/instructors', [App\Http\Controllers\FrontController::class, 'instructors']);
Route::post('/get-instructor', [App\Http\Controllers\FrontController::class, 'get_instructor']);
Route::get('add_to_cart/{id}', [CartController::class, 'add_to_cart']);
Route::get('cart/{id}', [CartController::class, 'cartPage']);
Route::get('show-header-cart', [CartController::class, 'show_cart_header']);
Route::get('show-cart-table', [CartController::class, 'show_cart_table']);
Route::post('remove_cart_item/', [CartController::class, 'remove_cart_item']);
Route::get('/checkout', [CartController::class, 'checkout'])->middleware('auth');
Route::get('/test_job', [CartController::class, 'demo']);




Route::get('/400', [FrontController::class,'page_404']);

Route::get('/teacher-demo', [FrontController::class,'teacher_demo']);

Route::get('/500', [FrontController::class,'page_500']);
Route::get('/verified', [FrontController::class,'verified'])->name('verified');
// Route::post('/timezone', [FrontController::class,'timezone']);
Route::get('read-notification/{id}',[FrontController::class,'readNotification']);


Route::get('/fbtesting', [FrontController::class,'room']);
Route::get('/whiteboard', [FrontController::class,'mail']);

Route::post('india_checkout',[CartController::class,'indCheckout']);

Route::get('/return', [TeacherFrontController::class,'returnBank']);
Route::get('/refresh', [TeacherFrontController::class,'refreshBank']);

Route::get('privacy', [FrontController::class,'privacy']);
Route::get('class/{id}/{uid}',  function($id,$uid){
auth()->user()->unreadNotifications->where('id', $uid)->markAsRead();
   return redirect('class/'.$id);

});;

Route::get('course/{id}/{uid}',  function($id,$uid){
auth()->user()->unreadNotifications->where('id', $uid)->markAsRead();
   return redirect('course/'.$id);

});

Route::get('terms-and-conditions', [FrontController::class,'terms']);
Route::get('blogs', [FrontController::class,'blogs']);
Route::get('blog/{slug}', [FrontController::class,'single_blog']);
Route::get('blog/{category_slug}/category', [FrontController::class,'category_blog']);
Route::get('cancellation-policy', [FrontController::class,'cancellation_policy']);
Route::get('payout-policy', [FrontController::class,'payout_policy']);

Route::post('timezone', [FrontController::class,'timezone']);
Route::post('cookie', [FrontController::class,'setCookie']);
Route::post('/user-register', [App\Http\Controllers\HomeController::class, 'register']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);


// Route::get('/checkout', [App\Http\Controllers\FrontController::class, 'checkout']);

Route::match(['get','post'],'/password', [FrontController::class, 'password']);
Route::get('/create ', [CartController::class, 'create']);
Route::post('/create ', [CartController::class, 'create']);
Route::post('/checkout', [CartController::class, 'checkoutSrore'])->name('checkout.store');
Route::get('/class', [VideoClassContoller::class, 'createClass']);
Route::post('/get-category-course', [App\Http\Controllers\FrontController::class, 'getCategoryCourse']);

Route::post('/subcategory', [App\Http\Controllers\FrontController::class, 'fetchSubcategory'])->name('subcategory');


Route::match(['GET','POST'],'add_card', [FrontController::class,'card'])->middleware('auth');
Route::get('my-cards', [FrontController::class,'my_cards'])->middleware('auth');
Route::get('delete-card/{cardId}/{custId}', [FrontController::class,'delete_card'])->middleware('auth');
Route::get('leave-class/{id}', [FrontController::class,'leaveClass'])->middleware('auth');

Route::get('/about-us', [App\Http\Controllers\FrontController::class, 'about']);
Route::get('/contact-us', [App\Http\Controllers\FrontController::class, 'contact']);
Route::get('/blogs', [App\Http\Controllers\FrontController::class, 'blogs']);
Route::get('/student/how-it-works', [App\Http\Controllers\FrontController::class, 'student_works']);
Route::get('/student/faqs', [App\Http\Controllers\FrontController::class, 'student_faq']);
Route::get('/teacher/how-it-works', [App\Http\Controllers\FrontController::class, 'instructor_works']);
Route::get('/steps-to-create-class', [App\Http\Controllers\FrontController::class, 'step_create_class']);
Route::get('/teacher/faqs', [App\Http\Controllers\FrontController::class, 'instructor_faq']);
Route::get('/become-instructor', [App\Http\Controllers\FrontController::class, 'become_instructor']);
Route::post('/request-class', [App\Http\Controllers\FrontController::class, 'request_class']);



Route::get('/become-an-instructor', [App\Http\Controllers\FrontController::class, 'become_an_instructor']);




Route::get('auth/facebook', [LoginController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

Route::get('auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);



 
Route::get('send',[VideoClassContoller::class, 'notification']);


// Route::get('/email/verify', function () {
//     return view('auth.verify');
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect('/login');
// })->name('verification.verify');





Route::post('/material', [TeacherFrontController::class, 'material'])->name('material');
Route::post('/prefrence', [FrontController::class, 'prefrence'])->name('prefrence');





                                                            //Teacher 





Route::group(['prefix' => 'teacher', 'middleware' => ['auth', 'role:teacher']], function () {
// Route::prefix('teacher')->group(function () {

// Route::match(['get','post'],'/teacher-register', [TeacherFrontController::class, 'teacherRegister'])->name('teacher-register');
Route::match(['get','post'],'/create-course', [TeacherFrontController::class, 'createCourse'])->name('create-course');
Route::get('edit-course/{slug}', [TeacherFrontController::class,'editCourse']);
Route::get('/profile', [TeacherFrontController::class, 'profile']);
Route::get('profile/{id}',  function($id){
auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
   return redirect('teacher/profile');

});;

Route::match(['get','post'],'/edit', [TeacherFrontController::class, 'editProfile']);
Route::post('/course', [TeacherFrontController::class, 'submitCourse'])->name('submitCourse');
Route::post('/edit-course/{id}', [TeacherFrontController::class, 'editSubmitCourse'])->name('editCourse');
Route::get('bank-details', [TeacherFrontController::class,'bank']);
Route::get('update-bank', [TeacherFrontController::class,'updateBank']);
Route::get('dashboard', [TeacherFrontController::class,'dashboard']);
Route::get('dashboard/{id}',  function($id){
auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
   return redirect('teacher/dashboard');

});;
Route::get('my-courses', [TeacherFrontController::class,'my_courses']);
Route::get('my-followers', [TeacherFrontController::class,'followers']);

Route::match(['get','post'],'add-bank-account', [TeacherFrontController::class,'add_bank'])->name('add_bank');



Route::get('all-courses', [TeacherFrontController::class,'courses']);
Route::get('material', [TeacherFrontController::class,'study_material']);
Route::put('material/{id}/edit', [StudyMaterialController::class,'update'])->name('teacher.material.update');
Route::get('/delete-material/{id}', [TeacherFrontController::class, 'delete_material']);
Route::post('cancel-course', [TeacherFrontController::class,'cancelCourse']);
Route::get('my_account', [TeacherFrontController::class,'my_account']);
Route::get('my-earnings', [TeacherFrontController::class,'my_earning']);
Route::get('my-feedback', [TeacherFrontController::class,'my_feedback']);


Route::post('startArchive', [TeacherFrontController::class,'start_archive'])->name('startArchive');
Route::post('stopArchive', [TeacherFrontController::class,'stop_archive'])->name('stopArchive');;
Route::get('leave-class/{id}', [TeacherFrontController::class,'leave_class']);
Route::get('meeting-end/{slug}', [TeacherFrontController::class,'meeting_end']);
Route::get('request-class', [TeacherFrontController::class,'request_class']);
Route::get('/reschedule-course/{slug}', [TeacherFrontController::class, 'resheduleCourse'])->name('resheduleCourse');
Route::post('/reschedule-course', [TeacherFrontController::class, 'resheduleSubmitCourse'])->name('resheduleSubmitCourse');
Route::get('/request-class/{uid}',  function($uid){
auth()->user()->unreadNotifications->where('id', $uid)->markAsRead();
   return redirect('teacher/request-class');

});

});


                                                                        // Student





Route::group(['prefix' => 'user', 'middleware' => ['auth', 'role:student']], function () {


Route::get('/dashboard', [StudentController::class,'dashboard']);
Route::match(['get','post'],'/profile', [StudentController::class,'profile']);
Route::get('/my-course', [StudentController::class,'mycourse']);
Route::get('/course/{id}', [StudentController::class,'course']);
Route::get('my-orders', [StudentController::class,'orders']);
Route::get('my-bookmarks', [StudentController::class,'wishlist']);
Route::get('follow-teacher', [StudentController::class,'teachers']);
Route::get('follow-teacher/{type}/{name}/{t_id}', [StudentController::class,'follow']);
Route::get('send', [StudentController::class,'notice']);
Route::post('cancel-course', [StudentController::class,'cancelCourse']);
Route::post('report', [StudentController::class,'report']);
Route::get('test', [StudentController::class,'test']);

Route::get('/feedback/{slug}', [StudentController::class,'feedback']);
Route::post('/feedback', [StudentController::class,'submitFeedback'])->name('feedback');

Route::match(['get','post'],'/teacher-register', [StudentController::class, 'teacherRegister'])->name('teacher-register');


Route::get('dashboard/{id}',  function($id){
auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
   return redirect('user/dashboard');

});


Route::post('/interest', [StudentController::class,'intrest_submit']);


});

Route::get('feedback/{id}/{uid}', [StudentController::class,'feedbackCheck'])->middleware('auth'); 



Route::get('test_mail', [FrontController::class,'test_mail']); 




Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
 
 	Route::get('/', [AdminController::class, 'index'])->name('admin');

 	// Category Routes

        Route::resource('zoomId', ZoomIdController::class);
    Route::post('zoomIdStatus', [ZoomIdController::class,'zoomIdStatus'])->name('zoomId.status');

     Route::resource('blog', BlogController::class);
    Route::post('blogStatus', [BlogController::class,'blogStatus'])->name('blog.status');


        Route::resource('language', LanguageController::class);
    Route::post('languageStatus', [LanguageController::class,'languageStatus'])->name('language.status');

       Route::resource('country', CountryController::class);
    Route::post('countryStatus', [CountryController::class,'countryStatus'])->name('country.status');

 	Route::resource('category', CategoryController::class);
 	Route::post('categoryStatus', [CategoryController::class,'categoryStatus'])->name('category.status');
    Route::post('categoryTop', [CategoryController::class,'categoryTop'])->name('category.top');

 	Route::resource('material', StudyMaterialController::class);

 	Route::get('users', [AdminController::class, 'users']);
 	Route::get('teacher', [AdminController::class, 'teacher']);

 	Route::get('currency', [AdminController::class, 'currency']);
     Route::match(['get','post'],'course-reports', [AdminController::class, 'reports']);
     Route::match(['get','post'],'request-class', [AdminController::class, 'request_class']);
   Route::match(['get','post'],'course_query', [AdminController::class, 'course_query']);
   Route::match(['get','post'],'password', [AdminController::class, 'password']);

    Route::resource('category', CategoryController::class);
    Route::post('categoryStatus', [CategoryController::class,'categoryStatus'])->name('category.status');

        Route::resource('faq', FaqController::class);
    Route::post('faqStatus', [FaqController::class,'faqStatus'])->name('faq.status');



    Route::get('pending-course',[CourseController::class,'pending_course']);
    Route::get('complete-course',[CourseController::class,'complete_course']);

    Route::get('user/{id}/{block}',[AdminController::class,'blocked_user']);
    Route::delete('user/{id}/delete',[AdminController::class,'user_delete']);
    Route::delete('teacher/{id}/delete',[AdminController::class,'teacher_delete']);

            Route::get('stripe-reports',[AdminController::class,'stripe_reports']);
    Route::get('razorpay-pending-reports',[AdminController::class,'pending_reports']);
    Route::get('razorpay-complete-reports',[AdminController::class,'complete_reports']);
    Route::get('payment-complete',[AdminController::class,'payment_complete']);


 });





 Route::get("/join", [App\Http\Controllers\HomeController::class, 'join']);

 Route::get("/video", [App\Http\Controllers\HomeController::class, 'video']);


 Route::get("/live/{id}", [App\Http\Controllers\HomeController::class, 'live']);
Route::middleware('auth')->group(function () {

    // This route creates classes for teachers

    Route::get("/create_class", [App\Http\Controllers\HomeController::class, 'createClass'])
        ->name('create_class');


    Route::post("/create__zoom_class", [App\Http\Controllers\HomeController::class, 'createClass'])
        ->name('create_zoom_class');



    // This route is used by both teachers and students to join a class

    Route::get("/classroom/{slug}", [App\Http\Controllers\VideoClassContoller::class, 'showClassRoom'])->name('classroom')->middleware('auth');

});




Route::get('email-test', function(){

  

    $details['email'] = 'yogeshkunalsewa@gmail.com';

  

    dispatch(new App\Jobs\TestJob($details));

  

    dd('done');

});

Route::get('send-mail', function () {
   
    $details = [
        'subject' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    \Mail::to('yogesh@ebslon.com')->send(new \App\Mail\SendEmailTest($details));
   
    dd("Email is Sent.");
});


//

