<div class="mobawidget">
	<div class="widget_header">
		<div class="widget_header_text"><a href="http://www.moba-champion.com/counterpicks">Counter Picks</a></div>
	</div>
	
	<div class="widget_shaper_list">
	
		<?php
		$shaperPath = $_SERVER['DOCUMENT_ROOT'] . "/data/shaperdata.json";
		$widgetShaperData = file_get_contents($shaperPath);
		$widgetShaperJSON = json_decode($widgetShaperData);

		foreach ($widgetShaperJSON as $shaper_entry)
		{
			$lcShaper = strtolower ($shaper_entry->name);
			echo '<div class="widget_shaper_entry shapertip" title="' . $shaper_entry->name . '">';
			echo '<a href="http://www.moba-champion.com/counterpicks/shaper.php?shaper=' . $shaper_entry->name . '">';
			echo '<img class="widget_shaper_pic" src="http://www.moba-champion.com/images/shapers/' . $lcShaper . '.png">';
			echo '</a></div>';
		}
		
		?>

	</div>
</div>