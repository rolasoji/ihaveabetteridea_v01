// Code goes here
var app = angular.module("musicApp", []);

app.controller("musicController", ["$scope", function ($scope) {
    $scope.data = [
      { name: "Grouplove", genre: "Alternative", rating: 4 },
      { name: "The Beatles", genre: "Rock", rating: 5 },
      { name: "The Cure", genre: "New Wave", rating: 4 },
    ];
}])

$(document).ready(function () {

    // highlight current nav
    $("#home a:contains('Wellness home')").parent().addClass('active');
    $("#dashboard a:contains('My dashboard')").parent().addClass('active');
    $("#about a:contains('About')").parent().addClass('active');
    $("#blog a:contains('Blog')").parent().addClass('active');
    $("#faq a:contains('FAQ')").parent().addClass('active');
    $("#aboutfood a:contains('Food')").parent().addClass('active');

    //==> make menus drop automatically - DOESN'T WORK AS EXPECTED
    $('ul.nav.li.dropdown').hover(function () {
        $('dropdown-menu', this).fadeIn();
    }, function () {
        $('dropdown-menu', this).fadeOut('fast');
    }); // hover
    //==> **** **********************************

    // Food items photogrid - activate tooltip on hover
    $("[data-toggle='tooltip']").tooltip({ animation: true });

    // Carousel - more controls
    $('#topmaincarousel').carousel({
        interval: 2000,
        pause: "hover",
        wrap: true,
    });

    // reset form after your modal window has been closed
    $('.modal').on('hidden.bs.modal', function(){
        $(this).find('form')[0].reset();
    });

    // Food items photogrid - activate a modal popup on click
    $('li img').on('click', function () {
        var src = $(this).attr('src');
        var img = '<img src="' + src + '" class="img-responsive"/>';

        // add some HTML texts and next / prev control buttons
        var index = $(this).parent('li').index();

        var html = '';
        html += img;
        html += '<div class="modal-footer">';
        html += '<a class="controls previous btn btn-primary btn-sm" role="button" href="' + (index) + '">&laquo; Prev</a>';
        html += '<a class="btn btn-default btn-sm" role="button" target="_blank" href="fooditems_cereals.php">More details&hellip;</a>';
        //html += '<a class="btn btn-default btn-sm" role="button" href="#itemmore" data-toggle="modal">More details&hellip;</a>';
        html += '<a class="controls next btn btn-primary btn-sm" role="button" href="' + (index + 2) + '">Next &raquo;</a>';
        html += '</div>';

        $('#fooditemdetails_modal').modal();
        $('#fooditemdetails_modal').on('shown.bs.modal', function () {
            $('#fooditemdetails_modal .modal-body').html(html);
            // call function to process next / prev buttons
            $('a.controls').trigger('click');
        });
        $('#fooditemdetails_modal').on('hidden.bs.modal', function () {
            $('#fooditemdetails_modal .modal-body').html('');
        });
    });

    $(document).on('click', 'a.controls', function () {
        var index = $(this).attr('href');
        var src = $('ul.row li:nth-child(' + index + ') img').attr('src');

        $('.modal-body img').attr('src', src);

        var newPrevIndex = parseInt(index) - 1;
        var newNextIndex = parseInt(newPrevIndex) + 2;

        if ($(this).hasClass('previous')) {
            $(this).attr('href', newPrevIndex);
            $('a.next').attr('href', newNextIndex);
        } else {
            $(this).attr('href', newNextIndex);
            $('a.previous').attr('href', newPrevIndex);
        }

        var total = $('ul.row li').length + 1;

        //hide next button
        if (total === newNextIndex) {
            $('a.next').hide();
        } else {
            $('a.next').show()
        }
        //hide previous button
        if (newPrevIndex === 0) {
            $('a.previous').hide();
        } else {
            $('a.previous').show()
        }

        return false;
    });
}); // document.ready - jQuery function

/*========================================
=            CUSTOM FUNCTIONS            =
========================================*/
// TODO: Create a generic dialog alert popup handle ??
//function dialogACTIVATION(form, msg) {

//    if (!form.captcha_code.value.match(/^[a-zA-Z0-9]{6}$/)) {
//        var captcha = form.captcha_code.value;
//        //alert('Please enter the CAPTCHA code shown.');
//        // prompt dialog
//        alertify.alert("You entered " + captcha + ". Please enter the CAPTCHA code shown.")
//        form.captcha_code.focus();
//        return false;
//    }
//    return true;
//}
