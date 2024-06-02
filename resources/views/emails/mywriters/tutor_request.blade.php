@extends('emails.mywriters.layout')

@section('content')

<p>Hi {{$name}}</p>
<p>You have received a order request. Please <a href="{{$url}}">click here</a> to view order</p>
<p>Thanks</p>

@endsection