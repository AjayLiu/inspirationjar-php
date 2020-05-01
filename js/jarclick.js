$("#jarQuote").hide();

var clickCount = 0;
var randArr;
function initRandArr(){
    $.get("backend_php/getAllQuoteIDs.php", function(data){
        randArr = data.substring(0,data.length-1).split(',');
        shuffleArray(randArr);
    });
}

function shuffleArray(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
}

function jarClick(){
    clickCount++;
    if(clickCount <= 1){
        $("#clickLabel").fadeOut();
        setInterval(function(){
            $("#clickLabel").fadeIn();
            $("#clickLabel").text("Click for more!");
        }, 2000);

        $("#titleText").fadeOut();
        $("#titleDescription").fadeOut();
    } else if (clickCount == 2){
        $('#clickMeIndicator').fadeOut();
    }
    if(clickCount < randArr.length){
        $("#jarQuote").load("backend_php/getRandomQuote.php", {'id': randArr[clickCount]});
    } else {
        $("#jarQuote").load("backend_php/noMoreQuotes.html");
    }
    $("#jarQuote").show();
    setInterval(function(){fittext();}, 400);
}


$(document).ready(
    function(){
        initRandArr();
        $("#jarImg").click(
            function(){
                jarClick();
            }
        );
    }
);
