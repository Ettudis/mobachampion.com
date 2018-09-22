var numGlads = 0;
var numHunters = 0;
var usedShapers = "";

function Bravery()
{
	this.shaper = "";
	this.spells = new Array();
	this.role = "";
	this.items = new Array();
	this.order = "R";
}

function LoadBravery()
{
	var bravery = new Bravery();
	if (shaperDataLoaded)
	{
		var validShapers = new Array();
		
		$(".bravery_shaper_option").each(function()
		{
			if (!$(this).hasClass("bravery_shaper_inactive"))
			{
				var shaper = $(this).data('shaper');
				for (var i = 0; i < shaperData.length; i++)
				{
					if (shaper == shaperData[i].name)
					{
						if (usedShapers.indexOf(shaper) == -1)
						{
							validShapers.push(shaperData[i]);
						}
					}
				}
			}
		});
		
		if (validShapers.length == 0)
		{
			alert('No shapers were selected.');
			bravery.shaper = shaperData[0];
		}
		else
		{
			var rndIndex = Math.floor(validShapers.length * Math.random());
			bravery.shaper = validShapers[rndIndex];
			usedShapers += bravery.shaper.name;
			usedShapers += ",";
		}
	}
	
	if (roleDataLoaded)
	{
		var bFoundRole = false;
		var timeout = 0;
		while (!bFoundRole && timeout < 100) // just in case epic code bug
		{
			var rndIndex = Math.floor(roleData.length * Math.random());
			var myRole = roleData[rndIndex];
			if (myRole.name == "Gladiator")
			{
				if (numGlads > 0)
				{
					numGlads--;
					bravery.role = myRole;
					bFoundRole = true;
				}
			}
			else if (myRole.name == "Hunter")
			{
				if (numHunters > 0)
				{
					numHunters--;
					bravery.role = myRole;
					bFoundRole = true;
				}
			}
			else
			{
				bravery.role = myRole;
				bFoundRole = true;
			}
			
			timeout++;
		}
		bravery.role = roleData[rndIndex];
	}
	
	if (spellDataLoaded)
	{
		var copySpellData = [].concat(spellData);
		for (var i = 0; i < 3; i++) 
		{
			var bFoundSpell = false;
			var timeout = 0;
			while (!bFoundSpell && timeout < 100) // just in case epic code bug
			{
				var rndIndex = Math.floor(copySpellData.length * Math.random());
				var spell = copySpellData[rndIndex];
				if ($.inArray(spell, bravery.spells) < 0)
				{
					bravery.spells.push(spell);
					copySpellData.splice(rndIndex, 1);
					bFoundSpell = true;
				}
				timeout++;
			}
		}
	}
	
	if (itempaloozaDataLoaded)
	{
		var copyItemData = [].concat(itempaloozaData);
		for (var i = 0; i < 6; i++) 
		{
			var bFoundItem = false;
			var timeout = 0;
			while (!bFoundItem && timeout < 100) // just in case epic code bug
			{
				var rndIndex = Math.floor(copyItemData.length * Math.random());
				var item = copyItemData[rndIndex];
				if (item.buildsfrom != "" && item.buildsinto == "" && $.inArray(item, bravery.items) < 0)
				{
					bravery.items.push(item);
					copyItemData.splice(rndIndex, 1);
					bFoundItem = true;
				}
				timeout++;
			}
		}
	}
	
	var order = ["Q", "W", "E"];
	for (var i = 0; i < 3; i++)
	{
		var rndIndex = Math.floor(order.length * Math.random());
		var spl = order.splice(rndIndex, 1);
		bravery.order += spl;
	}
	
	return bravery;
}

function ucfirst(string)
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function strtolower(string)
{
	return string.toLowerCase();
}

function ucfirstl(string)
{
	return ucfirst(strtolower(string));
}

