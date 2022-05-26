<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ConversionChats extends Authenticatable
{
    use Notifiable; 
	use Sortable;

	protected $fillable = ['id','conversion_id','sender_id' ,'sender_name','message' ,'created_at', 'updated_at'];
	
	public $sortable = ['id','conversion_id','sender_id' ,'sender_name','message' ,'created_at', 'updated_at'];
	
	public function receiverdata()
    {
        return $this->belongsTo('App\User','receiver_id');
    }
	public function conversiondata()
    {
        return $this->belongsTo('App\AdConversions','conversion_id');
    }
}