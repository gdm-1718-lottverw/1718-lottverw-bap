<div class="navigation">
    <a href="/" class="{{ Route::currentRouteNamed('home') ? 'active' : '' }}">
        <i class="fa fa-home" aria-hidden="true"></i>
    </a>
     <a href="/filter" class="{{ Route::currentRouteNamed('filter') ? 'active' : '' }}">
        <i class="fa fa-search" aria-hidden="true"></i>
    </a>
     <a href="/log" class="{{ Route::currentRouteNamed('log') ? 'active' : '' }}">
        <i class="fa fa-pencil" aria-hidden="true"></i>
    </a>
     <a href="/list" class="{{ Route::currentRouteNamed('list') ? 'active' : '' }}">
        <i class="fa fa-list" aria-hidden="true"></i>
    </a>

     <span class="padded"></span>
       <a></a>
    <a href="/add/parents" class="{{ Route::currentRouteNamed('parents') ? 'active' : '' }} admin">
        <i class="fa fa-user-plus" aria-hidden="true"></i>
    </a>

    <a href="/settings" class="{{ Route::currentRouteNamed('settings') ? 'active' : '' }} admin">
        <i class="fa fa-cog" aria-hidden="true"></i>
    </a>
   
    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out" aria-hidden="true"></i>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</div>


