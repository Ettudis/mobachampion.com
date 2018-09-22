<?php
$moba_champ_title = 'Bravery - MOBA-Champion.com';
$moba_champ_desc = 'The ultimate Dawngate bravery!';
$msCommunity = true;
$msGameModes = true;
include('../header.php');
?>

<script src="http://www.moba-champion.com/gamemodes/bravery.js?v=12"></script>

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/gamemodes/">Custom Game Modes</a> > Ultimate Bravery</div></div></div>
<div class="news_content">


<div class="article_news" style="position: relative">

<?php

$shaper = isset($_GET['shaper']) ? $_GET['shaper'] : null;
$hidden = false;
if (is_null($shaper))
{
	$shaper = "Amarynth";
	$hidden = true;
}

$role = isset($_GET['role']) ? $_GET['role'] : null;
if (is_null($role))
{
	$role = "Tactician";
}

$spell1 = isset($_GET['s1']) ? $_GET['s1'] : null;
if (is_null($spell1))
{
	$spell1 = "Blink";
}

$spell2 = isset($_GET['s2']) ? $_GET['s2'] : null;
if (is_null($spell2))
{
	$spell2 = "Blitz";
}

$spell3 = isset($_GET['s3']) ? $_GET['s3'] : null;
if (is_null($spell3))
{
	$spell3 = "Drain";
}

$order = isset($_GET['order']) ? $_GET['order'] : null;
if (is_null($order))
{
	$order = "RQWE";
}

$items = isset($_GET['items']) ? $_GET['items'] : null;
if (is_null($items) || strlen($items) < 12)
{
	$items = "1G0F1N1L0a0h";
}

$item1 = "";

$shaperData = file_get_contents('../data/shaperdata.json');
$shaperDataJSON = json_decode($shaperData);

$itemData = file_get_contents('../data/itempalooza.json');
$itemDataJSON = json_decode($itemData);

$itemArr = array("Life", "Life", "Life", "Life", "Life", "Life");
for ($i = 0; $i < 6; $i++)
{
	$ind1 = $i*2;
	$itemid = substr($items,$ind1,2);
	foreach ($itemDataJSON as $item_entry)
	{
		if ($item_entry->itemid == $itemid)
		{
			$itemArr[$i] = $item_entry->name;
		}
	}
}

$brav = $_GET['id'];
$group = false;
if (!is_null($brav))
{
	$bravery = R::load('bravery', $brav);
	if ($bravery->id > 0)
	{
		$group = true;
	}
}
else
{
	$brav = 0;
}

$shareUrl = "http://www.moba-champion.com/gamemodes/bravery.php?shaper=" . $shaper . "&role=" . $role . "&O=" . $order . "&items=" . $items
				. "&s1=" . $spell1 . "&s2=" . $spell2 . "&s3=" . $spell3; 
$groupShareUrl = 'http://www.moba-champion.com/gamemodes/bravery.php?id=' . $brav;

