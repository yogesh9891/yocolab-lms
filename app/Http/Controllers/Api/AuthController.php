<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\VideoClass;
use App\Models\ZoomId;

use JWTAuth,Mail,Auth;
use App\Models\User;
use App\Models\Cart;


class AuthController extends Controller
{
 



    public function register(Request $request)
    {
        //Validate data
        $data = $request->only('fname','lname', 'email', 'password','cpassword','phone');
        $validator = Validator::make($data, [
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|max:50',
            'cpassword' => 'required|string|min:8|max:50|same:password',
            'phone'=>'numeric|digits:10',

         
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }
        $user = 'er';

       
        $user = User::create([
            'name' => $request->fname.' '.$request->lname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
        ]);
          $user->assignRole('student');

        $this->generateTwoFactorCode($user->email);


        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Otp send successfully to your email',
        ], Response::HTTP_OK);
    }
 

     public function validEmail($email) {
       return User::where('email', $email)->first();
    }

    public function authenticate(Request $request)
    {
       
        $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:8|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        //Request is validated
        //Crean token
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
        return $credentials;
            return response()->json([
                    'success' => false,
                    'message' => 'Could not create token.',
                ], 500);
        }
    
          if (Auth::attempt($credentials) && Auth::user()->hasVerifiedEmail()) {

                  // $request->session()->regenerate();

                //Token created, return with success response and jwt token
                return response()->json([
                    'success' => true,
                    'token' => $token,
                ]);
            // dd(Auth::user()->hasVerifiedEmail());

             } else {
                  return response()->json([
                    'success' => false,
                    'message' => 'Email are not verfied',
                ], 400);
             }

    }


    public function verfiyToken(Request $request)
    {

         $credentials = $request->only('email', 'code');

         $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'code' => 'required|numeric|digits:6'
        ]);

         //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        $user =$this->validEmail($request->email);
         if(!$user)
          { 
               return response()->json([
                        'success' => false,
                        'message' => 'User not found and Please register again',
                    ], 400);

          } else {
                  
                      if(!$user->two_factor_code) {
                        return response()->json([
                        'success' => false,
                        'message' => 'Code not found and Please register again',
                    ], 400);
                  }  

                   if($user->two_factor_expires_at->lt(now()))
                      {
                             return response()->json([
                            'success' => false,
                            'message' => ' code has expired. Please try again.',
                        ], 400);
                      } else {
                        if($request->input('code') == $user->two_factor_code)
                                {
                                        
                                    $user->two_factor_code = null;
                                    $user->email_verified_at = now();
                                    $user->update();
                                      return response()->json([
                                                'success' => true,
                                                'message' => 'verfied,Please login',
                                            ]);
                                                                        
                                } else {

                                     return response()->json([
                                            'success' => false,
                                            'message' => 'Code  you have entered does not match',
                                        ], 400);
                                }
                      }




                }
    }

     public function generateTwoFactorCode($email)
    {
       $user = $this->validEmail($email);
       if(!$user){
         return response()->json([
                            'success' => false,
                            'message' => 'User not found and Please register again',
                        ], 400);

       }
        $user->timestamps = false;
        $code =  rand(100000, 999999);
        $user->two_factor_code = $code;
       $mail = ['code' => $code];
         Mail::send('mail.code', $mail, function($message) use ($user) {
             $message->to($user->email)->subject
                ('Email verification');
                 });
        // $token = $
        $user->two_factor_expires_at = now()->addMinutes(10);
        $user->save();
    }

    public function resend($email)
    {
            $this->generateTwoFactorCode($email);
             return response()->json([ 'success' => true,  'message' => 'Code has been sent again',]);
    }


 

  
      public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        //Request is validated, do logout        
        try {
            JWTAuth::invalidate($request->token);
            Auth::logout();
            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

      public function changePassword(Request $request) {
        $user = User::whereEmail($request->email)->first();
        $user->update([
          'password'=>bcrypt($request->password)
        ]);
    
        return response()->json([
            'success' => true,
          'data' => 'Password changed successfully.'
        ],Response::HTTP_CREATED);
    } 


      public function get_user(Request $request)
    {
     dd('dsf');
        $validator = Validator::make($request, [
            'token' => 'required',
        ]);
 
        $user = JWTAuth::authenticate($request->token);
 
        return response()->json(['user' => $user]);
    }


        public function getAuthenticatedUser()
            {
                $user = User::find(Auth::id())->first();
                   if(!$user){
                        return response()->json([
                            'success' => false,
                            'message' => 'User not found and Please register again',
                        ], 400);

                     }

       
               $role =  '';

              if(Auth::user()->hasRole('teacher'))
                    {
                        $role = 'teacher';
                    } else {
                        $role = 'student';
                    }


                    return response()->json([
                            'success' => true,
                            'message' => 'User role',
                            'role'=>$role
                        ], 200);
            }
    
    
    
        public function zoomClass($course_id)
        {
           $zoon =VideoClass::where('course_id',$course_id)->firstOrFail();

           $zoom_app = ZoomId::findOrFail($zoon->zoom_app_id);
           $zoon->APP_ID = $zoom_app->app_id;
           $zoon->APP_SECRET = $zoom_app->secret;
                 return response()->json([
                            'success' => true,
                            'message' => 'Zoom role',
                            'role'=>$zoon
                        ], 200);
        }

}
