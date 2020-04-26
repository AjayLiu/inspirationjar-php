$(document).ready(
    function(){


        //PROMPT LOGIN PAGE IF NOT LOGGED IN
        $.ajax({
          type: 'GET',
          url: 'backend_php/isLoggedIn.php',
          cache: false,
          success: function(result) {
              if(result != "LOGGED IN"){
                  //REDIRECT TO LOGIN
                  window.location = response;
              }
          }
        });


        //LOGOUT BUTTOn
        $(".logoutButton").click(
            function(){
                logout();
            }
        );
    }
);



function logout(){
    swal({
      title: "Are you sure you want to log out?",
      text: "Feel free to log back in anytime!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        swal("You have been logged out.", {
          icon: "success",
        });

        //LOG OUT
        $.ajax({
          type: 'GET',
          url: 'backend_php/logout.php',
          cache: false,
          success: function(result) {
              window.location.reload();
          }
        });
      }
    });
}
