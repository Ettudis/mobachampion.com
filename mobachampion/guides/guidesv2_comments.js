var commentSaveInProgress = false;

$(document).ready(function() 
{
	$("#comment_button").click(function()
	{
		SaveComment();
	});
	
	$(".news_comment_input").bind("keyup", function(event, ui) 
	{                          
		// Write your code here
		var numRemaining = 400 - $(this).val().length;
		if (numRemaining < 25)
		{
			$(".news_comment_post_chars_remaining").html("<font color=\"red\"> " + numRemaining + " characters remaining.</font>");
		}
		else if (numRemaining < 5)
		{
			$(".news_comment_post_chars_remaining").html("<font color=\"yellow\"> " + numRemaining + " characters remaining.</font>");
		}
		else
		{
			$(".news_comment_post_chars_remaining").html(" " + numRemaining + " characters remaining.");
		}
		
		if ($(this).val() != "" && $(this).val() != "Comment...")
		{
			$(this).css('border', 'none');
		}
	});

});

function SaveComment()
{
	console.log(comment_topic);
	var comment = $(".news_comment_input").val();
	console.log(comment);
	
	if (commentSaveInProgress == false && comment.length > 0 && comment != "Comment...") 
	{
		commentSaveInProgress = true;
		
			$.post( 
             "http://www.moba-champion.com/guides/actions/guidecomment.php",
             { 
				topic : comment_topic,
				comment : comment
			},
             function(data) 
			 {
				console.log(data);
				commentSaveInProgress = false;
				location.reload();
             })
			.error(function() 
			{ 
				alert("Error commenting on guide.");
				commentSaveInProgress = false;
			});		
	}
	else
	{
		$(".news_comment_input").css('border', '2px solid red');
	}
}