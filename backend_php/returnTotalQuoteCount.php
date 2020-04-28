<?php
    include "setup_connection.php";
    include "redirectLinks.php";

    session_start();

    $search = $_POST['search'];
    $sqlSearch = '%';
    if(isset($_POST['search'])){
        $sqlSearch = '%'.$search.'%';
    }

    //var_dump($search);

    $unique = $_POST['unique'];
    $uniqueIgnore = '-1';

    if(isset($unique)){
        if($unique == "true"){
            $email = $_SESSION['payload']['email'];
            $sql = "SELECT Likes, Dislikes, Favorites, Reports FROM accounts WHERE Email = '$email'";
            $result = $mysqli->query($sql) or die("an error has occured");

            $historyRow = $result->fetch_assoc();
            $historyStr = $historyRow['Likes'].$historyRow['Dislikes'].$historyRow['Favorites'].$historyRow['Reports'];
            $uniqueIgnore = substr($historyStr, 0, strlen($historyStr)-1);
        }
    }

    $sql = "SELECT HappyID, Happy_quote, HappyRating FROM happy_table WHERE isReviewedSafe = 1 AND Happy_quote LIKE ? AND HappyID NOT IN ($uniqueIgnore)";
    $stmt = mysqli_stmt_init($mysqli);
    //$result = $mysqli->query($sql) or die("an error has occured");
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "SQL ERROR";
    } else {
        mysqli_stmt_bind_param($stmt, "s", $sqlSearch);
        mysqli_stmt_execute($stmt);
    }
    $result = $stmt->get_result();
    echo mysqli_num_rows($result);

    // //EXCLUDE REPORTED ONES
    // $sql = "SELECT COUNT(1) FROM happy_table WHERE isReviewedSafe = 1 ORDER BY HappyRating DESC LIMIT 5";
    // $result = $mysqli->query($sql);
    //
    // $row = ($result)->fetch_array();
    //
    // $total = $row[0];
    // echo $total;

?>
