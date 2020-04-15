function setRandomColors(){
    var colors = ['#fdfcf5', '#fdfaf5', '#fbfdf5', '#f8fdf5', '#f5fdfc', '#f5f9fd', '#f8f5fd', '#fdf5fb'];
    var arr = document.getElementsByClassName('quote_container');
    for (i = 0; i < arr.length; i++) {
        var random_color = colors[Math.floor(Math.random() * colors.length)];
         arr[i].style.backgroundColor = random_color;
    }

}
//setRandomColors();
