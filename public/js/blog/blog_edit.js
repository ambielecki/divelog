$(document).ready(function() {
    $('#folder').material_select();
});

Vue.component('image-select', {
    template:   '<select multiple name="images[]" id="images" class="image-picker">' +
                    '<option></option>' +
                    '<option is="image-row" v-for="image in select_images" v-if="select_images" :component_image="image"></option>' +
                '</select>',
    props: ['select_images'],
    updated: function () {
        app.image = null;
        app.href = null;
        $("#images").imagepicker({
            limit: 3
        });
        $('#images').on('change', function() {
            var image = this.value;
            $.ajax({
                data: {
                    image: image
                },
                type: 'POST',
                url: '/api/image/detail',
                success: function (response) {
                    app.image = response.image;
                },
                error: function (response) {
                    var errors = response.responseJSON;
                    var error_messages = [];
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            error_messages.push(errors[key][0]);
                        }
                    }
                    console.log(error_messages);
                }
            });
        });
    }
});

Vue.component('image-row', {
    template: '<option :data-img-src="component_image.path" :value="component_image.id"></option>',
    props: ['component_image']
});

var app = new Vue({
    el: '#target',
    data: {
        images: [],
        image: null,
    }
});

$('#folder').on('change', function () {
    var folder = this.value;
    $.ajax({
        data: {
            folder: folder
        },
        type: 'POST',
        url: '/api/image/list',
        success: function (response) {
            app.images = response.images;
        },
        error: function (response) {
            var errors = response.responseJSON;
            var error_messages = [];
            for (var key in errors) {
                if (errors.hasOwnProperty(key)) {
                    error_messages.push(errors[key][0]);
                }
            }
            console.log(error_messages);
        }
    });
});

$(document).ready(function () {
    if ($("#images")) {
        $("#images").imagepicker({
            limit: 3
        });
    }
});