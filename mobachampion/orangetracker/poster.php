<?php
$moba_champ_title = 'MOBA-Champion - The Orange Tracker';
$moba_champ_desc = 'A list of Waystone Posts on Reddit, Twitter and the Forums';
$msOrangeTracker = true;
$msCommunity = true;
include('../header.php');
?>

<div id="main_container">

<div class="article_content">

<?php

$id = $_GET['id'];
$page = $_GET['page'];

if (!is_null($id))
{
echo '<div class="news_post">
	<div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/orangetracker/">Orange Tracker</a> - Posts by ' . $id . '</div></div></div>
	<div class="news_content">';
}
else
{
echo '<div class="news_post">
	<div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/orangetracker/">Orange Tracker</a>Orange Tracker</a></div></div></div>
	<div class="news_content">';
}
	
?>

<div class="article_news">

<?php

	$perpage = 10;

	if (is_null($page))
	{
		$page = 1;
	}
	
	if ($page < 1)
		$page = 1;
	
	$pagelimit = ($page-1) * $perpage;

	$otposts = 'SELECT id, url, title, poster, content, topic, MAX(posttime) as maxpost, posttime, type, responseto, count(topic) as topiccount FROM
				otpost
			WHERE otpost.poster = "' . $id . '"
			GROUP BY otpost.topic
			ORDER BY maxpost DESC
			LIMIT ' . $pagelimit . ',' . $perpage;
			
	$otpostsRows = R::getAll($otposts);
	$otpostsBeans = R::convertToBeans('otpost',$otpostsRows);
	
	$otCount = 'SELECT COUNT(*) FROM otpost WHERE poster = "' . $id . '" GROUP BY otpost.topic';
	$otCountRows = R::getAll($otCount);
	
	$totalCount = count($otCountRows);
	$totalPages = ceil($totalCount / $perpage);
	
	echo '<div class="ot_btn_menu">';
	
	$written = 0;
	
	if ($page > 1)
	{
		echo '<a href="http://www.moba-champion.com/orangetracker/poster.php?id=' . $id . '&page=' . ($page-1) . '"><div class="ot_btn_header_prev ot_btn_header">«</div></a>';
	}
	else
	{
		echo '<div class="ot_btn_header_prev ot_btn_header">«</div>';		
	}
	$written++;
	
	if ($page == 1)
	{
		echo '<a href="http://www.moba-champion.com/orangetracker/poster.php?id=' . $id . '&page=1"><div class="ot_btn_header_prev ot_btn_active">1</div></a>';
	}
	else
	{
		echo '<a href="http://www.moba-champion.com/orangetracker/poster.php?id=' . $id . '&page=1"><div class="ot_btn_header">1</div></a>';
	}
	$written++;
	
	if ($page > 4)
	{
		echo '<div class="ot_btn_spacer">...</div>';
		$written++;
	}
	
	if (($totalPages - $page) > 4)
	{
		$written++;
	}
	
	$written++;
	
	$remaining = 9 - $written;
	
	$startIndex = 0;
	$endIndex = 0;
	if ($page < 5)
	{
		$startIndex = 2;
		$endIndex = 2 + $remaining;
	}
	else if (($totalPages - $page) < 5)
	{
		$endIndex = $totalPages-1;
		$startIndex = $endIndex - $remaining;
	}
	else
	{
		$startIndex = $page - floor($remaining/2);
		$endIndex = $page + floor($remaining/2);
	}
	
	for ($i = $startIndex; $i <= $endIndex; $i++) 
	{
		if ($i > 1 && $i < $totalPages)
		{
			if ($i == $page)
			{
				echo '<a href="http://www.moba-champion.com/orangetracker/poster.php?id=' . $id . '&page=' . ($i) . '"><div class="ot_btn_header_prev ot_btn_active">' . $i .'</div></a>';
				$written++;
			}
			else
			{
				echo '<a href="http://www.moba-champion.com/orangetracker/poster.php?id=' . $id . '&page=' . ($i) . '"><div class="ot_btn_header_prev ot_btn_header">' . $i .'</div></a>';
				$written++;
			}
		}
		else
		{
			break;
		}
	}
	
	if (($totalPages - $page) > 4)
	{
		echo '<div class="ot_btn_spacer">...</div>';
	}
		
	if ($page != $totalPages)
	{
		echo '<a href="http://www.moba-champion.com/orangetracker/poster.php?id=' . $id . '&page=' . ($totalPages) . '"><div class="ot_btn_header">' . ($totalPages) . '</div></a>';
		echo '<a href="http://www.moba-champion.com/orangetracker/poster.php?id=' . $id . '&page=' . ($page+1) . '"><div class="ot_btn_header_next">»</div></a>';
	}
	else
	{
		echo '<a href="http://www.moba-champion.com/orangetracker/poster.php?id=' . $id . '&page=' . ($totalPages) . '"><div class="ot_btn_header ot_btn_active">' . ($totalPages) . '</div></a>';
		echo '<div class="ot_btn_header_next">»</div>';
	}
	
	echo '<div class="orange_tracker_all_posters_link"><a href="http://www.moba-champion.com/orangetracker/posterlist.php">All Posters</a></div>';
	echo '</div>';
	
	echo '<div class="orangetracker_header">';
		echo '<div class="orangetracker_header_subject">Subject</div>';
		echo '<div class="orangetracker_header_source">Source</div>';
		echo '<div class="orangetracker_header_replies">#</div>';
		echo '<div class="orangetracker_header_poster">Poster</div>';
		echo '<div class="orangetracker_header_time">Time</div>';
	echo '</div>';
	
	echo '<div class="ot_region">';
	
	foreach ($otpostsBeans as $otpost)
	{	
		echo '<div class="ot_list_row">';
		
			echo '<div class="ot_list_type">';
			if ($otpost->type == "reddit")
			{
				echo '<a href="' . $otpost->url . '"><img src="http://www.moba-champion.com/images/social/grey/reddit-logo.png"></a>';
			}
			else if ($otpost->type == "twitter")
			{
				echo '<a href="' . $otpost->url . '"><img src="http://www.moba-champion.com/images/social/grey/twitter.png"></a>';
			}
			else
			{
				echo '<img src="http://www.moba-champion.com/images/social/grey/reddit-logo.png">';
			}
			echo '</div>';
			
			echo '<div class="ot_list_title">';
				$title = htmlspecialchars_decode($otpost->title);
				$title = str_replace("\'", "'", $title);
				$title = str_replace("\\\"", "\"", $title);
				if (strlen($title) > 60)
				{
					$title = substr($title, 0, 60) . '...';
				}
				echo '<a href="http://www.moba-champion.com/orangetracker/post.php?id=' . $otpost->topic . '">' . $title . '</a>';
			echo '</div>';
			
			echo '<div class="ot_list_source">';
				if ($otpost->type == "reddit")
				{
					echo '<a href="http://www.reddit.com/r/dawngate">/r/dawngate</a>';
				}
				else if ($otpost->type == "twitter")
				{
					echo '<a href="https://twitter.com/TheDawngate/">Twitter</a>';
				}
				else
				{
					echo '<a href="https://twitter.com/TheDawngate/">Twitter</a>';
				}
			echo '</div>';
			
			echo '<div class="ot_list_count">';
				$topicCount = $otpost->topiccount;
				if (!is_null($otpost->responseto) && $otpost->responseto > 0)
				{
					$topicCount++;
				}
				echo $topicCount;
			echo '</div>';
			
			echo '<div class="ot_list_poster">';
				$posterName = "";
				if ($otpost->type == "twitter")
				{
					$posterName = '@' . $otpost->poster;
				}
				else
				{
					$posterName = $otpost->poster;
				}
				echo '<a href="http://www.moba-champion.com/orangetracker/poster.php?id=' . $otpost->poster . '">' . $posterName . '</a>';
			echo '</div>';
			
			echo '<div class="ot_list_time">';
				$time = time() - $otpost->maxpost;
				$days = floor($time / 86400);
				$months = floor($days / 30);
				$hours = floor($time / 3600) + 3; // offset
				$minute = floor($time / 60);
				
				if ($months > 1)
				{
					echo $months . ' months';
				}
				else if ($months == 1)
				{
					echo $months . ' month';
				}
				else if ($days > 1)
				{
					echo $days . ' days';
				}
				else if ($days == 1)
				{
					echo $days . ' day';
				}
				else if ($hours > 1)
				{
					echo $hours . ' hours';
				}
				else if ($hours == 1)
				{
					echo $hours . ' hour';
				}
				else
				{
					echo $minute . ' minutes';
				}
			echo '</div>';
		
		echo '</div>';
	}
	
	echo '</div>';
	
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
include('../widgets/shaperwidget.php');
include('../widgets/guidewidget.php');
?>
</div>

</div> <!-- main container -->
</div> <!-- maincontent -->

<?php
include('../footer.php');
?>