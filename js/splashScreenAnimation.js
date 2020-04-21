moveJar();
function moveJar() {
    var elem = document.getElementById("jar");
    var pos = $("#jar").position().left;
    var id = setInterval(frame, 1);

    function frame() {
        if (pos >= window.innerWidth * 0.10) {
          clearInterval(id);
          fadeTitle();
          showScrollIndicator();
        } else {
          pos++;
          elem.style.left = pos + 'px';
        }
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
