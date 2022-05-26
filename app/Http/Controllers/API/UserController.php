<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hash;
use Config;
use App\User;
class UserController extends Controller{
	
	public function __construct()
    {
    }
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
     	$obj	= 	User::find(@auth('api')->user()->id);
		    
	    	$result['first_name']   = $obj->first_name;
            $result['last_name'] = $obj->last_name;
            $result['email']     = $obj->email;
            $result['phone']   = $obj->phone;
            $result['location']     = $obj->city;
            $result['profile_img']     = $obj->profile_img;
            $result['created_at']  = $obj->created_at;
            $result['updated_at']  = $obj->updated_at;
                
                
			if($result){
				return response()->json([ 'success' => true, 'message' => 'User Profile', 'result'=>$result ]); 
			}else{
				return response()->json([ 'success' => false, 'errors' => 'Please try again']); 
			}

	}  
	
	public function updatepic(Request $request){
		$data = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,jpg,png,gif',
        ]);
		if ($data->fails())
		{
			$errors = $data->errors();
			if ($errors->has('image')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('image')]); 
			}
			
		}

		
		if($request->hasfile('image')) 
		{	
			$profile_img = $this->uploadFile($request->file('image'), Config::get('constants.profile_imgs'));
		}
		else
		{
			$profile_img = NULL;
		}	
		$obj = User::find(@auth('api')->user()->id);
		$obj->profile_img			=	@$profile_img;
			$saved				=	$obj->save(); 
			
		if($saved){
				return response()->json([ 'success' => true, 'message' => 'Image updated successfully', 'user'=>$obj,'image_url' => \URL::to('/public/img/profile_imgs/') ]); 
			}else{
				return response()->json([ 'success' => false, 'errors' => 'Please try again']); 
			}
	}
	public function update(Request $request)
    {   
      
		$data = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email,'.@auth('api')->user()->id,
        ]);
       
		if ($data->fails())
		{
			$errors = $data->errors();
			//print_r($errors);
			if ($errors->has('first_name')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('first_name')]); 
			}
			if ($errors->has('last_name')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('last_name')]); 
			}
			if ($errors->has('email')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('email')]); 
			}
			
		}else{
			$obj = User::find(@auth('api')->user()->id);
			$obj->first_name = $request->first_name;
			$obj->last_name = $request->last_name;
			$obj->phone = $request->phone;
			$obj->email = $request->email;
			$obj->country = $request->country;
			$obj->state = $request->state;
			$obj->city = $request->city;
			$obj->address = $request->address;
			$obj->zip = $request->zip;
			$saved = $obj->save();
			if($saved){
				return response()->json([ 'success' => true, 'message' => 'Profile updated successfully', 'user'=>$obj ]); 
			}else{
				return response()->json([ 'success' => false, 'errors' => 'Please try again']); 
			}
		}
	}
	 public function updateProfilePic(Request $request)
    {
 
       $validator = Validator::make($request->all(), 
              [ 
              'profile_img' => 'required|mimes:jpeg,jpg,png,gif',
             ]);   
 
    if ($validator->fails()) {          
            return response()->json(['error'=>$validator->errors()], 401);                        
         }  
 
  
        if ($files = $request->file('profile_img')) {
             
            
            $admin=User::find(@auth('api')->user()->id);
                $data=$request->all();
                
                if($request->hasFile('profile_img')) {
                    $file = $request->file('profile_img');
                    $fileName = time() . '.'.$file->getClientOriginalExtension();
                    $destinationPath = public_path('/assets/images');
                    $file->move($destinationPath, $fileName);
                    $admin->profile_img = $fileName;
                }
                $admin->save();
            return response()->json([
                "success" => true,
                "message" => "Profile Pic Successfully Uploaded",
                "profile_img" => \URL::to('public/assets/images/'.$fileName)
            ]);
  
        }
 
  
    }
}