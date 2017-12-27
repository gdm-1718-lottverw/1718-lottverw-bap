@extends('layouts.app')
@section('content')
 <section class="filter flex start align-stretch justified-start">
  <div class="filter-sidebar flex-child stretch">
   {{ Form::open(array('class' => 'flex column', 'action' => 'Backoffice\Filter\IndexController@create')) }}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="part flex column">
            <h4 class="sub-title">Aanwezig</h4>
            <span class="item"> {{Form::radio('present', 'present_present', true, ['class' => 'checko'])}} {{ Form::label('present', 'Aanwezig')}} </span>
            <span class="item"> {{Form::radio('present', 'present_out')}} {{ Form::label('out', 'Uit')}} </span>
            <span class="item"> {{Form::radio('present', 'present_registered', null, ['class' => 'checko'])}} {{ Form::label('registered', 'Reservatie')}} </span>
            <span class="item"> {{Form::radio('present', 'present_all')}} {{ Form::label('all', 'alle')}} </span>
        </div>
         <div class="part flex column">
            <h4 class="sub-title">Opvang type</h4>
            <span class="item"> {{Form::checkbox('type', 'morning', null, ['class' => 'checko'])}} {{ Form::label('type', 'Ochtend')}} </span>
            <span class="item"> {{Form::checkbox('type', 'evening', null, ['class' => 'checko'])}} {{ Form::label('type', 'Avond')}} </span>
            <span class="item"> {{Form::checkbox('type', 'full_day')}} {{ Form::label('type', 'Volledige dag')}} </span>
        </div>
        <div class="part flex column">
            <h4 class="sub-title">Organizaties</h4>
            @foreach($or as $sub)
                <span class="item"> {{Form::checkbox('organization',  $sub->name  )}} {{ Form::label('organization',  $sub->name )}} </span>
            @endforeach
        </div>
        <div class="part flex column">
            <h4 class="sub-title">Leeftijd</h4>
            <div id='slider'></div>
        </div>
       <div class="part flex column">
            <h4 class="sub-title">Allergie</h4>
            <span class="item"> {{Form::checkbox('allergie', 'food')}} {{ Form::label('allergie', 'Voedsel')}} </span>
            <span class="item"> {{Form::checkbox('allergie', 'insect')}} {{ Form::label('allergie', 'Insecten')}} </span>
            <span class="item"> {{Form::checkbox('allergie', 'allergene')}}  {{ Form::label('allergie', 'Allergenen')}} </span>
            <span class="item"> {{Form::checkbox('allergie', 'pet')}} {{ Form::label('allergie', 'Dieren')}} </span>
            <span class="item"> {{Form::checkbox('allergie', 'latex')}} {{ Form::label('allergie', 'Latex')}} </span>
        </div>

    {{ Form::close() }}
  </div> 
  <div class="filter-group-content">
    <div class="filter-topbar">
        {{ Form::open(array('class' => 'flex row', 'action' => 'Backoffice\Filter\IndexController@create')) }}
        <span class="item"> {{ Form::input('date', 'date', $value = \Carbon\Carbon::now()->format('Y-m-d'), $options = array('class'=>'date')) }}</span>
        <span class="item"> {{Form::checkbox('birthday', 'true')}} {{ Form::label('birthday', 'Deze maand jarig')}} </span>
        <span class="item"> {{Form::checkbox('activity', 'true')}}  {{ Form::label('activity', 'Deelname aan activiteit')}} </span>
        <span class="item"> {{Form::checkbox('picture', 'true')}} {{ Form::label('picture', 'Geen foto\'s')}} </span>
        <span class="item"> {{Form::checkbox('potty_trained', 'false')}} {{ Form::label('potty_trained', 'Zindelijkheidstraining')}} </span>
        {{ Form::close() }}
    </div> 
    <div class="filter-results">
     @foreach($planned as $child)
        <div class="filter-results-item">
            <span class="child-name">{{$child->child_id}} {{$child->name}}</span>
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