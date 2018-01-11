<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Rhino</title>
        <link href="{{asset('/css/vendor/nouislider.min.css')}}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet"> 
        <!-- Styles -->
        <link href="{{asset('/css/app.css')}}" rel="stylesheet" type="text/css">

    </head>
    
    <body>
        @guest
        @else
           <!--  <div class="header">
                <span class="location">{{ Auth::user()->username }}</span>
                <span class="date">
                    <?php $mytime = Carbon\Carbon::now();
                        echo $mytime->format('d/m/y, H:i');
                    ?>
                </span>
            </div> --> 
            @include('layouts.globals.navigation')
        @endguest
        @yield('content')
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
         <script src="{{asset('/js/vendor/nouislider.min.js')}}"></script>
        <script src="{{asset('/js/main/app.js')}}"></script>
</html>
