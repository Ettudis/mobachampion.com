function AddShaperTooltip(matchName)
{
	$(matchName).each(function() 
	{
		var shaperName = $(this).attr('title');
		
		if (shaperName && shaperName != "")
		{	
			var name = shaperName;
			var icon = "";
			var desc = "";
			var title = "";
			var role = "";
			
			if (shaperDataLoaded == true)
			{
				$.each(shaperData, function()
				{	
					if (shaperName.indexOf(this.name) !== -1)
					{
						name = shaperName;
						desc = this.desc;
						icon = this.icon;
						title = this.title;
						role = this.role;
					}
				});
			}

			var htmlString;
			htmlString = '<div class="standard_tooltip">';
			htmlString += '<div class="standard_tooltip_img"><img src="' + icon + '"></div>';
			htmlString += '<div class="standard_tooltip_item_header">';
			htmlString += '<p class="consumable_text">' + name + '</p><p>' + title + '</p></div>';
			
			htmlString += '<div class="standard_tooltip_item_content">';
			htmlString += '<div class="standard_tooltip_item_type">' + role + '</div>';
			htmlString += '</div></div>';
			
			$(this).attr('title', htmlString);
		}
			
		$(this).tooltipster();	
	});
}

function AddAbilityTooltip(matchName)
{
	$(matchName).each(function() 
	{
		var abilityName = $(this).attr('title');
			
		if (abilityName && abilityName != "")
		{	
			var name = abilityName;
			var icon = "";
			var desc = "";
			var shaper = "";
			var shaperName = $(this).data('shaper');

			if (shaperDataLoaded == true)
			{
				$.each(shaperData, function()
				{
					if (this.name == shaperName && abilityName == "p")
					{
						shaper = this.name;
						name = this.skill_p;					
						desc = this.desc_p;
						icon = "http://www.moba-champion.com/images/shapers/" + this.name.charAt(0).toLowerCase() + this.name.substring(1, this.name.Length).toLowerCase() + "/p.png";
						return false;
					}
					else if (this.name == shaperName && abilityName == "q")
					{
						name = this.skill_q;						
						desc = this.desc_q;
						icon = "http://www.moba-champion.com/images/shapers/" + this.name.charAt(0).toLowerCase() + this.name.substring(1, this.name.Length).toLowerCase() + "/q.png";
						shaper = this.name;
						return false;
					}
					else if (this.name == shaperName && abilityName == "w")
					{
						name = this.skill_w;						
						desc = this.desc_w;
						icon = "http://www.moba-champion.com/images/shapers/" + this.name.charAt(0).toLowerCase() + this.name.substring(1, this.name.Length ).toLowerCase() + "/w.png";
						shaper = this.name;
						return false;
					}
					else if (this.name == shaperName && abilityName == "e")
					{
						name = this.skill_e;						
						desc = this.desc_e;
						icon = "http://www.moba-champion.com/images/shapers/" + this.name.charAt(0).toLowerCase() + this.name.substring(1, this.name.Length).toLowerCase() + "/e.png";
						shaper = this.name;
						return false;
					}
					else if (this.name == shaperName && abilityName == "r")
					{
						name = this.skill_r;						
						desc = this.desc_r;
						icon = "http://www.moba-champion.com/images/shapers/" + this.name.charAt(0).toLowerCase() + this.name.substring(1, this.name.Length).toLowerCase() + "/r.png";
						shaper = this.name;
						return false;
					}
				});
			}
			
			var htmlString;
			htmlString = '<div class="standard_tooltip">';
			htmlString += '<div class="standard_tooltip_img"><img src="' + icon + '"></div>';
			htmlString += '<div class="standard_tooltip_item_header">';
			htmlString += '<p class="consumable_text">' + name + '</p></div>';
			
			htmlString += '<div class="standard_tooltip_item_content">';
			htmlString += '<p>' + desc + '</p>';
			htmlString += '<div class="standard_tooltip_item_type">' + shaper + '</div>';
			htmlString += '</div></div>';
			
			$(this).tooltipster('destroy');
			$(this).attr('title', htmlString);
			$(this).tooltipster();
		}
	});
}

