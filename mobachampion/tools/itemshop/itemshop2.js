var selectedBasicItemClass = "none";
var selectedBasicItemIndex  = 0;
var selectedAdvancedItemClass = "none";
var selectedAdvancedItemIndex  = 0;
var selectedLegendaryItemClass = "none";
var selectedLegendaryItemIndex  = 0;

function ToggleSelectedBasic()
{
	$("#" + selectedBasicItemClass + selectedBasicItemIndex).toggleClass('item_selected');
}

function ClearAdvanced()
{
	$("#" + selectedAdvancedItemClass + selectedAdvancedItemIndex).removeClass('item_selected');
	selectedAdvancedItemClass = "none";
	selectedAdvancedItemIndex = 0;
}

function ToggleSelectedAdvanced()
{
	$("#" + selectedAdvancedItemClass + selectedAdvancedItemIndex).toggleClass('item_selected');
}

function ClearLegendary()
{
	$("#" + selectedLegendaryItemClass + selectedLegendaryItemIndex).removeClass('item_selected');
	selectedLegendaryItemClass = "none";
	selectedLegendaryItemIndex = 0;	
}

function ToggleSelectedLegendary()
{
	$("#" + selectedLegendaryItemClass + selectedLegendaryItemIndex).toggleClass('item_selected');
}

function OnBasicItemClick(index)
{
	if (selectedBasicItemClass != "basic" || selectedBasicItemIndex != index)
	{
		ToggleSelectedBasic();
		
		ClearAdvanced();
		ClearLegendary();
		
		for (var i=0; i < 6; i++)
		{
			var divName = "#legendary" + (i+1);
			$(divName).addClass('item_hidden');
			$(divName).removeClass('item_selected');
			$(divName).html('');
		}			
				
		selectedBasicItemClass = "basic";
		selectedBasicItemIndex = index;
		
		ToggleSelectedBasic();
		PopulateAdvancedItems(index);
		
		DrawBasicLines();
	}
}

function DrawBasicLines()
{
	ClearBasicLines();
	ClearAdvancedLines();
		
	$("#row_gap" + selectedBasicItemIndex).children('.store_line_row_mid').children('.store_line_row_left').addClass('basic_line_1');
	$("#row_gap" + selectedBasicItemIndex).children('.store_line_row_mid').children('.store_line_row_center').addClass('basic_line_1');

	var advanced = new Array();
	advanced[0] = !$("#advanced" + 1).hasClass('item_hidden');
	advanced[1] = !$("#advanced" + 2).hasClass('item_hidden');
	advanced[2] = !$("#advanced" + 3).hasClass('item_hidden');
	advanced[3] = !$("#advanced" + 4).hasClass('item_hidden');
	advanced[4] = !$("#advanced" + 5).hasClass('item_hidden');
	advanced[5] = !$("#advanced" + 6).hasClass('item_hidden');
	
	// draw all the little green lines
	if (selectedAdvancedItemClass == "none")
	{
		for (var i = 1; i <= 6; i++)
		{
			if (advanced[i-1] == true)
			{
				$("#row_gap" + (i)).children('.store_line_row_mid').children('.store_line_row_center').addClass('basic_line_1');
				$("#row_gap" + (i)).children('.store_line_row_mid').children('.store_line_row_right').addClass('basic_line_1');
				
				if (i > selectedBasicItemIndex)
				{					
					$("#row_gap" + (i)).children('.store_line_row_top').children('.store_line_row_center').addClass('basic_line_1');
					$("#row_gap" + (i-1)).children('.store_line_row_bottom').children('.store_line_row_center').addClass('basic_line_1');
				}
				else if (i < selectedBasicItemIndex)
				{
					for (var j = i; j < selectedBasicItemIndex; j++)
					{
						$("#row_gap" + j).children('.store_line_row_bottom').children('.store_line_row_center').addClass('basic_line_1');
						$("#row_gap" + j).children('.store_line_row_mid').children('.store_line_row_center').addClass('basic_line_1');
						$("#row_gap" + (j+1)).children('.store_line_row_top').children('.store_line_row_center').addClass('basic_line_1');
					}
				}
			}
		}
	}
}

