<?php
$usePerksEditorCSS = true;
$moba_champ_title = 'MOBA-Champion - Loadout Editor';
$moba_champ_desc = 'Interactive Dawngate Loadout Editor';
$msTheorycrafting = true;
$msLoadouts = true;
include('../header.php');
$loadout = isset($_GET["l"]) ? $_GET["l"] : null;
?>

<script src="js/loadouts.js?v=3"></script>

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">
<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Loadout Editor</div></div></div>
<div class="news_content_noborder">

<!--
<div id="debug_window" style="min-width: 75px; min-height: 48px; position: fixed; bottom: 0px; left: 0px; background: #000">test</div>
-->

<div class="article_news">

<?php
	
	$loadoutIdValid = false;
	$favoriteCheck = "";
	
	$loadoutUrl = "http://www.moba-champion.com/loadouts/";
	if (!is_null($loadout))
	{
		$loadoutBean = R::load('loadout', $loadout);
		if (!is_null($loadout))
		{
			$loadoutIdValid = true;
			$loadoutUrl .= $loadout;
			$loadoutStr = $loadoutBean->fullstr;
			
			$author = "";
			if ($context['user']['is_logged'])
			{
				$author = $context['user']['name'];
				
				// find the loadout bean
				$favBean = R::findOne('loadoutfav',' loadout = :loadout AND author = :author ',
					array(':loadout'=>$loadoutBean->id,':author'=>$author));
					
				if (!is_null($favBean))
				{
					$favoriteCheck = ' <i class="fa fa-check"></i>';
				}
			}
						
		echo '
<script>
function AddShapesFromURL()
{' . PHP_EOL;
		
		$shapes = explode("_", $loadoutStr);
		foreach ($shapes as $shape)
		{		
			if ($shape != "")
			{
echo '	AddShape("' . $shape . '");' . PHP_EOL;
			}
		}
echo '
}
</script>' . PHP_EOL;

		}
	}
	else
	{
	}
	
	if ($loadoutIdValid == true)
	{
		echo '<script>var LoadoutSaveId = ' . $loadout . '</script>';
	}
	else
	{
		echo '<script>var LoadoutSaveId = -1;</script>';
	}
	
	echo '<div class="loadout_editor">';
		echo '<div class="loadout_editor_top">';
			echo '<input class="loadout_editor_save_url_input" value="' . $loadoutUrl . '" type="loadout" style="display: none;"></input>';
			echo '<div class="loadout_editor_save_url_upd" style="display: none;">';
			echo 'Loadout url updated!';
			echo '</div>';
		echo '</div>';
		echo '<div class="loadout_editor_main">';
			echo '<div class="loadout_editor_left">';
			echo '</div>';
			echo '<div class="loadout_editor_right">';
				echo '<div class="loadout_editor_summary_header">';
					echo '<div class="loadout_editor_summary_header_text">';
						echo 'Loadout Statistics';
					echo '</div>';
				echo '</div>';
				echo '<div class="loadout_editor_summary_content">';

				echo '</div>';
				echo '<div class="loadout_editor_summary_buttons">';
					echo '<div class="std_button loadout_editor_button_save">SHARE</div>';
					echo '<div class="std_button loadout_editor_button_clear">CLEAR</div>';
					echo '<div class="std_button loadout_editor_button_favorite">FAVORITE' . $favoriteCheck . '</div>';
					echo '<div class="std_button loadout_editor_button_myfavs"><a style="color: white;" href="http://www.moba-champion.com/loadouts/favorites.php">MY FAVORITES</a></div>';
				echo '</div>';
			echo '</div>';
			
			echo '<div class="loadout_editor_bottom">';
			echo '<div class="loadout_editor_bottom_header">';
				
			echo '<div class="loadout_editor_filterlist">
					<div class="loadout_editor_filter active_filter" filter="Special" title="Special"><img src="http://www.moba-champion.com/loadouts/editor/ui_special.png"></div>
					<div class="loadout_editor_filter" filter="Health" title="Health"><img src="http://www.moba-champion.com/loadouts/editor/ui_health.png"></div>
					<div class="loadout_editor_filter" filter="Mitigation" title="Mitigation"><img src="http://www.moba-champion.com/loadouts/editor/ui_mitigation.png"></div>
					<div class="loadout_editor_filter" filter="Offense" title="Offense"><img src="http://www.moba-champion.com/loadouts/editor/ui_offense.png"></div>
					<div class="loadout_editor_filter" filter="Utility" title="Utility"><img src="http://www.moba-champion.com/loadouts/editor/ui_utility.png"></div>
				</div>';
				
			echo '<div class="loadout_editor_controllist">
					<div class="loadout_editor_control">Controls</div>
				</div>';				
			
			echo '</div>';
					
			echo '<div class="loadout_editor_bottom_content">';
					
			$shapeData = file_get_contents('shapes.json');
			$shapeDataJSON = json_decode($shapeData);
			
			foreach ($shapeDataJSON->special as $shapeEntry)
			{
				echo '<div class="loadout_editor_mini_shape" id="' . $shapeEntry->id . '" filter="Special" path="' . $shapeEntry->img . '" area="' . $shapeEntry->area . '" stat="' . $shapeEntry->bonus . '" title="' . $shapeEntry->name . '" name="' . $shapeEntry->name . '">';
					echo '<div class="loadout_editor_mini_shape_img">
						<img src="http://www.moba-champion.com/loadouts/' . $shapeEntry->img . '_mini.png">';
						foreach ($shapeEntry->gems as $gem)
						{
							$offsets = explode(",", $gem->offset);
							echo '<div class="loadout_editor_mini_shape_gem" color="' . $gem->color . '" offset="' . $gem->offset . '" pos="' . $gem->pos . '">';
							echo '<img src="http://www.moba-champion.com/loadouts/gemslot/' . $gem->color . '_mini.png" style="left: ' . ($offsets[0]*16) . 'px; top: ' . ($offsets[1]*16) . 'px">';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			}
			
			foreach ($shapeDataJSON->health as $shapeEntry)
			{
				echo '<div class="loadout_editor_mini_shape" id="' . $shapeEntry->id . '" filter="Health" path="' . $shapeEntry->img . '" area="' . $shapeEntry->area . '" stat="' . $shapeEntry->bonus . '" title="' . $shapeEntry->name . '" name="' . $shapeEntry->name . '" style="display: none;">';
					echo '<div class="loadout_editor_mini_shape_img">
						<img src="http://www.moba-champion.com/loadouts/' . $shapeEntry->img . '_mini.png">';
						foreach ($shapeEntry->gems as $gem)
						{
							$offsets = explode(",", $gem->offset);
							echo '<div class="loadout_editor_mini_shape_gem" color="' . $gem->color . '" offset="' . $gem->offset . '" pos="' . $gem->pos . '">';
							echo '<img src="http://www.moba-champion.com/loadouts/gemslot/' . $gem->color . '_mini.png" style="left: ' . ($offsets[0]*16) . 'px; top: ' . ($offsets[1]*16) . 'px">';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			}
			
			foreach ($shapeDataJSON->mitigation as $shapeEntry)
			{
				echo '<div class="loadout_editor_mini_shape" id="' . $shapeEntry->id . '" filter="Mitigation" path="' . $shapeEntry->img . '" area="' . $shapeEntry->area . '" stat="' . $shapeEntry->bonus . '" title="' . $shapeEntry->name . '" name="' . $shapeEntry->name . '" style="display: none;">';
					echo '<div class="loadout_editor_mini_shape_img">
						<img src="http://www.moba-champion.com/loadouts/' . $shapeEntry->img . '_mini.png">';
						foreach ($shapeEntry->gems as $gem)
						{
							$offsets = explode(",", $gem->offset);
							echo '<div class="loadout_editor_mini_shape_gem" color="' . $gem->color . '" offset="' . $gem->offset . '" pos="' . $gem->pos . '">';
							echo '<img src="http://www.moba-champion.com/loadouts/gemslot/' . $gem->color . '_mini.png" style="left: ' . ($offsets[0]*16) . 'px; top: ' . ($offsets[1]*16) . 'px">';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			}
			
			foreach ($shapeDataJSON->offense as $shapeEntry)
			{
				echo '<div class="loadout_editor_mini_shape" id="' . $shapeEntry->id . '" filter="Offense" path="' . $shapeEntry->img . '" area="' . $shapeEntry->area . '" stat="' . $shapeEntry->bonus . '" title="' . $shapeEntry->name . '" name="' . $shapeEntry->name . '" style="display: none;">';
					echo '<div class="loadout_editor_mini_shape_img">
						<img src="http://www.moba-champion.com/loadouts/' . $shapeEntry->img . '_mini.png">';
						foreach ($shapeEntry->gems as $gem)
						{
							$offsets = explode(",", $gem->offset);
							echo '<div class="loadout_editor_mini_shape_gem" color="' . $gem->color . '" offset="' . $gem->offset . '" pos="' . $gem->pos . '">';
							echo '<img src="http://www.moba-champion.com/loadouts/gemslot/' . $gem->color . '_mini.png" style="left: ' . ($offsets[0]*16) . 'px; top: ' . ($offsets[1]*16) . 'px">';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			}
			
			foreach ($shapeDataJSON->utility as $shapeEntry)
			{
				echo '<div class="loadout_editor_mini_shape" id="' . $shapeEntry->id . '" filter="Utility" path="' . $shapeEntry->img . '" area="' . $shapeEntry->area . '" stat="' . $shapeEntry->bonus . '" title="' . $shapeEntry->name . '" name="' . $shapeEntry->name . '" style="display: none;">';
					echo '<div class="loadout_editor_mini_shape_img">
						<img src="http://www.moba-champion.com/loadouts/' . $shapeEntry->img . '_mini.png">';
						foreach ($shapeEntry->gems as $gem)
						{
							$offsets = explode(",", $gem->offset);
							echo '<div class="loadout_editor_mini_shape_gem" color="' . $gem->color . '" offset="' . $gem->offset . '" pos="' . $gem->pos . '">';
							echo '<img src="http://www.moba-champion.com/loadouts/gemslot/' . $gem->color . '_mini.png" style="left: ' . ($offsets[0]*16) . 'px; top: ' . ($offsets[1]*16) . 'px">';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			}
						
			echo '</div>'; // bottom content
			echo '</div>'; // bottom
		
		echo '</div>'; // main
		
	echo '</div>'; // loadout editor
	
	echo '
	<div class="gem_picker_window" style="display: none;">
		<div class="gem_picker_background"></div>
		<div class="gem_picker">
			<div class="gemtypes_radio btn-group">
				<button class="gemfilterall btn">All</button>
				<button class="gemfiltergreen btn">Offense</button>
				<button class="gemfilterred btn">Defense</button>
				<button class="gemfilterblue btn">Utility</button>
			</div>
			
			<div class="gem_picker_list">';
				
			$gemData = file_get_contents('gems.json');
			$gemDataJSON = json_decode($gemData);
			
			foreach ($gemDataJSON as $gem)
			{
				$gemBonus = str_replace(" Percent", "%", $gem->bonus);
				$gemBonus = str_replace("-", " ", $gemBonus);
				
				echo '<div class="gem_picker_gem" id="' . $gem->id . '" color="' . $gem->color . '" bonus="' . $gem->bonus . '" name="' . $gem->name . '" path="' . $gem->img . '">
						<div class="gem_picker_gem_img">
							<img src="http://www.moba-champion.com/loadouts/gems/' . $gem->img . '.png">
						</div>
						<div class="gem_picker_gem_body">
							<div class="gem_picker_gem_name">' . $gem->name . '</div>
							<div class="gem_picker_gem_text">' . $gemBonus . '</div>
						</div>
					  </div>';
			}
				
				
echo'		</div>
			
			<div class="gem_picker_close"><i class="fa fa-times"> </i> Close</div>
		</div>
	</div>';

?>

</div>
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
