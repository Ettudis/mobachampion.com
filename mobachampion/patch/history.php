<?php
$includeMixitUp = true;
$msGameInfo = true;
$msPatch = true;
include('../header.php');
?>

<div id="main_container">

<div class="article_content">

<?php
	$id = $_GET['id'];
	if (!is_null($id))
	{
		echo '<div class="news_post">
		<div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/patch/">Patch Home</a> > Patch History: '  . ucwords($id) . '</div><div class="news_poster"></div></div></div>
		<div class="news_content">

		<div class="article_news">';
	
		$shaperNotePath = 'output/' . strtolower($id) . '.php';
		if (file_exists($shaperNotePath) && filesize($shaperNotePath) > 0)
		{
			echo '<div class="patchnotes waystone_regtext">';
			include($shaperNotePath);
			echo '</div>';
		}
		else
		{
			echo '<p>Patch data was not found. Maybe the ID specified is bad, or has not undergone any patch changes?</p>';
		}
	}
	else
	{
		echo '<div class="news_post"><div class="news_header"><div class="news_header_text"><div class="news_title">Patch Notes</div></div></div><div class="news_content"><div class="article_news">';
		echo '<p>Patch data was not found. Maybe the ID specified is bad, or has not undergone any patch changes?</p>';
	}
?>

</div>

</div> <!-- news content -->

</div> <!-- news post -->
</div>

<div class="article_column2">
<?php 
include('../widgets/shaperwidget.php');
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