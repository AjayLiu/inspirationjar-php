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
        isSearch = true;
        allowRefresh = false;
        $("#quotes_root").load("backend_php/load_quotes.php", {"search": text, 'quoteNewCount': Number.MAX_SAFE_INTEGER});
    } else {
        isSearch = false;
        allowRefresh = true;
        $('.loadingIndicator').text("Loading quotes...");
        $("#quotes_root").load("backend_php/load_quotes.php");
    }
}




var checkbox = document.getElementById("uniqueCheckbox");
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
    if(checkbox.checked){
        allowRefresh = false;
        isSearch = true;
    }
    $("#quotes_root").load("backend_php/load_quotes.php", {'unique': checkbox.checked, 'quoteNewCount': Number.MAX_SAFE_INTEGER});
}
