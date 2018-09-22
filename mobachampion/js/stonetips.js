function AddStoneTip(matchName)
{
	
}


$(document).ready(function() 
{	
	var jsonURL = 'http://moba-champion.com/loadouts/shapes.json';
	var pathname = window.location.href;
	if (pathname.indexOf("www.") !== -1)
	{
		jsonURL = 'http://www.moba-champion.com/loadouts/shapes.json';
	}
	
	$.getJSON(jsonURL, function(data) 
	{	
		stoneData = data;
		stoneDataLoaded = true;
		
		$(".stonetip").each(function()
		{
			var special = $(this).attr('title');
			if (special && special != "")
			{	
				var name = special;
				var icon = "";
				var desc = "";
				
				if (stoneDataLoaded == true)
				{
					$.each(stoneData.special, function()
					{		
						if (name.indexOf(this.special) !== -1)
						{
							name = this.special;
							desc = this.bonus;
							icon = this.icon;
						}
					});
				}

				var htmlString;
				htmlString = '<div class="standard_tooltip">';
				htmlString += '<div class="standard_tooltip_item_content">';
				desc = desc.replace('Unique Passive', '<span class="passivetext">Unique Passive</span>');
				desc = desc.replace('Brawler', '<span class="misctext">Brawler</span>');
				desc = desc.replace('Outrider', '<span class="misctext">Outrider</span>');
				desc = desc.replace('Ravager', '<span class="misctext">Ravager</span>');
				desc = desc.replace('Hoplite', '<span class="misctext">Hoplite</span>');
				desc = desc.replace('Reaper', '<span class="misctext">Reaper</span>');
				desc = desc.replace('Scavenger', '<span class="misctext">Scavenger</span>');
				desc = desc.replace('Adventurer', '<span class="misctext">Adventurer</span>');
				desc = desc.replace('Berserker', '<span class="misctext">Berserker</span>');
				desc = desc.replace('Rogue', '<span class="misctext">Rogue</span>');
				desc = desc.replace('Warden', '<span class="misctext">Warden</span>');
				desc = desc.replace('Duelist', '<span class="misctext">Duelist</span>');
				htmlString += '<p>' + desc + '</p>';
				htmlString += '</div></div>';
				
				$(this).attr('title', htmlString);
			}
				
			$(this).tooltipster();			
		});
	});
});