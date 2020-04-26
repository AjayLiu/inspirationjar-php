var jarMoving = true;

$(document).ready( function(){
    moveJar();
});

function moveJar() {
    var elem = document.getElementById("jar");
    var pos = $("#jar").position().left;

    frame();

    var destination = window.innerWidth * 0.10;
    if(window.innerWidth < 767){
        destination = 0;
    }
    function frame() {
        if (pos >= destination) {
          fadeTitle();
          showScrollIndicator();
          showClickIndicator();
          setTimeout(displayQuotes, 400);
          jarMoving = false;
          return;
        } else {
          pos+=2;
          elem.style.left = pos + 'px';
        }
        setTimeout(frame, 1);
    }
}

$("#title").hide();
$('#titleDescription').hide();
function fadeTitle() {
    $("#title").fadeIn();
    $('#titleDescription').fadeIn();
}



$(".settingsButton").hide();
function displayQuotes(){
    $(".settingsButton").show();
    $("#quotes_root").load("backend_php/load_quotes.php");
}
