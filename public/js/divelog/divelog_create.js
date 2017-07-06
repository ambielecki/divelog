$(document).ready(function() {
    CKEDITOR.replace('comments');
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 40 // Creates a dropdown of 15 years to control year
    });
    $('select').material_select();

    $('#calculate_pg').on('click', function (evt) {
        $('#log_calculator_error').hide();
        var data = {
            'previous_pg': $('#previous_pg').val(),
            'surface_interval': $('#surface_interval').val(),
            'max_depth': $('#max_depth').val(),
            'bottom_time': $('#bottom_time').val()
        };
        app.error_messages = null;
        $.ajax({
            data: data,
            type: 'POST',
            url: '/api/log_calculator',
            success: function (response) {
                $('#pressure_group').val(response.pressure_group);
                Materialize.updateTextFields();
            },
            error: function (response) {h
                var errors = response.responseJSON;
                var error_messages = [];
                for (var key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        error_messages.push(errors[key][0]);
                    }
                }
                app.error_messages = error_messages;
            }
        });
        return false;
    });
});

Vue.component('dive-errors', {
    template: '<ul>' +
    '<li is="dive-error" v-for="error_message in dive_error_messages" :message="error_message"></li>' +
    '</ul>',
    props: ['dive_error_messages']
});

Vue.component('dive-error', {
    template: '<li>{{ message }}</li>',
    props: ['message']
});

var app = new Vue({
    el: '#calculator_messages',
    data: {
        error_messages: null
    }
});