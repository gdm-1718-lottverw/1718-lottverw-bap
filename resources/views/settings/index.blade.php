@extends('layouts.app')

@section('content')
<section id="settings" class="settings">
  <div class="settings-nav">
     <a href="/settings" class="{{ Route::currentRouteNamed('settings') ? 'active' : '' }}">
        <i class="fa fa-calendar" aria-hidden="true"></i>
    </a>
    <a href="/parents" class="{{ Route::currentRouteNamed('parents') ? 'active' : '' }}">
        <i class="fa fa-users" aria-hidden="true"></i>
    </a>
  </div>
</section>
@endsection('content')