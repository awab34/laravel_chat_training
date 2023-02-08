@extends('layouts.app')

@section('content')
@if(is_null($chat))
    <p>There is no Chat</p>
@else
    <p> <b>Chat Name:</b> {{$chat->chat_name}}</p>
    <p> <b>The Users Are:</b></p>
    <ul>
        @foreach ($chat->users as $user)
        <li><p>{{$user->name}}</p></li>
        @endforeach
        </ul>
@endif

@if ($chat->admin_id == Auth::id())
<form action="{{route('chat.update',$chat->id)}}" method="POST">
    @csrf
    @method('PUT')
    @foreach ($users as $item)
    <div class="form-check">
    <input type="checkbox" name="users[]" class="form-check-input"  value="{{ $item->id }}" @foreach ($chat->users as $user)
        @if ($item->id == $user->id)
        {{ 'checked' }}
        @endif
    @endforeach /> <label class="form-check-label">{{$item->name}}</label>
</div>
    @endforeach
    <button type="submit">Add Users</button>

    </form>
@endif


@if (count($messages) == 0)
<p>No Messages Found</p>
@else
<ul>
@foreach ($messages as $item)
<li><a href="{{route('create.show',$item->id)}}">{{$item->chat_name}}</a></li>
@endforeach
</ul>    
@endif
@endsection
