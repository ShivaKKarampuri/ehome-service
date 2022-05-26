<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Categoryslug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Route;

use App\Amenities;

use Auth;
use Config;

class AmenitiesController extends Controller
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
		
		$query 		= Amenities::where('id', '!=', '');
		
		$totalData 	= $query->count();	//for all data
		
		
		
		$lists		= $query->orderby('id','DESC')->get();		
		return view('Admin.amenities.index',compact(['lists', 'totalData']));	
	} 
	
	public function store(Request $request)
	{	
		if ($request->isMethod('post')) 
		{
			$this->validate($request, [
					'title' => 'required|max:255',
			]);
			$requestData 		= 	$request->all();
			
			$obj				= 	new Amenities;
			$obj->title			=	@$requestData['title'];
			$saved				=	$obj->save();  
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/amenities')->with('success', 'Amenities added Successfully');
			}
		}			
	}
	
	
	public function edit(Request $request, $id = NULL)
	{	
		
		if ($request->isMethod('post')) 
		{
			$requestData 		= 	$request->all();
			
			$this->validate($request, [
										'title' => 'required',
										
									  ]);
			
			$obj				=  Amenities::find(@$requestData['id']);
			$obj->title			=	@$requestData['title'];
			
			$saved				=	$obj->save();
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/amenities')->with('success', 'Amenities '.Config::get('constants.edited'));
			}				
		}
		else
		{	
	
			if(isset($id) && !empty($id))
			{
				$id = $this->decodeString($id);	
				if(Amenities::where('id', '=', $id)->exists()) 
				{
					$fetchedData = Amenities::find($id);
					return view('Admin.amenities.edit', compact(['fetchedData']));
				}
				else
				{
					return Redirect::to('/admin/amenities')->with('error', 'Amenities '.Config::get('constants.not_exist'));
				}	
			}
			else
			{
				return Redirect::to('/admin/cms_pages')->with('error', Config::get('constants.unauthorized'));
			}		
		}				
	}
	
}
