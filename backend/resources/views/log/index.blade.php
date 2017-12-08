@extends('layouts.app')

@section('content')

  @foreach($log as $l) 
    <p>{{$l->updated_at}}</p>
    @if($log->in == true)
    <p>IN</p>
    @elseIf($l->out == true)
    <p>OUT</p>
    @endif
  @endforeach

@endsection('content')