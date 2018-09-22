<?php
$msGuides = true;
include('../header.php');
require('SBBCodeParser.php');
$guideId = $_GET['id'];

$shapeData = file_get_contents('../loadouts/shapes.json');
$shapeDataJSON = json_decode($shapeData);

$gemData = file_get_contents('../loadouts/gems.json');
$gemDataJSON = json_decode($gemData);

$itemData = file_get_contents('../data/itempalooza.json');
$itemDataJSON = json_decode($itemData);

$TheGuide = null;
$NoGuide = false;
$GuideSkillOrder = "";
$GuideShaper = "";
$GuideShaperSmall = "";

$skillOrder = null;
$roles = null;
$spells = null;
$items = null;
$loadouts = null;
$GuideViews = 0;
$GuideNumComments = 0;

$myvote = 0;
$upvotes = 0;
$downvotes = 0;
$curDate = date('Y-m-d', strtotime("-9 week"));

if (isset($guideId))
{
	$TheGuide = R::load('guidev2', $guideId);
	$GuideShaper = $TheGuide->shaper;
	$GuideShaperSmall = strtolower($GuideShaper);
	
	$skillOrder = R::load('guidev2skillorder', $TheGuide->skillorder);
	if (!is_null($skillOrder))
	{
		$skillText = $skillOrder->basic;
		$GuideSkillOrder = strtoupper($skillOrder->basic[0] . ' > ' . $skillOrder->basic[1] . ' > ' . $skillOrder->basic[2] . ' > ' . $skillOrder->basic[3]);
	}
	
	if ($TheGuide->id > 0)
	{
		$numComments = R::count('guidecommentv2',' guide_id = :guideid', array(':guideid'=>$guideId));
		$GuideNumComments = $numComments;
		
		// Update View Count
		$guideView = R::findOne('guideview',' guideid = ? ',array($TheGuide->id));
		if (is_null($guideView))
		{
			$guideView = R::dispense('guideview');
			$guideView->guideid = $guideId;
			$guideView->views = 0;
			$viewid = R::store($guideView);
		}
		
		$GuideViews = $guideView->views;
        $GuideViews++;
        $guideView->views = $GuideViews;
        R::store($guideView);

		if ($context['user']['is_logged'])
		{
			$name = $context['user']['name'];
			$vote = R::findOne('votev2',' name = :name AND guideid = :guideid AND curdate > :curdate', array(':name'=>$name,':guideid'=>$TheGuide->id,':curdate'=>$curDate) );
			if (!is_null($vote))
			{
				$myvote = $vote->type;
			}
		}
		
		$upvotes = R::count('votev2',' guideid = :guideid AND type = 1 AND curdate > :curdate', array(':guideid'=>$TheGuide->id,':curdate'=>$curDate));
		$downvotes = R::count('votev2',' guideid = :guideid AND type = -1 AND curdate > :curdate', array(':guideid'=>$TheGuide->id,':curdate'=>$curDate));
	}

}
else
{
	$NoGuide = true;
}

function EarlyOut()
{
	echo	'</div></div></div><div class="article_column2">';
	include("../widgets/tournamentwidget.php");
	include("../widgets/shaperguidewidget.php");
	include("../widgets/adwidget.php");
	include("../widgets/streamwidget.php");
	include("../widgets/guidewidget.php");
	echo '</div></div></div>';
	include("../footer.php");
	exit(0);
}

function ParseText($input)
{
	try
	{
		$Parser = new SBBCodeParser\Node_Container_Document();
		$out = $Parser->parse($input)->detect_links()->get_html();
		return parseCode($out);
	}
	catch(Exception $e)
	{
		return '<p><b>BBCode Parsing Error: </b>' . $e->getMessage() . '</p>' . $input;
	}
}

function parseCode($txt)
{
   // these functions will clean the code first
   $ret = $txt;
   
   // abilities
   global $GuideShaper, $GuideShaperSmall;
	
   $ret = str_replace('[p]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/p.png" class="image32small abilitytip" title="p" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="p"></span>', $ret);
   $ret = str_replace('[q]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/q.png" class="image32small abilitytip" title="q" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="q"></span>', $ret);
   $ret = str_replace('[w]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/w.png" class="image32small abilitytip" title="w" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="w"></span>', $ret);
   $ret = str_replace('[e]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/e.png" class="image32small abilitytip" title="e" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="e"></span>', $ret);
   $ret = str_replace('[r]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/r.png" class="image32small abilitytip" title="r" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="r"></span>', $ret);
   $ret = str_replace('[P]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/p.png" class="image32small abilitytip" title="p" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="p"></span>', $ret);
   $ret = str_replace('[Q]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/q.png" class="image32small abilitytip" title="q" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="q"></span>', $ret);
   $ret = str_replace('[W]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/w.png" class="image32small abilitytip" title="w" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="w"></span>', $ret);
   $ret = str_replace('[E]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/e.png" class="image32small abilitytip" title="e" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="e"></span>', $ret);
   $ret = str_replace('[R]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/r.png" class="image32small abilitytip" title="r" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="r"></span>', $ret);
   
   // spells
   $ret = preg_replace_callback ('#\[spell\](.+)\[\/spell\]#iUs', function ($matches) 
	{
		return '<img src="http://www.moba-champion.com/images/spells/Spell_' . ucwords(strtolower($matches[1])) . '.png" class="image32small spelltip" title="' . ucwords(strtolower($matches[1])) . '"></img> <span class="orange_text spelltip" title="' . ucwords(strtolower($matches[1])) . '">' . ucwords(strtolower($matches[1])) . '</span>';
	}, $ret);
			
   // items
   $ret = preg_replace_callback('#\[item\](.+)\[\/item\]#iUs', function ($matches)
   {
		return '<img src="http://www.moba-champion.com/images/itempalooza/' . ucwords($matches[1]) . '.png" class="image32small iptip" title="' . ucwords($matches[1]) . '"></img> <span class="orange_text iptip" title="' . ucwords($matches[1]) . '">' . ucwords($matches[1]) . '</span>';
   }, $ret);
   
   // roles
   $ret = preg_replace_callback ('#\[role\](.+)\[\/role\]#iUs', function ($matches) 
			{
				return '<img src="http://www.moba-champion.com/images/roles/' . strtolower($matches[1]) . '.png" class="image32small roletip" title="' . ucwords($matches[1]) . '"></img> <span class="orange_text roletip" title="' . ucwords($matches[1]) . '">' . ucwords($matches[1]) . '</span>';
			}, $ret);
			
   //shapers
   $ret = preg_replace_callback ('#\[shaper\](.+)\[\/shaper\]#iUs', function ($matches) 
			{
				return '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($matches[1]) . '.png" class="image32small shapertip" title="' . ucwords($matches[1]) . '"></img> <span class="orange_text shapertip" title="' . ucwords($matches[1]) . '">' . ucwords($matches[1]) . '</span>';
			}, $ret);
   
   // return parsed string
   return $ret;
}

