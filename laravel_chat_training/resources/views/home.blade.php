@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <a href="{{route('create.chat')}}">Create A New Chat</a>
        </div>
    </div>
    @if (count($chats) == 0)
<p>No Chats Found</p>
@else
<table>
    <tr>
        <th>Chat Name</th>
        <th>Action</th>
    </tr>
    @foreach ($chats as $item)
    <tr><td><a href="{{route('chat.show',$item->id)}}">{{$item->chat_name}}</a></td>
        @if ($item->admin_id == Auth::id())
        <td><a href="{{route('chat.delete',$item->id)}}">delete</a></td>
        @endif
    </tr>
    @endforeach
</table>

   
@endif
</div>
@endsection
