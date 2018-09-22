<div class="mobawidget">
	<div class="widget_header">
		<div class="widget_header_text"><a href="http://www.moba-champion.com/shapers">Shaper Guides</a></div>
	</div>
	
	<div class="widget_shaper_list">
	
		<?php
		$shaperPath = $_SERVER['DOCUMENT_ROOT'] . "/data/shaperdata.json";
		$widgetShaperData = file_get_contents($shaperPath);
		$widgetShaperJSON = json_decode($widgetShaperData);
		
		$freeWeekPath = $_SERVER['DOCUMENT_ROOT'] . "/data/freeweek.json";
		$freeWeekData = file_get_contents($freeWeekPath);
		$freeWeekJSON = json_decode($freeWeekData);		

		foreach ($widgetShaperJSON as $shaper_entry)
		{			
			$lcShaper = strtolower ($shaper_entry->name);
			$free = false;
			foreach ($freeWeekJSON->array as $freeEntry)
			{
				if (strcasecmp($freeEntry,$shaper_entry->name) == 0)
				{
					$free = true;
				}
			}	
			
			echo '<div class="widget_shaper_entry shapertip" title="' . $shaper_entry->name . '">';
			echo '<a href="http://www.moba-champion.com/guides/list.php?shaper=' . $shaper_entry->name . '">';
			echo '<img class="widget_shaper_pic" src="http://www.moba-champion.com/images/shapers/' . $lcShaper . '.png">';
			echo '</a>';		
			
			echo '<div class="widget_shaper_overlay">';
			if ($free)
			{
				echo '<img src="http://www.moba-champion.com/images/icons/icon_shaperRotation.png">';
			}
			else
			{
				echo '<img src="http://moba-champion.com/images/icons/icon_shaperLocked.png">';
			}
			echo '</div>';
			
			echo '</div>';		
		}
		
		?>

	</div>
</div>