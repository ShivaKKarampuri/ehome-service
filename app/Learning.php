<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Learning extends Authenticatable
{
    use Notifiable;
	use Sortable;

	protected $fillable = [
        'id', 'title', 'description', 'status', 'created_at', 'updated_at'
    ];
	
	public $sortable = ['id', 'title', 'created_at', 'updated_at'];
}