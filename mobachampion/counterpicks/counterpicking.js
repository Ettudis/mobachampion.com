var currentVoteMode = 1;
var currentShaper = "";
var voteinprogress = false;

function Vote(shaper, vote, url)
{
	if (voteinprogress == false)
	{
		voteinprogress = true;
		
		$.post(url,
		{ 
            target : shaper,
			shaper : primaryShaper,
			vote : vote
		},
		function(data) 
		{		
			voteinprogress = false;
			location.reload();			
		});
	}	
}

$(document).ready(function() 
{
	$(".strong_show_more").click(function()
	{
		$(".counterpick_strong_more").slideToggle();
		if ($(this).html() == "Show More")
		{
			$(this).html("Show Less");
		}
		else
		{
			$(this).html("Show More");
		}
	});

	$(".weak_show_more").click(function()
	{
		$(".counterpick_weak_more").slideToggle();
		if ($(this).html() == "Show More")
		{
			$(this).html("Show Less");
		}
		else
		{
			$(this).html("Show More");
		}
	});

	$(".good_show_more").click(function()
	{
		$(".counterpick_good_more").slideToggle();
		if ($(this).html() == "Show More")
		{
			$(this).html("Show Less");
		}
		else
		{
			$(this).html("Show More");
		}
	});

	$(".guide_show_more").click(function()
	{
		$(".counterpick_guide_more").slideToggle();
		if ($(this).html() == "Show More")
		{
			$(this).html("Show Less");
		}
		else
		{
			$(this).html("Show More");
		}
	});	
	
	$(".strong_add_pick").click(function()
	{
		currentVoteMode = 1;
		if (isLoggedIn)
		{
			$(".counterpick_pop_title").html("Add another strong pick:");
			$(".counterpick_pop").toggle(250);
			$(".counterpick_pop_main").animate({
				top: "75px",
			}, 250, function(){});
		}
		else
		{
			$(".counterpick_pop2").toggle(250);
			$(".counterpick_pop_main2").animate({
				top: "75px",
			}, 250, function(){});		
		}
	});
	
	$(".weak_add_pick").click(function()
	{
		currentVoteMode = 2;
		if (isLoggedIn)
		{	
			$(".counterpick_pop_title").html("Add another weak pick:");
			$(".counterpick_pop").toggle(250);
			$(".counterpick_pop_main").animate({
				top: "75px",
			}, 250, function(){});
		}
		else
		{
			$(".counterpick_pop2").toggle(250);
			$(".counterpick_pop_main2").animate({
				top: "75px",
			}, 250, function(){});		
		}		
	});

	$(".good_add_pick").click(function()
	{
		currentVoteMode	= 3;
		if (isLoggedIn)
		{		
			$(".counterpick_pop_title").html("Add another good partner:");
			$(".counterpick_pop").toggle(250);
			$(".counterpick_pop_main").animate({
				top: "75px",
			}, 250, function(){});
		}
		else
		{
			$(".counterpick_pop2").toggle(250);
			$(".counterpick_pop_main2").animate({
				top: "75px",
			}, 250, function(){});		
		}		
	});
	
	$(".counterpick_pop_close").click(function()
	{
		$(".counterpick_pop_main").animate({
			top: "0px",
		}, 250, function(){});	
		$(".counterpick_pop").toggle(250);
	});	
	
	$(".counterpick_pop_close2").click(function()
	{
		$(".counterpick_pop_main2").animate({
			top: "0px",
		}, 250, function(){});	
		$(".counterpick_pop2").toggle(250);
	});	
	
	$(".counterpick_pop_confirm").click(function()
	{
		currentShaper = $(".pop_current_shaper").val();
		if (currentVoteMode == 1)
		{
			Vote(currentShaper,1,"strongpick.php");
		}
		else if (currentVoteMode == 2)
		{
			Vote(currentShaper,1,"weakpick.php");
		}
		else if (currentVoteMode == 3)
		{
			Vote(currentShaper,1,"goodpick.php");
		}
		
		$(".counterpick_pop_main").animate({
			top: "0px",
		}, 250, function(){});	
		$(".counterpick_pop").toggle(250);		
	});
	
	$(".strongbu").click(function()
	{
		if (isLoggedIn)
		{	
			var voteTarget = $(this).data('target');
			var voteTotal = $(this).data('vote');
			var used = $(this).data('used');
			
			if (used == false)
			{
				Vote(voteTarget,1,"strongpick.php");
				
				var htmlString = '<i class="icon-thumbs-up"></i> ' + (voteTotal + 1);
				$(this).html(htmlString);
				$(this).data('used', 'true');
			}
		}
		else
		{
			$(".counterpick_pop2").toggle(250);
			$(".counterpick_pop_main2").animate({
				top: "75px",
			}, 250, function(){});		
		}			
	});
	
	$(".strongbd").click(function()
	{
		if (isLoggedIn)
		{	
			var voteTarget = $(this).data('target');
			var voteTotal = $(this).data('vote');
			var used = $(this).data('used');
			
			if (used == false)
			{
				Vote(voteTarget,0,"strongpick.php");
				
				var htmlString = '<i class="icon-thumbs-down"></i> ' + (voteTotal + 1);
				$(this).html(htmlString);
				$(this).data('used', 'true');
			}
		}
		else
		{
			$(".counterpick_pop2").toggle(250);
			$(".counterpick_pop_main2").animate({
				top: "75px",
			}, 250, function(){});		
		}			
	});
	
	$(".weakbu").click(function()
	{
		if (isLoggedIn)
		{
			var voteTarget = $(this).data('target');
			var voteTotal = $(this).data('vote');
			var used = $(this).data('used');
			
			if (used == false)
			{
				Vote(voteTarget,1,"weakpick.php");
				
				var htmlString = '<i class="icon-thumbs-up"></i> ' + (voteTotal + 1);
				$(this).html(htmlString);
				$(this).data('used', 'true');
			}
		}
		else
		{
			$(".counterpick_pop2").toggle(250);
			$(".counterpick_pop_main2").animate({
				top: "75px",
			}, 250, function(){});		
		}			
	});
	
	$(".weakbd").click(function()
	{
		if (isLoggedIn)
		{	
			var voteTarget = $(this).data('target');
			var voteTotal = $(this).data('vote');
			var used = $(this).data('used');
			
			if (used == false)
			{
				Vote(voteTarget,0,"weakpick.php");
				
				var htmlString = '<i class="icon-thumbs-down"></i> ' + (voteTotal + 1);
				$(this).html(htmlString);
				$(this).data('used', 'true');
			}
		}
		else
		{
			$(".counterpick_pop2").toggle(250);
			$(".counterpick_pop_main2").animate({
				top: "75px",
			}, 250, function(){});		
		}			
	});	
	
	$(".goodbu").click(function()
	{
		if (isLoggedIn)
		{	
			var voteTarget = $(this).data('target');
			var voteTotal = $(this).data('vote');
			var used = $(this).data('used');
			
			if (used == false)
			{
				Vote(voteTarget,1,"goodpick.php");
				
				var htmlString = '<i class="icon-thumbs-up"></i> ' + (voteTotal + 1);
				$(this).html(htmlString);
				$(this).data('used', 'true');
			}
		}
		else
		{
			$(".counterpick_pop2").toggle(250);
			$(".counterpick_pop_main2").animate({
				top: "75px",
			}, 250, function(){});		
		}			
	});
	
	$(".goodbd").click(function()
	{
		if (isLoggedIn)
		{	
			var voteTarget = $(this).data('target');
			var voteTotal = $(this).data('vote');
			var used = $(this).data('used');
			
			if (used == false)
			{
				Vote(voteTarget,0,"goodpick.php");
				
				var htmlString = '<i class="icon-thumbs-down"></i> ' + (voteTotal + 1);
				$(this).html(htmlString);
				$(this).data('used', 'true');
			}
		}
		else
		{
			$(".counterpick_pop2").toggle(250);
			$(".counterpick_pop_main2").animate({
				top: "75px",
			}, 250, function(){});		
		}			
	});		
});
