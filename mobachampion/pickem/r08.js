(function($) {
    $.fn.goTo = function() {
        $('html, body').animate({
            scrollTop: $(this).offset().top + 'px'
        }, 'fast');
        return this; // for chaining...
    }
})(jQuery);

function SetQuestion(sel)
{
	var html = $(sel).html();
	if (html != '<i class="fa fa-times"></i>')
	{
		$(sel).html('<i class="fa fa-question"></i>');
	}
}
					
$(document).ready(function() 
{
	if (pickemformat != "r08simple")
		return;
		
	var brackets = prepicks.split(",");
	var finalbrackets = closedResults.split(",");
	if (brackets.length == 18)
	{
		$(".tid1").html(brackets[0]);
		$(".tid2").html(brackets[1]);
		$(".tid3").html(brackets[2]);
		$(".tid4").html(brackets[3]);
		$(".tid5").html(brackets[4]);
		$(".tid6").html(brackets[5]);
		$(".tid7").html(brackets[6]);
		$(".tid8").html(brackets[7]);
		$(".tid9").html(brackets[8]);
		$(".tid10").html(brackets[9]);
		$(".tid11").html(brackets[10]);
		$(".tid12").html(brackets[11]);
		$(".tid13").html(brackets[12]);
		$(".tid14").html(brackets[13]);
		$(".tid15").html(brackets[14]);
		$(".tid16").html(brackets[15]);
		
		$(".mid1").data("team",brackets[0]);
		$(".mid2").data("team",brackets[1]);
		$(".mid3").data("team",brackets[2]);
		$(".mid4").data("team",brackets[3]);
		$(".mid5").data("team",brackets[4]);
		$(".mid6").data("team",brackets[5]);
		$(".mid7").data("team",brackets[6]);
		$(".mid8").data("team",brackets[7]);
		$(".mid9").data("team",brackets[8]);
		$(".mid10").data("team",brackets[9]);
		$(".mid11").data("team",brackets[10]);
		$(".mid12").data("team",brackets[11]);
		$(".mid13").data("team",brackets[12]);
		$(".mid14").data("team",brackets[13]);
		$(".mid15").data("team",brackets[14]);
		$(".mid16").data("team",brackets[15]);
		
		if (brackets[16] == $(".tid13").html())
		{
			$(".mid13").html('<i class="fa fa-check"></i>');
		}
		else
		{
			$(".mid14").html('<i class="fa fa-check"></i>');
		}
										
		if (brackets[17] == $(".tid15").html())
		{
			$(".mid15").html('<i class="fa fa-check"></i>');
		}
		else
		{
			$(".mid16").html('<i class="fa fa-check"></i>');
		}
		
		if ($(".tid9").html() == $(".tid13").html())
		{
			$(".mid9").html('<i class="fa fa-check"></i>');
		}
		else
		{
			$(".mid10").html('<i class="fa fa-check"></i>');
		}
		
		if ($(".tid11").html() == $(".tid14").html())
		{
			$(".mid11").html('<i class="fa fa-check"></i>');
		}
		else
		{
			$(".mid12").html('<i class="fa fa-check"></i>');
		}
		
		if ($(".tid1").html() == $(".tid9").html())
		{
			$(".mid1").html('<i class="fa fa-check"></i>');
		}
		else
		{
			$(".mid2").html('<i class="fa fa-check"></i>');
		}
		
		if ($(".tid3").html() == $(".tid10").html())
		{
			$(".mid3").html('<i class="fa fa-check"></i>');
		}
		else
		{
			$(".mid4").html('<i class="fa fa-check"></i>');
		}
		
		if ($(".tid5").html() == $(".tid11").html())
		{
			$(".mid5").html('<i class="fa fa-check"></i>');
		}
		else
		{
			$(".mid6").html('<i class="fa fa-check"></i>');
		}
		
		if ($(".tid7").html() == $(".tid12").html())
		{
			$(".mid7").html('<i class="fa fa-check"></i>');
		}
		else
		{
			$(".mid8").html('<i class="fa fa-check"></i>');
		}								
	}
	
	if (brackets.length == 18 && finalbrackets.length == 18)
	{
		for (var i = 0; i < brackets.length; i++)
		{
			if (brackets[i] == finalbrackets[i])
			{
			
			}
			else if (finalbrackets[i] != "")
			{
				// Semis 1, clear match 1
				if (i == 8)
				{
					if ($(".mid1").html().length > 0)
						$(".mid1").html('<i class="fa fa-times"></i>');
					else
						$(".mid2").html('<i class="fa fa-times"></i>');
				}
				// Semis 2, clear match 2
				else if (i == 9)
				{
					if ($(".mid3").html().length > 0)
						$(".mid3").html('<i class="fa fa-times"></i>');
					else
						$(".mid4").html('<i class="fa fa-times"></i>');
				}
				// semis 3, clear match 3
				else if (i == 10)
				{
					if ($(".mid5").html().length > 0)
						$(".mid5").html('<i class="fa fa-times"></i>');
					else
						$(".mid6").html('<i class="fa fa-times"></i>');
				}
				// semis 4, clear match 4
				else if (i == 11)
				{
					if ($(".mid7").html().length > 0)
						$(".mid7").html('<i class="fa fa-times"></i>');
					else
						$(".mid8").html('<i class="fa fa-times"></i>');
				}
				// finals 1, clear semis match 1
				else if (i == 12)
				{
					if ($(".mid9").html().length > 0)
						$(".mid9").html('<i class="fa fa-times"></i>');
					else
						$(".mid10").html('<i class="fa fa-times"></i>');
				}
				// finals 2, clear semis match 2
				else if (i == 13)
				{
					if ($(".mid11").html().length > 0)
						$(".mid11").html('<i class="fa fa-times"></i>');
					else
						$(".mid12").html('<i class="fa fa-times"></i>');
				}
				// finals winner, clear finals match
				else if (i == 16)
				{
					if ($(".mid13").html().length > 0)
						$(".mid13").html('<i class="fa fa-times"></i>');
					else
						$(".mid14").html('<i class="fa fa-times"></i>');
				}
				// 3rd place winner, clear something else
				else if (i == 17)
				{
					if ($(".mid15").html().length > 0)
						$(".mid15").html('<i class="fa fa-times"></i>');
					else
						$(".mid16").html('<i class="fa fa-times"></i>');
				}
				
				if (i <= 15 && $(".mid" + (i+1)).html().length > 0)
				{
					console.log("trace3: " + i);
					$(".mid" + (i+1)).html('<i class="fa fa-times"></i>');
				}
			}
			else
			{
				if (i == 12)
				{
					if ($(".mid9").html().length > 0)
						SetQuestion(".mid9");
					else
						SetQuestion(".mid10");
				}
				else if (i == 13)
				{
					if ($(".mid11").html().length > 0)
						SetQuestion(".mid11");
					else
						SetQuestion(".mid12");
				}
				else if (i == 16)
				{
					console.log("trace");
					if ($(".mid13").html().length > 0)
						SetQuestion(".mid13");
					else
						SetQuestion(".mid14");
				}
				else if (i == 17)
				{
					if ($(".mid15").html().length > 0)
						SetQuestion(".mid15");
					else
						SetQuestion(".mid16");
				}
				
				if (i <= 15 && $(".mid" + (i+1)).html().length > 0)
				{
					SetQuestion(".mid" + (i+1));
				}
			}
		}
										
		var pts = 0;
		$(".r08selector").each(function()
		{
			if ($(this).html() == '<i class="fa fa-check"></i>')
			{
				pts++;
			}
		});
		$("#pickem_pts_tracker").html(pts + " / 8");
	}
	
	if (editingEnabled == false)
	{
		for (var i = 1; i < 19; i++)
		{
			var result = $(".mid" + i).html();
			if (result == '<i class="fa fa-check"></i>')
			{
				$(".tid" + i).addClass("pickemHighlight");
				$(".mid" + i).addClass("pickemHighlight");
			}
			else if (result == '<i class="fa fa-times"></i>')
			{
				if (i % 2 == 0)
				{
					$(".tid" + (i)).addClass("pickemHighlight");
					$(".mid" + (i)).addClass("pickemHighlight");
				}
				else
				{
					$(".tid" + (i+1)).addClass("pickemHighlight");
					$(".mid" + (i+1)).addClass("pickemHighlight");
				}
			}
		}
		return;
	}
	
	$(".r08selector").click(function()
	{
		var mid = $(this).data("mid");
		var team = $(this).data("team");
		
		if (mid < 13)
		{
			$(".mid13").html("");
			$(".mid14").html("");
			$(".mid15").html("");
			$(".mid16").html("");
		}
		
		if (mid == "1" || mid == "2")
		{
			$(".mid9").html("");
			$(".mid10").html("");
			
			$(".tid9").html(team);
			$(".mid9").data("team", team);
			
			$(".tid13").html("");
			$(".mid13").html("");
			$(".mid13").data("team", "");
			$(".tid15").html("");
			$(".mid15").html("");
			$(".mid15").data("team", "");
			
			
			$(".mid1").html("");
			$(".mid2").html("");
			$(this).html('<i class="fa fa-check"></i>');
		}
		else if (mid == "3" || mid == "4")
		{		
			$(".mid9").html("");
			$(".mid10").html("");
			
			$(".tid10").html(team);
			$(".mid10").data("team", team);
			
			$(".tid13").html("");
			$(".mid13").html("");
			$(".mid13").data("team", "");
			$(".tid15").html("");
			$(".mid15").html("");
			$(".mid15").data("team", "");
			
			$(".mid3").html("");
			$(".mid4").html("");
			$(this).html('<i class="fa fa-check"></i>');
		}
		else if (mid == "5" || mid == "6")
		{
			$(".mid11").html("");
			$(".mid12").html("");
			
			$(".tid11").html(team);
			$(".mid11").data("team", team);
			
			$(".tid14").html("");
			$(".mid14").html("");
			$(".mid14").data("team", "");
			$(".tid16").html("");
			$(".mid16").html("");
			$(".mid16").data("team", "");
			
			$(".mid5").html("");
			$(".mid6").html("");
			$(this).html('<i class="fa fa-check"></i>');
		}
		else if (mid == "7" || mid == "8")
		{						
			$(".mid11").html("");
			$(".mid12").html("");
			
			$(".tid12").html(team);
			$(".mid12").data("team", team);
			
			$(".tid14").html("");
			$(".mid14").html("");
			$(".mid14").data("team", "");
			$(".tid16").html("");
			$(".mid16").html("");
			$(".mid16").data("team", "");
			
			$(".mid7").html("");
			$(".mid8").html("");
			$(this).html('<i class="fa fa-check"></i>');
		}
		else if (mid == "9")
		{
			var team2 = $(".mid10").data("team");
			if (team.length > 0 && team2.length > 0)
			{
				$(".tid13").html("");							
				$(".mid13").html("");									
				$(".mid13").data("team", "");
				$(".tid13").html(team);
				$(".mid13").data("team", team);
				
				$(".tid15").html(team2);
				$(".mid15").data("team", team2);
				
				$(".mid9").html("");
				$(".mid10").html("");
				$(this).html('<i class="fa fa-check"></i>');
			}
		}
		else if (mid == "10")
		{
			var team2 = $(".mid9").data("team");
			if (team.length > 0 && team2.length > 0)
			{
				$(".tid13").html("");							
				$(".mid13").html("");									
				$(".mid13").data("team", "");
				$(".tid13").html(team);
				$(".mid13").data("team", team);
				
				$(".tid15").html(team2);
				$(".mid15").data("team", team2);
				
				$(".mid9").html("");
				$(".mid10").html("");
				$(this).html('<i class="fa fa-check"></i>');
			}
		}
		else if (mid == "11")
		{
			var team2 = $(".mid12").data("team");
			if (team.length > 0 && team2.length > 0)
			{
				$(".tid14").html("");							
				$(".mid14").html("");									
				$(".mid14").data("team", "");
				$(".tid14").html(team);
				$(".mid14").data("team", team);
				
				$(".tid16").html(team2);
				$(".mid16").data("team", team2);
				
				$(".mid11").html("");
				$(".mid12").html("");
				$(this).html('<i class="fa fa-check"></i>');
			}
		}
		else if (mid == "12")
		{
			var team2 = $(".mid11").data("team");
			if (team.length > 0 && team2.length > 0)
			{
				$(".tid14").html("");							
				$(".mid14").html("");									
				$(".mid14").data("team", "");
				$(".tid14").html(team);
				$(".mid14").data("team", team);
				
				$(".tid16").html(team2);
				$(".mid16").data("team", team2);
				
				$(".mid11").html("");
				$(".mid12").html("");
				$(this).html('<i class="fa fa-check"></i>');
			}
		}
		else if (mid == "13")
		{
			var team2 = $(".mid14").data("team");
			if (team.length > 0 && team2.length > 0)
			{
				$(".mid13").html("");
				$(".mid14").html("");
				$(this).html('<i class="fa fa-check"></i>');
			}
		}
		else if (mid == "14")
		{
			var team2 = $(".mid13").data("team");
			if (team.length > 0 && team2.length > 0)
			{
				$(".mid13").html("");
				$(".mid14").html("");
				$(this).html('<i class="fa fa-check"></i>');
			}
		}
		else if (mid == "15")
		{
			var team2 = $(".mid16").data("team");
			if (team.length > 0 && team2.length > 0)
			{
				$(".mid16").html("");
				$(this).html('<i class="fa fa-check"></i>');
			}
		}
		else if (mid == "16")
		{
			var team2 = $(".mid15").data("team");
			if (team.length > 0 && team2.length > 0)
			{
				$(".mid15").html("");
				$(this).html('<i class="fa fa-check"></i>');
			}
		}
		
		var numChecks = 0;
		$(".r08selector").each(function()
		{
			if ($(this).html().length > 0)
			{
				numChecks++;
			}
		});
		
		if (numChecks == 8)
		{
			$("#pickem_submit").fadeIn();
		}
		else
		{
			$("#pickem_submit").fadeOut();
		}
	});
	
	$("#pickem_submit").click(function()
	{
		var results = "";
		var numChecks = 0;
		$(".r08selector").each(function()
		{
			if ($(this).html().length > 0)
			{
				numChecks++;
			}
		});
		
		$(".r08team").each(function()
		{
			results += $(this).html();
			results += ",";
		});
		
		var winner = "";
		if ($(".mid13").html().length > 0)
		{
			winner = $(".tid13").html();
		}
		else
		{
			winner = $(".tid14").html();
		}
		
		results += winner;
		results += ",";
		
		var thirdwinner = "";
		if ($(".mid15").html().length > 0)
		{
			thirdwinner = $(".tid15").html();
		}
		else
		{
			thirdwinner = $(".tid16").html();
		}
		
		results += thirdwinner;
		
		if (numChecks == 8)
		{
			var url = "savepickem.php";
			
			$.post(url,
			{ 
				pickemId : pickemId,
				picksId : picksId,
				picks : results
			},
			function(data) 
			{		
				var json = jQuery.parseJSON(data);
				if (json.result == false)
				{
					$("#pickem_errors").html("Error: " + json.message);
				}
				else if (json.id > 0)
				{
					window.location.href = "http://www.moba-champion.com/pickem/event.php?id=" + pickemId + "&picksId=" + json.id;
					$("#pickem_errors").html("Saved successfully");
				}
				
				console.log(data);
			});
		}
		else
		{
			$("#pickem_errors").html("Error: The pick'em was not fully filled out.");
		}
	});
	
	var numChecks = 0;
	$(".r08selector").each(function()
	{
		if ($(this).html().length > 0)
		{
			numChecks++;
		}
	});
	
	if (numChecks == 8)
	{
		$("#pickem_submit").fadeIn();
	}
	else
	{
		$("#pickem_submit").fadeOut();
	}
});