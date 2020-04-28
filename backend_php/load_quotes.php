<html>
	<head>
		<link rel="stylesheet" href="../css/styles.css" type="text/css">
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="../js/quoteLoader.js"></script>
	</head>

	<body>

		<?php
			include "setup_connection.php";
			include "redirectLinks.php";

			session_start();

			$quoteNewCount = 10;
			if(isset($_POST['quoteNewCount'])){
				$quoteNewCount = $_POST['quoteNewCount'];
			}

			$sortSetting = 'HappyRating DESC';
			switch($_COOKIE['sort']){
				case 'MostLiked':
					$sortSetting = "HappyRating DESC";
					break;
				case 'MostRecent':
					$sortSetting = "HappyDate DESC";
					break;
				case 'LeastLiked':
					$sortSetting = "HappyRating ASC";
					break;
				case 'LeastRecent':
					$sortSetting = "HappyDate ASC";
					break;
			}

			$search = $_POST['search'];
			$sqlSearch = '%';
			if(isset($_POST['search'])){
				$sqlSearch = '%'.$search.'%';
			}

			$unique = $_POST['unique'];
			$uniqueIgnore = '-1';

			if(isset($unique)){
				if($unique == "true"){
					if(!isset($_SESSION['payload'])){
						$_SESSION['redir'] = "$indexLink";
						$url = $loginPageLink;
						echo "<script type='text/javascript'>window.top.location='$url';</script>"; exit;
					} else {
						$email = $_SESSION['payload']['email'];
						$sql = "SELECT Likes, Dislikes, Favorites, Reports FROM accounts WHERE Email = '$email'";
						$result = $mysqli->query($sql) or die("an error has occured");

						$historyRow = $result->fetch_assoc();
						$historyStr = $historyRow['Likes'].$historyRow['Dislikes'].$historyRow['Favorites'].$historyRow['Reports'];
						$uniqueIgnore = substr($historyStr, 0, strlen($historyStr)-1);
					}
				}
			}

			$sql = "SELECT HappyID, Happy_quote, HappyRating FROM happy_table WHERE isReviewedSafe = 1 AND Happy_quote LIKE ? AND HappyID NOT IN ($uniqueIgnore) ORDER BY $sortSetting LIMIT ?";
			$stmt = mysqli_stmt_init($mysqli);
			//$result = $mysqli->query($sql) or die("an error has occured");
			if(!mysqli_stmt_prepare($stmt, $sql)){
				echo "SQL ERROR";
			} else {
				mysqli_stmt_bind_param($stmt, "si", $sqlSearch, $quoteNewCount);
				mysqli_stmt_execute($stmt);
			}


			$result = $stmt->get_result();
			if (mysqli_num_rows($result) > 0) {
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
									<input type="image" alt='Like Button' src=images/smile.png class="button" name="<?php echo "good".($row["HappyID"]);?>" id = "goodButton" value="Thanks, I feel better!"/>
									<input type="image" alt='Dislike Button' src=images/sad.png class="button" name="<?php echo "bad".($row["HappyID"]);?>" id = "badButton" value="I still feel like trash" />
								</div>
							</div>
						</div>
					<?php
				}
			} else {
				//0 results;
				echo "0 results :(";
			}
		?>

		<script src = "/js/randomColors.js"></script>
		<script src="/js/jquery.fittext.js"></script>
		<script src="/js/fittext.js"></script>


	</body>

</html>
