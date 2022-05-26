<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hash;
use Config;
use DB;
use Illuminate\Support\Facades\Auth;
use App\MyAd;
use App\Message;
use App\Favoriteads;
use App\Category;
class AdsController extends Controller{
	
	public function __construct()
    {
    }
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function getcountries(Request $request){
		$countries = \App\Country::select('id','name')->orderby('name', 'ASC')->get();
		return response()->json([ 'success' => true, 'countries' => $countries ]); 
	} 
	public function getcategories(Request $request){
		$categories = DB::table('categories')->select('id','title','slug')->orderby('title', 'ASC')->get();
		return response()->json([ 'success' => true, 'categories' => $categories ]); 
	} 
	
	public function getstate(Request $request)
	{
		$countryid = $request->countryid;
		$state = \App\State::select('id','name')->where('country_id',$countryid)->get();
		
		return response()->json([ 'success' => true, 'states' => $state ]);  
	} 
	public function getcity(Request $request)
	{
		$stateid = $request->stateid;
		$city = \App\City::select('id','name')->where('state_id',$stateid)->get();
		 return response()->json([ 'success' => true, 'cities' => $city ]);  
	}
	
	public function getamenties(Request $request)
	{
		$Amenities = \App\Amenities::select('id','title')->get();
		 return response()->json([ 'success' => true, 'amenities' => $Amenities ]);  
	}
    public function index(Request $request)
    {   
		$a = $request->user();
		$a['image_url'] = \URL::to('/public/img/profile_imgs/');
	//	$arraymerge = array_merge($a, $b);
       return $a;
	}  
	
