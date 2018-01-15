@extends('layouts.app')

@section('content')
  <section class="list">
	<p class="title">Lijst van alle kinderen geregistreerd in deze opvang.</p>
	<div class="flex wrap justified-start children">
	   @foreach($children as $child)
	      <a href='/child/{{$child->id}}' class="child-item">{{$child->id}}. {{$child->name}}</a>
	    @endforeach
    </div>
  </section>
@endsection