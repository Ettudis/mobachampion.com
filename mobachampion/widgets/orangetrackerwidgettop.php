<div class="mobawidget">
	<div class="widget_header">
		<div class="widget_header_text"><a href="http://www.moba-champion.com/orangetracker/" id="widget_shaper_head">Orange Tracker</a></div>
	</div>
	
	<div>
	
		<?php
		
		
		$otposts = 'SELECT id, url, title, poster, content, topic, MAX(posttime) as maxpost, posttime, type, responseto, count(topic) as topiccount 
					FROM otpost
					WHERE type="reddit"
				GROUP BY otpost.topic,posttime
				ORDER BY maxpost DESC
				LIMIT 1,5';
			
		$otpostsRows = R::getAll($otposts);
		$otpostsBeans = R::convertToBeans('otpost',$otpostsRows);
	
		foreach ($otpostsBeans as $otpost)
		{	
			echo '<div class="ot_widget_row">';
			
			echo '<div class="ot_widget_type">';
			if ($otpost->type == "reddit")
			{
				echo '<a href="' . $otpost->url . '"><img src="http://www.moba-champion.com/images/social/grey/reddit-logo.png"></a>';
			}
			else if ($otpost->type == "twitter")
			{
				echo '<a href="' . $otpost->url . '"><img src="http://www.moba-champion.com/images/social/grey/twitter.png"></a>';
			}
			else
			{
				echo '<img src="http://www.moba-champion.com/images/social/grey/reddit-logo.png">';
			}
			echo '</div>';
			
			echo '<div class="ot_widget_title">';
				$title = htmlspecialchars_decode($otpost->title);
				$title = str_replace("\'", "'", $title);
				$title = str_replace("\\\"", "\"", $title);
				if (strlen($title) > 32)
				{
					$title = substr($title, 0, 32) . '...';
				}
				echo '<a href="http://www.moba-champion.com/orangetracker/post.php?id=' . $otpost->topic . '">' . $title . '</a>';
			echo '</div>';
			
			echo '<div class="ot_widget_time">';
				$time = time() - $otpost->maxpost + 3600; // DST
				$days = floor($time / 86400);
				$months = floor($days / 30);
				$hours = floor($time / 3600);
				$minute = floor($time / 60);
				
				if ($time < 0)
				{
					echo 'Now';
				}
				else if ($months > 1)
				{
					echo $months . 'm ago';
				}
				else if ($months == 1)
				{
					echo $months . 'm ago';
				}
				else if ($days > 1)
				{
					echo $days . 'd ago';
				}
				else if ($days == 1)
				{
					echo $days . 'd ago';
				}
				else if ($hours > 1)
				{
					echo $hours . 'h ago';
				}
				else
				{
					echo '1h ago';
				}
			echo '</div>';
			echo '</div>'; // echo '<div class="ot_widget_row">';
		}
		
		?>

	</div>
</div>