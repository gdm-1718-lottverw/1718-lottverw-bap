@extends('layouts.app')

@section('content')

  <section class="home" id="home">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @if(Count($leftOver)>0)
    <div id="container-leftover">
      @include('home.partials.leftOvers')
    </div> 
    @endif
    <div class="flex justified-end">
      <i onClick="showHide('show', '#overlay')" class="fa fa-plus btn-fab yellow flex-child center" aria-hidden="true"></i>
    </div>
    <div id="container-future">
      @include('home.partials.future')
    </div>  
    <div id="container-in">
      @include('home.partials.in')
    </div>
    <div id="container-out">
      @include('home.partials.out')
    </div>
    <div id="overlay" class="hide">
      <div class="flex justified-end">
        <i onClick="showHide('hide', '#overlay')" class="fa fa-times btn-fab pink flex-child center" aria-hidden="true"></i>
      </div>
      {{Form::open(array('action' => 'Backoffice\Home\IndexController@storeChild', 'class' => 'form'))}}
        {{-- TOKEN --}}
        {{ Form::hidden('_token', csrf_token() )}}
        {{ Form::hidden('_date', Carbon\Carbon::now() )}}
        {{ Form::hidden('_date', Carbon\Carbon::now() )}}
        {{ Form::hidden('_in', true )}}
        {{ Form::hidden('_out', false )}}
        <div class="select-dropdown">
          {{ Form::label('type', 'Selecteer een dagtype')}}
          <select name="type" id="type" class="form-control">
            <option value=""> -- Selecteer een dagtype --</option>
            <option value="voormiddag">Voormiddag</option>
            <option value="namiddag">Namiddag</option>
            <option value="hele dag">hele dag</option>
          </select>
        </div>
        <div class="select-dropdown">
          {{ Form::label('child_id', 'Selecteer een kind')}}
          <select name="child_id" id="child" class="form-control">
            <option value=""> -- Selecteer een kind --</option>
            @foreach ($children as $child)
              <option value="{{ $child->id }}">{{ $child->name }}</option>
            @endforeach 
          </select>
        </div>
      {!! Form::submit('Opslaan', array('class'=>'btn')) !!}
    </div> 
  </section>

@endsection('content')