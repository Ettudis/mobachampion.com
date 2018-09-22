<?php
include('../header.php');
?>


<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<?php
	$id = $_GET['id'];
	$tournament = R::findOne('tournament', ' id = ? ',array($id));
	
	if (is_null($tournament))
	{
		echo '<div class="news_post">
			<div class="news_header"><div class="news_header_text"><div class="news_title">Tournaments</div></div></div>
			<div class="news_content">
			<div class="article_news">';
	
		echo '<p>Sorry, but we could not find a tournament that matches the given ID.</p>';
	
		echo '</div></div></div>';
	}
	else
	{
			echo '<div class="news_post">
			<div class="news_header"><div class="news_header_text"><div class="news_title">' . $tournament->gname . '</div></div></div>
			<div class="news_content">
			<div class="article_news">';
		
		$numTeams = R::count('tournyteams',' tournamentid = ?',array($tournament->id));	
		$tournament->maxteams = 16;
		$tournament->gformat = '2v2';
		
		echo '<img src="http://i.imgur.com/5Er8eeI.png">';
		
		echo '<h3>Tournament Info</h3>';		
		
		echo '<div class="tournament_list">';
		echo '<div class="tournament_list_date">';
		echo '<B>Date:</b> ' . $tournament->gdate;
		echo '<BR><B>Format:</b> ' . $tournament->gformat;
		echo '<BR><B>Teams:</b> ' . $numTeams . ' / ' . $tournament->maxteams . ' registered.';
		echo '</div>';
		echo '<div class="tournament_list_blurb">' . $tournament->gblurb . '</div>';
		echo '</div>';
		
		echo '<h3>Registered Teams</h3>';
		
		$entrants = R::find('tournyteams',' tournamentid = ? ', array( $tournament->id ) );
		foreach($entrants as $entrant)
		{
			$theteam = R::load('team', $entrant->teamid);
			echo '<p><a href="http://www.moba-champion.com/tournaments/team.php?id=' . $theteam->id . '">' . $theteam->gname . '</a> (Captain: ' . $theteam->captain . ')</p>';
		}
		
		if ($context['user']['is_logged'])
		{
			$gcaptain  = $context['user']['name'];		
			$isTeamCaptain;
			
			// find team
			$team = R::findOne('team',' captain = ? ',array($gcaptain));
			if (!is_null($team))
			{
				$isTeamCaptain = true;
			}
			
			if ($isTeamCaptain)
			{
				$myentrant = R::findOne('tournyteams',' tournamentid = :tournamentid AND teamid = :teamid  ', array( 
										':tournamentid' => $tournament->id, 
										':teamid' => $team->id 
									));
									
				if ($tournament->open == 1)
				{
					if (!is_null($myentrant))
					{
						echo '<button class="btn tourny_exit" type="button">Withdraw from Tournament</button></a>';
					}
					else
					{
						echo '<button class="btn tourny_enter" type="button">Enter Tournament</button></a>';
					}
				}
			
			echo '<script>
			
				function EnterTournament()
				{	
					var url = "entertournamentaction.php";
					
					var teamid = ' . $team->id . ';
					var tournamentid = ' . $tournament->id . ';
					
					$.post(url,
					{ 
						teamid : teamid,
						tournamentid : tournamentid,
					},
					function(data) 
					{		
						console.log(data);
						location.reload();
					});
				}
				
				function ExitTournament()
				{	
					var url = "exittournamentaction.php";
					
					var teamid = ' . $team->id . ';
					var tournamentid = ' . $tournament->id . ';
					
					$.post(url,
					{ 
						teamid : teamid,
						tournamentid : tournamentid,
					},
					function(data) 
					{		
						location.reload();
					});
				}				
				
				$(document).ready(function() 
				{
					$(".tourny_enter").click(function()
					{
						EnterTournament();
					});
					
					$(".tourny_exit").click(function()
					{
						ExitTournament();
					});			
				});				
			  </script>';		
			}
		}
		
		echo '<h3>Bracket</h3>';
		echo '<p><a href="' . $tournament->gurl . '">Challonge URL</a></p>';
		echo '</div></div></div>';
	}

?>


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
