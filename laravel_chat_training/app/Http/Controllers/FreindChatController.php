<?php

namespace App\Http\Controllers;

use App\Models\freind_chat;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class FreindChatController extends Controller
{
    
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'reciever'=>'required'
        ]);
        $chat = freind_chat::create([
            'message'=>$request->message,
            'sender'=>Auth::id(),
            'reciever'=>$request->reciever,
        ]);

        return redirect()->back();
    }

    public function show($id)
    {
        $sent = freind_chat::where('sender',Auth::id())->where('reciever',$id)->get();
        $recieved = freind_chat::where('reciever',Auth::id())->where('sender',$id)->get();
        $sentMessagesArray = [];
        $recievedMessagesArray = [];
        foreach ($recieved as $message) {
            $recievedMessagesArray[] =  $message;
        }
        foreach ($sent as $message) {
            $sentMessagesArray[] =  $message;
        }
        $messagesArray = [];

        $countMessages = count($recieved) + count($sent);
        $sentIndex = 0;
        $recievedIndex = 0;
        for($i = 0;$i < $countMessages ;$i++){

            if((($sentIndex == count($sent) ) && count($sent) != 1) || count($sent) == 0 ){
                $user = User::find($recieved[$recievedIndex]->sender);
                $messagesArray[] = [
                    'id'=>$recieved[$recievedIndex]->id,
                    'message'=>$recieved[$recievedIndex]->message,
                    'name'=>$user->name,
                    'senderId'=>$user->id
                ];
                $recievedIndex++;
            }else if((($recievedIndex == count($recieved))  && count($recieved) != 1) || count($recieved) == 0 ){
                $user = User::find($sent[$sentIndex]->sender);
                $messagesArray[] = [
                    'id'=>$sent[$sentIndex]->id,
                    'message'=>$sent[$sentIndex]->message,
                    'name'=>$user->name,
                    'senderId'=>$user->id
                ];
                
                $sentIndex++;
            }else{

                if($sent[$sentIndex]->created_at > $recieved[$recievedIndex]->created_at){
                    $user = User::find($recieved[$recievedIndex]->sender);
                    $messagesArray[] = [
                        'id'=>$recieved[$recievedIndex]->id,
                        'message'=>$recieved[$recievedIndex]->message,
                        'name'=>$user->name,
                        'senderId'=>$user->id
                    ];
                    $recievedIndex++;
                }else{
                    $user = User::find($sent[$sentIndex]->sender);
                    $messagesArray[] = [
                        'id'=>$sent[$sentIndex]->id,
                        'message'=>$sent[$sentIndex]->message,
                        'name'=>$user->name,
                        'senderId'=>$user->id
                    ];
                    $sentIndex++;
                }
            }
        }
        return view('friendChat.index')->with('messages',$messagesArray)->with('friend_id',$id);
    }

    public function destroy($id)
    {
        
    }
}
