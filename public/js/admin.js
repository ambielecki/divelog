$(document).ready(function () {
    $('.collapsible').collapsible();
    $('.flash_close').click(function () {
        console.log('click');
        $(this).parent().hide();
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // init mobile sidenav
    let sidenav = document.querySelectorAll('.sidenav');
    M.Sidenav.init(sidenav, {});

    // dropdown init for nav
    let dropdown = document.querySelectorAll('.dropdown-trigger');
    M.Dropdown.init(dropdown, {
        hover: false,
    });
});
