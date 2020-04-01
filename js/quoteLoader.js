$(document).ready(
    function(){
        //GET ALL IDs that the user has already voted on
        var alreadyVotes;
        $.ajax({
            type: 'GET',
            url: 'getVotedIDs.php',
            cache: false,
            success: function(result) {
                alreadyVotes = result;
                markDupes();
            },
        });

        //Refresh Button
        var quoteCount = 5;
        $("#refreshButton").click(
            function(){
                quoteCount = quoteCount + 5;
                $("#quotes_root").load("load_quotes.php", {quoteNewCount: quoteCount}, function(){								
                    markDupes();
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
                    $(this).css('color', "yellow"); 	
                }
            });
        }

        //LIKE AND DISLIKE BUTTON
        $('.button').click(function(){	

            var clickBtnValue = $(this).attr("name");	

            /* CLIENT SIDE ANIMATION */
            var id = clickBtnValue.substring(clickBtnValue.indexOf('d') + 1);
            
            //IF IS A NEW VOTE
            if( alreadyVotes == null || alreadyVotes.indexOf(id+",") == -1){

                //UPDATE ALREADYVOTES
                //GET ALL IDs that the user has already voted on
                $.ajax({
                    type: 'GET',
                    url: 'getVotedIDs.php',
                    cache: false,
                    success: function(result) {
                        alreadyVotes = result;
                        markDupes();
                    },
                });
                
                var grat = ".gratitudeRatings[data-gratID=\"" + id + "\"]";
                //ADD or SUBTRACT ONE TO GRATITUDE (client side)  																			
                var rating = $(grat).text().substring($(grat).text().indexOf(':')+1).trim();										
                var toAdd = (clickBtnValue.charAt(0) == 'g') ? 1 : -1;																				
                var ratingInt = parseInt(rating) + toAdd;
                var newHTML = $(grat).text().substring(0, $(grat).text().indexOf(':') + 1) + "<br>" + ratingInt;
                $(grat).html(newHTML);
                
                //CHANGE COLOR
                $(grat).css('color', toAdd == 1? "green": "red"); 	


                
            }

            //AJAX TO LOG VOTE INTO DATABASE / PROMPT LOGIN
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
                                
        });
    }
);	