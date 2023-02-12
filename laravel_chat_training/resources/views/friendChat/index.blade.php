@extends('layouts.app')

@section('content')
@if (count($messages) == 0)
        <p>No Messages Found</p>
        <form action="{{route('message.store.friend.chat')}}" method="POST">
            @csrf
            <input type="hidden" name="reciever" value="{{$friend_id}}">
            <input type="text" name="message">
            <button type="submit">Send Message</button>
        </form>
        @else
        <ul>
        @foreach ($messages as $item)
        <p><b>{{$item['name']}}:</b>  {{$item['message']}}@if ($item['senderId'] == Auth::id())
             <a href="{{route('message.delete',$item['id'])}}">Delete</a>
             @endif</p>
        @endforeach
        </ul>  
        <form action="{{route('message.store.friend.chat')}}" method="POST">
            @csrf
            <input type="hidden" name="reciever" value="{{$friend_id}}">
            <input type="text" name="message">
            <button type="submit">Send Message</button>
        </form>  
        @endif
@endsection
