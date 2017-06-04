$(document).ready(function () {
    $('table').tableHover({
        colClass: 'dive_hover',
        rowClass: 'dive_hover',
        headCols: true,
    });
});

Vue.component('dive-row', {
    template:   '<tr>' +
                    '<td>{{ component_message }}</td>' +
                    '<td>{{ component_result }}</td>' +
                '</tr>',
    props: ['component_message', 'component_result']
});

Vue.component('dive-errors', {
    template:   '<ul>' +
                    '<li is="dive-error" v-for="error_message in dive_error_messages" :message="error_message"></li>' +
                '</ul>',
    props: ['dive_error_messages']
});

Vue.component('dive-error', {
    template: '<li>{{ message }}</li>',
    props: ['message']
});

var app = new Vue({
    el: '#results',
    data: {
        results: {
            dive_1_max_time: {
                message: 'Max Time for Dive 1: ',
                result: ''
            },
            dive_1_pg: {
                message: 'Pressure Group after Dive 1: ',
                result: ''
            },
            post_si_pg: {
                message: 'Pressure Group after Surface Interval: ',
                result: ''
            },
            dive_2_max_time: {
                message: 'Max Time for Dive 2: ',
                result: ''
            },
            dive_2_pg: {
                message: 'Pressure Group after Dive 2:',
                result: ''
            },
        },
        error_messages: null
    }
});

$('#dive_calculator').submit(function() {
    $.ajax({
        data: $(this).serialize(),
        type: $(this).attr('method'),
        url: '/api/calculator',
        success: function (response) {
            console.log(response);
            app.error_messages                  = null;
            app.results.dive_1_max_time.result  = response.dive_1_max_time;
            app.results.dive_1_pg.result        = response.dive_1_pg;
            app.results.post_si_pg.result       = response.post_si_pg;
            app.results.dive_2_max_time.result  = response.dive_2_max_time;
            app.results.dive_2_pg.result        = response.dive_2_pg;
        },
        error: function (response) {
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