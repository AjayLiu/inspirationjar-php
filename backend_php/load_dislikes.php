<html>
	<head>
		<link rel="stylesheet" href="../css/styles.css" type="text/css">
		<script src="../js/dislikeHistoryLoader.js"></script>
		
	</head>

	<body>

		<?php
			include "setup_connection.php";
            $email = $_SESSION['payload']['email'];
            $sql = "SELECT Dislikes FROM accounts WHERE Email = '$email'";
			$result = $mysqli->query($sql) or die("an error has occured");
            $prevDislikes = $result->fetch_assoc()['Dislikes'];
            $prevDislikesIDs = explode(",", "$prevDislikes"); //LAST IS ALWAYS EMPTY
            $DislikesToSql = "";
            if(count($prevDislikesIDs) > 1){
                for($i = 0; $i < count($prevDislikesIDs)-1; $i++){
                    $DislikesToSql .= $prevDislikesIDs[$i];
                    if($i != count($prevDislikesIDs)-2){
                        $DislikesToSql.=',';
                    }
                }
                $sql = "SELECT * FROM happy_table WHERE HappyID IN ($DislikesToSql)";
    			$result = $mysqli->query($sql) or die("an error has occured");
            }

        ?>
        <div id = "prevDislikes"><?php include "getAccountNums/numDislikes.php"; ?> </div>
        <?php
            if ($result->num_rows > 0) {
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
                                    <input type="image" src="/images/trashcan.png" name="<?php echo ($row["HappyID"]);?>" class = "undislikeButton" value='dislike'/>
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
