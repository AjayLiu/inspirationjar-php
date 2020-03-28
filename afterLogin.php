<?php 
    include "google.php";
    $payload = $_SESSION['payload'];

    if(isset($payload['email'])){
        echo $payload['email'];
    } 

    $url = $_SESSION['redir'];
    
    header("Location: $url");
?>