var tt_Parasite = "<left><b>Parasite</b></br>Spawn: 5:00</br>Respawn: 5:00 after death</br>Evolves to Stage 2: 15:00</br> Evolves to Stage 3: 25:00</br></br>First Form Vim: 155 + 5/lvl</br>First Form Exp: 204 + 9.75/lvl</br></br>Second Form Vim: 255 + 5/lvl</br>Second Form Exp: 400 + 9.75/lvl</br>Buff: +25 Power, 3% Max HP Regen / 5 Seconds</br></br>Third Form Vim: 350</br>Third Form Exp: 585</br>Buff: +50 Power, 3% Max HP Regen / 5 Seconds</br></br>The team that kills that Stage 3 Parasite is granted Striders with each minion wave for 4 minutes.</left>";
var tt_t1binding = "<left><b>Binding: Tier 1 </b></br>Global Vim: 150</br>Health: 3000</left>";
var tt_t2binding = "<left><b>Binding: Tier 2 </b></br>Global Vim: 150</br>Health: 3750</left>";
var tt_t3binding = "<left><b>Binding: Tier 3 </b></br>Global Vim: 150</br>Health: 4500</left>";
var tt_spiritwells = "<left><b>Spirit Well: </b></br>First Unlocks: 15:00</br>Unlock After Capture: 4:00</br>Vim: 1.5 Vim every 1:00 for each Worker</br>Note: Captures faster with more people</br></br><b>Well Worker</b></br>Vim: 6 + 0.1/level</br>Exp: 20 + 2/level</br></br>When killed, workers grant an additional 50% of their collected Vim to all nearby</br>allied players within 1200 range.</left>";
var tt_fountain = "<left><b>Shop & Fountain</b></br>Heals Shapers</br>Able to buy items</br>Protected by high damage turret</left>";
var tt_guardian1 = "<left><b>Mortal Guardian</b></br>5000 Health</br>100 Armor</br></br>Spirit Wins upon Destroying </br></br>Minions spawn at 1:00</left>";
var tt_guardian2 = "<left><b>Spirit Guardian</b></br>5000 Health</br>100 Armor</br></br>Mortal Wins upon Destroying </br></br>Minions spawn at 1:00</left>";
var tt_moneypigs = "<center><b>Money Pigs</b></br>Spawn: 3:30</br>Respawn: 5:00</br></br><b>Large Pig</b></br>Vim: 110 + 1/lvl</br>Exp: 135 + 3.0/lvl</br></br><b>Small Pig</b></br>Vim: 52 + 0.75/level</br>Exp: 80 + 1.5/level</center>";
var tt_haste = "<left><b>Haste Buff </b></br>AKA: Blue Buff / Big Shroom Camp</br>Respawn: 5:00</br></br>Vim: 75 + 0.5/lvl</br>Exp: 290 + 5.0/lvl</br>Buff: +20 Haste, after using an ability grants an addition +20 Haste for 3 seconds </left>";
var tt_power = "<left><b>Power Buff </b></br>AKA: Green Buff / Big Fish Camp</br>Respawn: 5:00</br></br>Vim: 75 + 0.6/lvl</br>Exp: 290 + 5.0/lvl</br>Buff: +15 Power & Total Power Increased by 10% </left>";
var tt_armor = "<left><b>Armor Buff </b></br>AKA: Orange Buff / Big Ugger Camp</br>Respawn: 5:00</br></br>Vim: 75 + 1.4/lvl</br>Exp: 290 + 5.0/lvl</br>Buff: +20 Armor & +1% Damage Reduction upon dealing damage, Stacks 10 Times </left>";
var tt_fish = "<left><b>Medium Fish</b></br>Vim: 45 + 0.8/lvl</br>Exp: 135 + 2.5/lvl</br></br><b>Little Fish x2</b></br>Vim: 6 + 0.1/lvl</br>Exp: 20 + 1.0/lvl</left>";
var tt_ugger = "<left><b>Medium Ugger</b></br>Vim: 58 + 0.3/lvl</br>Exp: 160 + 3.0/lvl</br></br><b>Little Ugger</b></br>Vim: 19 + 0.2/lvl</br>Exp: 40 + 1.5/lvl</left>";
var tt_shroom = "<left><b>Medium Shroom</b></br>Vim: 38 + 0.4/lvl</br>Exp: 105 + 2.0/lvl</br></br><b>Little Shroom x3</b></br>Vim: 4 + 0.1/lvl</br>Exp: 10 + 0.8/lvl</left>";
var tt_core1 = "<left><b>Guardian Core</b></br>Health: 3000</br>Armor: 50</br></br>Spawns an array of bubbles that stun enemies on contact.</left>";
var tt_core2 = "<left><b>Guardian Core</b></br>Health: 3000</br>Armor: 50</br></br>Fires a missile barrage at multiple locations.</left>";
var tt_core3 = "<left><b>Guardian Core</b></br>Health: 3000</br>Armor: 50</br></br>Fires a highly damaging AOE beam at enemies.</left>";
var tt_core4 = "<left><b>Guardian Core</b></br>Health: 3000</br>Armor: 50</br></br>Spawns health packs for the defending team, immediately healing them and boosting their power and haste.</left>";
var tt_core5 = "<left><b>Guardian Core</b></br>Health: 3000</br>Armor: 50</br></br>Casts a line of fire in a targeted direction.</left>";


$(document).ready(function() 
{
	$("#para_icon").attr('title', tt_Parasite);
	
	$(".t1b_icon").each(function()
	{
		$(this).attr('title', tt_t1binding);
	});
	
	$(".t2b_icon").each(function()
	{
		$(this).attr('title', tt_t2binding);
	});
	
	$(".t3b_icon").each(function()
	{
		$(this).attr('title', tt_t3binding);
	});
	
	$(".sw_icon").each(function()
	{
		$(this).attr('title', tt_spiritwells);
	});
	
	$(".fountain_icon").each(function()
	{
		$(this).attr('title', tt_fountain);
	});
	
	$(".guardian_icon1").each(function()
	{
		$(this).attr('title', tt_guardian1);
	});
	
	$(".guardian_icon2").each(function()
	{
		$(this).attr('title', tt_guardian2);
	});
	
	$(".mp_icon").each(function()
	{
		$(this).attr('title', tt_moneypigs);
	});
	
	$(".haste_icon").each(function()
	{
		$(this).attr('title', tt_haste);
	});
	
	$(".power_icon").each(function()
	{
		$(this).attr('title', tt_power);
	});
	
	$(".armor_icon").each(function()
	{
		$(this).attr('title', tt_armor);
	});
	
	$(".fish_icon").each(function()
	{
		$(this).attr('title', tt_fish);
	});
	
	$(".ugger_icon").each(function()
	{
		$(this).attr('title', tt_ugger);
	});
	
	$(".shroom_icon").each(function()
	{
		$(this).attr('title', tt_shroom);
	});
	
	$(".core_icon1").each(function()
	{
		$(this).attr('title', tt_core1);
	});
	$(".core_icon2").each(function()
	{
		$(this).attr('title', tt_core2);
	});
	$(".core_icon3").each(function()
	{
		$(this).attr('title', tt_core3);
	});
	$(".core_icon4").each(function()
	{
		$(this).attr('title', tt_core4);
	});
	$(".core_icon5").each(function()
	{
		$(this).attr('title', tt_core5);
	});
	
	
	$(".dawngate_map2_icon").each(function()
	{
		$(this).tooltipster();
	});
});

