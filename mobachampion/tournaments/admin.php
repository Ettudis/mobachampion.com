<?php
include('../header.php');
?>


<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Tournament Admin</div></div></div>
<div class="news_content">


<div class="article_news">

<?php
if ($user_info['is_admin'])
{
	echo '<h1>Create Tournament</p>';
	echo '<label for="1">Challonge URL</label>';
	echo '<input class="tournament_admin_url" type="shaper" name="guidetitle" id="1"/>';
	
	echo '<label for="2">Tournament Name</label>';
	echo '<input class="tournament_admin_name" type="shaper" name="guidetitle" id="2"/>';
	
	echo '<label for="3">Date & Time</label>';
	echo '<input class="tournament_admin_date" type="shaper" name="guidetitle" id="3"/>';
	
	echo '<label for="4">Checkin (Hours)</label>';
	echo '<input class="tournament_admin_checkin" type="shaper" name="guidetitle" id="4"/>';
		
	echo '<label for="6">Rules</label>';
	echo '<textarea class="tournament_admin_grules" type="shaper" name="guidetitle" id="6"></textarea>';

	echo '<label for="7">Format (i.e. 2v2)</label>';
	echo '<textarea class="tournament_admin_gformat" type="shaper" name="guidetitle" id="7"></textarea>';

	echo '<label for="8">Max Teams (i.e. 32)</label>';
	echo '<textarea class="tournament_admin_gmaxteams" type="shaper" name="guidetitle" id="8"></textarea>';

	echo '<label for="9">IRC Channel (i.e. #battleinbotlane)</label>';
	echo '<textarea class="tournament_admin_girc" type="shaper" name="guidetitle" id="9"></textarea>';	
	
	echo '<button type="button" class="tournament_create">Submit</button>';
	
	echo '<script>';
	echo '
	function CreateTournament()
	{	
		var url = "createtournament.php";
		
		var gurl = $(".tournament_admin_url").val();
		var gname = $(".tournament_admin_name").val();
		var gdate = $(".tournament_admin_date").val();
		var gcheckin = $(".tournament_admin_checkin").val();
		var gblurb = "";
		var grules = $(".tournament_admin_grules").val();
		var gformat = $(".tournament_admin_gformat").val();
		var gmaxteams = $(".tournament_admin_gmaxteams").val();
		var girc = $(".tournament_admin_girc").val();
		
		$.post(url,
		{ 
            gurl : gurl,
			gname : gname,
			gdate : gdate,
			gcheckin : gcheckin,
			gblurb : gblurb,
			grules : grules,
			gformat : gformat,
			gmaxteams : gmaxteams,
			girc : girc
		},
		function(data) 
		{		
			location.reload();
		});
	}
	
	
	$(document).ready(function() 
	{
		$(".tournament_create").click(function()
		{
			CreateTournament();
		});	
	});
		';
			
	echo '</script>';
}

?>
	
</div>
</div>

</div></div>

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
