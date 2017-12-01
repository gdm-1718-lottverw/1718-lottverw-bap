@extends('layouts.app')
@section('content')
 <section class="filter flex start align-stretch justified-start">
  <div class="filter-sidebar flex-child stretch">
   {{ Form::open(array('class' => 'flex column', 'action' => 'Backoffice\FilterController@create')) }}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="part flex column">
            <h4 class="sub-title">Aanwezig</h4>
            <span class="item"> {{Form::radio('present', 'present_present', true, ['class' => 'checko'])}} {{ Form::label('present', 'Aanwezig')}} </span>
            <span class="item"> {{Form::radio('present', 'present_registered', null, ['class' => 'checko'])}} {{ Form::label('registered', 'Reservatie')}} </span>
            <span class="item"> {{Form::radio('present', 'present_all')}} {{ Form::label('all', 'Alle')}} </span>
        </div>
         <div class="part flex column">
            <h4 class="sub-title">Opvang type</h4>
            <span class="item"> {{Form::checkbox('type', 'type_moring', null, ['class' => 'checko'])}} {{ Form::label('type', 'Ochtend')}} </span>
            <span class="item"> {{Form::checkbox('type', 'type_evening', null, ['class' => 'checko'])}} {{ Form::label('type', 'Avond')}} </span>
            <span class="item"> {{Form::checkbox('type', 'type_long')}} {{ Form::label('type', 'Opvang lang')}} </span>
            <span class="item"> {{Form::checkbox('type', 'type_full_day')}} {{ Form::label('type', 'Volledige dag')}} </span>
        </div>
        <div class="part flex column">
            <h4 class="sub-title">Organizaties</h4>
            @foreach($or as $sub)
                <span class="item"> {{Form::checkbox('organization',  $sub->name  )}} {{ Form::label('organization',  $sub->name )}} </span>
            @endforeach
        </div>
        <div class="part flex column">
            <h4 class="sub-title">Leeftijd</h4>
            <span class="item"> {{Form::checkbox('age', 'age_3_4')}} {{ Form::label('age', '3 - 4')}} </span>
            <span class="item"> {{Form::checkbox('age', 'age_5_7')}} {{ Form::label('age', '5 - 7')}} </span>
            <span class="item"> {{Form::checkbox('age', 'age_8_10')}} {{ Form::label('age', '8 - 10')}} </span>
            <span class="item"> {{Form::checkbox('age', 'age_10_12')}} {{ Form::label('age', '10 - 12')}} </span>
            <span class="item"> {{Form::checkbox('age', 'age_+12')}} {{ Form::label('age', '+12')}} </span>
        </div>
       <div class="part flex column">
            <h4 class="sub-title">Allergie</h4>
            <span class="item"> {{Form::checkbox('allergie', 'allergie_food')}} {{ Form::label('allergie', 'Voedsel')}} </span>
            <span class="item"> {{Form::checkbox('allergie', 'allergie_insect')}} {{ Form::label('allergie', 'Insecten')}} </span>
            <span class="item"> {{Form::checkbox('allergie', 'allergie_allergene')}}  {{ Form::label('allergie', 'Allergenen')}} </span>
            <span class="item"> {{Form::checkbox('allergie', 'allergie_pet')}} {{ Form::label('allergie', 'Dieren')}} </span>
            <span class="item"> {{Form::checkbox('allergie', 'allergie_latex')}} {{ Form::label('allergie', 'Latex')}} </span>
        </div>

    {{ Form::close() }}
  </div> 
  <div class="filter-group-content">
    <div class="filter-topbar">
        {{ Form::open(array('class' => 'flex row', 'action' => 'Backoffice\FilterController@create'))  }}
        <span class="item"> {{ Form::input('date', 'date', $value = \Carbon\Carbon::now()->format('Y-m-d'), $options = array('class'=>'date')) }}</span>
        <span class="item"> {{Form::checkbox('birthday', 'birthday')}} {{ Form::label('birthday', 'Deze maand jarig')}} </span>
        <span class="item"> {{Form::checkbox('activity', 'activity')}}  {{ Form::label('activity', 'Deelname aan activiteit')}} </span>
        <span class="item"> {{Form::checkbox('picture', 'picture')}} {{ Form::label('picture', 'Geen foto\'s')}} </span>
        <span class="item"> {{Form::checkbox('potty_trained', 'potty_trained')}} {{ Form::label('potty_trained', 'Zindelijkheidstraining')}} </span>
        {{ Form::close() }}
    </div> 
    <div class="filter-results">
     @foreach($children as $child)
        <div class="filter-results-item">
            <span class="child-name">{{$child->id}} {{$child->name}}</span>
            <span class="child-care">
                @if($child->potty_trained == false)
                    <i class="fa fa-tint" aria-hidden="true"></i>
                @endif
            </span>
        </div>
     @endforeach
    </div>
   </div>
 </section>
    
@endsection('content')