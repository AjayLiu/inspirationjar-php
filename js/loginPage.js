var checkbox = document.getElementById("rememberCheckbox");
document.getElementById("rememberLabel").addEventListener("click", toggleCheck);
var list = document.getElementsByClassName("rememberChange");
var i;
for ( i = 0; i < list.length; i++) {
    list[i].addEventListener("click", rememberChange);
}


function toggleCheck() {
    checkbox.checked = checkbox.checked == true ? false : true;
}

function rememberChange (){
    $.post('backend_php/setRemember.php', { "remember": checkbox.checked });
}