//solo
echo '<div id="bravery_solo"' . ($group ? 'style="display: none;"' : '') . '>';
echo '<div class="bravery_switcher" id="solo_switcher" ' . ($group || !$hidden ? 'style="display: none;"' : '') . '>Switch to Team</div>';
echo '<div class="bravery_instructions" ' . (!$hidden ? 'style="display: none;"' : '') . '>Click "Solo Bravery" to generate a random build!</div>';
echo '<div class="bravery_entry clrfix"' . ($hidden ? 'style="display: none;"' : '') . '>';
echo '<div class="bravery_solo_header">
			<div class="bravery_name">' . ucfirst($role) . ' ' . ucfirst($shaper) . '</div>
			</div>
		<div class="bravery_role_top">
			<img class="shapertip" id="shaper0" src="http://www.moba-champion.com/images/shapers/' . strtolower($shaper) . '.png" title="' . ucfirst($shaper) . '">
			<img class="roletip" id="role0" src="http://www.moba-champion.com/images/roles/' . strtolower($role) . '.png" title="' . ucfirst($role) . '">
		</div>
		<div class="bravery_entry_top">
			<div class="bravery_spellorder">
				<div class="bravery_skillorder_text">Spells</div>
				<div class="bravery_spell" id="spell00">
					<img class="spelltip" src="http://www.moba-champion.com/images/spells/Spell_' . ucfirst($spell1) . '.png" title="' . ucfirst($spell1) . '">
				</div>
				<div class="bravery_ability_divider"></div>
				<div class="bravery_spell" id="spell01">
					<img class="spelltip" src="http://www.moba-champion.com/images/spells/Spell_' . ucfirst($spell2) . '.png" title="' . ucfirst($spell2) . '">
				</div>
				<div class="bravery_ability_divider"></div>
				<div class="bravery_spell" id="spell02">
					<img class="spelltip" src="http://www.moba-champion.com/images/spells/Spell_' . ucfirst($spell3) . '.png" title="' . ucfirst($spell3) . '">
				</div>
			</div>
			<div class="bravery_skillorder">
				<div class="bravery_skillorder_text">Skill Order</div>
				<div class="bravery_ability abilitytip" id="ability00" data-shaper="' . ucfirst($shaper) . '" title="' . strtolower($order[0]) . '">
					<img src="http://www.moba-champion.com/images/shapers/' . strtolower($shaper) . '/' . strtolower($order[0]) . '.png">
					<div class="bravery_ability_key">' . ucfirst($order[0]) . '</div>
				</div>
				<div class="bravery_ability_divider">></div>
				<div class="bravery_ability abilitytip" id="ability01" data-shaper="' . ucfirst($shaper) . '" title="' . strtolower($order[1]) . '">
					<img src="http://www.moba-champion.com/images/shapers/' . strtolower($shaper) . '/' . strtolower($order[1]) . '.png">
					<div class="bravery_ability_key">' . ucfirst($order[1]) . '</div>
				</div>
				<div class="bravery_ability_divider">></div>
				<div class="bravery_ability abilitytip" id="ability02" data-shaper="' . ucfirst($shaper) . '" title="' . strtolower($order[2]) . '">
					<img src="http://www.moba-champion.com/images/shapers/' . strtolower($shaper) . '/' . strtolower($order[2]) . '.png">
					<div class="bravery_ability_key">' . ucfirst($order[2]) . '</div>
				</div>
				<div class="bravery_ability_divider">></div>
				<div class="bravery_ability abilitytip" id="ability03" data-shaper="' . ucfirst($shaper) . '" title="' . strtolower($order[3]) . '">
					<img src="http://www.moba-champion.com/images/shapers/' . strtolower($shaper) . '/' . strtolower($order[3]) . '.png">
					<div class="bravery_ability_key">' . ucfirst($order[3]) . '</div>
				</div>
			</div>
		</div>
		<div class="bravery_entry_bottom">
			<div class="bravery_item_text">Item Build</div>
			<img data-item="' . $itemArr[0] . '" class="solo_item iptip" title="' . $itemArr[0] . '" id="item00" src="http://www.moba-champion.com/images/itempalooza/' . $itemArr[0] . '.png">
			<img data-item="' . $itemArr[1] . '" class="solo_item iptip" title="' . $itemArr[1] . '" id="item01" src="http://www.moba-champion.com/images/itempalooza/' . $itemArr[1] . '.png">
			<img data-item="' . $itemArr[2] . '" class="solo_item iptip" title="' . $itemArr[2] . '" id="item02" src="http://www.moba-champion.com/images/itempalooza/' . $itemArr[2] . '.png">
			<img data-item="' . $itemArr[3] . '" class="solo_item iptip" title="' . $itemArr[3] . '" id="item03" src="http://www.moba-champion.com/images/itempalooza/' . $itemArr[3] . '.png">
			<img data-item="' . $itemArr[4] . '" class="solo_item iptip" title="' . $itemArr[4] . '" id="item04" src="http://www.moba-champion.com/images/itempalooza/' . $itemArr[4] . '.png">
			<img data-item="' . $itemArr[5] . '" class="solo_item iptip" title="' . $itemArr[5] . '" id="item05" src="http://www.moba-champion.com/images/itempalooza/' . $itemArr[5] . '.png">
		</div>
		<div class="bravery_solo_share">
			<h5>Share:</h5>
			<input id="solo_share" value="'. $shareUrl .'">
		 </div>
	  </div>';
