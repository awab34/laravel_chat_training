<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class freind_request extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_freind',
        'second_freind',
        'status'
    ];
}
