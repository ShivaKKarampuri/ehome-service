<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Favoriteads extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'favorite_ads';
    
	protected $fillable = [
        'id', 'ads_id', 'user_id', 'created_at', 'updated_at'
    ];
}