function GroupBraveryRow(braveryRow, i)
{
	$br = $bs.find("#bravery_group" + i);
	
	$br.html(braveryRow.shaper.name);
	
	var sname = strtolower(braveryRow.shaper.name);
	var rname = strtolower(braveryRow.role.name);
	var oname = strtolower(braveryRow.order);

	var shaperDiv = '<div data-shaper="' + ucfirst(braveryRow.shaper.name) + '" class="bravery_small_icon group_shaper" title="' + ucfirst(braveryRow.shaper.name) + '"><img src="http://www.moba-champion.com/images/shapers/' + sname + '.png"></div>';
	var roleDiv = '<div data-role="' + ucfirst(braveryRow.role.name) + '" class="bravery_small_icon group_role" title="' + ucfirst(braveryRow.role.name) + '"><img src="http://www.moba-champion.com/images/roles/' + rname + '.png"></div>';
	var playerDiv = '<div class="bravery_group_name"><input type="text" value="Player ' + (i+1) + '" maxlength="16"></input></div>';
	
	var spell1Div = '<div data-spell="' + ucfirst(braveryRow.spells[0].name) + '" class="bravery_small_icon group_spell" title="' + ucfirst(braveryRow.spells[0].name) + '"><img src="http://www.moba-champion.com/images/spells/Spell_' + braveryRow.spells[0].name + '.png"></div>';
	var spell2Div = '<div data-spell="' + ucfirst(braveryRow.spells[1].name) + '" class="bravery_small_icon group_spell" title="' + ucfirst(braveryRow.spells[1].name) + '"><img src="http://www.moba-champion.com/images/spells/Spell_' + braveryRow.spells[1].name + '.png"></div>';
	var spell3Div = '<div data-spell="' + ucfirst(braveryRow.spells[2].name) + '" class="bravery_small_icon group_spell" title="' + ucfirst(braveryRow.spells[2].name) + '"><img src="http://www.moba-champion.com/images/spells/Spell_' + braveryRow.spells[2].name + '.png"></div>';
	
	var braveryString = braveryRow.order[0] + " > " + braveryRow.order[1] + " > " + braveryRow.order[2] + " > " + braveryRow.order[3];
	var skillOrderDiv = '<BR><div class="bravery_small_icon group_order" data-order="' + braveryRow.order + '">' + braveryString + '</div>';
	
	var item0Div = '<div data-item="' + ucfirst(braveryRow.items[0].name) + '" class="bravery_small_icon group_item" title="' + ucfirst(braveryRow.items[0].name) + '"><img src="http://www.moba-champion.com/images/itempalooza/' + braveryRow.items[0].name + '.png"></div>';
	var item1Div = '<div data-item="' + ucfirst(braveryRow.items[1].name) + '" class="bravery_small_icon group_item" title="' + ucfirst(braveryRow.items[1].name) + '"><img src="http://www.moba-champion.com/images/itempalooza/' + braveryRow.items[1].name + '.png"></div>';
	var item2Div = '<div data-item="' + ucfirst(braveryRow.items[2].name) + '" class="bravery_small_icon group_item" title="' + ucfirst(braveryRow.items[2].name) + '"><img src="http://www.moba-champion.com/images/itempalooza/' + braveryRow.items[2].name + '.png"></div>';
	var item3Div = '<div data-item="' + ucfirst(braveryRow.items[3].name) + '" class="bravery_small_icon group_item" title="' + ucfirst(braveryRow.items[3].name) + '"><img src="http://www.moba-champion.com/images/itempalooza/' + braveryRow.items[3].name + '.png"></div>';
	var item4Div = '<div data-item="' + ucfirst(braveryRow.items[4].name) + '" class="bravery_small_icon group_item" title="' + ucfirst(braveryRow.items[4].name) + '"><img src="http://www.moba-champion.com/images/itempalooza/' + braveryRow.items[4].name + '.png"></div>';
	var item5Div = '<div data-item="' + ucfirst(braveryRow.items[5].name) + '" class="bravery_small_icon group_item" title="' + ucfirst(braveryRow.items[5].name) + '"><img src="http://www.moba-champion.com/images/itempalooza/' + braveryRow.items[5].name + '.png"></div>';
	
	$br.html(shaperDiv + roleDiv + playerDiv + skillOrderDiv + '<div style="width:450px;height:12px;float:left"></div>' +
			skillOrderDiv + item0Div + item1Div + item2Div + item3Div + item4Div + item5Div +
			'<div style="width:60px;height:10px;float:left"></div>' +
			spell1Div + spell2Div + spell3Div);
	
	AddShaperTooltip(".group_shaper");
	AddRoleTooltips(".group_role");
	AddItemPTooltips(".group_item");
}

