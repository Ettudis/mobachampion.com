function FormatPassive(passive)
{
	strExp = passive.split(":", 2);
	if (strExp.length == 2)
	{
		var passiveStr = strExp[0];
		
		if (passiveStr.indexOf('Stackable') != -1)
		{
			passiveStr = passiveStr.replace("Stackable Passive -", "");
			passiveStr = '<span class="misctext">' + passiveStr + '</span>:';
			passiveStr = '<span class="passivetext">Stackable Passive</span> - ' + passiveStr;
		}
		else if (passiveStr.indexOf('Unique') != -1)
		{
			passiveStr = passiveStr.replace("Unique Passive -", "");
			passiveStr = '<span class="misctext">' + passiveStr + '</span>:';
			passiveStr = '<span class="passivetext">Unique Passive</span> - ' + passiveStr;
		}
		
		return passiveStr + strExp[1];
	}
	else
	{
		return passive;
	}
}

function CreateSummary(summary)
{
	var summaries = summary.split(", ");
	var outSummary = "";
	
	for (var i = 0; i < summaries.length; i++)
	{ 
		var s = summaries[i];
		s = s.replace("+", "");
		
		var textExp = s.split(" ");
		var sumStr = "";
		
		switch(textExp[1])
		{
			case "Haste":
				sumStr = '<span class="hastetext">+' + textExp[0] + '</span> ' + textExp[1];
				break;
			case "Power":
				sumStr = '<span class="powertext">+' + textExp[0] + '</span> ' + textExp[1];
				break;
			case "Health":
				if (textExp.length == 3)
				{
					sumStr = '<span class="regentext">+' + textExp[0] + '</span> ' + textExp[1];
				}
				else
				{
					sumStr = '<span class="healthtext">+' + textExp[0] + '</span> ' + textExp[1];
				}
				break;
			case "Armor":
				sumStr = '<span class="armortext">+' + textExp[0] + '</span> ' + textExp[1];
				break;
			case "Magic":
				sumStr = '<span class="mrtext">+' + textExp[0] + '</span> ' + textExp[1];
				break;
			case "Lifedrain":
				sumStr = '<span class="lifedraintext">+' + textExp[0] + '</span> ' + textExp[1];
				break;
			default:
				sumStr = '<span class="misctext">+' + textExp[0] + '</span> ' + textExp[1];
				break;
		}
		
		if (textExp.length > 2)
		{
			for (var j = 2; j < textExp.length; j++)
			{
				sumStr += (" " + textExp[j]);
			}
		}
		
		if ((i+1) != summaries.length)
		{
			sumStr += "<BR>";
		}
		
		outSummary += sumStr;
	}
	
	return outSummary;
}

function AddItemPTooltips(matchName)
{
	$(matchName).each(function() 
	{
		var item = $(this).attr('title');
		if (item && item != "")
		{	
			var name = item;
			var price = "";
			var summary = "";
			var passive1 = "";
			var passive2 = "";
			var img = "";
			
			if (itempaloozaDataLoaded == true)
			{
				$.each(itempaloozaData, function()
				{					
					if (item.indexOf(this.name) !== -1)
					{
						name = item;
						price = this.cost;
						summary = this.summary;
						passive1 = FormatPassive(this.passive1);
						passive2 = FormatPassive(this.passive2);
						img = this.img;
					}
				});
			}

			var htmlString;
			htmlString = '<div class="standard_tooltip">';
			htmlString += '<div class="standard_tooltip_img"><img src="' + img + '"></div>';
			htmlString += '<div class="standard_tooltip_item_header">';

			if (img.indexOf('Legendary') !== -1)
			{
				htmlString += '<p class="legendary_text">' + item + '</p>';
			}
			else if (img.indexOf('Advanced') !== -1)
			{
				htmlString += '<p class="advanced_text">' + item + '</p>';
			}				
			else if (img.indexOf('Basic') !== -1)
			{
				htmlString += '<p class="basic_text">' + item + '</p>';
			}
			else
			{
				htmlString += '<p class="consumable_text">' + item + '</p>';
			}
			
			htmlString += '<p>Cost: <font color="gold">' + price + '</font></p></div>';
			
			htmlString += '<div class="standard_tooltip_item_content">';
			summary = CreateSummary(summary);
			htmlString += '<p>' + summary + '</p>';
			
			if (passive1 && passive1 != "")
			{
				htmlString += '<p>' + passive1 + '</p>';
			}
			if (passive2 && passive2 != "")
			{
				htmlString += '<p>' + passive2 + '</p>';
			}
			htmlString += '</div>';
			htmlString += '<div class="standard_tooltip_item_type">Item</div>';				
			htmlString += '</div>';
			$(this).attr('title', htmlString);
		}
			
		$(this).tooltipster();			
	});
}

