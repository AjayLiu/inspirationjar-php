
function fitTheQuotes(){
    if(window.innerWidth > 767){
        //WIDE MONITOR
        $(".quoteText").fitText(3);
    } else {
        //MOBILE PORTRAIT
        $(".quoteText").fitText(1.5);
    }
}
fitTheQuotes();
