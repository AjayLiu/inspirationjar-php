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

  $("#quotes_root").load("backend_php/load_quotes.php");
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