	public function addpost(Request $request){
	    
		$data = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'price' => 'required',
            'description' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);
		if ($data->fails())
		{
			$errors = $data->errors();
			//print_r($errors);
			if ($errors->has('title')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('title')]); 
			}
			if ($errors->has('price')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('price')]); 
			}
			if ($errors->has('description')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('description')]); 
			}
			if ($errors->has('name')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('name')]); 
			}
			if ($errors->has('email')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('email')]); 
			}
			if ($errors->has('phone')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('phone')]); 
			}
		}else{
			$requestData 		= 	$request->all();
			
			$ameniti = '';
			$amenities = @$requestData['amenities'];
		/* 	for($i=0; $i<count($amenities); $i++){
				$ameniti .= $amenities[$i].',';
			} */
			$obj				= 	new MyAd;
			$obj->category	=	@$requestData['category'];
		//	$obj->sub_category	=	@$requestData['sub_category'];
			$obj->user_id	=	@auth('api')->user()->id;
		
			$obj->title	=	@$requestData['title'];
			$obj->price	=	@$requestData['price'];
			$obj->tags	=	@$requestData['tags'];
			$obj->description	=	@$requestData['description'];
			$obj->country_id	=	@$requestData['country_id'];
			$obj->state_id	=	@$requestData['state_id'];
			$obj->city_id	=	@$requestData['city_id'];
			$obj->str_address	=	@$requestData['str_address'];
			$obj->status	=	1;
			$obj->pincode	=	@$requestData['pin_code'];
			$obj->beds	=	@$requestData['no_of_beds'];
			$obj->halls	=	@$requestData['no_of_hall'];
			$obj->bathroom	=	@$requestData['no_of_bathroom'];
			$obj->space	=	@$requestData['space'];
			$obj->year	=	@$requestData['year'];
			$obj->floors	=	@$requestData['no_floor'];
			$obj->contact_name	=	@$requestData['name'];
			$obj->contact_email	=	@$requestData['email'];
			$obj->contact_phone	=	@$requestData['phone'];
			$obj->amenities	=	$amenities;
			if ($request->hasFile('image_1')) :
					$photos_1 = $this->uploadFile($request->file('image_1'), Config::get('constants.cmspage'));
			else:
					$photos_1 = '';
			endif;
		
			if ($request->hasFile('image_2')) :
					$photos_2 = $this->uploadFile($request->file('image_2'), Config::get('constants.cmspage'));
			else:
					$photos_2 = '';
			endif;
			if ($request->hasFile('image_3')) :
					$photos_3 = $this->uploadFile($request->file('image_3'), Config::get('constants.cmspage'));
			else:
					$photos_3 = '';
			endif;
				if ($request->hasFile('image_4')) :
					$photos_4 = $this->uploadFile($request->file('image_4'), Config::get('constants.cmspage'));
			else:
					$photos_4 = '';
			endif;
		
			if ($request->hasFile('image_5')) :
					$photos_5 = $this->uploadFile($request->file('image_5'), Config::get('constants.cmspage'));
			else:
					$photos_5 = '';
			endif;
			if ($request->hasFile('image_6')) :
					$photos_6 = $this->uploadFile($request->file('image_6'), Config::get('constants.cmspage'));
			else:
					$photos_6 = '';
			endif;
				if ($request->hasFile('image_7')) :
					$photos_7 = $this->uploadFile($request->file('image_7'), Config::get('constants.cmspage'));
			else:
					$photos_7 = '';
			endif;
			
			$obj->photos			=   @$photos_1;
			$obj->photos1			=	@$photos_2;
			$obj->photos2			=	@$photos_3;
			$obj->photos3			=   @$photos_4;
			$obj->photos4			=	@$photos_5;
			$obj->photos5			=	@$photos_6;
			$obj->photos6			=   @$photos_7;
			$saved				=	$obj->save();  
			
			if($saved){
				return response()->json([ 'success' => true, 'message' => 'Post Added successfully', 'ads'=>$obj ]); 
			}else{
				return response()->json([ 'success' => false, 'errors' => 'Please try again']); 
			}
		}
	}
	
	public function updatepost(Request $request){
	    
		$data = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required|max:255',
            'price' => 'required',
            'description' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);
			if ($data->fails())
		{
			$errors = $data->errors();
			//print_r($errors);
			if ($errors->has('id')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('id')]); 
			}
			if ($errors->has('title')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('title')]); 
			}
			if ($errors->has('price')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('price')]); 
			}
			if ($errors->has('description')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('description')]); 
			}
			if ($errors->has('name')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('name')]); 
			}
			if ($errors->has('email')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('email')]); 
			}
			if ($errors->has('phone')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('phone')]); 
			}
		}else{
			$requestData 		= 	$request->all();
		
	     	$ameniti = '';
			$amenities = @$requestData['amenities'];
			// $amenities = explode(",",$requestData['amenities']);
			// print_r($amenities);die;
			// for($i=0; $i<count($amenities); $i++){
			// 	$ameniti .= $amenities[$i].',';
			// }
			
			$obj =  MyAd::where('id', $request->id)->first(); 
		    
			$obj->category	=	@$requestData['category'];
			$obj->user_id	=	@auth('api')->user()->id;
			$obj->title	=	@$requestData['title'];
			$obj->price	=	@$requestData['price'];
			$obj->tags	=	@$requestData['tags'];
			$obj->description	=	@$requestData['description'];
			$obj->country_id	=	@$requestData['country_id'];
			
			$obj->state_id	=	@$requestData['state_id'];
			$obj->city_id	=	@$requestData['city_id'];
			$obj->str_address	=	@$requestData['str_address'];
			$obj->status	=	1;
			$obj->pincode	=	@$requestData['pin_code'];
			$obj->beds	=	@$requestData['no_of_beds'];
			$obj->halls	=	@$requestData['no_of_hall'];
			$obj->bathroom	=	@$requestData['no_of_bathroom'];
			$obj->space	=	@$requestData['space'];
			$obj->year	=	@$requestData['year'];
			$obj->floors	=	@$requestData['no_floor'];
			$obj->contact_name	=	@$requestData['name'];
			$obj->contact_email	=	@$requestData['email'];
			$obj->contact_phone	=	@$requestData['phone'];
			$obj->amenities	=	@rtrim($ameniti,',');
// 			if ($request->hasFile('image')) :
// 				$obj->photos = $this->uploadFile($request->file('image'), Config::get('constants.cmspage'));
// 			endif;
// 			if ($request->hasFile('image_2')) :
// 				$obj->photos1 = $this->uploadFile($request->file('image_2'), Config::get('constants.cmspage'));
// 			endif;
// 			if ($request->hasFile('image_3')) :
// 				$obj->photos2 = $this->uploadFile($request->file('image_3'), Config::get('constants.cmspage'));
// 			endif;
            if ($request->hasFile('image_1')) :
					$photos_1 = $this->uploadFile($request->file('image_1'), Config::get('constants.cmspage'));
			else:
					$photos_1 = '';
			endif;
		
			if ($request->hasFile('image_2')) :
					$photos_2 = $this->uploadFile($request->file('image_2'), Config::get('constants.cmspage'));
			else:
					$photos_2 = '';
			endif;
			if ($request->hasFile('image_3')) :
					$photos_3 = $this->uploadFile($request->file('image_3'), Config::get('constants.cmspage'));
			else:
					$photos_3 = '';
			endif;
			if ($request->hasFile('image_4')) :
					$photos_4 = $this->uploadFile($request->file('image_4'), Config::get('constants.cmspage'));
			else:
					$photos_4 = '';
			endif;
		
			if ($request->hasFile('image_5')) :
					$photos_5 = $this->uploadFile($request->file('image_5'), Config::get('constants.cmspage'));
			else:
					$photos_5 = '';
			endif;
			if ($request->hasFile('image_6')) :
					$photos_6 = $this->uploadFile($request->file('image_6'), Config::get('constants.cmspage'));
			else:
					$photos_6 = '';
			endif;
			if ($request->hasFile('image_7')) :
					$photos_7 = $this->uploadFile($request->file('image_7'), Config::get('constants.cmspage'));
			else:
					$photos_7 = '';
			endif;
		
			$obj->photos			=   @$photos_1;
			$obj->photos1			=	@$photos_2;
			$obj->photos2			=	@$photos_3;
			$obj->photos3			=	@$photos_4;
			$obj->photos4			=	@$photos_5;
			$obj->photos5			=	@$photos_6;
			$obj->photos6			=	@$photos_7;
		
			$saved				=	$obj->save();  
			
			if($saved){
				return response()->json([ 'success' => true, 'message' => 'Post update successfully', 'ads'=>$obj ]); 
			}else{
				return response()->json([ 'success' => false, 'errors' => 'Please try again']); 
			}
		}
	}
	
	public function viewpost(Request $request){
		$data = Validator::make($request->all(), [
            'id' => 'required',
        ]);
		if ($data->fails())
		{
			$errors = $data->errors();
			//print_r($errors);
			if ($errors->has('id')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('id')]); 
			}
		}else{
			$obj				=  MyAd::where('id', $request->id)->with(['countrydata', 'statedata', 'citydata'])->first(); 
			if($obj){ 
			$e = explode(',', $obj->amenities);
			$s = [];
			foreach($e as $u){
				$le = \App\Amenities::where('id',$u)->first();
				if($le!=null){
				    $s[]= $le;
				}
			}
				$dede = Favoriteads::where('ads_id', $obj->id)->first();
			
				if(!empty($dede)){
				    $favorite_id = $dede->id;
				    $is_favorite = 'Yes';
				}else{
				   $is_favorite = 'No'; 
				}
				$a = array(
				    "favorite_id" => !empty($favorite_id)?$favorite_id:'',
				    "is_favorite" => $is_favorite,
					"id" => $obj->id,
					"category"=> $obj->category,
					"user_id"=> $obj->user_id,
					"sub_category"=> $obj->sub_category,
					"title"=> $obj->title,
					"price"=> $obj->price,
					"tags"=> $obj->tags,
					"description"=> $obj->description,
					"photos"=> $obj->photos,
					"photos1"=> $obj->photos1,
					"photos2"=> $obj->photos2,
					"photos3"=> $obj->photos3,
					"photos4"=> $obj->photos4,
					"photos5"=> $obj->photos5,
					"photos6"=> $obj->photos6,
					"country_id"=> $obj->country_id,
					"state_id"=> $obj->state_id,
					"city_id"=> $obj->city_id,
					"str_address"=> $obj->str_address,
					"status"=> $obj->status,
					"type"=> $obj->type,
					"contact_name"=> $obj->contact_name,
					"contact_email"=> $obj->contact_email,
					"contact_phone"=> $obj->contact_phone,
					"pincode"=> $obj->pincode,
					"beds"=> $obj->beds,
					"halls"=> $obj->halls,
					"bathroom"=> $obj->bathroom,
					"space"=> $obj->space,
					"year"=> $obj->year,
					"floors"=> $obj->floors,
					
					"amenities"=>$s,
				);
				$category	=  DB::table('categories')->where('id', $obj->category)->first(); 
				if($category!=null){
					   $a["categorydata"]=$category; 
					}else{
					    $a["categorydata"]=array('title' =>"");
					}
						if($obj->countrydata!=null){
					   $a["countrydata"]= $obj->countrydata; 
					}else{
					    $a["countrydata"]=array('name' =>"");
					}
					if($obj->statedata!=null){
					   $a["statedata"]= $obj->statedata; 
					}else{
					    $a["statedata"]=array('name' =>"");
					}
					if($obj->citydata!=null){
					   $a["citydata"]=$obj->citydata; 
					}else{
					    $a["citydata"]=array('name' =>"");
					}
				return response()->json([ 'success' => true, 'ads'=>$a ]); 
			}else{
				return response()->json([ 'success' => false, 'errors' => 'Record not found']); 
			}
		}
	}
	public function viewallads(Request $request){
		$objs=  MyAd::where('status',1)->with(['countrydata', 'statedata', 'citydata'])
		             ->orderby('created_at', 'DESC')
		             ->paginate(50); 
		            
			if($objs){ 
				$a = array();			
			foreach($objs as $key=> $obj){
				$user = \App\User::select('first_name', 'last_name', 'email', 'phone', 'country', 'state', 'city', 'address', 'zip', 'profile_img')->where('id',$obj->user_id)->first();
			$e = explode(',', $obj->amenities);
			$s = [];
			foreach($e as $u){
				$le = \App\Amenities::where('id',$u)->first();
				if($le!=null){
				    $s[]= $le;
				}
			}
			
				$dede = Favoriteads::where('ads_id', $obj->id)->first();
			
				if(!empty($dede)){
				    $favorite_id = $dede->id;
				    $is_favorite = 'Yes';
				}else{
				   $is_favorite = 'No'; 
				}
				$a[] = array(
				    "favorite_id" => !empty($favorite_id)?$favorite_id:'',
				    "is_favorite" => $is_favorite,
					"id" => $obj->id,
					"category"=> $obj->category,
					"user_id"=> $obj->user_id,
					"sub_category"=> $obj->sub_category,
					"title"=> $obj->title,
					"price"=> $obj->price,
					"tags"=> $obj->tags,
					"description"=> $obj->description,
					"photos"=> $obj->photos,
					"photos1"=> $obj->photos1,
					"photos2"=> $obj->photos2,
					"country_id"=> $obj->country_id,
					"state_id"=> $obj->state_id,
					"city_id"=> $obj->city_id,
					"str_address"=> $obj->str_address,
					"status"=> $obj->status,
					"type"=> $obj->type,
					"contact_name"=> $obj->contact_name,
					"contact_email"=> $obj->contact_email,
					"contact_phone"=> $obj->contact_phone,
					"pincode"=> $obj->pincode,
					"beds"=> $obj->beds,
					"halls"=> $obj->halls,
					"bathroom"=> $obj->bathroom,
					"space"=> $obj->space,
					"year"=> $obj->year,
					"floors"=> $obj->floors,
					 
					
				
					"amenities"=> $s,
					"userinfo"=> $user,
					
				);
			    $category	=  DB::table('categories')->where('id', $obj->category)->first(); 
				if($category!=null){
					   $a[$key]["categorydata"]=$category; 
					}else{
					    $a[$key]["categorydata"]=array('title' =>"");
					}
						if($obj->countrydata!=null){
					   $a[$key]["countrydata"]= $obj->countrydata; 
					}else{
					    $a[$key]["countrydata"]=array('name' =>"");
					}
					if($obj->statedata!=null){
					   $a[$key]["statedata"]= $obj->statedata; 
					}else{
					   $a[$key]["statedata"]=array('name' =>"");
					}
					if($obj->citydata!=null){
					   $a[$key]["citydata"]=$obj->citydata; 
					}else{
					   $a[$key]["citydata"]=array('name' =>"");
					}
				
				
			}
			
			
				return response()->json([ 'success' => true, 'ads'=>$a ]); 
			}else{
				return response()->json([ 'success' => false, 'errors' => 'Record not found']); 
			}
	}
	
