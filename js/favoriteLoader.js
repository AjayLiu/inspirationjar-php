$(document).ready(
    function(){
        //Unfavorite BUTTON
        $(".unfavoriteButton").click(
            function(){
                var yes = confirm("Are you sure you want to unfavorite this post?");
                if(yes){
                    var unfavoriteID = $(this).attr("name");
                    var ajaxurl = 'backend_php/unfavorite.php',
                    data =  {'unfavoriteID': unfavoriteID};
                    $.post(ajaxurl, data, function (response) {
                        if(response != "SUCCESS"){
                            window.location = response;
                        } else {
                            var reportedBlock = ".quoteBlock[data-gratID=\"" + unfavoriteID + "\"]";
                            $(reportedBlock).remove();

                            $("#prevFaves").load("backend_php/getAccountNums/numFaves.php");
                        }

                    });
                }

            }
        );
    }
);
