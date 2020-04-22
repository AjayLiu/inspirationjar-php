var isShown = false;
$("#scrollIndicator").hide();
function showScrollIndicator(){
    isShown = true;
    $('#scrollIndicator').fadeIn();

    //animation
    var elem = document.getElementById("scrollIndicator");
    var pos = $("#scrollIndicator").position().top;
    var f = 0;
    var mov = 0;
    var loop = setInterval(scrollAnim, 20);
    function scrollAnim(){
        if(f >= 80 && f < 90){
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

$(document).ready(
    function(){
        $("#scrollIndicator").click(
            function(){
                window.scroll({
                  top: window.innerHeight,
                  behavior: 'smooth'
                });
            }
        );
    }
);