echo '</div>';
// build your own
echo '<div class="bravery_switcher" id="bravery_builder" ' . ($group || !$hidden ? '' : 'style="display: none;"') . '>Create your own!</div>';
// group
echo '<div id="bravery_group"' . (!$group ? 'style="display: none;"' : '') . '>';
echo '<div class="bravery_switcher" id="group_switcher" ' . ($group || !$hidden ? 'style="display: none;"' : '') . '>Switch to Solo</div>';
echo '<div id="bravery_gintro" class="bravery_instructions"' . ($group ? 'style="display: none;"' : '') . '>Click "Team Bravery" to generate a random build!</div>';
	
	// Player 0-9
	for ($i = 0; $i < 10; $i++)
	{
		if ($i == 0)
		{
			echo '<div id="bravery_mortal" class="bravery_team"' . ($group ? '' : 'style="display: none;"') . '>Mortal Team</div>';
		}
		else if ($i == 5)
		{
			echo '<div id="bravery_spirit" class="bravery_team"' . ($group ? '' : 'style="display: none;"') . '>Spirit Team</div>';
		}
		
		echo '<div id="bravery_group' . $i . '" class="bravery_grpentry clrfix"' . (!$group ? 'style="display: none;"' : '') . '>';
		
		if ($group)
		{
			echo '<div data-shaper="' . $bravery->{'shaper' . ($i+1)} . '" class="bravery_small_icon group_shaper shapertip" title="' . ucfirst($bravery->{'shaper' . ($i+1)}) . '"><img src="http://www.moba-champion.com/images/shapers/' . strtolower($bravery->{'shaper' . ($i+1)}) . '.png"></div>';
			echo '<div data-role="' . $bravery->{'role' . ($i+1)} . '" class="bravery_small_icon group_role roletip" title="' . ucfirst($bravery->{'role' . ($i+1)}) . '"><img src="http://www.moba-champion.com/images/roles/' . strtolower($bravery->{'role' . ($i+1)}) . '.png"></div>';
		
			echo '<div class="bravery_group_name">' . $bravery->{'player' . ($i+1)} . '</div>';

			echo '<div style="width:450px;height:10px;float:left"></div>';

			$order = $bravery->{'order' . ($i+1)};
			$braveryString = $order[0] . " > " . $order[1] . " > " . $order[2] . " > " . $order[3];
			echo '<BR><div class="bravery_small_icon group_order" data-order="' . $braveryString . '">' . $braveryString . '</div>';
		
			$items = explode(",", $bravery->{'items' . ($i+1)});
			echo '<div data-item="' . $items[0] . '" class="bravery_small_icon group_item iptip" title="' . $items[0] . '"><img src="http://www.moba-champion.com/images/itempalooza/' . $items[0] . '.png"></div>';
			echo '<div data-item="' . $items[1] . '" class="bravery_small_icon group_item iptip" title="' . $items[1] . '"><img src="http://www.moba-champion.com/images/itempalooza/' . $items[1] . '.png"></div>';
			echo '<div data-item="' . $items[2] . '" class="bravery_small_icon group_item iptip" title="' . $items[2] . '"><img src="http://www.moba-champion.com/images/itempalooza/' . $items[2] . '.png"></div>';
			echo '<div data-item="' . $items[3] . '" class="bravery_small_icon group_item iptip" title="' . $items[3] . '"><img src="http://www.moba-champion.com/images/itempalooza/' . $items[3] . '.png"></div>';
			echo '<div data-item="' . $items[4] . '" class="bravery_small_icon group_item iptip" title="' . $items[4] . '"><img src="http://www.moba-champion.com/images/itempalooza/' . $items[4] . '.png"></div>';
			echo '<div data-item="' . $items[5] . '" class="bravery_small_icon group_item iptip" title="' . $items[5] . '"><img src="http://www.moba-champion.com/images/itempalooza/' . $items[5] . '.png"></div>';
			
			echo '<div style="width:60px;height:10px;float:left"></div>';
			
			$spells = explode(",", $bravery->{'spells' . ($i+1)});
			echo '<div data-spell="' . $spells[0] . '" class="bravery_small_icon group_spell spelltip" title="' . $spells[0] . '"><img src="http://www.moba-champion.com/images/spells/Spell_' . $spells[0] . '.png"></div>';
			echo '<div data-spell="' . $spells[1] . '" class="bravery_small_icon group_spell spelltip" title="' . $spells[1] . '"><img src="http://www.moba-champion.com/images/spells/Spell_' . $spells[1] . '.png"></div>';
			echo '<div data-spell="' . $spells[2] . '" class="bravery_small_icon group_spell spelltip" title="' . $spells[2] . '"><img src="http://www.moba-champion.com/images/spells/Spell_' . $spells[2] . '.png"></div>';
		}
		echo '</div>';
	}
	
	echo '<div id="group_saver" style="display: none;"><button id="group_save_btn" class="btn btn-large" type="button">Save and Share!</button></div>';
	echo '<div class="bravery_group_share" style="display:none;">
			<h5>Share:</h5>
			<input id="group_share" value="'. $groupShareUrl .'">
		 </div>';
