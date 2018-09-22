var voteInProgress = false;

$(document).ready(function() 
{
	$("#upvote_button").click(function()
	{
		Vote(1);
	});
	
	$("#downvote_button").click(function()
	{
		Vote(-1);
	});
});

function Vote(type)
{
	if (voteInProgress == false) 
	{
		voteInProgress = true;
		
		$.post("http://www.moba-champion.com/guides/actions/voteguide.php",
		{ 
			id : comment_topic,
			type : type
		},
		function(data) 
		{
			console.log(data);
			var results = jQuery.parseJSON(data)
			if (results.type == "1")
			{
				$("#upvote_button").removeClass("upvote");
				$("#upvote_button").addClass("upvoted");
				$("#downvote_button").removeClass("downvoted");
				$("#downvote_button").addClass("downvote");
			}
			else if (results.type == "-1")
			{
				$("#upvote_button").addClass("upvote");
				$("#upvote_button").removeClass("upvoted");
				$("#downvote_button").addClass("downvoted");
				$("#downvote_button").removeClass("downvote");
			}
			voteInProgress = false;
		}).error(function() 
		{ 
			alert("Error voting on guide.");
			voteInProgress = false;
		});		
	}
}