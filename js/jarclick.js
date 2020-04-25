$("#jarQuote").hide();

var clickCount = 0;

function jarClick(){
    clickCount++;
    if(clickCount <= 1){
        $("#clickLabel").fadeOut();
        setInterval(function(){
            $("#clickLabel").fadeIn();
            $("#clickLabel").text("Click the jar for more!");
        }, 2000);

        $("#titleText").fadeOut();
        $("#titleDescription").fadeOut();
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
