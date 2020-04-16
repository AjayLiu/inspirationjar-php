<?php
    include "setup_connection.php";

    //EXCLUDE REPORTED ONES
    $sql = "SELECT COUNT(1) FROM happy_table WHERE isReviewedSafe = 1 ORDER BY HappyRating DESC LIMIT 5";
    $result = $mysqli->query($sql);

    $row = ($result)->fetch_array();

    $total = $row[0];
    echo $total;

?>
