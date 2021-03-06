// Overall type and saving
var GuideType = 0;
var SaveInProgress;

// Fullselectors
var SpellPickerNumChoices = 0;
var ItemPickerNumChoices = 0;
var CurLoadoutId = 0;
var shownSaveTooltip = false;

// Modified
var GuideRolesModified = true;
var GuideLoadoutModified = true;
var GuideSpellModified = true;
var GuideItemModified = true;
var GuideSkillModified = true;
var GuideAbilityUpdated = true;

var PendingSaves = 0;
	
function CloseSelector(delay)
{
	$("#guidev2_type_selector").slideUp(delay);
	$("#master_guide_settings").show(delay);
}

function OpenSelector(delay)
{
	$("#guidev2_type_selector").slideDown(delay);
}

function OpenSettings(toggle, delay)
{
	if (GuideType == 1)
	{
		$(".guidev2_settings_shaper").show(0);
		$("#guidev2_settings_left_shaper").show(0);
	}
	else
	{
		$(".guidev2_settings_shaper").hide(0);
		$("#guidev2_settings_left_shaper").hide(0);
	}
	
	if (toggle == true)
	{
		$("#guidev2_settings").slideToggle(delay)
	}
	else
	{
		$("#guidev2_settings").slideDown(delay);
	}
}

function CloseSettings(delay)
{
	$("#guidev2_settings").slideUp(delay);
}

function LoadHeader(delay)
{
	$("#guidev2_header").slideDown(delay);
}

function LoadQuickGuide()
{
	$("#guidev2_quick").slideDown(500);
}

function StartEdit()
{
	$("#guidev2_redo").delay(1000).show(0);
	$("#guidev2_start").html('Update Settings');
}

function LoadRequiredSections()
{
	$("#guidev2_roles").show();
	$("#guidev2_loadouts").show();
	$("#guidev2_spells").show();
	$("#guidev2_items").show();
	$("#guidev2_skillorder").show();
	$("#guidev2_abilities").show();
	//$("#guidev2_matchups").show();
	$("#guidev2_publish").show();
	$("#guidev2_publish2").show();
	$("#guidev2_help").show();
	CreateSceditors();
	//LoadQuickGuide();
	//CreateAddSectionButton($("#guidev2_quick"));
}

function CreateAddSectionButton(afterElem)
{
	var src = '<div class="guidev2_add_section_left"><i class="icon-plus"></i></div><div class="guidev2_add_section_right">Add Section</div>';
	d=document.createElement("div");
	$(d).addClass("guidev2_add_section")
		.css('display', 'none')
		.html(src)
		.insertAfter(afterElem)
		.show(500);
}

function ValidateSettings()
{
	GuideIgn = $(".guidev2_settings_ign_val").val();
	GuideTitle = $(".guidev2_settings_title_val").val();
	GuideShaper = $(".guidev2_settings_shaper_val").find(":selected").text();
	
	var bResult = true;
	if (GuideTitle == "")
	{
		if ($('#guidev2_settings_title_err').length == 0)
		{
			var src = '<a href="#" class="close" data-dismiss="alert">&times;</a>You must enter a Guide Title.';
			d=document.createElement("div");
			$(d).addClass("guidev2_settings_err")
				.attr('id', 'guidev2_settings_title_err')
				.css('display', 'none')
				.html(src)
				.appendTo($(".guidev2_settings_title"))
				.show(500);
		}
		else
		{
			$('#guidev2_settings_title_err').show(500);
		}

		bResult = false;
	}
	else if (GuideTitle.length > 64)
	{
		if ($('#guidev2_settings_title_err').length == 0)
		{
			var src = '<a href="#" class="close" data-dismiss="alert">&times;</a>Maximum length of 64 characters.';
			d=document.createElement("div");
			$(d).addClass("guidev2_settings_err")
				.attr('id', 'guidev2_settings_title_err')
				.css('display', 'none')
				.html(src)
				.appendTo($(".guidev2_settings_title"))
				.show(500);
		}
		else
		{
			$('#guidev2_settings_title_err').show(500);
		}
	}
	
	if (GuideIgn == "")
	{
		if ($('#guidev2_settings_ign_err').length == 0)
		{
			var src = '<a href="#" class="close" data-dismiss="alert">&times;</a>Please enter your in-game name.';
			d=document.createElement("div");
			$(d).addClass("guidev2_settings_err")
				.attr('id', 'guidev2_settings_ign_err')
				.css('display', 'none')
				.html(src)
				.appendTo($(".guidev2_settings_ign"))
				.show(500);
		}
		else
		{
			$('#guidev2_settings_ign_err').show(500);
		}
		
		bResult = false;
	}
	
	if (GuideType == 1 && GuideShaper == "Select a Shaper...")
	{
		if ($('#guidev2_settings_shaper_err').length == 0)
		{
			var src = '<a href="#" class="close" data-dismiss="alert">&times;</a>Please select a shaper.';
			d=document.createElement("div");
			$(d).addClass("guidev2_settings_err")
				.attr('id', 'guidev2_settings_shaper_err')
				.css('display', 'none')
				.html(src)
				.appendTo($(".guidev2_settings_shaper"))
				.show(500);
		}
		else
		{
			$('#guidev2_settings_shaper_err').show(500);
		}
		
		bResult = false;
	}
	
	return bResult;
}

function GetGuideHeader()
{
	if (GuideType == 1)
	{
		return GuideShaper;
	}
	else if (GuideType == 2)
	{
		return "team";
	}
	else if (GuideType == 3)
	{
		return "general";
	}
	
	return "general";
}

function ucfirst( str ) {
    return str.substr(0, 1).toUpperCase() + str.substr(1);
}

function lcfirst( str ) {
    return str.substr(0, 1).toLowerCase() + str.substr(1);
}

