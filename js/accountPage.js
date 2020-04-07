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
    }
);

function logout(){
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
