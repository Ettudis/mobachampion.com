<?php
echo '<div>';

//$randWidgetDisplay = rand( 1 , 1 );
if (true)
{
	$lamentz = R::load('lamentz', 1);
	if ($lamentz->id == 1)
	{
	echo '<div class="mobawidget">
			<div class="widget_header">
				<div class="widget_header_text"><B>Dawngate Chronicles</B></div>
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
						if ($(this).data("id") != "0" && $(this).data("id") != 0)
						{
							var link = "http://www.dawngatechronicles.com/season-one/" + $(this).data("id");
							window.location.href = link;
						}
					});
				});
			  </script>';
	}
}
else
{
	echo '<div style="margin-top: 8px;margin-bottom:16px; border-radius:8px;box-shadow: 0 0 5px rgba(0,0,0,0.75);">';
	echo '<a href="http://www.dawnscout.com"><img src="http://www.moba-champion.com/news/ds.png" style="border-radius:8px;"></a>';
	echo '</div>';
}
echo '</div>';
?>