<?php 
require_once('../forum/SSI.php');
?>

<?php
$moba_champ_title = 'Dawngate Tier List - MOBA-Champion.com';
$moba_champ_desc = 'Dawngate Shaper Tier Lists and Score Bards.';
$msSoloQueue = true;
$msTierList = true;
include('../header.php');
?>

<script type="text/javascript" src="http://www.moba-champion.com/js/jquery.tablesorter.js"></script>

	<script type="text/javascript">
	
	var myTextExtraction = function(node)  
	{  
		// extract data from markup and return it  
		console.log(node);
		var returnVal = node.innerHTML;
		if (returnVal.indexOf("+") !== -1)
		{
			returnVal = returnVal.replace("+", 1);
		}
		else if (returnVal.indexOf("-") !== -1)
		{
			returnVal = returnVal.replace("-", 3);
		}		
		else
		{
			returnVal = returnVal + "2";
		}
		
		return returnVal; 
	} 
	
	$(document).ready(function() 
		{ 
			$("#sorttable").tablesorter({textExtraction: myTextExtraction});
			$("#sorttable2").tablesorter({textExtraction: myTextExtraction});
			$("#sorttable3").tablesorter({textExtraction: myTextExtraction});
		} 
	);
	
	$(document).ready(function() 
	{	
		$('.tierlisttip').each(function()
		{
			var customTitle = $(this).attr('title');
			customTitle = '<div class="tier_list_tip">' + customTitle + '</div>';
			$(this).attr('title',customTitle);
			$(this).tooltipster();
		});
	});
	
	</script>	
	
<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Tier List - Kahgen Era</div></div></div>
<div class="news_content">
<p style="text-align: right"><i><b>Last Updated:</b> April 6, 2014</i></p>
<p>We don't believe that the Shapers of Dawngate can be summarized in a simple list. For this reason,
   we've seperated a standard tier list into catagorized lists for each general archtype and the jungle. You 
   can use these lists as a quick overview of the current state of the game. However, I would strongly urge you to play each
   shaper to their strengths and avoid sweeping generalizations. For the statistics behind these choices, please visit our <a href="http://www.dawnscout.com/Statistics">Dawnscout Statistics</a> page.</p>
