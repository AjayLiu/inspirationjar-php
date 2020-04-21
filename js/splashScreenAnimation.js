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
          //$("#quotes_root").load("backend_php/load_quotes.php");
          return;
        } else {
          pos++;
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

$("#scrollIndicator").hide();
function showScrollIndicator(){
    $('#scrollIndicator').fadeIn();

    //animation
    var elem = document.getElementById("scrollIndicator");
    var pos = $("#scrollIndicator").position().top;
    var f = 0;
    var mov = 0;
    var loop = setInterval(scrollAnim, 20);
    function scrollAnim(){
        if(f > 80 && f < 90){
            mov++;
        } else if( f > 80 && f < 100) {
            mov--;
        } else if (f == 100){
            f = 0;
        }
        f++;
        elem.style.top = (pos + mov) + 'px';
    }
}
