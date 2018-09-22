<?php
$moba_champ_title = 'MOBA-Champion - Item List';
$moba_champ_desc = 'A comprehensive list of items from Dawngate';
include('../header.php');
?>

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<?php
$itemName = $_GET['item'];

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
		  <div class="news_header"><div class="news_header_text"><div class="news_title">' . $itemName . '</div></div></div>
		  <div class="news_content">
		  
		  <div class="article_news">';
		  
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
							echo '<p class="bold_text"><a href="http://www.moba-champion.com/itempalooza/item.php?item='. $item_entry->name .'">' . $item_entry->name . '</a></p>';
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
									echo '<a href="http://www.moba-champion.com/itempalooza/item.php?item=' . $fromItem . '"><img src="http://www.moba-champion.com/images/itempalooza/' . $fromItem . '.png" class="iptip" title="' . $fromItem . '"></a>';
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
									echo '<a href="http://www.moba-champion.com/itempalooza/item.php?item=' . $intoItem . '"><img src="http://www.moba-champion.com/images/itempalooza/' . $intoItem . '.png" class="iptip" title="' . $intoItem . '"></a>';
								}
							echo '</p></div>';
						}	
						
						echo '</div>';
						
					echo '</div>';
				
				// summary				
				echo '<p>' . $item_entry->summary . '</p>';	
				
				// passive1
				if ($item_entry->passive1 != "")
				{
					echo '<p>'. $item_entry->passive1 . '</p>';
				}
				
				// passive2
				if ($item_entry->passive2 != "")
				{
					echo '<p>'. $item_entry->passive2 . '</p>';
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
