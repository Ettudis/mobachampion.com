var searchMouseHappened = false;
var arrayShapers = [];
var arrayItems = [];
var arrayRoles = [];
var arraySpells = [];

var SearchTrie = new Trie();

function AddSearchItem(item, type)
{
	if (type == "shaper")
	{
		arrayShapers.push(item);
	}
	else if (type == "item")
	{
		arrayItems.push(item);
	}
	else if (type == "role")
	{
		arrayRoles.push(item);
	}
	else if (type == "spell")
	{
		arraySpells.push(item);
	}
	
	SearchTrie.insert(item.toLowerCase());
};

$(document).ready(function() 
{	
	/*
	var i;
    for(i = 0; i < arrayShapers.length; i++) {
        T.insert(arrayShapers[i].toLowerCase());
    } */
	
	$('#shaper_search').blur(function() 
	{
		if (searchMouseHappened == false)
		{
			$("#moba_search_result").hide();
		}
		
		searchMouseHappened = false;
	});
		
	$('#shaper_search').focus(function() 
	{
		var content = $(this).val().length;
		if (content > 0)
		{
			$("#moba_search_result").show();	
		}
	});
	
	$("#shaper_search").keyup(function()
	{
		var textInput, html;
		textInput = $(this).val();
		
		stateList = SearchTrie.autoComplete(textInput.toLowerCase());
		html = "";
				
		if (stateList.length > 0)
		{
			for (var j=0 ; j < stateList.length && j < 5; j++)
			{ 
				var searchResult = stateList[j];
				searchResult = searchResult.replace(/\b[a-z]/g, function(letter) {
					return letter.toUpperCase();
				});
				
				var found = false;
				var i;
				for (i = 0; i < arrayShapers.length && found == false; i++)
				{
					if (arrayShapers[i] == searchResult)
					{
						html += '<div class="moba_search_result_row">';
						html += '<div class="moba_search_img"><a class="moba_search_link" href="http://www.moba-champion.com/shapers/' + stateList[j] + '">' + '<img src="http://www.moba-champion.com/images/shapers/' + stateList[j] + '.png" class="shapertip newshapertips" title="' + searchResult + '"></a></div>';
						html += '<div class="moba_search_content"><a class="moba_search_link shapertip newshapertips" title="' + searchResult + '" href="http://www.moba-champion.com/shapers/' + stateList[j] + '">' + searchResult + '</a></div>';
						html += "</div>";
						found = true;
					}
				}
				for (i = 0; i < arrayItems.length && found == false; i++)
				{
					if (arrayItems[i] == searchResult)
					{
						html += '<div class="moba_search_result_row">';
						html += '<div class="moba_search_img"><a class="moba_search_link" href="http://www.moba-champion.com/items/item.php?item=' + searchResult + '">' + '<img src="http://www.moba-champion.com/images/itempalooza/' + searchResult + '.png" class="iptip newitemtips" title="' + searchResult + '"></a></div>';
						html += '<div class="moba_search_content"><a class="moba_search_link newitemtips" title="' + searchResult + '" href="http://www.moba-champion.com/items/item.php?item=' + searchResult + '">' + searchResult + '</a></div>';
						html += "</div>";				
					}
				}
				for (i = 0; i < arrayRoles.length && found == false; i++)
				{			
					if (arrayRoles[i] == searchResult)
					{
						html += '<div class="moba_search_result_row">';
						html += '<div class="moba_search_img"><a class="moba_search_link" href="http://www.moba-champion.com/roles/' + stateList[j] + '">' + '<img src="http://www.moba-champion.com/images/roles/' + stateList[j] + '.png" class="roletip newroletips" title="' + searchResult + '"></a></div>';
						html += '<div class="moba_search_content"><a class="moba_search_link newroletips" title="' + searchResult + '" href="http://www.moba-champion.com/roles/' + stateList[0] + '">' + searchResult + '</a></div>';
						html += "</div>";	
					}
				}
				for (i = 0; i < arraySpells.length && found == false; i++)
				{				
					if (arraySpells[i] == searchResult)
					{
						html += '<div class="moba_search_result_row">';
						html += '<div class="moba_search_img"><a class="moba_search_link" href="http://www.moba-champion.com/spells/' + stateList[j] + '">' + '<img src="http://www.moba-champion.com/images/spells/Spell_' + searchResult + '_1.png" class="spelltip newspelltips" title="' + searchResult + '"></a></div>';
						html += '<div class="moba_search_content"><a class="moba_search_link newspelltips" title="' + searchResult + '" href="http://www.moba-champion.com/spells#' + searchResult + '">' + searchResult + '</a></div>';
						html += "</div>";				
					}				
				}
			}
		}

		if (textInput.length == 0)
		{
			$("#moba_search_result").hide();
			$("#moba_search_result").html("");
		}
		else
		{
			$("#moba_search_result").show();
			$("#moba_search_result").html(html);
		}
		
		$('.moba_search_link').mousedown(function() 
		{
			searchMouseHappened = true;
		});
				
		
		$("#moba_search_result").removeClass('moba_search_hidden');
		
		AddItemPTooltips(".newitemtips");
		AddSpellTooltip(".newspelltips");
		AddRoleTooltips(".newroletips");
		AddShaperTooltip(".newshapertips");
	});
});
