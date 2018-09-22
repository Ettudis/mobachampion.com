<?php
$moba_champ_title = 'MOBA-Champion - Dawngate Player Guides';
$moba_champ_desc = 'The best source of player guides for Dawngate!';
$msGuideList = true;
$msGuides = true;
include('../header.php');
?>

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<?php

function CheckForBadGuideList($badstuff)
{
	if (strpos($badstuff,'<script>') !== false ||
		strpos($badstuff,'</script>') !== false ||
		strpos($badstuff,'iframe') !== false) 
	{
		return true;
	}
	
	return false;
}

$shaper = isset($_GET['shaper']) ? $_GET['shaper'] : null;
$filter = false;

$author = isset($_GET['author']) ? $_GET['author'] : null;
$filterAuthor = false;

if (in_array($shaper, $DB_ShaperList))
{
	$filter = true;
}

$featured = null;
$curDate = date('Y-m-d', strtotime("-9 week"));

echo '<div class="news_post">';

if ($filter)
{
	echo '<div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/guides/">Guides</a> > ' . $shaper . ' Guides</div></div></div>
			<div class="news_content">';
}
else
{
	echo '<div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/guides/">Guides</a> > Shaper Guides</div></div></div>
			<div class="news_content">';
}

echo '<div class="article_news">';

$guides = null;
$uses_author = false;
$loggedinAuthor = "";

if ($context['user']['is_logged'] == true)
{
    $loggedinAuthor = $context['user']['name'];
}

$limit_start = 0;
$limit_pagesize = 10;
$page = 1;
if (isset($_GET['page']))
{
	$page = $_GET['page'];
	$limit_start = ($page - 1) * $limit_pagesize;
}

if ($user_info['is_admin'] == true && (isset($_GET['vp']) && $_GET['vp'] == 'yes'))
{
	$loggedinAuthor = $author;
}

if (!is_null($author))
{	
	$guideSql = 'SELECT 
				guidev2.title, guidev2.author, guidev2.shaper, guidev2.id, guidev2.featured, guidev2.tags, guidev2.updatetime,
				SUM(votev2.type) AS vote_total
			FROM
				guidev2
				LEFT JOIN (select * from votev2 WHERE curdate > "' . $curDate . '") votev2 ON guidev2.id = votev2.guideid
			WHERE guidev2.author = "' . $author . '" AND (guidev2.privacy <> "Private" OR guidev2.author = "' . $loggedinAuthor . '") AND guidev2.featured = "0" GROUP BY
				guidev2.id
			ORDER BY vote_total DESC
			LIMIT ' . $limit_start . ', ' . $limit_pagesize;
	$guideRows = R::getAll($guideSql);
	$guides = R::convertToBeans('guidev2',$guideRows);
	$uses_author = true;
	if ($loggedinAuthor == $author)
	{
		$totalGuides = R::count('guidev2',' author = ?',array($loggedinAuthor));
	}
	else
	{
		$totalGuides = R::count('guidev2',' privacy = :privacy AND author = :author',array( ':privacy' => 'Public', ':author' => $author ));
	}
}
else if ($filter)
{
	$guideSql = 'SELECT 
				guidev2.title, guidev2.author, guidev2.shaper, guidev2.id, guidev2.featured, guidev2.tags, guidev2.updatetime,
				SUM(votev2.type) AS vote_total
			FROM
				guidev2
				LEFT JOIN (select * from votev2 WHERE curdate > "' . $curDate . '") votev2 ON guidev2.id = votev2.guideid
			WHERE guidev2.shaper = "' . $shaper . '" AND guidev2.privacy <> "Private" AND guidev2.featured = "0"
				GROUP BY
				guidev2.id
			ORDER BY vote_total DESC
			LIMIT ' . $limit_start . ', ' . $limit_pagesize;			
	$guideRows = R::getAll($guideSql);
	$guides = R::convertToBeans('guidev2',$guideRows);
	$totalGuides =  R::count('guidev2',' shaper = ? AND privacy = "Public" AND featured = "0"',array($shaper));
}
else
{
	$guideSql = 'SELECT 
				guidev2.title, guidev2.author, guidev2.shaper, guidev2.id, guidev2.featured, guidev2.tags, guidev2.updatetime,
				SUM(votev2.type) AS vote_total
			FROM
				guidev2
				LEFT JOIN (select * from votev2 WHERE curdate > "' . $curDate . '") votev2 ON guidev2.id = votev2.guideid
			WHERE guidev2.privacy <> "Private" AND guidev2.featured = "0"
				GROUP BY 
				guidev2.id
			ORDER BY vote_total DESC
			LIMIT ' . $limit_start . ', ' . $limit_pagesize;			
	$guideRows = R::getAll($guideSql);
	$guides = R::convertToBeans('guidev2',$guideRows);
	$totalGuides =  R::count('guidev2',' privacy = "Public" AND featured = "0"');
}

