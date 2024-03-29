<html>
	<head>
		<link rel="stylesheet" href="../css/styles.css" type="text/css">
        <script src="../js/favoriteLoader.js"></script>

	</head>

	<body>

		<?php
			include "setup_connection.php";
            $email = $_SESSION['payload']['email'];
            $sql = "SELECT Favorites FROM accounts WHERE Email = '$email'";
			$result = $mysqli->query($sql) or die("an error has occured");
            $prevFaves = $result->fetch_assoc()['Favorites'];
            $prevFaveIDs = explode(",", "$prevFaves"); //LAST IS ALWAYS EMPTY
            $favesToSql = "";

            if(count($prevFaveIDs) > 1){
                for($i = 0; $i < count($prevFaveIDs)-1; $i++){
                    $favesToSql .= $prevFaveIDs[$i];
                    if($i != count($prevFaveIDs)-2){
                        $favesToSql.=',';
                    }
                }
                $sql = "SELECT * FROM happy_table WHERE HappyID IN ($favesToSql)";
    			$result = $mysqli->query($sql) or die("an error has occured");
            }

        ?>
        <div id = "prevFaves"><?php include "getAccountNums/numFaves.php"; ?> </div>
        <?php
            if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					?>
						<div class = "quote_container">
							<div class = "quoteBlock" data-gratID="<?php echo ($row["HappyID"]);?>">
								<div class = "quoteText" data-gratID="<?php echo ($row["HappyID"]);?>">
									"<?php echo stripslashes($row["Happy_quote"]);?>"
								</div>
								<div class = "gratitudeRatings" data-gratID="<?php echo ($row["HappyID"]);?>">
                                    <?php
                                    if($row['isReported'] && !$row['isReviewedSafe']){
                                        echo "This post has been reported and is under review.";
                                    } else {
                                        echo "Gratitude Rating: <br>";
    									echo $row["HappyRating"];
                                    }
		                            ?>
								</div>
								<div class = "quoteEditBar" data-gratID="<?php echo ($row["HappyID"]);?>">
									<input type="image" src="/images/heartbreak.png" name="<?php echo ($row["HappyID"]);?>" class = "unfavoriteButton" value=''/>
                                </div>
							</div>
						</div>
					<?php
				}
			} else {
				//0 results;
				echo "0 results";
			}

		?>

	</body>

</html>
