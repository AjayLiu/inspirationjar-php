<?php
	include "setup_connection.php";
	include "redirectLinks.php";
	include "rememberMe.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Home | EncourageMe </title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="styles.css" type="text/css">
        
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="/js/quoteLoader.js"></script>
	</head>

	<body>
		<div class = "navbar">
            <div class = "navanchors">
                <ul>
                    <li><a href = "index.php">Home</a></li>
                    <li><a href = "submit.php">Submit</a></li>
                    <li><a href = "contact.html">Contact</a></li>
                </ul>
            </div>            
        </div>
		<div class = "intro">
            <h1>had a bad day?</h1>
            <p>Read some encouraging messages submitted from wholesome humans around the world!</p>                             
			
		</div> 

		<?php
			$sql = "SELECT HappyID, Happy_quote, HappyRating FROM happy_table ORDER BY HappyRating DESC LIMIT 5";
			$result = $mysqli->query($sql);

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
        <script src = "/js/randomColors.js"></script>
		
		<div class = "refreshButtonContainer">
			<button id = "refreshButton">Click for more messages!</button>
		</div>
		
		<script src="/js/jquery.fittext.js"></script>
		<script type="text/javascript">
			if(window.innerWidth > 767){
				$(".quoteText").fitText(2);	
				$("#refreshButton").fitText(8);	
			} else {
				$(".quoteText").fitText(1);	
				$("#refreshButton").fitText(2);	
			}
				
		</script>  
		
	</body>

</html>