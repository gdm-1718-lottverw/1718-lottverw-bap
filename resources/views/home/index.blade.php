@extends('layouts.app')

@section('content')

  <section class="home" id="home">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div id="to-come" class="flex wrap justified-start">
      @include('home.partials.future')
    </div>  
    <div id="in" class="flex wrap justified-start">
      @include('home.partials.in')
    </div>
    <div id="out" class="flex wrap justified-start">
      @include('home.partials.out')
    </div> 
  </section>

@endsection('content')