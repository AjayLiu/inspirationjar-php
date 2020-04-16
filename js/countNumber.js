$(document).ready(
    function(){
        updateGratRating();
    }
);

function updateGratRating(){
    //GET Rating
    var rating = 0;
    var ajaxurl = 'backend_php/getMyRating.php';
    $.ajax({
        url: ajaxurl,
    }).done(function(response) {
        rating = response;
        $('.count').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: rating
            }, {
                duration: 2000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    });
}
