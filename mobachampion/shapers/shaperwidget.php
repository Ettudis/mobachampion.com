<div class="mobawidget">
	<div class="widget_header">
		<div class="widget_header_text"><a href="http://www.moba-champion.com/shapers">Shapers</a></div>
	</div>
	
	<div class="widget_shaper_list">
	
		<?php
		$shaperPath = $_SERVER['DOCUMENT_ROOT'] . "/data/shaperdata.json"
		$widgetShaperData = file_get_contents($shaperPath);
		$widgetShaperJSON = json_decode($widgetShaperData);

		foreach ($widgetShaperJSON as $shaper_entry)
		{
			$lcShaper = strtolower ($shaper_entry->name);
			echo '<div class="widget_shaper_entry">';
			echo '<a href="http://www.moba-champion.com/shapers/' . $lcShaper . '">';
			echo '<img class="widget_shaper_pic shapertip" src="http://www.moba-champion.com/images/shapers/' . $lcShaper . '.png" title="' . $shaper_entry->name . '">';
			echo '</a></div>';
		}
		
		?>

	</div>
</div>

<script>
$(document).ready(function() 
{
	$(".widget_shaper_pic").each(function()
	{
		$(this).tooltipster();
	});
});
</script>