$(document).ready(
    function(){
        $(".undislikeButton").click(
            function(){
                var yes = confirm("Are you sure you want to Undislike this post?");
                if(yes){
                    var deleteID = $(this).attr("name");
                    var likeOrDislike = $(this).val();
                    var ajaxurl = 'backend_php/unvote.php',
                    data =  {'deleteID': deleteID, 'likeOrDislike': likeOrDislike};
                    $.post(ajaxurl, data, function (response) {
                        if(response != "SUCCESS"){
                            window.location = response;
                        } else {
                            var reportedBlock = ".quoteBlock[data-gratID=\"" + deleteID + "\"]";
                            $(reportedBlock).remove();
                            $("#prevDislikes").load("backend_php/getAccountNums/numDislikes.php");
                        }

                    });
                }

            }
        );

    }
);
