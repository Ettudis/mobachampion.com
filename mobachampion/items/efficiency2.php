<?php 
require_once('../forum/SSI.php');
?>

<?php
$moba_champ_title = 'Vim Efficiency - MOBA-Champion.com';
$moba_champ_desc = 'Theorycrafting Item Vim Efficiency';
$msItemEfficiency = true;
$msTheorycrafting = true;
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
			$("#myTable").tablesorter();
		$(".needsTT").tooltipster();
	});
	
	</script>	
	
<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Item Vim Efficiency</div></div></div>
<div class="news_content">

<!-- content -->

<?php
$itemData = file_get_contents('../data/itempalooza.json');
$itemDataJSON = json_decode($itemData);
 
$efficiencyData = file_get_contents('efficiency.json');
$efficiencyDataJSON = json_decode($efficiencyData);

?>

<h4 style="color: #FFBF00;">Vim Efficiency Model</h4>
Due to varying degrees of <a href="#slot">slot</a> efficiency, complicated <a href="#passive">passives</a> and the diminishing returns of <a href="#stat">pure stats</a> in 
Dawngate, it is impossible to build a perfectly accurate model of vim efficiency. Our vim efficiency (VE) model was created using both the in-game vim prices and the loadout
editor. When items with pure stats were not available, we leveraged the loadout editor to estimate the VE of a particular stat. Since each spark is guaranteed to fill a single slot 
in a spirit stone, we can use common values like Power to generate the vim worth of other stats.

<h4 style="color: #FFBF00;" id="slot">Slot Efficiency</h4>
<p>The concept of slot efficiency might seem foreign, since each item can only take up a single slot. However, since items contain varying degrees of
vim investment, we define slot efficiency as the number of raw vim/stats you can fit into an item. For example: an advanced item might be incredibly 
vim efficient for the stats it gives, but will always give less total stats than its legendary upgrade. In situations like these, it is a smarter choice
to stop upgrading the item at the Advanced tier until you run out of slots to maximize your vim and slot efficiency.</p>

<h4 style="color: #FFBF00;" id="stat">Pure Stat Efficiency</h4>
<p>One attribute seen throughout Dawngate is diminishing returns when stacking raw values. For example: items that give only a single stat are generally
less vim efficient than items that consist of multiple stats. Similarly, in the Loadout system, you can see diminished returns when stacking spirit stones and
sparks of the same type. Waystone's design philosophies reward well-rounded builds and discourage going all-in with a particular stat.</p>

<h4 style="color: #FFBF00;" id="passive">Passive Efficiency</h4>
<p>Many items with powerful passive effects will be accompanied with lower values of stat efficiency. This is especially true with support-based items. The charts
below calculate the vim efficiency of items prior to the inclusion of their passives. In general, the stronger that a passive is, the more vim it will represent 
in the item's total price.</p>

<h4 style="color: #FFBF00;" id="base">Estimated Vim Efficiency (VE) Values</h4>
<ul>
<li><b>Power:</b> Calculated from the <span class="iptip" title="Supremacy">Supremacy</span> item (3000 vim / 90 power = 33.33 VE)</li>
<li><b>Haste:</b> Calculated from Time (460 vim / 20 haste = 23 VE)</li>
<li><b>Life Drain:</b> Estimated from <span class="iptip" title="Consumption">Consumption</span>, subtracting the cost of the power portion. (500 vim / 10% lifedrain = 50 VE)</li>
<li><b>Armor:</b> Estimated from <span class="iptip" title="Desire">Desire</span> after subtracting Lifedrain and Power. (766.7 vim / 30 armor = 25.55 VE)</li>
<li><b>Magic Resistance:</b> Equivalent to armor, proven by Armor/Magic Resistance sparks in the loadout editor. (14.52 VE)</li>
<li><b>Mastery:</b> Estimated from <span class="iptip" title="Force">Force</span> after subtracting Power. (500 Vim / 10 Mastery = 50 VE)</li>
<li><b>Penetration:</b> Estimated from <span class="iptip" title="Aggression">Aggression</span> after subtracting Power. (500 vim / 15 Penetration = 33.34 VE)</li>
<li><b>Movement Speed:</b> Estimated from <span class="iptip" title="Motion">Motion</span> after removing haste. (365 vim / 5% movement speed = 73 VE)</li>
<li><b>Health: </b> Estimated by comparing sparks with calculated VE of other attributes (2.63 VE)</li>
<li><b>Health Regeneration: </b> Estimated by comparing sparks with calculated VE of other attributes (19.48 VE)</li>
</ul>