function CreateRole($name, $desc)
{
	$descOut = ParseText($desc);
	
	echo  '<div class="guidev2_role_row" data-role="' . $name . '">
				<div class="guidev2_role_left">
					<div class="guidev2_role_img">
						<img src="http://www.moba-champion.com/images/roles/' . strtolower($name) . '.png" class="roletip" title="' . ucfirst($name) . '">
					</div>
					<div class="guidev2_role_header">' . ucfirst($name) . '</div>
				</div>
				<div class="guidev2_role_right guidev2_role_right_display">' . $descOut . '</div>
			</div>';
}


function AddSpecial(&$Bonuses, $special)
{
	$specialStr = "Z " . $special;
	array_push($Bonuses, $specialStr);
}

function AddBonus(&$Bonuses, $bonus)
{
	$bonuses = explode(' ', $bonus);
	$val = $bonuses[0];
	$type = $bonuses[1];
	
	$arrlength=count($Bonuses);
	$bFound = false;
	for($x=0;$x<$arrlength;$x++)
	{
		$b = $Bonuses[$x];
		$bstr = explode(' ', $b);
		$bVal = $bstr[0];
		$bType = $bstr[1];
		
		if ($bType == $type)
		{
			$newVal = $bVal + $val;
			$newStr = $newVal . ' ' . $bType;
			$Bonuses[$x] = $newStr;
			$bFound = true;
		}
	}
	
	if ($bFound == false)
	{
		array_push($Bonuses, $bonus);
	}
}

function startsWith($haystack, $needle)
{
    return $needle === "" || strpos($haystack, $needle) === 0;
}

function endsWith($haystack, $needle)
{
    return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
}

function FormatLoadoutText($text)
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

function CreateLoadoutQuick($id)
{
	global $shapeDataJSON, $gemDataJSON;			
	
	$loadoutBean = R::load('loadout', $id);
	if (!is_null($loadoutBean))
	{	
	
		$Bonuses = array();
		$loadoutStr = $loadoutBean->fullstr;
		
		$shapes = explode("_", $loadoutStr);
				
		foreach ($shapes as $shape)
		{		
			if ($shape != "")
			{
				$strs = explode(',', $shape);
				$shapeId = $strs[2];
				$numGems = $strs[4];
				
				$found = false;
				foreach ($shapeDataJSON->special as $shape_entry)
				{
					if ($shape_entry->id == $shapeId)
					{
						AddSpecial($Bonuses, $shape_entry->special);
						$found = true;
						break;
					}
				}
				
				if ($found == false)
				{
					foreach ($shapeDataJSON->health as $shape_entry)
					{
						if ($shape_entry->id == $shapeId)
						{
							$bonusStrs = explode(',', $shape_entry->bonus);
							foreach($bonusStrs as $bonusStr)
							{
								AddBonus($Bonuses, $bonusStr);
							}
							$found = true;
							break;
						}
					}
				}
				
				if ($found == false)
				{
					foreach ($shapeDataJSON->utility as $shape_entry)
					{
						if ($shape_entry->id == $shapeId)
						{
							$bonusStrs = explode(',', $shape_entry->bonus);
							foreach($bonusStrs as $bonusStr)
							{
								AddBonus($Bonuses, $bonusStr);
							}
							$found = true;
							break;
						}
					}
				}
				
				if ($found == false)
				{
					foreach ($shapeDataJSON->offense as $shape_entry)
					{
						if ($shape_entry->id == $shapeId)
						{
							$bonusStrs = explode(',', $shape_entry->bonus);
							foreach($bonusStrs as $bonusStr)
							{
								AddBonus($Bonuses, $bonusStr);
							}
							$found = true;
							break;
						}
					}
				}
				
				if ($found == false)
				{
					foreach ($shapeDataJSON->mitigation as $shape_entry)
					{
						if ($shape_entry->id == $shapeId)
						{
							$bonusStrs = explode(',', $shape_entry->bonus);
							foreach($bonusStrs as $bonusStr)
							{
								AddBonus($Bonuses, $bonusStr);
							}
							$found = true;
							break;
						}
					}
				}
				
				$endIter = 5 + $numGems;
				for ($i = 5; $i <= $endIter; $i++) 
				{
					foreach ($gemDataJSON as $gem)
					{
						if (array_key_exists($i, $strs) && $gem->id == $strs[$i])
						{
							$bonusStrs = explode(',', $gem->bonus);
							foreach($bonusStrs as $bonusStr)
							{
								AddBonus($Bonuses, $bonusStr);
							}
							break;
						}
					}
					
				}
			}
		}
		
		$arrlength=count($Bonuses);
		if ($arrlength == 0)
		{
			echo 'No loadout specified.';
		}
		else
		{
			$bonusStr = "";
			for($x=0;$x<$arrlength;$x++)
			{
				$bonusStr .= $Bonuses[$x];
				if ($x < $arrlength-1)
				{
					$bonusStr .= ",";
				}
			}
			
			$bonusStr = str_replace("-", " ", $bonusStr);
			$bonusStr = str_replace("+", "", $bonusStr);
			$bonusStr = str_replace(" Percent", "%", $bonusStr);
						
			$res = explode(",", $bonusStr );			
			$itCount = count($res);
			
			for ($i = 0; $i < $itCount; $i++) 
			{
				if (startsWith($res[$i], "Z"))
				{
					echo '<div class="guidev2_loadout_fullselector_stat2 stonetip" title="' . substr($res[$i],2) . '"><span class="passivetext">Unique Passive</span> - <span class="misctext">' . substr($res[$i],2) . '</span></div>';
				}
				else
				{
					echo '<div class="guidev2_loadout_fullselector_stat2">' . FormatLoadoutText($res[$i]) . '</div>';
				}
			}
		}
	}
}

