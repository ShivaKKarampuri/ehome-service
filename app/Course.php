<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Course extends Authenticatable
{
    use Notifiable;

	protected $fillable = [
        'id', 'course_name', 'description', 'image', 'status', 'created_at', 'updated_at'
    ];
}  