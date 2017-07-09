$(document).ready(function() {
    $('select').material_select();
    $('#submit_and_add').click(function () {
        $('#submit_action').val('add');
        return true;
    });
});
