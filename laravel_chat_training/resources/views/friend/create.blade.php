@extends('layouts.app')

@section('content')

<form action="{{route('search.friend')}}" method="POST">
    @csrf
    <label for=""><b>Search For A New Friend:</b></label>
    <input type="text" name="name">
    <button type="submit">Search</button>
</form>
@if (isset($searchResult))
    @if (count($searchResult) == 0)
        <p>No User Found</p>
    @else
    <table>
        <tr>
            <th>User Name</th>
            <th>Action</th>
        </tr>
        @foreach ($searchResult as $item)
        
        <tr><td><p><b>{{$item['name']}}</b></p></td>
            
            <td><a href="{{route('request.friend',$item['id'])}}">Request Friendship</a></td>
            
        </tr>
        
        @endforeach
    </table>
    @endif
    
@endif

@endsection