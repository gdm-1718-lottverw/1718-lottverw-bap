<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Rhino</title>
        <link href="/css/vendor/nouislider.min.css" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet"> 
        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet" type="text/css">

    </head>
    
    <body>
        @guest
            <ul class="guest-navigation flex justified-end">
                <li class="flex-child center"><a href="{{ route('login') }}">Login</a></li>
                <li class="flex-child center"><a href="{{ route('register') }}">Register</a></li>
            </ul>
        @else
             <div class="header">
                <span class="location">{{ Auth::user()->username }}</span>
                <span class="date">
                    <?php $mytime = Carbon\Carbon::now();
                        echo $mytime->format('d/m/y, H:i');
                    ?>
                </span>
            </div>
            @include('layouts.globals.navigation')
        @endguest
        @yield('content')
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="/js/vendor/nouislider.min.js"></script>
        <script src="/js/main/app.js"></script>
                <script>
                    $( document ).ready(function() {
                        // HOME SIGN IN OR OUT
                        function signLeftoverInOut(action, oldContainer, oldId, e){
                            $.ajax({
                                method: "POST",
                                url: "/leftover/" + action,
                                data: {'id': e.target.id, '_token': $('input[name=_token]').val()},
                            }).done(function( msg ) {
                                $('div#'+oldContainer).load(document.URL +  " div#"+oldContainer);
                            })
                        }
                            
                            $('#container-leftover').on('click', '.fa-sign-in', (e) => {
                               signLeftoverInOut('sign-in', 'container-leftover', 'left-over', e);
                            });
                            $('#container-leftover').on('click', '.fa-sign-out', (e) => {
                                signLeftoverInOut('sign-out', 'container-leftover', 'left-over', e);
                            });
                        });
                </script>
</html>
