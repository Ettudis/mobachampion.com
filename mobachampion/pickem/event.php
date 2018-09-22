<?php
$moba_champ_title = 'Pick\'Em - MOBA-Champion.com';
$moba_champ_desc = 'eSports and Living Lore Predictions';
$msCommunity = true;
$msPickem = true;
include('../header.php');
?>

<script type="text/javascript" src="http://www.moba-champion.com/pickem/r08.js?v=7"></script>
<script type="text/javascript" src="http://www.moba-champion.com/pickem/r16.js?v=7"></script>

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/pickem/">Pickem</a></div></div></div>
<div class="news_content">

<?php

function GetFormatStr($fmt)
{
	if ($fmt == "r08simple")
	{
		return "Round of 8 Tournament";
	}
	else if ($fmt = "r16simple")
	{
		return "Round of 16 Tournament";
	}
	
	return "Unknown";
}

function GetAvailablePts($fmt)
{
	if ($fmt == "r08simple")
	{
		return 8;
	}
	else if ($fmt = "r16simple")
	{
		return 16;
	}
	
	return 0;
}

function CreateR08Matchup($mnum, $pickemmatchup)
{
	$matchup = explode(",", $pickemmatchup);
	echo '<div class="r08versus" style="float:left;margin-left: 32px; margin-bottom: 16px; width:200px;height:80px;border:1px solid black;background:#2c2c2c;">';
				
		$mid = (2*$mnum) + 1;
		$mid2 = (2*$mnum) + 2;
		echo '<div class="r08option">';
		echo '<div class="r08team tid' . $mid . '">' . $matchup[0] . '</div>';
		echo '<div class="r08selector mid' . $mid . '" data-mid="'. $mid . '" data-team="' . $matchup[0] . '"></div>';
		echo '</div>';
	
		echo '<div class="r08option">';
		echo '<div class="r08team tid' . $mid2 . '">' . $matchup[1] . '</div>';
		echo '<div class="r08selector mid' . $mid2 . '" data-mid="'. $mid2 . '" data-team="' . $matchup[1] . '"></div>';
		echo '</div>';
			
	echo '</div>';
}