// 	public function searchAds(Request $request){	

// 		$objs=  MyAd::where(['status'=>1])->where(function($query){
// 			$cities	=  array_column(DB::table('cities')->select('id')->where('name', request()->query('city'))->get()->toArray(),'id');
// 			return $query
// 			->whereIn('city_id',$cities)
// 			->orWhere('pincode',request()->query('pincode'));
//         })->with(['countrydata', 'statedata', 'citydata'])->orderby('created_at', 'DESC')->paginate(50); 
		
// 			if($objs){ 
// 				$a = array();			
// 			foreach($objs as $key=> $obj){
// 				$user = \App\User::select('first_name', 'last_name', 'email', 'phone', 'country', 'state', 'city', 'address', 'zip', 'profile_img')->where('id',$obj->user_id)->first();
// 				$e = explode(',', $obj->amenities);
// 			$s = ''; 
// 			foreach($e as $u){
// 				$le = \App\Amenities::where('id',$u)->first();
// 					if($le!=null){
// 				$s .= $le->title.',';
// 				}
// 			}
			
// 				$a[$key] = array(
// 					"id" => $obj->id,
// 					"category"=> $obj->category,
// 					"user_id"=> $obj->user_id,
// 					"sub_category"=> $obj->sub_category,
// 					"title"=> $obj->title,
// 					"price"=> $obj->price,
// 					"tags"=> $obj->tags,
// 					"description"=> $obj->description,
// 					"photos"=> $obj->photos,
// 					"photos1"=> $obj->photos1,
// 					"photos2"=> $obj->photos2,
// 					"country_id"=> $obj->country_id,
// 					"state_id"=> $obj->state_id,
// 					"city_id"=> $obj->city_id,
// 					"str_address"=> $obj->str_address,
// 					"status"=> $obj->status,
// 					"type"=> $obj->type,
// 					"contact_name"=> $obj->contact_name,
// 					"contact_email"=> $obj->contact_email,
// 					"contact_phone"=> $obj->contact_phone,
// 					"pincode"=> $obj->pincode,
// 					"beds"=> $obj->beds,
// 					"halls"=> $obj->halls,
// 					"bathroom"=> $obj->bathroom,
// 					"space"=> $obj->space,
// 					"year"=> $obj->year,
// 					"floors"=> $obj->floors,
					 
					
				
