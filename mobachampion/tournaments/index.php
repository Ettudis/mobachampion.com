<?php
$msTournaments = true;
include('../header.php');
?>


<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Tournaments</div></div></div>
<div class="news_content">


<div class="article_news">

<?php
	$tournamentSQL = 'SELECT * FROM tournament';
	$tournamentRows = R::getAll($tournamentSQL);
	$tournaments = R::convertToBeans('tournament',$tournamentRows);	
	
	$tournyCount = 0;
	
	echo '<h3>MOBA-Champion Tournaments</h3>';
	foreach($tournaments as $tournament)
	{
		if ($tournament->open == 1 && $tournament->grules == 'bib')
		{
			$tournyCount++;
			$numTeams = R::count('tournyteams',' tournamentid = ?',array($tournament->id));	
			$tournament->maxteams = $tournament->gmaxteams;
			
			echo '<div class="tournament_list">';
			echo '<div class="tourny_left">';
			echo '<div class="tournament_list_name">';
				echo '<a href="http://www.moba-champion.com/tournaments/event.php?id=' . $tournament->id . '">' . $tournament->gname . '</a>';
			echo '</div>';
			echo '<div class="tournament_list_date">';
			echo '<B>Date:</b> ' . $tournament->gdate;
			echo '<BR><B>Format:</b> ' . $tournament->gformat;
			echo '<BR><B>Teams:</b> ' . $numTeams . ' / ' . $tournament->maxteams . ' registered.';
			echo '</div>';
			echo '<div class="tournament_list_blurb">' . $tournament->gblurb . '</div>';
			echo '</div>';
			echo '<div class="tourny_right"><a href="http://www.moba-champion.com/tournaments/event.php?id=' . $tournament->id . '"><img src="http://i.imgur.com/5Er8eeI.png"></a></div>';
			echo '</div>';
		}
	}
	
	if ($tournyCount == 0)
	{
		echo '<p>No MOBA-Champion tournaments are currently running. Check back soon!</p>';
	}
	
	echo '<h3>Community Tournaments</h3>';
	$openTournyCount = 0;
	foreach($tournaments as $tournament)
	{
		if ($tournament->open == 1 && $tournament->grules == 's1cknote')
		{
			$openTournyCount++;
			$numTeams = R::count('tournyteams',' tournamentid = ?',array($tournament->id));	
			
			echo '<div class="tournament_list">';
			echo '<div class="tourny_left">';
			echo '<div class="tournament_list_name">';
				echo '<a href="http://www.moba-champion.com/tournaments/event.php?id=' . $tournament->id . '">' . $tournament->gname . '</a>';
			echo '</div>';
			echo '<div class="tournament_list_date">';
			echo '<B>Date:</b> ' . $tournament->gdate;
			echo '<BR><B>Format:</b> ' . $tournament->gformat;
			echo '<BR><B>Teams:</b> ' . $numTeams . ' / ' . $tournament->gmaxteams . ' registered.';
			echo '</div>';
			echo '<div class="tournament_list_blurb">' . $tournament->gblurb . '</div>';
			echo '</div>';
			echo '<div class="tourny_right"><a href="http://www.moba-champion.com/tournaments/event.php?id=' . $tournament->id . '"><img src="http://www.moba-champion.com/tournaments/5v5test.png"></a></div>';
			echo '</div>';
		}
		else if ($tournament->open == 1 && $tournament->grules == "jake")
		{
			$openTournyCount++;
			$numTeams = R::count('tournyteams',' tournamentid = ?',array($tournament->id));	
			
			echo '<div class="tournament_list">';
			echo '<div class="tourny_left">';
			echo '<div class="tournament_list_name">';
				echo '<a href="http://www.moba-champion.com/tournaments/event.php?id=' . $tournament->id . '">' . $tournament->gname . '</a>';
			echo '</div>';
			echo '<div class="tournament_list_date">';
			echo '<B>Date:</b> ' . $tournament->gdate;
			echo '<BR><B>Format:</b> ' . $tournament->gformat;
			echo '<BR><B>Teams:</b> ' . $numTeams . ' / ' . $tournament->gmaxteams . ' registered.';
			echo '</div>';
			echo '<div class="tournament_list_blurb">' . $tournament->gblurb . '</div>';
			echo '</div>';
			echo '<div class="tourny_right"><a href="http://www.moba-champion.com/tournaments/event.php?id=' . $tournament->id . '"><img src="http://www.moba-champion.com/tournaments/1v1test.png"></a></div>';
			echo '</div>';
		}
	}
	
	if ($tournyCount == 0)
	{
		echo '<p>No community tournaments are currently running. Check back soon!</p>';
	}
	
	echo '<h3>Past Tournaments</h3>';
	$tournamentsReversed = array_reverse($tournaments);
	foreach($tournamentsReversed as $tournament)
	{
		if ($tournament->open == 0)
		{
			$tournyCount++;
			$numTeams = R::count('tournyteams',' tournamentid = ?',array($tournament->id));	
			$tournament->maxteams = $tournament->gmaxteams;
			
			echo '<div class="tournament_list_small">';
			echo '<div class="tourny_left">';
			echo '<div class="tournament_list_name">';
				echo '<a href="http://www.moba-champion.com/tournaments/event.php?id=' . $tournament->id . '">' . $tournament->gname . '</a>';
			echo '</div>';
			echo '<div class="tournament_list_date">';
			echo '<B>Date:</b> ' . $tournament->gdate;
			echo '<BR><B>Format:</b> ' . $tournament->gformat;
			echo '<BR><B>Teams:</b> ' . $numTeams . ' / ' . $tournament->maxteams . ' registered.';
			echo '</div>';
			echo '<div class="tournament_list_blurb">' . $tournament->gblurb . '</div>';
			echo '</div>';
			echo '</div>';
		}
	}	
	
	if ($tournyCount == 0)
	{
		echo '<p>No tournaments are pending at this time.</p>';
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
