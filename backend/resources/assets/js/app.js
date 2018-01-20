$(document).ready(function(){           
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
            var target = $(e.target);
            var attr = target.attr('disabled');
            typeof attr == typeof undefined ?  signLeftoverInOut('sign-in', 'container-leftover', 'left-over', e): console.log(attr);           
            target.attr('disabled', 'disabled');
        });
        $('#container-leftover').on('click', '.fa-sign-out', (e) => {
            var target = $(e.target);
            var attr = target.attr('disabled');
            typeof attr == typeof undefined ? signLeftoverInOut('sign-out', 'container-leftover', 'left-over', e): console.log(attr);           
            target.attr('disabled', 'disabled');
        });

    $("#headCount").click((e) => {
        var tip = $('.tip');
        if(tip.hasClass('show')){
            tip.removeClass('show');
            tip.addClass('out')
         } else{
            tip.addClass('show')
            tip.removeClass('out');
           
         } 
    })

    deleteConfirm = (item, url, data, id) => {
        console.log(item, url, data)
        var c = confirm('Bent u zeker dat u ' + item + ' wilt verwijderen?');

        if(c == true){
            $.ajax({
                method: "POST",
                url: url,
                data: data,
            }).done(function(){
                $("#row-"+ id).hide();
            })
        }
    }

    function signInOut(action, oldContainer, newContainer, oldId, newId, e){
        $.ajax({
            method: "POST",
            url: "/"+action,
            data: {'id': e.target.id, '_token': $('input[name=_token]').val()},
        }).done(function( msg ) {
            $('div#'+oldContainer).load(window.location.href +  " div#"+oldId);
            $('div#'+newContainer).load(window.location.href +  " div#"+newId);
        })
    }

    $('#container-future').on('click', '.fa-sign-in', (e) => {
        var target = $(e.target);
        var attr = target.attr('disabled');
        typeof attr == typeof undefined ? signInOut('sign-in', 'container-future', 'container-in', 'to-come', 'in', e): console.log(attr);           
        target.attr('disabled', 'disabled');
    });

    $('#container-in').on('click', '.fa-sign-out', (e) => {
        var target = $(e.target);
        var attr = target.attr('disabled');
        typeof attr == typeof undefined ? signInOut('sign-out', 'container-in', 'container-out', 'in', 'out', e) : console.log(attr);                  
        target.attr('disabled', 'disabled');
    });


    /* ADD PARENT */
    // SHOW FORM ON HOMEPAGE
    showHide = (action, target) => {
        action == 'show'? $(target).removeClass('hide') : $(target).addClass('hide');
    }
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
            filterItems();
        });
    }
    $('.date').change(() => {
         filterItems();
    }) 
    filterItems = () => {
        var data = [];
          // Init new data array     
        var age = [{age: slider.noUiSlider.get()}];
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
    }
    $('.item input').change(() => {    
        filterItems();
    });
});
