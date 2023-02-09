<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class freind_chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender',
        'reciever',
        'message'
    ];
}
