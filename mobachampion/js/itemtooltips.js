var currentItemSelect = "";
var numStarting = 0;
var numCore  = 0;
var numOffensive = 0;
var numDefensive = 0;
var numSituational = 0;

var guidesLoaded = false;

function AddItemTooltips(matchName)
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
			
			if (itemDataLoaded == true)
			{
				$.each(itemData, function()
				{					
					if (item.indexOf(this.name) !== -1)
					{
						name = item;
						price = this.cost;
						summary = this.summary;
						passive1 = this.passive1;
						passive2 = this.passive2;
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
			htmlString += '<p>' + summary + '</p>';
			if (passive1 && passive1 != "")
			{
				htmlString += '<p class="standard_tooltip_item_content_indent">Passive: ' + passive1 + '</p>';
			}
			if (passive2 && passive2 != "")
			{
				htmlString += '<p class="standard_tooltip_item_content_indent">Passive: ' + passive2 + '</p>';
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
	var jsonURL = 'http://moba-champion.com/data/itemdata.json';
	var pathname = window.location.href;
	if (pathname.indexOf("www.") !== -1)
	{
		jsonURL = 'http://www.moba-champion.com/data/itemdata.json';
	}
	
	$.getJSON(jsonURL, function(data) 
	{		
		itemData = data; 
		itemDataLoaded = true;
		
		PopulateItemList();
		
		$(".mobatip").each(function() 
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
				
				if (itemDataLoaded == true)
				{
					$.each(itemData, function()
					{					
						if (item.indexOf(this.name) !== -1)
						{
							name = item;
							price = this.cost;
							summary = this.summary;
							passive1 = this.passive1;
							passive2 = this.passive2;
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
				htmlString += '<p>' + summary + '</p>';
				if (passive1 && passive1 != "")
				{
					htmlString += '<p class="standard_tooltip_item_content_indent">Passive: ' + passive1 + '</p>';
				}
				if (passive2 && passive2 != "")
				{
					htmlString += '<p class="standard_tooltip_item_content_indent">Passive: ' + passive2 + '</p>';
				}
				htmlString += '</div>';
				htmlString += '<div class="standard_tooltip_item_type">Item</div>';				
				htmlString += '</div>';
				$(this).attr('title', htmlString);
			}
				
			$(this).tooltipster();			
		});
				
		$(".guide_item_entry").click(function()
		{
			currentItemSelect = $(this).data('itemttype');
			ToggleItemSelector();
		});

		$(".guide_item_close").click(function()
		{
			ToggleItemSelector();
		});
		
		$(".guide_item_picker_item").click(function()
		{
			var itemName = $(this).data('itemname');
			var itemSrc = $(this).data('itemsrc');
			AddItem(itemName, itemSrc);
			ToggleItemSelector();
		});
		
		if (guidesLoaded == true)
		{
			AttemptLoadGuide();
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
	if (itemData == null)
		return;
		
	var outData;
	$.each(itemData, function()
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
	htmlString += '<p>' + summary + '</p>';
	if (passive1 && passive1 != "")
	{
		htmlString += '<p class="standard_tooltip_item_content_indent">Passive: ' + passive1 + '</p>';
	}
	if (passive2 && passive2 != "")
	{
		htmlString += '<p class="standard_tooltip_item_content_indent">Passive: ' + passive2 + '</p>';
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
			
			$(d).addClass("guide_item_item mobatip")
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
 
function IncrementItem(type)
{
	if (type == "starting")
	{
		numStarting++;
		if (numStarting >= 5)
		{
			$(".starting_button").hide();
		}
	}
	else if (type == "core")
	{
		numCore++;
		if (numCore >= 5)
		{
			$(".core_button").hide();
		}		
	}
	else if (type == "offense")
	{
		numOffensive++;
		if (numOffensive >= 5)
		{
			$(".offense_button").hide();
		}		
	}
	else if (type == "defense")
	{
		numDefensive++;
		if (numDefensive >= 5)
		{
			$(".defense_button").hide();
		}		
	}
	else if (type == "situational")
	{
		numSituational++;
		if (numSituational >= 5)
		{
			$(".situational_button").hide();
		}		
	}	
}

function DecrementItem(type)
{
	if (type == "starting")
	{
		numStarting--;
		if (numStarting < 0)
		{
			numStarting = 0;
		}
		$(".starting_button").show();
	}
	else if (type == "core")
	{
		numCore--
		if (numCore < 0)
		{
			numCore = 0;
		}
		$(".core_button").show();		
	}
	else if (type == "offense")
	{
		numOffensive--;
		if (numOffensive < 0)
		{
			numOffensive = 0;
		}
		$(".offense_button").show();
	}
	else if (type == "defense")
	{
		numDefensive--;
		if (numDefensive < 0)
		{
			numDefensive = 0;
		}
		$(".defense_button").show();
	}
	else if (type == "situational")
	{
		numSituational--;
		if (numSituational < 0)
		{
			numSituational = 0;
		}
		$(".situational_button").show();
	} 
}
 
function PopulateItemList()
{
	var itemListDiv;
	itemListDiv = $(".guide_item_picker");
	if (itemListDiv)
	{
		$.each(itemData, function()
		{
			itemListDiv.append('<div class="guide_item_picker_item mobatip" data-itemsrc="' + this.img + '" data-itemname="' + this.name + '" title="' + this.name + '"><img src="' + this.img + '"></div>');
		});	
	}
}

$(function() 
{

})