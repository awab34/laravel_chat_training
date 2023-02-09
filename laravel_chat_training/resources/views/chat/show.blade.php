@extends('layouts.app')

@section('content')
@if(is_null($chat))
    <p>There is no Chat</p>
@else
@if ($chat->admin_id == Auth::id() && count($chat->users) == 1)
@if (count($friends) == 0)
<a href="{{route('add.firend')}}">Add Friends</a>
@else 
<form action="{{route('chat.update',$chat->id)}}" method="POST">
    @csrf
    @method('PUT')
    @foreach ($friends as $item)
    <div class="form-check">
    <input type="checkbox" name="users[]" class="form-check-input"  value="{{ $item['id'] }}" @foreach ($chat->users as $user)
        @if ($item['id'] == $user->id)
        {{ 'checked' }}
        @endif
    @endforeach /> <label class="form-check-label">{{$item['name']}}</label>
</div>
    @endforeach
    <button type="submit">Add Users</button>

    </form>
    <br>
    <br>
<p><b>please add Users</b></p>  
@endif

@else
    <p> <b>Chat Name:</b> {{$chat->chat_name}}</p>
    <p> <b>The Users Are:</b></p>
    <ul>
        @foreach ($chat->users as $user)
        <li><p>{{$user->name}}</p></li>
        @endforeach
        </ul>
        <form action="{{route('chat.update',$chat->id)}}" method="POST">
            @csrf
            @method('PUT')
            @foreach ($friends as $item)
            <div class="form-check">
            <input type="checkbox" name="users[]" class="form-check-input"  value="{{ $item['id'] }}" @foreach ($chat->users as $user)
                @if ($item['id'] == $user->id)
                {{ 'checked' }}
                @endif
            @endforeach /> <label class="form-check-label">{{$item['name']}}</label>
        </div>
            @endforeach
            <button type="submit">Add Users</button>
        
            </form>
            <br>
            <br>
            @if (count($messages) == 0)
        <p>No Messages Found</p>
        <form action="{{route('message.store')}}" method="POST">
            @csrf
            <input type="hidden" name="chat_id" value="{{$chat->id}}">
            <input type="text" name="message">
            <button type="submit">Send Message</button>
        </form>
        @else
        <ul>
        @foreach ($messages as $item)
        <p><b>{{$item->users->name}}:</b>  {{$item->message}} <a href="{{route('message.delete',$item->id)}}">Delete</a></p>
        @endforeach
        </ul>  
        <form action="{{route('message.store')}}" method="POST">
            @csrf
            <input type="hidden" name="chat_id" value="{{$chat->id}}">
            <input type="text" name="message">
            <button type="submit">Send Message</button>
        </form>  
        @endif
        @endif
@endif





@endsection
