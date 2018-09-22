<?php
$moba_champ_title = 'Dawngate Item List - MOBA-Champion.com';
$moba_champ_desc = 'A comprehensive list of items from Dawngate';
include('../header.php');
?>

<script src="itempaloozashop.js"></script> <!-- Including our script -->

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title extra-wide-content">Item Store Simulator</div></div></div>
<div class="news_content">

<div id="item_store">

<div id="store_headers">
<div id="store_header1" class="basic_text">Basic Items</div>
<div id="store_header2" class="advanced_text">Advanced Items</div>
<div id="store_header3" class="legendary_text">Legendary Items</div>
<!--
<div id="store_header4">Current Selection</div>
<div class="store_current_sel"></div>
<div class="store_current_sel_text"></div> -->
</div>

<div id="store_spacer"></div>

<div id="item_store_col1">
	<div class="store_row store_item" id="basic1" data-quality="basic" data-index="1" data-summary="+120 Health, +10 Health Regen per 5 seconds" data-passive1="Stackable Passive - Consume I:<BR>When a nearby enemy dies there is a 33% chance that you will be healed for 3 Health. The amount healed is doubled for melee shapers.">
		<img src="http://www.moba-champion.com/images/itempalooza/Life.png" class="iptip" title="Life">
		<span class="basic_text">Life</span>
		<span>420</span>
	</div>
	<div class="store_space"></div>
	
	<div class="store_row store_item" id="basic2" data-quality="basic" data-index="2" data-summary="+18 Armor" data-passive1="Stackable Passive - Toughness I:<BR>Reduces the damage taken from basic attacks by 3. The reduction is tripled against shapers">
		<img src="http://www.moba-champion.com/images/itempalooza/Resilience.png" class="iptip" title="Resilience">
		<span class="basic_text">Resilience</span>
		<span>380</span>	
	</div>
	<div class="store_space"></div>
	
	<div class="store_row store_item" id="basic3" data-quality="basic" data-index="3" data-summary="+24 Magic Reisstance" data-passive1="Stackable Passive - Void: Reduces any magical damage taken by 10. The reduction is only half as effective against damage over time effects.">
		<img src="http://www.moba-champion.com/images/itempalooza/Will.png" class="iptip" title="Will">
		<span class="basic_text">Will</span>
		<span>350</span>	
	</div>
	<div class="store_space"></div>
	
	<div class="store_row store_item" id="basic4" data-quality="basic" data-index="4" data-summary="+12 Power" data-passive1="">
		<img src="http://www.moba-champion.com/images/itempalooza/Power.png" class="iptip" title="Power">
		<span class="basic_text">Power</span>
		<span>375</span>	
	</div>		
	<div class="store_space"></div>
	
	<div class="store_row store_item" id="basic5" data-quality="basic" data-index="5" data-summary="+20 Haste" data-passive1="">
		<img src="http://www.moba-champion.com/images/itempalooza/Time.png" class="iptip" title="Time">
		<span class="basic_text">Time</span>
		<span>460</span>		
	</div>
	<div class="store_space"></div>
	
	<div class="store_row store_item" id="basic6" data-quality="basic" data-index="6" data-summary="+5 Power" data-passive1="Stackable Passive - Life Leech:<BR>Dealing damage causes you to restore 5 Health. The amount healed is doubled against shapers. This effect has a 0.5 second cooldown.">	
		<img src="http://www.moba-champion.com/images/itempalooza/Hunger.png" class="iptip" title="Hunger">
		<span class="basic_text">Hunger</span>
		<span>420</span>		
	</div>
</div>

<div id="item_store_col2">
	<div class="store_line_row" id="row_gap1">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
	</div>
	<div class="store_line_row" id="row_gap2">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
	<div class="store_line_row" id="row_gap3">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
	<div class="store_line_row" id="row_gap4">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
	<div class="store_line_row" id="row_gap5">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
	<div class="store_line_row" id="row_gap6">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
</div>

