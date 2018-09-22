<?php
$moba_champ_title = 'Pick\'Em - MOBA-Champion.com';
$moba_champ_desc = 'eSports and Living Lore Predictions';
$msCommunity = true;
$msPickem = true;
include('../header.php');
?>

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/pickem/">Pick'em</a> > Leaderboard</div></div></div>
<div class="news_content">

<img src="http://www.moba-champion.com/pickem/pickem.png" style="margin-bottom:16px;">

<?php
	$pickemresults = R::findAll('pickresult', ' ORDER BY totalpts DESC, name ASC ');
	
	echo '<table id="pickem_lb" class="tablesorter" style="text-align:center;">';
	echo '<thead>';
	echo '<tr class="pickem_row" style="width:800px;float:left;font-weight:bold;font-size:14px;border:1px solid black;">';
		echo '<th class="pickem_pos_col" style="float:left;width:75px;border-right:1px solid black;">Pos.</td>';
		echo '<th class="pickem_name_col" style="float:left;width:150px;border-right:1px solid black;">Name</td>';
		echo '<th class="pickem_event_col" style="float:left;width:175px;border-right:1px solid black;">Race to the Gate: North</td>';
		echo '<th class="pickem_event_col" style="float:right;width:150px;border-left:1px solid black;">Total Points</td>';
	echo '</tr>';
	echo '</thead>';
	
	$lbindex = 1 ;
	$north = 1;
	foreach ($pickemresults as $pickresult)
	{
		echo '<tr class="pickem_row" style="width:800px;float:left;border:1px solid black;">';
			echo '<td class="pickem_pos_col" style="float:left;width:75px;border-right:1px solid black;">' . $lbindex . '</td>';
			echo '<td class="pickem_name_col" style="float:left;width:150px;border-right:1px solid black;">' . $pickresult->name . '</td>';
			echo '<td class="pickem_event_col" style="float:left;width:175px;border-right:1px solid black;">' . $pickresult->$north . '</td>';
			echo '<td class="pickem_event_col" style="float:right;width:150px;border-left:1px solid black;">' . $pickresult->totalpts . '</td>';
		echo '</tr>';
		
		$lbindex++;
	}
	echo '</table>';
	
?>
	<script type="text/javascript" src="http://www.moba-champion.com/js/jquery.tablesorter.js"></script>
	<script>
	$( document ).ready(function() 
	{
		$("#pickem_lb").tablesorter( {sortList: [[0,0], [1,0]]} );  
	});
	</script>
<BR>
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
