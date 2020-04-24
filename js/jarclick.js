$("#jarQuote").hide();

var clickCount = 0;

function jarClick(){
    clickCount++;
    if(clickCount <= 1){
        $("#titleText").hide();
        $("#titleDescription").hide();
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
