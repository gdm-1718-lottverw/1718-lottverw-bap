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
  </div>
</section>
@endsection('content')