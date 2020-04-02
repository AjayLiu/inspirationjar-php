$(document).ready(
    function(){
        $('.gratitudeRatings').hide();
        //GET ALL IDs that the user has already voted on
        var alreadyVotes;
        $.ajax({
            type: 'GET',
            url: 'backend_php/getVotedIDs.php',
            cache: false,
            success: function(result) {
                alreadyVotes = result;
                markDupes();
                $('.gratitudeRatings').show();
            },
        });


        //REPORT BUTTON
        $(".reportButton").click(
            function(){
                var reportID = $(this).attr("name");


                var ajaxurl = 'backend_php/report.php',
                data =  {'reportedID': reportID};
                $.post(ajaxurl, data, function (response) {
                    if(response != "SUCCESS"){
                        if(response == "DUPE"){
                            alert("It looks like you reported this quote before. Sorry for showing this to you again, must be an error");
                        } else if(isNaN(response)){
                            //REDIRECT TO LOGIN
                            window.location = response;
                        } else {
                            //SPAM
                            alert("It looks like you reported a quote just " + response + " seconds ago. Please wait at least 30 seconds before reporting.");
                        }
                    } else {
                        alert("Thanks for maintaining order in this site! We will review this quote and take the appropriate actions.");
                        var reportedBlock = ".quoteBlock[data-gratID=\"" + reportID + "\"]";
                        $(reportedBlock).remove();
                    }
                });
            }
        );

        //Refresh Button
        var quoteCount = 5;

        $("#refreshButton").click(
            function(){
                //FIRST CHECK IF THERE ARE ANY QUOTES TO LOAD
                $.ajax({
                    type: 'GET',
                    url: 'backend_php/returnTotalQuoteCount.php',
                    cache: false,
                    success: function(result) {
                        if(quoteCount <= result){
                            quoteCount = quoteCount + 5;
                            $("#quotes_root").load("load_quotes.php", {quoteNewCount: quoteCount}, function(){
                                markDupes();
                            });
                        } else {
                            //REMOVE REFRESH BUTTON
                            alert("No more quotes to load!");
                            $("#refreshButton").remove();
                        }
                    },
                });


            }
        );

        function markDupes(){
            //MARK ALL POSTS THAT ARE ALREADY VOTED IN YELLOW
            $('.gratitudeRatings').each(function(){
                var thisId = $(this).attr("data-gratid");

                //FOUND A POST ALREADY VOTED BY USER
                if(alreadyVotes.indexOf(thisId+",") != -1){
                    var newHTML = "You already voted on this post!";
                    $(this).html(newHTML);
                    $(this).css('color', "orange");
                }
            });
        }


        var IDsToIgnoreReacting = "";

        //LIKE AND DISLIKE BUTTON
        $('.button').click(function(){

            var clickBtnValue = $(this).attr("name");

            /* CLIENT SIDE ANIMATION */
            var id = clickBtnValue.substring(clickBtnValue.indexOf('d') + 1);

            //AJAX TO LOG VOTE INTO DATABASE / PROMPT LOGIN
            /*
            var ajaxurl = 'vote.php',
            data =  {'action': clickBtnValue};
            var session;
            $.ajaxSetup({cache: false})
            $.get(ajaxurl, function (data) {
                session = data;
            }).done(function(){
                $.post(ajaxurl, data, function (response) {
                    if(response != "DUPE"){
                        if(response != "LOGGED IN"){
                            //SEND TO LOGIN PAGE
                            window.location = session;
                        }
                    }
                });
            });
            */
            //AJAX TO LOG VOTE INTO DATABASE / PROMPT LOGIN
            var ajaxurl = 'backend_php/vote.php',
            data =  {'action': clickBtnValue};
            $.ajaxSetup({cache: false})
            $.post(ajaxurl, data, function (response) {
                if(response != "DUPE"){
                    if(response != "LOGGED IN"){
                        //SEND TO LOGIN PAGE
                        window.location = response;
                    }
                }
            });


            //UPDATE ALREADYVOTES
            //GET ALL IDs that the user has already voted on
            $.ajax({
                type: 'GET',
                url: 'backend_php/getVotedIDs.php',
                cache: false,
                success: function(result) {
                    alreadyVotes = result;
                    markDupes();
                },
            });

            //IF IS A NEW VOTE
            if( alreadyVotes == null || alreadyVotes.indexOf(id+",") == -1 && IDsToIgnoreReacting.indexOf(id+',') == -1){
                var grat = ".gratitudeRatings[data-gratID=\"" + id + "\"]";
                //ADD or SUBTRACT ONE TO GRATITUDE (client side)
                var rating = $(grat).text().substring($(grat).text().indexOf(':')+1).trim();
                var toAdd = (clickBtnValue.charAt(0) == 'g') ? 1 : -1;
                var ratingInt = parseInt(rating) + toAdd;
                var newHTML = $(grat).text().substring(0, $(grat).text().indexOf(':') + 1) + "<br>" + ratingInt;
                $(grat).html(newHTML);

                //PREVENT SPAMMING (client side)
                IDsToIgnoreReacting+=id+',';

                //CHANGE COLOR
                $(grat).css('color', toAdd == 1? "green": "red");
            }




        });
    }
);
