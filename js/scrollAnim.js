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
    setTimeout(function(){
        $('#clickMeIndicator').fadeIn(800);
        //animation
        var elem0 = document.getElementById("clickLabel");

        var f = 0;
        var mov = 0;
        var loop = setInterval(clickAnim, 20);
        function clickAnim(){
            if(f >= 80 && f < 90){
                mov++;
            } else if( f > 80 && f < 100) {
                mov--;
            } else if (f == 100){
                f = 0;
            }
            f++;
            elem0.style.top = mov-20 + 'px';
        }
    }, 1000);
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