<h4 style="color: #FFBF00;" id="waystone">Waystone Tuning Values</h4>
<p>We were able to compare our vim efficiency model with the actual vim values assigned to base stats by Waystone:</p>
<table class="tier_list_chart efficiency_table">
<thead>
<tr><th><b>Stat</b></th><th><b>Estimated Vim/Stat</b></th><th><b>Waystone Vim/Stat</b></th>
</thead>
<tr><td>1 Health</td><td>2.63 Vim</td><td>2.6 Vim</td>
<tr><td>1 Armor</td><td>25.55 Vim</td><td>18 Vim</td>
<tr><td>1 Magic Resistance</td><td>25.55 Vim</td><td>18 Vim</td>
<tr><td>1 Health Regen/5</td><td>19.46 Vim</td><td>20 Vim</td>
<tr><td>1 Power</td><td>33.33 Vim</td><td>32.5 Vim</td>
<tr><td>1 Haste</td><td>23 Vim</td><td>33 Vim</td>
<tr><td>1 Defense Penetration</td><td>33.34 Vim</td><td>40 Vim</td>
<tr><td>1 Mastery</td><td>50 Vim</td><td>55 Vim</td>
<tr><td>1% Lifedrain</td><td>50 Vim</td><td>60 Vim</td>
<tr><td>1% Movespeed</td><td>73 Vim</td><td>50 Vim</td>
</table>
<p></p>

<h4 style="color: #FFBF00;">Vim Efficiency Charts</h4>
<p>The following values are the estimated vim efficiency of Dawngate's items using our Model<!-- and the Waystone Model-->. These values
represent the item's efficiency before factoring in the item's passive. For example, <span class="iptip" title="Growth">Growth</span>
is very vim/stat efficient as it does not contain a passive. <span class="iptip" title="Furor">Furor's</span> base stats are very inefficient
for its cost, as it relies on an extremely strong passive worth approximately 2000 vim.</p>
<div class="efficiency_table">

<table id="myTable" class="tablesorter tier_list_chart"> 
<thead> 
<tr> 
    <th align="left">Item</th> 
    <th class="needsTT" title="The overall cost of the item">Item Cost</th> 
    <th class="needsTT" title="The cost of the item's passive using MOBA-Champion's Efficiency Values">Est Passive Cost</th> 
    <th class="needsTT" title="The cost of the item's passive using Waystone's Efficiency Values">Waystone's Passive Cost</th>
	<th class="needsTT" title="The percentage of the item cost that is consumed by the Passive">Passive Premium</th>
</tr> 
</thead> 
<tbody> 

<?php
foreach($efficiencyDataJSON as $eff)
{
	echo '<tr>';
	echo '<td align="left"><div style="float: left; margin-left: 20px;">' . '<img src="http://www.moba-champion.com/images/itempalooza/' . $eff->name . '.png" class="iptip" title="' . $eff->name . '" style="width: 24px; height: 24px; border: 1px solid black; border-radius: 2px;"> 
			<span class="iptip" title="' . $eff->name . '">' . $eff->name . '</span></div></td>';
	echo '<td>' . $eff->cost . '</td>';
	
	$wsPVim = (intval($eff->cost) - intval($eff->waystone));
	$statPPct = $wsPVim / $eff->cost * 100;
			
	echo '<td>' . (intval($eff->cost) - intval($eff->efficiency)) . '</td>';
	echo '<td>' . $wsPVim. '</td>';
	echo '<td>' . round($statPPct,2). '%</td>';
	echo '</trd>';
}

?>

</tbody> 
</table> 
  
</div>  <!-- <div class="efficiency_table"> -->

<!-- end content-->

</div>
</div>

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
