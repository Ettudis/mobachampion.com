function AddSpellTooltip(matchName)
{
	$(matchName).each(function() 
	{
		var spell = $(this).attr('title');
		if (spell && spell != "")
		{	
			var name = spell;
			var icon = "";
			var desc = "";
			var cooldown = "";
			
			if (spellDataLoaded == true)
			{
				$.each(spellData, function()
				{		
					if (spell.indexOf(this.name) !== -1)
					{
						name = spell;
						desc = this.desc;
						icon = this.icon;
						cooldown = this.cooldown;
					}
				});
			}

			var htmlString;
			htmlString = '<div class="standard_tooltip">';
			htmlString += '<div class="standard_tooltip_img"><img src="' + icon + '"></div>';
			htmlString += '<div class="standard_tooltip_item_header">';
			htmlString += '<p class="consumable_text">' + spell + '</p><p>Cooldown: ' + cooldown + '</p></div>';
			
			htmlString += '<div class="standard_tooltip_item_content">';
			htmlString += '<p>' + desc + '</p>';
			htmlString += '<div class="standard_tooltip_item_type">Spell</div>';
			htmlString += '</div></div>';
			
			$(this).attr('title', htmlString);
		}
			
		$(this).tooltipster();			
	});
}


$(document).ready(function() 
{	
	var jsonURL = 'http://moba-champion.com/data/spelldata.json';
	var pathname = window.location.href;
	if (pathname.indexOf("www.") !== -1)
	{
		jsonURL = 'http://www.moba-champion.com/data/spelldata.json';
	}
	
	$.getJSON(jsonURL, function(data) 
	{	
		spellData = data;
		spellDataLoaded = true;
		
		$(".spelltip").each(function()
		{
			var spell = $(this).attr('title');
			if (spell && spell != "")
			{	
				var name = spell;
				var icon = "";
				var desc = "";
				var cooldown = "";
				
				if (spellDataLoaded == true)
				{
					$.each(spellData, function()
					{		
						if (spell.indexOf(this.name) !== -1)
						{
							name = spell;
							desc = this.desc;
							icon = this.icon;
							cooldown = this.cooldown;
						}
					});
				}

				var htmlString;
				htmlString = '<div class="standard_tooltip">';
				htmlString += '<div class="standard_tooltip_img"><img src="' + icon + '"></div>';
				htmlString += '<div class="standard_tooltip_item_header">';
				htmlString += '<p class="consumable_text">' + spell + '</p><p>Cooldown: ' + cooldown + '</p></div>';
				
				htmlString += '<div class="standard_tooltip_item_content">';
				htmlString += '<p>' + desc + '</p>';
				htmlString += '<div class="standard_tooltip_item_type">Spell</div>';
				htmlString += '</div></div>';
				
				$(this).attr('title', htmlString);
			}
				
			$(this).tooltipster();			
		});
		
		for (var i = 0; i < spellData.length; i++)
		{
			AddSearchItem(spellData[i].name, 'spell');
		}
		
	});
});