@extends('emails.educrafter.layout')

@section('content')

<p>Hi {{$name}}</p>
<p>{{$messageContent}}</p>
<p>Thanks</p>

@endsection