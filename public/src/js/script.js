$(document).ready(function() {

    $('section.sec_8 .card-header').click((event) => {
        $(event.currentTarget).children(".plus-minus").toggleClass("add_minus");
    });

});