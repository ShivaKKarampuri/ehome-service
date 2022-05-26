<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class City extends Authenticatable 
{
    use Notifiable;
 
	protected $fillable = [
        'id', 'sortname', 'name', 'phonecode', 'created_at', 'updated_at'
    ];
	
	public function countrydata()
    {
        return $this->belongsTo('App\Country','country_id');
    }
	public function statedata()
    {
        return $this->belongsTo('App\State','state_id');
    } 
}