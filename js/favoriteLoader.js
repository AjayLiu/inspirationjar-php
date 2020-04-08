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
                            alert("Post successfully unfavorited");

                            var reportedBlock = ".quoteBlock[data-gratID=\"" + unfavoriteID + "\"]";
                            $(reportedBlock).remove();

                            $("#prevPosts").load(location.href + " #prevPosts");
                        }

                    });
                }

            }
        );
    }
);