echo '</div>';
// options
echo '<div class="bravery_solo_options"' . ($group || !$hidden ? 'style="display: none;"' : '') . '>
		<button id="solo_generate_btn" class="btn btn-large" type="button">Solo Bravery!</button>
		<button style="display:none;" id="group_generate_btn" class="btn btn-large" type="button">Team Bravery!</button>
		<div id="group_only_options" style="display: none;">
		<h5>Team Options</h5>
		<label>Max Gladiators</h5>
		<select id="maxglad">
			<option value="1">1</option>
			<option value="2" selected="selected">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select>
		<label>Max Hunters</h5>
		<select id="maxhunt">
			<option value="1" selected="selected">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select>
		</div>
		<h5>Select</h5>
		<button id="select_all" class="btn">All</button>
		<button id="select_none" class="btn">None</button>
		<h5>Affiliation</h5>
		<button id="region_north" class="solo_region btn active" data-region="north">The North</button>
		<button id="region_east" class="solo_region btn active" data-region="east">The East</button>
		<button id="region_south" class="solo_region btn active" data-region="south">The South</button>
		<button id="region_west" class="solo_region btn active" data-region="west">The West</button>
		<button id="region_heart" class="solo_region btn active" data-region="heart">Heart of the World</button>
		<button id="region_none" class="solo_region btn active" data-region="none">Unaffiliated</button>
		<h5>Range</h5>
		<button id="range_ranged" class="solo_range btn active" data-range="ranged">Ranged</button>
		<button id="range_melee" class="solo_range btn active" data-range="melee">Melee</button>
		<h5>Shapers</h5>';
		foreach($shaperDataJSON as $shaper)
		{
			echo '<div class="bravery_shaper_option" data-region="' . $shaper->region . '" data-role="'. $shaper->role .'" data-shaper="' . $shaper->name . '">
					<img src="http://www.moba-champion.com/images/shapers/' . strtolower($shaper->name) . '.png">
				  </div>';
		}
echo '</div>';
?>

</div>
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
