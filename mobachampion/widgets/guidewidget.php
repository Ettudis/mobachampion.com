<div class="mobawidget">
	<div class="widget_header">
		<div class="widget_header_text"><a href="http://www.moba-champion.com/guides">Recently Updated Guides</a></div>
	</div>
	
	<div class="widget_guide_list">
		
<?php

function CheckForBadGuide($badstuff)
{
	if (strpos($badstuff,'<script>') !== false ||
		strpos($badstuff,'</script>') !== false ||
		strpos($badstuff,'iframe') !== false) 
	{
		return true;
	}
	
	return false;
}

$guideSql = 'SELECT 
			guidev2.title, guidev2.author, guidev2.shaper, guidev2.id,
			SUM(vote.type) AS vote_total
		FROM
			guidev2
			LEFT JOIN vote ON guidev2.id = vote.guideid
		WHERE guidev2.id != 1 AND guidev2.privacy <> "Private" GROUP BY
			guidev2.id
		ORDER BY updatetime DESC LIMIT 8';
$guideRows = R::getAll($guideSql);
$widget_guides = R::convertToBeans('guidev2',$guideRows);	

$widget_count = 0;

foreach($widget_guides as $widget_guide)
{
	if (CheckForBadGuide($widget_guide->title) ||
		CheckForBadGuide($widget_guide->shaper) ||
		CheckForBadGuide($widget_guide->shaper) ||
		CheckForBadGuide($widget_guide->author))
	{
		continue;
	}
	
	if ($widget_count % 2 == 0)
	{
		echo '<div class="guide_widget_list_row">';
	}
	else
	{
		echo '<div class="guide_widget_list_row_alt">';
	}
	
	$widget_guidetitle = $widget_guide->title;
	if (strlen($widget_guidetitle) > 30)
	{
		$widget_guidetitle = substr($widget_guidetitle, 0, 27) . "...";
	}
	
	echo '<div class="guide_widget_list_icon"><img src="http://www.moba-champion.com/images/shapers/' . strtolower ($widget_guide->shaper) . '.png"></div>';
	echo '<div class="guide_widget_list_content"><a href="http://www.moba-champion.com/guides/view/' . $widget_guide->id . '">' . $widget_guidetitle . '</a><BR>Author: ' . $widget_guide->author . '</div>';
	echo '</div>';
	
	$widget_count++;
}

?>		
	</div>
</div>