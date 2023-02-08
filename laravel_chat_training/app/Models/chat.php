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

    
    public function user()
    {
        return $this->belongsTo(User::class,'admin_id');
    }

    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function massages()
    {
        return $this->hasMany(massage::class);
    }
}