function CreateR16Matchup($mnum, $pickemmatchup)
{
	$matchup = explode(",", $pickemmatchup);
	echo '<div class="r16versus" style="float:left;margin-left: 32px; margin-bottom: 16px; width:153px;height:80px;border:1px solid black;background:#2c2c2c;">';
				
		$mid = (2*$mnum) + 1;
		$mid2 = (2*$mnum) + 2;
		echo '<div class="r16option">';
		echo '<div class="r16team tid' . $mid . '">' . $matchup[0] . '</div>';
		echo '<div class="r16selector mid' . $mid . '" data-mid="'. $mid . '" data-team="' . $matchup[0] . '"></div>';
		echo '</div>';
	
		echo '<div class="r16option">';
		echo '<div class="r16team tid' . $mid2 . '">' . $matchup[1] . '</div>';
		echo '<div class="r16selector mid' . $mid2 . '" data-mid="'. $mid2 . '" data-team="' . $matchup[1] . '"></div>';
		echo '</div>';
			
	echo '</div>';
}

	$id = $_GET['id'];
	$picksid = $_GET['picksId'];
	$viewOthers = false;
	$otherPerson = "";
	$thePicks = "";
	
	if (is_numeric($id))
	{
		$pickem = R::load('pickem', $id);
		
		$pickBean = null;
		if (is_null($picksid) || !is_numeric($picksid))
		{
			if ($context['user']['is_logged'])
			{
				// ONLY LOAD THE ONE WITH YOUR ID ON IT
				// http://redbeanphp.com/manual3_0/finding_beans
				$pickBean = R::findOne('pick',
						' name = :name AND pickem_id = :pickem_id', 
							array( 
								':name' => $context['user']['name'], 
								':pickem_id' => $id 
							)
						);
				$picksid = $pickBean->id;
			}
		}
		
		if (is_numeric($picksid))
		{
			$pickBean = R::load('pick', $picksid);
			$thePicks = $pickBean->picks;
			
			if (is_null($pickBean) && $context['user']['is_logged'])
			{
				$pickBean = R::findOne('pick',' name = ? ', array( $context['user']['name'] ));
			}
			
			if (!is_null($pickBean))
			{
				$picksid = $pickBean->id;
			}
			
			echo '<script>';
			echo 'var picksId = '. $picksid .';' . PHP_EOL;
			echo 'var pickemId = '. $id .';' . PHP_EOL;
			
			if (is_null($pickBean))
			{
				echo 'var editingEnabled = true;';
			}
			else if ($context['user']['is_logged'])
			{
				if ($pickBean->name == $context['user']['name'])
				{
					echo 'var editingEnabled = true;' . PHP_EOL;
				}
				else
				{
					echo 'var editingEnabled = false;' . PHP_EOL;
					$viewOthers = true;
					$otherPerson = $pickBean->name;
				}
			}
			else if ($pickBean->id > 0)
			{
				echo 'var editingEnabled = false;' . PHP_EOL;
				$viewOthers = true;
				$otherPerson = $pickBean->name;
			}
			else
			{
				echo 'var editingEnabled = false;' . PHP_EOL;
			}
			
			echo 'var prepicks = "'. $thePicks .'";'. PHP_EOL;
			
			echo '</script>';
		}
		else
		{
			echo '<script>';
			echo 'var picksId = -1;' . PHP_EOL;
			echo 'var pickemId = '. $id .';' . PHP_EOL;
			echo 'var editingEnabled = true;' . PHP_EOL;
			echo 'var prepicks = "";'. PHP_EOL;
			echo '</script>';
		}
		
		echo '<script>';
		if ($context['user']['is_logged'])
		{
			echo 'var loggedIn = true;' . PHP_EOL;
		}
		else
		{
			echo 'var loggedIn = false;' . PHP_EOL;
		}
		echo '</script>';
		
		if (is_null($pickem) || $pickem->id == 0)
		{
			echo '<p>Invalid Pick\'em id. You may have reached this page in error. Click <a href="http://www.moba-champion.com/pickem/">here</a> to return home!</p>';
		}
		else
		{
			$availablePts = GetAvailablePts($pickem->format);
			$fmtStr = GetFormatStr($pickem->format);
			$closedStr = ($pickem->open == 1) ? "Open" : "Closed";
			
			echo '<script>var closedResults = "' . $pickem->results . '";</script>' . PHP_EOL;

			// todo: load from pts
			$points = 0;
			
			echo '<img src="' . $pickem->banner . '" style="margin-bottom:16px;">';
			echo '<div style="float:left;width:500px;">';
			echo '<div style="font-size:24px;font-weight:bold;line-height: 32px;">' . $pickem->name . '</div>';
			echo '<B>Date:</B> ' . date('Y-m-d', (($pickem->utcfinal)-14400));
			echo '<BR><B>Format:</B> ' . $fmtStr;
			echo '<BR><B>Event Status:</b> ' . $closedStr;
			echo '</div>';
			
			echo '<div style="float:right;width:200px;text-align:right;">';
			echo '<div style="font-weight:bold;font-size:18px;line-height:42px;">Points</div>';
			echo '<div id="pickem_pts_tracker" style="font-weight:bold;font-size:36px;">'. $points . ' / ' . $availablePts . '</div>';
			echo '</div>';
			
			echo '<script>';
			echo 'var pickemformat = "' . $pickem->format . '"';
			echo '</script>';
			
			if ($pickem->open == 0)
			{
				echo '<script>';
				echo 'editingEnabled = false;' . PHP_EOL;
				echo '</script>';
			}
				
			if ($pickem->format == "r08simple")
			{
				$mnum = 0;
				
				echo '<div class="r08simple_bracket" style="float:left;width=800px;height:460px;border:1px solid black;margin-top:8px;background:#1e1e1e;background-image: url(\'bracket.png\');">';
				
				echo '<div class="r08header" style="float:left;width=800px;">';
					echo '<div class="r08simple_smheader" style="margin-top:16px;margin-bottom:16px;text-align:center;float:left;width:266px;font-size:20px;font-weight=bold;">Quarterfinals</div>';
					echo '<div class="r08simple_smheader" style="margin-top:16px;margin-bottom:16px;text-align:center;float:left;width:266px;font-size:20px;font-weight=bold;">Semifinals</div>';
					echo '<div class="r08simple_smheader" style="margin-top:16px;margin-bottom:16px;text-align:center;float:left;width:266px;font-size:20px;font-weight=bold;">Finals</div>';
				echo '</div>';
				
				echo '<div class="r08simple_quarterfinals" style="float:left;width:266px;">';
					CreateR08Matchup($mnum++,$pickem->pickem1);
					CreateR08Matchup($mnum++,$pickem->pickem2);
					CreateR08Matchup($mnum++,$pickem->pickem3);
					CreateR08Matchup($mnum++,$pickem->pickem4);
				echo '</div>';
				
				echo '<div class="r08simple_semifinals" style="float:left;width:266px;">';
					// filloer
					echo '<div class="r08simple_filler" style="float:left;width:266px;height:64px;"></div>';
					CreateR08Matchup($mnum++,",");
					echo '<div class="r08simple_filler" style="float:left;width:266px;height:64px;"></div>';
					CreateR08Matchup($mnum++,",");
				echo '</div>';
				
				echo '<div class="r08simple_finals" style="float:left;width:266px;">';
					echo '<div class="r08simple_filler" style="float:left;width:266px;height:64px;"></div>';
					echo '<div class="r08simple_smheader" style="margin-top:16px;margin-bottom:16px;text-align:center;float:left;width:266px;font-size:16px;font-weight=bold;">Final Match</div>';
					CreateR08Matchup($mnum++,",");
					echo '<div class="r08simple_smheader" style="margin-top:16px;margin-bottom:16px;text-align:center;float:left;width:266px;font-size:16px;font-weight=bold;">3rd Place Match</div>';
					CreateR08Matchup($mnum++,",");
				echo '</div>';
				
				echo '</div>';
				
				echo '<div style="float:left;width:825px;height:25px;margin-top:16px;margin-bottom:16px;">';
						if ($viewOthers)
						{
							echo '<p>You are viewing the Pick\'em of ' . $otherPerson . '. Click <a href="http://www.moba-champion.com/pickem/">here</a> to create your own!</p>';
						}
						else if ($context['user']['is_logged'])
						{
							echo '<div style="float:left;width:100px;height:25px;">';
							echo '<button type="button" id="pickem_submit" class="btn" style="display:none;">Save</button>';
						    echo '</div>';
						}
						else
						{
							echo '<p>You must be logged in to create a Pick\'em</p>';
						}
					
					echo '<div id="pickem_errors" style="margin-top:8px;"></div>';
				echo '</div>';
			}
			else if ($pickem->format == "r16simple")
			{
				$mnum = 0;
				
				echo '<div class="r16simple_bracket" style="float:left;width=800px;height:840px;border:1px solid black;margin-top:8px;background:#1e1e1e;background-image: url(\'bracket16.png\');">';
				
				echo '<div class="r16header" style="float:left;width=800px;">';
					echo '<div class="r08simple_smheader" style="margin-top:16px;margin-bottom:16px;text-align:center;float:left;width:192px;font-size:20px;font-weight=bold;">Round of 16</div>';
					echo '<div class="r08simple_smheader" style="margin-top:16px;margin-bottom:16px;text-align:center;float:left;width:192px;font-size:20px;font-weight=bold;">Round of 8</div>';
					echo '<div class="r08simple_smheader" style="margin-top:16px;margin-bottom:16px;text-align:center;float:left;width:192px;font-size:20px;font-weight=bold;">Semifinals</div>';
					echo '<div class="r08simple_smheader" style="margin-top:16px;margin-bottom:16px;text-align:center;float:left;width:192px;font-size:20px;font-weight=bold;">Finals</div>';
				echo '</div>';
				
				echo '<div class="r08simple_quarterfinals" style="float:left;width:192px;">';
					CreateR16Matchup($mnum++,$pickem->pickem1);
					CreateR16Matchup($mnum++,$pickem->pickem2);
					CreateR16Matchup($mnum++,$pickem->pickem3);
					CreateR16Matchup($mnum++,$pickem->pickem4);
					CreateR16Matchup($mnum++,$pickem->pickem5);
					CreateR16Matchup($mnum++,$pickem->pickem6);
					CreateR16Matchup($mnum++,$pickem->pickem7);
					CreateR16Matchup($mnum++,$pickem->pickem8);
				echo '</div>';
				
				echo '<div class="r08simple_quarterfinals" style="float:left;width:192px;">';
					// filloer
					echo '<div class="r08simple_filler" style="float:left;width:192px;height:70px;"></div>';
					CreateR16Matchup($mnum++,",");
					echo '<div class="r08simple_filler" style="float:left;width:192px;height:70px;"></div>';
					CreateR16Matchup($mnum++,",");
					echo '<div class="r08simple_filler" style="float:left;width:192px;height:110px;"></div>';
					CreateR16Matchup($mnum++,",");
					echo '<div class="r08simple_filler" style="float:left;width:192px;height:90px;"></div>';
					CreateR16Matchup($mnum++,",");
				echo '</div>';
				
				echo '<div class="r08simple_semifinals" style="float:left;width:192px;">';
					echo '<div class="r08simple_filler" style="float:left;width:192px;height:150px;"></div>';
					CreateR16Matchup($mnum++,",");
					echo '<div class="r08simple_filler" style="float:left;width:192px;height:300px;"></div>';
					CreateR16Matchup($mnum++,",");
				echo '</div>';
				
				echo '<div class="r08simple_finals" style="float:left;width:192px;">';					
					echo '<div class="r08simple_filler" style="float:left;width:192px;height:290px;"></div>';
					echo '<div class="r08simple_smheader" style="margin-top:16px;margin-bottom:16px;text-align:center;float:left;width:192px;font-size:16px;font-weight=bold;">Final Match</div>';
					CreateR16Matchup($mnum++,",");
					echo '<div class="r08simple_filler" style="float:left;width:192px;height:170px;"></div>';
					echo '<div class="r08simple_smheader" style="margin-top:16px;margin-bottom:16px;text-align:center;float:left;width:192px;font-size:16px;font-weight=bold;">3rd Place Match</div>';
					CreateR16Matchup($mnum++,",");
				echo '</div>';
				
				echo '</div>';
				
				echo '<div style="float:left;width:825px;height:25px;margin-top:16px;margin-bottom:16px;">';
						if ($viewOthers)
						{
							echo '<p>You are viewing the Pick\'em of ' . $otherPerson . '. Click <a href="http://www.moba-champion.com/pickem/">here</a> to create your own!</p>';
						}
						else if ($context['user']['is_logged'])
						{
							echo '<div style="float:left;width:100px;height:25px;">';
							echo '<button type="button" id="pickem_submit" class="btn" style="display:none;">Save</button>';
						    echo '</div>';
						}
						else
						{
							echo '<p>You must be logged in to create a Pick\'em</p>';
						}
					
					echo '<div id="pickem_errors" style="margin-top:8px;"></div>';
				echo '</div>';
			}
		}
	}
	else
	{
		echo '<p>Invalid Pick\'em id. You may have reached this page in error. Click <a href="http://www.moba-champion.com/pickem/">here</a> to return to home!</p>';
	}
	
?>

</div> <!-- news_content -->

<?php
	include('../widgets/adwidget2.php');
?>

</div></div>

<div class="article_column2">
<?php 
include('../widgets/tournamentwidget.php');
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
