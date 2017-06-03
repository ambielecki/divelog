Vue.component('dive-row', {
    template: "<tr><td>{{ component_message }}</td><td>{{ component_result }}</td></tr>",
    props: ['component_message', 'component_result']
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
            }
        },
    }
});

$('#dive_calculator').submit(function() {
    $.ajax({
        data: $(this).serialize(),
        type: $(this).attr('method'),
        url: '/api/calculator',
        success: function (response) {
            console.log(response);
            app.results.dive_1_max_time.result     = response['dive_1_max_time'];
            app.results.dive_1_pg.result           = response['dive_1_pg'];
            app.results.post_si_pg.result          = response['post_si_pg'];
            app.results.dive_2_max_time.result     = response['dive_2_max_time'];
            app.results.dive_2_pg.result           = response['dive_2_pg'];
        },
        error: function (response) {
            console.log(response.responseJSON);
        }
    });
    return false;
});