$(document).ready(function() 
{	
	var jsonURL = 'http://moba-champion.com/data/shaperdata.json';
	var pathname = window.location.href;	
	if (pathname.indexOf("www.") !== -1)
	{
		jsonURL = 'http://www.moba-champion.com/data/shaperdata.json';
	}

	$.getJSON(jsonURL, function(data) 
	{	
		shaperData = data;
		shaperDataLoaded = true;
		
		$('.shapertip').each(function()
		{
			var shaperName = $(this).attr('title');
			
			if (shaperName && shaperName != "")
			{	
				var name = shaperName;
				var icon = "";
				var desc = "";
				var title = "";
				var role = "";
				
				if (shaperDataLoaded == true)
				{
					$.each(shaperData, function()
					{	
						if (shaperName.indexOf(this.name) !== -1)
						{
							name = shaperName;
							desc = this.desc;
							icon = this.icon;
							title = this.title;
							role = this.role;
						}
					});
				}

				var htmlString;
				htmlString = '<div class="standard_tooltip">';
				htmlString += '<div class="standard_tooltip_img"><img src="' + icon + '"></div>';
				htmlString += '<div class="standard_tooltip_item_header">';
				htmlString += '<p class="consumable_text">' + name + '</p><p>' + title + '</p></div>';
				
				htmlString += '<div class="standard_tooltip_item_content">';
				htmlString += '<div class="standard_tooltip_item_type">' + role + '</div>';
				htmlString += '</div></div>';
				
				$(this).attr('title', htmlString);
			}
				
			$(this).tooltipster();
		});
		
		$('.abilitytip').each(function()
		{
			var abilityName = $(this).attr('title');
			
			if (abilityName && abilityName != "")
			{	
				var name = abilityName;
				var icon = "";
				var desc = "";
				var shaper = "";
				var shaperName = $(this).data('shaper');

				if (shaperDataLoaded == true)
				{
					$.each(shaperData, function()
					{
						if (this.name == shaperName && abilityName == "p")
						{
							shaper = this.name;
							name = this.skill_p;
							desc = this.desc_p;
							icon = "http://www.moba-champion.com/images/shapers/" + this.name.charAt(0).toLowerCase() + this.name.substring(1, this.name.Length).toLowerCase() + "/p.png";
							return false;
						}
						else if (this.name == shaperName && abilityName == "q")
						{
							name = this.skill_q;						
							desc = this.desc_q;
							icon = "http://www.moba-champion.com/images/shapers/" + this.name.charAt(0).toLowerCase() + this.name.substring(1, this.name.Length).toLowerCase() + "/q.png";
							shaper = this.name;
							return false;
						}
						else if (this.name == shaperName && abilityName == "w")
						{
							name = this.skill_w;						
							desc = this.desc_w;
							icon = "http://www.moba-champion.com/images/shapers/" + this.name.charAt(0).toLowerCase() + this.name.substring(1, this.name.Length ).toLowerCase() + "/w.png";
							shaper = this.name;
							return false;
						}
						else if (this.name == shaperName && abilityName == "e")
						{
							name = this.skill_e;						
							desc = this.desc_e;
							icon = "http://www.moba-champion.com/images/shapers/" + this.name.charAt(0).toLowerCase() + this.name.substring(1, this.name.Length).toLowerCase() + "/e.png";
							shaper = this.name;
							return false;
						}
						else if (this.name == shaperName && abilityName == "r")
						{
							name = this.skill_r;						
							desc = this.desc_r;
							icon = "http://www.moba-champion.com/images/shapers/" + this.name.charAt(0).toLowerCase() + this.name.substring(1, this.name.Length).toLowerCase() + "/r.png";
							shaper = this.name;
							return false;
						}
					});
				}
				
				var htmlString;
				htmlString = '<div class="standard_tooltip">';
				htmlString += '<div class="standard_tooltip_img"><img src="' + icon + '"></div>';
				htmlString += '<div class="standard_tooltip_item_header">';
				htmlString += '<p class="consumable_text">' + name + '</p></div>';
				
				htmlString += '<div class="standard_tooltip_item_content">';
				htmlString += '<p>' + desc + '</p>';
				htmlString += '<div class="standard_tooltip_item_type">' + shaper + '</div>';
				htmlString += '</div></div>';
				
				$(this).attr('title', htmlString);
			}
				
			$(this).tooltipster();
		});		
		
		for (var i = 0; i < shaperData.length; i++)
		{
			AddSearchItem(shaperData[i].name, 'shaper');
		}
	});
});