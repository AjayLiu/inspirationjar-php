$(document).ready(
    function(){
        //DELETE BUTTON
        $(".deleteButton").click(
            function(){
                var yes = confirm("Are you sure you want to delete this post permanently?");
                if(yes){
                    var deleteID = $(this).attr("name");
                    var ajaxurl = 'backend_php/delete.php',
                    data =  {'deleteID': deleteID};
                    $.post(ajaxurl, data, function (response) {
                        if(response != "SUCCESS"){
                            window.location = response;
                        } else {
                            alert("Post successfully deleted");

                            var reportedBlock = ".quoteBlock[data-gratID=\"" + deleteID + "\"]";
                            $(reportedBlock).remove();
                            $("#prevPosts").load("getAccountNums/numPosts.php");
                            updateGratRating();
                        }

                    });
                }

            }
        );

    }
);
