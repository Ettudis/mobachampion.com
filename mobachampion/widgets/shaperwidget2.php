<div class="mobawidget">
	<div class="widget_header">
		<div class="widget_header_text"><a href="http://www.moba-champion.com/shapers" id="widget_shaper_head">Shaper Rotation</a></div>
	</div>
	
	<div class="widget_shaper_list">
	
		<?php
		$shaperPath = $_SERVER['DOCUMENT_ROOT'] . "/data/shaperdata.json";
		$widgetShaperData = file_get_contents($shaperPath);
		$widgetShaperJSON = json_decode($widgetShaperData);
		
		$freeWeekPath = $_SERVER['DOCUMENT_ROOT'] . "/data/freeweek.json";
		$freeWeekData = file_get_contents($freeWeekPath);
		$freeWeekJSON = json_decode($freeWeekData);		

		$si = 0;
		
		foreach ($freeWeekJSON->array as $freeEntry)
		{
			$lcShaper = strtolower ($freeEntry);
			
			if ($si == 0)
			{
				echo '<div class="widget_shaper_paid" style="float: left;width: 100%;color: white;font-weight: bold;">Two Weeks Remaining:</div>';
			}
			else if ($si == 5)
			{
				echo '<div class="widget_shaper_paid" style="float: left;width: 100%;color: white;font-weight: bold;">One Week Remaining:</div>';
			}
			
			echo '<div class="widget_shaper_entry widget_shaper_paid shapertip" title="' . $freeEntry . '">';
			echo '<a href="http://www.moba-champion.com/shapers/' . $lcShaper . '">';
			echo '<img class="widget_shaper_pic" src="http://www.moba-champion.com/images/shapers/' . $lcShaper . '.png">';
			echo '</a>';
			
			echo '</div>';
				
			$si++;
		}
		
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
			
			echo '<div class="widget_shaper_entry widget_shaper_paid shapertip" title="' . $shaper_entry->name . '" style="display: none;">';
			
			echo '<a href="http://www.moba-champion.com/shapers/' . $lcShaper . '">';
			echo '<img class="widget_shaper_pic" src="http://www.moba-champion.com/images/shapers/' . $lcShaper . '.png">';
			echo '</a>';		
			
			echo '<div class="widget_shaper_overlay">';
			if ($free)
			{
				echo '<img src="http://www.moba-champion.com/images/icons/icon_shaperRotation.png">';
			}
			else
			{
				//echo '<img src="http://moba-champion.com/images/icons/icon_shaperLocked.png">';
			}
			echo '</div>';
			
			echo '</div>';	
		}
		?>

	</div>
	
			
	<div class="widget_shaper_expand">+</div>
	<script>
	$(".widget_shaper_expand").click(function()
	{
		$(".widget_shaper_paid").toggle();

		if ($(this).html() == '+')
		{
			$(this).html('-');
			$("#widget_shaper_head").html("All Shapers");
		}
		else
		{
			$(this).html('+');
			$("#widget_shaper_head").html("Shaper Rotation");
		}
	});
	</script>
	

</div>