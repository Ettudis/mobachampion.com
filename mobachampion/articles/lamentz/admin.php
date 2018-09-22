<?php
include('../../header.php');
?>


<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Dawngate Chronicles Analysis Admin</div></div></div>
<div class="news_content">


<div class="article_news">

<?php

$startPage = 0;
$postsPerPage = 3;
$PostList = ssi_recentTopics_newsPage($startPage, $postsPerPage, null, array(8), 'array');

if ($user_info['is_admin'])
{ 
	$lamentz = R::load('lamentz', 1);
	echo '<h3>Articles</h3>';
	echo '<label for="1">Monday Article</label>';
	echo '<select class="monday_article" style="width:400px;">';
		$bFound = false;
		if ($PostList[0]['topic'] == $lamentz->monday_article)
		{
			$bFound = true;
			echo '<option value="' . $PostList[0]['topic'] . '" selected>' . $PostList[0]['subject'] . '</option>';
		}
		else
		{
			echo '<option value="' . $PostList[0]['topic'] . '">' . $PostList[0]['subject'] . '</option>';
		}
		if ($PostList[1]['topic'] == $lamentz->monday_article)
		{
			$bFound = true;
			echo '<option value="' . $PostList[1]['topic'] . '" selected>' . $PostList[1]['subject'] . '</option>';
		}
		else
		{
			echo '<option value="' . $PostList[1]['topic'] . '">' . $PostList[1]['subject'] . '</option>';
		}
		if ($PostList[2]['topic'] == $lamentz->monday_article)
		{
			$bFound = true;
			echo '<option value="' . $PostList[2]['topic'] . '" selected>' . $PostList[2]['subject'] . '</option>';
		}
		else
		{
			echo '<option value="' . $PostList[2]['topic'] . '">' . $PostList[2]['subject'] . '</option>';
		}

		if (!$bFound)
		{
			echo '<option value="0" selected>none</option>';
		}
		else
		{
			echo '<option value="0">none</option>';
		}
	echo '</select>';
	
	echo '<label for="1">Wednesday Article</label>';
	echo '<select class="wednesday_article" style="width:400px;">';
		$bFound = false;
		if ($PostList[0]['topic'] == $lamentz->wednesday_article)
		{
			$bFound = true;
			echo '<option value="' . $PostList[0]['topic'] . '" selected>' . $PostList[0]['subject'] . '</option>';
		}
		else
		{
			echo '<option value="' . $PostList[0]['topic'] . '">' . $PostList[0]['subject'] . '</option>';
		}
		if ($PostList[1]['topic'] == $lamentz->wednesday_article)
		{
			$bFound = true;
			echo '<option value="' . $PostList[1]['topic'] . '" selected>' . $PostList[1]['subject'] . '</option>';
		}
		else
		{
			echo '<option value="' . $PostList[1]['topic'] . '">' . $PostList[1]['subject'] . '</option>';
		}
		if ($PostList[2]['topic'] == $lamentz->wednesday_article)
		{
			$bFound = true;
			echo '<option value="' . $PostList[2]['topic'] . '" selected>' . $PostList[2]['subject'] . '</option>';
		}
		else
		{
			echo '<option value="' . $PostList[2]['topic'] . '">' . $PostList[2]['subject'] . '</option>';
		}

		if (!$bFound)
		{
			echo '<option value="0" selected>none</option>';
		}
		else
		{
			echo '<option value="0">none</option>';
		}
	echo '</select>';
		
	echo '<label for="1">Friday Article</label>';
	echo '<select class="friday_article" style="width:400px;">';
		$bFound = false;
		if ($PostList[0]['topic'] == $lamentz->friday_article)
		{
			$bFound = true;
			echo '<option value="' . $PostList[0]['topic'] . '" selected>' . $PostList[0]['subject'] . '</option>';
		}
		else
		{
			echo '<option value="' . $PostList[0]['topic'] . '">' . $PostList[0]['subject'] . '</option>';
		}
		if ($PostList[1]['topic'] == $lamentz->friday_article)
		{
			$bFound = true;
			echo '<option value="' . $PostList[1]['topic'] . '" selected>' . $PostList[1]['subject'] . '</option>';
		}
		else
		{
			echo '<option value="' . $PostList[1]['topic'] . '">' . $PostList[1]['subject'] . '</option>';
		}
		if ($PostList[2]['topic'] == $lamentz->friday_article)
		{
			$bFound = true;
			echo '<option value="' . $PostList[2]['topic'] . '" selected>' . $PostList[2]['subject'] . '</option>';
		}
		else
		{
			echo '<option value="' . $PostList[2]['topic'] . '">' . $PostList[2]['subject'] . '</option>';
		}

		if (!$bFound)
		{
			echo '<option value="0" selected>none</option>';
		}
		else
		{
			echo '<option value="0">none</option>';
		}
	echo '</select>';
	
		echo '<hr>';
		
	echo '<h3>Thumbnails</h3>';
	echo '<label for="4">Monday Thumbnail</label>';
	echo '<input class="monday_thumb" type="shaper" name="guidetitle" id="4"/ value="' . $lamentz->monday_thumb . '" style="width:400px;">';
	
	echo '<label for="5">Thursday Thumbnail</label>';
	echo '<input class="wednesday_thumb" type="shaper" name="guidetitle" id="5"/ value="' . $lamentz->wednesday_thumb . '" style="width:400px;">';
	
	echo '<label for="6">Friday Thumbnail</label>';
	echo '<input class="friday_thumb" type="shaper" name="guidetitle" id="6"/ value="' . $lamentz->friday_thumb . '" style="width:400px;">';
	
	echo '<hr>';
	
	echo '<h3>Recent Articles</h3>';
	echo '<a href="http://www.moba-champion.com/articles/' . $PostList[0]['topic'] . '">' . $PostList[0]['subject'] . ' </a><BR>';
	echo '<a href="http://www.moba-champion.com/articles/' . $PostList[1]['topic'] . '">' . $PostList[1]['subject'] . ' </a><BR>';
	echo '<a href="http://www.moba-champion.com/articles/' . $PostList[2]['topic'] . '">' . $PostList[2]['subject'] . ' </a><BR>';	
	echo '<hr>';
	
	echo '<button type="button" class="lamentz_update">Submit</button>';
	
	echo '<script>';
	echo '
	function UpdateLamentz()
	{	
		var url = "update.php";
		
		var monday_article = $(".monday_article").val();
		var wednesday_article = $(".wednesday_article").val();
		var friday_article = $(".friday_article").val();
		
		var monday_thumb = $(".monday_thumb").val();
		var wednesday_thumb = $(".wednesday_thumb").val();
		var friday_thumb = $(".friday_thumb").val();
		
		console.log(monday_article);
		console.log(wednesday_article);
		console.log(friday_article);
		console.log(monday_thumb);
		console.log(wednesday_thumb);
		console.log(friday_thumb);
		
		$.post(url,
		{ 
			monday_article : monday_article,
			wednesday_article : wednesday_article,
			friday_article : friday_article,
            monday_thumb : monday_thumb,
			wednesday_thumb : wednesday_thumb,
			friday_thumb : friday_thumb
		},
		function(data) 
		{		
			location.reload();
		});
	}
	
	
	$(document).ready(function() 
	{
		$(".lamentz_update").click(function()
		{
			UpdateLamentz();
		});	
	});
		';
			
	echo '</script>';
}

?>
	
</div>
</div>

</div></div>

<div class="article_column2">
<?php 
include('../../widgets/shaperwidget.php');
include('../../widgets/adwidget.php');
include('../../widgets/streamwidget.php');
include('../../widgets/guidewidget.php');
?>
</div>

</div> <!-- main container -->
</div> <!-- maincontent -->

<?php
include('../footer.php');
?>
