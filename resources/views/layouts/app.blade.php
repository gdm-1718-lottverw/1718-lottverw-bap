<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Rhino</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="header">
            <span class="location">Mariaschool Grobbendonk</span>
            <span class="date">
                <?php $mytime = Carbon\Carbon::now();
                    echo $mytime->format('D, d M \'y, H:i');
                ?>
            </span>
        </div>
        @include('layouts.globals.navigation')
        @yield('content')
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="/js/app.js"></script>
        <script>


        $(document).ready(function(){ 
            /* HOME */
            $('.fa-sign-in').click((e) => {
                console.log(e.target.id);
                $.ajax({
                    method: "POST",
                    url: "/sign-in",
                    data: {'id': e.target.id, '_token': $('input[name=_token]').val()},
                })
                .done(function( msg ) {
                   $('.home').replaceWith(msg);
                });
            });

            $('.fa-sign-out').click((e) => {
                console.log(e.target.id);
                $.ajax({
                    method: "POST",
                    url: "/sign-out",
                    data: {'id': e.target.id, '_token': $('input[name=_token]').val()},
                })
                .done(function( msg ) {
                   $('.home').replaceWith(msg);
                });
            });

            /* FILTER*/
             $('.item input').change(() => {        
                var data = [{}];
                var date = $('input[name=date]').val();
                
                $('.item input:checked').each(function(index) {
                    var name = $(this)[0]['name'];
                    var value = $(this).val();
        
                    var O = {
                        [name]: [value]
                    }

                });
                    $.ajax({
                        method: "POST",
                        url: "filter",
                        data: {'data': data, 'date': date, '_token': $('input[name=_token]').val()},
                        })
                    .done(function( msg ) {
                        $('.filter-results').replaceWith(msg);
                    });
                });
        });
        </script>
    </body>
</html>