<?php

	$tierData = file_get_contents('../data/tierlist.json');
	$tierDataJSON = json_decode($tierData);
	
	echo '<div class="tier_list_pretty2">';
	echo '<h3>Jungle Tier List</h3>';
	
	echo '<table class="tier_list_table">';
	echo '<tr><td>Tier 1</td><td>';
	foreach ($tierDataJSON->jungletier->tier1 as $tier)
	{
		echo '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($tier->name) . '.png" class="tierlisttip"  title="' . $tier->reason . '">';
	}		
	echo '</td></tr>';
	echo '<tr><td>Tier 2</td><td>';
	foreach ($tierDataJSON->jungletier->tier2 as $tier)
	{
		echo '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($tier->name) . '.png" class="tierlisttip"  title="' . $tier->reason . '">';
	}			
	echo '</td></tr>';
	echo '<tr><td>Tier 3</td><td>';
	foreach ($tierDataJSON->jungletier->tier3 as $tier)
	{
		echo '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($tier->name) . '.png" class="tierlisttip"  title="' . $tier->reason . '">';
	}	
	echo '</td></tr>';
	echo '<tr><td>Tier 4</td><td>';
	foreach ($tierDataJSON->jungletier->tier4 as $tier)
	{
		echo '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($tier->name) . '.png" class="tierlisttip"  title="' . $tier->reason . '">';
	}	
	echo '</td></tr>';
	echo '<tr><td>Tier 5</td><td>';
	foreach ($tierDataJSON->jungletier->tier5 as $tier)
	{
		echo '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($tier->name) . '.png" class="tierlisttip"  title="' . $tier->reason . '">';
	}		
	echo '</td></tr>';	
    echo '</table>';
	echo '</div>';
	
	echo '<div class="tier_list_pretty2">';
	echo '<h3>Melee (DPS) Tier List</h3>';
	echo '<table class="tier_list_table">';
	echo '<tr><td>Tier 1</td><td>';
	foreach ($tierDataJSON->meleetier->tier1 as $tier)
	{
		echo '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($tier->name) . '.png" class="tierlisttip"  title="' . $tier->reason . '">';
	}		
	echo '</td></tr>';
	echo '<tr><td>Tier 2</td><td>';
	foreach ($tierDataJSON->meleetier->tier2 as $tier)
	{
		echo '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($tier->name) . '.png" class="tierlisttip"  title="' . $tier->reason . '">';
	}			
	echo '</td></tr>';
    echo '</table>';
	echo '</div>';
	
	echo '<div class="tier_list_pretty2">';
	echo '<h3>Melee (Tank) Tier List</h3>';
	echo '<table class="tier_list_table">';
	echo '<tr><td>Tier 1</td><td>';
	foreach ($tierDataJSON->tanktier->tier1 as $tier)
	{
		echo '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($tier->name) . '.png" class="tierlisttip"  title="' . $tier->reason . '">';
	}		
	echo '</td></tr>';
	echo '<tr><td>Tier 2</td><td>';
	foreach ($tierDataJSON->tanktier->tier2 as $tier)
	{
		echo '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($tier->name) . '.png" class="tierlisttip"  title="' . $tier->reason . '">';
	}		
	echo '</td></tr>';
    echo '</table>';
	echo '</div>';
	
	echo '<div class="tier_list_pretty2">';
	echo '<h3>Mage / Assassin Tier List</h3>';
	echo '<table class="tier_list_table">';
	echo '<tr><td>Tier 1</td><td>';
	foreach ($tierDataJSON->magetier->tier1 as $tier)
	{
		echo '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($tier->name) . '.png" class="tierlisttip"  title="' . $tier->reason . '">';
	}		
	echo '</td></tr>';
	echo '<tr><td>Tier 2</td><td>';
	foreach ($tierDataJSON->magetier->tier2 as $tier)
	{
		echo '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($tier->name) . '.png" class="tierlisttip"  title="' . $tier->reason . '">';
	}		
	echo '</td></tr>';
    echo '</table>';
	echo '</div>';
	
	echo '<div class="tier_list_pretty2">';
	echo '<h3>Support Tier List List</h3>';
	echo '<table class="tier_list_table">';
	echo '<tr><td>Tier 1</td><td>';
	foreach ($tierDataJSON->supportier->tier1 as $tier)
	{
		echo '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($tier->name) . '.png" class="tierlisttip"  title="' . $tier->reason . '">';
	}		
	echo '</td></tr>';
	echo '<tr><td>Tier 2</td><td>';
	foreach ($tierDataJSON->supportier->tier2 as $tier)
	{
		echo '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($tier->name) . '.png" class="tierlisttip"  title="' . $tier->reason . '">';
	}		
	echo '</td></tr>';
    echo '</table>';
	echo '</div>';
	
	echo '<div class="tier_list_pretty2">';
	echo '<h3>Ranged Carry Tier List</h3>';
	echo '<table class="tier_list_table">';
	echo '<tr><td>Tier 1</td><td>';
	foreach ($tierDataJSON->carrytier->tier1 as $tier)
	{
		echo '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($tier->name) . '.png" class="tierlisttip"  title="' . $tier->reason . '">';
	}	
	echo '</td></tr>';
	echo '<tr><td>Tier 2</td><td>';
	foreach ($tierDataJSON->carrytier->tier2 as $tier)
	{
		echo '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($tier->name) . '.png" class="tierlisttip"  title="' . $tier->reason . '">';
	}	
	echo '</td></tr>';
    echo '</table>';
	echo '</div>';
?>

</div></div>

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
