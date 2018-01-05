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
                        var node;
                        var count = {medical: 0, pedagogic: 0, allergies: 0, guardian: 0};
                        var stop = "<p class='disabled'>Er kunnen maar 3 extra items worden toegevoegd</p>";
                        // ADD PARENT DEPENDING ON SELECTED FAMILY TYPE
                        $( "#family_type" ).change(function(e) {
                          var selected = e.target.selectedOptions[0].value;
                            if(selected == "alleenstaande ouder"){
                                console.log('selected:', selected);
                                node = $('#parent-1').detach();
                            } else {
                                $('.section').append(node);
                            }
                        });

                        // ADD CONDITION WHEN CLICKED
                        addNode = (condition) => {
                            count[condition]++;
                            if(count[condition] == 4){
                                $('#' + condition).replaceWith(stop);
                            }
                             else if(count[condition] < 4){
                                 // Node we want to clone
                                node =  $('#container_' + condition);
                                // We need to change the values for each input item
                                var updated_node = node.clone();
                                // Let's change the id for clean code.
                                updated_node.id = "container_" + count[condition] + '_' + condition;
                                updated_node.attr("id", updated_node.id);
                                var inputs = updated_node.find('input');
                                var selects = updated_node.find('select');
                                var labels = updated_node.find('label');
                                $.each(inputs,(i, e) => {
                                    name = $(e).prop('name');
                                    name = name.slice(0,-1);
                                    $(e).attr("name", name + count[condition]);
                                })
                                $.each(labels,(i, e) => {
                                    name = $(e).prop('for');
                                      name = name.slice(0,-1);
                                    $(e).attr("for", name + count[condition]);
                                })
                                $.each(selects,(i, e) => {
                                    name = $(e).prop('name');
                                    name = name.slice(0,-1);
                                    $(e).attr("name", name + count[condition]);
                                })
                                // Insert the new node in the dom.
                                updated_node.insertBefore('#' + condition);
                            }
                            else {
                                return;
                            }
                          
                        }
                    });
                </script>
</html>