function GetItemInfo(itemName)
{
	var item;
	$.each(itemData, function()
	{					
		if (itemName.indexOf(this.name) !== -1)
		{
			item = this;
			return false;
		}
	});
	
	return item;
}

function GetLinks(itemName)
{
	var list = null;
	
	$.each(itemData, function()
	{					
		if (itemName.indexOf(this.name) !== -1)
		{
			console.log(this.buildsinto);
			
			list = new Array();
			var buildsInto = this.buildsinto.split(",");
			for(var i = 0; i < buildsInto.length; i++)
			{
				list[i] = GetItemInfo(buildsInto[i]);
			}
		}
	});
	
	return list;
}

function PopulateAdvancedItems(index)
{
	if (itemDataLoaded)
	{
		var numElements = 0;
		var list = null;
		
		switch(index)
		{
			case 1:
				list = GetLinks("Life");
				numElements = list.length;
				break;
			case 2:
				list = GetLinks("Resilience");
				numElements = list.length;		
				break;
			case 3:
				list = GetLinks("Will");
				numElements = list.length;	
				break;
			case 4:
				list = GetLinks("Power");
				numElements = list.length;			
				break;
			case 5:
				list = GetLinks("Time");
				numElements = list.length;		
				break;
			case 6:
				list = GetLinks("Hunger");
				numElements = list.length;			
				break;
			default:
				break;
		}
		
		for (var i=0; i < 6; i++)
		{
			var divName = "#advanced" + (i+1);
			if (list == null || i >= numElements)
			{
				$(divName).addClass('item_hidden');
				$(divName).removeClass('item_selected');
				$(divName).html('');
			}
			else
			{				
				$(divName).removeClass('item_hidden');
				var htmlString = "";
				htmlString += '<img src="http://www.moba-champion.com/images/items/Advanced_' + list[i].name + '.png\" class="mobatip_adv" title="' + list[i].name + '">';
				htmlString += "<span class=\"advanced_text\">" + list[i].name + "</span>";
				htmlString += "<span>" + list[i].cost + "</span>";			
				$(divName).data("summary", list[i].summary);
				$(divName).data("passive1", list[i].passive1);
				$(divName).data("passive2", list[i].passive2);					
				$(divName).html(htmlString);
			}
		}
		
		AddItemTooltips(".mobatip_adv");		
	}
}

function OnAdvancedItemClick(index)
{
	if (selectedBasicItemClass == "none")
		return;
		
	if (selectedAdvancedItemClass != "advanced" || selectedAdvancedItemIndex != index)
	{
		ToggleSelectedAdvanced();
		ClearLegendary();
		
		selectedAdvancedItemClass = "advanced";
		selectedAdvancedItemIndex = index;
		
		ToggleSelectedAdvanced();
		PopulateLegendaryItems(index-1);
		
		DrawBasicFilledLines();
		DrawAdvancedLines();
	}
}

function ClearBasicLines()
{
	$(".store_line_row_left").removeClass("basic_line_1");
	$(".store_line_row_center").removeClass("basic_line_1");
	$(".store_line_row_right").removeClass("basic_line_1");
	$(".store_line_row_left").removeClass("basic_line_2");
	$(".store_line_row_center").removeClass("basic_line_2");
	$(".store_line_row_right").removeClass("basic_line_2");
}

function ClearAdvancedLines()
{
	$(".store_line_row_left").removeClass("basic_line_3");
	$(".store_line_row_center").removeClass("basic_line_3");
	$(".store_line_row_right").removeClass("basic_line_3");
	$(".store_line_row_left").removeClass("basic_line_4");
	$(".store_line_row_center").removeClass("basic_line_4");
	$(".store_line_row_right").removeClass("basic_line_4");		
}

