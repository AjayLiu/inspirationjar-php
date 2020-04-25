<?php
    include "setup_connection.php";

    $sql = "SELECT HappyID FROM happy_table WHERE isReviewedSafe = 1";
    $result = $mysqli->query($sql) or die("ouch, error");
    $str = '';
    while($row = $result->fetch_assoc()){
        $str.=$row['HappyID'].',';
    }
    echo $str;
?>