function CanDoGroup(num)
{
	if (shaperDataLoaded)
	{
		var validShapers = new Array();
		
		$(".bravery_shaper_option").each(function()
		{
			if (!$(this).hasClass("bravery_shaper_inactive"))
			{
				var shaper = $(this).data('shaper');
				for (var i = 0; i < shaperData.length; i++)
				{
					if (shaper == shaperData[i].name)
					{
						if (usedShapers.indexOf(shaper) == -1)
						{
							validShapers.push(shaperData[i]);
						}
					}
				}
			}
		});
		
		if (validShapers.length < num)
		{
			return false;
		}
		
		return true;
	}
	
	return false;
}

function GroupBravery()
{	
	for (var i = 0; i < 10; i++)
	{
		// Reset vals 
		if (i == 0 || i == 5)
		{
			numGlads = $("#maxglad").val();
			numHunters = $("#maxhunt").val();
			usedShapers = "";
		}
		
		var braveryRow = LoadBravery();
		GroupBraveryRow(braveryRow, i);
	}
}

function SoloBravery()
{	
	numGlads = 1;
	numHunters = 1;
	usedShapers = "";
	var soloBravery = LoadBravery();
	
	// define names
	var sname = strtolower(soloBravery.shaper.name);
	var rname = strtolower(soloBravery.role.name);
	var oname = strtolower(soloBravery.order);
	var iname = soloBravery.items[0].itemid.toString() + soloBravery.items[1].itemid.toString() + 
				soloBravery.items[2].itemid.toString() + soloBravery.items[3].itemid.toString() + 
				soloBravery.items[4].itemid.toString() + soloBravery.items[5].itemid.toString();
	
	console.log(soloBravery);
	
	// Shaper Name
	$bs.find(".bravery_name").html(ucfirst(soloBravery.role.name) + " " + ucfirst(soloBravery.shaper.name))
	
	// Shaper Img
	$bs.find("#shaper0").attr("src", "http://www.moba-champion.com/images/shapers/" + strtolower(soloBravery.shaper.name) + ".png")
							 .tooltipster('destroy')
							 .attr('title',ucfirst(soloBravery.shaper.name));
							 
	// Role
	$bs.find("#role0").attr("src", "http://www.moba-champion.com/images/roles/" + rname + ".png")
					.tooltipster('destroy')
					.attr('title',ucfirst(soloBravery.role.name));

	// Spell Img
	$bs.find(".bravery_spellorder").find("#spell00").find("img")
			.attr("src", "http://www.moba-champion.com/images/spells/Spell_" + soloBravery.spells[0].name + ".png");
	$bs.find(".bravery_spellorder").find("#spell01").find("img")
			.attr("src", "http://www.moba-champion.com/images/spells/Spell_" + soloBravery.spells[1].name + ".png");
	$bs.find(".bravery_spellorder").find("#spell02").find("img")       
			.attr("src", "http://www.moba-champion.com/images/spells/Spell_" + soloBravery.spells[2].name + ".png");
			
	// Spell order tooltips
	$bs.find(".bravery_spellorder").find("#spell00").data('spell', ucfirst(soloBravery.spells[0].name))
									.tooltipster('destroy')
									.attr('title', ucfirst(soloBravery.spells[0].name));
	$bs.find(".bravery_spellorder").find("#spell01").data('spell', ucfirst(soloBravery.spells[1].name))
									.tooltipster('destroy')
									.attr('title', ucfirst(soloBravery.spells[1].name));
	$bs.find(".bravery_spellorder").find("#spell02").data('spell', ucfirst(soloBravery.spells[2].name))
									.tooltipster('destroy')
									.attr('title', ucfirst(soloBravery.spells[2].name));
									
	// Skill Order Img
	$bs.find(".bravery_skillorder").find("#ability00").find("img")
			.attr("src", "http://www.moba-champion.com/images/shapers/" + sname + "/" + soloBravery.order[0].toLowerCase() + ".png");
	$bs.find(".bravery_skillorder").find("#ability01").find("img")
			.attr("src", "http://www.moba-champion.com/images/shapers/" + sname + "/" + soloBravery.order[1].toLowerCase() + ".png");
	$bs.find(".bravery_skillorder").find("#ability02").find("img")
			.attr("src", "http://www.moba-champion.com/images/shapers/" + sname + "/" + soloBravery.order[2].toLowerCase() + ".png");
	$bs.find(".bravery_skillorder").find("#ability03").find("img")
			.attr("src", "http://www.moba-champion.com/images/shapers/" + sname + "/" + soloBravery.order[3].toLowerCase() + ".png");
	
	// Skill order tooltips
	$bs.find(".bravery_skillorder").find("#ability00").data('shaper', ucfirst(sname))
									.attr('title', soloBravery.order[0].toLowerCase());
	$bs.find(".bravery_skillorder").find("#ability01").data('shaper', ucfirst(sname))
									.attr('title', soloBravery.order[1].toLowerCase());
	$bs.find(".bravery_skillorder").find("#ability02").data('shaper', ucfirst(sname))
									.attr('title', soloBravery.order[2].toLowerCase());
	$bs.find(".bravery_skillorder").find("#ability03").data('shaper', ucfirst(sname))
									.attr('title', soloBravery.order[3].toLowerCase());
		
	// Skill Order Text
	$bs.find(".bravery_skillorder").find("#ability00").find(".bravery_ability_key").html(soloBravery.order[0]);
	$bs.find(".bravery_skillorder").find("#ability01").find(".bravery_ability_key").html(soloBravery.order[1]);
	$bs.find(".bravery_skillorder").find("#ability02").find(".bravery_ability_key").html(soloBravery.order[2]);
	$bs.find(".bravery_skillorder").find("#ability03").find(".bravery_ability_key").html(soloBravery.order[3]);
	
	// Item Array
	$bs.find("#item00").attr("src", "http://www.moba-champion.com/images/itempalooza/" + ucfirst(soloBravery.items[0].name) + ".png").tooltipster('destroy').attr('title', ucfirst(soloBravery.items[0].name));
	$bs.find("#item01").attr("src", "http://www.moba-champion.com/images/itempalooza/" + ucfirst(soloBravery.items[1].name) + ".png").tooltipster('destroy').attr('title', ucfirst(soloBravery.items[1].name));
	$bs.find("#item02").attr("src", "http://www.moba-champion.com/images/itempalooza/" + ucfirst(soloBravery.items[2].name) + ".png").tooltipster('destroy').attr('title', ucfirst(soloBravery.items[2].name));
	$bs.find("#item03").attr("src", "http://www.moba-champion.com/images/itempalooza/" + ucfirst(soloBravery.items[3].name) + ".png").tooltipster('destroy').attr('title', ucfirst(soloBravery.items[3].name));
	$bs.find("#item04").attr("src", "http://www.moba-champion.com/images/itempalooza/" + ucfirst(soloBravery.items[4].name) + ".png").tooltipster('destroy').attr('title', ucfirst(soloBravery.items[4].name));
	$bs.find("#item05").attr("src", "http://www.moba-champion.com/images/itempalooza/" + ucfirst(soloBravery.items[5].name) + ".png").tooltipster('destroy').attr('title', ucfirst(soloBravery.items[5].name));
	
	// Sharing is Caring
	var shareUrl = "http://www.moba-champion.com/gamemodes/bravery.php?shaper=" + sname + "&role=" + rname + "&order=" + oname + "&items=" + iname
					+ "&s1=" + soloBravery.spells[0].name + "&s2=" + soloBravery.spells[1].name + "&s3=" + soloBravery.spells[2].name;
	$("#solo_share").val(shareUrl);
	
	AddItemPTooltips(".solo_item");
	AddShaperTooltip("#shaper0");
	AddRoleTooltips("#role0");
	AddSpellTooltip("#spell00");
	AddSpellTooltip("#spell01");
	AddSpellTooltip("#spell02");
	AddAbilityTooltip("#ability00");
	AddAbilityTooltip("#ability01");
	AddAbilityTooltip("#ability02");
	AddAbilityTooltip("#ability03");
}

