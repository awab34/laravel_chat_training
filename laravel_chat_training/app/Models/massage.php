<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class massage extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
        'chat_id'
    ];

    public function chats()
    {
        return $this->belongsTo(chat::class,'chat_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
