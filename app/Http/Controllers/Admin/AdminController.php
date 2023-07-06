<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Prefrence;
use App\Models\Report;
use App\Models\Teacher;
use App\Models\RequestClass;
use App\Models\Earning;

use Hash,Auth;

class AdminController extends Controller
{
    public function index()
    {
    	return view('admin.dashboard');
    }

    public function users()
    {
    	$users = User::where('is_admin',0)->where('is_teacher',0)->orderBy('id','desc')->get();
    	return view('admin.user.index',compact('users'));
    }

    public function teacher()
    {
    	$teachers = User::where('is_admin',0)->where('is_teacher',1)->orderBy('id','desc')->get();
    	return view('admin.teacher.index',compact('teachers'));
    }

    public function currency()
    {
    	return view('admin.currency');
    }

    public function course_query(Request $request)
    {
       $datas = Prefrence::get();
       if($request->isMethod('post')){

            $id = $request->id;
            Prefrence::destroy($id);
            return redirect()->back()->with('flash_message','Quuery is Deleted');

       }
        return view('admin.course_query',compact('datas'));
    }

    public function reports(Request $request)
    {
      $datas =Report::with('course')->get();
       if($request->isMethod('post')){

            $id = $request->id;
            Report::destroy($id);
            return redirect()->back()->with('flash_message','Quuery is Deleted');

       }
       return view('admin.course_reports',compact('datas'));

    }

      public function request_class(Request $request)
    {
      $datas =RequestClass::get();
       if($request->isMethod('post')){

            $id = $request->id;
            RequestClass::destroy($id);
            return redirect()->back()->with('flash_message','Quuery is Deleted');

       }
       return view('admin.request_class',compact('datas'));

    }

    function blocked_user($id)
    {
        $user = User::find($id);
        if($user->status == 1){

        $user->status = 0;
        $user->save();
           return redirect()->back()->with('flash_message','User  is Bocked');
        } else {

        $user->status = 1;
        $user->save();
           return redirect()->back()->with('flash_message','User is Unblocked');
        }
    }

      function user_delete($id)
    {
        $user = User::destroy($id);

           return redirect()->back()->with('flash_message','User  is deleted successfully');
       
    }

     function teacher_delete($id)
    {
        $teacher = Teacher::find($id);
        $user = User::find($teacher->user_id);
        $user->removeRole('teacher');
        $teacher->destroy($id);
        $user->is_teacher =0;
        $user->save();
        return redirect()->back()->with('flash_message','Teacher  is deleted successfully');
       
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

        return view('admin.password');
    }

      public function stripe_reports()
    {
           
       $reports = Earning::where('type',0)->where('status','complete')->get();
            return view('admin.reports.stripe',compact('reports'));
    }


    public function pending_reports()
    {

       $reports = Earning::where('type',1)->where('status','pending')->get();

            return view('admin.reports.pending',compact('reports'));
    }

    public function complete_reports()
    {
       $reports = Earning::where('type',1)->where('status','complete')->get();
            return view('admin.reports.complete',compact('reports'));

    }

    public function payment_complete()
    {
      
         $reports = Earning::where('type',1)->where('status','pending')->get();
         if($reports){

        foreach ($reports as $value) {
           $teacher = Teacher::where('user_id',$value->user_id)->first();
           $account_id = $teacher->account_id;
           if($account_id){

                // $res = Http::withBasicAuth(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'))->get('https://api.razorpay.com/v1/fund_accounts/'.$account_id);
                $res = Http::withBasicAuth(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'))->post('https://api.razorpay.com/v1/payouts', [
                                            'account_number' => '4564568538997213',
                                            'fund_account_id' => $account_id,
                                            'amount' => $value->total*100,
                                            'currency'=>'INR',
                                            'mode'=>'NEFT',
                                            'purpose'=>'vendor bill',

                                          
                                        ]);

                $result = $res->json();

                //  if($result['error']){
                //     return redirect()->back()->with('success',$result['error']['description']) ;
                // }
                // dd($result);
                if($result['status'] != 'rejected'){
                    $value->status ='complete';
                    $value->update();
                } else {
                     return redirect()->back()->with('success','Please Try again after sometime') ;
                }


           }
        }

        return redirect()->back()->with('success','Payment are processed') ;
     } else {
        return redirect()->back()->with('success','NO payment') ;
     }
    }


}
