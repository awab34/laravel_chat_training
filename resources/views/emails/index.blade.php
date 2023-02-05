@extends('layouts.app')

@section('content')
<form action="{{route('send.email')}}" method="POST">
@csrf
<textarea name="content" id="" cols="30" rows="10"></textarea>
<button type="submit">Send Email</button>
</form>
@endsection
