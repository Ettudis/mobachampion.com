<?php
$moba_champ_chat = true;
$msTournaments = true;
include('../header.php');
?>


<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<?php
	$id = $_GET['id'];
	$tournament = R::findOne('tournament', ' id = ? ',array($id));
	
	$melee = false;
	if ($id == 12)
	{
		$melee = true;
	}
	
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
		if ($melee == true)
		{
			echo '<div class="news_post">
			
			<div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/tournaments">Tournaments</a> | ' . $tournament->gname . ' - Melee ONLY</div></div></div>
			<div class="news_content">
			<div class="article_news">';
		}
		else
		{
			echo '<div class="news_post">
			
			<div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/tournaments">Tournaments</a> | ' . $tournament->gname . '</div></div></div>
			<div class="news_content">
			<div class="article_news">';
		}
		
		$numTeams = R::count('tournyteams',' tournamentid = ?',array($tournament->id));	
		
echo '  <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>';
  
		echo '
<div id="tabs">
  <ul class="tournament_tab_area">
    <li class="tournament_tab"><a href="#tabs-1">Info</a></li>
	<li class="tournament_tab"><a href="#tabs-2">Registration</a></li>
	<li class="tournament_tab"><a href="#tabs-3">Bracket</a></li>
    <li class="tournament_tab"><a href="#tabs-4">Rules</a></li>
    <li class="tournament_tab"><a href="#tabs-5">Chat</a></li>
  </ul>
  
  <div class="tournament_page">
  <div id="tabs-1">';

		if ($tournament->grules == 'bib')
		{
			echo '<img src="http://i.imgur.com/e6CKI7d.jpg">';
		}
		else if ($tournament->id == 19)
		{
			echo '<img src="http://i.imgur.com/XRERgaI.png">';
		}
		else if ($tournament->id == 23)
		{
			echo '<img src="http://i.imgur.com/nzQMlnw.jpg">';
		}
		else if ($tournament->grules == 'jake')
		{
			echo '<img src="http://i.imgur.com/wNr4kz9.jpg">';
		}
		else if ($tournament->id == 28)
		{
			echo '<img src="http://i.imgur.com/uKrB8yd.png">';
		}
		
		echo '<h3>Date and Time</h3>';
		
		echo '<div class="tournament_list_noborder">';
		echo '<div class="tournament_list_date">';
		echo '<B>Date:</B> ' . $tournament->gdate;
		echo '<BR><B>Time:</B> ' . $tournament->gtime;
		echo '<BR><B>Format:</b> ' . $tournament->gformat;
        
        if ($numTeams > $tournament->gmaxteams)
        {
        	echo '<BR><B>Teams:</b> ' . $tournament->gmaxteams . ' / ' . $tournament->gmaxteams . ' registered.';        
        }
        else
        {
            echo '<BR><B>Teams:</b> ' . $numTeams . ' / ' . $tournament->gmaxteams . ' registered.';
        }
    
		echo '</div>';
		echo '<div class="tournament_list_blurb">' . $tournament->gblurb . '</div>';
		echo '</div>';
		
		echo '<p>Enter the Chat when the tournament begins.</p>';
		
		echo '<h3>Prizes</h3>';
		echo '<ul>';
		if ($tournament->prize1 != "")
		{
			echo '<li><B>First Place:</B> ' . $tournament->prize1 . '</li>';
		}
		if ($tournament->prize2 != "")
		{
			echo '<li><B>Second Place:</B> ' . $tournament->prize2 . '</li>';
		}
		if ($tournament->prize3 != "")
		{
			echo '<li><B>Third Place:</B> ' . $tournament->prize3 . '</li>';
		}
		echo '</ul>';
		
		echo '<h3>Admins</h3>';
		$admins = explode(",", $tournament->admins);
		if (count($admins) > 0)
		{
			echo '<ul>';
			foreach($admins as $admin)
			{
				echo '<li>' . $admin . '</li>';
			}
			echo '</ul>';
		}
		
		if ($tournament->grules == 'bib')
		{
			
		}
		else if ($tournament->id == 17)
		{
			echo '<img src="http://i.imgur.com/zU3IEAG.png" style="margin-left: 150px;">';
		}
		
		
  echo '</div>
  <div id="tabs-2">';

  echo '<h3>Registration</h3>';
		
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
							
				$regisText = "";
				$checkinText = "";
				$regButtonText = "";
				$checkinButtonText = "";
				
				if ($tournament->open == 1)
				{
					if (!is_null($myentrant))
					{
						$curTime = time();
						$tournamentTime = $tournament->gtimestamp;
						$secondsUntil = $tournamentTime - $curTime;
						$checkinTime = $secondsUntil - ($tournament->gcheckin*60*60);
						
						$regisText = '<p>Please ensure your entire team roster is listed on your Team\'s page.</p>';
						$regButtonText = '<button class="btn tourny_exit" type="button">Withdraw from Tournament</button></a>';
						
						if ($checkinTime < 0)
						{
							if ($myentrant->checkedin != 1)
							{
								$checkinButtonText = ' <button class="btn tourny_checkin" type="button">Checkin to Tournament</button></a>';
							}
						}
						else
						{
							$minutes = $checkinTime / 60;
							$hours = $minutes / 60;							
							$displayDays = floor($hours / 24);
							$displayHours = floor($hours % 24);
							$displayMinutes = floor($minutes % 60);
							
							if ($displayDays > 0)
							{
								$checkinText = '<p>Tournament checkin begins in ' . $displayDays . ' days, ' . $displayHours . ' hours and ' . $displayMinutes . ' minutes.</p>';
							}
							else if ($displayHours > 0)
							{
								$checkinText = '<p>Tournament checkin begins in ' . $displayHours . ' hours and ' . $displayMinutes . ' minutes.</p>';
							}
							else if ($displayMinutes > 0)
							{
								$checkinText = '<p>Tournament checkin begins in ' . $displayMinutes . ' minutes.</p>';
							}
						}
					}
					else
					{
						$curTime = time();
						$tournamentTime = $tournament->gtimestamp;
						$secondsUntil = $tournamentTime - $curTime;
						$checkinTime = $secondsUntil - ($tournament->gcheckin*60*60);
						
                        if ($numTeams >= ($tournament->gmaxteams + 8))
                        {
                            $regisText = '<p>Registration has closed. All slots are full.</p>';
                        }
						else if ($secondsUntil < 0)
						{
							$regisText = '<p>Registration has closed.</p>';
						}
						else
						{
							$minutes = $secondsUntil / 60;
							$hours = $minutes / 60;							
							$displayDays = floor($hours / 24);
							$displayHours = floor($hours % 24);
							$displayMinutes = floor($minutes % 60);
							
							if ($displayDays > 0)
							{
								$regisText = '<p>Tournament registration ends in ' . $displayDays . ' days, ' . $displayHours . ' hours and ' . $displayMinutes . ' minutes.</p>';
							}
							else if ($displayHours > 0)
							{
								$regisText = '<p>Tournament registration ends in ' . $displayHours . ' hours and ' . $displayMinutes . ' minutes.</p>';
							}
							else if ($displayMinutes > 0)
							{
								$regisText = '<p>Tournament registration ends in ' . $displayMinutes . ' minutes.</p>';
							}
							
							$numMembers = R::count('member',' teamid = :teamid', array(':teamid'=>$team->id));
							$reqMembers = $tournament->minteamsize;
							if ($numMembers < $reqMembers)
							{
								$regisText = '<p>A minimum of ' . $reqMembers . ' team members is required to enter the tournament.</p>';
							}
							else
							{
								if ($numTeams >= $tournament->gmaxteams)
								{
									$regButtonText = '<button class="btn tourny_enter" type="button">Enter Waiting List</button></a>';
								}
								else
								{
									$regButtonText = '<button class="btn tourny_enter" type="button">Enter Tournament</button></a>';
								}
							}
						}
						
						if ($checkinTime > 0)
						{
							$minutes = $checkinTime / 60;
							$hours = $minutes / 60;							
							$displayDays = floor($hours / 24);
							$displayHours = floor($hours % 24);
							$displayMinutes = floor($minutes % 60);
							
							if ($displayDays > 0)
							{
								$checkinText = '<p>Tournament checkin begins in ' . $displayDays . ' days, ' . $displayHours . ' hours and ' . $displayMinutes . ' minutes.</p>';
							}
							else if ($displayHours > 0)
							{
								$checkinText = '<p>Tournament checkin begins in ' . $displayHours . ' hours and ' . $displayMinutes . ' minutes.</p>';
							}
							else if ($displayMinutes > 0)
							{
								$checkinText = '<p>Tournament checkin begins in ' . $displayMinutes . ' minutes.</p>';
							}
						}
						else
						{
							
						}
					}
				}
				else
				{
					$regisText = '<p>Registration has closed.</p>';
				}
				
				echo $regisText;
				echo $checkinText;
				echo $regButtonText;
				echo $checkinButtonText;
			
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
				
				function CheckinTournament()
				{	
					var url = "checkintournamentaction.php";
					
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
					
					$(".tourny_checkin").click(function()
					{
						CheckinTournament();
					});
				});				
			  </script>';		
			}
			else
			{
				echo '<p>Only a team captain can enter a tournament. Please <a href="http://www.moba-champion.com/tournaments/teams.php">Create a Team</a> or have your team captain register for the event.</p>';
			}
		}
		else
		{
			echo '<p>Tournaments are only open to Registered users. Please <a href="http://moba-champion.com/forum/index.php?action=login">login</a> or <a href="http://moba-champion.com/forum/index.php?action=register">register</a>.</p>';
		}
		
		echo '<h3>Registered Teams</h3>';
  
		$entrants = R::find('tournyteams',' tournamentid = ? ', array( $tournament->id ) );
		$countTeams = 0;
		foreach($entrants as $entrant)
		{
			$countTeams++;
			$theteam = R::load('team', $entrant->teamid);
			echo '<p>';
			echo '<a href="http://www.moba-champion.com/tournaments/team.php?id=' . $theteam->id . '">' . $theteam->gname . '</a> (Captain: ' . $theteam->captain . ')';
			if ($entrant->checkedin)
			{
				echo ' <i class="fa fa-check"></i>';
			}
			
			echo '</p>';
            
            if ($countTeams == $tournament->gmaxteams)
            {
                echo '<h3>The Waiting List</h3>';
                echo '<p>The following teams entered after the tournament was "full" and will fill the slots of any no-shows after the start of the event.</p>';
            }
		}
		
		if ($countTeams == 0)
		{
			echo '<p>No teams have registered for this event.</p>';
		}
		
  echo '</div>
  <div id="tabs-3">';
  
	if ($tournament->grules == 's1cknote' && $tournament->id == 19)
	{
		echo '<p>Brackets hosted externally: Please see the <a href="http://www.reddit.com/r/dawngate/comments/27k3x1/s1cknote_invitational_4_rules_reminders_bracket/">reddit thread</a> for a link to the bracket!</p>';
	}
	else
	{
		echo '<p>Tournament bracket provided by <a href="' . $tournament->gurl . '">Challonge.com</a>';
		echo '<iframe src="' . $tournament->gurl . '/module" width="790px" height="500" frameborder="1" allowtransparency="true"></iframe>';  
	}
	
  echo '</div>
  <div id="tabs-4">';

