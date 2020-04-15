<?php
    include "setup_connection.php";
    session_start();

    $email = $_SESSION['payload']['email'];
    $sql = "SELECT Posts FROM accounts WHERE Email = '$email'";
    $result = $mysqli->query($sql) or die("an error has occured");
    $prevPosts = $result->fetch_assoc()['Posts'];
    $prevPostsIDs = explode(",", "$prevPosts"); //LAST IS ALWAYS EMPTY
    $PostsToSql = "";

    if(count($prevPostsIDs) > 1){
        for($i = 0; $i < count($prevPostsIDs)-1; $i++){
            $PostsToSql .= $prevPostsIDs[$i];
            if($i != count($prevPostsIDs)-2){
                $PostsToSql.=',';
            }
        }

        $sql = "SELECT * FROM happy_table WHERE HappyID IN ($PostsToSql)";
        $result = $mysqli->query($sql) or die("an error has occured");
        if(mysqli_num_rows($result) > 0){
            $sum = 0;
            while($row = $result->fetch_assoc()){
                $sum += $row['HappyRating'];
            }
            echo $sum;
        } else{
            echo 0;
        }
    } else {
        echo 0;
    }


?>
