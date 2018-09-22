// Overall type and saving
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
var GuideCustomModified = true;
var GuideIntroModified = true;
var GuideCustomIds = "";

var TextProgress = 0;
var TextLimit = 0;

var PendingSaves = 0;
var PendingCustoms = 0;

var SortingInProgress = false;

String.prototype.replaceAll = function(search, replace)
{
    //if replace is null, return original string otherwise it will
    //replace search string with 'undefined'.
    if(!replace) 
        return this;

    return this.replace(new RegExp('[' + search + ']', 'g'), replace);
};
    
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

function ShowRequiredSections()
{
	if (GuideType == 1)
	{
		$("#guidev2_roles").show();
		$("#guidev2_loadouts").show();
		$("#guidev2_spells").show();
		$("#guidev2_items").show();
		$("#guidev2_skillorder").show();
		$("#guidev2_abilities").show();
		$("#guidev2_publish2").show();
		$("#guidev2_publishquick").show();
	}
	else
	{
		$("#guidev2_roles").hide();
		$("#guidev2_loadouts").hide();
		$("#guidev2_spells").hide();
		$("#guidev2_items").hide();
		$("#guidev2_skillorder").hide();
		$("#guidev2_abilities").hide();
		$("#guidev2_publish2").hide();
		$("#guidev2_publishquick").hide();
	}
	
	$("#guidev2_publish").show();
	$("#guidev2_help").show();
	$("#guidev2_introduction").show();
}

function LoadRequiredSections()
{
	ShowRequiredSections();
	//LoadQuickGuide();
	CreateAddSectionButton($("#guidev2_debug"));
}

function CreateAddSectionButton(afterElem)
{
	var src = '<div class="guidev2_add_section_left"><i class="fa fa-plus"></i></div><div class="guidev2_add_section_right">Add Section</div>';
	d=document.createElement("div");
	$(d).addClass("guidev2_add_section")
		.css('display', 'none')
		.html(src)
		.insertBefore(afterElem)
		.show(500)
		.click(function()
		{
			if (GuideNumCustomSections < 10)
			{
				GuideNumCustomSections++;
				CreateCustomSection(this);
				MarkModified('custom');
			}
			
			if (GuideNumCustomSections == 10)
			{
				$(this).hide();
			}
		});
		
	if (GuideNumCustomSections == 10)
	{
		$(d).hide();
	}
}

