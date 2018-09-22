<?php
$theShaper = 'Vex';
$theShaperSmall = 'vex';

$moba_champ_title = 'MOBA-Champion - ' . $theShaper . ' Info, Statistics, Bio and Guides';
$moba_champ_desc = $theShaper . ' info, statistics, bio, guides and recommended items. MOBA-Champion!';
include('../../header.php');
?>

<script src="../shapervideos.js"></script>

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<?php
$shaperData = file_get_contents('../../data/shaperdata.json');
$shaperDataJSON = json_decode($shaperData);
$shaperIndex = 0;

foreach ($shaperDataJSON as $shaper_entry)
{
	if ($shaper_entry->name == $theShaper)
	{
		break;
	}
	
	$shaperIndex++;
}

$theShaperData = $shaperDataJSON[$shaperIndex];
			
echo '<div class="shaper_header_art" id="' . $theShaperSmall . '_art_header">
	<h1>' . $theShaperData->name . '</h1>
	<h3>' . $theShaperData->title . '</h3>
	</div>';
?>

<div class="shaper_tabbable_area">

<div class="tabbable">
  <ul class="nav nav-tabs">
    <li class="active extra_space_tab"><a href="#pane1" data-toggle="tab">Overview</a></li>
	<li class="extra_space_tab"><a href="#pane3" data-toggle="tab">Recommended Items</a></li>
    <li class="extra_space_tab"><a href="#pane4" data-toggle="tab">Guides</a></li>
  </ul>
  <div class="tab-content fancy_bordered" >
  
    <div id="pane1" class="tab-pane active shaper_area">
	
		<div class="shaper_area_overview_header">
			<div class="shaper_area_overview_left">
				<?php 
					echo '<p><b>Archetype: </b>' . $theShaperData->role . '</p>';
					echo '<p><b>Recommended Role: </b>' . $theShaperData->recommended_role . '</p>'; 
				?>
			</div>

			<?php include('../arch_' . $theShaperData->archtype . '.php'); ?>
		</div>
		
<?php
	$abilityKeys = array("p", "q", "w", "e", "r" );
	foreach ($abilityKeys as $abilityKey)
	{
		$nameKey = "skill_" . $abilityKey;
		$descKey = "desc_" . $abilityKey;
		$videoKey = "video_" . $abilityKey;
		$imgKey = "thumb_" . $abilityKey;
		$rangeKey = "range_" . $abilityKey;
		$cdKey = "cd_" . $abilityKey;
		
		echo '<div class="shaper_ability_row">
				<div class="shaper_ability_row_c1"><img src="http://www.moba-champion.com/images/shapers/' . $theShaperSmall . '/' . $abilityKey . '.png">';
		
		if ($abilityKey != "p")
		{
			echo '<div class="shaper_ability_row_key">' . strtoupper ($abilityKey) . '</div>';
		}
		else
		{
			echo '<div class="shaper_ability_row_key">Passive</div>';
		}
		
		echo '</div>';
		
		echo '  <div class="shaper_ability_row_c2">';
		echo   '<div class="shaper_ability_row_c2_header">' . $theShaperData->$nameKey . '</div>';
		echo   '<div class="shaper_ability_row_c2_ability">' . $theShaperData->$descKey . '</div>';
		if ($abilityKey != "p")
		{		
			echo '<div class="ability_costs">
						<table>
						<tr><td>Range:</td>		<td>' . $theShaperData->$rangeKey . '</td></tr>
						<tr><td>Cooldown:</td>	<td>' . $theShaperData->$cdKey . '</td></tr>
						</table>
					</div>';
		}				
		echo '</div>';
		echo  '<div class="shaper_ability_row_c3">';
		if ($theShaperData->$videoKey != "")
		{
			echo '<img src="' . $theShaperData->$imgKey . '">';
			echo '<div class="shaper_ability_row_c3_text"><i class="icon-play"></i></div>';
			echo '<div class="shaper_ability_row_c3_overlay overlay_' . $abilityKey . '"></div>';
		}
		echo '</div></div>';
		
		// create hidden frame
		echo '<div class="shaper_ability_hidden guide_hidden video_' . $abilityKey . '">';
		echo '<div class="shaper_ability_hidden_bg">';
		echo '</div>';
		echo '<div class="shaper_ability_hidden_video">';
			echo '<iframe width="560" height="315" src="' . $theShaperData->$videoKey . '" frameborder="0" allowfullscreen></iframe>';
			echo '<div class="shaper_video_close"><i class="icon-remove"> </i> Close</div>';
		echo '</div>';
		echo '</div>';		
	}

	echo '</div>';
			
?>
	
	<div id="pane3" class="tab-pane shaper_area">
		<h4>Starting Items</h4>
			<img src="http://www.moba-champion.com/images/items/Basic_Power.png" class="mobatip" title="Power">
			<img src="http://www.moba-champion.com/images/items/Consumable_Potion_HealingPotion.png" class="mobatip" title="Healing Potion x3">
		<h4>Core</h4>
			<img src="http://www.moba-champion.com/images/items/Legendary_Destruction.png" class="mobatip" title="Destruction">
			<img src="http://www.moba-champion.com/images/items/Legendary_Voracity.png" class="mobatip" title="Voracity">		
			<img src="http://www.moba-champion.com/images/items/Legendary_Rage.png" class="mobatip" title="Rage">
		<h4>Offensive</h4>
			<img src="http://www.moba-champion.com/images/items/Legendary_Chaos.png" class="mobatip" title="Chaos">		
			<img src="http://www.moba-champion.com/images/items/Legendary_Pain.png" class="mobatip" title="Pain">		
		<h4>Defensive</h4>
			<img src="http://www.moba-champion.com/images/items/Legendary_Rampancy.png" class="mobatip" title="Rampancy">		
			<img src="http://www.moba-champion.com/images/items/Legendary_Ambition.png" class="mobatip" title="Ambition">		
    </div>
	
    <div id="pane4" class="tab-pane shaper_area">
<?php
$shaper = 'Vex';
include('../guide_tab.php');
?>
    </div>
		
  </div><!-- /.tab-content -->
</div><!-- /.tabbable -->

</div>
</div>

<div class="article_column2">
<?php 
include('../../widgets/shaperwidget.php');
include('../../widgets/adwidget.php');
include('../../widgets/streamwidget.php');
include('../../widgets/guidewidget.php');
?>
</div>

</div> <!-- main container -->
</div> <!-- maincontent -->

<?php
include('../../footer.php');
?>