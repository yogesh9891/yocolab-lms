<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\InstructorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Auth


Route::post('login', [AuthController::class, 'authenticate']);
Route::post('register', [AuthController::class, 'register']);
Route::post('verify', [AuthController::class, 'verfiyToken']);
Route::get('resend/{email}', [AuthController::class, 'resend']);
Route::post('change-password', [AuthController::class, 'changePassword']);
Route::post('logout', [AuthController::class, 'logout']);
Route::get('role', [AuthController::class, 'getAuthenticatedUser'])->middleware('jwt.verify');
Route::get('zoom/{course_id}', [AuthController::class, 'zoomClass'])->middleware('jwt.verify');




// Front

Route::get('language', [ApiController::class, 'language']);
Route::get('country', [ApiController::class, 'country']);
Route::get('category', [ApiController::class, 'category']);
Route::get('category/{slug}', [ApiController::class, 'category_show']);
Route::get('instructor-profile/{t_id}', [ApiController::class, 'instructor_profile']);
Route::get('class/{slug}', [ApiController::class, 'class_details']);
Route::get('instructors', [ApiController::class, 'instructors']);
Route::get('top-courses', [ApiController::class, 'top_courses']);
Route::get('today-courses', [ApiController::class, 'today_courses']);








	//Student

Route::group(['prefix' => 'student','middleware' => ['jwt.verify','role:student']], function() {
	
	Route::post('instructor-register', [StudentController::class, 'instructor_register']);

	Route::get('profile', [StudentController::class, 'user_profile']);
	Route::post('profile-update', [StudentController::class, 'user_update']);
	Route::get('dashboard', [StudentController::class, 'user_dashboard']);
	Route::get('my-courses', [StudentController::class, 'my_course']);
	Route::get('order-history', [StudentController::class, 'orders']);


	Route::get('wishlist', [StudentController::class, 'wishlist']);
	Route::get('wishlist/add/{course_id}', [StudentController::class, 'add_wishlist']);
	Route::get('wishlist/remove/{cart_id}', [StudentController::class, 'remove_wishlist']);



});



//Instructor

Route::group(['prefix' => 'instructor','middleware' => ['jwt.verify','role:teacher']], function() {

	Route::post('edit', [InstructorController::class, 'edit_profile']);
	Route::get('profile/', [InstructorController::class, 'profile']);

	Route::get('material/', [InstructorController::class, 'material']);
	Route::post('material/create', [InstructorController::class, 'material_store']);
	Route::get('material/{id}', [InstructorController::class, 'material_show']);
	Route::post('material/{id}', [InstructorController::class, 'material_update']);



	Route::post('create-class/', [InstructorController::class, 'create_class']);
	Route::get('class/{slug}/edit', [InstructorController::class, 'edit_class']);
	Route::post('class/{slug}/edit', [InstructorController::class, 'class_update']);
	
});