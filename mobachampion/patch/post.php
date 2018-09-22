<?php
$moba_champ_title = 'MOBA-Champion - Dawngate Stream List';
$moba_champ_desc = 'A list of active Dawngate streams on MOBA-Champion.com!';
include('../header.php');
?>

<div id="main_container">

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Post</div></div></div>
<div class="news_content">

<div class="article_news">

<?php

	$perpage = 10;
	$topic = $_GET['topic'];
	
	if (!is_null($topic))
	{
		$otposts = 'SELECT id, url, title, poster, content, topic, posttime, type, count(topic) as topiccount FROM
					otpost
				WHERE otpost.topic = "' . $topic . '"
				ORDER BY otpost.posttime DESC
				LIMIT ' . $pagelimit . ',' . $perpage;
		$otpostsRows = R::getAll($otposts);
		$otpostsBeans = R::convertToBeans('otpost',$otpostsRows);
		
		var_dump($otpostsRows);
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