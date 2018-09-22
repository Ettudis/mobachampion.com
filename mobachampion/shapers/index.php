<?php

$getShaper = isset($_GET['shaper']) ? $_GET['shaper'] : "";
$theShaperSmall = strtolower($getShaper);
$theShaper = ucwords($theShaperSmall);
$theShaper = str_replace("Of", "of", $theShaper); // hack

$moba_champ_title = 'MOBA-Champion - ' . $theShaper . ' Info, Statistics, Bio and Guides';
$moba_champ_desc = $theShaper . ' info, statistics, bio, guides and recommended items. MOBA-Champion!';

$includeMixitUp = true;
$msGameInfo = true;
$msShapers = true;
include('../header.php');
?>

<script src="shapervideos.js"></script>

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<?php

$foundShaper = false;
$secretShaper = false;
$shaperData = null;
$shaperDataJSON = null;

if (in_array($theShaper, $DB_ShaperList))
{
	$foundShaper = true;
	$shaperData = file_get_contents('../data/shaperdata.json');
	$shaperDataJSON = json_decode($shaperData);
	
	$youtubeData = file_get_contents('../data/youtube.json');
	$youtubeDataJSON = json_decode($youtubeData);
	
}
else if ($context['user']['is_logged'] && $user_info['is_admin'] && in_array($theShaper, $DB_Unreleased))
{
	$secretShaper = true;
	$shaperData = file_get_contents('../data/__G2fzcn2487Xf.json');
	$shaperDataJSON = json_decode($shaperData);
	
	$youtubeData = file_get_contents('../data/youtube.json');
	$youtubeDataJSON = json_decode($youtubeData);
}
else
{
echo '

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Shapers</div></div></div>
<div class="news_content">
		
		<div class="guide_filter clrfix" id="filter_area">
			<div class="guide_filter_archetypes">
				<div class="btn-group guide_filter_fleft">
				  <button class="btn active" data-filter="all" data-dimension="archtype">All</button>
				  <button class="btn" data-filter="Mage" data-dimension="archtype">Mage</button>
				  <button class="btn" data-filter="Support" data-dimension="archtype">Support</button>
				  <button class="btn" data-filter="Carry" data-dimension="archtype">Carry</button>
				  <button class="btn" data-filter="Bruiser" data-dimension="archtype">Bruiser</button>
				  <button class="btn" data-filter="Tank" data-dimension="archtype">Tank</button>
				  <button class="btn" data-filter="Assassin" data-dimension="archtype">Assassin</button>
				</div>
				
				<div class="btn-group guide_filter_fleft">
				  <button class="btn active" data-filter="all" data-dimension="range">All</button>
				  <button class="btn" data-filter="Ranged" data-dimension="range">Ranged</button>
				  <button class="btn" data-filter="Melee" data-dimension="range">Melee</button>
				</div>

				</div>
		</div>
		
		<!-- GRID -->
		<div id="Grid">
		
		<div class="fail_element">Sorry &mdash; we could not find any Shapers matching these criteria.</div>';
		
			$shaperData = file_get_contents('../data/shaperdata.json');
			$shaperDataJSON = json_decode($shaperData);
			
			foreach ($shaperDataJSON as $shaper_entry)
			{
				$smallName = strtolower($shaper_entry->name);
				
				echo '<li class="mix ' . $shaper_entry->role . '" data-cat="1">';

				echo '<a href="http://www.moba-champion.com/shapers/' . $smallName . '"/>
					 <div class="guide_shaper_link">
						<ul><li><img src="http://www.moba-champion.com/images/shapers/' . $smallName . '.png" class="img-rounded"></li><li>' . $shaper_entry->name . '</li></ul>
					 </div>
					 </a>';
				
				echo '</li>';
			}
		echo '</div></div>';

	echo '</div>';
	include('../widgets/adwidget2.php');
	echo '</div>';
	
	echo '<div class="article_column2">';
	include('../widgets/shaperwidget.php');
	include('../widgets/adwidget.php');
	include('../widgets/streamwidget.php');
	include('../widgets/guidewidget.php');
	echo '</div></div></div>';

	include('../footer.php');
	return;
}

$shaperIndex = 0;

foreach ($shaperDataJSON as $shaper_entry)
{
	if ($shaper_entry->name == $theShaper)
	{
		break;
	}
	
	$shaperIndex++;
}

$ytData = null;
foreach ($youtubeDataJSON as $yt)
{
	if ($yt->shaper == $theShaper)
	{
		$ytData = $yt;
		break;
	}
}

$theShaperData = $shaperDataJSON[$shaperIndex];

$imgPaths = $theShaperSmall;
if (isset($theShaperData->hash) && $theShaperData->hash != "")
{
	$imgPaths = $theShaperData->hash;
}

if (isset($theShaperData->releasecontrol) && $theShaperData->releasecontrol != "")
{
	$imgPaths = $theShaperData->releasecontrol;
}
			
echo '<div class="shaper_header_art" style="background-image: url(\'http://www.moba-champion.com/images/shapers/' . $imgPaths . '/header.jpg\');background-repeat: no-repeat;">
	<h1>' . $theShaperData->name . '</h1>
	<h3>' . $theShaperData->title . '</h3>
	</div>';
?>

<div class="shaper_tabbable_area">

