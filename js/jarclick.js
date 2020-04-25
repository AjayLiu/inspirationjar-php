$("#jarQuote").hide();
$("#clickLabel").hide();

var clickCount = 0;

function jarClick(){
    clickCount++;
    if(clickCount <= 1){
        $("#titleText").fadeOut();
        $("#titleDescription").fadeOut();
        $("#clickLabel").fadeIn();
    } else if (clickCount == 2){
        $('#clickMeIndicator').fadeOut();
    }
    $("#jarQuote").load("backend_php/getRandomQuote.php");
    $("#jarQuote").show();
    setInterval(function(){fittext();}, 400);
}

$(document).ready(
    function(){
        $("#jarImg").click(
            function(){
                jarClick();
            }
        );
    }
);
