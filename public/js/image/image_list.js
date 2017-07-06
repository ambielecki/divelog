$(document).ready(function() {
    $('#folder').material_select();
});

Vue.component('image-select', {
    template:   '<select name="display_images" id="display_images" class="image-picker">' +
                    '<option></option>' +
                    '<option is="image-row" v-for="image in select_images" v-if="select_images" :component_image="image"></option>' +
                '</select>',
    props: ['select_images'],
    updated: function () {
        app.image = null;
        app.href = null;
        $("#display_images").imagepicker({
            hide_select: true
        });
        $('#display_images').on('change', function() {
            var image = this.value;
            $.ajax({
                data: {
                    image: image
                },
                type: 'POST',
                url: '/api/image/detail',
                success: function (response) {
                    app.image = response.image;
                    app.edit_href = '/admin/image/edit/' + response.image.id;
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

Vue.component('image-display', {
    template:   '<div class="card">' +
                    '<div class="card-image">' +
                        '<img :src="display_image.path" :alt="display_image.description">' +
                        '<div class="card-content">' +
                            '<p>Header: {{ display_image.header }}</p>' +
                            '<p>Subheader: {{ display_image.subheader }}</p>' +
                            '<p>Description: {{ display_image.description }}</p>' +
                        '</div>' +
                    '</div>' +
                '</div>',
    props: ['display_image']
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
        edit_href: null,
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