function CreateLoadout($name, $id, $desc)
{
	echo '<div class="guidev2_loadout_row clrfix" data-loadoutid="' . $id . '">
			<div class="guidev2_loadout_left">
				<div class="guidev2_loadout_header"><a href="http://www.moba-champion.com/loadouts/index.php?l=' . $id . '">' . $name . '</a></div>
			</div>';

	echo '<div class="guidev2_loadout_tags clrfix">';
	
	global $shapeDataJSON, $gemDataJSON;			
	
	$loadoutBean = R::load('loadout', $id);
	if (!is_null($loadoutBean))
	{	
	
		$Bonuses = array();
		$loadoutStr = $loadoutBean->fullstr;
		
		$shapes = explode("_", $loadoutStr);
				
		foreach ($shapes as $shape)
		{		
			if ($shape != "")
			{
				$strs = explode(',', $shape);
				$shapeId = $strs[2];
				$numGems = $strs[4];
				
				$found = false;
				foreach ($shapeDataJSON->special as $shape_entry)
				{
					if ($shape_entry->id == $shapeId)
					{
						AddSpecial($Bonuses, $shape_entry->special);
						$found = true;
						break;
					}
				}
				
				if ($found == false)
				{
					foreach ($shapeDataJSON->health as $shape_entry)
					{
						if ($shape_entry->id == $shapeId)
						{
							$bonusStrs = explode(',', $shape_entry->bonus);
							foreach($bonusStrs as $bonusStr)
							{
								AddBonus($Bonuses, $bonusStr);
							}
							$found = true;
							break;
						}
					}
				}
				
				if ($found == false)
				{
					foreach ($shapeDataJSON->utility as $shape_entry)
					{
						if ($shape_entry->id == $shapeId)
						{
							$bonusStrs = explode(',', $shape_entry->bonus);
							foreach($bonusStrs as $bonusStr)
							{
								AddBonus($Bonuses, $bonusStr);
							}
							$found = true;
							break;
						}
					}
				}
				
				if ($found == false)
				{
					foreach ($shapeDataJSON->offense as $shape_entry)
					{
						if ($shape_entry->id == $shapeId)
						{
							$bonusStrs = explode(',', $shape_entry->bonus);
							foreach($bonusStrs as $bonusStr)
							{
								AddBonus($Bonuses, $bonusStr);
							}
							$found = true;
							break;
						}
					}
				}
				
				if ($found == false)
				{
					foreach ($shapeDataJSON->mitigation as $shape_entry)
					{
						if ($shape_entry->id == $shapeId)
						{
							$bonusStrs = explode(',', $shape_entry->bonus);
							foreach($bonusStrs as $bonusStr)
							{
								AddBonus($Bonuses, $bonusStr);
							}
							$found = true;
							break;
						}
					}
				}
				
				$endIter = 5 + $numGems;
				for ($i = 5; $i <= $endIter; $i++) 
				{
					foreach ($gemDataJSON as $gem)
					{
						if (array_key_exists($i, $strs) && $gem->id == $strs[$i])
						{
							$bonusStrs = explode(',', $gem->bonus);
							foreach($bonusStrs as $bonusStr)
							{
								AddBonus($Bonuses, $bonusStr);
							}
							break;
						}
					}
					
				}
			}
		}
		
		$arrlength=count($Bonuses);
		if ($arrlength == 0)
		{
			echo 'No loadout specified.';
		}
		else
		{
			$bonusStr = "";
			for($x=0;$x<$arrlength;$x++)
			{
				$bonusStr .= $Bonuses[$x];
				if ($x < $arrlength-1)
				{
					$bonusStr .= ",";
				}
			}
			
			$bonusStr = str_replace("-", " ", $bonusStr);
			$bonusStr = str_replace("+", "", $bonusStr);
			$bonusStr = str_replace(" Percent", "%", $bonusStr);
						
			$res = explode(",", $bonusStr );			
			$itCount = count($res);
			
			for ($i = 0; $i < $itCount; $i++) 
			{
				if (startsWith($res[$i], "Z"))
				{
					echo '<div class="guidev2_loadout_fullselector_stat2 stonetip" title="' . substr($res[$i],2) . '"><span class="passivetext">Unique Passive</span> - <span class="misctext">' . substr($res[$i],2) . '</span></div>';
				}
				else
				{
					echo '<div class="guidev2_loadout_fullselector_stat2">' . FormatLoadoutText($res[$i]) . '</div>';
				}
			}
		}
	}
	
	$descOut = ParseText($desc);
	
	echo '</div>'; // guidev2_loadout_tags
	
	echo '	<div class="guidev2_loadout_right_display">' . $descOut . '</div>
		  </div>';
}

