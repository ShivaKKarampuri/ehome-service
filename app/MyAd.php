<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MyAd extends Authenticatable
{
    use Notifiable; 
	use Sortable;

	protected $fillable = [
        'id', 'title', 'description', 'created_at', 'updated_at'
    ];
	
	public $sortable = ['id', 'title', 'created_at', 'updated_at'];
	
	public function categorydata()
    {
        return $this->belongsTo('App\Category','category');
    }
	public function subcategorydata()
    {
        return $this->belongsTo('App\Category','sub_category');
    }
	
	public function countrydata()
    {
        return $this->belongsTo('App\Country','country_id','id');
    }
	
	public function statedata()
    {
        return $this->belongsTo('App\State','state_id','id');
    }
	
	public function citydata()
    {
        return $this->belongsTo('App\City','city_id','id');
    }
    public function favoriteads()
    {
        return $this->belongsTo('App\Favoriteads','ads_id','id');
    }
}