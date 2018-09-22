<?php
$moba_champ_title = 'MOBA-Champion - Item';
$moba_champ_desc = 'A comprehensive list of items from Dawngate';
$msItems = true;
$msGameInfo = true;
include('../header.php');
?>

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<?php
$itemName = isset($_GET['item']) ? $_GET['item'] : "";

if (is_null($itemName))
{
	echo '<div class="news_post">
		  <div class="news_header"><div class="news_header_text"><div class="news_title">Item Not Found</div></div></div>
		  <div class="news_content">
		  
		  <div class="article_news">';
		  
		  echo '<p>OOPS! It looks like we forgot to specify an item!</p>';
}
else
{
	echo '<div class="news_post">
		  <div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/items/">Item Database</a> > ' . $itemName . '</div></div></div>
		  <div class="news_content">
		  
		  <div class="article_news">';
		  

	function FormatSummary($text)
	{		
		$strExp = explode(":", $text, 2);
		if (count($strExp) == 2)
		{
			$passiveStr = $strExp[0];
			
			if (strpos($passiveStr, 'Stackable') !== FALSE)
			{
				$passiveStr = str_replace("Stackable Passive -", "", $passiveStr);
				$passiveStr = '<span class="misctext">' . $passiveStr . '</span>:';
				$passiveStr = '<span class="passivetext">Stackable Passive</span> - ' . $passiveStr;
			}
			else if (strpos($passiveStr, 'Unique') !== FALSE)
			{
				$passiveStr = str_replace("Unique Passive -", "", $passiveStr);
				$passiveStr = '<span class="misctext">' . $passiveStr . '</span>:';
				$passiveStr = '<span class="passivetext">Unique Passive</span> - ' . $passiveStr;
			}
			
			return $passiveStr . $strExp[1];
		}
		else
		{
			return $text;
		}
	}
	
	function FormatItemText($ix, $text)
	{
		if ($ix == 1)
		{
			$text = str_replace("UNIQUE ACTIVE", '<span class="misctext">UNIQUE ACTIVE</span>', $text);
			$text = str_replace("ACTIVE", '<span class="misctext">ACTIVE</span>', $text);
			$text = str_replace(":", ":<BR>", $text);
			return $text;
		}
		
		$inText = str_replace("+", "", $text);
		$inText = str_replace(", ", ",", $inText);
		
		$outstr = "";
		$stats = explode(",", $inText);
		
		$count = count($stats);
		$i = 0;
		foreach($stats as $stat)
		{
			$outstr .= FormatIndividualText($stat);
			$i++;
			
			if ($i != $count)
			{
				$outstr .= "<BR>";
			}
		}
		
		return $outstr;
	}
	
	function FormatIndividualText($text)
	{
		$textExp = explode(" ", $text, 2);
		if (count($textExp) == 2)
		{
			switch($textExp[1])
			{
				case "Haste":
					return '<span class="hastetext">+' . $textExp[0] . '</span> ' . $textExp[1];
					break;
				case "Power":
					return '<span class="powertext">+' . $textExp[0] . '</span> ' . $textExp[1];
					break;
				case "Health":
					return '<span class="healthtext">+' . $textExp[0] . '</span> ' . $textExp[1];
					break;
				case "Health Regeneration":
					return '<span class="regentext">+' . $textExp[0] . '</span> ' . $textExp[1];
					break;
				case "Armor":
					return '<span class="armortext">+' . $textExp[0] . '</span> ' . $textExp[1];
					break;
				case "Magic Resistance":
					return '<span class="mrtext">+' . $textExp[0] . '</span> ' . $textExp[1];
					break;
				case "Lifedrain":
					return '<span class="lifedraintext">+' . $textExp[0] . '</span> ' . $textExp[1];
					break;
				default:
					return '<span class="misctext">+' . $textExp[0] . '</span> ' . $textExp[1];
			}
		}
		else
		{
			return $text;
		}
	}
	
		$itemData = file_get_contents('../data/itempalooza.json');
		$itemDataJSON = json_decode($itemData);
			
		$num_consumables = 0;
		$itemFound = false;
		
		foreach ($itemDataJSON as $item_entry)
		{
			if ($item_entry->name == $itemName)
			{
				echo '<div class="item_group"><div class="new_ability_row_st">';
				echo '<div class="new_spell_summary_desc">';
				 
				 	// img
					echo '<div class="new_spell_header">';
						echo '<div class="new_spell_header_img">';
							echo '<img src="' . $item_entry->img . '" class="img-rounded iptip" title="' . $item_entry->name . '">';
						echo '</div>';	
						
						echo '<div class="new_spell_header_text">';
							// name					
							echo '<p class="bold_text"><a href="http://www.moba-champion.com/items/item.php?item='. $item_entry->name .'">' . $item_entry->name . '</a></p>';
							// gold
							echo '<p>COST: <font color="gold"><B>' . $item_entry->cost . '</B></font></p>';
						echo '</div>';
						
						// builds from
						if ($item_entry->buildsfrom != "")
						{
							$fromItems = explode(",",$item_entry->buildsfrom);
							echo '<div class="spell_builds"><p>BUILDS FROM ';
								foreach($fromItems as $fromItem)
								{
									echo '<a href="http://www.moba-champion.com/items/item.php?item=' . $fromItem . '"><img src="http://www.moba-champion.com/images/itempalooza/' . $fromItem . '.png" class="iptip" title="' . $fromItem . '"></a>';
								}
							echo '</p></div>';
						}
						
						// builds intro
						echo '<div class="spell_builds_area">';
						if ($item_entry->buildsinto != "")
						{
							$intoItems = explode(",",$item_entry->buildsinto);
							echo '<div class="spell_builds"><p>BUILDS INTO ';
								foreach($intoItems as $intoItem)
								{
									echo '<a href="http://www.moba-champion.com/items/item.php?item=' . $intoItem . '"><img src="http://www.moba-champion.com/images/itempalooza/' . $intoItem . '.png" class="iptip" title="' . $intoItem . '"></a>';
								}
							echo '</p></div>';
						}	
						
						echo '</div>';
						
					echo '</div>';
				
				// summary				
				echo '<p>' . FormatItemText($item_entry->type, $item_entry->summary) . '</p>';	
				
				// passive1
				if ($item_entry->passive1 != "")
				{
					echo '<p>'. FormatSummary($item_entry->passive1) . '</p>';
				}
				
				// passive2
				if ($item_entry->passive2 != "")
				{
					echo '<p>'. FormatSummary($item_entry->passive2) . '</p>';
				}
						
				echo '</div></div></div>';
				$itemFound = true;
			}
		}
		
		if ($itemFound == false)
		{
			echo '<p>Item "' . $itemName . '" could not be found. Did you spell it correctly?</p>';
		}
}

