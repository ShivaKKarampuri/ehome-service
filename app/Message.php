<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Message extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'message';
    
	protected $fillable = [
        'id', 'sender_id', 'reciever_id', 'message', 'created_at', 'updated_at'
    ];
}