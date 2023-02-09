@extends('layouts.app')

@section('content')


<a href="{{route('add.firend')}}">Add Friends</a>
@if (count($freindRequests) > 0)
    <ul>
        @foreach ($freindRequests as $item)
        <li><b>{{$item['name']}}</b> 
        <form action="{{route('accept.friend')}}" method="post">
            @csrf
            <input type="hidden" name="first_freind" value="{{$item['requester']}}">
            <input type="hidden" name="status" value="1">
            <input type="hidden" name="requestId" value="{{$item['id']}}">
            <button type="submit">Accept</button>
        </form>
        <form action="{{route('accept.friend')}}" method="post">
            @csrf
            <input type="hidden" name="first_freind" value="{{$item['requester']}}">
            <input type="hidden" name="status" value="2">
            <input type="hidden" name="requestId" value="{{$item['id']}}">
            <button type="submit">Reject</button>
        </form>
    </li>
            
    @endforeach
        
    </ul>
@endif
@if (count($friends) == 0 )
<p>No Friends Found</p>
@else
<table>
    <tr>
        <th>Friend Name</th>
        <th>Actions</th>
    </tr>
    @foreach ($friends as $item)
    <tr><td><p><b>{{$item['name']}}</b></p></td>
        
        <td><a href="{{route('unfriend',$item['id'])}}">Unfriend</a>
        <a href="{{route('message.friend',$item['id'])}}">Chat</a></td>
        
    </tr>
    @endforeach
    
</table>

   
@endif




@endsection
