<?php
$msGuides = true;
$msGuidesEdit = true;
include('../header.php');

$guideId = $_GET['id'];
$guide = null;
$roles = null;

$shapeData = file_get_contents('../loadouts/shapes.json');
$shapeDataJSON = json_decode($shapeData);

$gemData = file_get_contents('../loadouts/gems.json');
$gemDataJSON = json_decode($gemData);

$itemData = file_get_contents('../data/itempalooza.json');
$itemDataJSON = json_decode($itemData);

if (isset($guideId))
{
    $guide = R::load('guidev2', $guideId);
    if ($guide->id > 0)
    {
		echo '<script type="text/javascript">
			var GuideId = "' . addslashes($guide->id) . '";
			var GuideShaper = "' . addslashes($guide->shaper) . '";
			var GuideHeader =  "' . addslashes($guide->shaper) . '";
			var GuideTitle = "' . addslashes ($guide->title) . '";
			var GuideIgn = "' . addslashes($guide->ign) . '";
			var GuideRoleId = "' . (is_null($guide->roles) ? "-1" : addslashes($guide->roles)) . '";
			var GuideLoadoutId = "' . (is_null($guide->loadouts) ? "-1" : addslashes($guide->loadouts)) . '";
			var GuideSpellId = "' . (is_null($guide->spells) ? "-1" : addslashes($guide->spells)) . '";
			var GuideItemId = "' . (is_null($guide->items) ? "-1" : addslashes($guide->items)) . '";
			var GuideSkillOrder = "' . (is_null($guide->skillorder) ? "-1" : addslashes($guide->skillorder)) . '";
			var GuideAbilities = "' . (is_null($guide->abilities) ? "-1" : addslashes($guide->abilities)) . '";
			var GuideNumCustomSections = "' . (substr_count($guide->customs, ",") + 1) . '";
		  </script>';
	}
	else
	{
		echo '<script type="text/javascript">
			var GuideId = -1;
			var GuideShaper = "";
			var GuideHeader = "";
			var GuideTitle = "";
			var GuideIgn = "";
			var GuideRoleId = -1;
			var GuideLoadoutId = -1;
			var GuideSpellId = -1;
			var GuideItemId = -1;
			var GuideSkillOrder = -1;
			var GuideAbilities = -1;
			var GuideNumCustomSections = 0;
		  </script>';
	}
}
else
{
		echo '<script type="text/javascript">
			var GuideId = -1;
			var GuideShaper = "";
			var GuideHeader = "";
			var GuideTitle = "";
			var GuideIgn = "";
			var GuideRoleId = -1;
			var GuideLoadoutId = -1;
			var GuideSpellId = -1;
			var GuideItemId = -1;
			var GuideSkillOrder = -1;
			var GuideAbilities = -1;
			var GuideNumCustomSections = 0;
		  </script>';
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

function IsRoleActive($in, $str)
{
	if (strcmp($in->role1,$str) == 0)
	{
		return true;
	}
	
	if (strcmp($in->role2,$str) == 0)
	{
		return true;
	}
	
	if (strcmp($in->role3,$str) == 0)
	{
		return true;
	}
	
	if (strcmp($in->role4,$str) == 0)
	{
		return true;
	}
	
	return false;
}

function CreateRole($name, $desc)
{
echo  '<div class="guidev2_role_row" data-role="' . $name . '">
			<div class="guidev2_role_left">
				<div class="guidev2_role_img">
					<img src="http://www.moba-champion.com/images/roles/' . strtolower($name) . '.png" class="gv2roleroletip" title="' . strtolower($name) . '">
				</div>
				<div class="guidev2_role_header">' . ucfirst($name) . '</div>
			</div>
			<div class="guidev2_role_right">
				<textarea data-type="role">' . $desc . '</textarea>
				<div class="guidev2_controls_updown">
					<div class="guidev2_up" data-type="role"><i class="fa fa-chevron-up"></i></div>
					<div class="guidev2_down" data-type="role"><i class="fa fa-chevron-down"></i></div>
				</div>
			</div>
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

function CreateLoadout($name, $id, $desc)
{
	echo '<div class="guidev2_loadout_row clrfix" data-loadoutid="' . $id . '">
			<div class="guidev2_loadout_left">
				<div class="guidev2_loadout_header">' . $name . '</div>
			</div>';

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
							AddBonus($Bonuses, $shape_entry->bonus);
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
							AddBonus($Bonuses, $shape_entry->bonus);
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
							AddBonus($Bonuses, $shape_entry->bonus);
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
							AddBonus($Bonuses, $shape_entry->bonus);
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
						if ($gem->id == $strs[$i])
						{
							AddBonus($Bonuses, $gem->bonus);
							break;
						}
					}
					
				}
			}
		}
		
		$arrlength=count($Bonuses);
		if ($arrlength == 0)
		{
			echo 'none';
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
					echo '<div class="guidev2_loadout_fullselector_stat2">' . substr($res[$i],2) . '</div>';
				}
				else
				{
					echo '<div class="guidev2_loadout_fullselector_stat2">+' . $res[$i] . '</div>';
				}
			}
		}
	}
	
	echo '	<div class="guidev2_loadout_right">
				<textarea class="add_sceditor" data-type="loadout">' . $desc . '</textarea>
				<div class="guidev2_controls_updown">
					<div class="guidev2_up" data-type="loadout"><i class="fa fa-chevron-up"></i></div>
					<div class="guidev2_down" data-type="loadout"><i class="fa fa-chevron-down"></i></div>
				</div>
			</div>
			<div class="guidev2_loadout_removal add_loadout_delete_handler">
				<div class="guidev2_remove_button guidev2_remove_loadout_button"><i class="fa fa-times"></i></div>
			</div>
		  </div>';
}

