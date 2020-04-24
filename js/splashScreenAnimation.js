$(document).ready( function(){
    moveJar();
});

function moveJar() {
    var elem = document.getElementById("jar");
    var pos = $("#jar").position().left;

    frame();
    function frame() {
        if (pos >= window.innerWidth * 0.10) {
          fadeTitle();
          showScrollIndicator();
          showClickIndicator();
          setTimeout(displayQuotes, 400);
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
