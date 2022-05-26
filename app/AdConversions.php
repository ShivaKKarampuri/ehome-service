<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdConversions extends Authenticatable
{
    use Notifiable; 
	use Sortable;

	protected $fillable = [ 'id','receiver_id','ad_id','sender_id','created_at', 'updated_at' ];
	
	public $sortable = ['id','ad_id','receiver_id','sender_id', 'created_at', 'updated_at'];
	
	public function receiverdata()
    {
        return $this->belongsTo('App\User','receiver_id');
    }
	public function senderdata()
    {
        return $this->belongsTo('App\User','sender_id');
    }
    public function adddata()
    {
        return $this->belongsTo('App\MyAd','ad_id');
    }
}