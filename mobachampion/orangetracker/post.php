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
$postTopic = $_GET['id'];
if (!is_null($postTopic))
{
	echo '<div class="news_post">
		<div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/orangetracker/">Orange Tracker</a> | Post (' . $postTopic . ')</div></div></div>
		<div class="news_content">';
}
else
{
	echo '<div class="news_post">
		<div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/orangetracker/">Orange Tracker</a> | Post</div></div></div>
		<div class="news_content">';
}
?>

<div class="article_news">

<?php
			
	if (!is_null($postTopic))
	{		
		$otposts = 'SELECT * FROM otpost WHERE topic = "' . $postTopic . '" ';
		$otpostsRows = R::getAll($otposts);
		$otpostsBeans = R::convertToBeans('otpost',$otpostsRows);
		
		$iterate = 0;
		foreach ($otpostsBeans as $otpost)
		{
			if (!is_null($otpost->responseto) && $otpost->responseto > 0)
			{
				echo '<div class="orange_tracker_post">';
				echo '<div class="orange_tracker_post_title">';
				echo '<div class="orange_tracker_post_title_poster"><a href="http://www.twitter.com/' . $otpost->responsetoname . '">'. $otpost->responsetoname . '</a></div>';
				echo '<div class="orange_tracker_post_title_source"><a href="http://www.twitter.com/' . $otpost->responsetoname . '/status/' . $otpost->responseto .'"><img src="http://www.moba-champion.com/images/social/grey/twitter.png"></a> <a href="http://www.twitter.com/' . $otpost->responsetoname . '/status/' . $otpost->responseto .'">Source</a></div>';
							
				echo '</div>';
				echo '<div class="orange_tracker_post_content">';

				$responseToContent = htmlspecialchars_decode($otpost->responsetext);
				$responseToContent = str_replace("\'", "'", $responseToContent);
				$responseToContent = str_replace("\\\"", "\"", $responseToContent);
				echo $responseToContent;
				
				echo '</div>';
				echo '</div>';
			}
			
			$posterName = "";
			if ($otpost->type == "reddit")
			{
				$posterName = $otpost->poster;
			}
			else if ($otpost->type == "twitter")
			{
				$posterName = '@' . $otpost->poster;
			}
			
			echo '<div class="orange_tracker_post">';
			echo '<div class="orange_tracker_post_title">';
			echo '<div class="orange_tracker_post_title_poster"><img src="http://www.moba-champion.com/images/waystone.png"><a href="http://www.moba-champion.com/orangetracker/poster.php?id=' . $otpost->poster . '">'. $posterName . '</a></div>';
			if ($otpost->type == "reddit")
			{
				echo '<div class="orange_tracker_post_title_source"><a href="'. $otpost->url .'"><img src="http://www.moba-champion.com/images/social/grey/reddit-logo.png"></a> <a href="'. $otpost->url .'">Source</a></div>';
			}
			else if ($otpost->type == "twitter")
			{
				echo '<div class="orange_tracker_post_title_source"><a href="'. $otpost->url .'"><img src="http://www.moba-champion.com/images/social/grey/twitter.png"></a> <a href="'. $otpost->url .'">Source</a></div>';
			}
			
			echo '</div>';
			echo '<div class="orange_tracker_post_content">';
			$pageContent = htmlspecialchars_decode($otpost->content);
			$pageContent = str_replace("\'", "'", $pageContent);
			$pageContent = str_replace("\\\"", "\"", $pageContent);
			echo $pageContent;
			echo '</div>';
			echo '</div>';
		}
	}
	else
	{
		echo '<p>Post ID was not specified: nothing to see here</p>';
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
include('../widgets/shaperwidget.php');
include('../widgets/guidewidget.php');
?>
</div>

</div> <!-- main container -->
</div> <!-- maincontent -->

<?php
include('../footer.php');
?>