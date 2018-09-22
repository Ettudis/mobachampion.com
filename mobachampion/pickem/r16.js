function FullClearElem(el)
{
	$(".tid" + el).html("");
	$(".mid" + el).html("");
	$(".mid" + el).data("team", "");
}

function SoftClearElem(el)
{
	$(".mid" + el).html("");
}

function ClearF1()
{
	FullClearElem("29");
	FullClearElem("31");
}

function ClearF2()
{
	FullClearElem("30");
	FullClearElem("32");
}

function ClearS1(b)
{
	if (b)
	{
		FullClearElem("25");
	}
	else
	{
		SoftClearElem("25");
	}
	ClearF1();
}

function ClearS2(b)
{
	if (b)
	{
		FullClearElem("26");
	}
	else
	{
		SoftClearElem("26");
	}
	ClearF1();
}

function ClearS3(b)
{
	if (b)
	{
		FullClearElem("27");
	}
	else
	{
		SoftClearElem("27");
	}
	ClearF2();
}

function ClearS4(b)
{
	if (b)
	{
		FullClearElem("28");
	}
	else
	{
		SoftClearElem("28");
	}
	ClearF2();
}

function SetTeam(el, team)
{
	FullClearElem(el);
	$(".tid" + el).html(team);
	$(".mid" + el).data("team", team);	
}

function AddUserPicks(start, end, next)
{
	for (var i = 0; i < end; i++)
	{
		var thisTid = (start+(2*i));
		if ($(".tid" + thisTid).html() == $(".tid" + (next+i)).html())
		{
			$(".mid" + thisTid).html('<i class="fa fa-check"></i>');
		}
		else
		{
			$(".mid" + (thisTid + 1)).html('<i class="fa fa-check"></i>');
		}
	}
}

function AddFailPick(left, right, first, second)
{
	if (left == right)
	{
		if ($(".mid" + first).html().length > 0)
			$(".mid" + first).html('<i class="fa fa-times"></i>');
		else
			$(".mid" + second).html('<i class="fa fa-times"></i>');
	}
}

function AddQuestionPick(left, right, first, second)
{
	if (left == right)
	{
		if ($(".mid" + first).html().length > 0)
			$(".mid" + first).html('<i class="fa fa-question"></i>');
		else
			$(".mid" + second).html('<i class="fa fa-question"></i>');
	}
}

