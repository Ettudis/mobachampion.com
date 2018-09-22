var commentSaveInProgress = false;

$(document).ready(function() 
{
	$("#comment_button").click(function()
	{
		SaveComment();
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
             "submitcomment.php",
             { 
				topic : comment_topic,
				comment : comment
			},
             function(data) 
			 {
				location.reload();
             }

          );		
	}
	else
	{
		$(".news_comment_input").css('border', '2px solid red');
	}
}