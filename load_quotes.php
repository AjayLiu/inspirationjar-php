<html>
	<head>
		<link rel="stylesheet" href="styles.css" type="text/css">
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	</head>

	<body>
		<?php
			include "setup_connection.php";

			$quoteNewCount = $_POST['quoteNewCount'];

			$sql = "SELECT HappyID, Happy_quote FROM happy_table ORDER BY HappyRating DESC LIMIT $quoteNewCount";
			$result = $mysqli->query($sql) or die("an error has occured");


			if ($result->num_rows > 0) {
				?> <div id = "quotes_root" > <?php

					// output data of each row		
					while($row = $result->fetch_assoc()) {
						?>
							<div class = "quote_container">
								<div class = "quoteBlock">
									<div class = "quoteText">
										"<?php echo stripslashes($row["Happy_quote"]);?>"
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

		<script> 
			function setRandomColors(){
				var colors = ['#00a388', '#d4a31c', '#e3d0c1', '#d2bfdb', '#bfd1db', '#b5dff7', '#b2ebc8'];
				var arr = document.getElementsByClassName('quote_container');
				for (i = 0; i < arr.length; i++) {
					var random_color = colors[Math.floor(Math.random() * colors.length)];
 					arr[i].style.backgroundColor = random_color;
				}
			}
			setRandomColors();

		</script>

		<script src="jquery.fittext.js"></script>
		<script type="text/javascript">
			$(".quoteText").fitText(2);			
		</script>  

	</body>

</html>

