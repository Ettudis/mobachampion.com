<div class="shaper_area_overview_right">
	<table>
		<tr>
			<td class="shaper_area_overview_c1">HEALTH</td><td class="shaper_area_overview_c2">540 (+84)</td>
			<td class="shaper_area_overview_c1">HEALTH REGEN</td><td class="shaper_area_overview_c2">8 (+0.5)</td>
		</tr>
		<tr>
			<td class="shaper_area_overview_c1">BASIC ATTACK</td><td class="shaper_area_overview_c2">63 (+2.7)</td>
			<td class="shaper_area_overview_c1">ATTACK SPEED</td><td class="shaper_area_overview_c2">1.5 (+3.0%)</td>
		</tr>
		<tr>
		<?php 
		global $extraRange;
		if (isset($extraRange))
		{
			echo '<td class="shaper_area_overview_c1">ATTACK RANGE</td><td class="shaper_area_overview_c2">' . (130 + $extraRange) . '</td>';
		}
		else
		{
			echo '<td class="shaper_area_overview_c1">ATTACK RANGE</td><td class="shaper_area_overview_c2">130</td>';
		}
		?>
			<td class="shaper_area_overview_c1">MOVE SPEED</td><td class="shaper_area_overview_c2">395</td>
		</tr>
		<tr>
			<td class="shaper_area_overview_c1">ARMOR</td><td class="shaper_area_overview_c2">21 (+3.3)</td>
			<td class="shaper_area_overview_c1">MAGIC RESIST</td><td class="shaper_area_overview_c2">33 (+1.0)</td>
		</tr>
		<tr>
			<td class="shaper_area_overview_c1">ATTACK HASTE RATIO</td><td class="shaper_area_overview_c2">1.0</td>
			<td class="shaper_area_overview_c1">SPELL HASTE RATIO</td><td class="shaper_area_overview_c2">0.2</td>
		</tr>
		<tr>
			<td class="shaper_area_overview_c1">ATTACK POWER RATIO</td><td class="shaper_area_overview_c2">1.0</td>
			<td class="shaper_area_overview_c1"></td><td class="shaper_area_overview_c2"></td>
		</tr>						
	</table>
</div>