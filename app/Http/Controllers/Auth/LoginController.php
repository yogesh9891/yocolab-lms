<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Auth\Events\Verified;
use App\Models\User;
use Illuminate\Support\Facades\Date;
use Auth;
use Hash;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

      protected function authenticated()
    {
       \Auth::logoutOtherDevices(request('password'));
    }

      public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }


     public function handleFacebookCallback()
    {
        try {
        
                   $user = Socialite::driver('facebook')->user();


            $finduser = User::where('facebook_id', $user->id)->first();
     
            if($finduser){
                
                if($finduser->status==0){
                          return redirect()->back()->with('flash_error','Your are blocked by admin. Please contact  adimn');
                }
                Auth::login($finduser);
    
                return redirect('user/dashboard');
     
            }else{

                 $user_1 = User::where('email',$user->email)->first();

               if($user_1){
                $user_1->facebook_id = $user->id;
              
               $user_1->update();
               $user_1->assignRole('student');
                  Auth::login($user_1);
      
                return redirect('user/dashboard');
               }else{
        
               $newUser = new User;
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->facebook_id = $user->id;
                $newUser->password =  Hash::make($user->name.'@yocolab');
                $newUser->email_verified_at =date('Y-m-d H:i:s');
                   $newUser->save();
                     $newUser->assignRole('student');
              
                event(new Verified($newUser));
                event(new Registered($newUser));
                $details = ['name' =>$user->name];
                   \Mail::to($user->email)->send(new \App\Mail\StudentJoined($details));
                    Auth::login($newUser);
                return redirect('user/dashboard');
            }
        }
        } catch (InvalidStateException  $e) {
            // dd($e->getMessage());
            return redirect('/');
        }
    }



     public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

      public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
            // try {
            //        $user = Socialite::driver('google')->user();
            // } catch (InvalidStateException $e) {
            //         // $socialite = Socialite::driver($provider)->stateless()->user();
            //        $user = Socialite::driver('google')->stateless()->user();
            //     }

            // dd($user);

            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
             if($finduser->status==0){
                          return redirect()->back()->with('flash_error','Your are blocked by admin. Please contact  adimn');
                }
                Auth::login($finduser);
      
                return redirect('user/dashboard');
       
            }else{

                $user_1 = User::where('email',$user->email)->first();

               if($user_1){
                $user_1->google_id = $user->id;
              
               $user_1->update();
               $user_1->assignRole('student');
                  Auth::login($user_1);
      
                return redirect('user/dashboard');
               } else {
                $newUser = new User;
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->google_id = $user->id;
                $newUser->password =  Hash::make($user->name.'@yocolab');
                $newUser->email_verified_at = Date::now();

                $newUser->save();
                     $newUser->assignRole('student');
            
                event(new Verified($newUser));
                event(new Registered($newUser));
                $details = ['name' =>$user->name];
                   \Mail::to($user->email)->send(new \App\Mail\StudentJoined($details));
                    Auth::login($newUser);
  
                return redirect('user/dashboard');
               }
            }
      
        } catch (Exception $e) {
           return redirect('/');
        }
    }


}
