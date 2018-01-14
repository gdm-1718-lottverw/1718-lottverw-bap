@extends('layouts.app')

@section('content')
<section id="settings" class="settings">
  <div class="settings-nav flex row justified-start">
     <a href="/settings" class="{{ Route::currentRouteNamed('settings') ? 'active' : '' }} flex justified-c centered">
        <i class="fa fa-calendar" aria-hidden="true"></i>
    </a>
    <a href="/parents" class="{{ Route::currentRouteNamed('parents') ? 'active' : '' }} flex justified-c centered">
        <i class="fa fa-users" aria-hidden="true"></i>
    </a>
    <a href="/organizations" class="{{ Route::currentRouteNamed('organizations') ? 'active' : '' }} flex justified-c centered">
        <i class="fa fa-sitemap" aria-hidden="true"></i>
    </a>
  </div>
  <div class="add">
  		@if ($errors->any())
	    <div class="error flex column">
		     @foreach ($errors->all() as $error)
		            <p>{{ $error }}</p>
		        @endforeach
		    </div>
		@endif
  	{{Form::open(array('action' => 'Backoffice\Settings\IndexController@store', 'class' => 'form'))}}
		{{-- TOKEN --}}
		{{ Form::hidden('_token', csrf_token() )}}
	
		<p class="title">Vakantie dag toevoegen</p>
		<div class="flex row">
			<div class="form-group flex column">
					{{ Form::label('occasion', 'Rede')}}
					{{ Form::text('occasion', null, ['placeholder' => 'Korte beschrijving'])}}
					<div class="border"></div>
			</div>
			<div class="form-group flex column">
					{{ Form::label('day', 'Datum')}}
					{{ Form::text('day', null, ['placeholder' => 'voorbeeld: 01/02/2019'])}}
					<div class="border"></div>
			</div>
		</div>
		<div class="flex justified-end">
			{!! Form::submit('Toevoegen', array('class'=>'btn')) !!}
		</div>
	{{Form::close()}}
  </div>
  <div class="content flex row wrap">
  	@foreach($vacations as $v)
  	<div class="item flex row centered justified-start">
  		<p class="o">{{$v->occasion}}</p>
  		<p class="d">{{$v->day}}</p>
        {{ Form::open(array('action' => 'Backoffice\Settings\IndexController@delete', 'class' => 'trash')) }} 
        {{ Form::hidden('_id', $v->id )}}
        {{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['type' => 'submit']) }}
        {{ Form::close()}}
  	</div>
  	@endforeach
  </div>
</section>
@endsection('content')