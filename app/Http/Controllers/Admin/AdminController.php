<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; 
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;

use App\Admin;
use App\WebsiteSetting;
use App\SeoPage;

use Auth;
use Config;

class AdminController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {	
		
        return view('Admin.dashboard');
    }
	/**
     * My Profile.
     *
     * @return \Illuminate\Http\Response
     */
	
	public function myProfile(Request $request)
	{
		/* Get all Select Data */	
			$countries = array();		
		/* Get all Select Data */
		
		if ($request->isMethod('post')) 
		{	
			$requestData 		= 	$request->all();
			
			$this->validate($request, [
				'first_name' => 'required',
				'last_name' => 'nullable',
				'email' => 'required|unique:admins,email,'.$requestData['id'],
				//'country' => 'required',
				'phone' => 'required|max:14|unique:admins,phone,'.$requestData['id'],
				/* 'state' => 'required',
				'city' => 'required',
				'address' => 'required',
				'zip' => 'required' */
			  ]);
									  
			/* Profile Image Upload Function Start */						  
				if($request->hasfile('profile_img')) 
				{	
					/* Unlink File Function Start */ 
						if($requestData['profile_img'] != '')
							{
								$this->unlinkFile($requestData['old_profile_img'], Config::get('constants.profile_imgs'));
							}
					/* Unlink File Function End */
					
					$profile_img = $this->uploadFile($request->file('profile_img'), Config::get('constants.profile_imgs'));
				}
				else
				{
					$profile_img = @$requestData['old_profile_img'];
				}		
			/* Profile Image Upload Function End */						  
								  					  
			$obj							= 	Admin::find(Auth::user()->id);
			
			$obj->first_name				=	@$requestData['first_name'];
			$obj->last_name					=	@$requestData['last_name'];
			$obj->email					=	@$requestData['email'];
			$obj->phone						=	@$requestData['phone'];
			$obj->country					=	@$requestData['country'];
			$obj->state						=	@$requestData['state'];
			$obj->city						=	@$requestData['city'];
			$obj->address					=	@$requestData['address'];
			$obj->company_name					=	@$requestData['company_name'];
			$obj->company_website					=	@$requestData['company_website'];
			$obj->zip						=	@$requestData['zip'];
			//$obj->gst_no						=	@$requestData['gst_no'];
			$obj->profile_img				=	@$profile_img;
			
			$saved							=	$obj->save();
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/my_profile')->with('success', 'Your Profile has been edited successfully.');
			}		
		}
		else
		{	
			$id = Auth::user()->id;	
			$fetchedData = Admin::find($id);
		
			return view('Admin.my_profile', compact(['fetchedData', 'countries']));
		}	
	}	
	/**
     * Change password and Logout automatiaclly.
     *
     * @return \Illuminate\Http\Response
     */
	public function change_password(Request $request)
	{
		//check authorization start	
			/* $check = $this->checkAuthorizationAction('Admin', $request->route()->getActionMethod(), Auth::user()->role);
			if($check)
			{
				return Redirect::to('/admin/dashboard')->with('error',config('constants.unauthorized'));
			} */	
		//check authorization end

		if ($request->isMethod('post')) 
		{
			$this->validate($request, [
										'old_password' => 'required|min:6',
										'password' => 'required|confirmed|min:6',
										'password_confirmation' => 'required|min:6'
									  ]);
			
			
			$requestData 	= 	$request->all();
			$admin_id = Auth::user()->id;
			
			$fetchedData = Admin::where('id', '=', $admin_id)->first();
			if(!empty($fetchedData))
				{
					if($admin_id == trim($requestData['admin_id']))
						{
							 if (!(Hash::check($request->get('old_password'), Auth::user()->password))) 
								{
									return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
								}
							else
								{
									$admin = Admin::find($requestData['admin_id']);
									$admin->password = Hash::make($requestData['password']);
									if($admin->save())
										{
											Auth::guard('admin')->logout();
											$request->session()->flush();
											
											return redirect('/admin')->with('success', 'Your Password has been changed successfully.');
										}
									else
										{
											return redirect()->back()->with('error', Config::get('constants.server_error'));
										}
								}	
						}
					else
						{
							return redirect()->back()->with('error', 'You can change the password only your account.');
						}	
				}	
			else
				{
					return redirect()->back()->with('error', 'User is not exist, so you can not change the password.');
				}	
		}
		return view('Admin.change_password');		
	}
	 
	public function CustomerDetail(Request $request){
		$contactexist = Member::where('id', $request->customer_id)->where('user_id', Auth::user()->id)->exists();
		if($contactexist){
			$member = Member::where('id', $request->customer_id)->with(['currencydata'])->first();
			$details = VehicleDetail::where('customer_id',$request->customer_id)->get();
			return json_encode(array('success' => true, 'memberdetail' => $member,'vehicledetail'=>$details));
		}else{
			return json_encode(array('success' => false, 'message' => 'ID not exist'));
		}
	}
	public function editSeo(Request $request, $id = NULL)
	{
		if ($request->isMethod('post')) 
		{
			$requestData 		= 	$request->all();
			
			$this->validate($request, [
										'id' => 'required'
									  ]);

			$obj				= 	SeoPage::find($requestData['id']);
			$obj->meta_title	=	@$requestData['meta_title'];
			$obj->meta_keyword	=	@$requestData['meta_keyword'];
			$obj->meta_desc		=	@$requestData['meta_desc'];

			$saved				=	$obj->save();
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/dashboard')->with('success', 'SEO Information for this Page'.Config::get('constants.edited'));
			}				
		}
		else
		{	
			if(isset($id) && !empty($id))
			{
				$id = $this->decodeString($id);	
				if(SeoPage::where('id', '=', $id)->exists()) 
				{
					$fetchedData = SeoPage::find($id);
					return view('Admin.seo.edit_seo', compact(['fetchedData']));
				}
				else
				{
					return Redirect::to('/admin/dashboard')->with('error', 'Page'.Config::get('constants.not_exist'));
				}	
			}
			else
			{
				return Redirect::to('/admin/dashboard')->with('error', Config::get('constants.unauthorized'));
			}		
		}		
	}
	
	public function websiteSetting(Request $request)
	{
		//check authorization start	
			$check = $this->checkAuthorizationAction('Admin', $request->route()->getActionMethod(), Auth::user()->role);
			if($check)
			{
				return Redirect::to('/admin/dashboard')->with('error',config('constants.unauthorized'));
			}	
		//check authorization end
		
		if ($request->isMethod('post')) 
		{	
			$requestData 		= 	$request->all();
			
			$this->validate($request, [
										'phone' => 'required|max:20',
										'ofc_timing' => 'nullable|max:255',
										'email' => 'required|max:255'
									  ]);	

			/* Logo Upload Function Start */						  
				if($request->hasfile('logo')) 
				{	
					/* Unlink File Function Start */ 
						if(@$requestData['logo'] != '')
							{
								$this->unlinkFile(@$requestData['old_logo'], Config::get('constants.logo'));
							}
					/* Unlink File Function End */
					
					$logo = $this->uploadFile($request->file('logo'), Config::get('constants.logo'));
				}
				else
				{
					$logo = @$requestData['old_logo'];
				}		
			/* Logoe Upload Function End */					  
			
			if(!empty(@$requestData['id']))
			{		
				$obj				= 	WebsiteSetting::find(@$requestData['id']);
			}		
			else
			{
				$obj				= 	new WebsiteSetting;
			}	
			$obj->phone				=	@$requestData['phone'];
			$obj->ofc_timing		=	@$requestData['ofc_timing'];
			$obj->email				=	@$requestData['email'];
			$obj->logo				=	@$logo;
			
			$saved							=	$obj->save();
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/website_setting')->with('success', 'Website Setting has been edited successfully.');
			}		
		}
		else
		{	
			$fetchedData = WebsiteSetting::where('id', '!=', '')->first();
		
			return view('Admin.website_setting', compact(['fetchedData']));
		}	
	}
	
	public function deleteAllAction(Request $request){
		$status 			= 	0;
		$method 			= 	$request->method();	
		$redirect 			= 	'';	
	
		if ($request->isMethod('post')) 
		{
			$requestData 	= 	$request->all();
			$requestData['table'] = trim($requestData['table']);
			if(isset($requestData['id']) && !empty($requestData['id']) && isset($requestData['table']) && !empty($requestData['table'])) 
			{
				$tableExist = Schema::hasTable(trim($requestData['table']));
				if($tableExist)
				{
					
						$recordExist = DB::table($requestData['table'])->wherein('id', $requestData['id'])->exists();
					
					if($recordExist)
					{
						$id = $requestData['id'];
						$fl = true;
						foreach ($id as $ke) {
							if($requestData['table'] == 'invoices'){
								
								$rs = DB::table('invoices')->where('id', $ke)->first();
								$response	=	DB::table($requestData['table'])->where('id', @$ke)->delete();
								DB::table('invoice_details')->where('invoice_id', @$ke)->delete();
								DB::table('invoice_followups')->where('invoice_id', @$ke)->delete();
								DB::table('insurances')->where('id', @$rs->insurance_id)->delete();
								DB::table('invoice_payments')->where('invoice_id', @$ke)->delete();
							}
						} 	
						if($fl){
							$status = 1;	
							$message = 'Record has been deleted successfully. Redirecting .....';
						}
					}else{
						$message = 'ID does not exist, please check it once again.';
					}
				}else{
					$message = 'Table does not exist, please check it once again.';	
				}		
			}else 
			{
				$message = 'Id OR Table does not exist, please check it once again.';		
			}
		}else 
		{
			$message = Config::get('constants.post_method');
		}
		echo json_encode(array('status'=>$status, 'message'=>$message));
		die;
	}
	public function deleteAction(Request $request)
	{	
		$status 			= 	0;
		$method 			= 	$request->method();	
		if ($request->isMethod('post')) 
		{
			$requestData 	= 	$request->all();
			
			$requestData['id'] = trim($requestData['id']);
			$requestData['table'] = trim($requestData['table']);
			
			$role = Auth::user()->role;
				
				if(isset($requestData['id']) && !empty($requestData['id']) && isset($requestData['table']) && !empty($requestData['table'])) 
				{
					$tableExist = Schema::hasTable(trim($requestData['table']));
					
					if($tableExist)
					{
						$recordExist = DB::table($requestData['table'])->where('id', $requestData['id'])->exists();
						
						if($recordExist)
						{
								if($requestData['table'] == 'my_ads' || $requestData['table'] == 'admins'){
									$response	=	DB::table($requestData['table'])->where('id', @$requestData['id'])->update(['type' => 'trash']);
								}else{
									$response	=	DB::table($requestData['table'])->where('id', @$requestData['id'])->delete();
								}
							
								
								
								if($response) 
								{	
									$status = 1;	
									$message = 'Record has been deleted successfully.';
								} 
								else 
								{
									$message = Config::get('constants.server_error');
								}
							
						}
						else
						{
							$message = 'ID does not exist, please check it once again.';
						}		
					}
					else
					{
						$message = 'Table does not exist, please check it once again.';	
					}		
				} 
				else 
				{
					$message = 'Id OR Table does not exist, please check it once again.';		
				}
					
		} 
		else 
		{
			$message = Config::get('constants.post_method');
		}
		echo json_encode(array('status'=>$status, 'message'=>$message));
		die;
	}
	
	
	public function editapi(Request $request)
	{
		//check authorization start	
			$check = $this->checkAuthorizationAction('api_key', $request->route()->getActionMethod(), Auth::user()->role);
			if($check)
			{
				return Redirect::to('/admin/dashboard')->with('error',config('constants.unauthorized'));
			}	
		//check authorization end
		if ($request->isMethod('post')) 
		{
			$obj	= 	Admin::find(Auth::user()->id);
			$obj->client_id	=	md5(Auth::user()->id.time());
			$saved				=	$obj->save();
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/api-key')->with('success', 'Api Key'.Config::get('constants.edited'));
			}
		}else{	
			return view('Admin.apikey');
		}
	}
	
	public function updateAction(Request $request)
	{	
		$status 			= 	0;
		$method 			= 	$request->method();	
		if ($request->isMethod('post')) 
		{
			$requestData 	= 	$request->all();

			$requestData['id'] = trim($requestData['id']);
			$requestData['current_status'] = trim($requestData['current_status']);
			$requestData['table'] = trim($requestData['table']);
			$requestData['col'] = trim($requestData['colname']);
			
			$role = Auth::user()->role;
			if($role == 1 || $role == 7)
			{
				if(isset($requestData['id']) && !empty($requestData['id']) && isset($requestData['current_status']) && isset($requestData['table']) && !empty($requestData['table'])) 
				{
					$tableExist = Schema::hasTable(trim($requestData['table']));
					
					if($tableExist)
					{
						$recordExist = DB::table($requestData['table'])->where('id', $requestData['id'])->exists();
						
						if($recordExist)
						{
							if($requestData['current_status'] == 0)
							{
								$updated_status = 1;
								$message = 'Record has been enabled successfully.';
							}
							else
							{
								$updated_status = 0;
								$message = 'Record has been disabled successfully.';
							}		
					
							$response 	= 	DB::table($requestData['table'])->where('id', $requestData['id'])->update([$requestData['col'] => $updated_status]);	
							if($response) 
							{
								$status = 1;	
							} 
							else 
							{
								$message = Config::get('constants.server_error');
							}
						}
						else
						{
							$message = 'ID does not exist, please check it once again.';
						}							
					}	
					else
					{
						$message = 'Table does not exist, please check it once again.';	
					}	
				} 
				else 
				{
					$message = 'Id OR Current Status OR Table does not exist, please check it once again.';		
				}
			}
			else
			{
				$message = 'You are not authorized person to perform this action.';	
			}		
		} 
		else 
		{
			$message = Config::get('constants.post_method');
		}
		echo json_encode(array('status'=>$status, 'message'=>$message));
		die;
	}
	

	public function getStates(Request $request)
	{	
		$status 			= 	0;
		$data				=	array();
		$method 			= 	$request->method();	
		
		if ($request->isMethod('post')) 
		{
			$requestData 	= 	$request->all();
			
			$requestData['id'] = trim($requestData['id']);
			
			if(isset($requestData['id']) && !empty($requestData['id'])) 
			{
				$recordExist = Country::where('id', $requestData['id'])->exists();
				
				if($recordExist)
				{
					$data 	= 	State::where('country_id', '=', $requestData['id'])->get();
					
					if($data) 
					{
						$status = 1;	
						$message = 'Record has been fetched successfully.';
					} 
					else 
					{
						$message = Config::get('constants.server_error');
					}
				}
				else
				{
					$message = 'ID does not exist, please check it once again.';
				}			
			} 
			else 
			{
				$message = 'ID does not exist, please check it once again.';		
			}
		} 
		else 
		{
			$message = Config::get('constants.post_method');
		}
		echo json_encode(array('status'=>$status, 'message'=>$message, 'data'=>$data));
		die;
	}

	public function multi_factor(Request $request)
	{
		return view('Admin.multi_factor');		
	} 
	public function sessions(Request $request)
	{
		return view('Admin.sessions');		
	} 
	
	public function getsubcategory(Request $request)
	{
		$categoryid = $request->categoryid;
		$subcats = \App\Category::where('parent',$categoryid)->get();
		foreach ($subcats as $ut){
			echo '<option value="'.$ut->id.'">'.$ut->title.'</option>';
		}
		exit;
	} 
	public function getstate(Request $request)
	{
		$countryid = $request->countryid;
		$state = \App\State::where('country_id',$countryid)->get();
		foreach ($state as $st){
			echo '<option value="'.$st->id.'">'.$st->name.'</option>';
		}
		exit; 
	} 
	public function getcity(Request $request)
	{
		$stateid = $request->stateid;
		$city = \App\City::where('state_id',$stateid)->get();
		foreach ($city as $ct){
			echo '<option value="'.$ct->id.'">'.$ct->name.'</option>';
		}
		exit; 
	} 
}
