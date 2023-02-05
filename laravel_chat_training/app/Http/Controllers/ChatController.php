<?php

namespace App\Http\Controllers;

use App\Models\chat;
use Illuminate\Http\Request;
use App\Models\massage;

class ChatController extends Controller
{
    
    public function index()
    {
        $chats = chat::where('user_id',Auth::id())->orderBy('created_at','DESC')->get();
        return view('post.index',compact('chats'));
    }

    
    public function create()
    {
        return view('post.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'chat_name' => 'required|string',
        ]);
        $chat = chat::create([
            'chat_name'=>$request->chat_name,
            'admin_id'=>Auth::id(),
        ]);
        return redirect()->back();
    }

    
    public function show($id)
    {
        $chat = chat::where('id',$id)->first();
        $messages = massage::where('chat_id',$id)->orderBy('created_at','DESC')->get();
        return view('post.show')->with('chat',$chat)->with('messages',$messages);
    }
    
    public function update(Request $request, $id)
    {
        $chat = chat::find($id);
        $request->validate([
            'users' => 'required',
        ]);
        $chat->users()->sync($request->users);
        return redirect()->back();
    }

    
    public function destroy($id)
    {
        
    }
}
