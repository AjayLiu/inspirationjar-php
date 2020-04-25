$("#scrollIndicator").hide();
function showScrollIndicator(){
    $('#scrollIndicator').fadeIn();

    //animation
    var elem0 = document.getElementById("scrollIndicator");
    var pos = $("#scrollIndicator").position().top;
    var f = 0;
    var mov = 0;
    var loop = setInterval(scrollAnim, 40);
    function scrollAnim(){
        if(f >= 80 && f < 90){
            mov++;
        } else if( f > 80 && f < 100) {
            mov--;
        } else if (f == 100){
            f = 0;
        }
        f++;
        elem0.style.top = (pos + mov) + 'px';
    }
}

$('#clickMeIndicator').hide();
function showClickIndicator(){
    $('#clickMeIndicator').fadeIn();

    //animation
    var elem0 = document.getElementById("clickMeIndicator");
    var posTop = $("#clickMeIndicator").position().top;
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
        elem0.style.top = (posTop + mov) + 'px';
    }
}



$(document).ready(
    function(){
        $("#scrollIndicatorInput").click(
            function(){
                window.scroll({
                  top: window.innerHeight * 0.9,
                  behavior: 'smooth'
                });
            }
        );
        $("#clickMeIndicatorInput").click(
            function(){
                jarClick();
            }
        );
    }
);
