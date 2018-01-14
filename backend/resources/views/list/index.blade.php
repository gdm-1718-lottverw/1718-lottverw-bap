@extends('layouts.app')

@section('content')
  <section class="list">
  <div class="flex wrap justified-start">
    @foreach($children as $child)
      <a href='/child/{{$child->id}}' class="child-item">{{$child->id}}. {{$child->name}}</a>
    @endforeach
    </div>
  </section>
@endsection