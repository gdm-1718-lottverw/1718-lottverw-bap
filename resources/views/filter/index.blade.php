@extends('layouts.app')
@section('content')
 <section class="filter flex start align-stretch justified-start">
  <div class="filter-sidebar flex-child stretch">
   {{ Form::open(array('class' => 'flex column ', 'action' => 'Backoffice\FilterController@test')) }}
        <div class="part flex column">
            <h4 class="sub-title">Leeftijd</h4>
            <span class="item"> {{Form::checkbox('age', 'value')}} {{ Form::label('age', '3 - 4')}} </span>
            <span class="item"> {{Form::checkbox('age', 'value')}} {{ Form::label('age', '5 - 7')}} </span>
            <span class="item"> {{Form::checkbox('age', 'value')}} {{ Form::label('age', '8 - 10')}} </span>
            <span class="item"> {{Form::checkbox('age', 'value')}} {{ Form::label('age', '10 - 12')}} </span>
            <span class="item"> {{Form::checkbox('age', 'value')}} {{ Form::label('age', '+12')}} </span>

        </div>
        <div class="part flex column">
            <h4 class="sub-title">Zindelijk</h4>
            <span class="item"> {{Form::checkbox('potty_trained', 'value')}} {{ Form::label('potty_trained', 'Ja')}} </span>
            <span class="item"> {{Form::checkbox('potty_trained', 'value')}} {{ Form::label('potty_trained', 'Neen')}} </span>
        </div>
       <div class="part flex column">
            <h4 class="sub-title">Allergie</h4>
            <span class="item"> {{Form::checkbox('allergie', 'value')}} {{ Form::label('allergie', 'Voedsel')}} </span>
            <span class="item"> {{Form::checkbox('allergie', 'value')}} {{ Form::label('allergie', 'Insecten')}} </span>
            <span class="item"> {{Form::checkbox('allergie', 'value')}}  {{ Form::label('allergie', 'Allergenen')}} </span>
            <span class="item"> {{Form::checkbox('allergie', 'value')}} {{ Form::label('allergie', 'Dieren')}} </span>
            <span class="item"> {{Form::checkbox('allergie', 'value')}} {{ Form::label('allergie', 'Latex')}} </span>
        </div>
    {{ Form::close() }}
  </div> 
  <div class="filter-group-content">
    <div class="filter-topbar">
        {{ Form::open(array('action' => 'Backoffice\FilterController@test'))  }}
        <h4  class="sub-title">Jarig deze maand</h4>
        <h4 class="sub-title">Geen foto's</h4>
        <h4 class="sub-title">Doet mee aan activiteit</h4>
        <h4 class="sub-title">Middag dutje</h4>
           
        {{ Form::close() }}
    </div> 
    <div class="filter-results">
        <div class="filter-results-item">
            <span class="child-name">id. Child name</span>
            <span class="child-care">Icon</span>
        </div>
    </div>
   </div>
 </section>
     
@endsection('content')