function OnLegendaryItemClick(index)
{
	if (selectedBasicItemClass == "none" || selectedAdvancedItemClass == "none")
		return;
		
	if (selectedLegendaryItemClass != "legendary" || selectedLegendaryItemIndex != index)
	{
		ToggleSelectedLegendary();
		
		selectedLegendaryItemClass = "legendary";
		selectedLegendaryItemIndex = index;
		
		ToggleSelectedLegendary();
		DrawAdvancedFilledLines();
	}
}

function DrawBasicFilledLines()
{
	// clear 
	ClearBasicLines();
	ClearAdvancedLines();
	
	$("#row_gap" + selectedBasicItemIndex).children('.store_line_row_mid').children('.store_line_row_left').addClass('basic_line_2');
	$("#row_gap" + selectedBasicItemIndex).children('.store_line_row_mid').children('.store_line_row_center').addClass('basic_line_2');	
	$("#row_gap" + selectedAdvancedItemIndex).children('.store_line_row_mid').children('.store_line_row_right').addClass('basic_line_2');
	$("#row_gap" + selectedAdvancedItemIndex).children('.store_line_row_mid').children('.store_line_row_center').addClass('basic_line_2');	
	
	if (selectedBasicItemIndex < selectedAdvancedItemIndex)
	{
		$("#row_gap" + selectedBasicItemIndex).children('.store_line_row_bottom').children('.store_line_row_center').addClass('basic_line_2');
		for (var i = selectedBasicItemIndex + 1; i < selectedAdvancedItemIndex; i++)
		{
			$("#row_gap" + i).children('.store_line_row_top').children('.store_line_row_center').addClass('basic_line_2');
			$("#row_gap" + i).children('.store_line_row_mid').children('.store_line_row_center').addClass('basic_line_2');
			$("#row_gap" + i).children('.store_line_row_bottom').children('.store_line_row_center').addClass('basic_line_2');			
		}
		$("#row_gap" + selectedAdvancedItemIndex).children('.store_line_row_top').children('.store_line_row_center').addClass('basic_line_2');
	}
	else if (selectedBasicItemIndex > selectedAdvancedItemIndex)
	{
		$("#row_gap" + selectedBasicItemIndex).children('.store_line_row_top').children('.store_line_row_center').addClass('basic_line_2');
		for (var i = selectedAdvancedItemIndex + 1; i < selectedBasicItemIndex; i++)
		{
			$("#row_gap" + i).children('.store_line_row_top').children('.store_line_row_center').addClass('basic_line_2');
			$("#row_gap" + i).children('.store_line_row_mid').children('.store_line_row_center').addClass('basic_line_2');
			$("#row_gap" + i).children('.store_line_row_bottom').children('.store_line_row_center').addClass('basic_line_2');				
		}
		$("#row_gap" + selectedAdvancedItemIndex).children('.store_line_row_bottom').children('.store_line_row_center').addClass('basic_line_2');	
	}
	else
	{
		$("#row_gap" + selectedBasicItemIndex).children('.store_line_row_mid').children('.store_line_row_center').addClass('basic_line_2');
	}
}

