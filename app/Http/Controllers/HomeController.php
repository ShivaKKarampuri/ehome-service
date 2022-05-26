<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; 
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;

use App\WebsiteSetting;
use App\SeoPage;
use App\Destination;
use App\Package;

use Illuminate\Support\Facades\Session;
use Config;
use Cookie;


class HomeController extends Controller
{
	public function __construct(Request $request)
    {	
		$siteData = WebsiteSetting::where('id', '!=', '')->first();
		\View::share('siteData', $siteData);
	}
	
    public function coming_soon()
    {
        return view('coming_soon');
    }
	
	public function sicaptcha(Request $request)
    {
		 $code=$request->code;
		
		$im = imagecreatetruecolor(50, 24);
		$bg = imagecolorallocate($im, 37, 37, 37); //background color blue
		$fg = imagecolorallocate($im, 255, 241, 70);//text color white
		imagefill($im, 0, 0, $bg);
		imagestring($im, 5, 5, 5,  $code, $fg);
		header("Cache-Control: no-cache, must-revalidate");
		header('Content-type: image/png');
		imagepng($im);
		imagedestroy($im);
	
    }
	
		public static function hextorgb ($hexstring){ 
			$integar = hexdec($hexstring); 
						return array( "red" => 0xFF & ($integar >> 0x10),
			"green" => 0xFF & ($integar >> 0x8),
			"blue" => 0xFF & $integar
			);
		}
	
	 public function Searchtour(Request $request)
    {
		$client_id = env('TRAVEL_CLIENT_ID', '');
	    $durl = env('TRAVEL_API_URL', '')."searchtour?term=".$request->term."&client_id=".$client_id; 
		$searcdata = $this->curlRequest($durl,'GET','');
		echo $searcdata; 
		die;
    } 
	
	public function Page(Request $request, $slug= null)
    {
		$client_id = env('TRAVEL_CLIENT_ID', '');
	    $durl = env('TRAVEL_API_URL', '')."page?slug=".$slug."&client_id=".$client_id; 
		$pagedata = $this->curlRequest($durl,'GET','');
		 return view('Frontend.cms.index', compact(['pagedata']));
    } 
	
	public function index(Request $request)
    {
		$client_id = env('TRAVEL_CLIENT_ID', '');
		$seoDetails = SeoPage::where('page_slug', '=', 'home')->first();
		/*Domestic Tour*/
		 $durl = env('TRAVEL_API_URL', '')."destination-tour?dest_type=domestic&order=DESC&limit=10&client_id=".$client_id; 
		
		$domesticresponse = $this->curlRequest($durl,'GET','');
		/*Domestic Tour*/
	
		/*International Tour*/
		$iurl = env('TRAVEL_API_URL', '')."destination-tour?dest_type=international&order=DESC&limit=10&client_id=".$client_id; 
		$internationalesponse = $this->curlRequest($iurl,'GET','');
		/*International Tour*/
		
		/*Popular Tour*/
		$purl = env('TRAVEL_API_URL', '')."popular-tour?client_id=".$client_id; 
		$populartours = $this->curlRequest($purl,'GET','');
		/*Popular Tour*/
		
		/*holidaytype Tour*/
		$hurl = env('TRAVEL_API_URL', '')."holidaytype?client_id=".$client_id; 
		$holidaytypetours = $this->curlRequest($hurl,'GET','');
		/*holidaytype Tour*/
        return view('index', compact(['seoDetails','domesticresponse','internationalesponse','populartours','holidaytypetours']));
    }

	public function singlepack(Request $request)
    {
		return view('singlepackage');
    }	 
	
	public function packdetails(Request $request)
    {
		return view('packdetails'); 
    }
	
	public function myprofile(Request $request)
    {
		return view('profile');    
    }	
}
