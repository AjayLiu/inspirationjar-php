<html>
	<head>
		<link rel="stylesheet" href="../css/styles.css" type="text/css">
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	</head>

	<body>

		<?php
			include "setup_connection.php";
            $email = $_SESSION['payload']['email'];
            $sql = "SELECT Likes FROM accounts WHERE Email = '$email'";
			$result = $mysqli->query($sql) or die("an error has occured");
            $prevPosts = $result->fetch_assoc()['Likes'];
            $prevPostsIDs = explode(",", "$prevPosts"); //LAST IS ALWAYS EMPTY
            $postsToSql = "";

            if(count($prevPostsIDs) > 1){
                for($i = 0; $i < count($prevPostsIDs)-1; $i++){
                    $postsToSql .= $prevPostsIDs[$i];
                    if($i != count($prevPostsIDs)-2){
                        $postsToSql.=',';
                    }
                }
                $sql = "SELECT * FROM happy_table WHERE HappyID IN ($postsToSql)";
    			$result = $mysqli->query($sql) or die("an error has occured");
            }

        ?>
        <div id = "prevPosts">Your Previous Likes: <?php echo count($prevPostsIDs)-1?> </h1>
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
							</div>
						</div>
					<?php
				}
			} else {
				//0 results;
				echo "0 results";
			}

		?>

		<script src = "/js/randomColors.js"></script>
		<script src="/js/jquery.fittext.js"></script>
		<script src="/js/fittext.js"></script>


	</body>

</html>
