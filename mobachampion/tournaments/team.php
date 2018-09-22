<?php
$msTournaments = true;
$msTeams = true;
include('../header.php');
?>


<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<?php

$id = $_GET['id'];
$maxTeamSize = 7;

$gname = "";
if ($context['user']['is_logged'])
{
	$gname = $context['user']['name'];
}	
		
if (is_null($id))
{
	echo '<div class="news_post">
		<div class="news_header"><div class="news_header_text"><div class="news_title">Teams</div></div></div>
		<div class="news_content">

		<div class="article_news">';
	echo '<p>You have not specified a Team Id. Would you like to return to the <a href="http://www.moba-champion.com/teams">teams page</a>.</p>';
}
else
{
	$team = R::load('team', $id);
	if (!$team->id)
	{
		echo '<div class="news_post">
			<div class="news_header"><div class="news_header_text"><div class="news_title">Teams</div></div></div>
			<div class="news_content">

			<div class="article_news">';	
		echo '<h3>Team</h3>';		
		echo '<p>Error loading team details.</p>';
		echo '<a href="http://www.moba-champion.com/tournaments/createteam.php">';
		echo '<button class="btn" type="button">Create a Team</button></a>';			
	}
	else
	{
		echo '<div class="news_post">
			<div class="news_header"><div class="news_header_text"><div class="news_title">' . $team->gname . '</div></div></div>
			<div class="news_content">

			<div class="article_news">';
			
		echo '<h3>Members</h3>';
		$members = R::find('member',' teamid = ? ',array($id));
		echo '<p>' . $team->captain . ' (Captain)</p>';
		
		$isOnTeam = false;
		if ($gname == $team->captain)
		{
			$isOnTeam = true;
		}
		
		foreach($members as $mem)
		{
			if ($mem->sub == 1)
			{
				continue;
			}
			
			if ($mem->name != $team->captain)
			{
				if ($gname == $team->captain)
				{
					echo '<p>' . $mem->name . ' (<a href="#" class="team-tosub" data-name="' . $mem->name . '">Add to Subs</a> / <a href="#" class="team-remove" data-name="' . $mem->name . '">Remove</a>)</p>';
				}
				else
				{
					echo '<p>' . $mem->name . '</p>';
				}
				
				if ($gname == $mem->name)
				{
					$isOnTeam = true;
				}
			}
			
			if ($gname != "")
			{
				if ($mem->name == $gname)
				{
					if ($gname != $team->captain)
					{
						echo '<button type="button" class="team_leave btn">Leave Team</button>';
					}
				}
			}
		}
		
		echo '<h3>Substitutes</h3>';
		$numSubs = 0;
		foreach($members as $mem)
		{
			if ($mem->sub == 0)
			{
				continue;
			}
			
			$numSubs++;
			
			if ($mem->name != $team->captain)
			{
				if ($gname == $team->captain)
				{
					echo '<p>' . $mem->name . ' (<a href="#" class="team-fromsub" data-name="' . $mem->name . '">Add to Members</a> / <a href="#" class="team-remove" data-name="' . $mem->name . '">Remove</a>)</p>';
				}
				else
				{
					echo '<p>' . $mem->name . '</p>';
				}
				
				if ($gname == $mem->name)
				{
					$isOnTeam = true;
				}
			}
			
			if ($gname != "")
			{
				if ($mem->name == $gname)
				{
					if ($gname != $team->captain)
					{
						echo '<button type="button" class="team_leave btn">Leave Team</button>';
					}
				}
			}
		}
		
		if ($numSubs == 0)
		{
			echo '<p>This team does not have any substitute players.</p>';
		}
		
		if ($gname != "")
		{
			$count = R::count('member','name = :name', array(':name'=>$gname) );
			if ($count == 0)
			{
				$application = R::findOne('teamapp',' teamid = :teamid AND name = :name ',array( 
										':teamid' => $id, 
										':name' => $gname 
									));			
				if (!is_null($application))
				{
					echo '<button type="button" class="team_notapply btn">Withdraw Application</button>';
				}
				else if ($isOnTeam == false)
				{
					echo '<button type="button" class="team_apply btn">Apply</button>';
				}
			}
		}
		
		if ($team->desc != "")
		{
			echo '<h3>Roster</h3>';
			echo '<p>' . nl2br($team->desc) . '</p>';
		}
		
		echo '<h3>Tournament History</h3>';
		
		if ($team->id > 0)
		{
			$thistory = R::find('tournyteams',' teamid = ? ', array($team->id ));
			if (count($thistory) > 0)
			{
				echo '<ul>';
				foreach($thistory as $tourny)
				{
					$thisTournament = R::load('tournament', $tourny->tournamentid);
					if ($thisTournament->id > 0)
					{
						echo '<li><a href="http://www.moba-champion.com/tournaments/event.php?id=' . $thisTournament->id . '">' . $thisTournament->gname . '</a></li>';
					}
				}
				echo '</ul>';
			}
			else
			{
				echo '<p>This team has not participated in a tournament.</p>';
			}
		}
		else
		{
			echo '<p>This team has not participated in a tournament.</p>';
		}		
		
		
		if ($gname == $team->captain)
		{
			echo '<h3>Admin</h3>';
			
			echo '<h4>Team Management</h4>';
			echo '<p><a href="#" class="team-disband">Disband Team</a></p>';
			
			echo '<h4>Pending Applications</h4>';
			
			$applications = R::find('teamapp',' teamid = :teamid',array( 
									':teamid' => $id ));
									
			if (empty($applications))
			{
				echo '<p>No pending applications.</p>';
			}
			else
			{
				foreach($applications as $appl)
				{
					echo '
						<p>
						'. $appl->name .'
							(<a href="#" class="team_accept" data-name="' . $appl->name . '">Accept</a> / <a href="#" class="team_deny" data-name="' . $appl->name . '">Deny</a>)
						</p>
					';
				}
			}
			
			echo '<h4>Roster</h4>';
			echo '<div class="team_update_desc"><textarea id="team_desc_text" style="width: 600px; height: 100px;" placeholder="Please enter a team roster if not all members are added to the team. (All on one line)">' . $team->desc . '</textarea></div>';
			echo '<button id="team_update_button">Update</button>';
													
			echo '<script>
			
				function DisbandTeam()
				{	
					var url = "disbandteamaction.php";
					
					var gid = ' . $team->id . ';
					
					$.post(url,
					{ 
						gid : gid,
					},
					function(data) 
					{		
						window.location.href = "http://www.moba-champion.com/tournaments/teams.php";
					});
				}
					
				function AskDisbandTeam()
				{
					var x;
					var r=confirm("Are you sure you want to disband your team?");
					if (r==true)
					{
						DisbandTeam();
					}
					else
					{

					}				
				}					
					
				function RemovePlayer(name)
				{	
					var url = "removeplayeraction.php";
					
					var gid = ' . $team->id . ';
					
					$.post(url,
					{ 
						gid : gid,
						name : name,
					},
					function(data) 
					{		
						location.reload();
					});
				}
							
				function AskRemovePlayer(name)
				{
					var x;
					var r=confirm("Are you sure you want to remove " + name + " from your team.");
					if (r==true)
					{
						RemovePlayer(name);
					}
					else
					{

					}				
				}
				
				function AcceptPlayer(name)
				{	
					var url = "acceptplayeraction.php";
					
					var gid = ' . $team->id . ';
					
					$.post(url,
					{ 
						gid : gid,
						name : name,
					},
					function(data) 
					{		
						location.reload();
					});
				}

				function DenyPlayer(name)
				{	
					var url = "denyplayeraction.php";
					
					var gid = ' . $team->id . ';
					
					$.post(url,
					{ 
						gid : gid,
						name : name,
					},
					function(data) 
					{		
						location.reload();
					});
				}

				function UpdateDesc(desc)
				{
					var url = "updatedescaction.php";
					
					var gid = ' . $team->id . ';
					
					$.post(url,
					{ 
						gid : gid,
						desc : desc,
					},
					function(data) 
					{		
						location.reload();
					});
				}
				
				function UpdateSub(name, sub)
				{
					var url = "updatesub.php";
					var gid = ' . $team->id . ';
					
					$.post(url,
					{ 
						gid : gid,
						name : name,
						sub : sub
					},
					function(data) 
					{		
						location.reload();
					});
				}
								
				$(document).ready(function() 
				{
					$(".team-disband").click(function()
					{
						AskDisbandTeam();
					});
					
					$(".team-remove").click(function()
					{
						var name = $(this).data("name");
						AskRemovePlayer(name);
					});
					
					$(".team-tosub").click(function()
					{
						var name = $(this).data("name");
						UpdateSub(name,1);
					});
					
					$(".team-fromsub").click(function()
					{
						var name = $(this).data("name");
						UpdateSub(name,0);
					});
					
					$(".team_accept").click(function()
					{
						var name = $(this).data("name");
						AcceptPlayer(name);
					});	

					$(".team_deny").click(function()
					{
						var name = $(this).data("name");
						DenyPlayer(name);
					});	
					
					$("#team_update_button").click(function()
					{
						var desc = $("#team_desc_text").val();
						UpdateDesc(desc);
					});
					
				});				
			  </script>';
		}
		else
		{
		
		echo '
			<script>
				function ApplyTeam()
				{	
					var url = "applyteamaction.php";
					
					var gid = ' . $team->id . ';
					
					$.post(url,
					{ 
						gid : gid,
						name : name,
					},
					function(data) 
					{		
						console.log(data);
						location.reload();
					});
				}

				function WithdrawTeam()
				{	
					var url = "notapplyteamaction.php";
					
					var gid = ' . $team->id . ';
					
					$.post(url,
					{ 
						gid : gid,
						name : name,
					},
					function(data) 
					{		
						console.log(data);
						location.reload();
					});
				}
				
				function LeaveTeam()
				{
					var url = "leaveteamaction.php";
					var gid = 0;
					
					$.post(url,
					{ 
						gid : gid,
					},
					function(data) 
					{		
						location.reload();
					});
				}

				$(document).ready(function() 
				{
					$(".team-disband").click(function()
					{
						AskDisbandTeam();
					});
					
					$(".team-remove").click(function()
					{
						var name = $(this).data("name");
						AskRemovePlayer(name);
					});
					
					$(".team_apply").click(function()
					{
						ApplyTeam();
					});
					
					$(".team_notapply").click(function()
					{
						WithdrawTeam();
					});	
					
					
					$(".team_leave").click(function()
					{
						LeaveTeam();
					});	
				});					
			  </script>';
		}
	}
}

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