echo '</div>';
	
	$efficiencyData = file_get_contents('efficiency.json');
	$efficiencyDataJSON = json_decode($efficiencyData);
	foreach($efficiencyDataJSON as $eff)
	{
		if ($itemName == $eff->name)
		{
			echo '<h3>Item Efficiency</h3>';
			$wsVim = intval($eff->waystone);
			$wsPVim = (intval($eff->cost) - intval($eff->waystone));
			$statPct = $wsVim / $eff->cost * 100;
			$statPPct = $wsPVim / $eff->cost * 100;
			echo '<p>The base stats of ' . $itemName . ' are worth ' . $wsVim . ' vim. ('. round($statPct,2) .'% of total cost)';
			echo '<p>The passive effects of ' . $itemName . ' are worth ' . $wsPVim . ' vim. ('. round($statPPct,2) .'% of total cost)';
			break;
		}
	}
	
	echo '<h3>Patch History</h3>';

	$shaperNotePath = '../patch/output/' . strtolower($itemName) . '.php';
	if (file_exists($shaperNotePath) && filesize($shaperNotePath) > 0)
	{
		echo '<div class="patchnotes waystone_regtext">';
		include($shaperNotePath);
		echo '</div>';
	}
	else
	{
		echo '<p>This item has not undergone any changes. So balanced!</p>';
	}
?>

</div> <!-- news content -->
</div> <!-- news post -->

<?php 
include('../widgets/adwidget2.php');
?>

</div> <!-- article_content-->

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