function CreateCustomSection(afterElem)
{
	var src = '<div class="guidev2_section_header clrfix custom_add_removal">                                   \
						<div class="guidev2_section_header_text"><input/></div>                                 \
					</div>                                                                                      \
					<div class="guidev2_section_content clrfix" style="padding-right: 16px;">					\
							<div class="guideinput" data-type="custom"></div>       							\
						</div>';
				
	d=document.createElement("div");
	$(d).addClass("guidev2_section")
		.addClass("guidev2_content")
		.addClass("guidev2_custom_section")
		.data('contenttype', 7)
		.html(src)
		.appendTo(".guidev2_custom_area")
		.show(500);
	
	var deleteSrc = '<i class="fa fa-minus"></i>';
	d2 = document.createElement("div");
	$(d2).addClass("guidev2_section_header_icon")
		.addClass("section_delete")
		.html(deleteSrc)
		.appendTo(".custom_add_removal")
		.click(function()
		{
			var myDiv = this;
			$('<div></div>').appendTo($(this))
			.html('<div><p>Are you sure you want to remove this custom section?</p></div>')
			.dialog(
			{
			  modal: true, 
			  title: 'Remove Custom Section', 
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
					$(myDiv).parent().parent().remove();
					GuideNumCustomSections--;
					if (GuideNumCustomSections < 10)
					{
						$(".guidev2_add_section").slideDown(500);
					}
					
					MarkModified('custom');
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
	
	$(".custom_add_removal").find("input").keydown(function()
	{
		GuideCustomModified = true;
	});
	
	$(".custom_add_removal").removeClass("custom_add_removal");
	InitialBBCodeParsing();
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
	
	$.post("http://www.moba-champion.com/guides/actions/newguide.php",
	{ 
		id : GuideId,
		title : GuideTitle,
		ign : GuideIgn,
		shaper : GuideShaper
	},
	function(data) 
	{	
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
				history.pushState({"id":100}, document.title, "http://www.moba-champion.com/guides/editor/" + GuideId);
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

function SaveSettings(save)
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
			if (save == true)
			{
				SaveGuide(true);
			}
			else
			{
				UpdateGuideHeader(GuideId);
			}
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
	
	$(".custom_add_removal").find("input").keydown(function()
	{
		GuideCustomModified = true;
	});
	$(".custom_add_removal").removeClass("custom_add_removal");
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
		GuideType = 2;
		CloseSelector(500);
		OpenSettings(false, 500);
		$("#master_guide_title").html('Team Guide Editor');
	});
	
	$("#guidev2_selector_general").click(function()
	{
		GuideType = 3;
		CloseSelector(500);
		OpenSettings(false, 500);
		$("#master_guide_title").html('General Guide Editor');
	});
	
	$("#guidev2_start").click(function()
	{
		if (GuideId == -1)
		{
			SaveSettings(true);
		}
		else
		{
			SaveSettings(false);
		}
		
		LoadRequiredSections();
	});
	
	$(".guidev2_publish_btn").click(function()
	{
		SaveGuide(false);
	});
	
	$(".guidev2_fullselector_close").click(function()
	{
		if ($(this).hasClass('close_editor'))
		{
			$(".textresult").each(function()
			{
				var val = TextEditor.sceditor('instance').val();
				$(this).data('content', val);
				if (val.length == 0)
				{
					$(this).html("Click here to start adding text.");
				}
				else
				{
					$(this).html(ParseEditorText(val));
				}
				$(this).removeClass('textresult');
			});
		}
		
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
			$(".guidev2_role_row2").each(function()
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
									<div class="guidev2_role_header">' + ucfirst(roleType) + '</div>     \																	\
								</div>                                          \
								<div class="guidev2_role_right">				\
								<div class="guideinput guideroleinput" data-type="role" data-limit=15000 data-title="' + ucfirst(roleType) + '" data-content=""></div> \
								</div>';
								
				d=document.createElement("div");
				$(d).addClass("guidev2_role_row2")
					.css('display', 'none')
					.data('role', roleType)
					.html(src)
					.appendTo($(".guidev2_role_area"))
					.show(0);
					
				AddRoleTooltips(".gv2roleroletip");
				$(".gv2roleroletip").removeClass("gv2roleroletip");
				
				// checkbox handlers
				$(".addrolecb").change(function() 
				{
					$(".role_quickpick_val").not(this).attr('checked', false);
					MarkModified('role');
				})
				.removeClass('.addrolecb');
				
				InitialBBCodeParsing();
			}
			
			$(this).addClass("guidev2_role_row_active");
		}
		else
		{
			$(".guidev2_role_row2").each(function()
			{
				if ($(this).data('role') == roleType)
				{
					$(this).hide(0);
				}
			});
			
			$(this).removeClass("guidev2_role_row_active");
		}
	});
	
	// checkbox handlers
	$(".addrolecb").change(function() 
	{
		$(".role_quickpick_val").not(this).attr('checked', false);
		MarkModified('role');
	})
	.removeClass('.addrolecb');
}

function ClearSpellSelector()
{
	$(".guidev2_spell_fullselector_picker").show(0);
	$(".guidev2_spell_fullselector_accept").hide(0);
	SpellPickerNumChoices = 0;
	$(".guidev2_spell_fullselector_summary").html("0 / 3");
	$(".guidev2_spell_fullselector_picker_choices").children(".guidev2_spell_option").each(function()
	{
		$(this).remove();
	});
	
	$(".guidev2_spell_fullselector_picker_options").children(".guidev2_spell_option").each(function()
	{
		$(this).show();
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
				
				if (SpellPickerNumChoices == 3)
				{
					$(".guidev2_spell_fullselector_accept").slideDown(200);
				}
				else
				{
					$(".guidev2_spell_fullselector_accept").slideUp(200);
				}
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
							<div class="guidev2_spell_quickpick">                                                                                       \
								<input type="checkbox" class="spell_quickpick_val addspellcb">Quick Guide   											\
							</div>                                                                                                                      \
							</div>                                          \
							<div class="guidev2_spell_right"><textarea class="add_sceditor" data-type="spell"></textarea>		\
								<div class="guidev2_controls_updown"> \
								<div class="guidev2_up" data-type="spell"><i class="fa fa-chevron-up"></i></div> 			\
								<div class="guidev2_down" data-type="spell"><i class="fa fa-chevron-down"></i></div></div>		\
							</div>	';
							
			var removeSrc = '<div class="guidev2_remove_button"><i class="fa fa-times"></i></div>';
									
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
			CreateUpDownHandlers();
			
			// checkbox handlers
			$(".addspellcb").change(function() 
			{
				$(".spell_quickpick_val").not(this).attr('checked', false);
				MarkModified('spell');
			})
			.removeClass('.addspellcb');
		}
	});
	
	// checkbox handlers
	$(".addspellcb").change(function() 
	{
		$(".spell_quickpick_val").not(this).attr('checked', false);
		MarkModified('spell');
	})
	.removeClass('.addspellcb');
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
			if ((!validateUrl(loadoutUrl) || !strContains(loadoutUrl, "/loadouts/")) && $("#guidev2_loadout_import_err").length == 0)
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
			var n = loadoutUrl.lastIndexOf("/loadouts/");
			CurLoadoutId = loadoutUrl.substring(n+10);
			
			$("#guide_loadout_spinner").show(0);
			$(".guidev2_loadout_fullselector_summary").html('');
			
			$.get("http://www.moba-champion.com/guides/actions/getloadout.php",
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
		var src = '<div class="guidev2_loadout_right">	\
					<div class="guideinput guideloadoutinput" data-type="loadout" data-limit=10000 data-title="' + loadoutName + '"  data-content=""></div></div>';
						
		var removeSrc = '<div class="guidev2_remove_button guidev2_remove_loadout_button"><i class="fa fa-times"></i></div>';
						
			dHeader=document.createElement("div");
			$(dHeader).addClass("guidev2_loadout_left")
				.html('<div class="guidev2_loadout_header">' + loadoutName + '</div>');
				
			d=document.createElement("div");
			$(d).addClass("guidev2_loadout_row")
				.addClass("guidev2_loadout_row")
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
			$(d2).addClass("guidev2_remove_loadout_button2").html(removeSrc).appendTo($(d))
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
						$(myDiv).parent().parent().remove();
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
			InitialBBCodeParsing();
			
			// checkbox handlers
			$(".addloadoutcb").change(function() 
			{
				$(".loadout_quickpick_val").not(this).attr('checked', false);
				MarkModified('loadout');
			})
			.removeClass('.addloadoutcb');
	});
	
	// checkbox handlers
	$(".addloadoutcb").change(function() 
	{
		$(".loadout_quickpick_val").not(this).attr('checked', false);
		MarkModified('loadout');
	})
	.removeClass('.addloadoutcb');
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
	$(".guidev2_item_fullselector_summary").html("0 / 10");
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
			if (GuideNumItems >= 10)
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
								<div class="guidev2_up" data-type="item"><i class="fa fa-chevron-up"></i></div> 			\
								<div class="guidev2_down" data-type="item"><i class="fa fa-chevron-down"></i></div>		\
							</div>		\
						</div>';
							
			var removeSrc = '<div class="guidev2_remove_button"><i class="fa fa-times"></i></div>';
									
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
						if (GuideNumItems < 10)
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
			
			var quickpickSrc = '<input type="checkbox" class="item_quickpick_val additemcb">Quick Guide';
			dv3=document.createElement("div");
			$(dv3).addClass("guidev2_item_quickpick").html(quickpickSrc).appendTo($(d));
			
			MarkModified("item");
			AddItemPTooltips(".guidev2_add_item_tt");
			$(".guidev2_add_item_tt").removeClass('guidev2_add_item_tt');
			CreateUpDownHandlers();
			
			// checkbox handlers
			$(".additemcb").change(function() 
			{
				$(".item_quickpick_val").not(this).attr('checked', false);
				MarkModified('item');
			})
			.removeClass('.additemcb');
		}
	});
	
	// checkbox handlers
	$(".additemcb").change(function() 
	{
		$(".item_quickpick_val").not(this).attr('checked', false);
		MarkModified('item');
	})
	.removeClass('.additemcb');
}