function CreateSpell($names, $desc)
{
	$spellNames = explode(",", $names);
	$spell1 = $spellNames[0];
	$spell2 = $spellNames[1];
	$spell3 = $spellNames[2];
	
	echo '<div class="guidev2_spell_row" data-spell1="' . $spell1 . '" data-spell2="' . $spell2 . '" data-spell3="' . $spell3 . '" >
					<div class="guidev2_spell_left">
						<div class="guidev2_spell_img">
							<img src="http://www.moba-champion.com/images/spells/Spell_' . ucfirst($spell1) . '_1.png" title="' . ucfirst($spell1) . '" class="spelltip">
							<img src="http://www.moba-champion.com/images/spells/Spell_' . ucfirst($spell2) . '_1.png" title="' . ucfirst($spell2) . '" class="spelltip">
							<img src="http://www.moba-champion.com/images/spells/Spell_' . ucfirst($spell3) . '_1.png" title="' . ucfirst($spell3) . '" class="spelltip"></div>
							<div class="guidev2_spell_header">' . ucfirst($spell1) . ", " . ucfirst($spell2) . " & " . ucfirst($spell3) . '</div>
					</div>
					<div class="guidev2_spell_right"><textarea class="add_sceditor" data-type="spell">' . $desc . '</textarea>
						<div class="guidev2_controls_updown">
							<div class="guidev2_up" data-type="spell"><i class="fa fa-chevron-up"></i></div>
							<div class="guidev2_down" data-type="spell"><i class="fa fa-chevron-down"></i></div>
						</div>
					</div>
					<div class="guidev2_remove_button add_spell_delete_handler"><i class="fa fa-times"></i></div>
				</div>';
}

function CreateItem($name, $items, $desc)
{
	$itemExp = explode(",", $items);
			
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
		
		echo '<div class="guidev2_item_desc">
				<textarea class="add_sceditor" data-type="item">' . $desc . '</textarea>
				<div class="guidev2_controls_updown">
					<div class="guidev2_up" data-type="item"><i class="fa fa-chevron-up"></i></div>
					<div class="guidev2_down" data-type="item"><i class="fa fa-chevron-down"></i></div>
				</div>
			 </div>
			 <div class="guidev2_item_removal add_item_delete_handler"><div class="guidev2_remove_button"><i class="fa fa-times"></i></div></div>
		</div>';
}

function CreateBasicSkillOrder($skid)
{
	$ucSkid = ucfirst($skid);
	echo '<div class="guidev2_skillorder_grid_icon" data-skill="' . $skid . '">
		<div class="guidev2_skillorder_basic_icon" id="guidev2_skillorder_basic_' . $skid . '" title="' . $skid .'">
			<div class="guidev2_skillorder_basic_text">' . $ucSkid . '</div>
		</div>
	</div>';
}

?>

<script type="text/javascript" src="http://www.moba-champion.com/guides/development/jquery.sceditor.bbcode.js"></script>
<script src="http://www.moba-champion.com/guides/guidesv2_skillorder.js?v=7"></script>
<script src="http://www.moba-champion.com/guides/guidesv2.js?v=8"></script>
	
<div id="main_container">

<div class="article_content">

<div class="news_post">
<div class="news_header">
	<div class="news_header_text">
		<div class="news_title" id="master_guide_title"><a href="http://www.moba-champion.com/guides/">Guides</a> > Create a Guide</div>
		<div class="news_title" id="master_guide_settings" style="display: none;"><i class="master_guide_settings_cog fa fa-cog"></i>
			<div class="news_title" id="master_guide_settings_tooltip" style="display: none;">
				<a href="#" class="close" data-dismiss="alert">&times;</a>You can always change the Guide type or edit your settings here.
			</div>
		</div>
	</div>
