@extends('layouts.app')

@section('content')
<form action="{{route('chat.store')}}" method="POST">
@csrf
<label for="">Chat Name</label><input type="text" name="chat_name">
<button type="submit">Create Chat</button>
</form>
@endsection
