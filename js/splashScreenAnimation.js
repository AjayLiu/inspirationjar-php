var jarMoving = true;

$(document).ready( function(){
    moveJar();
});

function moveJar() {
    $("#jar").hide();
    setTimeout(function(){
        $("#jar").fadeIn();
        showScrollIndicator();
        showClickIndicator();
        setTimeout(displayQuotes, 400);
        jarMoving = false;
    }, 1);
}


$(".settingsButton").hide();
function displayQuotes(){
    $(".settingsButton").show();
    //$("#quotes_root").load("backend_php/load_quotes.php");
}
