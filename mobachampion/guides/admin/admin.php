<?php
include('../../header.php');
?>


<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Admin</div></div></div>
<div class="news_content">


<div class="article_news">

<?php
if ($user_info['is_admin'])
{
	$gid = $_GET['id'];
	$guide = R::findOne('guide','id = :gid', array(':gid'=>$gid) );
	if (!is_null($guide))
	{
		echo 'Guide: ' . $guide->title . '(' . $guide->id . ') by ' . $guide->author . ' featured status: ' . $guide->featured; 
		echo '<HR>';
	}
	
	echo '<input class="guide_admin_featured" type="shaper" name="guideadminfeatured"/>';
	echo '<button type="button" class="guide_admin_featured_submit">Submit</button>';
	echo '<HR>';
	
	echo '<script>';
	echo '
	function SubmitAdminFeatured()
	{	
		var url = "featured.php";
		var gid = $(".guide_admin_featured").val();
		
		$.post(url,
		{ 
            gid : gid,
		},
		function(data) 
		{		
			location.reload();
		});
	}
	
	$(document).ready(function() 
	{
		$(".guide_admin_featured_submit").click(function()
		{
			SubmitAdminFeatured();
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
include('../../footer.php');
?>