<div class="tabbable">
  <ul class="nav nav-tabs">
    <li class="active extra_space_tab"><a href="#pane1" data-toggle="tab">Overview</a></li>
	<li class="extra_space_tab"><a href="#pane2" data-toggle="tab">Patch History</a></li>
    <li class="extra_space_tab"><a href="#pane4" data-toggle="tab">Guides</a></li>
	<li class="extra_space_tab"><a href="#pane3" data-toggle="tab">Lore</a></li>
  </ul>
  
  <div class="tab-content fancy_bordered" >
  
    <div id="pane1" class="tab-pane active shaper_area">
	
		<div class="shaper_area_overview_header">
			<div class="shaper_area_overview_left">
				<?php 
					echo '<p><b>Archetype: </b>' . $theShaperData->role . '</p>';
					echo '<p><b>Recommended Role: </b>' . $theShaperData->recommended_role . '</p>';
					echo '<p><b>Price: </b>
							<img src="http://moba-champion.com/images/icons/icon_destiny.png" width="16" height="16"> ';
					echo $theShaperData->price;
					echo ' or <img src="http://moba-champion.com/images/icons/icon_waypoints.png" width="16" height="16"> ';
					echo '685';
				?>
			</div>

			<?php include('arch_' . $theShaperData->archtype . '.php'); ?>
		</div>
		
<?php
	$abilityKeys = array("p", "q", "w", "e", "r" );
	foreach ($abilityKeys as $abilityKey)
	{
		$nameKey = "skill_" . $abilityKey;
		$descKey = "desc_" . $abilityKey;
		$rangeKey = "range_" . $abilityKey;
		$cdKey = "cd_" . $abilityKey;
		$costKey = "cost_" . $abilityKey;
		$costType = "cost_type_" . $abilityKey;
		
		echo '<div class="shaper_ability_row">
				<div class="shaper_ability_row_c1"><img src="http://www.moba-champion.com/images/shapers/' . $imgPaths . '/' . $abilityKey . '.png">';
		
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
						<table>';
						if (isset($theShaperData->$costType) && $theShaperData->$costType != "")
						{
							echo '<tr><td><b>' . $theShaperData->$costType . ' Cost:</b></td>		<td>' . (isset($theShaperData->$costKey) ? $theShaperData->$costKey : "") . '</td></tr>';
						}
						else
						{
							echo '<tr><td><b>Cost:</b></td>		<td>' . (isset($theShaperData->$costKey) ? $theShaperData->$costKey : "") . '</td></tr>';
						}
			echo '		<tr><td><b>Range:</b></td>		<td>' . $theShaperData->$rangeKey . '</td></tr>
						<tr><td><b>Cooldown:</b></td>	<td>' . $theShaperData->$cdKey . '</td></tr>
						</table>
					</div>';
		}				
		echo '</div>';
		echo  '<div class="shaper_ability_row_c3">';
		
		if ($ytData != null && $ytData->$abilityKey != "")
		{
			echo '<img src="http://i1.ytimg.com/vi/' . $ytData->$abilityKey . '/mqdefault.jpg">';
			echo '<div class="shaper_ability_row_c3_text"><i class="fa fa-play"></i></div>';
			echo '<div class="shaper_ability_row_c3_overlay overlay_' . $abilityKey . '"></div>';
		}
		
		echo '</div></div>';
		
		// create hidden frame
		if ($ytData != null && $ytData->$abilityKey != "")
		{
			echo '<div class="shaper_ability_hidden guide_hidden video_' . $abilityKey . '">';
			echo '<div class="shaper_ability_hidden_bg">';
			echo '</div>';
			echo '<div class="shaper_ability_hidden_video">';
				echo '<iframe width="560" height="315" src="http://www.youtube.com/embed/' . $ytData->$abilityKey . '" frameborder="0" allowfullscreen></iframe>';
				echo '<div class="shaper_video_close"><i class="fa fa-times"> </i> Close</div>';
			echo '</div>';
			echo '</div>';	
		}	
	}

	echo '</div>';
			
?>
				
    <div id="pane4" class="tab-pane shaper_area">

<?php
$shaper = $theShaper;
include('guide_tab.php');
?>
	
    </div>
	
	<div id="pane2" class="tab-pane shaper_area">
<?php
	$shaperNotePath = '../patch/output/' . strtolower($theShaperSmall) . '.php';
	if (file_exists($shaperNotePath) && filesize($shaperNotePath) > 0)
	{
		echo '<div class="patchnotes waystone_regtext">';
		include($shaperNotePath);
		echo '</div>';
	}
	else
	{
		echo '<p>Patch data was not found. Maybe the ID specified is bad, or has not undergone any patch changes?</p>';
	}
?>
	</div>
	
	<div id="pane3" class="tab-pane shaper_area">
<?
	
	if (file_exists('../data/biodata.json'))
	{
		$itemData = file_get_contents('../data/biodata.json');
		$itemDataJSON = json_decode($itemData);	
		
		foreach ($itemDataJSON as $bio)
		{
			if ($bio->name == $theShaper)
			{
				echo '<div>' . $bio->long . '</div>';
			}
		}
	}
?>
	
    </div>
	
  </div><!-- /.tab-content -->
</div><!-- /.tabbable -->

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