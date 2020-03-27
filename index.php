<?php
    include "setup_connection.php";
?>

<html>
	<head>
		<meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Home | EncourageMe </title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="styles.css" type="text/css">
        
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script>
			$(document).ready(
                function(){
                    //Refresh Button
					var quoteCount = 5;
                    $("#refreshButton").click(
                        function(){
                            quoteCount = quoteCount + 5;
                            $("#quotes_root").load("load_quotes.php", {quoteNewCount: quoteCount});
                        }
                    );
					$('.button').click(function(){
						var clickBtnValue = $(this).attr("name");						
						var ajaxurl = 'vote.php',
						data =  {'action': clickBtnValue};
						$.post(ajaxurl, data, function (response) {
							// Response div goes here.
							//alert("action performed successfully");
						});
					});
			    }
            );			
		</script>
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
			include "setup_connection.php";


			$sql = "SELECT HappyID, Happy_quote FROM happy_table ORDER BY HappyRating DESC LIMIT 5";
			$result = $mysqli->query($sql);

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
			$(".quoteText").fitText(1.5);			
		</script>  

        <button id = "refreshButton">Click for more messages!</button>

	</body>

</html>