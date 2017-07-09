$(document).ready(function () {
    $(".button-collapse").sideNav();
    $(".dropdown-button").dropdown();
    $('.collapsible').collapsible();
    $('.flash_close').click(function () {
        console.log('click');
        $(this).parent().hide();
    });
});
