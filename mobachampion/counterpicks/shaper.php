<?php 
require_once('../forum/SSI.php');
?>

<?php
$moba_champ_title = 'MOBA-Champion - Dawngate Counter Picks';
$moba_champ_desc = 'Dawngate Counter Picks and Shaper Info';
$msSoloQueue = true;
$msCounterPicks = true;
include('../header.php');
?>

<script src="counterpicking.js"></script>

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<?php

if ($context['user']['is_logged'] == false)
{
	echo '<script>var isLoggedIn = false;</script>';
}
else
{
	echo '<script>var isLoggedIn = true;</script>';
}
$shaper = $_GET['shaper'];
if (in_array($shaper, $DB_ShaperList))
{
    echo '<script>var primaryShaper = "' . $shaper . '";</script>';

	echo '<div class="news_post">
	<div class="news_header"><div class="news_header_text"><div class="news_title">Counter Picks - ' . $shaper . '</div></div></div>
	<div class="news_content">';
	
	// submitters
	echo '<div class="counterpick_pop guide_hidden">
		<div class="counterpick_pop_bg"></div>
		<div class="counterpick_pop_main">
			<div class="counterpick_pop_title"></div>
			<div class="counterpick_pop_selector"><form class="form-inline"><select class="pop_current_shaper">';
				foreach($DB_ShaperList as $ss)
				{
					echo '<option value="' . $ss . '">' . $ss . '</option>';
				}
		echo '</select>
			<button type="button" class="counterpick_pop_confirm btn">Submit</button>
			</form>
			
			<div class="counterpick_pop_close"><i class="fa fa-times"> </i> Cancel</div>		
			
			</div>
			
		</div>
		
		</div>';

	// offline
	echo '<div class="counterpick_pop2 guide_hidden">
		<div class="counterpick_pop_bg2"></div>
		<div class="counterpick_pop_main2">
			<div class="counterpick_pop_title2">You must be logged in to rate counter picks.<BR>Please <a href="http://moba-champion.com/forum/index.php?action=login">log in</a> or <a href="http://www.moba-champion.com/forum/index.php?action=register">register</a>.</div>
			
			<div class="counterpick_pop_close2"><i class="fa fa-times"> </i> Cancel</div>		
			
		</div></div>';		
	
	echo '<div class="counter_pick_main">';
	echo '<div class="counter_pick_list">';

	// small
	$shaperSmall = strtolower($shaper);	

	// data
	$shaperData = file_get_contents('../data/counterpickdata.json');
	$shaperDataJSON = json_decode($shaperData);
	$shaperIndex = 0;
	$shaperValid = false;
	foreach ($shaperDataJSON as $shaper_entry)
	{
		if ($shaper_entry->name == $shaper)
		{
			$shaperValid = true;		
			break;
		}
		
		$shaperIndex++;
	}

	if ($shaperValid)
	{
		$theShaperData = $shaperDataJSON[$shaperIndex];

		$shaperTitle = $theShaperData->title;
		$shaperArch = $theShaperData->role;
		
		
		echo '<div class="counterpick_header">';
			echo '<div class="counterpick_header_left">';
				echo '<div class="counterpick_header_left_img"><img src="http://www.moba-champion.com/images/shapers/' . $shaperSmall . '.png"></div>';
				echo '<div class="counterpick_header_left_content">';
					echo '<div class="counterpick_header_left_name">' . $shaper . '</div>';
					echo '<div class="counterpick_header_left_title">'. $shaperTitle .'</div>';
					echo '<div class="counterpick_header_left_title">'. $shaperArch .'</div>';
				echo '</div>';
			echo '</div>';
			echo '<div class="counterpick_header_right">';
				echo '<div class="counterpick_header_right_spells">';
					echo '<div class="counterpick_header_right_title">Counter Spells:</div>';
					if ($theShaperData->spell1 != "")
					{
						echo '<div class="counterpick_header_right_item"><img src="http://www.moba-champion.com/images/spells/Spell_' .$theShaperData->spell1 . '_1.png" class="spelltip" title="' .$theShaperData->spell1 . '"></div>';
					}
					if ($theShaperData->spell2 != "")
					{					
						echo '<div class="counterpick_header_right_item"><img src="http://www.moba-champion.com/images/spells/Spell_' .$theShaperData->spell2 . '_1.png" class="spelltip" title="' .$theShaperData->spell2 . '"></div>';
					}
					if ($theShaperData->spell3 != "")
					{					
						echo '<div class="counterpick_header_right_item"><img src="http://www.moba-champion.com/images/spells/Spell_' .$theShaperData->spell3 . '_1.png" class="spelltip" title="' .$theShaperData->spell3 . '"></div>';
					}
				echo '</div>';
				
				echo '<div class="counterpick_header_right_spells">';
					echo '<div class="counterpick_header_right_title">Counter Items:</div>';
					if ($theShaperData->item1 != "")
					{					
						echo '<div class="counterpick_header_right_item"><img src="http://www.moba-champion.com/images/itempalooza/' .$theShaperData->item1 . '.png" class="iptip" title="' .$theShaperData->item1 . '"></div>';
					}
					if ($theShaperData->item2 != "")
					{					
						echo '<div class="counterpick_header_right_item"><img src="http://www.moba-champion.com/images/itempalooza/' .$theShaperData->item2 . '.png" class="iptip" title="' .$theShaperData->item2 . '"></div>';
					}
					if ($theShaperData->item3 != "")
					{					
						echo '<div class="counterpick_header_right_item"><img src="http://www.moba-champion.com/images/itempalooza/' .$theShaperData->item3 . '.png" class="iptip" title="' .$theShaperData->item3 . '"></div>';
					}
				echo '</div>';	
				
			echo '</div>';
		echo '</div>';
	}
	
	// Strong
	echo '<div class="counterpick_row">';
	
	echo '<div class="counterpick_area">';
	echo '<div class="counterpick_title">' . $shaper . ' is strong against:</div>';
	
	$strongSql = 'SELECT target, COUNT(vote) as vote_count, SUM(vote) as vote_sum, SUM(vote) - (COUNT(vote) - SUM(vote)) as difference
			FROM strongpick
			WHERE shaper = "' . $shaper . '"
			GROUP BY target
			ORDER BY difference desc';
	$strongRows = R::getAll($strongSql);
	$strongBeans = R::convertToBeans('strongpick',$strongRows);
	
	$strongCount = 0;
	foreach($strongRows as $strongBean)
	{
		if ($strongCount < 8)
		{	
			if ($strongCount == 4)
			{
				echo '<div class="counterpick_more counterpick_strong_more" style="display:none">';
			}
			
			$upvote = $strongBean["vote_sum"];
			$downvote = $strongBean["vote_count"] - $upvote;
			$target = $strongBean["target"];
			$targetSmall = strtolower($target);
			
			$leftPct = 140 * ($upvote / ($upvote + $downvote));
			$rightPct = 140 * ($downvote / ($upvote + $downvote));
			
			$strongCount++;
			
			echo '<div class="counterpick_shaper">';
			echo '<div class="counterpick_shaper_icon">';
				echo '<img src="http://www.moba-champion.com/images/shapers/' . $targetSmall . '.png">';
			echo '</div>';
			echo '<div class="counterpick_shaper_content">';
				echo '<div class="counterpick_shaper_top">' . $target . '</div>';
				echo '<div class="counterpick_shaper_bottom">';
					echo '<div class="counterpick_bar">';
						echo '<div class="counterpick_bar_g" style="width:' . $leftPct . 'px;"></div>';
						echo '<div class="counterpick_bar_r" style="width:' . $rightPct . 'px;"></div>';
					echo '</div>'; // counterpick_bar
					echo '<div class="counterpick_button_up strongbu" data-used="false" data-target="' . $target . '" data-vote="' . $upvote . '"><i class="fa fa-thumbs-up"></i> ' . $upvote . '</div>';
					echo '<div class="counterpick_button_down strongbd" data-used="false" data-target="' . $target . '" data-vote="' . $downvote . '"><i class="fa fa-thumbs-down"></i> ' . $downvote . '</div>';			
				echo '</div>'; // counterpick_shaper_bottom
			echo '</div>'; // counterpick_shaper_content
			echo '</div>'; // counterpick_shaper			
		}
	}
	
    if ($strongCount > 4)
	{
		echo '</div>'; // counterpick_more
	}
	else
	{
		for ($j = $strongCount; $j <= 3; $j++)
		{
			echo '<div class="counterpick_shaper">';
			echo '</div>';
		}
	}
	
	echo '<div class="counterpick_toolbar">';
    if ($strongCount > 4)
	{	
		echo '<button type="button" class="strong_show_more">Show More</button>';
	}
	echo '<button type="button" class="strong_add_pick">Add another Strong pick</button>';
	echo '</div>';
	
	echo '</div>'; // counterpick_area;
	
	// Weak
	echo '<div class="counterpick_area">';
	echo '<div class="counterpick_title">' . $shaper . ' is weak against:</div>';
	
	$weakSql = 'SELECT target, COUNT(vote) as vote_count, SUM(vote) as vote_sum, SUM(vote) - (COUNT(vote) - SUM(vote)) as difference
			FROM weakpick
			WHERE shaper = "' . $shaper . '"
			GROUP BY target
			ORDER BY difference desc';
	$weakRows = R::getAll($weakSql);
	$weakBeans = R::convertToBeans('weakpick',$weakRows);
	
	$weakCount = 0;
	foreach($weakRows as $weakBean)
	{
		if ($weakCount < 8)
		{	
			if ($weakCount == 4)
			{
				echo '<div class="counterpick_more counterpick_weak_more" style="display:none">';
			}
			
			$upvote = $weakBean["vote_sum"];
			$downvote = $weakBean["vote_count"] - $upvote;
			$target = $weakBean["target"];
			$targetSmall = strtolower($target);
			
			$leftPct = 140 * ($upvote / ($upvote + $downvote));
			$rightPct = 140 * ($downvote / ($upvote + $downvote));
			
			$weakCount++;
			
			echo '<div class="counterpick_shaper">';
			echo '<div class="counterpick_shaper_icon">';
				echo '<img src="http://www.moba-champion.com/images/shapers/' . $targetSmall . '.png">';
			echo '</div>';
			echo '<div class="counterpick_shaper_content">';
				echo '<div class="counterpick_shaper_top">' . $target . '</div>';
				echo '<div class="counterpick_shaper_bottom">';
					echo '<div class="counterpick_bar">';
						echo '<div class="counterpick_bar_g" style="width:' . $leftPct . 'px;"></div>';
						echo '<div class="counterpick_bar_r" style="width:' . $rightPct . 'px;"></div>';
					echo '</div>'; // counterpick_bar
					echo '<div class="counterpick_button_up weakbu" data-used="false" data-target="' . $target . '" data-vote="' . $upvote . '"><i class="fa fa-thumbs-up"></i> ' . $upvote . '</div>';
					echo '<div class="counterpick_button_down weakbd" data-used="false" data-target="' . $target . '" data-vote="' . $downvote . '"><i class="fa fa-thumbs-down"></i> ' . $downvote . '</div>';			
				echo '</div>'; // counterpick_shaper_bottom
			echo '</div>'; // counterpick_shaper_content
			echo '</div>'; // counterpick_shaper			
		}
	}
			
    if ($weakCount > 4)
	{
		echo '</div>'; // counterpick_more
	}
	else
	{
		for ($j = $weakCount; $j <= 3; $j++)
		{
			echo '<div class="counterpick_shaper">';
			echo '</div>';
		}
	}
	
	echo '<div class="counterpick_toolbar">';
    if ($weakCount > 4)
	{		
		echo '<button type="button" class="weak_show_more">Show More</button>';
	}
	echo '<button type="button" class="weak_add_pick">Add another Weak pick</button>';
	echo '</div>';
	
	echo '</div>';  // counterpick_area;
	
	echo '</div>'; // counterpick_row
	echo '<div class="counterpick_row">';
	
	// Good With
	echo '<div class="counterpick_area">';
	echo '<div class="counterpick_title">' . $shaper . ' is good with:</div>';
	
	$goodSql = 'SELECT target, COUNT(vote) as vote_count, SUM(vote) as vote_sum, SUM(vote) - (COUNT(vote) - SUM(vote)) as difference
			FROM goodpick
			WHERE shaper = "' . $shaper . '"
			GROUP BY target
			ORDER BY difference desc';
	$goodRows = R::getAll($goodSql);
	$goodBeans = R::convertToBeans('goodpick',$goodRows);
	
	$goodCount = 0;
	foreach($goodRows as $goodBean)
	{
		if ($goodCount < 8)
		{	
			if ($goodCount == 4)
			{
				echo '<div class="counterpick_more counterpick_good_more" style="display:none">';
			}
			
			$upvote = $goodBean["vote_sum"];
			$downvote = $goodBean["vote_count"] - $upvote;
			$target = $goodBean["target"];
			$targetSmall = strtolower($target);
			
			$leftPct = 140 * ($upvote / ($upvote + $downvote));
			$rightPct = 140 * ($downvote / ($upvote + $downvote));
			
			$goodCount++;
			
			echo '<div class="counterpick_shaper">';
			echo '<div class="counterpick_shaper_icon">';
				echo '<img src="http://www.moba-champion.com/images/shapers/' . $targetSmall . '.png">';
			echo '</div>';
			echo '<div class="counterpick_shaper_content">';
				echo '<div class="counterpick_shaper_top">' . $target . '</div>';
				echo '<div class="counterpick_shaper_bottom">';
					echo '<div class="counterpick_bar">';
						echo '<div class="counterpick_bar_g" style="width:' . $leftPct . 'px;"></div>';
						echo '<div class="counterpick_bar_r" style="width:' . $rightPct . 'px;"></div>';
					echo '</div>'; // counterpick_bar
					echo '<div class="counterpick_button_up goodbu" data-used="false" data-target="' . $target . '" data-vote="' . $upvote . '"><i class="fa fa-thumbs-up"></i> ' . $upvote . '</div>';
					echo '<div class="counterpick_button_down goodbd" data-used="false" data-target="' . $target . '" data-vote="' . $downvote . '"><i class="fa fa-thumbs-down"></i> ' . $downvote . '</div>';			
				echo '</div>'; // counterpick_shaper_bottom
			echo '</div>'; // counterpick_shaper_content
			echo '</div>'; // counterpick_shaper			
		}
	}
			
    if ($goodCount > 4)
	{
		echo '</div>'; // counterpick_more
	}
	else
	{
		for ($j = $goodCount; $j <= 3; $j++)
		{
			echo '<div class="counterpick_shaper">';
			echo '</div>';
		}
	}
	
	echo '<div class="counterpick_toolbar">';
    if ($goodCount > 4)
	{		
		echo '<button type="button" class="good_show_more">Show More</button>';
	}
	echo '<button type="button" class="good_add_pick">Add another Partner</button>';
	echo '</div>';		
	
	echo '</div>';  // counterpick_area;
	
	// Guides
	echo '<div class="counterpick_area">';
	echo '<div class="counterpick_title">' . $shaper . ' guides:</div>';
	
	$guideSql = 'SELECT 
				guidev2.title, guidev2.author, guidev2.shaper, guidev2.id,
				SUM(votev2.type) AS vote_total
			FROM
				guidev2
				LEFT JOIN votev2 ON guidev2.id = votev2.guideid
			WHERE guidev2.shaper = "' . $shaper . '" AND guidev2.privacy <> "Private" GROUP BY
				guidev2.id
			ORDER BY vote_total DESC';
	$guideRows = R::getAll($guideSql);
	$guides = R::convertToBeans('guidev2',$guideRows);

	$guideCount = 0;
	foreach($guides as $guide)
	{
		if ($guideCount < 8)
		{	
			if ($guideCount == 4)
			{
				echo '<div class="counterpick_more counterpick_guide_more" style="display:none">';
			}
			
			$guideCount++;
			
			echo '<div class="counterpick_shaper">';
			echo '<div class="counterpick_shaper_icon">';
				echo '<img src="http://www.moba-champion.com/images/shapers/' . $shaperSmall . '.png">';
			echo '</div>';
			echo '<div class="counterpick_shaper_content">';
			$guideTitle = $guide->title;
			if (strlen($guideTitle) > 30)
			{
				$guideTitle = substr($guideTitle, 0, 27) . '...';
			}
				echo '<div class="counterpick_shaper_top"><a href="http://www.moba-champion.com/guides/view.php?id=' . $guide->id . '">' . $guideTitle . '</a></div>';
				echo '<div class="counterpick_shaper_bottom">';
					echo '<div class="counterpick_bar_long">';
						echo 'Author: ' . $guide->author;
					echo '</div>'; // counterpick_bar		
				echo '</div>'; // counterpick_shaper_bottom
			echo '</div>'; // counterpick_shaper_content
			echo '</div>'; // counterpick_shaper						
		}
	}	
	
    if ($guideCount > 4)
	{
		echo '</div>'; // counterpick_more
	}
	else
	{
		for ($j = $guideCount; $j <= 3; $j++)
		{
			echo '<div class="counterpick_shaper">';
			echo '</div>';
		}
	}	
	
	echo '<div class="counterpick_toolbar">';
    if ($guideCount > 4)
	{			
		echo '<button type="button" class="guide_show_more">Show More</button>';
	}
	echo '<a href="http://www.moba-champion.com/guides/editor.php"><button type="button">Create a ' . $shaper . ' guide</button></a>';
	echo '</div>';	
	
	echo '</div>';  // counterpick_area;
	
	echo '</div>'; // counterpick_row	
	echo '</div>'; // counter_pick_list
	echo '</div>'; // counter_pick_main
}
else if (is_null($shaper))
{
	echo '<div class="news_post">
	<div class="news_header"><div class="news_header_text"><div class="news_title">Counter Picks - 404 Counters Not Found</div></div></div>
	<div class="news_content">';
	
	echo '<p>Error: No shaper was specified</p>';
}
else
{
	echo '<div class="news_post">
	<div class="news_header"><div class="news_header_text"><div class="news_title">Counter Picks - ' . $shaper . '</div></div></div>
	<div class="news_content">';
	
	echo '<p>An invalid Shaper: "' . $shaper . '" was specified.</p>';
}

?>

 
</div></div> <!-- news_post news_content -->
</div> <!-- article_content -->

<div class="article_column2">
<?php 
include('../widgets/counterpickwidget.php');
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