function EvaluateRegions(active, rclass, reclass)
{
	var numNorth = 0;
	var numSouth = 0;
	var numEast  = 0;
	var numWest  = 0;
	var numHeart = 0;
	var numUnaff = 0;
	var numRanged = 0;
	var numMelee = 0;
	
	var invNorth = 0;
	var invSouth = 0;
	var invEast  = 0;
	var invWest  = 0;
	var invHeart = 0;
	var invUnaff = 0;
	var invRanged = 0;
	var invMelee = 0;
		
	$(".bravery_shaper_option").each(function()
	{
		var role = $(this).data('role').toLowerCase();
		var region = $(this).data('region').toLowerCase();
		if (role.indexOf(rclass) >= 0)
		{
			if (active)
			{
				$(this).removeClass("bravery_shaper_inactive");
			}
			else
			{
				$(this).addClass("bravery_shaper_inactive");
			}
		}
		else if(region.indexOf(reclass) >= 0)
		{
			if (active)
			{
				$(this).removeClass("bravery_shaper_inactive");
			}
			else
			{
				$(this).addClass("bravery_shaper_inactive");
			}
		}
		
		var shaperActive = !($(this).hasClass('bravery_shaper_inactive'));
		switch(region)
		{
			case "the north":
				shaperActive ? numNorth++ : invNorth++;
				break;
			case "the south":
				shaperActive ? numSouth++ : invSouth++;
				break;
			case "the east":
				shaperActive ? numEast++ : invEast++;
				break;
			case "the west":
				shaperActive ? numWest++ : invWest++;
				break;
			case "the heart of the world":
				shaperActive ? numHeart++ : invHeart++;
				break;
			case "none":
				shaperActive ? numUnaff++ : invUnaff++;
				break;
		}
		if (role.indexOf("ranged") >= 0)
		{
			shaperActive ? numRanged++ : invRanged++;
		}
		else if (role.indexOf("melee") >= 0)
		{
			shaperActive ? numMelee++ : invMelee++;
		}
	});
	
	if (numNorth == 0)
	{
		$("#region_north").removeClass('active');
	}
	else if (invNorth == 0)
	{
		$("#region_north").addClass('active');
	}

	if (numEast == 0)
	{
		$("#region_east").removeClass('active');
	}
	else if (invEast == 0)
	{
		$("#region_east").addClass('active');
	}
	
	if (numSouth == 0)
	{
		$("#region_south").removeClass('active');
	}
	else if (invSouth == 0)
	{
		$("#region_south").addClass('active');
	}
	
	if (numWest == 0)
	{
		$("#region_west").removeClass('active');
	}
	else if (invWest == 0)
	{
		$("#region_west").addClass('active');
	}
	
	if (numHeart == 0)
	{
		$("#region_heart").removeClass('active');
	}
	else if (invHeart == 0)
	{
		$("#region_heart").addClass('active');
	}
	
	if (numUnaff == 0)
	{
		$("#region_none").removeClass('active');
	}
	else if (invUnaff == 0)
	{
		$("#region_none").addClass('active');
	}
	
	if (numRanged == 0)
	{
		$("#range_ranged").removeClass('active');
	}
	else if (invRanged == 0)
	{
		$("#range_ranged").addClass('active');
	}
	
	if (numMelee == 0)
	{
		$("#range_melee").removeClass('active');
	}
	else if (invMelee == 0)
	{
		$("#range_melee").addClass('active');
	}
}

