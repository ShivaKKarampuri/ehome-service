<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Route;

use App\Course;

use Auth;
use Config;

class CourseController extends Controller
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
		
		 $query 		= Course::where('id', '!=', '');
		
		$totalData 	= $query->count();	//for all data
		
		if ($request->has('search_term')) 
		{
			$search_term 		= 	$request->input('search_term');
			if(trim($search_term) != '')
			{		
				$query->where('title', 'LIKE', '%' . $search_term . '%');
			}
		}
		
		if ($request->has('search_term') || $request->has('search_term_from') || $request->has('search_term_to')) 
		{
			$totalData 	= $query->count();//after search
		}
		
		$lists		= $query->orderby('id','DESC')->get(); 
		
		return view('Admin.course.index',compact(['lists', 'totalData']));	
	} 
	 
	public function create(Request $request)
	{ 
		return view('Admin.course.create');	 
	}
	
	public function store(Request $request)
	{
		 /* $check = $this->checkAuthorizationAction('cmspages', $request->route()->getActionMethod(), Auth::user()->role);
			if($check)
			{
				return Redirect::to('/admin/dashboard')->with('error',config('constants.unauthorized'));
			} */	
		if ($request->isMethod('post')) 
		{
			$this->validate($request, [
										'course_name' => 'required|max:255'
									  ]);
			
			$requestData 		= 	$request->all();
			
			$obj				= 	new Course;
			$obj->course_name	=	@$requestData['course_name'];
			$obj->description	=	@$requestData['description'];
			$obj->status	=	@$requestData['status'];
			
			/* Profile Image Upload Function Start */						  
					if($request->hasfile('image')) 
					{	
						$image = $this->uploadFile($request->file('image'), Config::get('constants.cmspage'));
					}
					else
					{
						$image = NULL;
					}		
				/* Profile Image Upload Function End */	
			$obj->image			=	@$image;
			$saved				=	$obj->save();  
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else 
			{
				return Redirect::to('/admin/course')->with('success', 'Course added Successfully');
			}				
		}			 
	} 
	
	public function edit(Request $request, $id = NULL)
	{	
		if ($request->isMethod('post')) 
		{
			$requestData 		= 	$request->all();
			$this->validate($request, [
										'course_name' => 'required|max:255'
									  ]);
			
			//$requestData 		= 	$request->all();
			
			$obj				= 	 Course::find($requestData['id']);
			$obj->course_name	=	@$requestData['course_name'];
			$obj->description	=	@$requestData['description'];
			$obj->status	=	@$requestData['status'];
			
			/* Profile Image Upload Function Start */						  
					if($request->hasfile('image')) 
			{	
				/* Unlink File Function Start */ 
					if($requestData['image'] != '')
						{
							$this->unlinkFile($requestData['old_image'], Config::get('constants.cmspage'));
						}
				/* Unlink File Function End */
				
				$image = $this->uploadFile($request->file('image'), Config::get('constants.cmspage'));
			}
			else
			{
				$image = @$requestData['old_image'];
			}		
				/* Profile Image Upload Function End */	
			$obj->image			=	@$image;
			$saved				=	$obj->save();  
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/course')->with('success', 'Course added Successfully');
			}				
		}	
		else 
		{	
			if(isset($id) && !empty($id))
			{
				$id = $this->decodeString($id);	
				if(Course::where('id', '=', $id)->exists()) 
				{
					$fetchedData = Course::find($id);
					return view('Admin.course.edit', compact(['fetchedData']));
				}
				else
				{
					return Redirect::to('/admin/course')->with('error', 'Course'.Config::get('constants.not_exist'));
				}	
			}
			else
			{
				return Redirect::to('/admin/course')->with('error', Config::get('constants.unauthorized'));
			}		
		}				
	}
	
}