function CreateTooltips()
{
	$(".guidev2_tt_required").tooltipster();
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
					$(myDiv).parent().parent().remove();
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
					if (GuideNumItems < 10)
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
	
	$(".add_custom_delete_handler").each(function()
	{
		$(this).click(function()
		{
			var myDiv = this;
			$('<div></div>').appendTo($(this))
			.html('<div><p>Are you sure you want to remove this custom section?</p></div>')
			.dialog(
			{
			  modal: true, 
			  title: 'Remove Custom Section', 
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
					$(myDiv).parent().parent().remove();
					GuideNumCustomSections--;
					if (GuideNumCustomSections < 10)
					{
						$(".guidev2_add_section").slideDown(500);
					}
					
					MarkModified('custom');
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
	
	src += (GuideIntroModified) ? 'Introduction: modified<br>' : 'Introduction: not modified<BR>';
	src += (GuideRolesModified) ? 'Roles: modified<BR>' : 'Roles: not modified<BR>';
	src += (GuideSpellModified) ? 'Spells: modified<BR>' : 'Spells: not modified<BR>';
	src += (GuideLoadoutModified) ?  'Loadouts: modified<BR>' : 'Loadouts: not modified<BR>';
	src += (GuideItemModified) ? 'Items: modified<BR>' : 'Items: not modified<BR>';
	src += (GuideSkillModified) ? 'Skills: modified<BR>' : 'Skills: not modified<BR>';
	src += (GuideAbilityUpdated) ? 'Abilities: modified<BR>' : 'Abilities: not modified<BR>';
	src += (GuideCustomModified) ? 'Custom sections: modified<BR>' : 'Custom sections: not modified<BR>';
	
	$("#guidev2_debug_area").html(src);
}

function ClearModified()
{
	GuideIntroModified = false;
	GuideRolesModified = false;
	GuideSpellModified = false;
	GuideLoadoutModified = false;
	GuideItemModified = false;
	GuideSkillModified = false;
	GuideAbilityUpdated = false;
	GuideCustomModified = false;
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
	else if (type == 'custom')
	{
		GuideCustomModified = true;
	}
	else if (type == 'intro')
	{
		GuideIntroModified = true;
	}
	
	DisplayModified();
}

function UpdateTextProgress(progress)
{
	TextProgress = progress;
	var progressTxt = TextProgress + " / " + TextLimit;
	$(".guidev2_texteditor_progress").html(progressTxt);
}

var TextEditor;
function CreateEditor()
{
	TextEditor = $("#guidev2_texteditor_text");
	TextEditor.sceditor(
	{
		plugins: "bbcode",
		style: "http://www.moba-champion.com/guides/development/jquery.sceditor.default.css",
		toolbar: "bold,italic,underline|left,center,right|bulletlist,orderedlist|image,link,youtube|source",
		emoticonsEnabled: false,
		width: "100%",
		height: 350,
		resizeWidth: false,
		resizeHeight: false,
	});
	TextEditor.addClass('handled');
	TextEditor.sceditor('instance').keyUp(function(e)
	{
		var val = TextEditor.sceditor('instance').val();
		var len = val.length;
		UpdateTextProgress(len);
	});
}

function ShowEditor(newTitle, limit, content)
{
	$(".guidev2_texteditor").show();
	$(".guidev2_texteditor_title").html(newTitle);
	TextProgress = 0;
	TextLimit = limit;
	TextEditor.sceditor('instance').val(content);
	TextEditor.sceditor('instance').width("100%");
	TextEditor.sceditor('instance').height(350);
	TextEditor.sceditor('instance').sourceMode(false);
	UpdateTextProgress(0);
}

function CloseEditor()
{
	$(".guidev2_texteditor").hide();
	TextProgress = 0;
	TextLimit = 0;
}

function ParseEditorText(text)
{
	var outText = text;
	
	var result = XBBCODE.process({
		text: outText,
		removeMisalignedTags: false,
		addInLineBreaks: true
	});
	
	if (result.error)
	{
		return outText;
	}
	else
	{
		var lss = GuideShaper.toLowerCase();
		outText = result.html;
		outText = outText.replace(/&#91;/g, "[");
		outText = outText.replace(/&#93;/g, "]");
		outText = outText.replace(/\[p\]/g, '<img src="http://www.moba-champion.com/images/shapers/' + lss + '/p.png" class="image32small abilitytip" title="p" data-shaper="' + GuideShaper + '"> <span class="orange_text abilitytip" title="p"></span>');
		outText = outText.replace(/\[q\]/g, '<img src="http://www.moba-champion.com/images/shapers/' + lss + '/q.png" class="image32small abilitytip" title="q" data-shaper="' + GuideShaper + '"> <span class="orange_text abilitytip" title="q"></span>');
		outText = outText.replace(/\[w\]/g, '<img src="http://www.moba-champion.com/images/shapers/' + lss + '/w.png" class="image32small abilitytip" title="w" data-shaper="' + GuideShaper + '"> <span class="orange_text abilitytip" title="w"></span>');
		outText = outText.replace(/\[e\]/g, '<img src="http://www.moba-champion.com/images/shapers/' + lss + '/e.png" class="image32small abilitytip" title="e" data-shaper="' + GuideShaper + '"> <span class="orange_text abilitytip" title="e"></span>');
		outText = outText.replace(/\[r\]/g, '<img src="http://www.moba-champion.com/images/shapers/' + lss + '/r.png" class="image32small abilitytip" title="r" data-shaper="' + GuideShaper + '"> <span class="orange_text abilitytip" title="r"></span>');
		outText = outText.replace(/\[P\]/g, '<img src="http://www.moba-champion.com/images/shapers/' + lss + '/p.png" class="image32small abilitytip" title="p" data-shaper="' + GuideShaper + '"> <span class="orange_text abilitytip" title="p"></span>');
		outText = outText.replace(/\[Q\]/g, '<img src="http://www.moba-champion.com/images/shapers/' + lss + '/q.png" class="image32small abilitytip" title="q" data-shaper="' + GuideShaper + '"> <span class="orange_text abilitytip" title="q"></span>');
		outText = outText.replace(/\[W\]/g, '<img src="http://www.moba-champion.com/images/shapers/' + lss + '/w.png" class="image32small abilitytip" title="w" data-shaper="' + GuideShaper + '"> <span class="orange_text abilitytip" title="w"></span>');
		outText = outText.replace(/\[E\]/g, '<img src="http://www.moba-champion.com/images/shapers/' + lss + '/e.png" class="image32small abilitytip" title="e" data-shaper="' + GuideShaper + '"> <span class="orange_text abilitytip" title="e"></span>');
		outText = outText.replace(/\[R\]/g, '<img src="http://www.moba-champion.com/images/shapers/' + lss + '/r.png" class="image32small abilitytip" title="r" data-shaper="' + GuideShaper + '"> <span class="orange_text abilitytip" title="r"></span>');
	
		return outText;
	}
}

function StrExport(str)
{
	if (str == null)
	{
		return "";
	}
	
	return str;
}

function FilterDesc(desc)
{
	if (desc == "Click here to start adding text.")
	{
		return "";
	}
	
	return desc;
}

function RoleSave(el)
{
	var area = $(el).find('.guidev2_role_area');
	var numRoles = area.children(':visible').length;
	
	if (numRoles == 0)
	{
		$(".guidev2_save_errors").append('<p class="guidev2_save_warn">Please select at least one role.</p>');
	}
	else
	{
		if (numRoles > 4) numRoles = 4;
		var roleNames = new Array();
		var roleDescs = new Array();
		var selrole = "";
		
		for (var i = 0; i < 4; i++)
		{
			roleNames[i] = "";
			roleDescs[i] = "";
		}
		
		for (var i = 0; i < numRoles; i++)
		{ 
			var row = area.children(':visible')[i];
			var editor = $(row).find('.guideinput');
			var body = editor.data('content');
			
			var checked = $(row).find(".role_quickpick_val");
			var checkedVal = $(checked).is(':checked');
			if (checkedVal == true)
			{
				selrole = $(row).data('role');
			}
			
			roleNames[i] = $(row).data('role');
			roleDescs[i] = FilterDesc(body);
		}
		
		if (selrole == "")
		{
			selrole = roleNames[0];
			$(".role_quickpick_val").first().prop('checked', true);
		}
		
		PendingSaves++;
		
		$.post("http://www.moba-champion.com/guides/actions/saverole.php",
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
			role4desc : StrExport(roleDescs[3]),
			selrole : selrole
		},
		function(data) 
		{
			PendingSaves--;
			
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
		
		var selloadout = "";
		
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
			
			var checked = $(row).find(".loadout_quickpick_val");
			var checkedVal = $(checked).is(':checked');
			if (checkedVal == true)
			{
				selloadout = loadoutId;
			}
			
			loadoutNames[i] = loadoutName;
			loadoutIds[i] 	= loadoutId;
			loadoutDescs[i] = loadoutDesc;
		}
		
		if (selloadout == "")
		{
			selloadout = loadoutIds[0];
			$(".loadout_quickpick_val").first().prop('checked', true);
		}
		
		PendingSaves++;
		
		$.post("http://www.moba-champion.com/guides/actions/saveloadout.php",
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
			loadoutDescs3	: StrExport(loadoutDescs[2]),
			selloadout : selloadout
		},
		function(data) 
		{
			PendingSaves--;
			
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
	
	if (numSpells == 0)
	{
		$(".guidev2_save_errors").append('<p class="guidev2_save_warn">Please select at least one spell set.</p>');
	}
	else
	{
		if (numSpells > 3) numSpells = 3;
		var spellNames = new Array();
		var spellDescs = new Array();
		
		var selspell = "";
		
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
			
			var checked = $(row).find(".spell_quickpick_val");
			var checkedVal = $(checked).is(':checked');
			if (checkedVal == true)
			{
				selspell = spellSet;
			}
						
			spellNames[i] = spellSet;
			spellDescs[i] = spellDesc;
		}
		
		if (selspell == "")
		{
			selspell = spellNames[0];
			$(".spell_quickpick_val").first().prop('checked', true);
		}
		
		PendingSaves++;
		
		$.post("http://www.moba-champion.com/guides/actions/savespell.php",
		{
			spellid : GuideSpellId,
			guideid : GuideId,
			spellNames1 	: StrExport(spellNames[0]),
			spellDescs1		: StrExport(spellDescs[0]),
			spellNames2 	: StrExport(spellNames[1]),
			spellDescs2		: StrExport(spellDescs[1]),
			spellNames3 	: StrExport(spellNames[2]),
			spellDescs3		: StrExport(spellDescs[2]),
			selspell 		: selspell
		},
		function(data) 
		{
			PendingSaves--;
			
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
	
	if (numItems == 0)
	{
		$(".guidev2_save_errors").append('<p class="guidev2_save_warn">Please select at least one item set.</p>');
	}
	else
	{
		if (numItems > 10) numItems = 10;
		
		var itemName = new Array();
		var itemSets = new Array();
		var itemDesc = new Array();
		
		var selitem = "";
		
		for (var i = 0; i < 10; i++)
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
						
			var checked = $(row).find(".item_quickpick_val");
			var checkedVal = $(checked).is(':checked');
			if (checkedVal == true)
			{
				selitem = name;
			}
			
			itemName[i] = name;
			itemSets[i] = itemSet;
			itemDesc[i] = desc;
		}
		
		if (selitem == "")
		{
			selitem = itemName[0];
			$(".item_quickpick_val").first().prop('checked', true);
		}
		
		PendingSaves++;
		
		$.post("http://www.moba-champion.com/guides/actions/saveitem.php",
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
			itemSets7 : StrExport(itemSets[6]),
			itemName8 : StrExport(itemName[7]),
			itemDesc8 : StrExport(itemDesc[7]),
			itemSets8 : StrExport(itemSets[7]),
			itemName9 : StrExport(itemName[8]),
			itemDesc9 : StrExport(itemDesc[8]),
			itemSets9 : StrExport(itemSets[8]),
			itemName10 : StrExport(itemName[9]),
			itemDesc10 : StrExport(itemDesc[9]),
			itemSets10 : StrExport(itemSets[9]),
			selitem : selitem
		},
		function(data) 
		{
			PendingSaves--;
			
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
		
		$.post("http://www.moba-champion.com/guides/actions/saveskillorder.php",
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
		
		$.post("http://www.moba-champion.com/guides/actions/saveabilities.php",
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

function SaveIntro(el)
{
	var area = $(el).find('.guidev2_section_content');
	var desc = $(area).find('.guideinput').data("content");
	desc = FilterDesc(desc);
	
	PendingSaves++;
	
	$.post("http://www.moba-champion.com/guides/actions/saveintro.php",
	{
		guideid : GuideId,
		introid : GuideIntroId,
		desc : desc
	},
	function(data) 
	{
		PendingSaves--;
			
		var results = jQuery.parseJSON(data)
		if (results.id > 0)
		{
			GuideIntroId = results.id;
			$(".guidev2_save_errors").append('<p class="guidev2_save_success">' + results.message + "</p>");
		}
		else
		{
			$(".guidev2_save_errors").append('<p class="guidev2_save_fail">' + results.message + "</p>");
		}
	
		GuideIntroModified = false;
		DisplayModified();
		SaveOverallGuideCB(false);
	})
	.error(function() 
	{ 
		$(".guidev2_save_errors").append('<p class="guidev2_save_fail">Error saving custom section: ' + title + '</p>');
		PendingSaves--;
		SaveOverallGuideCB(false);
	});
}

function SaveCustom(el)
{
	var title = $(el).find(".guidev2_section_header_text").find("input").val();
	var area = $(el).find('.guidev2_section_content');
	var desc = $(area).find('textarea').sceditor('instance').val();			
	PendingSaves++;
	PendingCustoms++;
	
	var customid = $(el).data('id');
	
	$.post("http://www.moba-champion.com/guides/actions/savecustom.php",
	{
		guideid : GuideId,
		customid : customid,
		title : title,
		desc : desc
	},
	function(data) 
	{
		PendingSaves--;
		PendingCustoms--;
		console.log(data);
		
		var results = jQuery.parseJSON(data)
		if (results.id > 0)
		{
			$(el).data('id',results.id);
			$(".guidev2_save_errors").append('<p class="guidev2_save_success">' + results.message + "</p>");
		}
		else
		{
			$(".guidev2_save_errors").append('<p class="guidev2_save_fail">' + results.message + "</p>");
		}
	
		if (PendingCustoms == 0)
		{
			GuideCustomModified = false;
		}
		
		DisplayModified();
		SaveOverallGuideCB(false);
	})
	.error(function() 
	{ 
		$(".guidev2_save_errors").append('<p class="guidev2_save_fail">Error saving custom section: ' + title + '</p>');
		PendingSaves--;
		PendingCustoms--;
		SaveOverallGuideCB(false);
	});
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
			if (type == 1 && GuideRolesModified && GuideType == 1)
			{
				RoleSave(this);
			}
			else if (type == 2 && GuideLoadoutModified && GuideType == 1)
			{
				LoadoutSave(this);
			}
			else if (type == 3 && GuideSpellModified && GuideType == 1)
			{
				SpellSave(this);
			}
			else if (type == 4 && GuideItemModified && GuideType == 1)
			{
				ItemSave(this);
			}
			else if (type == 5 && GuideSkillModified && GuideType == 1)
			{
				SkillOrderSave(this);
			}
			else if (type == 6 && GuideAbilityUpdated && GuideType == 1)
			{
				SaveAbilities(this);
			}
			else if (type == 7 && GuideCustomModified)
			{
				SaveCustom(this);
			}
			else if (type == 8 && GuideIntroModified)
			{
				SaveIntro(this);
			}
		});
		
		SaveOverallGuideCB();
	}
}

function CalculateGuideCustomIds()
{
	var customIds = "";
	$(".guidev2_custom_section").each(function()
	{
		customIds += $(this).data('id');
		customIds += ",";
	});
	
	if(customIds.charAt( customIds.length-1 ) == ",") 
	{
		customIds = customIds.slice(0, -1)
	}
	
	return customIds;
}

function UpdateGuideHeader(resultid)
{
	var newGuideHeader = GetGuideHeader();
	UpdateShaper(true);
	GuideId = resultid;
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
}

function SaveOverallGuide(bCloseSettings)
{
	SaveInProgress = true;
	
	GuideCustomIds = CalculateGuideCustomIds();
	
	var GuidePrivacy = $("#guidev2_options_privacy").val();
	$.post("http://www.moba-champion.com/guides/actions/updateguide.php",
	{ 
		id : GuideId,
		title : GuideTitle,
		ign : GuideIgn,
		shaper : GuideShaper,
		privacy : GuidePrivacy,
		intro : GuideIntroId,
		roles : GuideRoleId,
		loadouts : GuideLoadoutId,
		spells : GuideSpellId,
		items : GuideItemId,
		skillorder : GuideSkillOrder,
		abilities : GuideAbilities,
		customs : GuideCustomIds,
		type : GuideType
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
			UpdateGuideHeader(results.id);
			
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

function InitialBBCodeParsing()
{
	$(".guideinput").not('handled').each(function()
	{
		var text = $(this).html();
		var parsedText = ParseEditorText(text);
		if (parsedText.length == 0)
		{
			parsedText = "Click here to start adding text.";
		}
		
		$(this).html(parsedText);
		$(this).addClass('handled');
		$(this).click(function()
		{
			if (!SortingInProgress)
			{
				var stitle = $(this).data('title');
				var slimit = $(this).data('limit');
				var scontent = $(this).data('content');
				var type = $(this).data('type');
				
				$(this).addClass('textresult');
				if (scontent == "Click here to start adding text.")
				{
					scontent = "";
				}
				
				MarkModified(type);
				ShowEditor(stitle,slimit,scontent);
			}
		});
	});
}

function AddSortable(identifier)
{
	$(identifier).sortable(
	{
		revert: true,
		start: function( event, ui ) 
		{
			SortingInProgress = true;
		},
		stop: function( event, ui ) 
		{
			SortingInProgress = false;
		},
	});
}

function CreateDragHandlers()
{
	AddSortable(".guidev2_role_area");
	AddSortable(".guidev2_loadout_selector");
	AddSortable(".guidev2_custom_area");
	AddSortable(".guidev2_spell_selector");
	AddSortable(".guidev2_item_selector");
}

$(document).ready(function() 
{
	CreateEditor();
	InitialBBCodeParsing();
	GuideHeader = GetGuideHeader();
	
	CreateClickHandlers();
	CreateChangeHandlers();
	CreateRoleHandlers();
	CreateSpellHandlers();	
	CreateLoadoutHandlers();
	CreateSkillOrderHandlers();
	CreateItemHandlers();
	CreateTooltips();
	CreateDragHandlers();
	
	if (GuideId >= 1)
	{
		// settings
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