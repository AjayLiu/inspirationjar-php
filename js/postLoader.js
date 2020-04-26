$(document).ready(
    function(){
        //DELETE BUTTON
        $(".deleteButton").click(
            function(){
                swal({
                  title: "Are you sure you want to delete this post permanently?",
                  text: "Your quote can't be recovered if you delete it!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                }).then((willDelete) => {
                  if (willDelete) {
                    swal("Quote successfully deleted", {
                      icon: "success",
                    });

                    var deleteID = $(this).attr("name");
                    var ajaxurl = 'backend_php/delete.php',
                    data =  {'deleteID': deleteID};
                    $.post(ajaxurl, data, function (response) {
                        if(response != "SUCCESS"){
                            window.location = response;
                        } else {
                            var reportedBlock = ".quoteBlock[data-gratID=\"" + deleteID + "\"]";
                            $(reportedBlock).remove();
                            $("#prevPosts").load("getAccountNums/numPosts.php");
                            updateGratRating();
                        }

                    });
                  }
                });

            }
        );

    }
);
