/**
 * Created by Bielecki on 7/3/2017.
 */
$(document).ready(function () {
    $('select').material_select();
    $('#dives').change(function () {
        window.location.href = '/divelog/list?limit=' + $(this).val();
    });
});