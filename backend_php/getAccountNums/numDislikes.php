<?php
    include "../setup_connection.php";
    session_start();

    $email = $_SESSION['payload']['email'];
    $sql = "SELECT Dislikes FROM accounts WHERE Email = '$email'";
    $result = $mysqli->query($sql) or die("an error has occured");
    $prevLikes = $result->fetch_assoc()['Dislikes'];
    $prevLikesIDs = explode(",", "$prevLikes"); //LAST IS ALWAYS EMPTY
    $LikesToSql = "";

    if(count($prevLikesIDs) > 1){
        for($i = 0; $i < count($prevLikesIDs)-1; $i++){
            $LikesToSql .= $prevLikesIDs[$i];
            if($i != count($prevLikesIDs)-2){
                $LikesToSql.=',';
            }
        }

        $sql = "SELECT * FROM happy_table WHERE HappyID IN ($LikesToSql)";
        $result = $mysqli->query($sql) or die("an error has occured");
        if(mysqli_num_rows($result) > 0)
            echo "Number of Disliked Posts: ".mysqli_num_rows($result);
        else
            echo "You have not disliked any posts";
    }  else {
        echo "You have not disliked any posts";
    }

?>