$(document).ready(function() 
{
	$(".bravery_shaper_option").click(function()
	{
		$(this).toggleClass("bravery_shaper_inactive");
		var active = $(this).hasClass('active');
		EvaluateRegions(active, 'invalid', 'invalid');
	});
	
	$("#select_all").click(function()
	{
		$(".bravery_shaper_option").removeClass("bravery_shaper_inactive");
		$(".solo_region").addClass('active');
		$(".solo_range").addClass('active');
	});
	
	$("#select_none").click(function()
	{
		$(".bravery_shaper_option").addClass("bravery_shaper_inactive");
		$(".solo_region").removeClass('active');
		$(".solo_range").removeClass('active');
	});
	
	$(".solo_region").click(function()
	{
		var region = $(this).data('region');
		$(this).toggleClass('active');
		var active = $(this).hasClass('active');
		EvaluateRegions(active, 'invalid', region);
	});
	
	$(".solo_range").click(function()
	{
		var rangeClass = $(this).data('range');
		$(this).toggleClass('active');
		var active = $(this).hasClass('active');
		EvaluateRegions(active, rangeClass, 'invalid');
	});
	
	$("#solo_generate_btn").click(function()
	{
		$bs = $("#bravery_solo");
		$bs.find(".bravery_entry").show();
		$bs.find(".bravery_instructions").hide();
		if (!CanDoGroup(1))
		{
			alert("Not enough shapers for Solo Bravery!");
		}
		else
		{
			SoloBravery();
		}
	});
	
	$("#group_generate_btn").click(function()
	{
		$bs = $("#bravery_group");
		$bs.find(".bravery_grpentry").show();
		$bs.find("#bravery_gintro").hide();
		$bs.find("#bravery_mortal").show();
		$bs.find("#bravery_spirit").show();
		$bs.find("#group_saver").show();
		if (!CanDoGroup(5))
		{
			alert("Not enough shapers for Solo Bravery!");
		}
		else
		{
			GroupBravery();
		}
	});
	
	$("#solo_switcher").click(function()
	{
		$("#bravery_solo").hide();
		$("#bravery_group").show();
		$("#solo_generate_btn").hide();
		$("#group_generate_btn").show();
		$("#group_only_options").show();
	});
	
	$("#group_switcher").click(function()
	{
		$("#bravery_solo").show();
		$("#bravery_group").hide();
		$("#solo_generate_btn").show();
		$("#group_generate_btn").hide();
		$("#group_only_options").hide();
	});
	
	$("#bravery_builder").click(function(e)
	{
		window.location.href = "http://www.moba-champion.com/gamemodes/bravery.php";
	});
	
    $("#group_save_btn").click(function(e)
	{
		$(".bravery_group_share").slideDown();
		var url = "savebravery.php";

		var Shapers = new Array();
		var Spells = new Array();
		var Items = new Array();
		var Players = new Array();
		var Orders = new Array();
		var Roles = new Array();
		
		var i = 0;
		
		$(".bravery_grpentry").each(function()
		{
			// shaper
			var shaper = $(this).find(".group_shaper").data('shaper');
			Shapers.push(shaper);
			
			// role
			var role = $(this).find(".group_role").data("role");
			Roles.push(role);
			
			// player name
			var player = $(this).find(".bravery_group_name input").val();
			Players.push(player);
			
			var order = $(this).find(".group_order").data("order");
			Orders.push(order);
			
			// spell 1-3
			var spell = "";
			$(this).find(".group_spell").each(function()
			{
				spell += $(this).data('spell');
				spell += ",";
			});
			spell = spell.substring(0, spell.length-1);
			Spells.push(spell);
			
			// items 1-6
			var item = "";
			$(this).find(".group_item").each(function()
			{
				item += $(this).data('item');
				item += ",";
			});
			item = item.substring(0, item.length-1);
			Items.push(item);
		});
		
		$.post(url,
		{ 
            player1 :  Players[0],
			player2 :  Players[1],
			player3 :  Players[2],
			player4 :  Players[3],
			player5 :  Players[4],
			player6 :  Players[5],
			player7 :  Players[6],
			player8 :  Players[7],
			player9 :  Players[8],
			player10 : Players[9],
            shaper1 :  Shapers[0],
			shaper2 :  Shapers[1],
			shaper3 :  Shapers[2],
			shaper4 :  Shapers[3],
			shaper5 :  Shapers[4],
			shaper6 :  Shapers[5],
			shaper7 :  Shapers[6],
			shaper8 :  Shapers[7],
			shaper9 :  Shapers[8],
			shaper10 : Shapers[9],
            role1 :  Roles[0],
			role2 :  Roles[1],
			role3 :  Roles[2],
			role4 :  Roles[3],
			role5 :  Roles[4],
			role6 :  Roles[5],
			role7 :  Roles[6],
			role8 :  Roles[7],
			role9 :  Roles[8],
			role10 : Roles[9],
			spells1 : Spells[0],
			spells2 : Spells[1],
			spells3 : Spells[2],
			spells4 : Spells[3],
			spells5 : Spells[4],
			spells6 : Spells[5],
			spells7 : Spells[6],
			spells8 : Spells[7],
			spells9 : Spells[8],
			spells10 : Spells[9],
			items1 : Items[0],
			items2 : Items[1],
			items3 : Items[2],
			items4 : Items[3],
			items5 : Items[4],
			items6 : Items[5],
			items7 : Items[6],
			items8 : Items[7],
			items9 : Items[8],
			items10 : Items[9],
			order1 : Orders[0],
			order2 : Orders[1],
			order3 : Orders[2],
			order4 : Orders[3],
			order5 : Orders[4],
			order6 : Orders[5],
			order7 : Orders[6],
			order8 : Orders[7],
			order9 : Orders[8],
			order10 : Orders[9]
		},
		function(data) 
		{	
			var results = jQuery.parseJSON(data);
			if (results.success == true)
			{
				var v = "http://www.moba-champion.com/gamemodes/bravery.php?id=" + results.returnid;
				$("#group_share").val(v);
			}
			
			console.log(results);
		});
	});
});
	