$numGuides = count($guides);
$end = $limit_start + $numGuides;

if ($numGuides > 0)
{
	echo '<div class="guidev2_list_area">';
	echo '<div style="float: left; width: 100%">';
	echo '<div style="float: left; width: 300px;">';
	echo '<span>Displaying guides ' . ($limit_start + 1) .' - ' . ($end) . ' of ' . $totalGuides . ' guides.</span>';
	echo '</div>';
	
	echo '<div style="float: right; width: 400px; text-align: right;">Page: ';	
	$limit_num_pages = ceil($totalGuides / $limit_pagesize);

	for ($i = 0; $i < $limit_num_pages; $i++) 
	{
		if ($filter)
		{
			echo '<a href="http://www.moba-champion.com/guides/list.php?shaper=' . $shaper.'&page=' . ($i+1) . '">' . ($i+1) . '</a> ';
		}
		else if ($author)
		{
			if (isset($_GET['vp']) && $_GET['vp'] == "yes")
			{
				echo '<a href="http://www.moba-champion.com/guides/list.php?author=' . $author.'&page=' . ($i+1) . '&vp=yes">' . ($i+1) . '</a> ';
			}
			else
			{
				echo '<a href="http://www.moba-champion.com/guides/list.php?author=' . $author.'&page=' . ($i+1) . '">' . ($i+1) . '</a> ';
			}
		}
		else
		{
			echo '<a href="http://www.moba-champion.com/guides/list.php?page=' . ($i+1) . '">' . ($i+1) . '</a> ';
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
	echo '<p>No guides for ' . $shaper . ' exist yet! Be the first to <a href="http://www.moba-champion.com/guides/editor.php">create one!</p>';
}

	// last updated
	$patchData = file_get_contents('../patch/patchdata.json');
	$patchDataJSON = json_decode($patchData);
	$thePatches = $patchDataJSON->patches;

foreach($guides as $guide)
{
	if ($guide->featured == 1 || 
		CheckForBadGuideList($guide->title) ||
		CheckForBadGuideList($guide->shaper) ||
		CheckForBadGuideList($guide->id) ||
		CheckForBadGuideList($guide->author))
	{
		continue;
	}
	
	echo '<div class="guide_list_row">';
	echo '<div class="guide_list_icon"><img src="http://www.moba-champion.com/images/shapers/' . strtolower ($guide->shaper) . '.png"></div>';
	echo '<div class="guide_list_content"><a href="http://www.moba-champion.com/guides/view/' . $guide->id . '">' . $guide->title . '</a><BR><B>Author: </B>' . $guide->author;
		// tags
		$tags = explode(",", $guide->tags);
		echo '&nbsp;&nbsp;';
		foreach($tags as $tag)
		{
			if ($tag == "Featured")
			{
				echo '&nbsp;&nbsp;<span class="label label-info">' . $tag . '</span>&nbsp;&nbsp;';
			}
			else if ($tag == "Beginner")
			{
				echo '&nbsp;&nbsp;<span class="label label-important">' . $tag . '</span>&nbsp;&nbsp;';
			}
			else if ($tag == "Partner")
			{
				echo '&nbsp;&nbsp;<span class="label label-success">' . $tag . '</span>&nbsp;&nbsp;';
			}
			else if ($tag == "Champion")
			{
				echo '&nbsp;&nbsp;<span class="label label-warning">' . $tag . '</span>&nbsp;&nbsp;';
			}
		}
		
	echo '</div>';
	
	$name = $context['user']['name'];
	$myvote = 0;
	if ($context['user']['is_logged'])
	{
		$vote = R::findOne('vote',' name = :name AND guideid = :guideid ', array(':name'=>$name,':guideid'=>$guide->id) );
		if (!is_null($vote))
		{
			$myvote = $vote->type;
		}
	}
	
	$orangevotes = R::count('votev2',' guideid = :guideid AND type = 1 AND curdate > :curdate', array(':guideid'=>$guide->id,':curdate'=>$curDate));
	$bluevotes = R::count('votev2',' guideid = :guideid AND type = -1 AND curdate > :curdate', array(':guideid'=>$guide->id,':curdate'=>$curDate));
	
	$guideView = R::findOne('guideview', ' guideid = ? ',array($guide->id));
	$view = 0;
	if (!is_null($guideView))
	{
		$view = $guideView->views;
	}
		
	$numVotes = ($orangevotes-$bluevotes);
	if ($myvote == 1)
	{
		echo '<div class="guide_display_header_summary2"><p><i class="fa fa-thumbs-o-up orangethumb thumb' . $guide->id . '" data-id="' . $guide->id . '"></i> ' . ($orangevotes-$bluevotes). '</p><p><i class="fa fa-eye"></i> ' . $view . '</p></div>';
	}
	else if ($myvote == -1)
	{
		echo '<div class="guide_display_header_summary2"><p><i class="fa fa-thumbs-down bluethumb thumb' . $guide->id . '" data-id="' . $guide->id . '"></i> ' . ($orangevotes-$bluevotes). '</p><p><i class="fa fa-eye"></i> ' . $view . '</p></div>';
	}
	else if ($numVotes < 0)
	{
		echo '<div class="guide_display_header_summary2"><p><i class="fa fa-thumbs-o-down bluethumb thumb' . $guide->id . '" data-id="' . $guide->id . '"></i> ' . ($orangevotes-$bluevotes). '</p><p><i class="fa fa-eye"></i> ' . $view . '</p></div>';
	}
	else
	{
		echo '<div class="guide_display_header_summary2"><p><i class="fa fa-thumbs-up orangethumb thumb' . $guide->id . '" data-id="' . $guide->id . '"></i> ' . ($orangevotes-$bluevotes) . '</p><p><i class="fa fa-eye"></i> ' . $view . '</p></div>';
	}
	
	if ($guide->author == $context['user']['name'])
	{
		echo '<div class="guide_display_header_edit"><p><a href="http://www.moba-champion.com/guides/editor/' . $guide->id . '">
		<button class="btn btn-primary" type="button">Edit Guide</button></a>
		</p></div>';
	}
	
	$curpatch = "";
	$numpatches = 0;
	$totalpatches = 0;
	foreach ($thePatches as $patch)
	{
		$totalpatches++;
		$patchTime = strtotime($patch->date);
		if ($guide->updatetime > $patchTime)
		{
			$curpatch = $patch->name;
			$curpatch = str_replace("Closed Beta:", "", $curpatch);
			$numpatches++;
		}
	}
	
	$patchdelta = $totalpatches - $numpatches;
	if ($patchdelta == 0)
	{
		$curpatch .= ' (Latest)';
	}
	
	echo '<div class="guide_display_header_summary_lastupdate" style="float: right;padding-top: 10px;text-align:center;width: 110px;">';
	echo '<b>Last Updated:</b><BR>' . $curpatch;
	echo '</div>';
	
	echo '</div>';
}

if ($numGuides > 0 || $numFeatured > 0)
{
	echo '</div>';
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
