<html>
	<head>
		<link rel="stylesheet" href="styles.css" type="text/css">
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="quoteLoader.js"></script>
	</head>

	<body>
		<?php
			include "setup_connection.php";

			$quoteNewCount = $_POST['quoteNewCount'];

			$sql = "SELECT HappyID, Happy_quote, HappyRating FROM happy_table ORDER BY HappyRating DESC LIMIT $quoteNewCount";
			$result = $mysqli->query($sql) or die("an error has occured");


			if ($result->num_rows > 0) {
				?> <div id = "quotes_root" > <?php

					// output data of each row		
					while($row = $result->fetch_assoc()) {
						?>
							<div class = "quote_container">
								<div class = "quoteBlock" data-gratID="<?php echo ($row["HappyID"]);?>">
									<div class = "quoteText" data-gratID="<?php echo ($row["HappyID"]);?>">
										"<?php echo stripslashes($row["Happy_quote"]);?>"
									</div>									
									<div class = "gratitudeRatings" data-gratID="<?php echo ($row["HappyID"]);?>">
										Gratitude Rating: <br> 
										<?php echo $row["HappyRating"]; ?>
									</div>
									<div class = "buttons">
										<input type="submit" class="button" name="<?php echo "good".($row["HappyID"]);?>" id = "goodButton" value="Thanks, I feel better!" />
										<input type="submit" class="button" name="<?php echo "bad".($row["HappyID"]);?>" id = "badButton" value="I still feel like trash" />
									</div>
								</div>
							</div>

						<?php
						
					}

				?>
				</div>

				<?php
			} else {
				echo "0 results";
			}
		?>

		<script src = "randomColors.js"></script>

		<script src="jquery.fittext.js"></script>
		<script type="text/javascript">
			$(".quoteText").fitText(2);			
		</script>  

	</body>

</html>

