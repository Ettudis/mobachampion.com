<?php
$moba_champ_title = 'MOBA-Champion - Dawngate Player Guides';
$moba_champ_desc = 'The best source of player guides for Dawngate!';
include('../header.php');
?>

<script src="voting.js"></script> <!-- Including our script -->

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<?php

$shaper = $_GET['shaper'];
$filter = false;

$author = $_GET['author'];
$filterAuthor = false;

if (in_array($shaper, $DB_ShaperList))
{
	$filter = true;
}

$featured = null;
if ($filter)
{
	$featuredSQL = 'SELECT guide.title, guide.author, guide.shaper, guide.id, guide.featured
			FROM guide
			WHERE guide.shaper = "' . $shaper . '" AND guide.privacy <> "Private" AND guide.featured = "1";';
	$featuredRows = R::getAll($featuredSQL);
	$featured = R::convertToBeans('guide',$featuredRows);			
}

$numFeatured = count($featured);
if ($numFeatured > 0)
{
	echo '<div class="news_post">
			<div class="news_header"><div class="news_header_text"><div class="news_title">Featured Guides</div></div></div>
		  
		<div class="news_content">
		<div class="article_news">
		<div class="guide_list_table">';

	foreach($featured as $guide)
	{	
		echo '<div class="guide_list_row">';
		echo '<div class="guide_list_icon"><img src="http://www.moba-champion.com/images/shapers/' . strtolower ($guide->shaper) . '.png"></div>';
		echo '<div class="guide_list_content"><a href="http://www.moba-champion.com/guides/display.php?id=' . $guide->id . '">' . $guide->title . '</a><BR>Author: ' . $guide->author . '</div>';
		
		$name = $context['user']['username'];
		$myvote = 0;

		$guideView = R::findOne('guideview', ' guideid = ? ',array($guide->id));
		$view = 0;
		if (!is_null($guideView))
		{
			$view = $guideView->views;
		}
		
		if (intval($view) < 1100)
		{
			$view = "<1000";
		}
		
		if ($guide->author == $context['user']['username'])
		{
			echo '<div class="guide_display_header_edit"><p><a href="http://www.moba-champion.com/guides/edit.php?id=' . $guide->id . '">
			<button class="btn btn-primary" type="button">Edit Guide</button></a>
			</p></div>';
		}
		
		echo '</div>';
	}
	
	echo '</div></div></div></div>';
}

echo '<div class="news_post">';

if ($filter)
{
	echo '<div class="news_header"><div class="news_header_text"><div class="news_title">' . $shaper . ' Guides</div></div></div>
			<div class="news_content">';
}
else
{
	echo '<div class="news_header"><div class="news_header_text"><div class="news_title">Shaper Guides</div></div></div>
			<div class="news_content">';
}

echo '<div class="article_news">';

$guides = null;
$uses_author = false;
$loggedinAuthor = "testtesttesttest";

if ($context['user']['is_logged'] == true)
{
    $loggedinAuthor = $context['user']['username'];
}

$limit_start = 0;
$limit_pagesize = 10;
if (isset($_GET['page']))
{
	$page = $_GET['page'];
	$limit_start = ($page - 1) * $limit_pagesize;
}

if (!is_null($author))
{	
	$guideSql = 'SELECT 
				guide.title, guide.author, guide.shaper, guide.id, guide.featured
			FROM
				guide
			WHERE guide.author = "' . $author . '" AND (guide.privacy <> "Private" OR guide.author = "' . $loggedinAuthor . '") AND guide.featured = "0"
			LIMIT ' . $limit_start . ', ' . $limit_pagesize;
	$guideRows = R::getAll($guideSql);
	$guides = R::convertToBeans('guide',$guideRows);
	$uses_author = true;
	$totalGuides = count($guides);
}
else if ($filter)
{
	$guideSql = 'SELECT 
				guide.title, guide.author, guide.shaper, guide.id, guide.featured
			FROM
				guide
			WHERE guide.shaper = "' . $shaper . '" AND guide.privacy <> "Private" AND guide.featured = "0"
			LIMIT ' . $limit_start . ', ' . $limit_pagesize;			
	$guideRows = R::getAll($guideSql);
	$guides = R::convertToBeans('guide',$guideRows);
	$totalGuides =  R::count('guide',' shaper = ? AND privacy = "Public" AND featured = "0"',array($shaper));
}
else
{
	$guides = R::findAll('guide',' ORDER BY title 
				LIMIT ' . $limit_start . ', ' . $limit_pagesize);
	$totalGuides =  R::count('guide',' shaper = ? AND privacy = "Public" AND featured = "0"',array($shaper));
}

$numGuides = count($guides);
$end = $limit_start + $numGuides;

if ($numGuides > 0)
{
	echo '<div style="float: left; height: 30px; background: #3c3c3c !important;">';
	echo '<div style="float: left; width: 300px; background: #3c3c3c !important;">';
	echo '<span>Displaying guides ' . ($limit_start + 1) .' - ' . ($end) . ' of ' . $totalGuides . ' guides.</span>';
	echo '</div>';
	
	echo '<div style="float: right; width: 500px; text-align: right; background: #3c3c3c !important;">Page: ';	
	$limit_num_pages = ceil($totalGuides / $limit_pagesize);
	if ($limit_start <= 10)
	{
		for ($i = 0; $i < $limit_num_pages; $i++) 
		{
			echo '<a href="http://www.moba-champion.com/guides/legacylist.php?shaper=' . $shaper.'&page=' . ($i+1) . '">' . ($i+1) . '</a> ';
		}
	}
	echo '</div></div>';
		
	echo '<div class="guide_list_table">';
}
else if ($uses_author == true)
{
	echo '<p>No guides written by author "' . $author . '" could be found.</p>';
}
else
{
	echo '<p>No guides for ' . $shaper . ' exist yet! Be the first to <a href="http://www.moba-champion.com/guides/create.php">create one!</p>';
}

foreach($guides as $guide)
{
	if ($guide->featured == 1)
	{
		continue;
	}
	
	echo '<div class="guide_list_row">';
	echo '<div class="guide_list_icon"><img src="http://www.moba-champion.com/images/shapers/' . strtolower ($guide->shaper) . '.png"></div>';
	echo '<div class="guide_list_content"><a href="http://www.moba-champion.com/guides/display.php?id=' . $guide->id . '">' . $guide->title . '</a><BR>Author: ' . $guide->author . '</div>';
	
	$name = $context['user']['username'];
	$view = 0;
		
	if ($guide->author == $context['user']['username'])
	{
		echo '<div class="guide_display_header_edit"><p><a href="http://www.moba-champion.com/guides/edit.php?id=' . $guide->id . '">
		<button class="btn btn-primary" type="button">Edit Guide</button></a>
		</p></div>';
	}
	
	echo '</div>';
}

if ($numGuides > 0 || $numFeatured > 0)
{
	echo '</div>';
}

?>

</div>

</div> <!-- news -->
</div> <!-- content -->

</div>

<div class="article_column2">
<?php 
include('../widgets/tournamentwidget.php');
include('../widgets/shaperguidewidget.php');
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