function validateUrl(str)
{
	if(/^([a-z]([a-z]|\d|\+|-|\.)*):(\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?((\[(|(v[\da-f]{1,}\.(([a-z]|\d|-|\.|_|~)|[!\$&'\(\)\*\+,;=]|:)+))\])|((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=])*)(:\d*)?)(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*|(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)){0})(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(str)) 
	{
	  return true;
	} 
	else 
	{
	  return false;
	}
}

function strContains(str, contains)
{
	if (str.indexOf(contains) != -1)
	{
		return true;
	}
	
	return false;
}

function escapeRegExp(str) 
{
  return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
}

function replaceAll(find, replace, str) 
{
  return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);
}

function startsWith(str, find)
{
	if (str.substring(0, find.length) === find)
	{
		return true;
	}
	
	return false;
}

function UpdateHeader()
{
	var imgSrc = "http://www.moba-champion.com/images/shapers/" + GuideHeader.toLowerCase() + "/header.jpg";
	if ($('.guidev2_header_bg_img').length == 0)
	{
		d=document.createElement("img");
		$(d).addClass("guidev2_header_bg_img")
			.attr('src', imgSrc)
			.css('display', 'none')
			.html('')
			.appendTo($("#guidev2_header_bg"))
			.load(function()
			{
				$(".guidev2_header_bg_img").show(0);
			});
	}
	else
	{
		$('.guidev2_header_bg_img').attr('src', imgSrc);
		$(".guidev2_header_bg_img").show(0);
	}
}

function CreateNewGuide()
{
	$(".guide_settings_spinner").show(0);
		
	if (shownSaveTooltip == false)
	{
		$("#master_guide_settings_tooltip").fadeIn(500);
		shownSaveTooltip = true;
	}
	
	SaveInProgress = true;
	
	$.post("actions/newguide.php",
	{ 
		id : GuideId,
		title : GuideTitle,
		ign : GuideIgn,
		shaper : GuideShaper
	},
	function(data) 
	{
		console.log(data);
		
		SaveInProgress = false; 
		$(".guide_settings_spinner").hide(0);
		
		var results = jQuery.parseJSON(data)
		if (results.id > 0)
		{
			$("#guidev2_header_title_text").html(GuideTitle);
			
			var newGuideHeader = GetGuideHeader();
			UpdateShaper(true);
			GuideId = results.id;
			CloseSettings();
			StartEdit();
			
			if (GuideHeader != newGuideHeader)
			{
				GuideHeader = newGuideHeader;
				UpdateHeader();
				LoadHeader(500);
				LoadRequiredSections();
			}
			else
			{
				if (GuideId == -1)
				{
					LoadHeader(500);
					LoadRequiredSections();
				}
			}
			
			if(history.pushState) 
			{
				history.pushState({"id":100}, document.title, "http://www.moba-champion.com/guides/create.php?id=" + GuideId);
			}
		}
		else
		{
			$(".guide_settings_spinner").hide(0);
			if ($('#guidev2_creation_error').length == 0)
			{
				var src = '<a href="#" class="close" data-dismiss="alert">&times;</a>Error creating Guide. Please try again later.';
				d=document.createElement("div");
				$(d).addClass("guidev2_settings_err")
					.attr('id', 'guidev2_creation_error')
					.css('display', 'none')
					.html(src)
					.appendTo($(".guidev2_settings_creation"))
					.show(500);
			}
			else
			{
				$('#guidev2_creation_error').show(500);
			}
		}
	})
    .error(function() 
	{ 
		alert("Error saving guide.");
		SaveInProgress = false;
		$(".guide_settings_spinner").hide(0);
	});
}

function SaveSettings()
{
	if (!SaveInProgress && ValidateSettings())
	{
		if (GuideId == -1)
		{
			CreateNewGuide();
		}
		else
		{
			UpdateShaper(true);
			UpdateHeader();
			SaveGuide(true);
		}
	}
}

function UpdateShaper(loadTT)
{
	$("#guidev2_skillorder_basic_q").css('background-image', "url(http://www.moba-champion.com/images/shapers/" + GuideShaper.toLowerCase() + "/q.png)")
		.addClass('abilitytip').data('shaper', GuideShaper).attr('title', 'q');
	$("#guidev2_skillorder_basic_w").css('background-image', "url(http://www.moba-champion.com/images/shapers/" + GuideShaper.toLowerCase() + "/w.png)")
		.addClass('abilitytip').data('shaper', GuideShaper).attr('title', 'w');
	$("#guidev2_skillorder_basic_e").css('background-image', "url(http://www.moba-champion.com/images/shapers/" + GuideShaper.toLowerCase() + "/e.png)")
		.addClass('abilitytip').data('shaper', GuideShaper).attr('title', 'e');
	$("#guidev2_skillorder_basic_r").css('background-image', "url(http://www.moba-champion.com/images/shapers/" + GuideShaper.toLowerCase() + "/r.png)")
		.addClass('abilitytip').data('shaper', GuideShaper).attr('title', 'r');
	
	$("#guidev2_ability_p_img").attr('src', 'http://www.moba-champion.com/images/shapers/' + GuideShaper.toLowerCase() + '/p.png')
								.addClass('abilitytip').data('shaper', GuideShaper).attr('title', 'p');
	$("#guidev2_ability_q_img").attr('src', 'http://www.moba-champion.com/images/shapers/' + GuideShaper.toLowerCase() + '/q.png')
								.addClass('abilitytip').data('shaper', GuideShaper).attr('title', 'q');
	$("#guidev2_ability_w_img").attr('src', 'http://www.moba-champion.com/images/shapers/' + GuideShaper.toLowerCase() + '/w.png')
								.addClass('abilitytip').data('shaper', GuideShaper).attr('title', 'w');
	$("#guidev2_ability_e_img").attr('src', 'http://www.moba-champion.com/images/shapers/' + GuideShaper.toLowerCase() + '/e.png')
								.addClass('abilitytip').data('shaper', GuideShaper).attr('title', 'e');
	$("#guidev2_ability_r_img").attr('src', 'http://www.moba-champion.com/images/shapers/' + GuideShaper.toLowerCase() + '/r.png')
								.addClass('abilitytip').data('shaper', GuideShaper).attr('title', 'r');
								
	if (loadTT)
	{
		AddAbilityTooltip("#guidev2_skillorder_basic_q");
		AddAbilityTooltip("#guidev2_skillorder_basic_w");
		AddAbilityTooltip("#guidev2_skillorder_basic_e");
		AddAbilityTooltip("#guidev2_skillorder_basic_r");
		AddAbilityTooltip("#guidev2_ability_p_img");
		AddAbilityTooltip("#guidev2_ability_q_img");
		AddAbilityTooltip("#guidev2_ability_w_img");
		AddAbilityTooltip("#guidev2_ability_e_img");
		AddAbilityTooltip("#guidev2_ability_r_img");
	}
}

function CreateChangeHandlers()
{
	$(".guidev2_settings_title_val").keydown(function()
	{
		$("#guidev2_settings_title_err").hide(0);
	});
	
	$(".guidev2_settings_shaper_val").change(function()
	{
		$("#guidev2_settings_shaper_err").hide(0);
	});
	
	$(".guidev2_settings_ign_val").keydown(function()
	{
		$("#guidev2_settings_ign_err").hide(0);
	});
}

function CreateClickHandlers()
{
	$("#guidev2_header_title_text").click(function()
	{
		OpenSettings(false, 500);
		$(".guidev2_settings_title_val").focus();
	});
	
	$(".master_guide_settings_cog").click(function()
	{
		OpenSettings(true, 500);
	});
	
	$("#guidev2_redo").click(function()
	{
		OpenSelector(500);
		CloseSettings(500);
	});
	
	$("#guidev2_selector_shaper").click(function()
	{
		GuideType = 1;
		CloseSelector(500);
		OpenSettings(false, 500);
		$("#master_guide_title").html('Shaper Guide Editor');
	});
	
	$("#guidev2_selector_comp").click(function()
	{
	/*
		GuideType = 2;
		CloseSelector();
		OpenSettings(false);
		$("#master_guide_title").html('Team Guide Editor');
	*/
	});
	
	$("#guidev2_selector_general").click(function()
	{
	/*
		GuideType = 3;
		CloseSelector();
		OpenSettings(false);
		$("#master_guide_title").html('General Guide Editor');
	*/
	});
	
	$("#guidev2_start").click(function()
	{
		SaveSettings();
	});
	
	$(".guidev2_publish_btn").click(function()
	{
		SaveGuide(false);
	});
	
	$(".guidev2_fullselector_close").click(function()
	{
		$(this).parent().slideUp(300);
		var self = this;
		setTimeout(function() 
		{
			$(self).parent().parent().hide();
			$(".guidev2_fullselector_picker").show(0);
			ClearSpellSelector();
			ClearLoadoutSelector();
			ClearItemSelector();
		}, 300);   // you pick the appropriate time here
	});
}

function CreateRoleHandlers()
{
	$(".guidev2_role_select").click(function()
	{
		MarkModified('role');
		var roleType = $(this).attr('role');
		if (!$(this).hasClass("guidev2_role_row_active"))
		{
			var bFound = false;
			$(".guidev2_role_row").each(function()
			{
				if ($(this).data('role') == roleType)
				{
					bFound = true;
					$(this).appendTo($(".guidev2_role_area"));
					$(this).show(0);
				}
			});
			
			if (bFound == false)
			{
				var src = '	<div class="guidev2_role_left">                 \
								<div class="guidev2_role_img">				\
									<img src="http://www.moba-champion.com/images/roles/' + ucfirst(roleType) + '.png" class="gv2roleroletip" title="' + ucfirst(roleType) + '"></div>        \
									<div class="guidev2_role_header">' + ucfirst(roleType) + '</div>     \
								</div>                                          \
								<div class="guidev2_role_right"><textarea class="add_sceditor" data-type="role"></textarea> \
								<div class="guidev2_controls_updown"> \
								<div class="guidev2_up" data-type="role"><i class="icon-chevron-up"></i></div> 			\
								<div class="guidev2_down" data-type="role"><i class="icon-chevron-down"></i></div></div>		\
								</div>';
								
				d=document.createElement("div");
				$(d).addClass("guidev2_role_row")
					.css('display', 'none')
					.data('role', roleType)
					.html(src)
					.appendTo($(".guidev2_role_area"))
					.show(0);
					
				AddRoleTooltips(".gv2roleroletip");
				$(".gv2roleroletip").removeClass("gv2roleroletip");
				
				AddSceditor();
			}
			
			$(this).addClass("guidev2_role_row_active");
			CreateUpDownHandlers();
		}
		else
		{
			$(".guidev2_role_row").each(function()
			{
				if ($(this).data('role') == roleType)
				{
					$(this).hide(0);
				}
			});
			
			$(this).removeClass("guidev2_role_row_active");
		}
	});
}

function ClearSpellSelector()
{
	$(".guidev2_spell_fullselector_picker").show(0);
	$(".guidev2_spell_fullselector_accept").hide(0);
	SpellPickerNumChoices = 0;
	$(".guidev2_spell_fullselector_summary").html("0 / 3");
	$(".guidev2_spell_fullselector_picker_choices").children(".guidev2_spell_option").each(function()
	{
		$(this).data('valid', false);
		$(".guidev2_spell_fullselector_picker_options").append($(this).clone(true));
		$(this).remove();
	});
}

function CreateSpellHandlers()
{
	$(".guidev2_spell_fullselector_picker_choices").sortable();
	$(".guidev2_spell_fullselector_picker_choices").disableSelection();
	
	$(".guidev2_spell_option").click(function()
	{ 
		var spellName = $(this).data('spell');

		if (SpellPickerNumChoices < 3)
		{	
			var theClone = $(this).clone(false);
			$(".guidev2_spell_fullselector_picker_choices").append(theClone);
			$(this).hide();
			
			theClone.addClass('gv2spelltip');
			theClone.attr('title', spellName);
			AddSpellTooltip('.gv2spelltip');
			$(theClone).removeClass('gv2spelltip');
			
			$(theClone).click(function()
			{
				var mySpell = $(this).data('spell');
				$(".guidev2_spell_fullselector_picker_options").children().each(function()
				{
					var otherSpell = $(this).data('spell');
					if (otherSpell == mySpell)
					{
						$(this).show(0);
					}
				});
				
				$(this).remove();
				SpellPickerNumChoices--;
				var spellText = SpellPickerNumChoices + " / 3";
				$(".guidev2_spell_fullselector_summary").html(spellText);
			});
			
			SpellPickerNumChoices++;
			var spellText = SpellPickerNumChoices + " / 3";
			$(".guidev2_spell_fullselector_summary").html(spellText);
		}
		
		if (SpellPickerNumChoices == 3)
		{
			$(".guidev2_spell_fullselector_accept").slideDown(200);
		}
		else
		{
			$(".guidev2_spell_fullselector_accept").slideUp(200);
		}
	});
		
	$("#guidev2_add_spell").click(function()
	{
		SpellPickerNumChoices = 0;
		$(".guidev2_spell_fullselector").slideDown(500);
	});
	
	$(".guidev2_spell_fullselector_accept").click(function()
	{
		$(this).parent().slideUp(300);
		var self = this;
		setTimeout(function() 
		{
			$(self).parent().parent().hide();
			ClearSpellSelector();
		}, 300);   // you pick the appropriate time here
		
		var children = $(".guidev2_spell_fullselector_picker_choices").children(".guidev2_spell_option");
		if (children.length == 3)
		{
			GuideNumSpellSets++;
			if (GuideNumSpellSets >= 3)
			{
				$("#guidev2_add_spell").slideUp(500);
			}
			
			var spell1 = $(children[0]).data('spell');
			var spell2 = $(children[1]).data('spell');
			var spell3 = $(children[2]).data('spell');
			
			var src = '	<div class="guidev2_spell_left">                 \
							<div class="guidev2_spell_img">				\
								<img src="http://www.moba-champion.com/images/spells/Spell_' + ucfirst(spell1) + '_1.png" title="' + ucfirst(spell1) + '" class="gv2spelltipl">        \
								<img src="http://www.moba-champion.com/images/spells/Spell_' + ucfirst(spell2) + '_1.png" title="' + ucfirst(spell2) + '" class="gv2spelltipl">        \
								<img src="http://www.moba-champion.com/images/spells/Spell_' + ucfirst(spell3) + '_1.png" title="' + ucfirst(spell3) + '" class="gv2spelltipl"></div>  \
								<div class="guidev2_spell_header">' + ucfirst(spell1) + ", " + ucfirst(spell2) + " & " + ucfirst(spell3) + '</div>     \
							</div>                                          \
							<div class="guidev2_spell_right"><textarea class="add_sceditor" data-type="spell"></textarea>		\
								<div class="guidev2_controls_updown"> \
								<div class="guidev2_up" data-type="spell"><i class="icon-chevron-up"></i></div> 			\
								<div class="guidev2_down" data-type="spell"><i class="icon-chevron-down"></i></div></div>		\
							</div>	';
							
			var removeSrc = '<div class="guidev2_remove_button"><i class="icon-remove"></i></div>';
									
			d=document.createElement("div");
			$(d).addClass("guidev2_spell_row")
				.css('display', 'none')
				.data('spell1', spell1)
				.data('spell2', spell2)
				.data('spell3', spell3)
				.html(src)
				.appendTo($(".guidev2_spell_selector"))
				.slideDown(500);
				
			AddSpellTooltip('.gv2spelltipl');
			$(".gv2spelltipl").each(function()
			{
				$(this).removeClass('gv2spelltipl');
			});
					
			d2=document.createElement("div");
			$(d2).addClass("guidev2_spell_removal").html(removeSrc).appendTo($(d))
			.click(function()
			{
				var myDiv = this;
				$('<div></div>').appendTo($(this))
				.html('<div><p>Are you sure you want to remove this spell set?</p></div>')
				.dialog(
				{
				  modal: true, 
				  title: 'Remove Spell Set', 
				  zIndex: 10000, 
				  autoOpen: true,
				  width: 300, 
				  height: 200,
				  resizable: false,
				  dialogClass: 'spell_delete_dialog',
				  closeOnEscapeType: true,
				  buttons: 
				  {
					Yes: function () 
					{
						$(myDiv).parent().remove();
						GuideNumSpellSets--;
						if (GuideNumSpellSets < 3)
						{
							$("#guidev2_add_spell").slideDown(500);
						}
						
						MarkModified('spell');
						$(this).dialog("close");
					},
					No: function () 
					{
						$(this).dialog("close");
					}
				 },
				 close: function (event, ui) 
				 {
					  $(this).remove();
				 }
				});
			});
			
			MarkModified('spell');
			AddSceditor();
			CreateUpDownHandlers();
		}
	});
}

function ClearLoadoutSelector()
{
	$("#guidev2_loadout_name").val('');
	$("#guidev2_loadout_url").val('');
	$(".guidev2_loadout_fullselector_summary").html('');
	$(".guidev2_loadout_fullselector_picker").show(0);
	$(".guidev2_loadout_fullselector_accept").hide(0);
	ItemPickerNumChoices = 0;
	SpellPickerNumChoices = 0;
	CurLoadoutId = 0;
}

function CreateLoadoutHandlers()
{
	$("#guidev2_add_loadout").click(function()
	{
		$(".guidev2_loadout_fullselector").slideDown(500);
	});
	
	$("#guidev2_loadout_name").keydown(function()
	{
		$("#guidev2_loadout_name_err").hide(0);
	});
	
	$("#guidev2_loadout_url").keydown(function()
	{
		$("#guidev2_loadout_import_err").hide(0);
		$(".guidev2_loadout_fullselector_accept").hide(0);
	});
	
	$("#guidev2_loadout_import").click(function()
	{
		var loadoutName = $("#guidev2_loadout_name").val();
		var loadoutUrl = $("#guidev2_loadout_url").val();
		
		var bSaveLoadout = true;
		if (loadoutName.length == 0 && $("#guidev2_loadout_name_err").length == 0)
		{
			var src = '<a href="#" class="close" data-dismiss="alert">&times;</a>Please enter a loadout name.';
			d=document.createElement("div");
			$(d).addClass("guidev2_settings_err")
				.attr('id', 'guidev2_loadout_name_err')
				.css('display', 'none')
				.html(src)
				.appendTo($(".guidev2_loadout_fullselector_input"))
				.show(500);
			bSaveLoadout = false;
		}
		
		if (loadoutUrl.length == 0 && $("#guidev2_loadout_import_err").length == 0)
		{
			var src = '<a href="#" class="close" data-dismiss="alert">&times;</a>Please enter a loadout url.';
			d=document.createElement("div");
			$(d).addClass("guidev2_settings_err")
				.attr('id', 'guidev2_loadout_import_err')
				.css('display', 'none')
				.html(src)
				.appendTo($(".guidev2_loadout_fullselector_import"))
				.show(500);
			bSaveLoadout = false;
		}
		
		if (bSaveLoadout)
		{
			if ((!validateUrl(loadoutUrl) || !strContains(loadoutUrl, "l=")) && $("#guidev2_loadout_import_err").length == 0)
			{
				var src = '<a href="#" class="close" data-dismiss="alert">&times;</a>Loadout URL was invalid.';
				d=document.createElement("div");
				$(d).addClass("guidev2_settings_err")
					.attr('id', 'guidev2_loadout_import_err')
					.css('display', 'none')
					.html(src)
					.appendTo($(".guidev2_loadout_fullselector_import"))
					.show(500);
				bSaveLoadout = false;
			}
		}
				
		if (bSaveLoadout)
		{	
			var n = loadoutUrl.lastIndexOf("l=");
			CurLoadoutId = loadoutUrl.substring(n+2);
			
			$("#guide_loadout_spinner").show(0);
			$(".guidev2_loadout_fullselector_summary").html('');
			
			$.get("actions/getloadout.php",
			{ 
				id : CurLoadoutId,
			},
			function(data) 
			{
				$("#guide_loadout_spinner").hide(0);
				
				if (data == 'invalid')
				{	
					var src = '<a href="#" class="close" data-dismiss="alert">&times;</a>Unknown error importing loadout.';
					d=document.createElement("div");
					$(d).addClass("guidev2_settings_err")
						.attr('id', 'guidev2_loadout_import_err')
						.css('display', 'none')
						.html(src)
						.appendTo($(".guidev2_loadout_fullselector_import"))
						.show(500);
					
					$(".guidev2_loadout_fullselector_accept").hide(0);
				}
				else
				{
					if (data.length > 0)
					{
						var fmtData = replaceAll("-", " ", data);
						fmtData = replaceAll("+", "", fmtData);
						fmtData = replaceAll(" Percent", "%", fmtData);
						var res = fmtData.split(",");
						var fullStr = "";
						for (var ri = 0; ri < res.length; ri++)
						{
							if (startsWith(res[ri], "Z"))
							{
								fullStr += '<div class="guidev2_loadout_fullselector_stat">' + res[ri].substring(2) + '</div>';
							}
							else
							{
								fullStr += '<div class="guidev2_loadout_fullselector_stat">+' + res[ri] + '</div>';
							}
						}
						
						$(".guidev2_loadout_fullselector_accept").show(0);
						
						$(".guidev2_loadout_fullselector_summary").html(fullStr);
					}
				}
			},
			"text");
		}
	});
	
	$(".guidev2_loadout_fullselector_accept").click(function()
	{
		$(this).parent().slideUp(300);
		var self = this;
		setTimeout(function() 
		{
			$(self).parent().parent().hide();
			$(".guidev2_fullselector_picker").show(0);
			ClearLoadoutSelector();
		}, 300);   // you pick the appropriate time here
		
		GuideNumLoadouts++;
		if (GuideNumLoadouts >= 3)
		{
			$("#guidev2_add_loadout").slideUp(500);
		}
		
		var loadoutName = $("#guidev2_loadout_name").val();
		var src = '<div class="guidev2_loadout_right"><textarea class="add_sceditor" data-type="loadout"></textarea>	\
								<div class="guidev2_controls_updown"> \
								<div class="guidev2_up" data-type="loadout"><i class="icon-chevron-up"></i></div> 			\
								<div class="guidev2_down" data-type="loadout"><i class="icon-chevron-down"></i></div></div>		\
						</div>';
						
		var removeSrc = '<div class="guidev2_remove_button guidev2_remove_loadout_button"><i class="icon-remove"></i></div>';
			
			dHeader=document.createElement("div");
			$(dHeader).addClass("guidev2_loadout_left")
				.html('<div class="guidev2_loadout_header">' + loadoutName + '</div>');
				
			d=document.createElement("div");
			$(d).addClass("guidev2_loadout_row")
				.addClass("clrfix")
				.css('display', 'none')
				.data('loadoutid', CurLoadoutId)
				.html(src)
				.appendTo($(".guidev2_loadout_selector"))
				.slideDown(500);
		
			$(".guidev2_loadout_fullselector_stat")
				.clone()
				.removeClass("guidev2_loadout_fullselector_stat")
				.addClass("guidev2_loadout_fullselector_stat2")
				.prependTo($(d));
				
			$(dHeader).prependTo($(d));
			
			d2=document.createElement("div");
			$(d2).addClass("guidev2_loadout_removal").html(removeSrc).appendTo($(d))
			.click(function()
			{
				var myDiv = this;
				$('<div></div>').appendTo($(this))
				.html('<div><p>Are you sure you want to remove this loadout?</p></div>')
				.dialog(
				{
				  modal: true, 
				  title: 'Remove Loadout', 
				  zIndex: 10000, 
				  autoOpen: true,
				  width: 300, 
				  height: 200,
				  resizable: false,
				  dialogClass: 'loadout_delete_dialog',
				  closeOnEscapeType: true,
				  buttons: 
				  {
					Yes: function () 
					{
						$(myDiv).parent().remove();
						GuideNumLoadouts--;
						if (GuideNumLoadouts < 3)
						{
							$("#guidev2_add_loadout").slideDown(500);
						}
						
						$(this).dialog("close");
						MarkModified('loadout');
					},
					No: function () 
					{
						$(this).dialog("close");
					}
				 },
				 close: function (event, ui) 
				 {
					  $(this).remove();
				 }
				});
			});
			
			MarkModified('loadout');
			AddSceditor();
			CreateUpDownHandlers();
	});
}

function CreateSkillOrderHandlers()
{	
	$(".guidev2_skillorder_switch").click(function()
	{
		MarkModified("skillorder");
		if (GuideSkillOrderMode == 0)
		{
			$(".guidev2_skillorder_switch").html("Switch to Basic");
			$(".guidev2_skillorder_basic").hide();
			$(".guidev2_skillorder_advanced").show();
			GuideSkillOrderMode = 1;
		}
		else
		{
			$(".guidev2_skillorder_switch").html("Switch to Advanced");
			$(".guidev2_skillorder_basic").show();
			$(".guidev2_skillorder_advanced").hide();
			GuideSkillOrderMode = 0;
		}
	});
	
	$(".guidev2_skillorder_icons").sortable(
		{
		  items: ".guidev2_skillorder_grid_icon",
		  cursor: "move",
		  stop: function( event, ui ) 
		  {
			MarkModified("skillorder");
		  }
		}
	);
	$(".guidev2_skillorder_icons").disableSelection();
}


function ClearItemSelector()
{
	$(".guidev2_item_fullselector_picker").show(0);
	$("#guidev2_item_setname_val").val('');
	ItemPickerNumChoices = 0;
	SpellPickerNumChoices = 0;
	$(".guidev2_item_fullselector_summary").html("0 / 7");
	$(".guidev2_item_fullselector_picker_choices").children(".guidev2_item_option").each(function()
	{
		$(this).remove();
	});
}

function CreateItemHandlers()
{
	$("#guidev2_add_item").click(function()
	{
		ItemPickerNumChoices = 0;
		$(".guidev2_item_fullselector").slideDown(500);
	});
	
	$(".itemsfilterall").click(function(e)
	{
		$(".guidev2_item_fullselector_picker_options").children().each(function()
		{
			$(this).show(0);
		});
	});
	
	$(".itemsfilterconsumable").click(function(e)
	{
		$(".guidev2_item_fullselector_picker_options").children().each(function()
		{
			var type = $(this).data("type");
			if (type == 1)
			{
				$(this).show(0);
			}
			else
			{
				$(this).hide(0);
			}
		});
	});
	
	$(".itemsfilterbasic").click(function(e)
	{
		$(".guidev2_item_fullselector_picker_options").children().each(function()
		{
			var type = $(this).data("type");
			if (type == 2)
			{
				$(this).show(0);
			}
			else
			{
				$(this).hide(0);
			}
		});
	});
	
	$(".itemsfilteradvanced").click(function(e)
	{
		$(".guidev2_item_fullselector_picker_options").children().each(function()
		{
			var type = $(this).data("type");
			if (type == 3)
			{
				$(this).show(0);
			}
			else
			{
				$(this).hide(0);
			}
		});
	});
	
	$(".itemsfilterlegendary").click(function(e)
	{
		$(".guidev2_item_fullselector_picker_options").children().each(function()
		{
			var type = $(this).data("type");
			if (type == 4)
			{
				$(this).show(0);
			}
			else
			{
				$(this).hide(0);
			}
		});
	});
	
	$(".guidev2_item_option").click(function()
	{ 
		var valid = $(this).data('valid');
		if (valid == true)
		{	
			$(this).remove();
			ItemPickerNumChoices--;
			var spellText = ItemPickerNumChoices + " / 6";
			$(".guidev2_spell_fullselector_summary").html(spellText);
		}
		else
		{
			if (ItemPickerNumChoices < 6)
			{	
				$(this).data('valid', true);
				$(".guidev2_item_fullselector_picker_choices").append($(this).clone(true));
				$(this).data('valid', false);
				ItemPickerNumChoices++;
				var spellText = ItemPickerNumChoices + " / 6";
				$(".guidev2_item_fullselector_summary").html(spellText);
			}
		}
	});
	
	$(".guidev2_item_fullselector_accept").click(function()
	{
		$(this).parent().parent().slideUp(300);
		var self = this;
		setTimeout(function() 
		{
			$(self).parent().parent().parent().hide();
			ClearItemSelector();
		}, 300);   // you pick the appropriate time here
		
		var children = $(".guidev2_item_fullselector_picker_choices").children(".guidev2_item_option");
		if (children.length <= 6)
		{
			GuideNumItems++;
			if (GuideNumItems >= 7)
			{
				$("#guidev2_add_item").slideUp(500);
			}
			
			var item1 = $(children[0]).data('item');
			var item2 = $(children[1]).data('item');
			var item3 = $(children[2]).data('item');
			var item4 = $(children[3]).data('item');
			var item5 = $(children[4]).data('item');
			var item6 = $(children[5]).data('item');

			var setName = $("#guidev2_item_setname_val").val();
			
			var src = '	<div class="guidev2_item_imgs">				\
								<div class="guidev2_item_header">' + setName + '</div>';
								
			if (children.length > 0)
			{
				var img = $(children[0]).data('img');
				src += '<img src="' + img + '" title="' + item1 + '" class="guidev2_add_item_tt">';
			}
			
			if (children.length > 1)
			{
				var img = $(children[1]).data('img');
				src += '<img src="' + img + '" title="' + item2 + '" class="guidev2_add_item_tt">';
			}
			
			if (children.length > 2)
			{
				var img = $(children[2]).data('img');
				src += '<img src="' + img + '" title="' + item3 + '" class="guidev2_add_item_tt">';
			}
			
			if (children.length > 3)
			{
				var img = $(children[3]).data('img');
				src += '<img src="' + img + '" title="' + item4 + '" class="guidev2_add_item_tt">';
			}
			
			if (children.length > 4)
			{
				var img = $(children[4]).data('img');
				src += '<img src="' + img + '" title="' + item5 + '" class="guidev2_add_item_tt">';
			}
			
			if (children.length > 5)
			{
				var img = $(children[5]).data('img');
				src += '<img src="' + img + '" title="' + item6 + '" class="guidev2_add_item_tt">';
			}
			
			src += '</div> 	\
						<div class="guidev2_item_desc">	\
							<textarea class="add_sceditor" data-type="item"></textarea>	\
							<div class="guidev2_controls_updown"> \
								<div class="guidev2_up" data-type="item"><i class="icon-chevron-up"></i></div> 			\
								<div class="guidev2_down" data-type="item"><i class="icon-chevron-down"></i></div>		\
							</div>		\
						</div>';
							
			var removeSrc = '<div class="guidev2_remove_button"><i class="icon-remove"></i></div>';
									
			d=document.createElement("div");
			$(d).addClass("guidev2_item_row")
				.addClass("clrfix")
				.css('display', 'none')
				.data('item1', item1)
				.data('item2', item2)
				.data('item3', item3)
				.data('item4', item4)
				.data('item5', item5)
				.data('item6', item6)
				.html(src)
				.appendTo($(".guidev2_item_selector"))
				.slideDown(500);
		
			d2=document.createElement("div");
			$(d2).addClass("guidev2_item_removal").html(removeSrc).appendTo($(d))
			.click(function()
			{
				var myDiv = this;
				$('<div></div>').appendTo($(this))
				.html('<div><p>Are you sure you want to remove this item set?</p></div>')
				.dialog(
				{
				  modal: true, 
				  title: 'Remove Item Set', 
				  zIndex: 10000, 
				  autoOpen: true,
				  width: 300, 
				  height: 200,
				  resizable: false,
				  dialogClass: 'item_delete_dialog',
				  closeOnEscapeType: true,
				  buttons: 
				  {
					Yes: function () 
					{
						$(myDiv).parent().remove();
						GuideNumItems--;
						if (GuideNumItems < 7)
						{
							$("#guidev2_add_item").slideDown(500);
						}
						
						MarkModified('item');
						$(this).dialog("close");
					},
					No: function () 
					{
						$(this).dialog("close");
					}
				 },
				 close: function (event, ui) 
				 {
					  $(this).remove();
				 }
				});
			});
			
			MarkModified("item");
			AddItemPTooltips(".guidev2_add_item_tt");
			$(".guidev2_add_item_tt").removeClass('guidev2_add_item_tt');
			AddSceditor();
			CreateUpDownHandlers();
		}
	});
}

function CreateTooltips()
{
	$(".guidev2_tt_required").tooltipster();
}

function CreateRichText()
{

}

function CreateDeleteHandlers()
{
	$(".add_loadout_delete_handler").each(function()
	{
		$(this).click(function()
		{
			var myDiv = this;
			$('<div></div>').appendTo($(this))
			.html('<div><p>Are you sure you want to remove this loadout?</p></div>')
			.dialog(
			{
			  modal: true, 
			  title: 'Remove Loadout', 
			  zIndex: 10000, 
			  autoOpen: true,
			  width: 300, 
			  height: 200,
			  resizable: false,
			  dialogClass: 'loadout_delete_dialog',
			  closeOnEscapeType: true,
			  buttons: 
			  {
				Yes: function () 
				{
					console.log(GuideNumLoadouts + " decrimented to " + (GuideNumLoadouts-1));
					$(myDiv).parent().remove();
					GuideNumLoadouts--;
					if (GuideNumLoadouts < 3)
					{
						$("#guidev2_add_loadout").slideDown(500);
					}
					
					$(this).dialog("close");
					MarkModified('loadout');
				},
				No: function () 
				{
					$(this).dialog("close");
				}
			 },
			 close: function (event, ui) 
			 {
				  $(this).remove();
			 }
			});
		});
		$(this).removeClass(".add_loadout_delete_handler");
	});
	
	$(".add_spell_delete_handler").each(function()
	{
		$(this).click(function()
		{
			var myDiv = this;
			$('<div></div>').appendTo($(this))
			.html('<div><p>Are you sure you want to remove this spell set?</p></div>')
			.dialog(
			{
			  modal: true, 
			  title: 'Remove Spell Set', 
			  zIndex: 10000, 
			  autoOpen: true,
			  width: 300, 
			  height: 200,
			  resizable: false,
			  dialogClass: 'spell_delete_dialog',
			  closeOnEscapeType: true,
			  buttons: 
			  {
				Yes: function () 
				{
					$(myDiv).parent().remove();
					GuideNumSpellSets--;
					if (GuideNumSpellSets < 3)
					{
						$("#guidev2_add_spell").slideDown(500);
					}
					
					MarkModified('spell');
					$(this).dialog("close");
				},
				No: function () 
				{
					$(this).dialog("close");
				}
			 },
			 close: function (event, ui) 
			 {
				  $(this).remove();
			 }
			});
		});
		$(this).removeClass(".add_spell_delete_handler");
	});
	
	$(".add_item_delete_handler").each(function()
	{
		$(this).click(function()
		{
			var myDiv = this;
			$('<div></div>').appendTo($(this))
			.html('<div><p>Are you sure you want to remove this item set?</p></div>')
			.dialog(
			{
			  modal: true, 
			  title: 'Remove Item Set', 
			  zIndex: 10000, 
			  autoOpen: true,
			  width: 300, 
			  height: 200,
			  resizable: false,
			  dialogClass: 'item_delete_dialog',
			  closeOnEscapeType: true,
			  buttons: 
			  {
				Yes: function () 
				{
					$(myDiv).parent().remove();
					GuideNumItems--;
					if (GuideNumItems < 7)
					{
						$("#guidev2_add_item").slideDown(500);
					}
					
					MarkModified('item');
					$(this).dialog("close");
				},
				No: function () 
				{
					$(this).dialog("close");
				}
			 },
			 close: function (event, ui) 
			 {
				  $(this).remove();
			 }
			});
		});
		$(this).removeClass(".add_item_delete_handler");
	});
}

function CreateUpDownHandlers()
{
	$(".guidev2_up").not('.handled').each(function()
	{
		$(this).addClass('handled');
		var myType = $(this).data('type');
		$(this).click(function()
			{
				var numChildren = $(this).parent().parent().parent().parent().children().length;
				var index = $(this).parent().parent().parent().index();
				if (index > 0)
				{
					var newIndex = index - 1;
					var myRow = $(this).parent().parent().parent().parent().children().eq(index);
					var swapper = $(this).parent().parent().parent().parent().children().eq(newIndex);
					jQuery(myRow).after(jQuery(swapper));
					MarkModified(myType);
				}
			});
	});
	
	$(".guidev2_down").not('.handled').each(function()
	{
		$(this).addClass('handled');
		var myType = $(this).data('type');
		$(this).click(function()
			{
				var numChildren = $(this).parent().parent().parent().parent().children().length;
				var index = $(this).parent().parent().parent().index();
				if (index < numChildren - 1)
				{
					var newIndex = index + 1;
					var myRow = $(this).parent().parent().parent().parent().children().eq(index);
					var swapper = $(this).parent().parent().parent().parent().children().eq(newIndex);
					jQuery(myRow).before(jQuery(swapper));
					MarkModified(myType);
				}
			});
	});
}

function DisplayModified()
{
	var src = "";
	
	src += (GuideRolesModified) ? 'Roles: modified<BR>' : 'Roles: not modified<BR>';
	src += (GuideSpellModified) ? 'Spells: modified<BR>' : 'Spells: not modified<BR>';
	src += (GuideLoadoutModified) ?  'Loadouts: modified<BR>' : 'Loadouts: not modified<BR>';
	src += (GuideItemModified) ? 'Items: modified<BR>' : 'Items: not modified<BR>';
	src += (GuideSkillModified) ? 'Skills: modified<BR>' : 'Skills: not modified<BR>';
	src += (GuideAbilityUpdated) ? 'Abilities: modified<BR>' : 'Abilities: not modified<BR>';
	
	$("#guidev2_debug_area").html(src);
}

function ClearModified()
{
	GuideRolesModified = false;
	GuideSpellModified = false;
	GuideLoadoutModified = false;
	GuideItemModified = false;
	GuideSkillModified = false;
	GuideAbilityUpdated = false;
	DisplayModified();
}

function MarkModified(type)
{
	if (type == 'role')
	{
		GuideRolesModified = true;
	}
	else if (type == 'loadout')
	{
		GuideLoadoutModified = true;
	}
	else if (type == 'spell')
	{
		GuideSpellModified = true;
	}
	else if (type == 'item')
	{
		GuideItemModified = true;
	}
	else if (type == 'skillorder')
	{
		GuideSkillModified = true;
	}
	else if (type == 'ability')
	{
		GuideAbilityUpdated = true;
	}
	
	DisplayModified();
}


function AddSceditorInternal(me)
{
	var myType = me.data('type');
	me.sceditor({
		plugins: "bbcode",
		style: "http://www.moba-champion.com/guides/development/jquery.sceditor.default.css",
		toolbar: "bold,italic,underline|left,center,right|bulletlist,orderedlist|image,link,youtube|source",
		emoticonsEnabled: false,
		width: "100%",
		height: 200,
		resizeWidth: false
		});
	me.addClass('handled');
	me.sceditor('instance').keyDown(function(e)
	{
		MarkModified(myType);
	});
}

function AddSceditor()
{
	$(".add_sceditor").not('handled').each(function()
	{
		var $me = $(this);
		AddSceditorInternal($me);
	});
}

function CreateSceditors()
{
	$("textarea").not('.handled').each(function()
	{
		var $me = $(this);
		AddSceditorInternal($me);
	});
}

function StrExport(str)
{
	if (str == null)
	{
		return "";
	}
	
	return str;
}

function RoleSave(el)
{
	var area = $(el).find('.guidev2_role_area');
	var numRoles = area.children(':visible').length;
	console.log(numRoles + ' roles');
	
	if (numRoles == 0)
	{
		$(".guidev2_save_errors").append('<p class="guidev2_save_warn">Please select at least one role.</p>');
	}
	else
	{
		if (numRoles > 4) numRoles = 4;
		var roleNames = new Array();
		var roleDescs = new Array();
		
		for (var i = 0; i < 4; i++)
		{
			roleNames[i] = "";
			roleDescs[i] = "";
		}
		
		for (var i = 0; i < numRoles; i++)
		{ 
			var row = area.children(':visible')[i];
			var editor = $(row).find('textarea');
			var body = editor.sceditor('instance').val();
			
			roleNames[i] = $(row).data('role');
			roleDescs[i] = body;
		}
		
		PendingSaves++;
		
		$.post("actions/saverole.php",
		{ 
			roleid : GuideRoleId,
			guideid : GuideId,
			role1 : StrExport(roleNames[0]),
			role1desc : StrExport(roleDescs[0]),
			role2 : StrExport(roleNames[1]),
			role2desc : StrExport(roleDescs[1]),
			role3 : StrExport(roleNames[2]),
			role3desc : StrExport(roleDescs[2]),
			role4 : StrExport(roleNames[3]),
			role4desc : StrExport(roleDescs[3])
		},
		function(data) 
		{
			PendingSaves--;
			console.log(data);
			
			var results = jQuery.parseJSON(data)
			if (results.id > 0)
			{
				GuideRoleId = results.id;
				$(".guidev2_save_errors").append('<p class="guidev2_save_success">' + results.message + "</p>");
			}
			else
			{
				$(".guidev2_save_errors").append('<p class="guidev2_save_fail">' + results.message + "</p>");
			}
		
			GuideRolesModified = false;
			DisplayModified();
			SaveOverallGuideCB(false);
		})
		.error(function() 
		{ 
			$(".guidev2_save_errors").append('<p class="guidev2_save_fail">Error saving Roles.</p>');
			PendingSaves--;
			SaveOverallGuideCB(false);
		});

	}
}

function LoadoutSave(el)
{
	var area = $(el).find('.guidev2_loadout_selector');
	var numLoadouts = area.children(':visible').length;
	console.log(numLoadouts + ' loadouts');
	
	if (numLoadouts == 0)
	{
		$(".guidev2_save_errors").append('<p class="guidev2_save_warn">Please select at least one loadout.</p>');
	}
	else
	{
		if (numLoadouts > 3) numLoadouts = 3;
		var loadoutNames = new Array();
		var loadoutIds = new Array();
		var loadoutDescs = new Array();
		
		for (var i = 0; i < 3; i++)
		{
			loadoutNames[i] = "";
			loadoutIds[i] 	= "";
			loadoutDescs[i] = "";
		}
		
		for (var i = 0; i < numLoadouts; i++)
		{ 
			var row = area.children(':visible')[i];
			var editor = $(row).find('textarea');
			
			var loadoutDesc = editor.sceditor('instance').val();
			var loadoutId = $(row).data('loadoutid');
			var loadoutName = $(row).find('.guidev2_loadout_header').html();
			
			loadoutNames[i] = loadoutName;
			loadoutIds[i] 	= loadoutId;
			loadoutDescs[i] = loadoutDesc;
		}
		
		PendingSaves++;
		
		$.post("actions/saveloadout.php",
		{
			loadoutid : GuideLoadoutId,
			guideid : GuideId,
			loadoutNames1 	: StrExport(loadoutNames[0]),
			loadoutIds1		: StrExport(loadoutIds[0]),
			loadoutDescs1	: StrExport(loadoutDescs[0]),
			loadoutNames2 	: StrExport(loadoutNames[1]),
			loadoutIds2		: StrExport(loadoutIds[1]),
			loadoutDescs2	: StrExport(loadoutDescs[1]),	
			loadoutNames3 	: StrExport(loadoutNames[2]),
			loadoutIds3		: StrExport(loadoutIds[2]),
			loadoutDescs3	: StrExport(loadoutDescs[2])
		},
		function(data) 
		{
			PendingSaves--;
			console.log(data);
			
			var results = jQuery.parseJSON(data)
			if (results.id > 0)
			{
				GuideLoadoutId = results.id;
				$(".guidev2_save_errors").append('<p class="guidev2_save_success">' + results.message + "</p>");
			}
			else
			{
				$(".guidev2_save_errors").append('<p class="guidev2_save_fail">' + results.message + "</p>");
			}
		
			GuideLoadoutModified = false;
			DisplayModified();
			SaveOverallGuideCB(false);
		})
		.error(function() 
		{ 
			$(".guidev2_save_errors").append('<p class="guidev2_save_fail">Error saving loadouts.</p>');
			PendingSaves--;
			SaveOverallGuideCB(false);
		});

	}
}

function SpellSave(el)
{
	var area = $(el).find('.guidev2_spell_selector');
	var numSpells = area.children(':visible').length;
	console.log(numSpells + ' spells');
	
	if (numSpells == 0)
	{
		$(".guidev2_save_errors").append('<p class="guidev2_save_warn">Please select at least one spell set.</p>');
	}
	else
	{
		if (numSpells > 3) numSpells = 3;
		var spellNames = new Array();
		var spellDescs = new Array();
		
		for (var i = 0; i < 3; i++)
		{ 
			spellNames[i] = "";
		}   spellDescs[i] = "";
		
		for (var i = 0; i < numSpells; i++)
		{ 
			var row = area.children(':visible')[i];
			var editor = $(row).find('textarea');
			
			var spellDesc = editor.sceditor('instance').val();
			var spell1 = $(row).data('spell1');
			var spell2 = $(row).data('spell2');
			var spell3 = $(row).data('spell3');
			var spellSet = spell1 + "," + spell2 + "," + spell3;
						
			spellNames[i] = spellSet;
			spellDescs[i] = spellDesc;
		}
		
		PendingSaves++;
		
		$.post("actions/savespell.php",
		{
			spellid : GuideSpellId,
			guideid : GuideId,
			spellNames1 	: StrExport(spellNames[0]),
			spellDescs1		: StrExport(spellDescs[0]),
			spellNames2 	: StrExport(spellNames[1]),
			spellDescs2		: StrExport(spellDescs[1]),
			spellNames3 	: StrExport(spellNames[2]),
			spellDescs3		: StrExport(spellDescs[2]),
		},
		function(data) 
		{
			PendingSaves--;
			console.log(data);
			
			var results = jQuery.parseJSON(data)
			if (results.id > 0)
			{
				GuideSpellId = results.id;
				$(".guidev2_save_errors").append('<p class="guidev2_save_success">' + results.message + "</p>");
			}
			else
			{
				$(".guidev2_save_errors").append('<p class="guidev2_save_fail">' + results.message + "</p>");
			}
		
			GuideSpellModified = false;
			DisplayModified();
			SaveOverallGuideCB(false);
		})
		.error(function() 
		{ 
			$(".guidev2_save_errors").append('<p class="guidev2_save_fail">Error saving spells.</p>');
			PendingSaves--;
			SaveOverallGuideCB(false);
		});
	}
}

function ItemSave(el)
{
	var area = $(el).find('.guidev2_item_selector');
	var numItems = area.children(':visible').length;
	console.log(numItems + ' spells');
	
	if (numItems == 0)
	{
		$(".guidev2_save_errors").append('<p class="guidev2_save_warn">Please select at least one item set.</p>');
	}
	else
	{
		if (numItems > 7) numItems = 7;
		
		var itemName = new Array();
		var itemSets = new Array();
		var itemDesc = new Array();
		
		for (var i = 0; i < 7; i++)
		{ 
			itemName[i] = "";
			itemSets[i] = "";
			itemDesc[i] = "";
		}
		
		for (var i = 0; i < numItems; i++)
		{ 
			var row = area.children(':visible')[i];
			var editor = $(row).find('textarea');
			var name = $(row).find('.guidev2_item_header').html();
			
			var desc = editor.sceditor('instance').val();
			var item1 = $(row).data('item1');
			var item2 = $(row).data('item2');
			var item3 = $(row).data('item3');
			var item4 = $(row).data('item4');
			var item5 = $(row).data('item5');
			var item6 = $(row).data('item6');
			var itemSet = item1 + "," + item2 + "," + item3 + "," + item4 + "," + item5 + "," + item6;
						
			itemName[i] = name;
			itemSets[i] = itemSet;
			itemDesc[i] = desc;
		}
		
		PendingSaves++;
		
		$.post("actions/saveitemdebug.php",
		{
			itemid : GuideItemId,
			guideid : GuideId,
			itemName1 : StrExport(itemName[0]),
			itemDesc1 : StrExport(itemDesc[0]),
			itemSets1 : StrExport(itemSets[0]),
			itemName2 : StrExport(itemName[1]),
			itemDesc2 : StrExport(itemDesc[1]),
			itemSets2 : StrExport(itemSets[1]),
			itemName3 : StrExport(itemName[2]),
			itemDesc3 : StrExport(itemDesc[2]),
			itemSets3 : StrExport(itemSets[2]),
			itemName4 : StrExport(itemName[3]),
			itemDesc4 : StrExport(itemDesc[3]),
			itemSets4 : StrExport(itemSets[3]),
			itemName5 : StrExport(itemName[4]),
			itemDesc5 : StrExport(itemDesc[4]),
			itemSets5 : StrExport(itemSets[4]),
			itemName6 : StrExport(itemName[5]),
			itemDesc6 : StrExport(itemDesc[5]),
			itemSets6 : StrExport(itemSets[5]),
			itemName7 : StrExport(itemName[6]),
			itemDesc7 : StrExport(itemDesc[6]),
			itemSets7 : StrExport(itemSets[6])
		},
		function(data) 
		{
			PendingSaves--;
			console.log(data);
			
			var results = jQuery.parseJSON(data)
			if (results.id > 0)
			{
				GuideItemId = results.id;
				$(".guidev2_save_errors").append('<p class="guidev2_save_success">' + results.message + "</p>");
			}
			else
			{
				$(".guidev2_save_errors").append('<p class="guidev2_save_fail">' + results.message + "</p>");
			}
		
			GuideItemModified = false;
			DisplayModified();
			SaveOverallGuideCB(false);
		})
		.error(function() 
		{ 
			$(".guidev2_save_errors").append('<p class="guidev2_save_fail">Error saving items.</p>');
			PendingSaves--;
			SaveOverallGuideCB(false);
		});
	}
}

function SkillOrderSave(el)
{
	var basicDiv = $(el).find(".guidev2_skillorder_basic");
	var isBasicVisible = basicDiv.is(":visible");
	var skillChoice = 0;
	if (!isBasicVisible)
	{
		skillChoice = 1;
	}
				
	var basic = $(el).find('.guidev2_skillorder_icons');	
	var basicOrder = "";
	basicOrder += $(basic.children('.guidev2_skillorder_grid_icon')[0]).data('skill');
	basicOrder += $(basic.children('.guidev2_skillorder_grid_icon')[1]).data('skill');
	basicOrder += $(basic.children('.guidev2_skillorder_grid_icon')[2]).data('skill');
	basicOrder += $(basic.children('.guidev2_skillorder_grid_icon')[3]).data('skill');
	
	var editor = $(el).find('textarea');	
	var desc = editor.sceditor('instance').val();
	
	if (basicOrder.length != 4)
	{
		$(".guidev2_save_errors").append('<p class="guidev2_save_warn">Unknown skill order error.</p>');
	}
	else
	{	
		PendingSaves++;
		
		$.post("actions/saveskillorder.php",
		{
			skillorder : GuideSkillOrder,
			guideid : GuideId,
			basic : StrExport(basicOrder),
			adv : StrExport(pointAllocation),
			choice : StrExport(skillChoice),
			desc : StrExport(desc)
		},
		function(data) 
		{
			PendingSaves--;
			console.log(data);
			
			var results = jQuery.parseJSON(data)
			if (results.id > 0)
			{
				GuideSkillOrder = results.id;
				$(".guidev2_save_errors").append('<p class="guidev2_save_success">' + results.message + "</p>");
			}
			else
			{
				$(".guidev2_save_errors").append('<p class="guidev2_save_fail">' + results.message + "</p>");
			}
		
			GuideSkillModified = false;
			DisplayModified();
			SaveOverallGuideCB(false);
		})
		.error(function() 
		{ 
			$(".guidev2_save_errors").append('<p class="guidev2_save_fail">Error saving skill order.</p>');
			PendingSaves--;
			SaveOverallGuideCB(false);
		});
	}
}

function SaveAbilities(el)
{
	var area = $(el).find('.guidev2_section_content');
	var numAbilities = area.children(':visible').length;
		
	if (numAbilities != 5)
	{
		$(".guidev2_save_errors").append('<p class="guidev2_save_warn">Unknown ability descriptions error.</p>');
	}
	else
	{	
		var descp = $(area.children(':visible')[0]).find('textarea').sceditor('instance').val();
		var descq = $(area.children(':visible')[1]).find('textarea').sceditor('instance').val();
		var descw = $(area.children(':visible')[2]).find('textarea').sceditor('instance').val();
		var desce = $(area.children(':visible')[3]).find('textarea').sceditor('instance').val();
		var descr = $(area.children(':visible')[4]).find('textarea').sceditor('instance').val();
			
		PendingSaves++;
		
		$.post("actions/saveabilities.php",
		{
			skillorder : GuideAbilities,
			guideid : GuideId,
			descp : StrExport(descp),
			descq : StrExport(descq),
			descw : StrExport(descw),
			desce : StrExport(desce),
			descr : StrExport(descr)
		},
		function(data) 
		{
			PendingSaves--;
			console.log(data);
			
			var results = jQuery.parseJSON(data)
			if (results.id > 0)
			{
				GuideAbilities = results.id;
				$(".guidev2_save_errors").append('<p class="guidev2_save_success">' + results.message + "</p>");
			}
			else
			{
				$(".guidev2_save_errors").append('<p class="guidev2_save_fail">' + results.message + "</p>");
			}
		
			GuideAbilityUpdated = false;
			DisplayModified();
			SaveOverallGuideCB(false);
		})
		.error(function() 
		{ 
			$(".guidev2_save_errors").append('<p class="guidev2_save_fail">Error saving ability descriptions.</p>');
			PendingSaves--;
			SaveOverallGuideCB(false);
		});
	}
}

function SaveOverallGuideCB(bCloseSettings)
{
	if (PendingSaves == 0)
	{
		SaveOverallGuide(bCloseSettings);
	}
}

function SaveGuide(bCloseSettings)
{
	if (PendingSaves == 0 && !SaveInProgress && ValidateSettings())
	{				
		$(".guidev2_save_errors").html("");
		$(".guide_settings_spinner").show(0);
		
		$(".guidev2_content").each(function()
		{
			var type = $(this).data('contenttype');
			if (type == 1 && GuideRolesModified)
			{
				RoleSave(this);
			}
			else if (type == 2 && GuideLoadoutModified)
			{
				LoadoutSave(this);
			}
			else if (type == 3 && GuideSpellModified)
			{
				SpellSave(this);
			}
			else if (type == 4 && GuideItemModified)
			{
				ItemSave(this);
			}
			else if (type == 5 && GuideSkillModified)
			{
				SkillOrderSave(this);
			}
			else if (type == 6 && GuideAbilityUpdated)
			{
				SaveAbilities(this);
			}
		});
		
		SaveOverallGuideCB();
	}
}


function SaveOverallGuide(bCloseSettings)
{
	SaveInProgress = true;
	
	var GuidePrivacy = $("#guidev2_options_privacy").val();
	$.post("actions/updateguide.php",
	{ 
		id : GuideId,
		title : GuideTitle,
		ign : GuideIgn,
		shaper : GuideShaper,
		privacy : GuidePrivacy,
		roles : GuideRoleId,
		loadouts : GuideLoadoutId,
		spells : GuideSpellId,
		items : GuideItemId,
		skillorder : GuideSkillOrder,
		abilities : GuideAbilities
	},
	function(data) 
	{
		console.log(data);
		SaveInProgress = false; 
		$(".guide_settings_spinner").hide(0);
		
		var results = jQuery.parseJSON(data)
		if (results.id > 0)
		{
			$("#guidev2_header_title_text").html(GuideTitle);
			
			var newGuideHeader = GetGuideHeader();
			UpdateShaper(true);
			GuideId = results.id;
			CloseSettings();
			StartEdit();
			
			if (GuideHeader != newGuideHeader)
			{
				GuideHeader = newGuideHeader;
				UpdateHeader();
				LoadHeader(500);
				LoadRequiredSections();
			}
			else
			{
				if (GuideId == -1)
				{
					LoadHeader(500);
					LoadRequiredSections();
				}
			}
			
			$(".guidev2_save_errors").append('<p class="guidev2_save_success">' + results.message + "</p>");
		}
		else
		{
			$(".guidev2_save_errors").append('<p class="guidev2_save_fail">' + results.message + "</p>");
		}
	})
    .error(function() 
	{ 
		alert("Error saving guide.");
		SaveInProgress = false; 
		$(".guide_settings_spinner").hide(0);
	});
}

$(document).ready(function() 
{
	CreateClickHandlers();
	CreateChangeHandlers();
	CreateRoleHandlers();
	CreateSpellHandlers();	
	CreateLoadoutHandlers();
	CreateSkillOrderHandlers();
	CreateItemHandlers();
	CreateTooltips();
	CreateRichText();
	
	if (GuideId >= 1)
	{
		// settings
		GuideType = 1;
		$(".guidev2_settings_ign_val").val(GuideIgn);
		$(".guidev2_settings_title_val").val(GuideTitle);
		$(".guidev2_settings_shaper_val").val(GuideShaper);
	
		CloseSelector(0);
		CloseSettings(0);
		StartEdit();
		UpdateHeader();
		LoadHeader(0);
		LoadRequiredSections();
		UpdateShaper(false);
		CreateUpDownHandlers();
		CreateDeleteHandlers();
	}
	else
	{
		
	}
	
	MarkModified('none');
});