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


    }
);

document.getElementById('searchBar').addEventListener("keyup", searchChange);
function searchChange(){
    if(!jarMoving){
        search();
    }
}

function search(){
    var text = document.getElementById('searchBar').value;
    $("#quotes_root").load("backend_php/load_quotes.php", {"search": text, 'quoteNewCount': Number.MAX_SAFE_INTEGER});
    isSearch = text !='';
    allowRefresh = isSearch;
}