var pickInProgress = false;
$(document).ready(function() 
{
	if (pickemformat != "r16simple")
		return;
		
// BEGIN ALREADY PICKS
	// Populate user prepicks
	var brackets = prepicks.split(",");
	var finalbrackets = closedResults.split(",");
	if (brackets.length == 34)
	{
		for (var i = 0; i < 34; i++)
		{
			$(".tid" + (i+1)).html(brackets[i]);
			$(".mid" + (i+1)).data("team",brackets[i]);
		}
		
	// First Place / 3rd Place
		if (brackets[32] == $(".tid29").html())
		{
			$(".mid29").html('<i class="fa fa-check"></i>');
		}
		else
		{
			$(".mid30").html('<i class="fa fa-check"></i>');
		}
										
		if (brackets[33] == $(".tid31").html())
		{
			$(".mid31").html('<i class="fa fa-check"></i>');
		}
		else
		{
			$(".mid32").html('<i class="fa fa-check"></i>');
		}
		
	// CHECK POINTS
		// SF1
		AddUserPicks(25, 2, 29); // ro4
		AddUserPicks(17, 4, 25); // ro8
		AddUserPicks(1, 8, 17); // ro16
	// END CHECK POINTs
	}
	
	if (brackets.length == 34 && finalbrackets.length == 34)
	{
		for (var i = 0; i < brackets.length; i++)
		{
			if (brackets[i] == finalbrackets[i])
			{
			
			}
			else if (finalbrackets[i] != "")
			{
				// Ro8
				AddFailPick(i,16,1,2);
				AddFailPick(i,17,3,4);
				AddFailPick(i,18,5,6);
				AddFailPick(i,19,7,8);
				AddFailPick(i,20,9,10);
				AddFailPick(i,21,11,12);
				AddFailPick(i,22,13,14);
				AddFailPick(i,23,15,16);
				
				// Ro4
				AddFailPick(i,24,17,18);
				AddFailPick(i,25,19,20);
				AddFailPick(i,26,21,22);
				AddFailPick(i,27,23,24);
				
				// Ro2
				AddFailPick(i,28,25,26);
				AddFailPick(i,29,27,28);
				
				// Winner
				AddFailPick(i,32,29,30);
				
				// 3rd
				AddFailPick(i,33,31,32);
			}
			else if (editingEnabled == false)
			{
				// Ro8
				AddQuestionPick(i,16,1,2);
				AddQuestionPick(i,17,3,4);
				AddQuestionPick(i,18,5,6);
				AddQuestionPick(i,19,7,8);
				AddQuestionPick(i,20,9,10);
				AddQuestionPick(i,21,11,12);
				AddQuestionPick(i,22,13,14);
				AddQuestionPick(i,23,15,16);
				
				// Ro4
				AddQuestionPick(i,24,17,18);
				AddQuestionPick(i,25,19,20);
				AddQuestionPick(i,26,21,22);
				AddQuestionPick(i,27,23,24);
				
				// Ro2
				AddQuestionPick(i,28,25,26);
				AddQuestionPick(i,29,27,28);
				
				// Winner
				AddQuestionPick(i,32,29,30);
				
				// 3rd
				AddQuestionPick(i,33,31,32);
			}
		}
		
		if (editingEnabled == false)
		{
			var pts = 0;
			$(".r16selector").each(function()
			{
				if ($(this).html() == '<i class="fa fa-check"></i>')
				{
					pts++;
				}
			});
			$("#pickem_pts_tracker").html(pts + " / 16");
		}
	}
	
// END PRE PICKS

	if (loggedIn == false)
	{
		$(".r16selector").click(function()
		{
			alert("You must be logged in to create a Pick'em");
		});
		return;
	}
	
	// EDITING BELOW
	if (editingEnabled == false)
	{
		if (finalbrackets.length == 34)
		{
			for (var i = 1; i < 33; i++)
			{
				if (finalbrackets[i-1] != "")
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
			}
		}
		
		return;
	}

	$(".r16selector").click(function()
	{
		var mid = $(this).data("mid");
		var team = $(this).data("team");
		
		if (team.length == 0)
		{
			return;
		}
		
		// Any changes to the PRE-Finals should clear the Finals+3rd Place
		if (mid < 29)
		{
			$(".mid29").html("");
			$(".mid30").html("");
			$(".mid31").html("");
			$(".mid32").html("");
		}
		
		// ROUND OF 16
		if (mid == "1" || mid == "2")
		{			
			$(".mid1").html("");
			$(".mid2").html("");
			SetTeam("17",team);
			$(this).html('<i class="fa fa-check"></i>');
			ClearS1(true);
			ClearS2(false);
		}
		else if (mid == "3" || mid == "4")
		{		
			$(".mid3").html("");
			$(".mid4").html("");
			SetTeam("18",team);
			$(this).html('<i class="fa fa-check"></i>');
			ClearS1(true);
			ClearS2(false);
		}
		else if (mid == "5" || mid == "6")
		{
			$(".mid5").html("");
			$(".mid6").html("");
			SetTeam("19",team);
			$(this).html('<i class="fa fa-check"></i>');
			ClearS1(false);
			ClearS2(true);
		}
		else if (mid == "7" || mid == "8")
		{						
			$(".mid7").html("");
			$(".mid8").html("");
			SetTeam("20",team);
			$(this).html('<i class="fa fa-check"></i>');
			ClearS1(false);
			ClearS2(true);
		}
		else if (mid == "9" || mid == "10")
		{			
			$(".mid9").html("");
			$(".mid10").html("");
			SetTeam("21",team);
			$(this).html('<i class="fa fa-check"></i>');
			ClearS3(true);
			ClearS4(false);
		}
		else if (mid == "11" || mid == "12")
		{		
			$(".mid11").html("");
			$(".mid12").html("");
			SetTeam("22",team);
			$(this).html('<i class="fa fa-check"></i>');
			ClearS3(true);
			ClearS4(false);
		}
		else if (mid == "13" || mid == "14")
		{
			$(".mid13").html("");
			$(".mid14").html("");
			SetTeam("23",team);
			$(this).html('<i class="fa fa-check"></i>');
			ClearS3(false);
			ClearS4(true);
		}
		else if (mid == "15" || mid == "16")
		{						
			$(".mid15").html("");
			$(".mid16").html("");
			SetTeam("24",team);
			$(this).html('<i class="fa fa-check"></i>');
			ClearS3(false);
			ClearS4(true);
		}
		
		// ROUND of 8
		if (mid == "17" || mid == "18")
		{
			if ($(".mid17").data("team").length == 0 || $(".mid18").data("team").length == 0)
				return;
				
			ClearS1(true);
			ClearS2(false);
			$(".mid17").html("");
			$(".mid18").html("");
			SetTeam("25",team);
			$(this).html('<i class="fa fa-check"></i>');
		}
		else if (mid == "19" || mid == "20")
		{
			if ($(".mid19").data("team").length == 0 || $(".mid20").data("team").length == 0)
				return;

			ClearS1(false);
			ClearS2(true);
			$(".mid19").html("");
			$(".mid20").html("");
			SetTeam("26",team);
			$(this).html('<i class="fa fa-check"></i>');
		}
		else if (mid == "21" || mid == "22")
		{
			if ($(".mid21").data("team").length == 0 || $(".mid22").data("team").length == 0)
				return;
				
			ClearS3(true);
			ClearS4(false);
			$(".mid21").html("");
			$(".mid22").html("");
			SetTeam("27",team);
			$(this).html('<i class="fa fa-check"></i>');
		}
		else if (mid == "23" || mid == "24")
		{
			if ($(".mid23").data("team").length == 0 || $(".mid24").data("team").length == 0)
				return;
				
			ClearS3(false);
			ClearS4(true);
			$(".mid23").html("");
			$(".mid24").html("");
			SetTeam("28",team);
			$(this).html('<i class="fa fa-check"></i>');
		}
		
		// Round of 4
		else if (mid == "25")
		{
			if ($(".mid25").data("team").length == 0 || $(".mid26").data("team").length == 0)
				return;

			var team2 = $(".mid26").data("team");
			ClearF1();
			$(".mid25").html("");
			$(".mid26").html("");
			SetTeam("29",team);
			SetTeam("31",team2);
			$(this).html('<i class="fa fa-check"></i>');
		}
		else if (mid == "26")
		{
			if ($(".mid25").data("team").length == 0 || $(".mid26").data("team").length == 0)
				return;

			var team2 = $(".mid25").data("team");
			ClearF1();
			$(".mid25").html("");
			$(".mid26").html("");
			SetTeam("29",team);
			SetTeam("31",team2);
			$(this).html('<i class="fa fa-check"></i>');
		}
		else if (mid == "27")
		{
			if ($(".mid27").data("team").length == 0 || $(".mid28").data("team").length == 0)
				return;
				
			var team2 = $(".mid28").data("team");
			ClearF2();
			$(".mid27").html("");
			$(".mid28").html("");
			SetTeam("30",team);
			SetTeam("32",team2);
			$(this).html('<i class="fa fa-check"></i>');
		}
		else if (mid == "28")
		{
			if ($(".mid27").data("team").length == 0 || $(".mid28").data("team").length == 0)
				return;
				
			var team2 = $(".mid27").data("team");
			ClearF2();
			$(".mid27").html("");
			$(".mid28").html("");
			SetTeam("30",team);
			SetTeam("32",team2);
			$(this).html('<i class="fa fa-check"></i>');
		}
		// finals
		else if (mid == "29" || mid == "30")
		{
			if ($(".mid29").data("team").length == 0 || $(".mid30").data("team").length == 0)
				return;

			$(".mid29").html("");
			$(".mid30").html("");
			$(this).html('<i class="fa fa-check"></i>');
		}
		// 3rd place
		else if (mid == "31" || mid == "32")
		{
			if ($(".mid31").data("team").length == 0 || $(".mid32").data("team").length == 0)
				return;
				
			$(".mid31").html("");
			$(".mid32").html("");
			$(this).html('<i class="fa fa-check"></i>');
		}
		
		var numChecks = 0;
		$(".r16selector").each(function()
		{
			if ($(this).html().length > 0)
			{
				numChecks++;
			}
		});
		
		if (numChecks == 16)
		{
			$("#pickem_submit").fadeIn();
			$("#pickem_submit").goTo();
		}
		else
		{
			$("#pickem_submit").fadeOut();
		}
	});
	
	// SUBMIT
	$("#pickem_submit").click(function()
	{
		if (pickInProgress == true)
			return;
			
		pickInProgress = true;
		
		var results = "";
		var numChecks = 0;
		$(".r16selector").each(function()
		{
			if ($(this).html().length > 0)
			{
				numChecks++;
			}
		});
		
		$(".r16team").each(function()
		{
			results += $(this).html();
			results += ",";
		});
		
		var winner = "";
		if ($(".mid29").html().length > 0)
		{
			winner = $(".tid29").html();
		}
		else
		{
			winner = $(".tid30").html();
		}
		
		results += winner;
		results += ",";
		
		var thirdwinner = "";
		if ($(".mid31").html().length > 0)
		{
			thirdwinner = $(".tid31").html();
		}
		else
		{
			thirdwinner = $(".tid32").html();
		}
		
		results += thirdwinner;
		$("#pickem_submit").hide();
		
		if (numChecks == 16)
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
				pickInProgress = false;
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
			pickInProgress = false;
			$("#pickem_errors").html("Error: The pick'em was not fully filled out.");
		}
	});
});