@extends('emails.mywriters.layout')

@section('content')
<p>{!!$messageContent!!}</p>
<br>
<p><a href="{{$url}}">Read more...</a></p>

@endsection