</div>
<div class="news_content_noborder">

<?php
if ($context['user']['is_logged'] == false)
{
	echo '<p>You must be logged in to create a guide. Please log in or <a href="http://moba-champion.com/forum/index.php?action=register">Register</a>.</p>';
	echo '</div> <!-- news -->
	</div> <!-- content -->

	<div class="guide_item_picker_window guide_hidden">
	<div class="guide_item_background"></div>
	<div class="guide_item_picker">
		<div class="guide_item_close"><i class="fa fa-times"> </i> Close</div>
	</div>
	</div>

		</div></div>
	
	</div> <!-- main container -->
	</div> <!-- maincontent -->';

	include('../footer.php');
	exit(0);
}
else if ($guide->id > 0)
{
	if ($guide->author != $context['user']['name'])
	{
		echo '<p>You are trying to edit a guide that does not belong to you.</p>';
		echo '</div> <!-- news -->
		</div> <!-- content -->

		<div class="guide_item_picker_window guide_hidden">
		<div class="guide_item_background"></div>
		<div class="guide_item_picker">
			<div class="guide_item_close"><i class="fa fa-times"> </i> Close</div>
		</div>
		</div>

			</div></div>
		
		</div> <!-- main container -->
		</div> <!-- maincontent -->';

		include('../footer.php');
		exit(0);
	}
}

?>

