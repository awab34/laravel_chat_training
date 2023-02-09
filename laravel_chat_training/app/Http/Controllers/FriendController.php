<?php

namespace App\Http\Controllers;

use App\Models\friend;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\freind_request;

class FriendController extends Controller
{
    
    public function index()
    {
        $secondFriends = friend::where('first_freind',Auth::id())->get()->each(function ($friend, $key) {
            $user = User::find($friend->second_freind);
            
            return ['id'=>$friend->id,'name'=>$user->name];
        });
        $firstFriends = friend::where('second_freind',Auth::id())->get()->each(function ($friend, $key) {
            $user = User::find($friend->first_freind);
            return ['id'=>$friend->id,'name'=>$user->name];
        });

        $freindRequests = freind_request::where('second_freind',Auth::id())->where('status',0)->get();
        $requestsArray = [];
        $friendsArray = [];
        foreach ($firstFriends as $friend) {
            $user = User::find($friend->first_freind);
            $friendsArray[] =  ['id'=>$friend->first_freind,'name'=>$user->name];
        }
        foreach ($secondFriends as $friend) {
            $user = User::find($friend->second_freind);
            $friendsArray[] =  ['id'=>$friend->second_freind,'name'=>$user->name];
        }
        foreach ($freindRequests as $request) {
            $user = User::find($request->first_freind);
            $requestsArray[] =  ['id'=>$request->id,'name'=>$user->name,'requester'=>$request->first_freind];
        }

        return view('friend.index')->with('friends',$friendsArray)->with('freindRequests',$requestsArray);
    }

    public function create()
    {
        return view('friend.create');
    }
    public function search(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        $users = User::where('name', 'like','%'.$request->name.'%')->get();
        $secondFriends = friend::where('first_freind',Auth::id())->get();
        $firstFriends = friend::where('second_freind',Auth::id())->get();
        $requesters = freind_request::where('second_freind',Auth::id())->get();
        $anwserers = freind_request::where('first_freind',Auth::id())->get();
        $usersArray = [];
        foreach ($users as $user) {
            if($user->id == Auth::id()){
                
            }else{
                $allowed = true;
                foreach ($secondFriends as $friend) {
                    if($user->id == $friend->second_freind){
                        $allowed = false;
                    }
                }
                foreach ($firstFriends as $friend) {
                    if($user->id == $friend->first_freind){
                        $allowed = false;
                    }
                }
                foreach ($requesters as $friend) {
                    if($user->id == $friend->first_freind){
                        $allowed = false;
                    }
                }
                foreach ($anwserers as $friend) {
                    if($user->id == $friend->second_freind){
                        $allowed = false;
                    }
                }
                if($allowed){
                    $usersArray[] = ['id'=>$user->id,'name'=>$user->name];
                }
                
            }
          }
          
        return  view('friend.create')->with('searchResult',$usersArray);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_freind' => 'required|string',
            'status' => 'required',
            'requestId' => 'required',
        ]);

        if(strcmp("1",$request->status)==0){
            $freindRequest = freind_request::find($request->requestId);
            $freindRequest->status = $request->status;
            $freindRequest->save();
            $friend = friend::create([
                'first_freind'=>$request->first_freind,
                'second_freind'=>Auth::id(),
                'status'=>0
            ]);
        }else{
            $freindRequest = freind_request::find($request->requestId);
            $freindRequest->status = $request->status;
            $freindRequest->save();
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $secondFriend = friend::where('first_freind',Auth::id())->where('second_freind',$id)->first();
        $firstFriend = friend::where('second_freind',Auth::id())->where('first_freind',$id)->first();
        $requester = freind_request::where('second_freind',Auth::id())->where('first_freind',$id)->first();
        $anwserer = freind_request::where('first_freind',Auth::id())->where('second_freind',$id)->first();
        
if(!is_null($secondFriend)){
    
        $secondFriend->delete();
    
}
if(!is_null($firstFriend)){
    
        $firstFriend->delete();
    
}
if(!is_null($requester)){
    
        $requester->delete();
    
}

if(!is_null($anwserer)){
    
        $anwserer->delete();
    
}
        
        
        
        return redirect()->back();
    }
}
