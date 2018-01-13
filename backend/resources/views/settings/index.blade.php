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
  	{{Form::open(array('action' => 'Backoffice\Parents\IndexController@store', 'class' => 'form'))}}
		{{-- TOKEN --}}
		{{ Form::hidden('_token', csrf_token() )}}
	{{Form::close()}}
  </div>
  <div class="content flex row wrap">
  	@foreach($vacations as $v)
  	<div class="item flex row justified-s">
  		<p>{{$v->occasion}}</p>
  		<p>{{$v->day}}</p>
  	</div>
  	@endforeach
  </div>
</section>
@endsection('content')