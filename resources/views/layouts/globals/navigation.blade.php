<div class="navigation">
    <a href="/">
        <i class="fa fa-home" aria-hidden="true"></i>
    </a>
     <a href="/filter">
        <i class="fa fa-search" aria-hidden="true"></i>
    </a>
     <a href="/log">
        <i class="fa fa-history" aria-hidden="true"></i>
    </a>
     <a href="/list">
        <i class="fa fa-list" aria-hidden="true"></i>
    </a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out" aria-hidden="true"></i>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</div>


