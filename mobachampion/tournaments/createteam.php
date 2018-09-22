<?php
include('../header.php');
?>


<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header">
	<div class="news_header_text">
		<div class="news_title">Create Team</div>
	</div>
</div>
<div class="news_content">


<div class="article_news">

<?php

echo '<input type="text" class="input-large teamname" placeholder="Team Name..."/>
	  <button type="submit" class="btn createbutton">Create</button>';
echo '<div class="error_results"></div>';
	  
	echo '<script>';
	echo '
	function CreateTeam()
	{	
		var url = "createteamaction.php";
		
		var gname = $(".teamname").val();
		if (gname.length == 0)
		{
			$(".error_results").html("Please specify a team name.");
			return;
		}
		
		$.post(url,
		{ 
			gname : gname,
		},
		function(data) 
		{		
			var results = jQuery.parseJSON(data);
			
			if (results.success == false)
			{
				$(".error_results").html("Create team failed for reason: " + results.message);
			}
			else
			{
				$(".teamname").hide();
				$(".createbutton").hide();
				$(".error_results").html("Team was created successfully. Click <a href=\"http://www.moba-champion.com/tournaments/team.php?id=" + results.returnid + "\">here</a> to visit your team page.");
			}
		});
	}
	
	
	$(document).ready(function() 
	{
		$(".createbutton").click(function()
		{
			CreateTeam();
		});	
	});
		';
			
	echo '</script>';	  
?>
	
</div>
</div>
</div>
</div>

<div class="article_column2">
<?php 
include('../widgets/shaperwidget.php');
include('../widgets/adwidget.php');
include('../widgets/streamwidget.php');
include('../widgets/guidewidget.php');
?>
</div>

</div> <!-- main container -->
</div> <!-- maincontent -->

<?php
include('../footer.php');
?>