// 					"amenities"=> rtrim($s,','),
// 					"userinfo"=> $user,
// 				);
// 				$category	=  DB::table('categories')->where('id', $obj->category)->first(); 
// 				if($category!=null){
// 					   $a[$key]["categorydata"]=$category; 
// 					}else{
// 					    $a[$key]["categorydata"]=array('title' =>"");
// 					}
// 						if($obj->countrydata!=null){
// 					   $a[$key] ["countrydata"]= $obj->countrydata; 
// 					}else{
// 					    $a[$key]["countrydata"]=array('name' =>"");
// 					}
// 					if($obj->statedata!=null){
// 					   $a[$key]["statedata"]= $obj->statedata; 
// 					}else{
// 					    $a[$key]["statedata"]=array('name' =>"");
// 					}
// 					if($obj->citydata!=null){
// 					   $a[$key]["citydata"]=$obj->citydata; 
// 					}else{
// 					   $a[$key]["citydata"]=array('name' =>"");
// 					}
				
				
// 			}
			
			
// 				return response()->json([ 'success' => true, 'ads'=>$a ]); 
// 			}else{
// 				return response()->json([ 'success' => false, 'errors' => 'Record not found']); 
// 			}
// 	}
public function searchAds(Request $request){	



		/*$objs=  MyAd::where(['status'=>1])->where(function($query){

			$cities	=  array_column(DB::table('cities')->select('id')->where('name', request()->query('city'))->get()->toArray(),'id');

			return $query

			->whereIn('city_id',$cities)

			->orWhere('pincode',request()->query('pincode'));

        })->with(['countrydata', 'statedata', 'citydata'])->orderby('created_at', 'DESC')->paginate(50); */

        $objs=  MyAd::where(['status'=>1])->where(function($query){

			$cities	=  array_column(DB::table('cities')->select('id')->where('name', request()->query('city'))->get()->toArray(),'id');

			$states	=  array_column(DB::table('states')->select('id')->where('name', request()->query('state'))->get()->toArray(),'id');
			
			$countries	=  array_column(DB::table('countries')->select('id')->where('name', request()->query('country'))->get()->toArray(),'id');

			//print_r($cities); exit;

	//	echo request()->query('category'); exit;
	
	       if(!empty(request()->query('title'))){

 				$query->where('title',request()->query('title'));	

			}

 			if(!empty(request()->query('city'))){

 				$query->whereIn('city_id',$cities);	

			}
			if(!empty(request()->query('country'))){

 				$query->whereIn('country_id',$countries);	

			}

			if(!empty(request()->query('state'))){

				$query->whereIn('state_id',$states);	

			}

				// if(count($states)>0){

				// $query->whereIn('state_id',$states);	

 			// }

			

			if(request()->query('max_amount')>0){

				$query->where('price','<=',request()->query('max_amount'));	

			}

			if(request()->query('min_amount')>0){

				$query->where('price','>=',request()->query('min_amount'));	

			}

		

			if(request()->query('min_beds')>0){

				$query->where('beds','>=',request()->query('min_beds'));	

			}

			if(request()->query('max_beds')>0){

				$query->where('beds','<=',request()->query('max_beds'));	

			}

			if(request()->query('min_bathroom')>0){

				$query->where('bathroom','>=',request()->query('min_bathroom'));	

			}

			if(request()->query('max_bathroom')>0){

				$query->where('bathroom','<=',request()->query('max_bathroom'));	

			}

				if(request()->query('min_floors')>0){

				$query->where('floors','>=',request()->query('min_floors'));	

			}

			if(request()->query('max_floors')>0){

				$query->where('floors','<=',request()->query('max_floors'));	

			}

			if(request()->query('min_space')>0){

				$query->where('space','>=',request()->query('min_space'));	

			}

				if(request()->query('max_space')>0){

				$query->where('space','<=',request()->query('max_space'));	

			}
            $category=Category::where('title',request()->query('category'))->first();
            
			if(!empty($category)){

				$query->where('category',$category->id);

			}

			if(request()->query('year')>0){

				$query->where('year',request()->query('year'));

			}

			if(request()->query('pincode')>0){

				$query->orWhere('pincode',request()->query('pincode'));

			}

			

			

			return $query;

        })->with(['countrydata', 'statedata', 'citydata'])->orderby('created_at', 'DESC')->paginate(50);

		

			if($objs){ 

				$a = array();			

			foreach($objs as $key=> $obj){

				$user = \App\User::select('first_name', 'last_name', 'email', 'phone', 'country', 'state', 'city', 'address', 'zip', 'profile_img')->where('id',$obj->user_id)->first();

				$e = explode(',', $obj->amenities);

			$s = ''; 

			foreach($e as $u){

				$le = \App\Amenities::where('id',$u)->first();

					if($le!=null){

				$s .= $le->title.',';

				}

			}

			

				$a[$key] = array(

					"id" => $obj->id,

					"category"=> $obj->category,

					"user_id"=> $obj->user_id,

					"sub_category"=> $obj->sub_category,

					"title"=> $obj->title,

					"price"=> $obj->price,

					"tags"=> $obj->tags,

					"description"=> $obj->description,

					"photos"=> $obj->photos,

					"photos1"=> $obj->photos1,

					"photos2"=> $obj->photos2,

					"country_id"=> $obj->country_id,

					"state_id"=> $obj->state_id,

					"city_id"=> $obj->city_id,

					"str_address"=> $obj->str_address,

					"status"=> $obj->status,

					"type"=> $obj->type,

					"contact_name"=> $obj->contact_name,

					"contact_email"=> $obj->contact_email,

					"contact_phone"=> $obj->contact_phone,

					"pincode"=> $obj->pincode,

					"beds"=> $obj->beds,

					"halls"=> $obj->halls,

					"bathroom"=> $obj->bathroom,

					"space"=> $obj->space,

					"year"=> $obj->year,

					"floors"=> $obj->floors,



					"amenities"=> rtrim($s,','),

					"userinfo"=> $user,

				);

				$category	=  DB::table('categories')->where('id', $obj->category)->first(); 
               
				if($category!=null){

					   $a[$key]["categorydata"]=$category; 

					}else{

					    $a[$key]["categorydata"]=array('title' =>"");

					}

						if($obj->countrydata!=null){

					   $a[$key] ["countrydata"]= $obj->countrydata; 

					}else{

					    $a[$key]["countrydata"]=array('name' =>"");

					}

					if($obj->statedata!=null){

					   $a[$key]["statedata"]= $obj->statedata; 

					}else{

					    $a[$key]["statedata"]=array('name' =>"");

					}

					if($obj->citydata!=null){

					   $a[$key]["citydata"]=$obj->citydata; 

					}else{

					   $a[$key]["citydata"]=array('name' =>"");

					}

				

				

			}

			

			

				return response()->json([ 'success' => true, 'ads'=>$a ]); 

			}else{

				return response()->json([ 'success' => false, 'errors' => 'Record not found']); 

			}

	}
	public function viewuserpost(Request $request){
// 	  return response()->json([ 'success' => false, 'errors' => 'Record not found']); 
	
			$objs	=  MyAd::where('user_id',auth('api')->user()->id)->orderby('created_at', 'DESC')->with(['countrydata', 'statedata', 'citydata'])->get(); 
			if($objs){ 
// 			$a = array();			
// 			foreach($objs as $key=> $obj){
// 				$e = explode(',', $obj->amenities);
// 			$s = '';
// 			foreach($e as $u){
// 				$le = \App\Amenities::where('id',$u)->first();
// 				if($le!=null){
// 				$s .= $le->title.',';
// 				}
// 			}
$a = array();			
 			foreach($objs as $key=> $obj){
				$e = explode(',', $obj->amenities);
			$s = [];
			foreach($e as $u){
				$le = \App\Amenities::where('id',$u)->first();
				if($le!=null){
				    $s[]= $le;
				}
			}
 			
			
				$a[] = array(
					"id" => $obj->id,
					"category"=> $obj->category,
					"user_id"=> $obj->user_id,
					"sub_category"=> $obj->sub_category,
					"title"=> $obj->title,
					"price"=> $obj->price,
					"tags"=> $obj->tags,
					"description"=> $obj->description,
					"photos"=> $obj->photos,
					"photos1"=> $obj->photos1,
					"photos2"=> $obj->photos2,
					"country_id"=> $obj->country_id,
					"state_id"=> $obj->state_id,
					"city_id"=> $obj->city_id,
					"str_address"=> $obj->str_address,
					"status"=> $obj->status,
					"type"=> $obj->type,
					"contact_name"=> $obj->contact_name,
					"contact_email"=> $obj->contact_email,
					"contact_phone"=> $obj->contact_phone,
					"pincode"=> $obj->pincode,
					"beds"=> $obj->beds,
					"halls"=> $obj->halls,
					"bathroom"=> $obj->bathroom,
					"space"=> $obj->space,
					"year"=> $obj->year,
					"floors"=> $obj->floors,
				
			     	"amenities"=> $s,
				);
					
					if($obj->countrydata!=null){
					   $a[$key]["countrydata"]= array('name' =>$obj->countrydata->name); 
					}else{
					    $a[$key]["countrydata"]=array('name' =>"");
					}
					if($obj->statedata!=null){
					   $a[$key]["statedata"]= array('name' =>$obj->statedata->name); 
					}else{
					    $a[$key]["statedata"]=array('name' =>"");
					}
					if($obj->citydata!=null){
					   $a[$key]["citydata"]= array('name' =>$obj->citydata->name); 
					}else{
					    $a[$key]["citydata"]=array('name' =>"");
					}
					
				
			}
				return response()->json([ 'success' => true, 'ads'=>$a ]); 
			}else{
				return response()->json([ 'success' => false, 'errors' => 'Record not found']); 
			}
	
	}
	public function deletepost(Request $request){
		$data = Validator::make($request->all(), [
            'id' => 'required',
        ]);
		if ($data->fails())
		{
			$errors = $data->errors();
			//print_r($errors);
			if ($errors->has('id')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('id')]); 
			}
		}else{
			$response	=	DB::table('my_ads')->where('id', @$request->id)->where('user_id', @auth('api')->user()->id)->delete();
			if($response) 
			{	
				return response()->json([ 'success' => true, 'message' => 'Post deleted successfully' ]); 
			} 
			else 
			{
				return response()->json([ 'success' => true, 'message' => 'Post Not Found.' ]); 
			}
		}
	}
	
	public function sendMessage(Request $request){
	    
		$data = Validator::make($request->all(), [
            'message' => 'required',
            'reciever_id' => 'required'
        ]);
		if ($data->fails())
		{
			$errors = $data->errors();
		
			if ($errors->has('message')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('message')]); 
			}
			if ($errors->has('reciever_id')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('reciever_id')]); 
			}
			
		}else{
			$requestData = 	$request->all();
			
			$obj				= 	new Message;
		
			$obj->sender_id	    =	@auth('api')->user()->id;
		
			$obj->message	    =	@$requestData['message'];
			$obj->reciever_id	=	@$requestData['reciever_id'];
			
			$saved				=	$obj->save();  
			
			if($saved){
				return response()->json([ 'success' => true, 'message' => 'Message Added successfully',  'result'=>$obj ]); 
			}else{
				return response()->json([ 'success' => false, 'errors' => 'Please try again']); 
			}
		}
		
	}
	public function senderMessage(){
	    
			$obj_all		= 	Message::where('sender_id',@auth('api')->user()->id)->get();
		    $message_count	= 	Message::where('sender_id',@auth('api')->user()->id)->count();
            		
			$response = array();
		    $response[]['message_count']  = $message_count;
            foreach($obj_all  as $obj){
    	    	$result['sender_id']   = $obj->sender_id;
                $result['reciever_id'] = $obj->reciever_id;
                $result['message']     = $obj->message;
                $result['created_at']  = $obj->created_at;
                $result['updated_at']  = $obj->updated_at;
                
                $response[]        =    $result;
            }
			if($response){
				return response()->json([ 'success' => true, 'message' => 'Sender Message List', 'result'=>$response ]); 
			}else{
				return response()->json([ 'success' => false, 'errors' => 'Please try again']); 
			}
		}
		public function allMessage(){
	  
			$obj_all		= 	Message::join('users','users.id','=','message.sender_id')
			                            ->where('message.reciever_id',@auth('api')->user()->id)
			                            ->select('message.message','message.sender_id','message.reciever_id','message.created_at','message.status as read_status','users.id as user_id','users.profile_img','users.first_name','users.last_name','users.first_name as name')
                                        ->orderby('message.created_at','desc')
			                            ->groupBy('message.sender_id')
			                            ->get();
           /* $Unread_msg_count		=   DB::table('message')
                                         ->select(DB::raw('count(*) as total'))
                                         ->where('reciever_id',@auth('api')->user()->id)
                                         ->where('status','U')
                                         ->groupBy('sender_id')
                                         ->orderby('created_at','desc')
                                         ->get();*/
            //dd($Unread_msg_count);
			$response = array();
			//$response[]['unread_msg_count']   = $Unread_msg_count;
            foreach($obj_all  as $key=>$obj){
            
               /*if(!empty($Unread_msg_count)){
                   $result['unread_msg_count']   = $Unread_msg_count ? $Unread_msg_count : 0;
               }*/
                
                $result['sender_id']   = $obj->sender_id;
    	    	$result['sender_name']   = $obj->first_name.' '.$obj->last_name;
    	    	$result['sender_image']   = $obj->profile_img;
                $result['reciever_id'] = $obj->reciever_id;
                $result['message']     = $obj->message;
                $result['read/unread'] = ($obj->read_status == 'U') ? 'Unread' : 'Read';
                $result['created_at']  = $obj->created_at;
                //$result['updated_at']  = $obj->updated_at;
                
                $response[]        =    $result;
            }
			if($response){
				return response()->json([ 'success' => true, 'message' => 'All Message List', 'result'=>$response ]); 
			}else{
				return response()->json([ 'success' => false, 'errors' => 'No Message Found']); 
			}
		}
		public function chatHistory(Request $request){
	    
	    	$data = Validator::make($request->all(), [
            'sender_id' => 'required',
            'reciever_id' => 'required'
        ]);
		if ($data->fails())
		{
			$errors = $data->errors();
		
			if ($errors->has('sender_id')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('sender_id')]); 
			}
			if ($errors->has('reciever_id')){
				return response()->json([ 'success' => false, 'errors' => $errors->first('reciever_id')]); 
			}
			
		}else{
		    $result=DB::table('message')
                  ->join('users','message.sender_id','=','users.id')
                  ->where('sender_id', $request->sender_id)->where('reciever_id',$request->reciever_id)
                  ->orwhere('sender_id',$request->reciever_id)->where('reciever_id',$request->sender_id)
                  ->select('message.message','message.sender_id','message.reciever_id','message.created_at','users.id as user_id','users.first_name as name')
                  ->orderby('message.created_at','desc')
                  ->get();
                  
                  

			if($result){
				return response()->json([ 'success' => true, 'message' => 'Chat History', 'result'=>$result ]); 
			}else{
				return response()->json([ 'success' => false, 'errors' => 'Please try again']); 
			}
		  }
		}
		public function recieverMessage(Request $request){
	        $data = Validator::make($request->all(), [
            'reciever_id' => 'required'
            ]);
    		if ($data->fails())
    		{
    			$errors = $data->errors();
    			
    			if ($errors->has('reciever_id')){
    				return response()->json([ 'success' => false, 'errors' => $errors->first('reciever_id')]); 
    			}
    			
    		}else{
    		    $reciever_id = $request->reciever_id;
    			$obj_all	= 	Message::where('reciever_id',$reciever_id)->get();
    		    
    			$response = array();
                foreach($obj_all  as $obj){
        	    	$result['sender_id']   = $obj->sender_id;
                    $result['reciever_id'] = $obj->reciever_id;
                    $result['message']     = $obj->message;
                    $result['created_at']  = $obj->created_at;
                    $result['updated_at']  = $obj->updated_at;
                    
                    $response[]        =    $result;
                }
    		
    			if($response){
    				return response()->json([ 'success' => true, 'message' => 'Reciever Message List', 'result'=>$response ]); 
    			}else{
    				return response()->json([ 'success' => false, 'errors' => 'Please try again']); 
    			}
    		}
		}
		public function readMessage(Request $request){
	        $data = Validator::make($request->all(), [
            'sender_id' => 'required',
            'reciever_id' => 'required'
            ]);
    		if ($data->fails())
    		{
    			$errors = $data->errors();
    			
    			if ($errors->has('message_id')){
    				return response()->json([ 'success' => false, 'errors' => $errors->first('message_id')]); 
    			}
    			
    		}else{
    		    $result=DB::table('message')
                  ->where('sender_id', $request->sender_id)->where('reciever_id',$request->reciever_id)
                  ->orwhere('sender_id',$request->reciever_id)->where('reciever_id',$request->sender_id)
                  ->update(['status' => 'R']);
    		    
    		  
    			if($result){
    				return response()->json([ 'success' => true, 'message' => 'Message Read Successfully' ]); 
    			}else{
    				return response()->json([ 'success' => false, 'errors' => 'Please try again']); 
    			}
    		   
    		}
		}
		public function addFavorite(Request $request){
		    $data = Validator::make($request->all(), [
            'ads_id' => 'required'
            ]);
    		if ($data->fails())
    		{
    			$errors = $data->errors();
    		
    			if ($errors->has('ads_id')){
    				return response()->json([ 'success' => false, 'errors' => $errors->first('ads_id')]); 
    			}
    			
    		}else{
    			$requestData = 	$request->all();
    			
    			$obj				= 	new Favoriteads;
    		
    			$obj->user_id	    =	@auth('api')->user()->id;
    		
    			$obj->ads_id	    =	@$requestData['ads_id'];
    			
    			$saved				=	$obj->save();  
    			
    			if($saved){
    				return response()->json([ 'success' => true, 'message' => 'Successfully added in favorite list',  'result'=>$obj ]); 
    			}else{
    				return response()->json([ 'success' => false, 'errors' => 'Please try again']); 
    			}
    		}
		}
		public function favoriteAdsList(Request $request){
		    
		    $obj_all	= 	Favoriteads::leftjoin('my_ads','my_ads.id','favorite_ads.ads_id')
                                        ->select('favorite_ads.id as f_id','favorite_ads.ads_id','my_ads.*')
                                        ->where('favorite_ads.user_id',@auth('api')->user()->id)
                                        ->get();
             
			$response = array();
            foreach($obj_all  as $obj){
                $result['favorite_id']   = $obj->f_id;
    	    	$result['ads_id']   = $obj->ads_id;
                $result['user_id'] = $obj->user_id;
                $result['category']     = $obj->category;
                $result['sub_category']   = $obj->sub_category;
    	    	$result['title']   = $obj->title;
                $result['price'] = $obj->price;
                $result['tags']     = $obj->tags;
                $result['description']   = $obj->description;
    	    	$result['photos']   = $obj->photos;
                $result['photos1'] = $obj->photos1;
                $result['photos2'] = $obj->photos2;
                $result['photos3'] = $obj->photos3;
                $result['photos4'] = $obj->photos4;
                $result['photos5'] = $obj->photos5;
                $result['photos6'] = $obj->photos6;
                $result['contact_name']   = $obj->contact_name;
                $result['contact_email'] = $obj->contact_email;
                $result['contact_phone']     = $obj->contact_phone;
                $result['created_at']  = $obj->created_at;
                $result['updated_at']  = $obj->updated_at;
                
                $response[]        =    $result;
            }
			if($response){
				return response()->json([ 'success' => true, 'message' => 'Favorite Ads List', 'result'=>$response ]); 
			}else{
				return response()->json([ 'success' => false, 'errors' => 'Please try again']); 
			}
		}
		
		public function removefavoriteAdsList(Request $request){
		    $data = Validator::make($request->all(), [
            'favorite_id' => 'required'
            ]);
    		if ($data->fails())
    		{
    			$errors = $data->errors();
    		
    			if ($errors->has('favorite_id')){
    				return response()->json([ 'success' => false, 'errors' => $errors->first('favorite_id')]); 
    			}
    			
    		}else{
    			$requestData = 	$request->all();
    	
    			$favorite_id = $requestData['favorite_id'];
    			$obj	= 	Favoriteads::where('id',$favorite_id)->delete();
    		 
    			
    			if($obj){
    				return response()->json([ 'success' => true, 'message' => 'Successfully deleted from favorite list' ]); 
    			}else{
    				return response()->json([ 'success' => false, 'errors' => 'Please try again']); 
    			}
    		}
		}
}