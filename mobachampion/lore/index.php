<?php
$moba_champ_title = 'Lore - Dawngate - MOBA-Champion.com';
$moba_champ_desc = 'An interactive timeline of the Lore from Dawngate';
$msLore = true;
$msLoreMain = true;
include('../header.php');
?>


<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Lore</div></div></div>
<div class="news_content">

<h2 style="color:#FFBF00;text-align:center">Lore Introduction</h2>
<iframe style="padding-left: 125px;" width="560" height="315" src="//www.youtube.com/embed/ILSYNwqe71w" frameborder="0" allowfullscreen></iframe>

<?php
	$loreData = file_get_contents('../data/loredata.json');
	$loreDataJSON = json_decode($loreData);
	$i = 0;
	
	echo '<h2 style="color:#FFBF00;text-align:center">Playable Shapers</h2>';
	foreach ($loreDataJSON as $lore)
	{
		if ($lore->type != "shaper")
		{
			continue;
		}
		
		echo '<div>';
		echo '<h5 style="color:#FFB726"><img src="http://www.moba-champion.com/images/shapers/' . strtolower($lore->name) . '.png" style="width:32px;height:32px;"> ' . $lore->name;
		if ($lore->title != "")
		{
			echo ', ' . $lore->title;
		}
		echo '</h5>';
		echo '<p>'. $lore->lore .'</p>';
		echo '</div>';
	}
	
	echo '<h2 style="color:#FFBF00;text-align:center">Characters</h2>';
	foreach ($loreDataJSON as $lore)
	{
		if ($lore->type != "character")
		{
			continue;
		}
		
		echo '<div>';
		echo '<h5 style="color:#FFB726"><img src="http://www.moba-champion.com/images/shapers/' . strtolower($lore->name) . '.png" style="width:32px;height:32px;"> ' . $lore->name;
		if ($lore->title != "")
		{
			echo ', ' . $lore->title;
		}
		echo '</h5>';
		echo '<p>'. $lore->lore .'</p>';
		echo '</div>';
	}
	
	echo '<h2 style="color:#FFBF00;text-align:center">Regions</h2>';
	foreach ($loreDataJSON as $lore)
	{
		if ($lore->type != "region")
		{
			continue;
		}
		
		echo '<div>';
		if ($lore->override != "")
		{
			echo '<h5 style="color:#FFB726">' . $lore->override;
		}
		else
		{
			echo '<h5 style="color:#FFB726">' . $lore->name;
		}
		
		if ($lore->title != "")
		{
			echo ', ' . $lore->title;
		}
		echo '</h5>';
		echo '<p>'. $lore->lore .'</p>';
		if ($lore->quote != "")
		{
			echo '<p><i>' . $lore->quote . '</i></p>';
		}
		echo '</div>';
	}
	
	echo '<h2 style="color:#FFBF00;text-align:center">Factions</h2>';
	foreach ($loreDataJSON as $lore)
	{
		if ($lore->type != "faction")
		{
			continue;
		}
		
		echo '<div>';
		echo '<h5 style="color:#FFB726">' . $lore->name;
		if ($lore->title != "")
		{
			echo ', ' . $lore->title;
		}
		echo '</h5>';
		echo '<p>'. $lore->lore .'</p>';
		echo '</div>';
	}
	
	echo '<h2 style="color:#FFBF00;text-align:center">Other</h2>';
	foreach ($loreDataJSON as $lore)
	{
		if ($lore->type != "")
		{
			continue;
		}
		
		echo '<div>';
		echo '<h5 style="color:#FFB726">' . $lore->name;
		if ($lore->title != "")
		{
			echo ', ' . $lore->title;
		}
		echo '</h5>';
		echo '<p>'. $lore->lore .'</p>';
		echo '</div>';
	}
?>

</div>

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
