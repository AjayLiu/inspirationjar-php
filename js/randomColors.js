function setRandomColors(){
    var colors = ['#00a388', '#d4a31c', '#e3d0c1', '#d2bfdb', '#bfd1db', '#b5dff7', '#b2ebc8'];
    var arr = document.getElementsByClassName('quote_container');
    for (i = 0; i < arr.length; i++) {
        var random_color = colors[Math.floor(Math.random() * colors.length)];
         arr[i].style.backgroundColor = random_color;
    }
}
setRandomColors();
