<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Categoryslug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Route;

use App\Category;

use Auth;
use Config;

class CategoryController extends Controller
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
		
		$query 		= Category::where('id', '!=', '')->with(['categoryData']);
		
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
		
		$categories = Category::where('id','!=','')->orderby('title','ASC')->get();
		$category = array();
		foreach($categories as $cat){
			$category[] = array(
				'id' => $cat['id'],
				'name' => $cat['title'],
				'parent' => $cat['parent'],
			);
			
		}
		
		$ob = new Category;
		$tree = $ob->buildTree($category);
		
		return view('Admin.categories.index',compact(['lists', 'totalData', 'tree']));	
	} 
	
	public function store(Request $request)
	{	
		if ($request->isMethod('post')) 
		{
			$this->validate($request, [
					'title' => 'required|max:255',
			]);
			$requestData 		= 	$request->all();
			/* Profile Image Upload Function Start */						  
					if($request->hasfile('profile_img')) 
					{	
						$profile_img = $this->uploadFile($request->file('profile_img'), Config::get('constants.category_imgs'));
					}
					else
					{
						$profile_img = NULL;
					}		
					
				/* Profile Image Upload Function End */	
				
				$slug				= 	new Categoryslug;
			$obj				= 	new Category;
			$obj->title			=	@$requestData['title'];
			$obj->description			=	@$requestData['description'];
			$obj->status		=	@$requestData['status'];
			$obj->image		=	@$profile_img;
			$obj->parent = $requestData['parent'];
			$obj->slug = $slug->createSlug($request->title);
			$saved				=	$obj->save();  
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/categories')->with('success', 'Category added Successfully');
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
			if($request->hasfile('profile_img')) 
			{	
				/* Unlink File Function Start */ 
					if($requestData['profile_img'] != '')
						{
							$this->unlinkFile($requestData['old_profile_img'], Config::get('constants.cmspage'));
						}
				/* Unlink File Function End */
				
				$topinclu_image = $this->uploadFile($request->file('profile_img'), Config::get('constants.category_imgs'));
			}
			else
			{
				$profile_img = @$requestData['old_profile_img'];
			}
			$obj				=  Category::find(@$requestData['id']);
			$obj->title			=	@$requestData['title'];
			$obj->description			=	@$requestData['description'];
			$obj->status		=	@$requestData['status'];
			$obj->image		=	@$profile_img;
			$obj->parent = $requestData['parent'];
			if($obj->title != $requestData['title']){
					$obj->title = $slug->createSlug($request->title);
				}
			$saved				=	$obj->save();
			
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/categories')->with('success', 'Category '.Config::get('constants.edited'));
			}				
		}
		else
		{	
	$categories = Category::where('id','!=','')->orderby('title','ASC')->get();
		$category = array();
		foreach($categories as $cat){
			$category[] = array(
				'id' => $cat['id'],
				'name' => $cat['title'],
				'parent' => $cat['parent'],
			);
			
		}
		
		$ob = new Category;
		$tree = $ob->buildTree($category);
			if(isset($id) && !empty($id))
			{
				$id = $this->decodeString($id);	
				if(Category::where('id', '=', $id)->exists()) 
				{
					$fetchedData = Category::find($id);
					return view('Admin.categories.edit', compact(['fetchedData', 'tree']));
				}
				else
				{
					return Redirect::to('/admin/categories')->with('error', 'Category'.Config::get('constants.not_exist'));
				}	
			}
			else
			{
				return Redirect::to('/admin/cms_pages')->with('error', Config::get('constants.unauthorized'));
			}		
		}				
	}
	
}