function CreateSpell($names, $desc)
{
	$spellNames = explode(",", $names);
	$spell1 = $spellNames[0];
	$spell2 = $spellNames[1];
	$spell3 = $spellNames[2];
	
	$descOut = ParseText($desc);
	
	echo '<div class="guidev2_spell_row" data-spell1="' . $spell1 . '" data-spell2="' . $spell2 . '" data-spell3="' . $spell3 . '" >
					<div class="guidev2_spell_left">
						<div class="guidev2_spell_img">
							<img src="http://www.moba-champion.com/images/spells/Spell_' . ucfirst($spell1) . '_1.png" title="' . ucfirst($spell1) . '" class="spelltip">
							<img src="http://www.moba-champion.com/images/spells/Spell_' . ucfirst($spell2) . '_1.png" title="' . ucfirst($spell2) . '" class="spelltip">
							<img src="http://www.moba-champion.com/images/spells/Spell_' . ucfirst($spell3) . '_1.png" title="' . ucfirst($spell3) . '" class="spelltip"></div>
							<div class="guidev2_spell_header">' . ucfirst($spell1) . ", " . ucfirst($spell2) . " & " . ucfirst($spell3) . '</div>
					</div>
					<div class="guidev2_spell_right guidev2_spell_right_display">' . $descOut . '</div>
				</div>';
}


function CreateItem($name, $items, $desc)
{
	$itemExp = explode(",", $items);
	
	$descOut = ParseText($desc);
			
	echo '<div class="guidev2_item_row clrfix"';
		for ($it = 0; $it < count($itemExp); $it++)
		{
			echo ' data-item' . ($it+1) . '="' . $itemExp[$it] . '"';
		}
		echo '>';
		echo '<div class="guidev2_item_imgs">
				<div class="guidev2_item_header">' . $name . '</div>';
				
		foreach($itemExp as $item)
		{
			if ($item != 'undefined')
			{
				echo '<img src="' . GetImageUrl($item) . '" title="' . $item . '" class="iptip">';
			}
		}
		
		echo '</div>';
		
		echo '<div class="guidev2_item_desc guidev2_item_desc_display">' . $descOut . '</div></div>';
}

function CreateBasicSkillOrder($skid)
{
	global $GuideShaper;
	
	$ucSkid = ucfirst($skid);
	echo '<div class="guidev2_skillorder_grid_icon" data-skill="' . $skid . '">
		<div class="guidev2_skillorder_basic_icon abilitytip" data-shaper="' . $GuideShaper . '" id="guidev2_skillorder_basic_' . $skid . '" title="' . $skid .'"
		style="background-image: url(\'http://www.moba-champion.com/images/shapers/' . strtolower($GuideShaper) . '/'. $skid . '.png\');">
			<div class="guidev2_skillorder_basic_text">' . $ucSkid . '</div>
		</div>
	</div>';
}

function GetImageUrl($item)
{
	global $itemDataJSON;
	foreach ($itemDataJSON as $i)
	{
		if ($i->name == $item)
		{
			return $i->img;
		}
	}
	
	return "";
}

function OutputSkillOrder($desc)
{
	$descOut = ParseText($desc);
	echo $descOut;
}

function OutputAbilities($desc)
{
	$descOut = ParseText($desc);
	echo $descOut;
}

function OutputCustom($desc)
{
	$descOut = ParseText($desc);
	return $descOut;
}

?>
	
<?php
echo '<script>';	
echo 'var comment_topic = ' . $guideId . ';';
echo '</script>';
?>

<script type="text/javascript" src="http://www.moba-champion.com/guides/guidesv2_skilldisplay.js?v=5"></script>
<script type="text/javascript" src="http://www.moba-champion.com/guides/guidesv2_comments.js?v=5"></script>
<script type="text/javascript" src="http://www.moba-champion.com/guides/guidesv2_votes.js?v=5"></script>

<div id="main_container">

<div class="article_content">

<div class="news_post">
<div class="news_header">
	<div class="news_header_text">
		<div class="news_title" id="master_guide_title"><a href="http://www.moba-champion.com/guides/">Guides</a> > View Guide</div>
	</div>
</div>

<div class="news_content_noborder">

<?php

$myUser = "";
if ($context['user']['is_logged'])
{
	$myUser = $context['user']['name'];
}

if ($NoGuide == true)
{
	echo '<h3>404 Guide Not Found</h3>';
	echo '<p>Bad Url: A Guide ID was not specified in the request.</p>';
	EarlyOut();
}
else if (is_null($TheGuide) || ($TheGuide->privacy != 'Public' && $TheGuide->author != $myUser && !$user_info['is_admin']))
{
	echo '<h3>404 Guide Not Found</h3>';
	echo '<p>A guide with the specified identifier could not be found or is private.</p>';
	EarlyOut();
}

$roles = R::load('guidev2role', $TheGuide->roles);
$spells = R::load('guidev2spell', $TheGuide->spells);
$items = R::load('guidev2item', $TheGuide->items);
$loadouts = R::load('guidev2loadout', $TheGuide->loadouts);

?>

