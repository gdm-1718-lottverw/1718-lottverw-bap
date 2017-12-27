
        $(document).ready(function(){ 
            console.log('UPDATED');
            // CLOCK
            setInterval(function() {
                var d = new Date();
                $('.date').text(d.getDate() + '/' + (d.getMonth() + 1 ) + '/' + d.getFullYear() + ', ' + d.getHours() + ":" + d.getMinutes());
            }, 30000);
            // LOGPAGE CHANGE EDIT FIELD
            $('tbody').on('click', '.fa-pencil', (e) => {
                var id = e.currentTarget.id;
                $('.' + id).removeClass('hide');
                e.target.parentElement.classList.add('hide');
            })
             $('tbody').on('click', '.fa-times', (e) => {
                var id = e.currentTarget.id.match(/\d+/)[0];
                $('.' + id).addClass('hide');
                var i = $('#' + id)[0].parentElement.classList.remove('hide');
               
            })
            // SIGN KID IN
            $('#container-future').on('click', '.fa-sign-in', (e) => {
                 $.ajax({
                    method: "POST",
                    url: "/sign-in",
                    data: {'id': e.target.id, '_token': $('input[name=_token]').val()},
                })
                .done(function( msg ) {
                    $('div#container-future').load(location.href + " #to-come", function() {
                    });
                     $('div#container-in').load(location.href + " #in", function() {
                    });
                })
            })
            $('#container-in').on('click', '.fa-sign-out', (e) => {
                
                $.ajax({
                    method: "POST",
                    url: "/sign-out",
                    data: {'id': e.target.id, '_token': $('input[name=_token]').val()},
                })
                .done(function( msg ) {
                  $('div#container-in').load(location.href + " #in", function() {
                    });
                     $('div#container-out').load(location.href + " #out", function() {
                    });
                });
            });
            /* FILTER*/
            var slider = document.getElementById('slider');
            if(slider != null || slider != undefined){
                noUiSlider.create(slider, {
                    start: [3, 12],
                    step: 1,
                    connect: true,
                    orientation: 'vertical',
                    range: {
                        'min': 3,
                        'max': 12
                    },
                    tooltips: true, 
                    format: {
                        to: function ( value ) {
                            return value + '';
                        },
                        from: function ( value ) {
                            return value.replace('', '');
                        }
                    }
                });
                slider.noUiSlider.on('end', function(){
                    var date = $('input[name=date]').val();
                    var age = {age: slider.noUiSlider.get()};
                    console.log(age, date);
                   $.ajax({
                        method: "POST",
                        url: "filter",
                        data: {'data': age, 'age': age, 'date': date, '_token': $('input[name=_token]').val()},
                    })
                    .done(function( msg ) {
                        $('.filter-results').replaceWith(msg);
                    });
                });
            }

            $('.item input').change(() => {    
                // Init new data array     
                var data = [];
                var age = {age: slider.noUiSlider.get()};
                // Get the selected date.
                var date = $('input[name=date]').val();
                $('.item input:checked').each(function(index) {
                    // Get the input name
                    var name = $(this)[0]['name'];
                    // Get the input value
                    var value = $(this).val();
                    // a new object with name as key value als value.
                    var item = {[name]: [value]};
                    // When the data array is empty
                    // add the first selected item.
                    if(data.length === 0){
                        data.push(item);
                    } else {
                        // We need to keep track of the already looped items.
                        let count = 0;
                        // For each data object we need the index. 
                        data.forEach((o, i) => {
                            // Let's take the key of the object. 
                            a = Object.keys(o)[0];
                            // Check if the name of the input field exists in the data array.
                            if(a == name){
                                // If it does we need to check each value. 
                                data[i][name].forEach((val, ii) => {
                                    // When a value is not present in the current data object
                                    // push it. 
                                    if(val != value && ii == (data[i][name].length - 1)){
                                        data[i][name].push(value);
                                    } 
                                })
                            } 
                            // If the key is different from the curren name we need to add it. 
                            else if( a != name ){
                                // But we do not want to add it before the whole array has been looped. 
                                // That is why we check if the current index is equal to the length of an array. 
                                if(i === (data.length - 1) ){
                                    data.push(item);
                                }
                            }
                                count ++;
                            });
                        }
                        console.log(data);
                      
                });
                    $.ajax({
                        method: "POST",
                        url: "filter",
                        data: {'data': data, 'age': age, 'date': date, '_token': $('input[name=_token]').val()},
                        })
                    .done(function( msg ) {
                        $('.filter-results').replaceWith(msg);
                    });
                });
        });