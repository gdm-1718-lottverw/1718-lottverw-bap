@extends('layouts.app')
@section('content')
 <section class="filter flex start align-stretch justified-start">
  <div class="filter-sidebar flex-child stretch">
   {{ Form::open(array('class' => 'flex column', 'action' => 'Backoffice\FilterController@test')) }}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="part flex column">
            <h4 class="sub-title">Aanwezig</h4>
            <span class="item"> {{Form::checkbox('present', 'true', null, ['class' => 'checko'])}} {{ Form::label('present', 'Aanwezig')}} </span>
            <span class="item"> {{Form::checkbox('registered', 'false', null, ['class' => 'checko'])}} {{ Form::label('registered', 'Reservatie')}} </span>
            <span class="item"> {{Form::checkbox('all', 'false')}} {{ Form::label('all', 'Alle')}} </span>
        </div>
         <div class="part flex column">
            <h4 class="sub-title">Opvang type</h4>
            <span class="item"> {{Form::checkbox('type', 'true', null, ['class' => 'checko'])}} {{ Form::label('type', 'Ochtend')}} </span>
            <span class="item"> {{Form::checkbox('type', 'false', null, ['class' => 'checko'])}} {{ Form::label('type', 'Avond')}} </span>
            <span class="item"> {{Form::checkbox('type', 'false')}} {{ Form::label('type', 'Opvang lang')}} </span>
        </div>
        <div class="part flex column">
            <h4 class="sub-title">Organizaties</h4>
            @foreach($or as $sub)
                <span class="item"> {{Form::checkbox('organization',  $sub->name  )}} {{ Form::label('organization',  $sub->name )}} </span>
            @endforeach
        </div>
        <div class="part flex column">
            <h4 class="sub-title">Leeftijd</h4>
            <span class="item"> {{Form::checkbox('age', '3 - 4')}} {{ Form::label('age', '3 - 4')}} </span>
            <span class="item"> {{Form::checkbox('age', '5 - 7')}} {{ Form::label('age', '5 - 7')}} </span>
            <span class="item"> {{Form::checkbox('age', '8 - 10')}} {{ Form::label('age', '8 - 10')}} </span>
            <span class="item"> {{Form::checkbox('age', '10 - 12')}} {{ Form::label('age', '10 - 12')}} </span>
            <span class="item"> {{Form::checkbox('age', '+12')}} {{ Form::label('age', '+12')}} </span>
        </div>
       <div class="part flex column">
            <h4 class="sub-title">Allergie</h4>
            <span class="item"> {{Form::checkbox('allergie', 'food', true)}} {{ Form::label('allergie', 'Voedsel')}} </span>
            <span class="item"> {{Form::checkbox('allergie', 'insect', true)}} {{ Form::label('allergie', 'Insecten')}} </span>
            <span class="item"> {{Form::checkbox('allergie', 'allergene')}}  {{ Form::label('allergie', 'Allergenen')}} </span>
            <span class="item"> {{Form::checkbox('allergie', 'pet')}} {{ Form::label('allergie', 'Dieren')}} </span>
            <span class="item"> {{Form::checkbox('allergie', 'latex')}} {{ Form::label('allergie', 'Latex')}} </span>
        </div>

    {{ Form::close() }}
  </div> 
  <div class="filter-group-content">
    <div class="filter-topbar">
        {{ Form::open(array('class' => 'flex row', 'action' => 'Backoffice\FilterController@test'))  }}
        {{ Form::input('date', 'date', $value = \Carbon\Carbon::now()->format('Y-m-d'), $options = array('class'=>'date')) }}
        <span class="item"> {{Form::checkbox('birthday', 'true', true)}} {{ Form::label('birthday', 'Deze maand jarig')}} </span>
        <span class="item"> {{Form::checkbox('activity', 'true')}}  {{ Form::label('activity', 'Deelname aan activiteit')}} </span>
        <span class="item"> {{Form::checkbox('picture', 'false')}} {{ Form::label('picture', 'Geen foto\'s')}} </span>
        <span class="item"> {{Form::checkbox('potty_trained', 'true')}} {{ Form::label('potty_trained', 'Zindelijkheidstraining')}} </span>
        {{ Form::close() }}
    </div> 
    <div class="filter-results">
     @foreach($children as $child)
        <div class="filter-results-item">
            <span class="child-name">{{$child->id}} {{$child->name}}</span>
            <span class="child-care">Icon</span>
        </div>
     @endforeach
        
    </div>
   </div>
 </section>
    
@endsection('content')