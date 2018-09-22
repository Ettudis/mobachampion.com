<?php 
require_once('forum/SSI.php');
?>

<?php
include('header.php');
?>

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<?php

$search = $_GET['search'];

if (!isset($search))
{
echo '<div class="news_post">
	  <div class="news_header"><div class="news_header_text"><div class="news_title">Search</div></div></div>
      <div class="news_content">';

	echo '<p>No search parameter entered. You may have reached this page in error.</p>';
}
else
{
echo '<div class="news_post">
	  <div class="news_header"><div class="news_header_text"><div class="news_title">Search results for "' . $search . '"</div></div></div>
	  <div class="news_content">';

	// SPELLS
	$spellData = file_get_contents('data/spelldata.json');
	$spellDataJSON = json_decode($spellData);
	foreach ($spellDataJSON as $spell_entry)
	{
		if (stristr($spell_entry->name, $search) !== FALSE)
		{
			echo '<a href="http://www.moba-champion.com/spells/index.php#' . $spell_entry->name . '"/>
				 <div class="guide_shaper_link spelltip" title="' . $spell_entry->name . '">
					<ul><li><img src="http://www.moba-champion.com/images/spells/Spell_' . $spell_entry->name . '_1.png" class="img-rounded"></li><li>' . $spell_entry->name . '</li></ul>
				 </div>
				 </a>';
		}
	}
	
	// ROLES
	$roleData = file_get_contents('data/roledata.json');
	$roleDataJSON = json_decode($roleData);
	foreach ($roleDataJSON as $role_entry)
	{
		if (stristr($role_entry->name, $search) !== FALSE)
		{
			echo '<a href="http://www.moba-champion.com/roles/index.php#' . $role_entry->name . '"/>
				 <div class="guide_shaper_link roletip" title="' . $role_entry->name . '">
					<ul><li><img src="http://www.moba-champion.com/images/roles/' . $role_entry->name . '.png" class="img-rounded"></li><li>' . $role_entry->name . '</li></ul>
				 </div>
				 </a>';
		}
	}
	
	// SHAPERS
	$shaperData = file_get_contents('data/shaperdata.json');
	$shaperDataJSON = json_decode($shaperData);
	foreach ($shaperDataJSON as $shaper_entry)
	{
		if (stristr($shaper_entry->name, $search) !== FALSE)
		{
			echo '<a href="http://www.moba-champion.com/shapers/' . strtolower($shaper_entry->name) . '"/>
				 <div class="guide_shaper_link shapertip" title="' . $shaper_entry->name . '">
					<ul><li><img src="http://www.moba-champion.com/images/shapers/' . strtolower($shaper_entry->name) . '.png" class="img-rounded"></li><li>' . $shaper_entry->name . '</li></ul>
				 </div>
				 </a>';
		}
	}
	
	// ITEMDATA
	$itemData = file_get_contents('data/itempalooza.json');
	$itemDataJSON = json_decode($itemData);
	foreach ($itemDataJSON as $item_entry)
	{
		if (stristr($item_entry->name, $search) !== FALSE)
		{
			echo '<a href="http://www.moba-champion.com/items/item.php?item=' . $item_entry->name . '"/>
				 <div class="guide_shaper_link iptip" title="' . $item_entry->name . '">
					<ul><li><img src="http://www.moba-champion.com/images/itempalooza/' . $item_entry->name . '.png" class="img-rounded"></li><li>' . $item_entry->name . '</li></ul>
				 </div>
				 </a>';
		}
	}	
}

?>

</div> <!-- news_content -->
</div> <!-- news_post -->
</div> <!-- article_content -->

<div class="article_column2">
<?php 
include('widgets/shaperwidget.php');
include('widgets/adwidget.php');
include('widgets/streamwidget.php');
include('widgets/guidewidget.php');
?>
</div>

</div> <!-- main container -->
</div> <!-- maincontent -->

<?php
include('footer.php');
?>
