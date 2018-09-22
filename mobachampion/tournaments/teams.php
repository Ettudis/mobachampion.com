<?php
$msTournaments = true;
$msTeams = true;
include('../header.php');
?>


<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Teams</div></div></div>
<div class="news_content">

<div class="article_news">

<?php

if ($context['user']['is_logged'])
{
	$gname = $context['user']['name'];
	
	// is in team?
	$member = R::findOne('member',' name = :name', array(':name'=>$gname) );
	if (is_null($member))
	{
		echo '<h3>My Team</h3>';	
		echo '<p>You are not currently in a team.</p>';
		echo '<a href="http://www.moba-champion.com/tournaments/createteam.php">';
		echo '<button class="btn" type="button">Create a Team</button></a>';
	}
	else
	{
		$team = R::load('team', $member->teamid);
		if (is_null($team))
		{
			echo '<h3>My Team</h3>';		
			echo '<p>Error loading your team details.</p>';
			echo '<a href="http://www.moba-champion.com/tournaments/createteam.php">';
			echo '<button class="btn" type="button">Create a Team</button></a>';			
		}
		else
		{
			echo '<h3>My Team</h3>';			
			echo '<h4><a href="http://www.moba-champion.com/tournaments/team.php?id=' . $member->teamid . '">' . $team->gname . '</a></h4>';
			$members = R::findOne('member',' teamid = ? ',array($member->teamid));
			echo '<p>' . $team->captain . ' (Captain)</p>';
			foreach($members as $mem)
			{
				if ($mem->name != $team->captain)
				{
					echo '<p>' . $mem->name . '</p>';
				}
			}
		}
	}
}
else
{
	echo '<p>Please log in to view your team information.</p>';
}

echo '<h3>Team Search</h3>';
echo '<form class="form-horizontal" action="search.php" metho="get">
		<input type="text" class="input-large" name="team">
		<button type="submit" class="btn">Search</button>
	  </form>';
	  
echo '<h3>Teams A-Z</h3>';

		$filter = 'a';
		if (isset($_GET['filter']))
		{
			$filter = strtolower($_GET['filter']);
		}
		
echo '<div class="tournament_team_list_header">';
			echo '<div class="tt_tlh'; if ($filter == 'a') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=A">A</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'b') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=B">B</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'c') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=C">C</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'd') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=D">D</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'e') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=E">E</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'f') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=F">F</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'g') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=G">G</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'h') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=H">H</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'i') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=I">I</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'j') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=J">J</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'k') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=K">K</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'l') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=L">L</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'm') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=M">M</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'n') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=N">N</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'o') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=O">O</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'p') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=P">P</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'q') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=Q">Q</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'r') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=R">R</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 's') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=S">S</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 't') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=T">T</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'u') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=U">U</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'v') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=V">V</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'w') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=W">W</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'x') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=X">X</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'y') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=Y">Y</a></div>';
			echo '<div class="tt_tlh'; if ($filter == 'z') { echo ' tt_tlh_active'; } echo '"><a href="http://www.moba-champion.com/tournaments/teams.php?filter=Z">Z</a></div>';
		echo '</div>';
		
echo '<div class="tournament_team_list clrfix">';
		
		$tournamentSQL = 'SELECT * FROM team WHERE lcase(team.gname) LIKE \'' . $filter . '%\'';
		$tournamentRows = R::getAll($tournamentSQL);
		$teams = R::convertToBeans('team',$tournamentRows);

		foreach($teams as $team_entry)
		{
			echo '<div class="ttl_teamrow"><a href="http://www.moba-champion.com/tournaments/team.php?id=' . $team_entry->id . '">' . $team_entry->gname . '</a> (Captain: ' . $team_entry->captain . ')</div>';
		}
		
echo '</div>';

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
