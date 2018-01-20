@extends('layouts.app')

@section('content')
<section id="settings" class="settings">
  <div class="settings-nav flex row justified-start">
     <a href="/settings" class="{{ Route::currentRouteNamed('settings') ? 'active' : '' }} flex justified-c centered">
        <i class="fa fa-calendar" aria-hidden="true"></i>
    </a>
    <!--a href="/parents" class="{{ Route::currentRouteNamed('parents') ? 'active' : '' }} flex justified-c centered">
        <i class="fa fa-users" aria-hidden="true"></i>
    </a>
    <a href="/organizations" class="{{ Route::currentRouteNamed('organizations') ? 'active' : '' }} flex justified-c centered">
        <i class="fa fa-sitemap" aria-hidden="true"></i>
    </a-->
  </div>
  <p class='title-main'>Instellingen</p>
  <p class="title marginTop">Sluitings dag toevoegen</p>
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
		<div class="flex row">
			<div class="form-group flex column">
					{{ Form::label('occasion', 'Rede sluiting')}}
					{{ Form::text('occasion', null, ['placeholder' => 'bv. Permanente vorming.'])}}
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
  <p class="title">Overzicht sluitingsdagen</p>
  <div class="content flex row wrap">
  	@foreach($vacations as $v)
  	<div id="row-{{$v->id}}" class="item flex row centered justified-start">
  		<p class="o">{{$v->occasion}}</p>
  		<p class="d">{{$v->day}}</p>
      <a  class="trash" onClick="deleteConfirm('{{$v->occasion}}', '/settings/delete/date', {'_token': '{{ csrf_token() }}', '_id': '{{$v->id}}'}, '{{$v->id}}' )"><button><i class="fa fa-trash" aria-hidden="true"></i></button></a>
  	</div>
  	@endforeach
  </div>
</section>
@endsection('content')