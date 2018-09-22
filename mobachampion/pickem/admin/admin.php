<?php
include('../../header.php');
echo '<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">';
?>


<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Pickem Admin</div></div></div>
<div class="news_content">


<div class="article_news">

<?php
if ($user_info['is_admin'])
{
	echo '<h3>Create Pickem</h3>';
	
	echo '<label for="pickem_date">Date</label>';
	echo '<input id="pickem_date" type="shaper"/>';

	echo '<label for="pickem_time">Time (Hours) i.e. 4:30 => 16.5</label>';
	echo '<input id="pickem_time" type="shaper"/>';
	
	echo '<label for="pickem_name">Event Name</label>';
	echo '<input id="pickem_name" type="shaper"/>';
	
	echo '<label for="pickem_icon">Event Icon URL</label>';
	echo '<input id="pickem_icon" type="shaper"/>';
	
	echo '<label for="pickem_banner">Event Banner URL</label>';
	echo '<input id="pickem_banner" type="shaper"/>';
	
	echo '<label for="pickem_num">Num Matchups</label>';
	echo '<input id="pickem_num" type="shaper"/>';
	
	echo '<label for="pickem_format">Format</label>';
	echo '<select id="pickem_format" type="shaper">';
	echo '<option value="r08simple">Simple Round of 8</option>';
	echo '<option value="r16simple">Simple Round of 16</option>';
	echo '</select>';
	
	echo '<div class="r08simple">';
	echo '<label for="r08simple_match1">Match 1</label>';
	echo '<input id="r08simple_match1" type="shaper"/>';
	echo '<label for="r08simple_match2">Match 2</label>';
	echo '<input id="r08simple_match2" type="shaper"/>';	
	echo '<label for="r08simple_match3">Match 3</label>';
	echo '<input id="r08simple_match3" type="shaper"/>';	
	echo '<label for="r08simple_match4">Match 4</label>';
	echo '<input id="r08simple_match4" type="shaper"/>';
	echo '<label for="r08simple_match5">Match 5</label>';
	echo '<input id="r08simple_match5" type="shaper"/>';
	echo '<label for="r08simple_match6">Match 6</label>';
	echo '<input id="r08simple_match6" type="shaper"/>';	
	echo '<label for="r08simple_match7">Match 7</label>';
	echo '<input id="r08simple_match7" type="shaper"/>';	
	echo '<label for="r08simple_match8">Match 8</label>';
	echo '<input id="r08simple_match8" type="shaper"/>';	
	echo '</div>';
	
	echo '<BR><button type="button" id="pickem_create">Create</button>';
	
	echo '<script>';
	echo '
	function CreatePickem()
	{	
		var url = "createpickem.php";

		var name = $("#pickem_name").val();
		var gdate = $("#pickem_date").val();
		var gtime = $("#pickem_time").val();
		
		var utcdate = new Date(gdate);
		utcdate.setHours(gtime);
		var utcfinal = utcdate.getTime() / 1000;
		console.log(utcfinal);
		
		var format = $("#pickem_format").val();
		var nummatchups = $("#pickem_num").val();
		var icon = $("#pickem_icon").val();
		var banner = $("#pickem_banner").val();
		
		// simple round of 8/16
		var pickem1 = $("#r08simple_match1").val();
		var pickem2 = $("#r08simple_match2").val();
		var pickem3 = $("#r08simple_match3").val();
		var pickem4 = $("#r08simple_match4").val();
		var pickem5 = $("#r08simple_match5").val();
		var pickem6 = $("#r08simple_match6").val();
		var pickem7 = $("#r08simple_match7").val();
		var pickem8 = $("#r08simple_match8").val();
		
		console.log(name);
		console.log(utcfinal);
		console.log(icon);
		console.log(banner);
		console.log(format);
		console.log(nummatchups);
		console.log(pickem1);
		console.log(pickem2);
		console.log(pickem3);
		console.log(pickem4);
		console.log(pickem5);
		console.log(pickem6);
		console.log(pickem7);
		console.log(pickem8);
		
		$.post(url,
		{ 
            name : name,
			icon : icon,
			banner : banner,
			utcfinal : utcfinal,
			format : format,
			nummatchups : nummatchups,
			pickem1 : pickem1,
			pickem2 : pickem2,
			pickem3 : pickem3,
			pickem4 : pickem4,
			pickem5 : pickem5,
			pickem6 : pickem6,
			pickem7 : pickem7,
			pickem8 : pickem8
		},
		function(data) 
		{		
			console.log(data);
		});
	}
	
	
	$(document).ready(function() 
	{
		$("#pickem_date").datepicker();
		$("#pickem_create").click(function()
		{
			CreatePickem();
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
