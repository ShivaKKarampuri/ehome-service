<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use App\Mail\CommonMail;
use App\Mail\InvoiceEmailManager;
use App\Mail\MultipleattachmentEmailManager;

use App\UserRole;
use App\WebsiteSetting;

use Auth;
use Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function __construct()
    {
		$siteData = WebsiteSetting::where('id', '!=', '')->first();
		\View::share('siteData', $siteData);
        $this->middleware('guest:admin')->except('logout');
		exec('php public_html/development/artisan view:clear');
    }
	
	
	public function generateRandomString($length = 10) 
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) 
			{
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
		return $randomString;
	}
	
	public function encodeString($string = NULL) 
	{
		return base64_encode(convert_uuencode($string));	
	}
		
	public function decodeString($string = NULL)
	{
		if ( base64_encode(base64_decode($string, true)) === $string)
		{
			return convert_uudecode(base64_decode($string));
		} 
		else
		{
			return false;
		}		
	}
	
	public function uploadFile($file = NULL, $filePath = NULL)
	{
		$fileName = $file->getClientOriginalName();
		$explodeFileName = explode('.', $fileName);
		$newFileName = $explodeFileName[0].'_'.$this->generateRandomString(10);
		
		$ext = $file->getClientOriginalExtension();
		$newFileName = $newFileName.'.'.$ext;
		
		if($file->move($filePath, $newFileName))
		{
			return $newFileName;
		}
	}
	
	public function unlinkFile($file = NULL, $filePath = NULL)
	{
		$unlinkFiles = $filePath.'/'.$file;	
		if(file_exists($unlinkFiles) && is_file($unlinkFiles))
			{	
				unlink($unlinkFiles);
			}
	}
	
	protected function send_email_template($replace = array(), $replace_with = array(), $alias = null, $to = null, $subject = null, $sender = null) 
	{
		$email_template	= 	DB::table('email_templates')->where('alias', $alias)->first();
		$emailContent 	= 	$email_template->description;
		$subject 	= 	$email_template->subject;
		$emailContent	=	str_replace($replace,$replace_with,$emailContent);
	
			$subject		=	$subject;	
			
		$explodeTo = explode(';', $to);//for multiple and single to
		
		Mail::to($to)->send(new CommonMail($emailContent, $subject, 'classified@ecodelinfotel.com'));
	
		// check for failures
		if (Mail::failures()) {
			return false;
		}

		// otherwise everything is okay ...
		return true;
		
	}
	
	protected function send_compose_template($to = null, $subject = null, $sender = null,$array) 
	{
		
		$explodeTo = explode(';', $to);//for multiple and single to
		Mail::to($explodeTo)->send(new CommonMail($array['content'], $subject, $sender));
	
		// check for failures
		if (Mail::failures()) {
			return false;
		}

		// otherwise everything is okay ...
		return true;
		
	}
	protected function send_attachment_email_template($replace = array(), $replace_with = array(), $alias = null, $to = null, $subject = null, $sender = null,$invoicearray) 
	{
		$email_template	= 	DB::table('email_templates')->where('alias', $alias)->first();
		$emailContent 	= 	$email_template->description;
		$emailContent	=	str_replace($replace,$replace_with,$emailContent);
		if($subject == NULL)
		{
			$subject		=	$subject;	
		}	
		$explodeTo = explode(';', $to);//for multiple and single to
            $invoicearray['subject'] = $subject;
            $invoicearray['from'] = $sender;
            $invoicearray['content'] = $emailContent;
		Mail::to($explodeTo)->queue(new InvoiceEmailManager($invoicearray));
	
		// check for failures
		if (Mail::failures()) {
			return false;
		}

		// otherwise everything is okay ...
		return true;
		
	}
	
	protected function send_multipleattachment_email_template($replace = array(), $replace_with = array(), $alias = null, $to = null, $subject = null, $sender = null,$invoicearray) 
	{
		$email_template	= 	DB::table('email_templates')->where('alias', $alias)->first();
		$emailContent 	= 	$email_template->description;
		$emailContent	=	str_replace($replace,$replace_with,$emailContent);
		if($subject == NULL)
		{
			$subject		=	$subject;	
		}	
		$explodeTo = explode(';', $to);//for multiple and single to
            $invoicearray['subject'] = $subject;
            $invoicearray['from'] = $sender;
            $invoicearray['content'] = $emailContent;
		Mail::to($explodeTo)->queue(new MultipleattachmentEmailManager($invoicearray));
	
		// check for failures
		if (Mail::failures()) {
			return false;
		}

		// otherwise everything is okay ...
		return true;
		
	}
	
	protected function send_multiple_attach_compose($to = null, $subject = null,$sender,$invoicearray) 
	{	
		$explodeTo = explode(';', $to);//for multiple and single to
            $invoicearray['from'] = $sender;
		Mail::to($explodeTo)->queue(new MultipleattachmentEmailManager($invoicearray));
	
		// check for failures
		if (Mail::failures()) {
			return false;
		}

		// otherwise everything is okay ...
		return true;
		
	}
	
	public function checkAuthorizationAction($controller = NULL, $action = NULL, $role = NULL)
	{	
		
		$userrole = UserRole::where('usertype',$role)->first();
		if($userrole && $role != 1){
			 $module_access  = $userrole->module_access; 
			 //for test series vendor & organizations & professors authentication

				$noAccessController = json_decode($module_access);
				
					if (!in_array($controller, $noAccessController)) //pass from controller
					{
						return true;
					}
							
		}	
	}
	
	public function curlRequest($url,$type="PUT",$data){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_VERBOSE, 0);
        // enable header only for POST;
        if($type=='POST'){
            curl_setopt($curl, CURLOPT_HEADER, false);
			 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $type);
        }else{
            curl_setopt($curl, CURLOPT_HEADER, FALSE);
        }
        
       curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($curl); 
 
 	curl_close($curl);
 
        return $response;
    }
	
	public function createSlug($userid, $table, $title, $id = 0)
    {
        // Normalize the title
        $slug = str_slug($title);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($userid, $table, $slug, $id);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    public function getRelatedSlugs($userid, $table, $slug, $id = 0)
    {
        return DB::table($table)->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->where('user_id', '=', $userid)
            ->get();
    }
	
	public function createlocSlug($table, $title, $id = 0)
    {
        // Normalize the title
        $slug = str_slug($title);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getlocRelatedSlugs($table, $slug, $id);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    public function getlocRelatedSlugs($table, $slug, $id = 0)
    {
        return DB::table($table)->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)

            ->get();
    }
	
		public static function convert_number_to_words($number) {
	   
		$hyphen      = '-';
		$conjunction = '  ';
		$separator   = ' ';
		$negative    = 'negative ';
		$decimal     = ' point ';
		$dictionary  = array(
			0                   => 'Zero',
			1                   => 'One',
			2                   => 'Two',
			3                   => 'Three',
			4                   => 'Four',
			5                   => 'Five',
			6                   => 'Six',
			7                   => 'Seven',
			8                   => 'Eight',
			9                   => 'Nine',
			10                  => 'Ten',
			11                  => 'Eleven',
			12                  => 'Twelve',
			13                  => 'Thirteen',
			14                  => 'Fourteen',
			15                  => 'Fifteen',
			16                  => 'Sixteen',
			17                  => 'Seventeen',
			18                  => 'Eighteen',
			19                  => 'Nineteen',
			20                  => 'Twenty',
			30                  => 'Thirty',
			40                  => 'Fourty',
			50                  => 'Fifty',
			60                  => 'Sixty',
			70                  => 'Seventy',
			80                  => 'Eighty',
			90                  => 'Ninety',
			100                 => 'Hundred',
			1000                => 'Thousand',
			1000000             => 'Million',
			1000000000          => 'Billion',
			1000000000000       => 'Trillion',
			1000000000000000    => 'Quadrillion',
			1000000000000000000 => 'Quintillion'
		);
	   
		if (!is_numeric($number)) {
			return false;
		}
	   
		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
			// overflow
			trigger_error(
				'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
				E_USER_WARNING
			);
			return false;
		}
	 
		if ($number < 0) {
			return $negative . self::convert_number_to_words(abs($number));
		}
	   
		$string = $fraction = null;
	   
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
	   
		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
				break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= $hyphen . $dictionary[$units];
				}
				break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= $conjunction . self::convert_number_to_words($remainder);
				}
				break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number % $baseUnit;
				$string = self::convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= $remainder < 100 ? $conjunction : $separator;
					$string .= self::convert_number_to_words($remainder);
				}
				break;
		}
	   
		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $dictionary[$number];
			}
			$string .= implode(' ', $words);
		}
	   
		return $string;
	}
	
	
	public function createEmailSlug($table, $title, $id = 0)
    {
        // Normalize the title
        $slug = str_slug($title);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedEmailSlugs($table, $slug, $id);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('alias', $slug)){
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('alias', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    public function getRelatedEmailSlugs($table, $slug, $id = 0)
    {
        return DB::table($table)->where('alias', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
}
