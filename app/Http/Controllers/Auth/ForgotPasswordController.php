<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\User;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
	
	public function apiresetpassword(Request $request){
		$data = Validator::make($request->all(), [
            'user_id' => 'required',
            'password' => 'required|confirmed',
        ]);
		if ($data->fails())
		{
			$errors = $data->errors();
			if ($errors->has('user_id')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('user_id')]); 
			}
			if ($errors->has('password')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('password')]); 
			}
			
		}
		if(User::where('id', $request->user_id)->exists()){
			$use = User::where('id', $request->user_id)->first();
			$obj = User::find($use->id);
			$obj->otp_expire_time = date('Y-m-d H:i:s', strtotime('1 hour'));
			$obj->email_otp = 0;
			$obj->password = Hash::make($request->password);
			$obj->save();
			return response()->json([ 'success'=> true, 'message' => 'Password Reset successfully.', 'user'=>$obj]);
		}else{
			return response()->json([ 'success' => false, 'errors' => 'User not exist in our record']); 
		}
	}
	public function apiverifyotp(Request $request){
		$data = Validator::make($request->all(), [
            'email' => 'required|max:255',
            'otp' => 'required|max:255',
        ]);
		if ($data->fails())
		{
			$errors = $data->errors();
			if ($errors->has('email')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('email')]); 
			}
			if ($errors->has('otp')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('otp')]); 
			}
		}
		
		if(User::where('email', $request->email)->exists()){
			if(User::where('email', $request->email)->where('email_otp', $request->otp)->exists()){
				$my_time = date('Y-m-d H:i:s');
				$re = User::where('email', $request->email)->where('email_otp', $request->otp)->first();
				if (strtotime($re->otp_expire_time) >= strtotime($my_time)) {
					return response()->json([ 'success'=> true, 'message' => 'Otp verified successfully', 'user'=>$re]); 
				}else{
					return response()->json([ 'success' => false, 'errors' => 'Otp is expired']); 
				}
			}else{
				return response()->json([ 'success' => false, 'errors' => 'Your OTP is incorrect']); 
			}
		}else{
			return response()->json([ 'success' => false, 'errors' => 'Email not exist in our record']); 
		}
	}
	public function apiforgotpassword(Request $request){
		$data = Validator::make($request->all(), [
            'email' => 'required|max:255',
        ]);
		if ($data->fails())
		{
			$errors = $data->errors();
			if ($errors->has('email')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('email')]); 
			}
		}
		
		if(User::where('email', $request->email)->exists()){
			$use = User::where('email', $request->email)->first();
			$otp = rand ( 10000 , 99999 );
			$replace = array('{otp}', '{siteurl}', '{last_name}', '{year}');					
			$replace_with = array($otp, \URL::to('/'));
			$obj = User::find($use->id);
			$obj->otp_expire_time = date('Y-m-d H:i:s', strtotime('1 hour'));
			$obj->email_otp = $otp;
			$obj->save();
			$this->send_email_template($replace, $replace_with, 'forgot-password', $request->email);
			return response()->json([ 'success'=> true, 'message' => 'Email send successfully to your mail.', 'user'=>$obj]); 
		}else{
			
				return response()->json([ 'success' => false, 'errors' => 'Email not exist in our record']); 
			
		}
		
	}
}
