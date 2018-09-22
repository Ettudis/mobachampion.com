function AddRoleTooltips(matchName)
{
	$(matchName).each(function() 
	{
		var role = $(this).attr('title');
		if (role && role != "")
		{	
			var name = role;
			var icon = "";
			var desc = "";
			
			if (roleDataLoaded == true)
			{
				$.each(roleData, function()
				{		
					if (role.indexOf(this.name) !== -1)
					{
						name = role;
						desc = this.desc;
						icon = this.icon;
					}
				});
			}

			var htmlString;
			htmlString = '<div class="standard_tooltip">';
			htmlString += '<div class="standard_tooltip_img"><img src="' + icon + '"></div>';
			htmlString += '<div class="standard_tooltip_item_header">';
			htmlString += '<p class="consumable_text">' + role + '</p></div>';
			
			htmlString += '<div class="standard_tooltip_item_content">';
			htmlString += '<p>' + desc + '</p>';
			htmlString += '<div class="standard_tooltip_item_type">Role</div>';
			htmlString += '</div></div>';
			$(this).attr('title', htmlString);
		}
			
		$(this).tooltipster();	
	});
}

$(document).ready(function() 
{	
	var jsonURL = 'http://moba-champion.com/data/roledata.json';
	var pathname = window.location.href;
	if (pathname.indexOf("www.") !== -1)
	{
		jsonURL = 'http://www.moba-champion.com/data/roledata.json';
	}
	
	$.getJSON(jsonURL, function(data) 
	{	
		roleData = data;
		roleDataLoaded = true;
		
		$(".roletip").each(function()
		{
			var role = $(this).attr('title');
			if (role && role != "")
			{	
				var name = role;
				var icon = "";
				var desc = "";
				
				if (roleDataLoaded == true)
				{
					$.each(roleData, function()
					{		
						if (role.indexOf(this.name) !== -1)
						{
							name = role;
							desc = this.desc;
							icon = this.icon;
						}
					});
				}

				var htmlString;
				htmlString = '<div class="standard_tooltip">';
				htmlString += '<div class="standard_tooltip_img"><img src="' + icon + '"></div>';
				htmlString += '<div class="standard_tooltip_item_header">';
				htmlString += '<p class="consumable_text">' + role + '</p></div>';
				
				htmlString += '<div class="standard_tooltip_item_content">';
				htmlString += '<p>' + desc + '</p>';
				htmlString += '<div class="standard_tooltip_item_type">Role</div>';
				htmlString += '</div></div>';
                $(this).attr('title', htmlString);
			}
				
			$(this).tooltipster();			
		});
		
		for (var i = 0; i < roleData.length; i++)
		{
			AddSearchItem(roleData[i].name, 'role');
		}
		
	});
});