@extends('layouts.app')

@section('content')

  <section class="home" id="home">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @if(Count($leftOver) > 0)
    <div id="container-leftover">
      @include('home.partials.leftOvers')
    </div> 
    @endif
     @if(Count($leftOver) == 0 && Count($in) == 0 && Count($out) == 0 && Count($toCome) == 0)
    <p class="title">Geen inschrijvingen voor
      @if(Carbon\Carbon::now()->format('h:i:s') < \Carbon\Carbon::create(2017, 12, 23, 12, 01, 00)->format('H:i:s')) 
        deze namiddag
        @else 
        deze voormiddag
      @endif</p>
    @endif
    <i onClick="showHide('show', '#overlay')" class="fa fa-plus btn-fab blue" aria-hidden="true"></i>
    <div id="container-future">
      @include('home.partials.future')
    </div>  
    <div id="container-in">
      @include('home.partials.in')
    </div>
    <div id="container-out">
      @include('home.partials.out')
    </div>

    <div id="overlay" class="hide flex justified-c">
      <div class="flex justified-end">
        <i onClick="showHide('hide', '#overlay')" class="fa fa-times btn-fab top pink flex-child center" aria-hidden="true"></i>
      </div>
      {{Form::open(array('action' => 'Backoffice\Home\IndexController@storeChild', 'class' => 'form flex-child center'))}}
        <h1 class="overlay-title">Extra inschrijving</h1>
        {{-- TOKEN --}}
        {{ Form::hidden('_token', csrf_token() )}}
        {{ Form::hidden('_date', Carbon\Carbon::now() )}}
        {{ Form::hidden('_date', Carbon\Carbon::now() )}}
        {{ Form::hidden('_in', true )}}
        {{ Form::hidden('_out', false )}}
        <div class="flex column">
          <div class="form-group flex column">
            {{ Form::label('type', 'Selecteer een dagtype')}}
            <div class="select-dropdown">
              <select name="type" id="type" class="form-control">
                <option value=""> -- Selecteer een dagtype --</option>
                <option value="voormiddag">Voormiddag</option>
                <option value="namiddag">Namiddag</option>
              </select>
            </div>
          </div>
          <div class="form-group flex column">
            {{ Form::label('child_id', 'Selecteer een kind')}}
            <div class="select-dropdown">
              <select name="child_id" id="child" class="form-control">
                <option value=""> -- Selecteer een kind --</option>
                @foreach ($children as $child)
                  <option value="{{ $child->id }}">{{ $child->name }}</option>
                @endforeach 
              </select>
            </div>
          </div>
        </div>
        <div class="flex justified-end">
          {!! Form::submit('Opslaan', array('class'=>'btn flex-child end')) !!}
        </div>
    </div> 
  </section>

@endsection('content')