<div id="guidev2_editor">
	
	<!-- Guide Header -->
	<div id="guidev2_header">
		<div id="guidev2_header_bg">
			<img class="guidev2_header_bg_img" src="http://www.moba-champion.com/images/shapers/<?php echo strtolower($GuideShaper); ?>/header.jpg">
		</div>
		<div id="guidev2_header_title">
			<span id="guidev2_header_title_text"> 
				<?php 
					echo $TheGuide->title;
				?> 
			</span>
		</div>
		<div id="guidev2_header_summary">
			<div id="guidev2_header_icon"></div>
			<div id="guidev2_header_summary_info">
				<div id="guidev2_header_summary_stats">
				
					<div id="guidev2_header_summary_author">
						<div class="guide_header_summary_upper"><span class="guidev2_label_bold">Author: </span></div>
						<div class="guide_header_summary_lower"><span id="guidev2_author"> 
							<?php 
								$name = $TheGuide->author;
								if (strlen($name) > 16)
								{
									echo substr($name, 0, 16);
									echo '&#8230;';
								}
								else
								{
									echo $name;
								}
							?> 
						</span></div>
					</div>
				
					<div id="guidev2_header_summary_votes">
						<div class="guide_header_summary_upper"><i class="fa fa-thumbs-o-up"></i></div>
						<div class="guide_header_summary_lower"><span id="guidev2_votetotal"><?php echo $upvotes - $downvotes; ?></span></div>
					</div>
					<div id="guidev2_header_summary_views">
						<div class="guide_header_summary_upper"><i class="fa fa-eye"></i></div>
						<div class="guide_header_summary_lower"><span id="guidev2_viewtotal"><?php echo $GuideViews; ?></span></div>
					</div>
					<div id="guidev2_header_summary_comments">
						<div class="guide_header_summary_upper"><i class="fa fa-comment"></i></div>
						<div class="guide_header_summary_lower"><span id="guidev2_commenttotal"><?php echo $GuideNumComments; ?></span></div>
					</div>
					<div id="guidev2_header_summary_lastupdate">
						<div class="guide_header_summary_upper"><span class="guidev2_label_bold">Last Updated: </span></div>
						<div class="guide_header_summary_lower"><span id="guidev2_lastupdate"><?php echo $t_date=date("Y-m-d", $TheGuide->updatetime); ?></span></div>
					</div>
				</div>
			</div>
		</div>
	</div>
		
	<!-- Guide QuickGuide -->
	<div id="guidev2_quick" class="guidev2_section">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Quick Guide</div>
		</div>
		<div class="guidev2_section_content clrfix">
		
		<!--
			<div class="guidev2_quick_block clrfix">
				<div class="guidev2_quick_header">Starting Items</div>
				<div class="guidev2_quick_items clrfix">
					<div class="guidev2_quick_itemslot"><img src="http://www.moba-champion.com/guides/img/none.png"></div>
					<div class="guidev2_quick_itemslot"><img src="http://www.moba-champion.com/guides/img/none.png"></div>
				</div>
			</div>
						
			<div style="float: left;width:36px;height:24px;"></div>
			-->
			
			<div class="guidev2_quick_block clrfix">
				<div class="guidev2_quick_header">Item Build</div>
				<div class="guidev2_quick_items clrfix">
					<?php
					if ($items->id > 0)
					{
						$itemsExploded = explode(",", $items->item_sets1);
						$totalItems = count($itemsExploded);
						for ($i = 0; $i < $totalItems; $i++)
						{
							if ($itemsExploded[$i] != 'undefined')
							{
								echo '<div class="guidev2_quick_itemslot"><img class="iptip" src="'. GetImageUrl($itemsExploded[$i]) .'" title="' . $itemsExploded[$i] .'"></div>';
							}
						}
					}
					else
					{
						echo 'No item build specified.';
					}
					?>
				</div>
			</div>

			<div style="float: left;width:36px;height:24px;"></div>

			<div class="guidev2_quick_block clrfix">
				<div class="guidev2_quick_header">Role</div>
				<div class="guidev2_quick_role clrfix">
					<div class="guidev2_quick_itemslot"><img class="roletip" title="<?php echo ucfirst($roles->role1); ?>" src="http://www.moba-champion.com/images/roles/<?php echo strtolower($roles->role1); ?>.png"></div>
				</div>
			</div>
			
			<div style="float: left;width:36px;height:24px;"></div>
			
			<div class="guidev2_quick_block clrfix">
				<div class="guidev2_quick_header">Spells</div>
				<div class="guidev2_quick_items clrfix">
				<?php
					$spellsExploded = explode(",", $spells->spell_names1);
          if (isset($spellsExploded[0]))
            echo '<div class="guidev2_quick_itemslot"><img class="spelltip" title="' . $spellsExploded[0] . '" src="http://www.moba-champion.com/images/spells/Spell_' . $spellsExploded[0] . '_1.png"></div>';
          if (isset($spellsExploded[1]))
            echo '<div class="guidev2_quick_itemslot"><img class="spelltip" title="' . $spellsExploded[1] . '" src="http://www.moba-champion.com/images/spells/Spell_' . $spellsExploded[1] . '_1.png"></div>';
          if (isset($spellsExploded[2]))
            echo '<div class="guidev2_quick_itemslot"><img class="spelltip" title="' . $spellsExploded[2] . '" src="http://www.moba-champion.com/images/spells/Spell_' . $spellsExploded[2] . '_1.png"></div>';
				?>
				</div>
			</div>
			
			<div style="float: left;width:748px;height:16px;"></div>
			
			<div class="guidev2_quick_block clrfix">
				<div class="guidev2_quick_header">Skill Order</div>
				<div class="guidev2_quick_build clrfix">
					<? echo $GuideSkillOrder; ?>
				</div>
			</div>
			
			<div style="float: left;width:36px;height:24px;"></div>
			
			<div class="guidev2_quick_block clrfix guidev2_quick_block_loadout">
				<div class="guidev2_quick_header"><?php echo '<a href="http://www.moba-champion.com/loadouts/index.php?l=' . $loadouts->loadout_ids1 . '">Loadout</a>' ?></div>
				<div class="guidev2_quick_loadout clrfix">
					<?php
						CreateLoadoutQuick($loadouts->loadout_ids1);
					?>
				</div>
			</div>
			
			<div style="float: left;width:748px;height:16px;"></div>
		
		</div>
	</div>
	
	<!-- Role -->
	<div id="guidev2_roles" class="guidev2_section guidev2_content">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Role</div>
		</div>
		<div class="guidev2_section_content clrfix">

			<div class="guidev2_role_area">
				
			<?php 
				if (!is_null($TheGuide) && !is_null($roles))
				{			
					if ($roles->id >= 0)
					{
						if (!is_null($roles->role1) && $roles->role1 != "")
						{
							CreateRole($roles->role1, $roles->role1desc);
						}
						if (!is_null($roles->role2) && $roles->role2 != "")
						{
							CreateRole($roles->role2, $roles->role2desc);
						}
						if (!is_null($roles->role3) && $roles->role3 != "")
						{
							CreateRole($roles->role3, $roles->role3desc);
						}
						if (!is_null($roles->role4) && $roles->role4 != "")
						{
							CreateRole($roles->role4, $roles->role4desc);
						}
					}
				}
			?>
			
			</div>
		</div>
	</div>
	
	<!-- Loadouts -->
	<div id="guidev2_loadouts" class="guidev2_section guidev2_content">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Loadouts</div>
		</div>
		<div class="guidev2_section_content clrfix">

			<!-- loadout rows are here -->
			<div class="guidev2_loadout_selector">
			
			<?php 
				$numloadouts = 0;
				if (!is_null($TheGuide) && !is_null($loadouts))
				{
					if ($loadouts->id >= 0)
					{
						if (!is_null($loadouts->loadout_names1) && $loadouts->loadout_names1 != "")
						{
							$numloadouts++;
							CreateLoadout($loadouts->loadout_names1, $loadouts->loadout_ids1, $loadouts->loadout_descs1);
						}
						if (!is_null($loadouts->loadout_names2) && $loadouts->loadout_names2 != "")
						{
							$numloadouts++;
							CreateLoadout($loadouts->loadout_names2, $loadouts->loadout_ids2, $loadouts->loadout_descs2);
						}
						if (!is_null($loadouts->loadout_names3) && $loadouts->loadout_names3 != "")
						{
							$numloadouts++;
							CreateLoadout($loadouts->loadout_names3, $loadouts->loadout_ids3, $loadouts->loadout_descs3);
						}
					}
				}
			?>
			
			</div>
		</div>
	</div>
	
	<!-- Spell -->
	<div id="guidev2_spells" class="guidev2_section guidev2_content">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Spells</div>
		</div>
		
		<div class="guidev2_section_content clrfix">
			<!-- spell rows are here -->
			<div class="guidev2_spell_selector">
			
			<?php 
				$numSpells = 0;
				if (!is_null($TheGuide) && !is_null($spells))
				{
					if ($spells->id >= 0)
					{
						if (!is_null($spells->spell_names1) && $spells->spell_names1 != "")
						{
							$numSpells++;
							CreateSpell($spells->spell_names1, $spells->spell_descs1);
						}
						if (!is_null($spells->spell_names2) && $spells->spell_names2 != "")
						{
							$numSpells++;
							CreateSpell($spells->spell_names2, $spells->spell_descs2);
						}
						if (!is_null($spells->spell_names3) && $spells->spell_names3 != "")
						{
							$numSpells++;
							CreateSpell($spells->spell_names3, $spells->spell_descs3);
						}
					}
				}
			?>
			
			</div>
		</div>
	</div>
	
	<!-- Items -->
	<div id="guidev2_items" class="guidev2_section guidev2_content">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Items</div>
		</div>
		<div class="guidev2_section_content clrfix">
		
			<!-- item rows are here -->
			<div class="guidev2_item_selector">
			
			<?php 
				$numItems = 0;
				if (!is_null($TheGuide) && !is_null($items))
				{
					if ($items->id > 0)
					{
						if (!is_null($items->item_name1) && ($items->item_name1 != "" || $items->item_desc1 != ""))
						{
							$numItems++;
							CreateItem($items->item_name1, $items->item_sets1, $items->item_desc1);
						}
						if (!is_null($items->item_name2) && ($items->item_name2 != "" || $items->item_desc2 != ""))
						{
							$numItems++;
							CreateItem($items->item_name2, $items->item_sets2, $items->item_desc2);
						}
						if (!is_null($items->item_name3) && ($items->item_name3 != "" || $items->item_desc3 != ""))
						{
							$numItems++;
							CreateItem($items->item_name3, $items->item_sets3, $items->item_desc3);
						}
						if (!is_null($items->item_name4) && ($items->item_name4 != "" || $items->item_desc4 != ""))
						{
							$numItems++;
							CreateItem($items->item_name4, $items->item_sets4, $items->item_desc4);
						}
						if (!is_null($items->item_name5) && ($items->item_name5 != "" || $items->item_desc5 != ""))
						{
							$numItems++;
							CreateItem($items->item_name5, $items->item_sets5, $items->item_desc5);
						}
						if (!is_null($items->item_name6) && ($items->item_name6 != "" || $items->item_desc6 != ""))
						{
							$numItems++;
							CreateItem($items->item_name6, $items->item_sets6, $items->item_desc6);
						}
						if (!is_null($items->item_name7) && ($items->item_name7 != "" || $items->item_desc7 != ""))
						{
							$numItems++;
							CreateItem($items->item_name7, $items->item_sets7, $items->item_desc7);
						}
					}
				}
			?>
			
			</div>

		</div>
	</div>
	
	<!-- Skill Order -->
	<div id="guidev2_skillorder" class="guidev2_section guidev2_content">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Skill Order</div>
		</div>
		<div class="guidev2_section_content clrfix">
															
