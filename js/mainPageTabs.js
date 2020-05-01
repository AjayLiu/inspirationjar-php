function setSort(evt, name) {
    // Declare all variables
    var i, tabcontent, tablinks;
    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    // Show the current tab, and add an "active" class to the button that opened the tab
    evt.currentTarget.className += " active";

    document.cookie = "sort = " + name;

    if(!jarMoving){
        search();
    }
}

document.getElementById("defaultOpen").click();



$(document).ready(
    function(){

        var showSettings = false;
        $(".settingsTab").hide();

        //SETTINGS BUTTON
        $(".settingsButton").click(
            function(){
                showSettings = !showSettings;
                $(".settingsTab").fadeToggle();
            }
        );

        $("#searchSubmit").click(
            function(){
                search();
            }
        );
        $('#searchBar').keypress(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                search();
            }
        });
    }
);

var checkbox = document.getElementById("uniqueCheckbox");
document.getElementById('searchBar').addEventListener("keyup", searchChange);
function searchChange(){
    if(!jarMoving){
        var text = document.getElementById('searchBar').value;
        if(text == ''){
            search();
        }
    }
}

function search(){
    var text = document.getElementById('searchBar').value;
    if(text != ''){
        $("#quotes_root").load("backend_php/load_quotes.php", {"search": text, "unique": checkbox.checked, 'quoteNewCount': quoteCount});
    } else {
        $("#quotes_root").load("backend_php/load_quotes.php", {"search": text, "unique": checkbox.checked, 'quoteNewCount': quoteCount});
    }
}




document.getElementById("uniqueLabel").addEventListener("click", toggleUnique);
var list = document.getElementsByClassName("uniqueChange");
var i;
for ( i = 0; i < list.length; i++) {
    list[i].addEventListener("click", uniqueChanged);
}

function toggleUnique() {
    checkbox.checked = checkbox.checked == true ? false : true; //for some reason an easy flip flop doesnt work
}
function uniqueChanged(){
    var text = document.getElementById('searchBar').value;
    $("#quotes_root").load("backend_php/load_quotes.php", {"search": text, "unique": checkbox.checked, 'quoteNewCount': quoteCount});
}


var isFetching = false;
//Refresh
var quoteCount;
function refresh(){
    quoteCount = $( "#quotes_root .quoteBlock" ).length + 10;
    var text = document.getElementById('searchBar').value;
    $("#quotes_root").load("backend_php/load_quotes.php", {"search": text, "unique": checkbox.checked, 'quoteNewCount': quoteCount}, function(){
        markDupes();
        isFetching = false;
    });
}
$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() > $(document).height() - 200) {
        if(allowRefresh && !jarMoving){
            if(!isFetching){
                isFetching = true;
                var text = document.getElementById('searchBar').value;
                $.ajax({
                    type: 'POST',
                    url: 'backend_php/returnTotalQuoteCount.php',
                    data: {"search": text, "unique": checkbox.checked},
                    cache: false,
                    success: function(result) {
                        //alert(result);
                        quoteCount = $( "#quotes_root .quoteBlock" ).length;
                        if(quoteCount == result){
                            $('.loadingIndicator').text("That's all the quotes so far! Help spread the positivity and submit a quote!");
                            allowRefresh = false;
                        }
                        if(allowRefresh){
                            refresh();
                        }
                        isFetching = false;
                    }
                });
            }
        }
    }

});
