<div class="shaper_area_overview_right">
	<table>
		<tr>
			<td class="shaper_area_overview_c1">HEALTH</td><td class="shaper_area_overview_c2">515 (+65)</td>
			<td class="shaper_area_overview_c1">HEALTH REGEN</td><td class="shaper_area_overview_c2">7.5 (+0.65)</td>
		</tr>
		<tr>
			<td class="shaper_area_overview_c1">BASIC ATTACK</td><td class="shaper_area_overview_c2">59 (+2.4)</td>
			<td class="shaper_area_overview_c1">ATTACK SPEED</td><td class="shaper_area_overview_c2">1.5 (+3.1%)</td>
		</tr>
		<tr>
		<?php 
		if (isset($extraRange))
		{
			echo '<td class="shaper_area_overview_c1">ATTACK RANGE</td><td class="shaper_area_overview_c2">' . (130 + $extraRange) . '</td>';
		}
		else
		{
			echo '<td class="shaper_area_overview_c1">ATTACK RANGE</td><td class="shaper_area_overview_c2">130</td>';
		}
		?>
			<td class="shaper_area_overview_c1">MOVE SPEED</td><td class="shaper_area_overview_c2">390</td>
		</tr>
		<tr>
			<td class="shaper_area_overview_c1">ARMOR</td><td class="shaper_area_overview_c2">19 (+3.4)</td>
			<td class="shaper_area_overview_c1">MAGIC RESIST</td><td class="shaper_area_overview_c2">33 (+1.0)</td>
		</tr>
		<tr>
			<td class="shaper_area_overview_c1">ATTACK HASTE RATIO</td><td class="shaper_area_overview_c2">0.6</td>
			<td class="shaper_area_overview_c1">SPELL HASTE RATIO</td><td class="shaper_area_overview_c2">0.6</td>
		</tr>
		<tr>
			<td class="shaper_area_overview_c1">ATTACK POWER RATIO</td><td class="shaper_area_overview_c2">1.0</td>
			<td class="shaper_area_overview_c1"></td><td class="shaper_area_overview_c2"></td>
		</tr>						
	</table>
</div>