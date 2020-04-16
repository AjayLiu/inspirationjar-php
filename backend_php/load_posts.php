<html>
	<head>
		<link rel="stylesheet" href="../css/styles.css" type="text/css">
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../js/postLoader.js"></script>

	</head>

	<body>

		<?php
			include "setup_connection.php";
            $email = $_SESSION['payload']['email'];
            $sql = "SELECT Posts FROM accounts WHERE Email = '$email'";
			$result = $mysqli->query($sql) or die("an error has occured");
            $prevPosts = $result->fetch_assoc()['Posts'];
            $prevPostsIDs = explode(",", "$prevPosts"); //LAST IS ALWAYS EMPTY
            $postsToSql = "";

            if(count($prevPostsIDs) > 1){
                for($i = 0; $i < count($prevPostsIDs)-1; $i++){
                    $postsToSql .= $prevPostsIDs[$i];
                    if($i != count($prevPostsIDs)-2){
                        $postsToSql.=',';
                    }
                }
                $sql = "SELECT * FROM happy_table WHERE HappyID IN ($postsToSql) ORDER BY HappyDate DESC";
    			$result = $mysqli->query($sql) or die("an error has occured");
            }

        ?>
        <div id = "prevPosts"><?php include "getAccountNums/numPosts.php"; ?> </div>
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
                                    } else if (!$row['isReviewedSafe']){
										echo "This post is still under review.";
									} else {
										echo "Gratitude Rating: <br>";
										echo $row["HappyRating"];
									}
		                            ?>
								</div>
                                <div class = "quoteEditBar" data-gratID="<?php echo ($row["HappyID"]);?>">
                                    <input type="image" src="/images/trashcan.png" name="<?php echo ($row["HappyID"]);?>" class = "deleteButton" value=''/>
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
