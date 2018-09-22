<?php
$includeMixitUp = true;
include('../header.php');
?>


<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Guides</div></div></div>
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
		
		<div class="fail_element">Sorry &mdash; we could not find any Shapers matching these criteria.</div>
		
		<?php
			$shaperData = file_get_contents('../data/shaperdata.json');
			$shaperDataJSON = json_decode($shaperData);
			
			foreach ($shaperDataJSON as $shaper_entry)
			{
				$smallName = strtolower($shaper_entry->name);
				
				echo '<li class="mix ' . $shaper_entry->role . '" data-cat="1">';

				echo '<a href="http://www.moba-champion.com/guides/legacylist.php?shaper=' . $shaper_entry->name . '"/>
					 <div class="guide_shaper_link">
						<ul><li><img src="http://www.moba-champion.com/images/shapers/' . $smallName . '.png" class="img-rounded"></li><li>' . $shaper_entry->name . '</li></ul>
					 </div>
					 </a>';
				
				echo '</li>';
			}		
		?>
		</div>	
</div>

</div>
<?php
include('../widgets/adwidget2.php');
?>
</div>

<div class="article_column2">
<?php 
include('../widgets/tournamentwidget.php');
include('../widgets/guidewidget.php');
include('../widgets/shaperwidget.php');
include('../widgets/streamwidget.php');
include('../widgets/adwidget.php');
?>
</div>

</div> <!-- main container -->
</div> <!-- maincontent -->

<?php
include('../footer.php');
?>