<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class emailController extends Controller
{
    public function index(){
        

        return view("emails.index");
    }

    public function sendEmail(Request $request){
        Mail::to('awab3468@gmail.com')->send(new OrderShipped($request->content));

        return Redirect::back();
    }
}
