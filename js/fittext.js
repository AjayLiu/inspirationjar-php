if(window.innerWidth > 767){
    //WIDE MONITOR
    $(".quoteText").fitText(2);
    $(".gratitudeRatings").fitText(9);	
    $("#refreshButton").fitText(8);
} else {
    //MOBILE PORTRAIT
    $(".quoteText").fitText(1.5);
    $("#refreshButton").fitText(2);
}
