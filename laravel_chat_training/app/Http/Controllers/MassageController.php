<?php

namespace App\Http\Controllers;

use App\Models\massage;
use Illuminate\Http\Request;

class MassageController extends Controller
{
    

    

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'chat_id' => 'required',
        ]);

        $chat = massage::create([
            'message'=>$request->message,
            'user_id'=>Auth::id(),
            'chat_id'=>$request->chat_id,
        ]);
        return redirect()->back();

    }

    public function destroy($id)
    {
        $massage = massage::find($id);
        $massage->delete();
        return redirect()->back();
    }
}