function DrawAdvancedFilledLines()
{
	// clear 
	ClearAdvancedLines();
	
	$("#row_l_gap" + selectedAdvancedItemIndex).children('.store_line_row_mid').children('.store_line_row_left').addClass('basic_line_4');
	$("#row_l_gap" + selectedAdvancedItemIndex).children('.store_line_row_mid').children('.store_line_row_center').addClass('basic_line_4');	
	$("#row_l_gap" + selectedLegendaryItemIndex).children('.store_line_row_mid').children('.store_line_row_right').addClass('basic_line_4');
	$("#row_l_gap" + selectedLegendaryItemIndex).children('.store_line_row_mid').children('.store_line_row_center').addClass('basic_line_4');	
	
	if (selectedAdvancedItemIndex < selectedLegendaryItemIndex)
	{
		$("#row_l_gap" + selectedAdvancedItemIndex).children('.store_line_row_bottom').children('.store_line_row_center').addClass('basic_line_4');
		for (var i = selectedAdvancedItemIndex + 1; i < selectedLegendaryItemIndex; i++)
		{
			$("#row_l_gap" + i).children('.store_line_row_top').children('.store_line_row_center').addClass('basic_line_4');
			$("#row_l_gap" + i).children('.store_line_row_mid').children('.store_line_row_center').addClass('basic_line_4');
			$("#row_l_gap" + i).children('.store_line_row_bottom').children('.store_line_row_center').addClass('basic_line_4');			
		}
		$("#row_l_gap" + selectedLegendaryItemIndex).children('.store_line_row_top').children('.store_line_row_center').addClass('basic_line_4');
	}
	else if (selectedAdvancedItemIndex > selectedLegendaryItemIndex)
	{
		$("#row_l_gap" + selectedAdvancedItemIndex).children('.store_line_row_top').children('.store_line_row_center').addClass('basic_line_4');
		for (var i = selectedLegendaryItemIndex + 1; i < selectedAdvancedItemIndex; i++)
		{
			$("#row_l_gap" + i).children('.store_line_row_top').children('.store_line_row_center').addClass('basic_line_4');
			$("#row_l_gap" + i).children('.store_line_row_mid').children('.store_line_row_center').addClass('basic_line_4');
			$("#row_l_gap" + i).children('.store_line_row_bottom').children('.store_line_row_center').addClass('basic_line_4');				
		}
		$("#row_l_gap" + selectedLegendaryItemIndex).children('.store_line_row_bottom').children('.store_line_row_center').addClass('basic_line_4');	
	}
	else
	{
		$("#row_l_gap" + selectedAdvancedItemIndex).children('.store_line_row_mid').children('.store_line_row_center').addClass('basic_line_4');
	}
}

function DrawAdvancedLines()
{
	// clear 
	$(".store_line_row_left").removeClass("basic_line_3");
	$(".store_line_row_center").removeClass("basic_line_3");
	$(".store_line_row_right").removeClass("basic_line_3");
	
	// clear adv
	$(".store_line_row_left").removeClass("basic_line_4");
	$(".store_line_row_center").removeClass("basic_line_4");
	$(".store_line_row_right").removeClass("basic_line_4");	
		
	$("#row_l_gap" + selectedAdvancedItemIndex).children('.store_line_row_mid').children('.store_line_row_left').addClass('basic_line_3');
	$("#row_l_gap" + selectedAdvancedItemIndex).children('.store_line_row_mid').children('.store_line_row_center').addClass('basic_line_3');

	var legendary = new Array();
	legendary[0] = !$("#legendary1").hasClass('item_hidden');
	legendary[1] = !$("#legendary2").hasClass('item_hidden');
	legendary[2] = !$("#legendary3").hasClass('item_hidden');
	legendary[3] = !$("#legendary4").hasClass('item_hidden');
	legendary[4] = !$("#legendary5").hasClass('item_hidden');
	legendary[5] = !$("#legendary6").hasClass('item_hidden');
	
	// draw all the little green lines
	if (selectedLegendaryItemClass == "none")
	{
		for (var i = 1; i <= 6; i++)
		{
			if (legendary[i-1] == true)
			{
				$("#row_l_gap" + i).children('.store_line_row_mid').children('.store_line_row_center').addClass('basic_line_3');
				$("#row_l_gap" + i).children('.store_line_row_mid').children('.store_line_row_right').addClass('basic_line_3');
				
				if (i > selectedAdvancedItemIndex)
				{					
					$("#row_l_gap" + i).children('.store_line_row_top').children('.store_line_row_center').addClass('basic_line_3');
					$("#row_l_gap" + (i-1)).children('.store_line_row_bottom').children('.store_line_row_center').addClass('basic_line_3');
				}
				else if (i < selectedAdvancedItemIndex)
				{
					for (var j = i; j < selectedAdvancedItemIndex; j++)
					{
						$("#row_l_gap" + j).children('.store_line_row_bottom').children('.store_line_row_center').addClass('basic_line_3');
						$("#row_l_gap" + j).children('.store_line_row_mid').children('.store_line_row_center').addClass('basic_line_3');
						$("#row_l_gap" + (j+1)).children('.store_line_row_top').children('.store_line_row_center').addClass('basic_line_3');
					}
				}
			}
		}
	}
}

