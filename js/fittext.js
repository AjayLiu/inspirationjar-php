
function fitTheQuotes(){
    if(window.innerWidth > 767){
        //WIDE MONITOR
        $(".quoteText").fitText(2);
    } else {
        //MOBILE PORTRAIT
        $(".quoteText").fitText(1.5);
    }
}
fitTheQuotes();