<div id="guidev2_editor">
	<!-- GUIDE SELECTOR -->
	<div id="guidev2_type_selector" class="guidev2_section clrfix">
		<div id="guidev2_selector_header">
			Select a Guide Type
		</div>
		
		<div id="guidev2_selector_shaper" class="guidev2_selector">
			<div class="guidev2_selector_glow"></div>
			<div class="guidev2_selector_text">Shaper Guide</div>
		</div>
		
		<div id="guidev2_selector_comp" class="guidev2_selector">
			<div class="guidev2_selector_darkglow"></div>
			<div class="guidev2_selector_text">Coming Soon</div>
		</div>
		
		<div id="guidev2_selector_general" class="guidev2_selector">
			<div class="guidev2_selector_darkglow"></div>
			<div class="guidev2_selector_text">Coming Soon</div>
		</div>
	</div>
	
	<!-- GUIDE SETTINGS -->
	<div id="guidev2_settings" class="guidev2_section clrfix" style="display: none;">
		<div class="guidev2_inner">
			<div class="guidev2_settings_left">
				<div id="guidev2_settings_left_title" class="guidev2_settings_left_text">Guide Title:</div>
				<div id="guidev2_settings_left_shaper" class="guidev2_settings_left_text">Shaper:</div>
				<div id="guidev2_settings_left_ign" class="guidev2_settings_left_text">In-Game Name:</div>
			</div>
			<div class="guidev2_settings_right">
				<div class="guidev2_settings_title">
					<input class="guidev2_settings_title_val" type="shaper" name="guidetitle" maxlength="55">
				</div>
				
				<div class="guidev2_settings_shaper">
					<select class="guidev2_settings_shaper_val">
					<option value="all">Select a Shaper...</option>
						<?php
							$shaperData = file_get_contents('../data/shaperdata.json');
							$shaperDataJSON = json_decode($shaperData);
					
							foreach ($shaperDataJSON as $shaper_entry)
							{
								$smallName = strtolower($shaper_entry->name);
								echo '<option value="' . $shaper_entry->name . '">' . $shaper_entry->name . '</option>';
							}	
						?>
					</select>
				</div>
				
				<div class="guidev2_settings_ign">
					<input class="guidev2_settings_ign_val" type="shaper" name="guidetitle" maxlength="24">
				</div>
				
				<div class="guidev2_settings_creation">
					<button id="guidev2_start" class="btn btn-primary" type="button">Start Creating Guide</button>
					<button id="guidev2_redo" class="btn btn-inverse" type="button" style="display: none;">Change Guide Type</button>
					<img src="http://www.moba-champion.com/guides/img/spinner.gif" class="guide_settings_spinner" style="display: none;">
				</div>
			</div>
		</div>
	</div>
	
	<!-- Guide Header -->
	<div id="guidev2_header" style="display: none;">
		<div id="guidev2_header_bg"></div>
		<div id="guidev2_header_title">
			<span id="guidev2_header_title_text"> 
				<?php 
					if (!is_null($guide))
					{
						echo $guide->title;
					}
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
								$name = $context['user']['name'];
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
						<div class="guide_header_summary_upper"><i class="fa fa-thumbs-up"></i></div>
						<div class="guide_header_summary_lower"><span id="guidev2_votetotal">0</span></div>
					</div>
					<div id="guidev2_header_summary_views">
						<div class="guide_header_summary_upper"><i class="fa fa-eye"></i></div>
						<div class="guide_header_summary_lower"><span id="guidev2_viewtotal">0</span></div>
					</div>
					<div id="guidev2_header_summary_comments">
						<div class="guide_header_summary_upper"><i class="fa fa-comment"></i></div>
						<div class="guide_header_summary_lower"><span id="guidev2_commenttotal">0</span></div>
					</div>
					<div id="guidev2_header_summary_lastupdate">
						<div class="guide_header_summary_upper"><span class="guidev2_label_bold">Last Updated: </span></div>
						<div class="guide_header_summary_lower"><span id="guidev2_lastupdate">Today</span></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Publish -->
	<div id="guidev2_publish" class="guidev2_section" style="display: none;">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Publish Settings</div>
			<div class="guidev2_section_header_icon"><i class="fa fa-edit icon-white"></i></div>
		</div>
		<div class="guidev2_section_content clrfix">
		
			<h6>Privacy:</h6>
			<select id="guidev2_options_privacy">
				<option value="Private">Private</option>
				
			<?php 
				if (!is_null($guide) && $guide->privacy == 'Public')
				{
					echo '<option value="Public" selected="selected">Public</option>';
				}
				else
				{
					echo '<option value="Public">Public</option>';
				}
			?>
			
			</select>
			
			<p>
				<button class="guidev2_publish_btn btn btn-primary" type="button">Save Guide</button>
				<img src="http://www.moba-champion.com/guides/img/spinner.gif" class="guide_settings_spinner" style="display: none;">
			</p>
			
			<div class="guidev2_save_errors">
				
			</div>
			
		</div>
	</div>
	
	<!-- help -->
	<div id="guidev2_help" class="guidev2_section" style="display: none;">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Guide Macros</div>
			<div class="guidev2_section_header_icon"><i class="fa fa-edit icon-white"></i></div>
		</div>
		<div id="guidev2_macro_list" class="guidev2_section_content clrfix">
		
			<h6>The following macro types are available:</h6>
			<ul>
			<li>Ability Icons: [p], [q], [w], [e], [r]</li>
			<li>Shapers: [shaper]Amarynth[/shaper]</li>
			<li>Spells: [spell]Blink[/spell]</li>
			<li>Items: [item]Destruction[/item]</li>
			<li>Roles: [role]Gladiator[/role]</li>
			<li>Images: [img]www.imgur.com/example[/img]</li>
			<li>Youtube: [youtube]{video ID}[/youtube]</li>
			<li>Matchup: [matchup difficulty=75 shaper=Amarynth]Text Text Text Text[/matchup]</li>
			</ul>
			
		</div>
	</div>
	
	<!-- Guide QuickGuide -->
	<div id="guidev2_quick" class="guidev2_section" style="display: none;">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Quick Guide</div>
			<div class="guidev2_section_header_icon"><i class="fa fa-edit icon-white"></i></div>
		</div>
		<div class="guidev2_section_content clrfix">
		
			<div class="guidev2_quick_block clrfix">
				<div class="guidev2_quick_header">Starting Items</div>
				<div class="guidev2_quick_items clrfix">
					<div class="guidev2_quick_itemslot"><img src="http://www.moba-champion.com/guides/img/none.png"></div>
					<div class="guidev2_quick_itemslot"><img src="http://www.moba-champion.com/guides/img/none.png"></div>
				</div>
			</div>
			
			<div style="float: left;width:36px;height:24px;"></div>
			
			<div class="guidev2_quick_block clrfix">
				<div class="guidev2_quick_header">Item Build</div>
				<div class="guidev2_quick_items clrfix">
					<div class="guidev2_quick_itemslot"><img src="http://www.moba-champion.com/guides/img/none.png"></div>
					<div class="guidev2_quick_itemslot"><img src="http://www.moba-champion.com/guides/img/none.png"></div>
					<div class="guidev2_quick_itemslot"><img src="http://www.moba-champion.com/guides/img/none.png"></div>
					<div class="guidev2_quick_itemslot"><img src="http://www.moba-champion.com/guides/img/none.png"></div>
					<div class="guidev2_quick_itemslot"><img src="http://www.moba-champion.com/guides/img/none.png"></div>
					<div class="guidev2_quick_itemslot"><img src="http://www.moba-champion.com/guides/img/none.png"></div>
				</div>
			</div>

			<div style="float: left;width:36px;height:24px;"></div>

			<div class="guidev2_quick_block clrfix">
				<div class="guidev2_quick_header">Role</div>
				<div class="guidev2_quick_role clrfix">
					<div class="guidev2_quick_itemslot"><img src="http://www.moba-champion.com/guides/img/none.png"></div>
				</div>
			</div>
			
			<div style="float: left;width:748px;height:24px;"></div>
			
			<div class="guidev2_quick_block clrfix">
				<div class="guidev2_quick_header">Spells</div>
				<div class="guidev2_quick_items clrfix">
					<div class="guidev2_quick_itemslot"><img src="http://www.moba-champion.com/guides/img/none.png"></div>
					<div class="guidev2_quick_itemslot"><img src="http://www.moba-champion.com/guides/img/none.png"></div>
					<div class="guidev2_quick_itemslot"><img src="http://www.moba-champion.com/guides/img/none.png"></div>
				</div>
			</div>
			
			<div style="float: left;width:36px;height:24px;"></div>
			
			<div class="guidev2_quick_block clrfix">
				<div class="guidev2_quick_header">Build Order</div>
				<div class="guidev2_quick_build clrfix">
					R > Q > W > E
				</div>
			</div>
			
			<div style="float: left;width:36px;height:24px;"></div>
			
			<div class="guidev2_quick_block clrfix">
				<div class="guidev2_quick_header">Loadout</div>
				<div class="guidev2_quick_loadout clrfix">

				</div>
			</div>
		
		</div>
	</div>
	
	<!-- Role -->
	<div id="guidev2_roles" class="guidev2_section guidev2_content" data-contenttype="1" style="display: none;">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Role</div>
			<div class="guidev2_section_header_icon"><i class="fa fa-edit icon-white"></i></div>
		</div>
		<div class="guidev2_section_content clrfix">
			<div class="guidev2_role_selector">
			<p>Enable roles using the buttons below. Enter a description for each role. The topmost role is
				the primary role, which will be displayed in the guick guide.</p>
				
			<?php 
				if (!is_null($guide))
				{
					$roles = R::load('guidev2role', $guide->roles);
				}
			?>

				<div class="guidev2_role_select roletip <?php if ($roles->id >= 0 && IsRoleActive($roles, 'gladiator')) { echo 'guidev2_role_row_active'; } ?>" role="gladiator" title="Gladiator">
					<img src="http://www.moba-champion.com/images/roles/gladiator.png">
					<span>Gladiator</span>
				</div>
				<div class="guidev2_role_select roletip <?php if ($roles->id >= 0 && IsRoleActive($roles, 'tactician')) { echo 'guidev2_role_row_active'; } ?>" role="tactician" title="Tactician">
					<img src="http://www.moba-champion.com/images/roles/tactician.png">
					<span>Tactician</span>
				</div>
				<div class="guidev2_role_select roletip <?php if ($roles->id >= 0 && IsRoleActive($roles, 'hunter')) { echo 'guidev2_role_row_active'; } ?>" role="hunter" title="Hunter">
					<img src="http://www.moba-champion.com/images/roles/hunter.png">
					<span>Hunter</span>
				</div>
				<div class="guidev2_role_select roletip <?php if ($roles->id >= 0 && IsRoleActive($roles, 'predator')) { echo 'guidev2_role_row_active'; } ?>" role="predator" title="Predator">
					<img src="http://www.moba-champion.com/images/roles/predator.png">
					<span>Predator</span>
				</div>
			</div>
			<div class="guidev2_role_area">
				<!-- roles go here -->
				
			<?php 
				if (!is_null($guide))
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
	<div id="guidev2_loadouts" class="guidev2_section guidev2_content" data-contenttype="2" style="display: none;">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Loadouts</div>
			<div class="guidev2_section_header_icon"><i class="fa fa-edit icon-white"></i></div>
		</div>
		<div class="guidev2_section_content clrfix">

			<!-- loadout rows are here -->
			<div class="guidev2_loadout_selector">
			
			<?php 
				$numloadouts = 0;
				if (!is_null($guide) && $guide->loadouts > 0)
				{
					$loadouts = R::load('guidev2loadout', $guide->loadouts);
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
			
			<?php
			
			if ($numLoadouts == 3)
			{
				echo '<!-- add loadout button -->
						<div style="display: none;" id="guidev2_add_loadout" class="guidev2_add_button guidev2_tt_required" title="Add a Loadout"><i class="fa fa-plus"></i></div>';
			}
			else
			{
				echo '<!-- add loadout button -->
						<div id="guidev2_add_loadout" class="guidev2_add_button guidev2_tt_required" title="Add a Loadout"><i class="fa fa-plus"></i></div>';
			}
			
			echo '<script>var GuideNumLoadouts = ' . $numloadouts . ';</script>';
			?>
						
			<!-- loadout selectors -->
			<div class="guidev2_loadout_fullselector guidev2_hidden">
				<div class="guidev2_fullselector_background"></div>
				<div class="guidev2_fullselector_picker guidev2_loadout_fullselector_picker">
				
					<div class="guidev2_loadout_fullselector_picker_options clrfix">
						<div class="guidev2_loadout_fullselector_name">
							<span>Loadout Name: <i class="fa fa-question guidev2_tt_required" title="Enter a custom name for your loadout (max: 24 characters)"></i></span>
						</div>
						<div class="guidev2_loadout_fullselector_input">
							<input id="guidev2_loadout_name" type="shaper" name="guidetitle" maxlength="24">
						</div>
						<div class="guidev2_loadout_fullselector_share">
							<span>Share URL: <i class="fa fa-question guidev2_tt_required" title="Create a loadout using the loadout editor, click SHARE, and copy the URL into this field."></i></span>
						</div>
						<div class="guidev2_loadout_fullselector_import">
							<input id="guidev2_loadout_url" type="shaper" name="guidetitle" maxlength="70">
							<button id="guidev2_loadout_import" class="btn">Import</button>
							<img src="http://www.moba-champion.com/guides/img/spinner.gif" id="guide_loadout_spinner" style="display: none;">
						</div>
					</div>
					
					<div class="guidev2_loadout_fullselector_summary clrfix">
					</div>

					<div class="guidev2_loadout_fullselector_accept" style="display: none;"><button class="btn btn-primary btn-large">Accept</button></div>
					
					<div class="guidev2_loadout_external"><a href="http://www.moba-champion.com/loadouts" target="_blank">Loadout Editor</a> <i class="icon-edit icon-white"> </i></div>
					<div class="guidev2_fullselector_close"><i class="fa fa-times"> </i> Close</div>
				</div>
			</div>
			
		</div>
	</div>
	
	<!-- Spell -->
	<div id="guidev2_spells" class="guidev2_section guidev2_content" data-contenttype="3" style="display: none;">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Spells</div>
			<div class="guidev2_section_header_icon"><i class="fa fa-edit icon-white"></i></div>
		</div>
		
		<div class="guidev2_section_content clrfix">
			<!-- spell rows are here -->
			<div class="guidev2_spell_selector">
			
			<?php 
				$numSpells = 0;
				if (!is_null($guide) && $guide->spells > 0)
				{
					$spells = R::load('guidev2spell', $guide->spells);
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
			
			<?php
			
			if ($numSpells == 3)
			{
				echo '<!-- add spell button -->
						<div style="display: none;" id="guidev2_add_spell" class="guidev2_add_button guidev2_tt_required" title="Add a Spell Set"><i class="fa fa-plus"></i></div>';
			}
			else
			{
				echo '<!-- add spell button -->
						<div id="guidev2_add_spell" class="guidev2_add_button guidev2_tt_required" title="Add a Spell Set"><i class="fa fa-plus"></i></div>';
			}
			
			echo '<script>var GuideNumSpellSets = ' . $numSpells . ';</script>';
			?>

			<!-- spell selectors -->
			<div class="guidev2_spell_fullselector guidev2_hidden">
				<div class="guidev2_fullselector_background"></div>
				<div class="guidev2_fullselector_picker guidev2_spell_fullselector_picker">
					<div class="guidev2_spell_fullselector_picker_options clrfix">
						<?php
							$spellData = file_get_contents('../data/spelldata.json');
							$spellDataJSON = json_decode($spellData);
					
							foreach ($spellDataJSON as $spell)
							{
								echo '<div class="guidev2_spell_option spelltip" data-spell="' . $spell->name . '" data-valid="false" title="' . $spell->name . '">
										<img src="http://www.moba-champion.com/images/spells/Spell_' . $spell->name . '_1.png">
										<span>' . $spell->name . '</span>
									  </div>';
							}	
						?>
					</div>
					
					<div class="guidev2_spell_fullselector_picker_choices">
						<div class="guidev2_spell_fullselector_summary">0 / 3</div>
					</div>
					
					<div class="guidev2_spell_fullselector_accept" style="display: none;"><button class="btn btn-primary btn-large">Accept</button></div>
					<div class="guidev2_fullselector_close"><i class="fa fa-remove"> </i> Close</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Items -->
	<div id="guidev2_items" class="guidev2_section guidev2_content" data-contenttype="4" style="display: none;">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Items</div>
			<div class="guidev2_section_header_icon"><i class="fa fa-edit icon-white"></i></div>
		</div>
		<div class="guidev2_section_content clrfix">
		
			<!-- item rows are here -->
			<div class="guidev2_item_selector">
			
			<?php 
				$numItems = 0;
				if (!is_null($guide) && $guide->items > 0)
				{
					$items = R::load('guidev2item', $guide->items);
					if ($items->id >= 0)
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
			
			<?php
			
			if ($numItems == 7)
			{
				echo '<!-- add item button -->
						<div style="display: none;" id="guidev2_add_item" class="guidev2_add_button guidev2_tt_required" title="Add a Item Set"><i class="fa fa-plus"></i></div>';
			}
			else
			{
				echo '<!-- add item button -->
						<div id="guidev2_add_item" class="guidev2_add_button guidev2_tt_required" title="Add a Item Set"><i class="fa fa-plus"></i></div>';
			}
			
			echo '<script>var GuideNumItems = ' . $numItems . ';</script>';
			?>
			
			<!-- item selectors -->
			<div class="guidev2_item_fullselector guidev2_hidden">
				<div class="guidev2_fullselector_background"></div>
				<div class="guidev2_fullselector_picker guidev2_item_fullselector_picker">
				
					<div class="guidev2_items_radio btn-group">
						<button class="itemsfilterall btn">All</button>
						<button class="itemsfilterconsumable btn">Consumable</button>
						<button class="itemsfilterbasic btn">Basic</button>
						<button class="itemsfilteradvanced btn">Advanced</button>
						<button class="itemsfilterlegendary btn">Legendary</button>
					</div>
								
					<div class="guidev2_item_fullselector_picker_options clrfix">
						<?php
							$itemData = file_get_contents('../data/itempalooza.json');
							$itemDataJSON = json_decode($itemData);
					
							foreach ($itemDataJSON as $item)
							{
								echo '<div class="guidev2_item_option iptip" data-img="' . $item->img . '" title="' . $item->name . '" data-item="' . $item->name . '" data-valid="false" data-type="' . $item->type . '">
										<img src="' . $item->img . '">
									  </div>';
							}	
						?>
					</div>
					
					<hr class="guidev2_items_divider">
										
					<div class="guidev2_item_fullselector_picker_choices">
						<div class="guidev2_item_fullselector_summary">0 / 6</div>
					</div>
					
					<div class="guidev2_item_setname">
						<span class="set_name_lbl">Item Set Name:</span>
						<input id="guidev2_item_setname_val" type="shaper" name="guidetitle" maxlength="40">
						<div class="guidev2_item_fullselector_accept"><button class="btn btn-primary">Accept</button></div>
					</div>
				
					<div class="guidev2_fullselector_close"><i class="fa fa-remove"> </i> Close</div>
				</div>
			</div>
			
		</div>
	</div>
	
	<!-- Skill Order -->
	<div id="guidev2_skillorder" class="guidev2_section guidev2_content" data-contenttype="5" style="display: none;">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Skill Order</div>
			<div class="guidev2_section_header_icon"><i class="fa fa-edit icon-white"></i></div>
		</div>
		<div class="guidev2_section_content clrfix">
		
			<div style="position:relative;">
				<div class="guidev2_skillorder_switch">Switch to Advanced</div>
			</div>
													
<?php 
				$basicFound = false;
				$skillOrderDesc = "";
				$basicVisible = true;
				$basicOrder = "";
				
				if (!is_null($guide) && $guide->skillorder > 0)
				{
					$skillOrder = R::load('guidev2skillorder', $guide->skillorder);
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
					echo '<div class="guidev2_skillorder_basic">
						<p>Drag the spell icons below into your desired skill order, or switch to the advanced view for more fine-grained control.</p>
						<div class="guidev2_skillorder_icons">';
				}
				else
				{
					echo '<script>var GuideSkillOrderMode = 1;</script>';
					echo '<div class="guidev2_skillorder_basic" style="display: none;">
						<p>Drag the spell icons below into your desired skill order, or switch to the advanced view for more fine-grained control.</p>
						<div class="guidev2_skillorder_icons">';
				}
					
				if ($basicFound == false)
				{	
					echo '<script>var GuidePointAllocation = "";</script>';
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
			
			<div class="guidev2_skillorder_text">
				<textarea data-type="skillorder"><?php echo $skillOrderDesc; ?></textarea>
			</div>
			
		</div>
	</div>
	
	<!-- Abilities -->
	<div id="guidev2_abilities" class="guidev2_section guidev2_content" data-contenttype="6" style="display: none;">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Abilities</div>
			<div class="guidev2_section_header_icon"><i class="fa fa-edit icon-white"></i></div>
		</div>
		
		<div class="guidev2_section_content clrfix">
		
			<?php 
				$descp = "";
				$descq = "";
				$descw = "";
				$desce = "";
				$descr = "";
				
				if (!is_null($guide) && $guide->abilities > 0)
				{
					$abilities = R::load('guidev2abilities', $guide->abilities);
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
					}
				}
			?>
		
		<div class="guidev2_ability_row">
			<div class="guidev2_ability_left">
				<div class="guidev2_ability_img" data-shaper="Amarynth" title="p">
					<img id="guidev2_ability_p_img" src="http://www.moba-champion.com/images/shapers/amarynth/p.png">
				</div>
				<div id="guidev2_ability_p_text" class="guidev2_ability_header">Passive</div>
			</div>
			<div class="guidev2_ability_right"><textarea data-type="ability"><?php echo $descp; ?></textarea></div>
		</div>
		
		<div class="guidev2_ability_row">
			<div class="guidev2_ability_left">
				<div class="guidev2_ability_img" data-shaper="Amarynth" title="q">
					<img id="guidev2_ability_q_img" src="http://www.moba-champion.com/images/shapers/amarynth/q.png">
				</div>
				<div id="guidev2_ability_q_text" class="guidev2_ability_header">Q</div>
			</div>
			<div class="guidev2_ability_right"><textarea data-type="ability"><?php echo $descq; ?></textarea></div>
		</div>
		
		<div class="guidev2_ability_row">
			<div class="guidev2_ability_left">
				<div class="guidev2_ability_img" data-shaper="Amarynth" title="w">
					<img id="guidev2_ability_w_img" src="http://www.moba-champion.com/images/shapers/amarynth/w.png">
				</div>
				<div id="guidev2_ability_w_text" class="guidev2_ability_header">W</div>
			</div>
			<div class="guidev2_ability_right"><textarea data-type="ability"><?php echo $descw; ?></textarea></div>
		</div>
		
		<div class="guidev2_ability_row">
			<div class="guidev2_ability_left">
				<div class="guidev2_ability_img" data-shaper="Amarynth" title="e">
					<img id="guidev2_ability_e_img" src="http://www.moba-champion.com/images/shapers/amarynth/e.png">
				</div>
				<div id="guidev2_ability_e_text" class="guidev2_ability_header">E</div>
			</div>
			<div class="guidev2_ability_right"><textarea data-type="ability"><?php echo $desce; ?></textarea></div>
		</div>

		<div class="guidev2_ability_row">
			<div class="guidev2_ability_left">
				<div class="guidev2_ability_img" data-shaper="Amarynth" title="r">
					<img id="guidev2_ability_r_img" src="http://www.moba-champion.com/images/shapers/amarynth/r.png">
				</div>
				<div id="guidev2_ability_r_text" class="guidev2_ability_header">R</div>
			</div>
			<div class="guidev2_ability_right"><textarea data-type="ability"><?php echo $descr; ?></textarea></div>
		</div>
			
		</div>
	</div>
	
	<!-- Customs -->
	<?php
		if (!is_null($guide) && $guide->customs != "")
		{
			$customs = explode(',', $guide->customs);
			foreach($customs as $custom)
			{
				$customSection = R::load('guidev2custom', $custom);
				if ($customSection->id >= 0)
				{
					echo '<div class="guidev2_section guidev2_content guidev2_custom_section" data-contenttype="7" data-id="' . $customSection->id . '">
						<div class="guidev2_section_header clrfix custom_add_removal">                             
							<div class="guidev2_section_header_text"><input value="' . $customSection->title . '"/></div>      
							<div class="guidev2_section_header_icon section_delete add_custom_delete_handler"><i class="fa fa-times"></i></div>
						</div>
						<div class="guidev2_section_content clrfix" style="padding-right: 16px;">
							<textarea data-type="custom">' . $customSection->desc . '</textarea>
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
			<div class="guidev2_section_header_icon"><i class="fa fa-edit icon-white"></i></div>
		</div>
		<div class="guidev2_section_content clrfix">
		
		<h3>Coming Soon!</h3>
			
		</div>
	</div>
	
	<!-- debug -->
	<div id="guidev2_debug" class="guidev2_section" style="display: none;">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Debug</div>
			<div class="guidev2_section_header_icon"><i class="fa fa-edit icon-white"></i></div>
		</div>
		<div id="guidev2_debug_area" class="guidev2_section_content clrfix">
		
			
			
		</div>
	</div>
	
	<!-- Publish2 -->
	<div id="guidev2_publish2" class="guidev2_section" style="display: none;">
		<div class="guidev2_section_header">
			<div class="guidev2_section_header_text">Quick Save</div>
		</div>
		<div class="guidev2_section_content clrfix">
					
			<button class="guidev2_publish_btn btn btn-primary" type="button">Save Guide</button>
			<img src="http://www.moba-champion.com/guides/img/spinner.gif" class="guide_settings_spinner" style="display: none;">
			
			<div class="guidev2_save_errors">
				
			</div>
			
		</div>
	</div>
	
</div> <!-- guidev2_editor -->

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
