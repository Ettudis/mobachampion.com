<?php
include('../header.php');
?>

<script>
<?php
$itemstr = $_GET['i'];
$shapstr = $_GET['s'];
$ldoutstr = $_GET['l'];
echo "var savedItems = \"" . $itemstr . "\";\n";
echo "var savedShaper = \"" . $shapstr . "\";\n";
echo "var savedLoadout = \"" . $ldoutstr . "\";\n";
?>
var savedItemArray = ["","","","","",""];
if (savedItems.length >= 12) {
	for (var i = 0; i<6; i++) {
		savedItemArray[i] = savedItems.substr(i*2,2);
	}
}
</script>

<link rel="stylesheet" type="text/css" href="theorycrafting.css" />
<script type="text/javascript" src="itembuildertest.js"></script>
<script type="text/javascript" src="itempaloozashopbuyable.js"></script>

<script>
	document.title="MOBA-Champion - Morat's Item Builder";
</script>

<div id="main_container">
    <div class="article_content">
        <!-- News Post: Page Content with Orange Header -->
		<div class="news_post" id="instructionPost">
		<div class="news_header_uncollapsed" id="instructionHeader" onclick="toggleVisibility('instruction')"><div class="news_header_text"><div class="news_title">Morat's Item Builder</div></div></div>
		<div class="news_content" id="instructionContent" style="display: block">

		<div class="article_news">
			This tool allows you to try out different in game builds for your shaper and see the resulting stats.
			<br/><br/>
			You can also expand the collapsed sections to enter more advanced information and get more detailed results.
			<br/><br/>
			<i>
			Last Updated: November 25, 2013<br/>
			Reddit: <a href="http://www.reddit.com/user/MightyMorat" target="_blank">/u/MightyMorat</a><br/>
			Twitter: <a href="https://twitter.com/MoratPOG" target="_blank">@MoratPOG</a>
			</i>
		</div>

		</div> <!-- news content -->
		</div> <!-- news post -->		
		
		
        <div class="news_post" id="shaperInfoPost">
            <div class="news_header_uncollapsed" id="shaperInfoHeader" onclick="toggleVisibility('shaperInfo')">
                <div class="news_header_text"><div class="news_title">Shaper Select</div></div>
            </div>
            
            <div class="news_content" id="shaperInfoContent" style="display: block">
				<div class="article_news">
					<table>
						<tr>
							<td>
								<b>Pick a Shaper:</b>
							</td>
							<td>
								&nbsp;<select onChange="doCalculations()" id="shaperMenu">
								</select>
							</td>
							<td>
								<b>&nbsp;&nbsp; Choose your Level:</b>
							</td>
							<td>
								&nbsp;<select onChange="doCalculations()" id="levelSelect">
								</select>
							</td>
						</tr>
					</table>  
					
					<script>
					select = document.getElementById("levelSelect");
					for (var i = 1; i <= 20; i++) {
					  var option=document.createElement("option");
					  option.text=i.toString();
					  option.value=i;
					  select.add(option, null);          
					}         
					</script>		
					
				</div>
            </div>
        </div>
		
		<div align="center" style="margin-bottom: 8px;">

		</div>
		
        <div class="news_post" id="loadoutInfoPost">
            <div class="news_header_uncollapsed" id="loadoutInfoHeader" onclick="toggleVisibility('loadoutInfo')">
                <div class="news_header_text"><div class="news_title">Loadout</div></div>
            </div>
            
            <div class="news_content" id="loadoutInfoContent" style="display: block">
				<div class="article_news">
					<input type="radio" name="loadoutRadio" value="default" checked="true" style="margin-top: 0" onChange="doCalculations();">
					Default Loadout<br/>
					<input id="customRadioButton" type="radio" name="loadoutRadio" value="custom" style="margin-top: 0" onChange="doCalculations();">
					Custom Loadout<br/>								
					<b>SHARE URL:</b>&nbsp;<input type="loadout" id="shareLink" class="loadout_url" value="http://www.moba-champion.com/loadouts/index.php?l=">&nbsp;<input class="loadout_button" type="button" value="Load" onClick="loadLoadout();">
					<br/><br/>
					<div id="loadoutStats"></div>						
				</div>
            </div>
        </div>
		
		<div align="center" style="margin-bottom: 8px;">

		</div>

		<div class="news_post" id="storeSimPost">
		<div class="news_header_uncollapsed" id="storeSimHeader" onclick="toggleVisibility('storeSim')"><div class="news_header_text"><div class="news_title">Item Store Simulator</div></div></div>
		<div class="news_content" id="storeSimContent" style="display: block">

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
			<div class="store_row store_item" id="basic1" data-quality="basic" data-index="1" data-summary="+120 Health, +10 Health Regen per 5 seconds" data-passive1="Consume I: When a nearby enemy dies there is a 25% chance that you will be healed for 8 health.">
				<img src="http://www.moba-champion.com/images/itempalooza/Life.png" class="iptip" title="Life" onDblClick="addItem('Life');">
				<span class="basic_text">Life</span>
				<span>420</span>
			</div>
			<div class="store_space"></div>
			
			<div class="store_row store_item" id="basic2" data-quality="basic" data-index="2" data-summary="+18 Armor" data-passive1="Toughness I: Reduces the damage taken from basic attacks by 3. The reduction is tripled against shapers.">
				<img src="http://www.moba-champion.com/images/itempalooza/Resilience.png" class="iptip" title="Resilience" onDblClick="addItem('Resilience');">
				<span class="basic_text">Resilience</span>
				<span>380</span>	
			</div>
			<div class="store_space"></div>
			
			<div class="store_row store_item" id="basic3" data-quality="basic" data-index="3" data-summary="+24 Magic Reisstance" data-passive1="Void I: Reduces any magical damage taken by 10.">
				<img src="http://www.moba-champion.com/images/itempalooza/Will.png" class="iptip" title="Will" onDblClick="addItem('Will');">
				<span class="basic_text">Will</span>
				<span>350</span>	
			</div>
			<div class="store_space"></div>
			
			<div class="store_row store_item" id="basic4" data-quality="basic" data-index="4" data-summary="+12 Power" data-passive1="">
				<img src="http://www.moba-champion.com/images/itempalooza/Power.png" class="iptip" title="Power" onDblClick="addItem('Power');">
				<span class="basic_text">Power</span>
				<span>375</span>	
			</div>		
			<div class="store_space"></div>
			
			<div class="store_row store_item" id="basic5" data-quality="basic" data-index="5" data-summary="+20 Haste" data-passive1="">
				<img src="http://www.moba-champion.com/images/itempalooza/Time.png" class="iptip" title="Time" onDblClick="addItem('Time');">
				<span class="basic_text">Time</span>
				<span>460</span>		
			</div>
			<div class="store_space"></div>
			
			<div class="store_row store_item" id="basic6" data-quality="basic" data-index="6" data-summary="Life Leech: Heals a flat amount per damage dealt. The ammount healed is doubled against shapers." data-passive1="">	
				<img src="http://www.moba-champion.com/images/itempalooza/Hunger.png" class="iptip" title="Hunger" onDblClick="addItem('Hunger');">
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
			<div class="store_row store_item item_hidden" id="advanced1" data-quality="advanced" data-index="1">
			
			</div>
			<div class="store_space"></div>
			
			<div class="store_row store_item item_hidden" id="advanced2" data-quality="advanced" data-index="2">
			
			</div>
			<div class="store_space"></div>
			
			<div class="store_row store_item item_hidden" id="advanced3" data-quality="advanced" data-index="3">
			
			</div>
			<div class="store_space"></div>
			
			<div class="store_row store_item item_hidden" id="advanced4" data-quality="advanced" data-index="4">
			
			</div>
			<div class="store_space"></div>
			
			<div class="store_row store_item item_hidden" id="advanced5" data-quality="advanced" data-index="5">
			
			</div>
			<div class="store_space"></div>
			
			<div class="store_row store_item item_hidden" id="advanced6" data-quality="advanced" data-index="6">
			
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
			<div class="store_row store_item item_hidden" id="legendary1" data-quality="legendary" data-index="1"></div>
			<div class="store_space"></div>
			<div class="store_row store_item item_hidden" id="legendary2" data-quality="legendary" data-index="2"></div>
			<div class="store_space"></div>
			<div class="store_row store_item item_hidden" id="legendary3" data-quality="legendary" data-index="3"></div>
			<div class="store_space"></div>
			<div class="store_row store_item item_hidden" id="legendary4" data-quality="legendary" data-index="4"></div>
			<div class="store_space"></div>
			<div class="store_row store_item item_hidden" id="legendary5" data-quality="legendary" data-index="5"></div>
			<div class="store_space"></div>
			<div class="store_row store_item item_hidden" id="legendary6" data-quality="legendary" data-index="6"></div>
		</div>

		</div> <!-- store -->

		</div></div> <!-- news post -->

		<div align="center" style="margin-bottom: 8px;">

		</div>
		<div class="news_post" id="yourBuildPost">
		<div class="news_header_uncollapsed" id="yourBuildHeader" onclick="toggleVisibility('yourBuild')"><div class="news_header_text"><div class="news_title">Your Build</div></div></div>
		<div class="news_content" id="yourBuildContent" style="display: block">

		<div class="article_news">

		<p>
		Double click items in the store to add them to your build. Double click items in your build to remove them.
		</p>

		<img src="http://www.moba-champion.com/theorycrafting/Blank.png" class="mobatip0" id="buildItem0" onDblClick="removeItem(0);">&nbsp;
		<img src="http://www.moba-champion.com/theorycrafting/Blank.png" class="mobatip1" id="buildItem1" onDblClick="removeItem(1);">&nbsp;
		<img src="http://www.moba-champion.com/theorycrafting/Blank.png" class="mobatip2" id="buildItem2" onDblClick="removeItem(2);">&nbsp;
		<img src="http://www.moba-champion.com/theorycrafting/Blank.png" class="mobatip3" id="buildItem3" onDblClick="removeItem(3);">&nbsp;
		<img src="http://www.moba-champion.com/theorycrafting/Blank.png" class="mobatip4" id="buildItem4" onDblClick="removeItem(4);">&nbsp;
		<img src="http://www.moba-champion.com/theorycrafting/Blank.png" class="mobatip5" id="buildItem5" onDblClick="removeItem(5);">
		<br/><br/><div id="TotalCost">Total Cost: 0 vim</div>
		
		<br/>
		<input class="loadout_button" type="button" value="SHARE" onClick="updateShareUrl();">
		&nbsp;
		<input type="loadout" id="buildShareLink" class="loadout_url" value="" style="width: 600px;">
			
		</div>

		</div> <!-- news content -->
		</div> <!-- news post -->
		
		<div class="news_post_collapsed" id="advOptionsPost">
		<div class="news_header_collapsed" id="advOptionsHeader" onclick="toggleVisibility('advOptions')"><div class="news_header_text"><div class="news_title">Advanced Options</div></div></div>
		<div class="news_content" id="advOptionsContent" style="display: none;min-height:0">

			<div class="article_news">

				<div id="FarisForm" style="display: none">
					<p class="bold_text">Faris Form</p>
					<input type="radio" name="farisRadio" value="ranged" checked="true" style="margin-top: 0" onChange="doCalculations();">
					Ranged Form<br/>
					<input id="farisMeleeRadioButton" type="radio" name="farisRadio" value="melee" style="margin-top: 0" onChange="doCalculations();">
					Melee Form<br/>	
					<br/>
				</div>
				<div id="OutriderActive" style="display: none">
					<p class="bold_text">Outrider Passive</p>
					<input id="outriderCheck" type="checkbox" onChange="doCalculations();">&nbsp;Movespeed Bonus Active?
					<br/><br/>
				</div>
				<div id="RavagerSeconds" style="display: none">
					<p class="bold_text">Ravager Passive</p>
					Number of Seconds of Consecutive Combat: <input id="numSecondsCombat" type="number" value="0" min="0" max="10" onChange="doCalculations();">
					<br/>
				</div>
				<div id="BrawlerEnemies" style="display: none">
					<p class="bold_text">Brawler Passive</p>
					Number of Enemy Shapers Nearby: <input id="numNearbyEnemies" type="number" value="0" min="0" max="5" onChange="doCalculations();">
					<br/>
				</div>	
				<div id="ReaperActive" style="display: none">
					<p class="bold_text">Reaper Passive</p>
					<input id="reaperCheck" type="checkbox" onChange="doCalculations();">&nbsp;Power Bonus Active?
					<br/><br/>
				</div>	
				<div id="ScavengerActive" style="display: none">
					<p class="bold_text">Scavenger Passive</p>
					<input id="scavengerCheck" type="checkbox" onChange="doCalculations();">&nbsp;Movespeed Bonus Active?
					<br/><br/>
				</div>
				<div id="AdventurerActive" style="display: none">
					<p class="bold_text">Adventurer Passive</p>
					<input id="adventurerCheck" type="checkbox" onChange="doCalculations();">&nbsp;Movespeed Bonus Active?
					<br/><br/>
				</div>				
				<div id="RemainingHealth" style="display: none">
					<p class="bold_text">Remaining Health (Defiance/Vibrance/Valor/Ambition)</p>
					<input type="range" max="100" id="RemainingHealthSlider" value="100" onchange="doCalculations()"/>
					<div id="RemainingHealthDisplay">Remaining Health: 100%</div>
					<br/>
				</div>	
				<div id="ProsperityStacks" style="display: none">
					<p class="bold_text">Prosperity - Endless Bounty Passive</p>
					<input type="range" max="10" id="ProsperityCounter" value="0" onchange="doCalculations()"/>
					<div id="NumProsperityStacks">Stacks/Minutes: 0, Extra Health: 0, Extra Armor: 0, Extra Magic Resist</div>
					<br/>
				</div>
				<div id="PreservationStacks" style="display: none">
					<p class="bold_text">Preservation - Ablative Armor Passive</p>
					<input type="range" max="5" id="PreservationCounter" value="0" onchange="doCalculations()"/>
					<div id="NumPreservationStacks">Stacks: 0, Extra Power: 0</div>
					<br/>
				</div>					
				<div id="WillThiefStacks" style="display: none">
					<p class="bold_text">Balance/Betrayal/Oppression/Valor - Will Thief Passive</p>
					<input type="range" max="5" id="WillThiefCounter" value="0" onchange="doCalculations()"/>
					<div id="NumWillThiefStacks">Stacks: 0, Extra Magic Resist: 0</div>
					<br/>
				</div>				
				<div id="MightStacks" style="display: none">
					<p class="bold_text">Might/Decay - Soul Collector Passive</p>
					<input type="range" max="30" id="MightCounter" value="0" onchange="doCalculations()"/>
					<div id="NumMightStacks">Stacks: 0, Extra Power: 0, Extra Health: 0</div>
					<br/>
				</div>				
				<div id="StrifeStacks" style="display: none">
					<p class="bold_text">Strife - Soul Master Passive</p>
					<input type="range" max="500" id="StrifeCounter" value="0" onchange="doCalculations()"/>
					<div id="NumStrifeStacks">Stacks: 0, Extra Power: 0, Extra Health: 0</div>
					<br/>
				</div>
				<div id="VoracityStacks" style="display: none">
					<p class="bold_text">Voracity - Rising Hunger Passive</p>
					<input type="range" max="5" id="VoracityCounter" value="0" onchange="doCalculations()"/>
					<div id="NumVoracityStacks">Stacks: 0, Extra Power: 0, Extra Lifedrain: 0%</div>
					<br/>
				</div>
				<div id="HopeActive" style="display: none">
					<p class="bold_text">Hope - Avatar Passive</p>
					<input id="HopeCheck" type="checkbox" onChange="doCalculations();">&nbsp;Defense Bonuses Active?
					<br/><br/>
				</div>				
				<div id="StabilityActive" style="display: none">
					<p class="bold_text">Stability - Swift Recovery Passive</p>
					<input id="StabilityCheck" type="checkbox" onChange="doCalculations();">&nbsp;Movespeed Bonus Active?
					<br/><br/>
				</div>				
				<div id="JusticeActive" style="display: none">
					<p class="bold_text">Justice - Power Overwhelming Passive</p>
					<input id="JusticeCheck" type="checkbox" onChange="doCalculations();">&nbsp;Bonuses Active?
					<br/><br/>
				</div>				
				<div id="PursuitActive" style="display: none">
					<p class="bold_text">Pursuit - Relentless Passive</p>
					<input id="PursuitCheck" type="checkbox" onChange="doCalculations();">&nbsp;Movespeed Bonus Active?
					<br/>
					<br/>
				</div>				
			</div>

		</div> <!-- news content -->
		</div> <!-- news post -->		

		<div align="center" style="margin-bottom: 8px;">

		</div>

		<div class="news_post" id="buildStatsPost">
		<div class="news_header_uncollapsed" id="buildStatsHeader" onclick="toggleVisibility('buildStats')"><div class="news_header_text"><div class="news_title">Build Results</div></div></div>
		<div class="news_content" id="buildStatsContent" style="display: block">

		<div class="article_news">

		<div class="article_subheader"><h3>Stats</h3></div>
		<div id="StatsResults"></div>

		<div class="article_subheader"><h3>Item Passives*</h3></div>
		<div id="PassivesResults"></div>
		<br/>*<i>Note that item passives have been incorporated into the stats where possible.</i>
			
		</div>

		</div> <!-- news content -->
		</div> <!-- news post -->		
		
		<!-- TODO: Add a section for shaper abilities -->
		
		<!--
		<div align="center" style="margin-bottom: 8px;">

		</div>

		<div class="news_post_collapsed" id="vsTargetPost">
		<div class="news_header_collapsed" id="vsTargetHeader" onclick="toggleVisibility('vsTarget')"><div class="news_header_text"><div class="news_title">Mitigated Damage Against Target Shaper</div></div></div>
		<div class="news_content" id="vsTargetContent" style="display: none">

		<div class="article_news">
		
		<div class="article_subheader"><h3>Info</h3></div>
		<b>Target Max HP:</b> <input type="number" id="TargetHPInput" value="1000" min="0" max="9999" step="1" onChange="doCalculations();"><br/>
		<b>Target Armor:</b> <input type="number" id="TargetArmorInput" value="0" min="0" max="999" step="0.1" onChange="doCalculations();"><br/>
		<b>Target Magic Resist:</b> <input type="number" id="TargetResistInput" value="0" min="0" max="999" step="0.1" onChange="doCalculations();"><br/>
		<div class="article_subheader"><h3>Results</h3></div>
		<div id="MitigatedResults"></div>
		</div>

		</div> <!-- news content ->
		</div> <!-- news post ->			
		-->
		
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
