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

        //GET ALL IDs that the user has already FAVORITED on
        var alreadyFaves;
        $.ajax({
            type: 'GET',
            url: 'backend_php/getFavedIDs.php',
            cache: false,
            success: function(result) {
                alreadyFaves = result;
                markFaves();
            },
        });



        //REPORT BUTTON
        $(".reportButton").click(
            function(){

                swal({
                  title: "Are you sure you want to report this post?",
                  text: "Is this post potentially offensive to viewers or is completely off topic?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                }).then((willDelete) => {
                  if (willDelete) {
                    swal("Quote successfully reported", {
                      icon: "success",
                    });

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
                            alert("Report Successful. Thanks for maintaining order in this site! We will review this quote and take the appropriate actions.");
                            var reportedBlock = ".quoteBlock[data-gratID=\"" + reportID + "\"]";
                            $(reportedBlock).remove();
                        }
                    });
                  }
                });

            }
        );




        //FAVORITE BUTTON
        $(".favoriteButton").click(
            function(){

                //FLIP FLOP THE IMAGE
                if($(this).attr("src") == "../images/heart.png"){
                    $(this).attr("src","../images/heartBlank.png");
                } else {
                    $(this).attr("src","../images/heart.png");
                }

                var favID = $(this).attr("name");
                var ajaxurl = 'backend_php/favorite.php',
                data =  {'favID': favID};
                $.post(ajaxurl, data, function (response) {
                    if(response != "LOGGED IN"){
                        //SEND TO LOGIN PAGE
                        window.location = response;
                    } else {
                        //GET ALL IDs that the user has already FAVORITED on
                        $.ajax({
                            type: 'GET',
                            url: 'backend_php/getFavedIDs.php',
                            cache: false,
                            success: function(result) {
                                alreadyFaves = result;
                            },
                        });
                    }
                });
            }

        );

        //Refresh
        var quoteCount;
        function refresh(){
            allowRefresh = false;
            //FIRST CHECK IF THERE ARE ANY QUOTES TO LOAD
            $.ajax({
                type: 'GET',
                url: 'backend_php/returnTotalQuoteCount.php',
                cache: false,
                success: function(result) {
                    quoteCount = $( ".quoteBlock" ).length + 10;
                    $("#quotes_root").load("/backend_php/load_quotes.php", {'quoteNewCount': quoteCount}, function(){
                        markDupes();
                    });
                },
            });
        }

        $(window).scroll(function() {
            if(allowRefresh && !isSearch){
                if($(window).scrollTop() + $(window).height() > $(document).height() - 200) {
                    $.ajax({
                        type: 'GET',
                        url: 'backend_php/returnTotalQuoteCount.php',
                        cache: false,
                        success: function(result) {
                            quoteCount = $( ".quoteBlock" ).length;
                            if(quoteCount == result){
                                $('.loadingIndicator').text("That's all the quotes so far! Help spread the positivity and submit a quote!");
                                allowRefresh = false;
                            }
                            if(quoteCount <= result){
                                if(allowRefresh){
                                    refresh();
                                }
                            }
                        }
                    });
                }
            } else if(isSearch){
                $('.loadingIndicator').text("End of search");
            } else {
                $('.loadingIndicator').text("That's all the quotes so far! Help spread the positivity and submit a quote!");
            }

        });

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

        //MARK Favorites
        function markFaves(){
            //CHANGE PICS OF ALL POSTS THAT ARE FAVORITED INTO HEARTS
            $('.favoriteButton').each(function(){
                var thisId = $(this).attr("name");

                //FOUND A POST ALREADY FAVORITED BY USER
                if(alreadyFaves.indexOf(thisId+",") != -1){
                    $(this).attr("src","../images/heart.png");
                } else {
                    $(this).attr("src","../images/heartBlank.png");
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
            var ajaxurl = 'backend_php/vote.php',
            data =  {'action': clickBtnValue};
            $.ajaxSetup({cache: false})
            $.post(ajaxurl, data, function (response) {
                if(response != "DUPE"){
                    if(response != "LOGGED IN"){
                        //SEND TO LOGIN PAGE
                        window.location = response;
                    }
                } else {
                    //user probably spamming the vote or something
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
