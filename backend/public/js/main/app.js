/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(2);


/***/ }),
/* 1 */
/***/ (function(module, exports) {

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

$(document).ready(function () {
    // CLOCK
    setInterval(function () {
        var d = new Date();
        $('.date').text(d.getDate() + '/' + (d.getMonth() + 1) + '/' + d.getFullYear() + ', ' + d.getHours() + ":" + d.getMinutes());
    }, 30000);

    // LOGPAGE CHANGE EDIT FIELD
    $('tbody').on('click', '.fa-pencil', function (e) {
        var id = e.currentTarget.id;
        $('.' + id).removeClass('hide');
        e.target.parentElement.classList.add('hide');
    });
    $('tbody').on('click', '.fa-times', function (e) {
        var id = e.currentTarget.id.match(/\d+/)[0];
        $('.' + id).addClass('hide');
        var i = $('#' + id)[0].parentElement.classList.remove('hide');
    });
    // HOME SIGN IN OR OUT
    function signInOut(action, oldContainer, newContainer, oldId, newId, e) {
        $.ajax({
            method: "POST",
            url: "/" + action,
            data: { 'id': e.target.id, '_token': $('input[name=_token]').val() }
        }).done(function (msg) {
            $('div#' + oldContainer).load(location.href + " #" + oldId, function () {});
            $('div#' + newContainer).load(location.href + " #" + newId, function () {});
        });
    }

    $('#container-future').on('click', '.fa-sign-in', function (e) {
        signInOut('sign-in', 'container-future', 'container-in', 'to-come', 'in', e);
    });

    $('#container-in').on('click', '.fa-sign-out', function (e) {
        signInOut('sign-out', 'container-in', 'container-out', 'in', 'out', e);
    });

    /* FILTER*/
    var slider = document.getElementById('slider');
    if (slider != null || slider != undefined) {
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
                to: function to(value) {
                    return value + '';
                },
                from: function from(value) {
                    return value.replace('', '');
                }
            }
        });
        slider.noUiSlider.on('end', function () {
            var date = $('input[name=date]').val();
            var age_data = [{ age: slider.noUiSlider.get() }];
            $.ajax({
                method: "POST",
                url: "filter",
                data: { 'data': age_data, 'date': date, '_token': $('input[name=_token]').val() }
            }).done(function (msg) {
                $('.filter-results').replaceWith(msg);
            });
        });
    }

    $('.item input').change(function () {
        // Init new data array     
        var data = [];
        var age = [{ age: slider.noUiSlider.get() }];
        // Get the selected date.
        var date = $('input[name=date]').val();
        $('.item input:checked').each(function (index) {
            // Get the input name
            var name = $(this)[0]['name'];
            // Get the input value
            var value = $(this).val();
            // a new object with name as key value als value.
            var item = _defineProperty({}, name, [value]);
            // When the data array is empty
            // add the first selected item.
            if (data.length === 0) {
                data.push(item);
            } else {
                // We need to keep track of the already looped items.
                var count = 0;
                // For each data object we need the index. 
                data.forEach(function (o, i) {
                    // Let's take the key of the object. 
                    a = Object.keys(o)[0];
                    // Check if the name of the input field exists in the data array.
                    if (a == name) {
                        // If it does we need to check each value. 
                        data[i][name].forEach(function (val, ii) {
                            // When a value is not present in the current data object
                            // push it. 
                            if (val != value && ii == data[i][name].length - 1) {
                                data[i][name].push(value);
                            }
                        });
                    }
                    // If the key is different from the curren name we need to add it. 
                    else if (a != name) {
                            // But we do not want to add it before the whole array has been looped. 
                            // That is why we check if the current index is equal to the length of an array. 
                            if (i === data.length - 1) {
                                data.push(item);
                            }
                        }
                    count++;
                });
            }
            console.log(data);
        });
        $.ajax({
            method: "POST",
            url: "filter",
            data: { 'data': data, 'age': age, 'date': date, '_token': $('input[name=_token]').val() }
        }).done(function (msg) {
            $('.filter-results').replaceWith(msg);
        });
    });
});

/***/ }),
/* 2 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);