<?php 
				$basicFound = false;
				$skillOrderDesc = "";
				$basicVisible = true;
				$basicOrder = "";
				
				if (!is_null($TheGuide) && $skillOrder != null)
				{
					if ($skillOrder->id >= 0)
					{
						$basicFound = true;
						$basicOrder = $skillOrder->basic;

						
						$skillOrderDesc = (is_null($skillOrder->desc) ? "" : $skillOrder->desc);
						
						if ($skillOrder->choice == 1)
						{
							$basicVisible = false;
						}
					}
					
					echo '<script>var GuidePointAllocation = "' . $skillOrder->adv . '";</script>';
				}
				
				if ($basicVisible == true)
				{
					echo '<script>var GuideSkillOrderMode = 0;</script>';
					echo '<div class="guidev2_skillorder_basic"><div class="guidev2_skillorder_icons">';
				}
				else
				{
					echo '<div class="guidev2_skillorder_basic" style="display: none;"><div class="guidev2_skillorder_icons">';
				}
					
				if ($basicFound == false)
				{	
					echo '<script>var GuidePointAllocation = 0;</script>';
					CreateBasicSkillOrder('q');
					CreateBasicSkillOrder('w');
					CreateBasicSkillOrder('e');
					CreateBasicSkillOrder('r');
				}
				else
				{
					for ($i = 0; $i < 4; $i++)
					{
						CreateBasicSkillOrder($basicOrder[$i]);
					}
				}
			?>
			
				</div>
				
				<div class="guidev2_skillorder_dividers">
					<div class="guidev2_skillorder_basic_divider1">></div>
					<div class="guidev2_skillorder_basic_divider2">></div>
					<div class="guidev2_skillorder_basic_divider3">></div>
				</div>
			</div>
			
			<?php 
				if ($basicVisible == true)
				{
					echo '<div class="guidev2_skillorder_advanced" style="display: none;">';
				}
				else
				{
					echo '<div class="guidev2_skillorder_advanced">';
				}
				
				include('skillorder.php'); 
			?>
			
			</div>
			
			<div class="guidev2_skillorder_text_display"><?php OutputSkillOrder($skillOrderDesc); ?></div>
		</div>
	</div>
	
	<!-- Abilities -->
	<div id="guidev2_abilities" class="guidev2_section guidev2_content">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Abilities</div>
		</div>
		
		<div class="guidev2_section_content clrfix">
		
			<?php 
				$descp = "";
				$descq = "";
				$descw = "";
				$desce = "";
				$descr = "";
				
				if (!is_null($TheGuide) && $TheGuide->abilities > 0)
				{
					$abilities = R::load('guidev2abilities', $TheGuide->abilities);
					if ($abilities->id >= 0)
					{
						if (!is_null($abilities->descp) && $abilities->descp != "0" && $abilities->descp != "")
						{
							$descp = $abilities->descp;
						}
						if (!is_null($abilities->descq) && $abilities->descq != "0" && $abilities->descq != "")
						{
							$descq = $abilities->descq;
						}
						if (!is_null($abilities->descw) && $abilities->descw != "0" && $abilities->descw != "")
						{
							$descw = $abilities->descw;
						}
						if (!is_null($abilities->desce) && $abilities->desce != "0" && $abilities->desce != "")
						{
							$desce = $abilities->desce;
						}
						if (!is_null($abilities->descr) && $abilities->descr != "0" && $abilities->descr != "")
						{
							$descr = $abilities->descr;
						}
						echo '<script>var GuidePointAllocation = "' . $skillOrder->adv . '";</script>';
					}
				}
			?>
		
		<div class="guidev2_ability_row">
			<div class="guidev2_ability_left">
				<div class="guidev2_ability_img abilitytip" data-shaper="<?php echo $GuideShaper; ?>" title="p">
					<img id="guidev2_ability_p_img" src="http://www.moba-champion.com/images/shapers/<?php echo $GuideShaperSmall; ?>/p.png">
				</div>
				<div id="guidev2_ability_p_text" class="guidev2_ability_header">Passive</div>
			</div>
			<div class="guidev2_ability_right_display"><?php OutputAbilities($descp); ?></div>
		</div>
		
		<div class="guidev2_ability_row">
			<div class="guidev2_ability_left">
				<div class="guidev2_ability_img abilitytip" data-shaper="<?php echo $GuideShaper; ?>" title="q">
					<img id="guidev2_ability_q_img" src="http://www.moba-champion.com/images/shapers/<?php echo $GuideShaperSmall; ?>/q.png">
				</div>
				<div id="guidev2_ability_q_text" class="guidev2_ability_header">Q</div>
			</div>
			<div class="guidev2_ability_right_display"><?php OutputAbilities($descq); ?></div>
		</div>
		
		<div class="guidev2_ability_row">
			<div class="guidev2_ability_left">
				<div class="guidev2_ability_img abilitytip" data-shaper="<?php echo $GuideShaper; ?>" title="w">
					<img id="guidev2_ability_w_img" src="http://www.moba-champion.com/images/shapers/<?php echo $GuideShaperSmall; ?>/w.png">
				</div>
				<div id="guidev2_ability_w_text" class="guidev2_ability_header">W</div>
			</div>
			<div class="guidev2_ability_right_display"><?php OutputAbilities($descw); ?></div>
		</div>
		
		<div class="guidev2_ability_row">
			<div class="guidev2_ability_left">
				<div class="guidev2_ability_img abilitytip" data-shaper="<?php echo $GuideShaper; ?>" title="e">
					<img id="guidev2_ability_e_img" src="http://www.moba-champion.com/images/shapers/<?php echo $GuideShaperSmall; ?>/e.png">
				</div>
				<div id="guidev2_ability_e_text" class="guidev2_ability_header">E</div>
			</div>
			<div class="guidev2_ability_right_display"><?php OutputAbilities($desce); ?></div>
		</div>

		<div class="guidev2_ability_row">
			<div class="guidev2_ability_left">
				<div class="guidev2_ability_img abilitytip" data-shaper="<?php echo $GuideShaper; ?>" title="r">
					<img id="guidev2_ability_r_img" src="http://www.moba-champion.com/images/shapers/<?php echo $GuideShaperSmall; ?>/r.png">
				</div>
				<div id="guidev2_ability_r_text" class="guidev2_ability_header">R</div>
			</div>
			<div class="guidev2_ability_right_display"><?php OutputAbilities($descr); ?></div>
		</div>
			
		</div>
	</div>
	
