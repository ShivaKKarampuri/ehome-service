<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Route;

use App\MyAd;

use Auth;
use Config;

class AdsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {	
        $this->middleware('auth:admin');
	}
	/**
     * All Cms Page.
     *
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request)
	{
		
		 $query 		= MyAd::where('id', '!=', '')->with(['categorydata', 'subcategorydata']);
		
		$totalData 	= $query->count();	//for all data
		
		if ($request->has('category')) 
		{
			$category 		= 	$request->input('category');
			if(trim($category) != '')
			{		
				$query->where('category', '=', $category);
			}
		}
		
		if ($request->has('sub_category')) 
		{
			$sub_category 		= 	$request->input('sub_category');
			if(trim($sub_category) != '')
			{		
				$query->where('sub_category', '=', $sub_category);
			}
		}
		
		if ($request->has('status')) 
		{
			$status 		= 	$request->input('status');
			if(trim($status) != '')
			{	
				if($status == 'active'){
					$query->where('status', '=', 1);
				}else{
					$query->where('status', '=', 0);	
				}		
				
			}
		}else{
			
		}
		$type = isset($_GET['type']) ? $_GET['type'] : 'publish';
		$query->where('type', '=', $type);
		
		
		if ($request->has('category') || $request->has('sub_category') || $request->has('status')) 
		{
			$totalData 	= $query->count();//after search
		}
		
		$lists		= $query->orderby('id','DESC')->get(); 
		
		return view('Admin.ads.index',compact(['lists', 'totalData']));	
	} 
	 
	public function create(Request $request)
	{ 
		return view('Admin.ads.create');	 
	}
	
	public function store(Request $request)
	{
		if ($request->isMethod('post')) 
		{
			$this->validate($request, [
										//'category' => 'required',
										'title' => 'required',
										//'sub_category' => 'required'
									  ]);
			
			$requestData 		= 	$request->all();
			
			
			if ($request->hasFile('photos')) :
					$photos_1 = $this->uploadFile($request->file('photos'), Config::get('constants.cmspage'));
			else:
					$photos_1 = '';
			endif;
			if ($request->hasFile('photos_1')) :
					$photos_2 = $this->uploadFile($request->file('photos_1'), Config::get('constants.cmspage'));
			else:
					$photos_2 = '';
			endif;
			if ($request->hasFile('photos_2')) :
					$photos_3 = $this->uploadFile($request->file('photos_2'), Config::get('constants.cmspage'));
			else:
					$photos_3 = '';
			endif;
			$ameniti = '';
			$amenities = $requestData['amenities'];
			for($i=0; $i<count($amenities); $i++){
				$ameniti .= $amenities[$i].',';
			}
			
			$obj				= 	new MyAd;
			//$obj->category	=	@$requestData['category'];
		//	$obj->sub_category	=	@$requestData['sub_category'];
			$obj->user_id	=	Auth::user()->id;
			$obj->title	=	@$requestData['title'];
			$obj->price	=	@$requestData['price'];
			$obj->tags	=	@$requestData['tags'];
			$obj->description	=	@$requestData['description'];
			$obj->country_id	=	@$requestData['country_id'];
			$obj->state_id	=	@$requestData['state_id'];
			$obj->city_id	=	@$requestData['city_id'];
			$obj->str_address	=	@$requestData['str_address'];
			$obj->status	=	@$requestData['status'];
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
			
			$obj->photos			=	@$photos_1;
			$obj->photos1			=	@$photos_2;
			$obj->photos2			=	@$photos_3;
			$saved				=	$obj->save();  
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else 
			{
				return Redirect::to('/admin/ads')->with('success', 'Ads added Successfully');
			}				
		}			 
	} 
	
	public function edit(Request $request, $id = NULL)
	{	
		if ($request->isMethod('post')) 
		{
			$requestData 		= 	$request->all();
		$this->validate($request, [
										'category' => 'required',
										'title' => 'required',
										'sub_category' => 'required'
									  ]);
			
			//$requestData 		= 	$request->all();
			$ameniti = '';
			$amenities = $requestData['amenities'];
			for($i=0; $i<count($amenities); $i++){
				$ameniti .= $amenities[$i].',';
			}
			$obj				= 	 MyAd::find($requestData['id']);
			//$obj->category	=	@$requestData['category'];
			//$obj->sub_category	=	@$requestData['sub_category'];
			$obj->title	=	@$requestData['title'];
			$obj->price	=	@$requestData['price'];
			$obj->tags	=	@$requestData['tags'];
			$obj->description	=	@$requestData['description'];
			$obj->country_id	=	@$requestData['country_id'];
			$obj->state_id	=	@$requestData['state_id'];
			$obj->city_id	=	@$requestData['city_id'];
			$obj->str_address	=	@$requestData['str_address'];
			$obj->status	=	@$requestData['status'];
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
		
			/* Profile Image Upload Function Start */						  
			if($request->hasfile('photos')) 
			{	
				/* Unlink File Function Start */ 
					if($requestData['old_photos'] != '')
						{
							$this->unlinkFile($requestData['old_photos'], Config::get('constants.cmspage'));
						}
				/* Unlink File Function End */
				
				$photos_1 = $this->uploadFile($request->file('photos'), Config::get('constants.cmspage'));
			}
			else
			{
				$photos_1 = @$requestData['old_photos'];
			}	
			
			if($request->hasfile('photos_1')) 
			{	
				/* Unlink File Function Start */ 
					if($requestData['old_photos_1'] != '')
						{
							$this->unlinkFile($requestData['old_photos_1'], Config::get('constants.cmspage'));
						}
				/* Unlink File Function End */
				
				$photos_2 = $this->uploadFile($request->file('photos_1'), Config::get('constants.cmspage'));
			}
			else
			{
				$photos_2 = @$requestData['old_photos_1'];
			}	
			if($request->hasfile('photos_2')) 
			{	
				/* Unlink File Function Start */ 
					if($requestData['old_photos_2'] != '')
						{
							$this->unlinkFile($requestData['old_photos_2'], Config::get('constants.cmspage'));
						}
				/* Unlink File Function End */
				
				$photos_3 = $this->uploadFile($request->file('photos_2'), Config::get('constants.cmspage'));
			}
			else
			{
				$photos_3 = @$requestData['old_photos_2'];
			}	
				/* Profile Image Upload Function End */	
			$obj->photos			=	@$photos_1;
			$obj->photos1			=	@$photos_2;
			$obj->photos2			=	@$photos_3;
			$saved				=	$obj->save();  
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/ads')->with('success', 'Ads added Successfully');
			}				
		}	
		else 
		{	
			if(isset($id) && !empty($id))
			{
				$id = $this->decodeString($id);	
				if(MyAd::where('id', '=', $id)->exists()) 
				{
					$fetchedData = MyAd::find($id);
					return view('Admin.ads.edit', compact(['fetchedData']));
				}
				else
				{
					return Redirect::to('/admin/ads')->with('error', 'Ads'.Config::get('constants.not_exist'));
				}	
			}
			else
			{
				return Redirect::to('/admin/ads')->with('error', Config::get('constants.unauthorized'));
			}		
		}				
	}
	
}
