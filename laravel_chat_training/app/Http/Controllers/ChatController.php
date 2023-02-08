<?php

namespace App\Http\Controllers;

use App\Models\chat;
use Illuminate\Http\Request;
use App\Models\massage;
use App\Models\User;
use Auth;


class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = Auth::user();
        $chats = $user->chats;
        return view('home',compact('chats'));
    }

    public function create()
    {
        return view('chat.create');
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
        $chat->users()->attach(Auth::id());
        return redirect()->route('home');
    }

    
    public function show($id)
    {
        $chat = chat::where('id',$id)->first();
        $messages = massage::where('chat_id',2)->orderBy('created_at','DESC')->get();
        $users = User::all();
        return view('chat.show')->with('chat',$chat)->with('messages',$messages)->with('users',$users);
    }
    
    public function update(Request $request, $id)
    {
        $chat = chat::find($id);
        $request->validate([
            'users' => 'required',
        ]);
        $chat->users()->sync($request->users);
        return redirect()->route('home');
    }

    
    public function destroy($id)
    {
        $chat = chat::find($id);
        $chat->users()->detach();
        
        massage::where('chat_id',$id)->get()->each(function ($message, $key) {
            $message->delete();
        });

        $chat->delete();

        
        
        return redirect()->route('home');

    }
}
