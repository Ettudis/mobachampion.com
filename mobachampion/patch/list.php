<?php
$includeMixitUp = true;
$msGameInfo = true;
$msPatch = true;
include('../header.php');
?>


<div id="main_container">

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/patch/">Patch Home</a> > Patch History</div></div></div>
<div class="news_content">

<div class="article_news">
<?php
	
	$patchData = file_get_contents('patchdata.json');
	$patchDataJSON = json_decode($patchData);
	
	echo '<div class="patch_table">';
	
	$thePatches = array_reverse($patchDataJSON->patches);
	$iterator = count($thePatches);
	foreach ($thePatches as $patch)
	{
			echo '<div class="patch_row">';
			echo '<a href="http://www.moba-champion.com/patch/patch.php?id=' . $patch->id . '">' . $patch->name. '</a> (' . $patch->date . ')';
			echo '</div>';
			
			$iterator--;
	}
	echo '</div>';
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