@extends('layouts.app')
@section('content')
 <section class="filter flex column">
    <div class="filter-topbar flex row justified-start centered">
        {{ Form::open(array('class' => 'flex row', 'action' => 'Backoffice\Filter\IndexController@create')) }}
        <span class="item flex row centered jutified-c"> {{ Form::input('date', 'date', $value = \Carbon\Carbon::now()->format('Y-m-d'), $options = array('class'=>'date')) }}</span>
        <span class="item flex row centered jutified-c"> {{Form::checkbox('birthday', 'true')}} {{ Form::label('birthday', 'Deze maand jarig')}} </span>
        <span class="item flex row centered jutified-c"> {{Form::checkbox('picture', 'true')}} {{ Form::label('picture', 'Geen foto\'s')}} </span>
        <span class="item flex row centered jutified-c"> {{Form::checkbox('potty_trained', 'false')}} {{ Form::label('potty_trained', 'Zindelijkheidstraining')}} </span>
        {{ Form::close() }}
    </div>  
    <div class="search-content flex row justified-start">
        <div class="search">
           {{ Form::open(array('class' => 'flex column', 'action' => 'Backoffice\Filter\IndexController@create')) }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="part flex column">
                    <h4 class="sub-title">Aanwezig</h4>
                    <span class="item flex row centered jutified-c"> {{Form::radio('present', 'present_present', true, ['class' => 'checko'])}} {{ Form::label('present', 'Aanwezig')}} </span>
                    <span class="item flex row centered jutified-c"> {{Form::radio('present', 'present_out', null)}} {{ Form::label('out', 'Uit')}} </span>
                    <span class="item flex row centered jutified-c"> {{Form::radio('present', 'present_registered', null, ['class' => 'checko'])}} {{ Form::label('registered', 'Reservatie')}} </span>
                    <span class="item flex row centered jutified-c"> {{Form::radio('present', 'present_all', null)}} {{ Form::label('all', 'alle')}} </span>
                </div>
                 <div class="part flex column">
                    <h4 class="sub-title">Opvang type</h4>
                    <span class="item flex row centered jutified-c"> {{Form::checkbox('type', 'voormiddag', null, ['class' => 'checko'])}} {{ Form::label('type', 'Voormiddag')}} </span>
                    <span class="item flex row centered jutified-c"> {{Form::checkbox('type', 'namiddag', null, ['class' => 'checko'])}} {{ Form::label('type', 'Namiddag')}} </span>
                 </div>
               <div class="part flex column">
                    <h4 class="sub-title">Allergie</h4>
                    <span class="item flex row centered jutified-c"> {{Form::checkbox('allergie', 'food')}} {{ Form::label('allergie', 'Voedsel')}} </span>
                    <span class="item flex row centered jutified-c"> {{Form::checkbox('allergie', 'insects')}} {{ Form::label('allergie', 'Insecten')}} </span>
                    <span class="item flex row centered jutified-c"> {{Form::checkbox('allergie', 'animals')}} {{ Form::label('allergie', 'Dieren')}} </span>
                    <span class="item flex row centered jutified-c"> {{Form::checkbox('allergie', 'other')}} {{ Form::label('allergie', 'Ander')}} </span>
                </div>
                 <div class="part flex column">
                    <h4 class="sub-title">Pedagogie</h4>
                    <span class="item flex row centered jutified-c"> {{Form::checkbox('pedagogic', 'true')}} {{ Form::label('pedagogic', 'extra aandacht')}} </span>
                    <span class="item flex row centered jutified-c"></span>
                </div>
                 <div class="part flex column">
                    <h4 class="sub-title">Medische aandacht</h4>
                    <span class="item flex row centered jutified-c"> {{Form::checkbox('medical', 'true')}} {{ Form::label('medical', 'medische aandacht')}} </span>
                    <span class="item flex row centered jutified-c"></span>
                </div>
                <div class="part flex column">
                    <h4 class="sub-title">Leeftijd</h4>
                    <div id='slider'></div>
                </div>
            {{ Form::close() }}
        </div>
        <div class="filter-results flex wrap">
        @foreach($planned as $child)
            <div class="filter-results-item flex column justified-start">
                <span class="child-name">{{$child->name}}</span>
                <div class="child-care">
                    @if($child->parent_notes != null)
                       <p class="description">{{$child->parent_notes}}</p>
                    @endif
                </div>
            </div>
        @endforeach
        </div>
    </div> 
 </section>
    
@endsection('content')