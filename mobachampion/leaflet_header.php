error_log('trace?');

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="leaflet/dist/leaflet.label.css" />
<link rel="stylesheet" href="leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="leaflet/dist/MarkerCluster.css" />
<script src="leaflet/dist/leaflet.js"></script>	
<script src="leaflet/dist/leaflet.label.js"></script>
<script src="leaflet/dist/leaflet.markercluster.js"></script>

<script>
window.onload = function()
{
	//everything goes here
	var map = L.map('map', {
		center: [30.0, -30.0],
		zoom: 2,
		zoomControl:false,
		dragging: false,
		});

	var dawnMap = L.tileLayer('Map/DawnMapTiles/{z}/{x}/{y}.png', {
		attribution: 'MOBA-Champion',
		minZoom: 2,
		maxZoom: 2,
		noWrap: true,
		}).addTo(map);
						
	var popup = L.popup();

	//MONEY PIG ICONS
	var MoneyPigIcon = L.icon({
		iconUrl: 'Icons/moneypig-icon.png',

		iconSize:     [30, 30], // size of the icon
		iconAnchor:   [15, 15], // point of the icon which will correspond to marker's location
		popupAnchor:  [0, -15] // point from which the popup should open relative to the iconAnchor
	});

	L.marker([78.49055, -152.57812], {riseOnHover: true, icon: MoneyPigIcon}).bindLabel("<center><b>Money Pigs</b></br>Spawn: 3:00</br>Respawn:5:00</br>Vim:162 + 1.75/lvl</br>Exp: 435 + 6.9/lvl</center>").addTo(map);
	
	L.marker([-37.99616, 64.33594], {riseOnHover: true, icon: MoneyPigIcon}).bindLabel("<center><b>Money Pigs</b></br>Spawn: 3:00</br>Respawn:5:00</br>Vim:162 + 1.75/lvl</br>Exp: 435 + 6.9/lvl</center>").addTo(map);

	//FOUNTAIN ICON
	var FountainIcon = L.icon({
		iconUrl: 'Icons/fountain-icon.png',

		iconSize:     [30, 30], // size of the icon
		iconAnchor:   [15, 15], // point of the icon which will correspond to marker's location
		popupAnchor:  [0, -15] // point from which the popup should open relative to the iconAnchor	
	});

	L.marker([-53.95609, -152.57812], {riseOnHover: true, icon: FountainIcon}).bindLabel("<left><b>Shop & Fountain</b></br>Heals Shapers</br>Able to buy items</br>Protected by high damage turret</left>").addTo(map);	
	L.marker([82.2617, 64.6875], {riseOnHover: true, icon: FountainIcon}).bindLabel("<left><b>Shop & Fountain</b></br>Heals Shapers</br>Able to buy items</br>Protected by high damage turret</left>").addTo(map);	

	//SPIRIT WELL ICON
	var SpiritWellIcon = L.icon({
    iconUrl: 'Icons/spiritwell-icon.png',

    iconSize:     [30, 30], // size of the icon
    iconAnchor:   [15, 15], // point of the icon which will correspond to marker's location
    popupAnchor:  [0, -15] // point from which the popup should open relative to the iconAnchor	
});
	
	L.marker([55.17887, -150.82031], {riseOnHover: true, icon: SpiritWellIcon}).bindLabel("<left><b>Spirit Well: West </b></br>First Unlocks: 7:30</br>Unlock After Capture: 4:00</br>Vim: 1 Vim every 1:00 for each Worker</br>Note: Captures faster with more people</br></br><b>Well Worker</b></br>Vim: ~8</br>Exp: ~35</left>").addTo(map);	
	L.marker([81.92319, -65.03906], {riseOnHover: true, icon: SpiritWellIcon}).bindLabel("<left><b>Spirit Well: North</b></br>First Unlocks: 7:30</br>Unlock After Capture: 4:00</br>Vim: 1 Vim every 1:00 for each Worker</br>Note: Captures faster with more people</br></br><b>Well Worker</b></br>Vim: ~8</br>Exp: ~35</left>").addTo(map);	
	L.marker([21.61658, 62.22656], {riseOnHover: true, icon: SpiritWellIcon}).bindLabel("<left><b>Spirit Well: East</b></br>First Unlocks: 7:30</br>Unlock After Capture: 4:00</br>Vim: 1 Vim every 1:00 for each Worker</br>Note: Captures faster with more people</br></br><b>Well Worker</b></br>Vim: ~8</br>Exp: ~35</left>").addTo(map);	
	L.marker([-52.05249, -22.85156], {riseOnHover: true, icon: SpiritWellIcon}).bindLabel("<left><b>Spirit Well: South</b></br>First Unlocks: 7:30</br>Unlock After Capture: 4:00</br>Vim: 1 Vim every 1:00 for each Worker</br>Note: Captures faster with more people</br></br><b>Well Worker</b></br>Vim: ~8</br>Exp: ~35</left>").addTo(map);	

	//Binding ICON
	var BindingIcon = L.icon({
		iconUrl: 'Icons/binding-icon.png',

		iconSize:     [30, 30], // size of the icon
		iconAnchor:   [15, 15], // point of the icon which will correspond to marker's location
		popupAnchor:  [0, -15] // point from which the popup should open relative to the iconAnchor	
	});

	//TIER 1
	L.marker([55.17887, -110.03906], {riseOnHover: true, icon: BindingIcon}).bindLabel("<left><b>Binding: Tier 1 </b></br>Global Vim: 150</br>Respawn: 12:00</left>").addTo(map);	
	L.marker([-21.28937, -22.14844], {riseOnHover: true, icon: BindingIcon}).bindLabel("<left><b>Binding: Tier 1 </b></br>Global Vim: 150</br>Respawn: 12:00</left>").addTo(map);	
	L.marker([22.26876, 22.14844], {riseOnHover: true, icon: BindingIcon}).bindLabel("<left><b>Binding: Tier 1 </b></br>Global Vim: 150</br>Respawn: 12:00</left>").addTo(map);	
	L.marker([73.5284, -66.09375], {riseOnHover: true, icon: BindingIcon}).bindLabel("<left><b>Binding: Tier 1 </b></br>Global Vim: 150</br>Respawn: 12:00</left>").addTo(map);	
	
	//TIER 2
		
	L.marker([27.37177, -111.79687], {riseOnHover: true, icon: BindingIcon}).bindLabel("<left><b>Binding: Tier 2 </b></br>Global Vim: 150</br>Respawn: 8:00</left>").addTo(map);	
	L.marker([-22.59373, -59.76562], {riseOnHover: true, icon: BindingIcon}).bindLabel("<left><b>Binding: Tier 2 </b></br>Global Vim: 150</br>Respawn: 8:00</left>").addTo(map);	
	L.marker([51.61802, 23.55469], {riseOnHover: true, icon: BindingIcon}).bindLabel("<left><b>Binding: Tier 2 </b></br>Global Vim: 150</br>Respawn: 8:00</left>").addTo(map);	
	L.marker([74.01954, -27.77344], {riseOnHover: true, icon: BindingIcon}).bindLabel("<left><b>Binding: Tier 2 </b></br>Global Vim: 150</br>Respawn: 8:00</left>").addTo(map);	
	
	//TIER 3
	L.marker([-7.01367, -133.59375], {riseOnHover: true, icon: BindingIcon}).bindLabel("<left><b>Binding: Tier 3 </b></br>Global Vim: 150</br>Respawn: 4:00</left>").addTo(map);	
	L.marker([-41.50858, -93.86719], {riseOnHover: true, icon: BindingIcon}).bindLabel("<left><b>Binding: Tier 3 </b></br>Global Vim: 150</br>Respawn: 4:00</left>").addTo(map);	
	L.marker([68.00757, 46.05469], {riseOnHover: true, icon: BindingIcon}).bindLabel("<left><b>Binding: Tier 3 </b></br>Global Vim: 150</br>Respawn: 4:00</left>").addTo(map);	
	L.marker([78.90393, 6.32813], {riseOnHover: true, icon: BindingIcon}).bindLabel("<left><b>Binding: Tier 3 </b></br>Global Vim: 150</br>Respawn: 4:00</left>").addTo(map);	
	
	//ORANGEBUFF ICON
	var OrangeBuffIcon = L.icon({
		iconUrl: 'Icons/orangebuff-icon.png',

		iconSize:     [30, 30], // size of the icon
		iconAnchor:   [15, 15], // point of the icon which will correspond to marker's location
		popupAnchor:  [0, -15] // point from which the popup should open relative to the iconAnchor	
	});
		
	L.marker([66.08936, -141.32812], {riseOnHover: true, icon: OrangeBuffIcon}).bindLabel("<left><b>Armor Buff </b></br>AKA: Orange Buff / Big Ugger Camp</br>Respawn: 5:00</br>Vim: 75 + 1.4/lvl</br>Exp: 320 + 5.0/lvl</br>Buff: +20 Armor & +1% Damage Reduction upon dealing damage, Stacks 10 Times </left>").addTo(map);	
	L.marker([-0.70311, 52.73438], {riseOnHover: true, icon: OrangeBuffIcon}).bindLabel("<left><b>Armor Buff </b></br>AKA: Orange Buff / Big Ugger Camp</br>Respawn: 5:00</br>Vim: 75 + 1.4/lvl</br>Exp: 320 + 5.0/lvl</br>Buff: +20 Armor & +1% Damage Reduction upon dealing damage, Stacks 10 Times </left>").addTo(map);	
		
	//BLUEBUFF ICON
	var BlueBuffIcon = L.icon({
		iconUrl: 'Icons/bluebuff-icon.png',
		iconSize:     [30, 30], // size of the icon
		iconAnchor:   [15, 15], // point of the icon which will correspond to marker's location
		popupAnchor:  [0, -15] // point from which the popup should open relative to the iconAnchor	
	});
		
	L.marker([14.60485, -73.125], {riseOnHover: true, icon: BlueBuffIcon}).bindLabel("<left><b>Haste Buff </b></br>AKA: Blue Buff / Big Shroom Camp</br>Respawn: 5:00</br>Vim: 75 + 0.5/lvl</br>Exp: 320 + 5.0/lvl</br>Buff: +20 Haste, after using an ability grants an addition +20 Haste for 3 seconds </left>").addTo(map);	
	L.marker([58.81374, -15.11719], {riseOnHover: true, icon: BlueBuffIcon}).bindLabel("<left><b>Haste Buff </b></br>AKA: Blue Buff / Big Shroom Camp</br>Respawn: 5:00</br>Vim: 75 + 0.5/lvl</br>Exp: 320 + 5.0/lvl</br>Buff: +20 Haste, after using an ability grants an addition +20 Haste for 3 seconds </left>").addTo(map);	
		
	//GREENBUFF ICON
	var GreenBuffIcon = L.icon({
		iconUrl: 'Icons/greenbuff-icon.png',

		iconSize:     [30, 30], // size of the icon
		iconAnchor:   [15, 15], // point of the icon which will correspond to marker's location
		popupAnchor:  [0, -15] // point from which the popup should open relative to the iconAnchor	
	});
		
	L.marker([-45.08904, 3.86719], {riseOnHover: true, icon: GreenBuffIcon}).bindLabel("<left><b>Power Buff </b></br>AKA: Green Buff / Big Fish Camp</br>Respawn: 5:00</br>Vim: 75 + 0.6/lvl</br>Exp: 320 + 5.0/lvl</br>Buff: +15 Power & Total Power Increased by 10% </left>").addTo(map);
	L.marker([79.99717, -91.40625], {riseOnHover: true, icon: GreenBuffIcon}).bindLabel("<left><b>Power Buff </b></br>AKA: Green Buff / Big Fish Camp</br>Respawn: 5:00</br>Vim: 75 + 0.6/lvl</br>Exp: 320 + 5.0/lvl</br>Buff: +15 Power & Total Power Increased by 10% </left>").addTo(map);	
		
	//GUARDIAN ICON
	var GuardianIcon = L.icon({
		iconUrl: 'Icons/guardian-icon.png',

		iconSize:     [30, 30], // size of the icon
		iconAnchor:   [15, 15], // point of the icon which will correspond to marker's location
		popupAnchor:  [0, -15] // point from which the popup should open relative to the iconAnchor	
	});
		
	L.marker([-41.50858, -132.89062], {riseOnHover: true, icon: GuardianIcon}).bindLabel("<left><b>Mortal Guardian</b></br>Spirit Wins upon Destroying </left>").addTo(map);	
	L.marker([79.10509, 45.35156], {riseOnHover: true, icon: GuardianIcon}).bindLabel("<left><b>Spirit Guardian</b></br>Mortal Wins upon Destroying </left>").addTo(map);	
		
	//UGGER CAMP
	var SmallCamp1Icon = L.icon({
		iconUrl: 'Icons/smallcamp1-icon.png',

		iconSize:     [30, 30], // size of the icon
		iconAnchor:   [15, 15], // point of the icon which will correspond to marker's location
		popupAnchor:  [0, -15] // point from which the popup should open relative to the iconAnchor	
	});
		
	L.marker([38.82259, -142.03125], {riseOnHover: true, icon: SmallCamp1Icon}).bindLabel("<left><b>Big Ugger</b></br>Vim: 58 + 0.3/lvl</br>Exp: 150 + 2.7/lvl</br><b>Little Ugger</b></br>Vim: 19 + 0.2/lvl</br>Exp: 30 + 1.5/lvl</left>").addTo(map);	
	L.marker([68.78414, -172.96875], {riseOnHover: true, icon: SmallCamp1Icon}).bindLabel("<left><b>Big Ugger</b></br>Vim: 58 + 0.3/lvl</br>Exp: 150 + 2.7/lvl</br><b>Little Ugger</b></br>Vim: 19 + 0.2/lvl</br>Exp: 30 + 1.5/lvl</left>").addTo(map);	
	L.marker([-6.66461, 85.42969], {riseOnHover: true, icon: SmallCamp1Icon}).bindLabel("<left><b>Big Ugger</b></br>Vim: 58 + 0.3/lvl</br>Exp: 150 + 2.7/lvl</br><b>Little Ugger</b></br>Vim: 19 + 0.2/lvl</br>Exp: 30 + 1.5/lvl</left>").addTo(map);	
	L.marker([42.29356, 54.14063], {riseOnHover: true, icon: SmallCamp1Icon}).bindLabel("<left><b>Big Ugger</b></br>Vim: 58 + 0.3/lvl</br>Exp: 150 + 2.7/lvl</br><b>Little Ugger</b></br>Vim: 19 + 0.2/lvl</br>Exp: 30 + 1.5/lvl</left>").addTo(map);	
		
	//SHROOM CAMP
	var SmallCamp2Icon = L.icon({
		iconUrl: 'Icons/smallcamp2-icon.png',

		iconSize:     [30, 30], // size of the icon
		iconAnchor:   [15, 15], // point of the icon which will correspond to marker's location
		popupAnchor:  [0, -15] // point from which the popup should open relative to the iconAnchor	
	});
		
	L.marker([11.1784, -41.48437], {riseOnHover: true, icon: SmallCamp2Icon}).bindLabel("<left><b>Big Shroom</b></br>Vim: 38 + 0.4/lvl</br>Exp: 80 + 1.9/lvl</br><b>Little Shroom x3</b></br>Vim: 4 + 0.1/lvl</br>Exp: 6 + 0.8/lvl</left>").addTo(map);	
	L.marker([46.55886, -80.85937], {riseOnHover: true, icon: SmallCamp2Icon}).bindLabel("<left><b>Big Shroom</b></br>Vim: 38 + 0.4/lvl</br>Exp: 80 + 1.9/lvl</br><b>Little Shroom x3</b></br>Vim: 4 + 0.1/lvl</br>Exp: 6 + 0.8/lvl</left>").addTo(map);	
	L.marker([17.30869, -93.51562], {riseOnHover: true, icon: SmallCamp2Icon}).bindLabel("<left><b>Big Shroom</b></br>Vim: 38 + 0.4/lvl</br>Exp: 80 + 1.9/lvl</br><b>Little Shroom x3</b></br>Vim: 4 + 0.1/lvl</br>Exp: 6 + 0.8/lvl</left>").addTo(map);	
	L.marker([-5.26601, -71.36719], {riseOnHover: true, icon: SmallCamp2Icon}).bindLabel("<left><b>Big Shroom</b></br>Vim: 38 + 0.4/lvl</br>Exp: 80 + 1.9/lvl</br><b>Little Shroom x3</b></br>Vim: 4 + 0.1/lvl</br>Exp: 6 + 0.8/lvl</left>").addTo(map);	
	L.marker([34.59704, -7.38281], {riseOnHover: true, icon: SmallCamp2Icon}).bindLabel("<left><b>Big Shroom</b></br>Vim: 38 + 0.4/lvl</br>Exp: 80 + 1.9/lvl</br><b>Little Shroom x3</b></br>Vim: 4 + 0.1/lvl</br>Exp: 6 + 0.8/lvl</left>").addTo(map);	
	L.marker([60.58697, -46.05469], {riseOnHover: true, icon: SmallCamp2Icon}).bindLabel("<left><b>Big Shroom</b></br>Vim: 38 + 0.4/lvl</br>Exp: 80 + 1.9/lvl</br><b>Little Shroom x3</b></br>Vim: 4 + 0.1/lvl</br>Exp: 6 + 0.8/lvl</left>").addTo(map);	
	L.marker([58.07788, 6.67969], {riseOnHover: true, icon: SmallCamp2Icon}).bindLabel("<left><b>Big Shroom</b></br>Vim: 38 + 0.4/lvl</br>Exp: 80 + 1.9/lvl</br><b>Little Shroom x3</b></br>Vim: 4 + 0.1/lvl</br>Exp: 6 + 0.8/lvl</left>").addTo(map);	
	L.marker([68.52823, -16.17187], {riseOnHover: true, icon: SmallCamp2Icon}).bindLabel("<left><b>Big Shroom</b></br>Vim: 38 + 0.4/lvl</br>Exp: 80 + 1.9/lvl</br><b>Little Shroom x3</b></br>Vim: 4 + 0.1/lvl</br>Exp: 6 + 0.8/lvl</left>").addTo(map);	
	
	//FISH CAMP
	var SmallCamp3Icon = L.icon({
		iconUrl: 'Icons/smallcamp3-icon.png',

		iconSize:     [30, 30], // size of the icon
		iconAnchor:   [15, 15], // point of the icon which will correspond to marker's location
		popupAnchor:  [0, -15] // point from which the popup should open relative to the iconAnchor	
	});
		
	L.marker([-44.08759, -42.53906], {riseOnHover: true, icon: SmallCamp3Icon}).bindLabel("<left><b>Big Fish</b></br>Vim: 45 + 0.8/lvl</br>Exp: 95 + 2.0/lvl</br><b>Little Fish x2</b></br>Vim: 6 + 0.1/lvl</br>Exp: 10 + 0.5/lvl</left>").addTo(map);	
	L.marker([-27.37177, -0.70312], {riseOnHover: true, icon: SmallCamp3Icon}).bindLabel("<left><b>Big Fish</b></br>Vim: 45 + 0.8/lvl</br>Exp: 95 + 2.0/lvl</br><b>Little Fish x2</b></br>Vim: 6 + 0.1/lvl</br>Exp: 10 + 0.5/lvl</left>").addTo(map);	
	L.marker([-55.37911, 31.99219], {riseOnHover: true, icon: SmallCamp3Icon}).bindLabel("<left><b>Big Fish</b></br>Vim: 45 + 0.8/lvl</br>Exp: 95 + 2.0/lvl</br><b>Little Fish x2</b></br>Vim: 6 + 0.1/lvl</br>Exp: 10 + 0.5/lvl</left>").addTo(map);	
	L.marker([79.8123, -45.35156], {riseOnHover: true, icon: SmallCamp3Icon}).bindLabel("<left><b>Big Fish</b></br>Vim: 45 + 0.8/lvl</br>Exp: 95 + 2.0/lvl</br><b>Little Fish x2</b></br>Vim: 6 + 0.1/lvl</br>Exp: 10 + 0.5/lvl</left>").addTo(map);	
	L.marker([75.49716, -86.83594], {riseOnHover: true, icon: SmallCamp3Icon}).bindLabel("<left><b>Big Fish</b></br>Vim: 45 + 0.8/lvl</br>Exp: 95 + 2.0/lvl</br><b>Little Fish x2</b></br>Vim: 6 + 0.1/lvl</br>Exp: 10 + 0.5/lvl</left>").addTo(map);	
	
	var smallcamp3 = L.marker([82.44876, -120.58594],{ riseOnHover: true, icon: SmallCamp3Icon }).bindLabel("<left><b>Big Fish</b></br>Vim: 45 + 0.8/lvl</br>Exp: 95 + 2.0/lvl</br><b>Little Fish x2</b></br>Vim: 6 + 0.1/lvl</br>Exp: 10 + 0.5/lvl</left>").addTo(map);	
		
	//PARASITE ICON
	var ParasiteIcon = L.icon({
		iconUrl: 'Icons/parasite-icon.png',

		iconSize:     [30, 30], // size of the icon
		iconAnchor:   [15, 15], // point of the icon which will correspond to marker's location
		LabelAnchor:  [50, 50] // point from which the popup should open relative to the iconAnchor	
	});
	
	L.marker([40.71396, -43.94531], {riseOnHover: true, riseOffset: 25000, icon: ParasiteIcon}).bindLabel("<left><b>Parasite</b></br>Spawn: 5:00</br>Respawn:5:00</br>Evolves to 2: 12:30</br> Evolves to 3: 20:00</br></br>First Form Vim: 150 + 11.67/lvl</br>First Form Exp: 435 + 6.9/lvl</br></br>Second Form Vim: 325 + 11.67/lvl</br>Second Form Exp: 650 + 16.67/lvl</br>Buff: +X Power, X% HP Regen</br></br>Third Form Vim: 500</br>Third Form Exp: 900</br>Buff: +X Power, X% HP Regen</left>").addTo(map);
}
</script>