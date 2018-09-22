<?php
$moba_champ_title = 'MOBA-Champion - The Orange Tracker';
$moba_champ_desc = 'A list of Waystone Posts on Reddit, Twitter and the Forums';
$msOrangeTracker = true;
$msCommunity = true;
include('../header.php');
?>

<div id="main_container">

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/orangetracker/">Orange Tracker</a> - All Posters</div></div></div>
<div class="news_content">

<div class="article_news">

<?php

	$otdata = 'SELECT * FROM otdata';
	$otdataRows = R::getAll($otdata);
	$otdataBeans = R::convertToBeans('otpost',$otdataRows);
	
	echo '<h4>Reddit</h4>';
	echo '<ul>';
	foreach ($otdataBeans as $otdata)
	{
		if ($otdata->type == "reddit")
		{
			echo '<li><a href="http://www.moba-champion.com/orangetracker/poster.php?id=' . $otdata->poster . '">' . $otdata->poster . '</a></li>';
		}
	}
	echo '</ul>';
	
	echo '<h4>Twitter</h4>';
	foreach ($otdataBeans as $otdata)
	{
		if ($otdata->type == "twitter")
		{
			echo '<li><a href="http://www.moba-champion.com/orangetracker/poster.php?id=' . $otdata->poster . '">@' . $otdata->poster . '</a></li>';
		}
	}
	
	echo '<h4>Forums</h4>';
	echo '<li>Coming Soon!</li>';
	foreach ($otdataBeans as $otdata)
	{
		if ($otdata->type == "forum")
		{
		
		}
	}
	
?>

</div>
</div>

</div>
<?php
include('../widgets/adwidget2.php');
?>
</div>

<div class="article_column2">
<?php 
include('../widgets/shaperwidget.php');
include('../widgets/guidewidget.php');
?>
</div>

</div> <!-- main container -->
</div> <!-- maincontent -->

<?php
include('../footer.php');
?>