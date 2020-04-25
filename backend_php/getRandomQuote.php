<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="../js/quoteLoader.js"></script>

<?php
    include "setup_connection.php";
    $id = $_POST['id'];
    $sql = "SELECT HappyID, Happy_quote, HappyRating FROM happy_table WHERE HappyID = $id";
    $result = $mysqli->query($sql) or die("an error has occured");


    if (mysqli_num_rows($result) > 0) {
        $row = $result->fetch_assoc();
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
?>
