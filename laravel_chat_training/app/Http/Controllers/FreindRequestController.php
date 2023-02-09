<?php

namespace App\Http\Controllers;

use App\Models\freind_request;
use Illuminate\Http\Request;
use Auth;

class FreindRequestController extends Controller
{
    
    public function store($id)
    {
        $freind_request = freind_request::create([
            'first_freind'=>Auth::id(),
            'second_freind'=>$id,
            'status'=>0
        ]);
        return redirect()->route('add.firend');
    }

}