<!-- Customs -->
	<?php
		if (!is_null($TheGuide) && $TheGuide->customs != "")
		{
			$customs = explode(',', $TheGuide->customs);
			foreach($customs as $custom)
			{
				$customSection = R::load('guidev2custom', $custom);
				if ($customSection->id >= 0)
				{
					echo '<div class="guidev2_section guidev2_content guidev2_custom_section">
						<div class="guidev2_section_header clrfix custom_add_removal">                             
							<div class="guidev2_section_header_text">' . $customSection->title . '</div>      
						</div>
						<div class="guidev2_section_content clrfix" style="padding-right: 16px;">
							'. OutputCustom($customSection->desc) .'
						</div>
					</div>';
				}
			}
		}
	?>
	
	<!-- Matchups -->
	<div id="guidev2_matchups" class="guidev2_section" style="display: none;">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Matchups</div>
		</div>
		<div class="guidev2_section_content clrfix">
		
		<h3>Coming Soon!</h3>
			
		</div>
	</div>
	
	<!-- debug -->
	<div id="guidev2_debug" class="guidev2_section" style="display: none;">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Debug</div>
		</div>
		<div id="guidev2_debug_area" class="guidev2_section_content clrfix">
		
			
			
		</div>
	</div>
	
	<!-- vote -->
	<div id="guidev2_votes" class="guidev2_section">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Voting</div>
		</div>
		<div id="guidev2_vote_area" class="guidev2_section_content clrfix">
			
			<?php
			
			if ($context['user']['is_logged'] == true)
			{
				if ($myvote == 1)
				{
					echo '<div id="upvote_button" class="guidev2_big_vote_btn upvoted"><i class="fa fa-thumbs-up"></i></div>';
					echo '<div id="downvote_button" class="guidev2_big_vote_btn downvote"><i class="fa fa-thumbs-down"></i></div>';
				}
				else if ($myvote == -1)
				{
					echo '<div id="upvote_button" class="guidev2_big_vote_btn upvote"><i class="fa fa-thumbs-up"></i></div>';
					echo '<div id="downvote_button" class="guidev2_big_vote_btn downvoted"><i class="fa fa-thumbs-down"></i></div>';
				}
				else
				{
					echo '<div id="upvote_button" class="guidev2_big_vote_btn upvote"><i class="fa fa-thumbs-o-up"></i></div>';
					echo '<div id="downvote_button" class="guidev2_big_vote_btn downvote"><i class="fa fa-thumbs-o-down"></i></div>';
				}
			}
			else
			{
				echo '<p>You must be logged in to vote on Guides. Please Log in or <a href="http://moba-champion.com/forum/index.php?action=register">Register</a>.</p>';
			}
			
			?>
			
			
		</div>
	</div>
	