function PopulateLegendaryItems(index)
{
	if (itemDataLoaded)
	{
		var numElements = 0;
		var preList = null;
		var list = null;
		
		switch(selectedBasicItemIndex)
		{
			case 1:
				preList = GetLinks("Life");
				list = GetLinks(preList[index].name);
				numElements = list.length;
				break;
			case 2:
				preList = GetLinks("Resilience");
				list = GetLinks(preList[index].name);
				numElements = list.length;	
				break;
			case 3:
				preList = GetLinks("Will");
				list = GetLinks(preList[index].name);
				numElements = list.length;		
				break;
			case 4:
				preList = GetLinks("Power");
				list = GetLinks(preList[index].name);
				numElements = list.length;		
				break;
			case 5:
				preList = GetLinks("Time");
				list = GetLinks(preList[index].name);
				numElements = list.length;		
				break;
			case 6:
				preList = GetLinks("Hunger");
				list = GetLinks(preList[index].name);
				numElements = list.length;			
				break;			
			default:
				break;
		}
		
		for (var i=0; i < 6; i++)
		{
			var divName = "#legendary" + (i+1);
			if (list == null || i >= numElements)
			{
				$(divName).addClass('item_hidden');
				$(divName).removeClass('item_selected');
				$(divName).html('');
			}
			else
			{
				$(divName).removeClass('item_hidden');
				var htmlString = "";
				htmlString += '<img class="item_img mobatip_leg" src="http://www.moba-champion.com/images/items/Legendary_' + list[i].name + '.png" title="' + list[i].name + '">';
				htmlString += "<span class=\"legendary_text\">" + list[i].name + "</span>";
				htmlString += "<span>" + list[i].cost + "</span>";
				$(divName).data("summary", list[i].summary);
				$(divName).data("passive1", list[i].passive1);
				$(divName).data("passive2", list[i].passive2);			
				$(divName).html(htmlString);
			}
		}
		
		AddItemTooltips(".mobatip_leg");		
	}
}

function UpdateSelectedItem(item, divId)
{
	console.log($("#" + divId).html());
	$(".store_current_sel").html($("#" + divId).html());
	var htmlString = "";
	var summary = $("#" + divId).data('summary');
	var passive1 = $("#" + divId).data('passive1');
	var passive2 = $("#" + divId).data('passive2');
			
	if (summary && summary != "")
	{
		htmlString += '<p>' + summary + '</p>';
	}
	if (passive1 && passive1 != "")
	{
		htmlString += '<p>' + passive1 + '</p>';
	}
	if (passive2 && passive2 != "")
	{
		htmlString += '<p>' + passive2 + '</p>';
	}
	
	$(".store_current_sel_text").html(htmlString);
}

function OnItemClick(item, index)
{
	if (item == "basic")
	{
		OnBasicItemClick(index);
		UpdateSelectedItem(item, item + index);
	}
	
	if (item == "advanced")
	{
		OnAdvancedItemClick(index);
		UpdateSelectedItem(item, item + index);
	}

	if (item == "legendary")
	{
		OnLegendaryItemClick(index);
		UpdateSelectedItem(item, item + index);
	}
}

$(function() {
    $("#item_store").click(function(e) 
	{
		// check for my click
		if( $(e.target).hasClass("store_item") && !$(e.target).hasClass("item_hidden"))
		{
			var itemType = $(e.target).data('quality');
			var itemIndex = $(e.target).data('index');
			OnItemClick(itemType, itemIndex);
		}
						
		// check for my children's clicks
		var eparent = $(e.target).parent();
		if (eparent != null && eparent.hasClass("store_item"))
		{
			var itemType = eparent.data('quality');
			var itemIndex = eparent.data('index');
			OnItemClick(itemType, itemIndex);			
		}
    });
})