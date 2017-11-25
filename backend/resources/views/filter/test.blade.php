<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title>Laravel</title>

        <!-- Fonts -->
       <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">    </head>
    <body>
        <div class="container">
         </br>
          </br>
            <div class="row align-items-start">
                <h1>Testing the filter.</h1>
                <p>Create a simple child filter with ajax. Use child in stead of to do's :).</p>
            </div>
            </br>
            <div class="row align-items-end">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Text </label>
                        <input type="text" name="content" class="form-control" id="exampleInputEmail1"  aria-describedby="emailHelp" placeholder="Enter some text">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                    <button type="submit" id="send" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
                $('#send').click(function(e){
                    var text = $('#exampleInputEmail1').val();
                    $.post('test', {'text': text, '_token': $('input[name=_token]').val()}, function(data){
                    console.log(data);
                   
                    });
                });
            })
        </script>
    </body>
</html>
