<?php
$usePerksEditorCSS = true;
$moba_champ_title = 'MOBA-Champion - Favorite Loadouts';
$moba_champ_desc = 'Favorite Loadouts';
include('../header.php');
?>

<script src="js/debug.js?v=1"></script>

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">
<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Favorite Loadouts</div></div></div>
<div class="news_content">

<div class="article_news">

<?php

$shapeData = file_get_contents('shapes.json');
$shapeDataJSON = json_decode($shapeData);

$gemData = file_get_contents('gems.json');
$gemDataJSON = json_decode($gemData);

$shaperData = file_get_contents('../data/shaperdata.json');
$shaperDataJSON = json_decode($shaperData);

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
						if ($gem->id == $strs[$i])
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
					echo '<div class="guidev2_loadout_fullselector_stat2 stonetip" title="' . substr($res[$i],2) . '">' . substr($res[$i],2) . '</div>';
				}
				else
				{
					echo '<div class="guidev2_loadout_fullselector_stat2">+' . $res[$i] . '</div>';
				}
			}
		}
	}
}

	$author = $_GET["author"];
	if (!is_null($author))
	{	
		// find the loadout bean
		$favBean = R::find('loadoutfav',' author = ? ', array( $author ));
		if (count($favBean) > 0)
		{
			foreach ($favBean as $bean)
			{
				echo '<div class="favorite_loadout_row clrfix" style="float: left;">';
				
				$beanImg = "";
				if (!is_null($bean->shaper))
				{
					$beanImg = '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($bean->shaper) . '.png" class="loadout_shaper_small">';
				}
				
				if (!is_null($bean->title))
				{
					echo '<h5>' . $beanImg . ' ' . $bean->title .' (<a href="http://www.moba-champion.com/loadouts/index.php?l=' . $bean->loadout . '">View in Editor</a>)</h5>';
				}
				else
				{
					echo '<h5>' . $beanImg . ' Loadout #' . $bean->loadout . ' (<a href="http://www.moba-champion.com/loadouts/index.php?l=' . $bean->loadout . '">View in Editor</a>)</h5>';
				}
						CreateLoadoutQuick($bean->loadout);
				echo '</div>';
			}
			
			echo '<h5>Share Link:</h5>';
			echo '<input id="loadouturl" class="pull-left" style="cursor: text; width: 580px; height: 24px;" type="text" value="http://www.moba-champion.com/loadouts/favorites.php?author=' . $author . '" readonly />
					<button style="margin-left: 8px; height: 34px;" class="btn btn-primary pull-left" id="copybtn">Copy</button>';
			echo '<script>
					//add event listener
					$("#copybtn").click(function()
					{
						window.prompt("Copy to clipboard: Ctrl+C, Enter", $("#loadouturl").val());
					});
			</script>';
		}
	}
	else if ($context['user']['is_logged'])
	{
		$author = $context['user']['name'];
		
		// find the loadout bean
		$favBean = R::find('loadoutfav',' author = ? ', array( $author ));
		
		if (count($favBean) > 0)
		{
			foreach ($favBean as $bean)
			{
				echo '<div class="favorite_loadout_row clrfix" style="float: left;">';
				if (!is_null($bean->title))
				{
					echo '<h5>' . $bean->title .' (<a href="http://www.moba-champion.com/loadouts/index.php?l=' . $bean->loadout . '">View in Editor</a>)</h5>';
				}
				else
				{
					echo '<h5>Loadout #' . $bean->loadout . ' (<a href="http://www.moba-champion.com/loadouts/index.php?l=' . $bean->loadout . '">View in Editor</a>)</h5>';
				}
				
					CreateLoadoutQuick($bean->loadout);
						echo '
						<div style="float: left; width: 800px">
						<select class="pull-left" style="width: 200px; height: 34px; margin-right: 8px;">
						<option value="all">Select a Shaper...</option>';
							foreach ($shaperDataJSON as $shaper_entry)
							{
								$smallName = strtolower($shaper_entry->name);
								echo '<option ';
								
								if ($shaper_entry->name == $bean->shaper)
								{
									echo 'selected ';
								}
								
								echo 'value="' . $shaper_entry->name . '">' . $shaper_entry->name . '</option>';
							}	
					echo '</select>
						   <input class="pull-left" style="cursor: text; width: 300px; height: 24px;" type="text" placeholder="Name your loadout..." value="' . $bean->title . '" />
						   <button class="btn btn-primary pull-left changeShaper" data-id="' . $bean->loadout . '" style="margin-left: 8px; height: 32px;">Update Loadout</button>
							<div class="loadout_update_results" style="padding-top: 4px; margin-left: 8px; width:24px; float: left;"></div>
						</div>';
				echo '</div>';
			}
			
			echo '<h5>Share Link:</h5>';
			echo '<input id="loadouturl" class="pull-left" style="cursor: text; width: 580px; height: 24px;" type="text" value="http://www.moba-champion.com/loadouts/favorites.php?author=' . $author . '" readonly />
					<button style="margin-left: 8px; height: 34px;" class="btn btn-primary pull-left" id="copybtn">Copy</button>';
			echo '<script>
					var favActionInProgress = false;
					
					//add event listener
					$("#copybtn").click(function()
					{
						window.prompt("Copy to clipboard: Ctrl+C, Enter", $("#loadouturl").val());
					});
					
					$(".changeShaper").click(function()
					{
						if (favActionInProgress == false)
						{
							var me = this;
							$(me).parent().children(".loadout_update_results").html("");
							favActionInProgress = true;
							var url = "updatefavoriteaction.php";
							
							var loadout = $(this).data("id");
							var shaper = $(this).parent().children("select").val();
							var title = $(this).parent().children("input").val();
							
							$.post(url,
							{ 
								loadout : loadout,
								shaper : shaper,
								title : title
							},
							function(data) 
							{	
								console.log(data);
								favActionInProgress = false;
								var results = jQuery.parseJSON(data);
								if (results.returnid > 0)
								{
									$(me).parent().children(".loadout_update_results").html("<i class=\"icon-ok\"></i>");
								}
								else if (results.returnid == -2)
								{
									alert(results.message);
								}
								else
								{
									$(me).parent().children(".loadout_update_results").html("<i class=\"icon-remove\"></i>");
								}
							})
							.error(function() 
							{ 
								favActionInProgress = false;
							});
						}
					});
			</script>';
		}
	}
	else
	{
		echo '<p>You must be logged in to have Favorite Loadouts. Please log in or <a href="http://moba-champion.com/forum/index.php?action=register">Register</a>.</p>';
	}
?>

</div> <!-- article news -->
</div> <!-- news content -->
</div> <!-- news post -->
</div> <!-- article_content-->

<div class="article_column2">
<?php 

if ($user_info['is_admin'])
{	
	echo '<div class="mobawidget">
		<div class="widget_header">
			<div class="widget_header_text">Debug</div>	
		</div>
		
		<div class="widget_debug_rows" style="color: white;">
			<script>
				function UpdateDebugRows()
				{
					$(".widget_debug_rows").empty();
					
					var html = "";
					
					for (i = 0; i < 4 ; i++)
					{
						for (j = 0; j < 4; j++)
						{
							html += shapes[i][j];
						}
						
						html += "<BR>";
					}
					
					$(".widget_debug_rows").html(html);
				}
			</script>
		</div>
	</div>';
}
else
{
echo'
<script>
	function UpdateDebugRows()
	{
	
	}
</script>';
}

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
