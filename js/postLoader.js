$(document).ready(
    function(){
        //REPORT BUTTON
        $(".deleteButton").click(
            function(){
                var deleteID = $(this).attr("name");
                var ajaxurl = 'backend_php/delete.php',
                data =  {'deleteID': deleteID};
                $.post(ajaxurl, data, function (response) {
                    if(response != "SUCCESS"){
                        window.location = response;
                    } else {
                        alert("Post successfully deleted");

                        var reportedBlock = ".quoteBlock[data-gratID=\"" + reportID + "\"]";
                        $(reportedBlock).remove();
                    }
                    
                });
            }
        );
    }
);