<div id="item_store_col3">
	<div class="store_row store_item item_hidden" id="advanced1" data-quality="advanced" data-index="1" >
	
	</div>
	<div class="store_space"></div>
	
	<div class="store_row store_item item_hidden" id="advanced2" data-quality="advanced" data-index="2" >
	
	</div>
	<div class="store_space"></div>
	
	<div class="store_row store_item item_hidden" id="advanced3" data-quality="advanced" data-index="3" >
	
	</div>
	<div class="store_space"></div>
	
	<div class="store_row store_item item_hidden" id="advanced4" data-quality="advanced" data-index="4" >
	
	</div>
	<div class="store_space"></div>
	
	<div class="store_row store_item item_hidden" id="advanced5" data-quality="advanced" data-index="5" >
	
	</div>
	<div class="store_space"></div>
	
	<div class="store_row store_item item_hidden" id="advanced6" data-quality="advanced" data-index="6" >
	
	</div>
</div>

<div id="item_store_col4">
	<div class="store_line_row" id="row_l_gap1">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
	</div>
	<div class="store_line_row" id="row_l_gap2">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
	<div class="store_line_row" id="row_l_gap3">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
	<div class="store_line_row" id="row_l_gap4">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
	<div class="store_line_row" id="row_l_gap5">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
	<div class="store_line_row" id="row_l_gap6">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
</div>


<div id="item_store_col5">
	<div class="store_row store_item item_hidden" id="legendary1" data-quality="legendary" data-index="1" ></div>
	<div class="store_space"></div>
	<div class="store_row store_item item_hidden" id="legendary2" data-quality="legendary" data-index="2" ></div>
	<div class="store_space"></div>
	<div class="store_row store_item item_hidden" id="legendary3" data-quality="legendary" data-index="3" ></div>
	<div class="store_space"></div>
	<div class="store_row store_item item_hidden" id="legendary4" data-quality="legendary" data-index="4" ></div>
	<div class="store_space"></div>
	<div class="store_row store_item item_hidden" id="legendary5" data-quality="legendary" data-index="5" ></div>
	<div class="store_space"></div>
	<div class="store_row store_item item_hidden" id="legendary6" data-quality="legendary" data-index="6" ></div>
</div>

</div> <!-- store -->

</div></div> <!-- news post -->

<?php
include('../widgets/adwidget2.php');
?>

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Itempalooza</div></div></div>
<div class="news_content">

<div class="article_news">

<?php
	$itemData = file_get_contents('../data/itempalooza.json');
	$itemDataJSON = json_decode($itemData);
		
	$num_consumables = 0;
	
	$headersArray = array(
		1 => "Consumables",
		2 => "Basic Items",
		3 => "Advanced Items",
		4 => "Legendary Items",);
		
	$firstItem = true;	
		
	for ($ix = 1; $ix <= 4; $ix++)
	{
		echo '<div class="article_subheader" id="' . $headersArray[$ix] . '"><h3>' . $headersArray[$ix] . '</h3></div>';
		echo '<div class="item_group">';
						
		foreach ($itemDataJSON as $item_entry)
		{
			if ($item_entry->type == $ix)
			{
				echo '<div class="new_ability_row"  id="' . $item_entry->name . '">';
					
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
									echo '<a href="#' . $fromItem . '"><img src="http://www.moba-champion.com/images/itempalooza/' . $fromItem . '.png" class="iptip" title="' . $fromItem . '"></a>';
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
									echo '<a href="#' . $intoItem . '"><img src="http://www.moba-champion.com/images/itempalooza/' . $intoItem . '.png" class="iptip" title="' . $intoItem . '"></a>';
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
					echo '<p>' . $item_entry->passive1 . '</p>';
				}
				
				// passive2
				if ($item_entry->passive2 != "")
				{
					echo '<p>' . $item_entry->passive2 . '</p>';
				}
						
				echo '</div>
					</div>';
					

				$firstItem = false;	
			}
		}
				
		echo '</div>';
	}
	
?>
	
</div>

</div> <!-- news content -->
</div> <!-- news post -->
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
