@extends('layouts.app')

@section('content')

  <section class="home" id="home">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @if(Count($leftOver)>0)
    <div id="container-leftover">
      @include('home.partials.leftOvers')
    </div> 
    @endif
    <div id="container-future">
      @include('home.partials.future')
    </div>  
    <div id="container-in">
      @include('home.partials.in')
    </div>
    <div id="container-out">
      @include('home.partials.out')
    </div> 
  </section>

@endsection('content')