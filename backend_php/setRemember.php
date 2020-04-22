<?php
    session_start();
    if(isset($_POST['remember'])){        
        $_SESSION['remember'] = $_POST['remember'];
    }
?>
