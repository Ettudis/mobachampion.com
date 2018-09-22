<?php

$filter = true;

if ($filter)
{
	$guideSql = 'SELECT 
				guidev2.title, guidev2.author, guidev2.shaper, guidev2.id,
				SUM(votev2.type) AS vote_total
			FROM
				guidev2
				LEFT JOIN votev2 ON guidev2.id = votev2.guideid
			WHERE guidev2.shaper = "' . $shaper . '" AND guidev2.privacy = "Public" GROUP BY
				guidev2.id
			ORDER BY vote_total DESC';
	$guideRows = R::getAll($guideSql);
	$guides = R::convertToBeans('guidev2',$guideRows);	
}

$numGuides = count($guides);
$start = 1;
$end = $numGuides;

if ($numGuides > 0)
{
	echo 'Displaying guides ' . $start .' - ' . $end . ' of ' . $numGuides . ' guides, sorted by votes. More sorting options coming soon.';
	echo '<div class="guide_list_table">';
}
else
{
	echo '<p>No guides for ' . $shaper . ' exist yet! Be the first to <a href="http://www.moba-champion.com/guides/create.php">create one!</a></p>';
}

foreach($guides as $guide)
{
	echo '<div class="guide_list_row">';
	echo '<div class="guide_list_icon"><img src="http://www.moba-champion.com/images/shapers/' . strtolower ($guide->shaper) . '.png"></div>';
	echo '<div class="guide_list_content"><a href="http://www.moba-champion.com/guides/view.php?id=' . $guide->id . '">' . $guide->title . '</a><BR>Author: ' . $guide->author . '</div>';
	
	$name = $context['user']['username'];
	$myvote = 0;
	if ($context['user']['is_logged'])
	{
		$vote = R::findOne('votev2',' name = :name AND guideid = :guideid ', array(':name'=>$name,':guideid'=>$guide->id) );
		if (!is_null($vote))
		{
			$myvote = $vote->type;
		}
	}
	
	$orangevotes = R::count('votev2',' guideid = :guideid AND type = 1', array(':guideid'=>$guide->id));
	$bluevotes = R::count('votev2',' guideid = :guideid AND type = -1', array(':guideid'=>$guide->id));
	
	if ($myvote == -1)
	{
		echo '<div class="guide_display_header_summary2"><p><i class="icon-thumbs-up-alt orangethumb thumb' . $guide->id . '" data-id="' . $guide->id . '"></i> ' . $orangevotes . ' votes</p><p><i class="icon-thumbs-down bluethumb thumb' . $guide->id . '" data-id="' . $guide->id . '"></i> ' . $bluevotes . ' votes</p></div>';
	}
	else if ($myvote == 1)
	{
		echo '<div class="guide_display_header_summary2"><p><i class="icon-thumbs-up orangethumb thumb' . $guide->id . '" data-id="' . $guide->id . '"></i> ' . $orangevotes . ' votes</p><p><i class="icon-thumbs-down-alt bluethumb thumb' . $guide->id . '" data-id="' . $guide->id . '"></i> ' . $bluevotes . ' votes</p></div>';
	}
	else
	{
		echo '<div class="guide_display_header_summary2"><p><i class="icon-thumbs-up-alt orangethumb thumb' . $guide->id . '" data-id="' . $guide->id . '"></i> ' . $orangevotes . ' votes</p><p><i class="icon-thumbs-down-alt bluethumb thumb' . $guide->id . '" data-id="' . $guide->id . '"></i> ' . $bluevotes . ' votes</p></div>';
	}
	
	if ($guide->author == $context['user']['username'])
	{
		echo '<div class="guide_display_header_edit"><p><a href="http://www.moba-champion.com/guides/edit.php?id=' . $guide->id . '">
		<button class="btn btn-primary" type="button">Edit Guide</button></a>
		</p></div>';
	}
	
	echo '</div>';
}

if ($numGuides > 0)
{
	echo '</div>';
}

?>	