</div> <!-- guidev2_editor -->

<?php
	// GUIDE COMMENTS
	$startPage = isset($_GET['page']) ? $_GET['page'] : 0;
	if (!isset($startPage))
	{
		$startPage = 0;
	}
	
	$postsPerPage = 10;
		
	$commentSQL = 'SELECT 
				*
			FROM
				guidecommentv2
			WHERE guidecommentv2.guide_id = "' . $guideId . '" LIMIT ' . ($startPage*$postsPerPage) . ', ' . $postsPerPage;

	$commentData = R::getAll($commentSQL);
	$comments = R::convertToBeans('guidecommentv2',$commentData);
	$numButtons = ceil($numComments / $postsPerPage);
	
	if ($numComments > 0)
	{		
		echo '<div class="news_comment_header">';
		echo '<div class="news_comment_h3">Comments</div>';
			
		echo '<div class="news_comment_buttons">';
		echo '<div class="btn-toolbar">';
		
		for ($i = 1; $i <= $numButtons; $i++) 
		{
			echo '<div class="btn-group">';
			echo '<a href="http://www.moba-champion.com/guides/view.php?id=' . $guideId . '&page=' . ($i-1) .'#comments">';
			if (($i-1) == $startPage)
			{
				echo '<button style="background:#FFBF00;border-color: black;border-radius: 4px;padding-left: 6px;padding-right: 6px;">';
			}
			else
			{
				echo '<button style="border-color: black;border-radius: 4px;padding-left: 6px;padding-right: 6px;">';
			}
			echo $i;
			echo '</button></a>';
			echo '</div>';
		}

		echo '</div>'; // button toolbar
		echo '</div>'; // button right floater
		echo '</div>'; // comment header
	}	
	
	echo '<div id="comments" class="guidev2_comment_section">';
	
	// comment creation
	if ($context['user']['is_logged'] == true)
	{  
	  echo '<div class="news_comment">';
		echo '<div class="news_comment_post">';
		  echo '<div class="news_comment_post_left">';
			echo 'Comment: ';
		  echo '</div>';
		  echo '<div class="news_comment_post_right">';
			echo '<div class="news_comment_post_right_text">';
			  echo '<textarea rows="4" cols="150" maxlength="400" class="news_comment_input" onfocus="if (this.value == \'Comment...\') 
							{
								this.value = \'\';
							}" 
					onblur="if (this.value == \'\') 
							{
								this.value = \'Comment...\';
							}" autocomplete="off"/>Comment...</textarea>';
			echo '</div>';
			echo '<div class="news_comment_post_right_button">';
			  echo '<button class="btn btn-primary" id="comment_button">Post Comment</button>';
			  echo '<span class="news_comment_post_chars_remaining"> 400 characters remaining.</span>';
			echo '</div>';
		  echo '</div>';
		echo '</div>';
	  echo '</div>'; // news_comment
	}
	
	if ($numComments > 0)
	{				
		foreach ($comments as $comment)
		{
		  // comment writing
		  echo '<div class="news_comment">';
			  echo '<div class="news_comment_post_left">';
				echo $comment->user;
			  echo '</div>';
			  echo '<div class="news_comment_right">';
				echo '<div class="news_comment_body">';
					echo $comment->commentText;
				echo '</div>';
			  echo '</div>';
		  echo '</div>'; // news_comment
		}	  
		
    } // numPosts > 0
	
	echo '</div>'; // news_comment_section	
	
?>

</div> <!-- content -->
</div> <!-- news_post-->
</div> <!-- article_content -->

<div class="article_column2">
<?php 
include('../widgets/tournamentwidget.php');
include('../widgets/shaperguidewidget.php');
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
