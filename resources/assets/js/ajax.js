$(document).ready(function(){
    $('#send').click(function(e){
        var text = $('#exampleInputEmail1').val();
        $.ajax({
            method: "POST",
            url: "test",
            data: {'text': text, '_token': $('input[name=_token]').val()},
            })
            .done(function( msg ) {
                $('#children').replaceWith(msg);
            });
    });
});