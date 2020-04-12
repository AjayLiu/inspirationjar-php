<html>
	<head>
		<link rel="stylesheet" href="../css/styles.css" type="text/css">
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="../js/quoteLoader.js"></script>

	</head>

	<body>

		<?php
			include "setup_connection.php";
			$quoteNewCount = 10;
			if(isset($_POST['quoteNewCount'])){
				$quoteNewCount = $_POST['quoteNewCount'];
			}
			$sql = "SELECT HappyID, Happy_quote, HappyRating FROM happy_table WHERE isReported = 0 OR isReviewedSafe = 1 ORDER BY HappyRating DESC LIMIT $quoteNewCount";
			$result = $mysqli->query($sql) or die("an error has occured");


			if ($result->num_rows > 0) {


				// output data of each row
				while($row = $result->fetch_assoc()) {
					?>
						<div class = "quote_container">
							<div class = "quoteBlock" data-gratID="<?php echo ($row["HappyID"]);?>">
								<input type="image" src="/images/redflag.png" name="<?php echo ($row["HappyID"]);?>" class = "reportButton" value=''/>
								<input type="image" src="/images/heartBlank.png" name="<?php echo ($row["HappyID"]);?>" class = "favoriteButton" value=''/>

								<div class = "quoteText" data-gratID="<?php echo ($row["HappyID"]);?>">
									"<?php echo stripslashes($row["Happy_quote"]);?>"
								</div>
								<div class = "gratitudeRatings" data-gratID="<?php echo ($row["HappyID"]);?>">
									Gratitude Rating: <br>
									<?php echo $row["HappyRating"]; ?>
								</div>
								<div class = "buttons">
									<input type="image" src=images/smile.png class="button" name="<?php echo "good".($row["HappyID"]);?>" id = "goodButton" value="Thanks, I feel better!"/>
									<input type="image" src=images/sad.png class="button" name="<?php echo "bad".($row["HappyID"]);?>" id = "badButton" value="I still feel like trash" />
								</div>
							</div>
						</div>
					<?php
				}
			} else {
				//0 results;
				//echo "0 results";
			}
		?>

		<script src = "/js/randomColors.js"></script>
		<script src="/js/jquery.fittext.js"></script>
		<script src="/js/fittext.js"></script>


	</body>

</html>
