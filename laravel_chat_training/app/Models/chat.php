<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_name',
        'admin_id'
    ];

    
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    
    public function massages()
    {
        return $this->hasMany(massage::class);
    }
}
