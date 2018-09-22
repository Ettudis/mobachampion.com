<?php
$includeMixitUp = true;
$msGameInfo = true;
$msPatch = true;
include('../header.php');
?>


<div id="main_container">

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Patch History</div></div></div>
<div class="news_content taller">

<?php
	$patchData = file_get_contents('patchdata.json');
	$patchDataJSON = json_decode($patchData);
	
	echo '<div class="patch_latest_selector">';
	echo 'View a Patch: <a href="http://www.moba-champion.com/patch/patch.php?id=' . $patchDataJSON->latestid . '">' . $patchDataJSON->latest . '</a>';
	echo ' | ';
	echo '<a href="http://www.moba-champion.com/patch/list.php">All Patches</a>';
	echo '<p>Select a Shaper, Item, Role, Loadout or Spell below to view their individual patch history.</p>';	
	echo '</div>';
	
	?>
		
	<div class="guide_filter" id="filter_area">
	
		<div class="guide_filter_archetypes">
			<input type="text" placeholder="Filter Shapers, Icons, etc by name" class="patch_search" data-dimension="range">
		
			<div class="btn-group guide_filter_fleft">
			  <button class="btn active btnlarger" data-filter="all" data-dimension="archtype">All</button>
			  <button class="btn btnlarger" data-filter="Shapers" data-dimension="archtype">Shapers</button>
			  <button class="btn btnlarger" data-filter="Items" data-dimension="archtype">Items</button>
			  <button class="btn btnlarger" data-filter="Roles" data-dimension="archtype">Roles</button>
			  <button class="btn btnlarger" data-filter="Spells" data-dimension="archtype">Spells</button>
			  <button class="btn btnlarger" data-filter="Loadouts" data-dimension="archtype">Loadouts</button>
			</div>
		</div>
	</div>	

	<div id="Grid">
	<div class="fail_element">Sorry &mdash; we could not find any Shapers, Items, Roles, Spells or Loadouts matching these criteria.</div>
	
	<?php
		$shaperData = file_get_contents('../data/shaperdata.json');
		$shaperDataJSON = json_decode($shaperData);
		
		foreach ($shaperDataJSON as $shaper_entry)
		{
			$smallName = strtolower($shaper_entry->name);
			
			$classStr = "";
			$len = strlen($smallName);
			for ($i = 1; $i <= $len; $i++) 
			{
				$str = substr($smallName, 0, $i) . ' ';
				$classStr .= $str;
			}
			
			echo '<li class="mix Shapers ' . $classStr . '" data-cat="1">';

			echo '<a href="http://www.moba-champion.com/patch/history.php?id=' . $smallName . '"/>
				 <div class="guide_shaper_link">
					<ul><li><img src="http://www.moba-champion.com/images/shapers/' . $smallName . '.png" class="img-rounded"></li><li>' . $shaper_entry->name . '</li></ul>
				 </div>
				 </a>';
			
			echo '</li>';
		}
		
		$itemData = file_get_contents('../data/itempalooza.json');
		$itemDataJSON = json_decode($itemData);
		
		foreach ($itemDataJSON as $shaper_entry)
		{
			$smallName = strtolower($shaper_entry->name);
			
			$classStr = "";
			$len = strlen($smallName);
			for ($i = 1; $i <= $len; $i++) 
			{
				$str = substr($smallName, 0, $i) . ' ';
				$classStr .= $str;
			}
			
			echo '<li class="mix Items ' . $classStr . '" data-cat="1">';

			echo '<a href="http://www.moba-champion.com/patch/history.php?id=' . $smallName . '"/>
				 <div class="guide_shaper_link">
					<ul><li><img src="' . $shaper_entry->img . '" class="img-rounded"></li>';
					if (strlen($shaper_entry->name) > 14)
					{
						echo '<li class="patch_smallest_text">' . $shaper_entry->name . '</li></ul>';
					}
					else if (strlen($shaper_entry->name) > 12)
					{
						echo '<li class="patch_smaller_text">' . $shaper_entry->name . '</li></ul>';
					}
					else
					{
						echo '<li>' . $shaper_entry->name . '</li></ul>';
					}
					
				 echo '</div></a></li>';
		}
		
		$roleData = file_get_contents('../data/roledata.json');
		$roleDataJSON = json_decode($roleData);
		
		foreach ($roleDataJSON as $shaper_entry)
		{
			$smallName = strtolower($shaper_entry->name);
			
			$classStr = "";
			$len = strlen($smallName);
			for ($i = 1; $i <= $len; $i++) 
			{
				$str = substr($smallName, 0, $i) . ' ';
				$classStr .= $str;
			}
			
			echo '<li class="mix Roles ' . $classStr . '" data-cat="1">';

			echo '<a href="http://www.moba-champion.com/patch/history.php?id=' . $smallName . '"/>
				 <div class="guide_shaper_link">
					<ul><li><img src="http://www.moba-champion.com/images/roles/' . $smallName . '.png" class="img-rounded" style="width: 64px; height: 64px;"></li><li>' . $shaper_entry->name . '</li></ul>
				 </div>
				 </a>';
			
			echo '</li>';
		}
		
		$spellData = file_get_contents('../data/spelldata.json');
		$spellDataJSON = json_decode($spellData);
		
		foreach ($spellDataJSON as $shaper_entry)
		{
			$smallName = strtolower($shaper_entry->name);
			
			echo '<li class="mix Spells" data-cat="1">';

			echo '<a href="http://www.moba-champion.com/patch/history.php?id=' . $smallName . '"/>
				 <div class="guide_shaper_link">
					<ul><li><img src="http://www.moba-champion.com/images/spells/Spell_' . $shaper_entry->name . '_1.png" class="img-rounded" style="width: 64px; height: 64px;"></li><li>' . $shaper_entry->name . '</li></ul>
				 </div>
				 </a>';
			
			echo '</li>';
		}
		
		$loadoutData = file_get_contents('../data/loadoutdata.json');
		$loadoutDataJSON = json_decode($loadoutData);
		
		foreach ($loadoutDataJSON as $shaper_entry)
		{
			$smallName = strtolower($shaper_entry->name);

			$classStr = "";
			$len = strlen($smallName);
			for ($i = 1; $i <= $len; $i++) 
			{
				$str = substr($smallName, 0, $i) . ' ';
				$classStr .= $str;
			}
			
			echo '<li class="mix Loadouts ' . $classStr . '" data-cat="1">';

			echo '<a href="http://www.moba-champion.com/patch/history.php?id=' . $smallName . '"/>
				 <div class="guide_shaper_link">
					<ul><li><img src="http://www.moba-champion.com/images/icon_perks.png" class="img-rounded" style="width: 48px; height: 48px;"></li>';
					if (strlen($shaper_entry->name) > 14)
					{
						echo '<li class="patch_smallest_text">' . $shaper_entry->name . '</li></ul>';
					}
					else if (strlen($shaper_entry->name) > 12)
					{
						echo '<li class="patch_smaller_text">' . $shaper_entry->name . '</li></ul>';
					}
					else
					{
						echo '<li>' . $shaper_entry->name . '</li></ul>';
					}
			echo '</div></a></li>';
		}		
	?>		
	
	</div>		
		
</div> <!-- news content -->

</div> <!-- news post -->
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