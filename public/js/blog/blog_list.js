$(document).ready(function () {
    console.log('load');
    $('.disable_btn').on('click', function (evt) {
        if (!window.confirm('Are you sure you want to disable this post?')) {
            evt.preventDefault();
        }
    });
});