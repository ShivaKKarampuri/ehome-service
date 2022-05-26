<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hash;
use Config;
use App\AdConversions;
use App\ConversionChats;
class ChatsController extends Controller{
	
    public function index(Request $request)
    {   
		$list=  AdConversions::with(['receiverdata', 'senderdata', 'adddata'])->orderby('created_at', 'DESC')->paginate(50); 
		return response()->json([ 'success' => true, 'data' =>$list]); 	
	}  
	public function ChatsDetails(Request $request)
    {   
		$list=  ConversionChats::where('conversion_id',$request->id)->orderby('created_at', 'DESC')->paginate(50); 
		return response()->json([ 'success' => true, 'data' =>$list]); 	
	} 

	public function ChatCreate(Request $request)
    {   
		    $requestData = 	$request->all();
			$conversion_id=0;
		    if($request->conversion_id==""){
				$obj = 	new AdConversions;
				$obj->receiver_id	=	@$requestData['receiver_id'];
				$obj->ad_id	=	@$requestData['ad_id'];
				$obj->sender_id	=	@$requestData['sender_id'];
				$obj->save(); 
				$conversion_id=$obj->id;
			}else{
				$conversion_id=$request->conversion_id;
			}
			$chats				= 	new ConversionChats;
			$chats->sender_id	=	@$requestData['sender_id'];
			$chats->conversion_id	=	$conversion_id;
			$chats->sender_name	=	@$requestData['sender_name'];
			$chats->message	=	@$requestData['message'];
			$chats->save(); 
		return response()->json([ 'success' => true, 'message' => 'Message sent successfully',]); 	
	} 
	
}