$(document).ready(function() 
{	
	var jsonURL = 'http://moba-champion.com/data/itempalooza.json';
	var pathname = window.location.href;
	if (pathname.indexOf("www.") !== -1)
	{
		jsonURL = 'http://www.moba-champion.com/data/itempalooza.json';
	}
	
	$.getJSON(jsonURL, function(data) 
	{		
		itempaloozaData = data; 
		itempaloozaDataLoaded = true;
		
		$(".iptip").each(function() 
		{
			var item = $(this).attr('title');
			if (item && item != "")
			{	
				var name = item;
				var price = "";
				var summary = "";
				var passive1 = "";
				var passive2 = "";
				var img = "";
				
				if (itempaloozaDataLoaded == true)
				{
					$.each(itempaloozaData, function()
					{					
						if (item.indexOf(this.name) !== -1)
						{
							name = item;
							price = this.cost;
							summary = this.summary;
							passive1 = FormatPassive(this.passive1);
							passive2 = FormatPassive(this.passive2);
							img = this.img;
						}
					});
				}

				var htmlString;
				htmlString = '<div class="standard_tooltip">';
				htmlString += '<div class="standard_tooltip_img"><img src="' + img + '"></div>';
				htmlString += '<div class="standard_tooltip_item_header">';

				if (img.indexOf('Legendary') !== -1)
				{
					htmlString += '<p class="legendary_text">' + item + '</p>';
				}
				else if (img.indexOf('Advanced') !== -1)
				{
					htmlString += '<p class="advanced_text">' + item + '</p>';
				}				
				else if (img.indexOf('Basic') !== -1)
				{
					htmlString += '<p class="basic_text">' + item + '</p>';
				}
				else
				{
					htmlString += '<p class="consumable_text">' + item + '</p>';
				}
				
				htmlString += '<p>Cost: <font color="gold">' + price + '</font></p></div>';
				
				htmlString += '<div class="standard_tooltip_item_content">';
				
				summary = CreateSummary(summary);
				htmlString += '<p>' + summary + '</p>';
				
				if (passive1 && passive1 != "")
				{
					htmlString += '<p>' + passive1 + '</p>';
				}
				if (passive2 && passive2 != "")
				{
					htmlString += '<p>' + passive2 + '</p>';
				}
				htmlString += '</div>';
				htmlString += '<div class="standard_tooltip_item_type">Item</div>';				
				htmlString += '</div>';
				$(this).attr('title', htmlString);
			}
				
			$(this).tooltipster();			
		});
		
		for (var i = 0; i < itempaloozaData.length; i++)
		{
			AddSearchItem(itempaloozaData[i].name, 'item');
		}
	});
});

function getURIParameter(name) 
{
   return decodeURI(
       (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
   );
}

function getItemData(item)
{
	if (itempaloozaData == null)
		return;
		
	var outData;
	$.each(itempaloozaData, function()
	{				
		if (item.indexOf(this.name) !== -1)
		{
			outData = this;
			return false;
		}
	});	
	
	return outData;
}

function constructTooltip(item, img, price, summary, passive1, passive2)
{
	var htmlString;
	htmlString = '<div class="standard_tooltip">';
	htmlString += '<div class="standard_tooltip_img"><img src="' + img + '"></div>';
	htmlString += '<div class="standard_tooltip_item_header">';

	if (img.indexOf('Legendary') !== -1)
	{
		htmlString += '<p class="legendary_text">' + item + '</p>';
	}
	else if (img.indexOf('Advanced') !== -1)
	{
		htmlString += '<p class="advanced_text">' + item + '</p>';
	}				
	else if (img.indexOf('Basic') !== -1)
	{
		htmlString += '<p class="basic_text">' + item + '</p>';
	}
	else
	{
		htmlString += '<p class="consumable_text">' + item + '</p>';
	}
	
	htmlString += '<p>Cost: <font color="gold">' + price + '</font></p></div>';
	
	htmlString += '<div class="standard_tooltip_item_content">';
	
	summary = CreateSummary(summary);
	htmlString += '<p>' + summary + '</p>';
	
	if (passive1 && passive1 != "")
	{
		htmlString += '<p>' + passive1 + '</p>';
	}
	if (passive2 && passive2 != "")
	{
		htmlString += '<p>' + passive2 + '</p>';
	}				
	htmlString += '</div></div>';
	return htmlString;
}

function AddItem(itemName, itemSrc)
{
	if (!itemName || !itemSrc || itemName == "" || itemSrc == "" || itemName.length <= 1)
	{
		return;
	}
	
	var text = '<img src="' + itemSrc + '">';

	$(".guide_item_category_list").each(function()
	{	
		
		var type = $(this).data('itemttype');
		if (type == currentItemSelect)
		{
			
			d=document.createElement('div');
			
			var outData = getItemData(itemName);
			var htmlString = "";
			
			if (outData)
			{
				htmlString = constructTooltip(outData.name, outData.img, outData.cost, outData.summary, outData.passive1, outData.passive2);
			}
			
			$(d).addClass("guide_item_item iptip")
				.html(text)
				.appendTo($(this)) //main div
				.data('itemtype', currentItemSelect)
				.data('itemname', itemName)
				.attr('title', htmlString)
				.tooltipster()
				.click(function()
				{
					var itemtype = $(this).data('itemtype');
					DecrementItem(itemtype);
					$(this).remove();
				});
		}
	});
	
	IncrementItem(currentItemSelect);
}
 