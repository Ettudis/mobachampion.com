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
		$path = 'src/patch' . $id . '.json';
		$patchData = file_get_contents($path);
		if ($patchData != false)
		{
			$patchDataJSON = json_decode($patchData);
				
			echo '<div class="news_post">
			<div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/patch/">Patch Home</a> > ' . $patchDataJSON->name . '</div><div class="news_poster">' . $patchDataJSON->date . '</div></div></div>
			<div class="news_content">

			<div class="article_news">';
		
			echo '<div class="patchnotes waystone_regtext">';

			foreach ($patchDataJSON->patch as $patch)
			{
				if (!is_null($patch->shaper))
				{
					echo '<h5><img src="http://www.moba-champion.com/images/shapers/' . strtolower($patch->shaper) . '.png" style="width: 24px; height: 24px;"> ' . $patch->shaper . '</h5>';
				}
				
				if (!is_null($patch->role))
				{
					echo '<h5><img src="http://www.moba-champion.com/images/roles/' . strtolower($patch->role) . '.png" style="width: 24px; height: 24px;"> ' . $patch->role . '</h5>';
				}

				if (!is_null($patch->spell))
				{
					echo '<h5><img src="http://www.moba-champion.com/images/spells/Spell_' . $patch->spell . '_1.png" style="width: 24px; height: 24px;"> ' . $patch->spell . '</h5>';
				}

				if (!is_null($patch->item))
				{
					echo '<h5><img src="http://www.moba-champion.com/images/items/list/' . $patch->item . '.png" style="width: 24px; height: 24px;"> ' . $patch->item . '</h5>';
				}
				
				if (!is_null($patch->itemp))
				{
					echo '<h5><img class="iptip" title="'. $patch->itemp .'" src="http://www.moba-champion.com/images/itempalooza/' . $patch->itemp . '.png" style="width: 24px; height: 24px;"> ' . $patch->itemp . '</h5>';
				}

				if (!is_null($patch->loadout))
				{
					echo '<h5>' . $patch->loadout . '</h5>';
				}				
				
				echo '<p>' . $patch->data . '</p>';
			}
			
			echo '</div>';
		}
		else
		{
			echo '<div class="news_post"><div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/patch/">Patch Home</a> > Patch Notes</div></div></div><div class="news_content"><div class="article_news">';
			echo '<p>Patch data was not found.</p>';
		}		
	}
	else
	{
			echo '<div class="news_post"><div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/patch/">Patch Home</a> > Patch Notes</div></div></div><div class="news_content"><div class="article_news">';
			echo '<p>Patch data was not found.</p>';
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