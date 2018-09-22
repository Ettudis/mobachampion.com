<?php
echo '<div>';

$randWidgetDisplay = rand( 1 , 1 );
if ($randWidgetDisplay == 1)
{
	$lamentz = R::load('lamentz', 1);
	if ($lamentz->id == 1)
	{
	echo '<div class="mobawidget">
			<div class="widget_header">
				<div class="widget_header_text"><B>Dawngate Chronicles Analysis</B></div>
			</div>';
		
		echo '<div class="news_chronicles_area">';
			echo '<div class="news_chronicles_inner">';
			
				echo '<div class="news_chronicles_post">';
					echo '<div class="news_chronicles_img">
							<img src="' . $lamentz->monday_thumb . '" class="chronicles_link">';
					echo '<div class="news_chronicles_overlay" data-id="' . $lamentz->monday_article . '"></div>';
					echo '</div>';
					echo '<div class="news_chronicles_day">Monday</div>';
				echo '</div>';
				
				echo '<div class="news_chronicles_post">';
					echo '<div class="news_chronicles_img">
							<img src="' . $lamentz->wednesday_thumb . '" class="chronicles_link">';
					echo '<div class="news_chronicles_overlay" data-id="' . $lamentz->wednesday_article . '"></div>';
					echo '</div>';
					echo '<div class="news_chronicles_day">Wednesday</div>';
				echo '</div>';
				
				echo '<div class="news_chronicles_post">';
					echo '<div class="news_chronicles_img">
							<img src="' . $lamentz->friday_thumb . '" class="chronicles_link">';
					echo '<div class="news_chronicles_overlay" data-id="' . $lamentz->friday_article . '"></div>';
					echo '</div>';
					echo '<div class="news_chronicles_day">Friday</div>';
				echo '</div>';
				
			echo '</div>';
		echo '</div>';
		
		echo '</div>';
		
		echo '<script>
				$(document).ready(function() 
				{
					$(".news_chronicles_overlay").click(function()
					{
						var link = "http://www.moba-champion.com/articles/" + $(this).data("id");
						window.location.href = link;
						console.log("trace1");
					});
				});
			  </script>';
	}
}
else if ($randWidgetDisplay == 0)
{
	echo '<a href="http://www.moba-champion.com/contests">
			<img src="">
		  </a>';
}
else
{
	echo '<a href="http://www.dawnscout.com"><img src="http://www.moba-champion.com/news/ds.png"></a>';
}
echo '</div>';
?>