if ($tournament->grules == 'bib')
	{
	  echo '<h5>Game Type:</h5>
	<ol>
	<li>Games will be played <B>2v2</B> in the <B>Bot Lane Only</B></li>
	<li><B>Two Ban per Team</B> which is to be made clear in the Game Lobby before Shaper Select<BR>Picking a banned shaper will result in disqualification</li>
	<li>Blind Pick with Duplicate Shapers<BR>These picks do not need to be made clear to the other team in the game lobby.</li>
	<li><B>NEW:</B> Higher team seed plays Mortal (Left / Bot) side and bans first. Teams alternate both sides and bans in BO3 Matches</li>
	</ol>
	<h5>Win Conditions:</h5>
	<p>There are multiple win conditions for this tournament and are as listed below.</p>
	<p>You will only need to accomplish one (1) of these three (3) conditions before your opponent to win the round.</p>
	<ol>
	<li>Reach a total of two (2) kills.</li>
	<li>Have a combined total of 100 last-hits between you and your partner.</li>
	<li>Destroy the first enemy binding.</li>
	</ol>';

	if ($melee == true)
	{
		echo '<h5>Melee ONLY Rules</h5>
				<ol>
				<li>Only melee characters can be picked.</li>
				<li>Faris is banned as he starts as a Ranged Character at Level 1</li>
				</ol>';
	}

	echo '<h5>In Game Rules:</h5>
	<ol>
	<li>No Attacking / Killing Jungle Camps (Including Money Pigs, Parasite, and Spirit Well Workers)</li>
	<li>No Capturing of Spirit Wells</li>
	<li>Do not leave the allowed area <a href="http://i.imgur.com/QxXivRh.jpg">here is a map picture of all allowed areas</a> or <a href="http://i.imgur.com/HSevcDe.jpg">Colorblind Version</a></li>
	<li>Use of both wards is allowed</li>
	<li>All Items are allowed</li>
	<li>All Shapers are allowed.</li>
	<li>Returning to Base by walking or recalling is allowed.</li>
	</ol>
	<h5>Registration Details:</h5>
	<ul>
	<li>Registration Closes at 5:25pm PST / 8:25pm EST</li>
	<li>Matches can begin at 5:30pm PST / 8:30pm EST</li>
	<li>No Shows Disqualified at 5:45pm PST / 8:45pm EST</li>
	</ul>
	<h5>Bracket Format</h5>
	<ul>
	<li>Quarter-Finals and Below: Best of One</li> 
	<li>Semi-Finals: Best of Three</li>
	<li>Finals: Best of Three</li>
	</ul>
	<h5>Tournament Setup</h5>
	<ul>
	<li>Matches will be coordinated on the Shout Box tab on this page.</li>
	<li>Matches will be created in the Custom Game Lobby</li>
	<li>Each Team will tell the other team, **Two (2) Bans** in the lobby before the game starts.
			<ul>
			<li>Each team will have 2 bans for a total of 4 bans.</li>
			<li>If I type Ban Dibs and you type Ban Raina these shapers will be banned for both teams. </li>
			<li>So if Team 1 bans Dibs they cannot pick Dibs and you cannot pick Dibs. </li>
			<li>Higher team seed plays Mortal (Left / Bot) side and bans first. Teams alternate both sides and bans in BO3 Matches</li>
			<li>When both teams understand the bans and are ready you can start the game.</li></ul></li>
	<li>Shaper Select will be blind pick with <B>duplicate shapers allowed</B>, <B>picking a banned shaper will result in disqualification</B>.</li>
	<li>In game both teams will go bot and play until a win condition is satisfied.</li>
	<li>When a team has <B>won the game take a screenshot</B> with the scoreboard open or of the destroyed binding.</li>
	<li>All players will quit the match upon a team?s victory. The game will end upon all players leaving or exiting their client. (Screenshots will help to settle any false reports.) </li>
	<li>Report the winner of the match to a Tournament Admin in IRC.</li>
	<li>As the bracket updates <B>continue to play games until finals</B> at which point Twerp and BestDibsNA will <B>cast all rounds of the semi-finals and finals</B>.
	</ul>
	<h5>Disconnect, Remake, Substitute, and Name Policies</h5>
	<ul>
	<li>Each team is allowed (1) remake</li>
	<li>Must call for remake before 2:30 ingame. Remakes are allowed after 2:30 if your opponent allows it.</li>
	<li>Remade games must use the same shapers on both sides.</li>
	<li>Substitute players are not allowed, however you may change your roster until the event begins.</li>
	<li>We ask that you please play under your regular In-Game-Name and as well that you do not change names or accounts during the event.</li>
	<li>Please register for the event under the same name you use ingame.</li>
	<li>Offensive ingame and team names will be disqualified at the discretion of the tournament staff. Keep it clean!</li>
	</ul>
	';
}
else if ($tournament->grules == 's1cknote')
{
	echo '<h5>Tournament Format</h5>';
	echo '<ul><li>The format for the tournament is double elimination.</li>';
	echo '<li>The format for the tournament is once again being reworked. We will be using group stages initially there will be two groups with bo1 between all other teams in the group and the top two teams from each group will be placed into the bracket. The bracket this time around will be reduced to single elimination and will also include a 3rd place match. All bracket games will be a bo3.</li>';
	echo '<li>Shaper picks are unique per game: once picked, a shaper is not eligible to be picked by the opposing team.</li>';
	echo '<li>All match results must be posted to the tournament admins.</li>';
	echo '</ul>';
	
	echo '<h5>Picks and Bans</h5>';
	echo '<p>Picks and bans are to be done in the pre-game lobby. The team that is listed first on the bracket starts as the Mortal side,
		   and then it alternates every game</p>';
	echo '<ul>';
	echo '<li>Team A BANS 1 Shaper</li>';
	echo '<li>Team B BANS 1 Shaper</li>';
	echo '<li>Team A Picks 1 Shaper</li>';
	echo '<li>Team B Picks 2 Shapers</li>';
	echo '<li>Team A Picks 1 Shaper</li>';
	echo '<li>Team B BANS 1 Shaper</li>';
	echo '<li>Team A BANS 1 Shaper/li>';
	echo '<li>Team B Picks 1 Shaper/li>';
	echo '<li>Team A Picks 2 Shapers</li>';
	echo '<li>Team B Picks 1 Shaper</li>';
	echo '<li>Team A Picks 1 Shaper</li>';
	echo '<li>Team B Picks 1 Shaper</li>';
	echo '</ul>';
}
else if ($tournament->grules == 'jake')
{
	echo '<h3>Win Conditions:</h3>
		<ul>
			<li>First to 100 minions</li>
			<li>First to Kill Tower</li>
			<li>First to Kill the other player once (1 death means you lose)</li>
		</ul>
		<h3>Rules</h3>
		<p>There are no bans, and you may play whoever you want. I have already heard some great ideas that people are going to use.
			When your game is over, and if there is not a Ref in the custom game with you, please take and submit a screenshot of the game. Honesty matters</p>';
}

  echo '</div>
    <div id="tabs-5">
		
        <iframe src="http://webchat.quakenet.org/?channels=' . $tournament->girc . '" width="790" height="500"></iframe>

		';
echo '</div></div></div>';
		
		
		echo '</div></div>';
		echo '</div>';
				include('../widgets/adwidget2.php'); 
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
