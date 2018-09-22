 var buildPoints = 0;
 
 function initToolbarBootstrapBindings() 
 {
  var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier', 
		'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
		'Times New Roman', 'Verdana'],
		fontTarget = $('[title=Font]').siblings('.dropdown-menu');
  $.each(fonts, function (idx, fontName) 
  {
	  fontTarget.append($('<li><a data-edit="fontName ' + fontName +'" style="font-family:\''+ fontName +'\'">'+fontName + '</a></li>'));
  });
  $('a[title]').tooltip({container:'body'});
	$('.dropdown-menu input').click(function() {return false;})
		.change(function () {$(this).parent('.dropdown-menu-editor').siblings('.dropdown-toggle-editor').dropdown('toggle');})
	.keydown('esc', function () {this.value='';$(this).change();});

  $('[data-role=magic-overlay]').each(function () { 
	var overlay = $(this), target = $(overlay.data('target')); 
	overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
  });
};

function showErrorAlert (reason, detail) 
{
	var msg='';
	if (reason==='unsupported-file-type') 
	{ 
		msg = "Unsupported format " +detail; 
	}
	else 
	{
		console.log("error uploading file", reason, detail);
	}
	$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
	 '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
};
 
 function CreateSectionInputs()
 {
	$(".guide_section").each(function()
	{
 	var divIndex = $( this ).data('index');
	var divEditor = '<div class="guide_text_section">\
	<div id="alerts"></div>\
    <div class="btn-toolbar" data-role="editor' + divIndex + '-toolbar" data-target="#editor' + divIndex + '">\
      <div class="btn-group">\
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="icon-font"></i><b class="caret"></b></a>\
          <ul class="dropdown-menu guideabs">\
          </ul>\
        </div>\
      <div class="btn-group">\
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="icon-text-height"></i>&nbsp;<b class="caret"></b></a>\
          <ul class="dropdown-menu guideabs">\
          <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>\
          <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>\
          <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>\
          </ul>\
      </div>\
      <div class="btn-group">\
        <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="icon-bold"></i></a>\
        <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="icon-italic"></i></a>\
        <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="icon-strikethrough"></i></a>\
        <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="icon-underline"></i></a>\
      </div>\
      <div class="btn-group">\
        <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="icon-list-ul"></i></a>\
        <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="icon-list-ol"></i></a>\
        <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="icon-indent-left"></i></a>\
        <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="icon-indent-right"></i></a>\
      </div>\
      <div class="btn-group">\
        <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="icon-align-left"></i></a>\
        <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="icon-align-center"></i></a>\
        <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="icon-align-right"></i></a>\
        <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="icon-align-justify"></i></a>\
      </div>\
      <div class="btn-group">\
		  <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="icon-link"></i></a>\
		    <div class="dropdown-menu input-append">\
			    <input class="span2" placeholder="URL" type="text" data-edit="createLink"/>\
			    <button class="btn" type="button">Add</button>\
        </div>\
        <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="icon-cut"></i></a>\
      </div>\
      <div class="btn-group">\
        <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="icon-undo"></i></a>\
        <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="icon-repeat"></i></a>\
      </div>\
    </div>\
    <div id="editor' + divIndex + '" class="guide_editor_text"></div>\
	</div>';
	
	    $( this ).append(divEditor);
    });
 }

 var dd1val;
 var dd2val;
 var dd3val;
 
var guideid = -1;
var publish = true;

$(document).ready(function() 
{
	var index = window.location.href.indexOf("?id");
	if(index > -1)	
	{
		guideid = getURLParameter("id");
	}
	
	CreateSectionInputs();
	initToolbarBootstrapBindings();
	$(".guide_section").each(function()
	{
		var divIndex = $( this ).data('index');	
		$('#editor' + divIndex).wysiwyg( { toolbarSelector: '[data-role=editor' + divIndex + '-toolbar]'} );
	});
	
	HighlightNextRow();
	
	$("#save_button").click(function()
	{
		SaveGuide();
	});
	
	if (itemDataLoaded && guideid && guideid != "" && $.isNumeric(guideid))
	{
		AttemptLoadGuide();
	}
	
	guidesLoaded = true;
});

function AttemptLoadGuide()
{
	$.post( 
	 "loadguide.php",
	 { 
		id : guideid
	},
	 function(data) 
	 {
		var results = jQuery.parseJSON(data);
		
		if (results.success == false)
			return;
			
		$(".guide_create_info_title").val(results.title);
		$(".guide_info_shaper").val(results.shaper);
		$(".guide_info_lane").val(results.lane);
		$(".guide_info_role").val(results.role);
		$(".guide_info_spell1").val(results.spell1);
		$(".guide_info_spell2").val(results.spell2);
		$(".guide_info_spell3").val(results.spell3);
		$(".guide_savey_privacy").val(results.privacy);
		$(".guide_create_info_loadout_url").val(results.loadouturl);
		
		$(".skillCol").each(function()
		{
			var button = $(this).data('button');	
			var index = $(this).data('index');
			
			if (index-1 == 0)
			{
				$(this).html("");
			}
			
			var thischar = results.skillPoints[index-1];
			if (button == thischar)
			{
				$(this).html('<i class="icon-ok"></i>');
			}
		});
		
		
		buildPoints = 18;
		pointAllocation = results.skillPoints;
		points_q = 5;
		points_w = 5;
		points_e = 5;
		points_r = 3;
				
		currentItemSelect = "starting";
		AddItem(results.starting1, "http://www.moba-champion.com/images/items/list/" + results.starting1 + ".png");
		AddItem(results.starting2, "http://www.moba-champion.com/images/items/list/" + results.starting2 + ".png");
		AddItem(results.starting3, "http://www.moba-champion.com/images/items/list/" + results.starting3 + ".png");
		AddItem(results.starting4, "http://www.moba-champion.com/images/items/list/" + results.starting4 + ".png");
		AddItem(results.starting5, "http://www.moba-champion.com/images/items/list/" + results.starting5 + ".png");
		
		currentItemSelect = "core";
		AddItem(results.core1, "http://www.moba-champion.com/images/items/list/" + results.core1 + ".png");
		AddItem(results.core2, "http://www.moba-champion.com/images/items/list/" + results.core2 + ".png");
		AddItem(results.core3, "http://www.moba-champion.com/images/items/list/" + results.core3 + ".png");
		AddItem(results.core4, "http://www.moba-champion.com/images/items/list/" + results.core4 + ".png");
		AddItem(results.core5, "http://www.moba-champion.com/images/items/list/" + results.core5 + ".png");	
		
		currentItemSelect = "offense";
		AddItem(results.offensive1, "http://www.moba-champion.com/images/items/list/" + results.offensive1 + ".png");
		AddItem(results.offensive2, "http://www.moba-champion.com/images/items/list/" + results.offensive2 + ".png");
		AddItem(results.offensive3, "http://www.moba-champion.com/images/items/list/" + results.offensive3 + ".png");
		AddItem(results.offensive4, "http://www.moba-champion.com/images/items/list/" + results.offensive4 + ".png");
		AddItem(results.offensive5, "http://www.moba-champion.com/images/items/list/" + results.offensive5 + ".png");

		currentItemSelect = "defense";
		AddItem(results.defensive1, "http://www.moba-champion.com/images/items/list/" + results.defensive1 + ".png");
		AddItem(results.defensive2, "http://www.moba-champion.com/images/items/list/" + results.defensive2 + ".png");
		AddItem(results.defensive3, "http://www.moba-champion.com/images/items/list/" + results.defensive3 + ".png");
		AddItem(results.defensive4, "http://www.moba-champion.com/images/items/list/" + results.defensive4 + ".png");
		AddItem(results.defensive5, "http://www.moba-champion.com/images/items/list/" + results.defensive5 + ".png");
		
		currentItemSelect = "situational";
		AddItem(results.situational1, "http://www.moba-champion.com/images/items/list/" + results.situational1 + ".png");
		AddItem(results.situational2, "http://www.moba-champion.com/images/items/list/" + results.situational2 + ".png");
		AddItem(results.situational3, "http://www.moba-champion.com/images/items/list/" + results.situational3 + ".png");
		AddItem(results.situational4, "http://www.moba-champion.com/images/items/list/" + results.situational4 + ".png");
		AddItem(results.situational5, "http://www.moba-champion.com/images/items/list/" + results.situational5 + ".png");			
				
		var count = 0;
		$(".guide_section").each(function()
		{
			var guideText = $(this).find(".guide_editor_text");	
			if (count == 0)
			{
				guideText.html(results.roleText);
			}
			else if (count == 1)
			{
				guideText.html(results.loadoutText);
			}
			else if (count == 2)
			{
				guideText.html(results.skillText);
			}			
			else if (count == 3)
			{
				guideText.html(results.spellText);
			}			
			else if (count == 4)
			{
				guideText.html(results.itemText);
			}			
			else if (count == 5)
			{
				guideText.html(results.contentText);
			}			
			count++;
		});		
	 }

  );
}
 
function getURLParameter(name) 
{
   return decodeURI(
       (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
   );
}

 var saveInProgress;
 
function SaveGuide()
{	
	var title = $(".guide_create_info_title").val();
	var shaper = $(".guide_info_shaper").find(":selected").text();
	var lane = $(".guide_info_lane").find(":selected").text();
	var role = $(".guide_info_role").find(":selected").text();
	var spell1 = $(".guide_info_spell1").find(":selected").text();
	var spell2 = $(".guide_info_spell2").find(":selected").text();
	var spell3 = $(".guide_info_spell3").find(":selected").text();
	var privacy = $(".guide_savey_privacy").find(":selected").text();
	var loadouturl = $(".guide_create_info_loadout_url").val();
		
	var guideTextArray = new Array();
	var count = 0;
	$(".guide_section").each(function()
	{
		var guideText = $(this).find(".guide_editor_text");
		var guideTextClean = guideText.cleanHtml();
		guideTextArray[count] = guideTextClean;
		count++;
	});
		
	if (!saveInProgress && Validate(title, shaper, lane, loadouturl, role, spell1, spell2, spell3, guideTextArray) == true)
	{				
		var starting = new Array("", "", "", "", "");
		var core = new Array("", "", "", "", "");
		var offensive = new Array("", "", "", "", "");
		var defensive = new Array("", "", "", "", "");
		var situational = new Array("", "", "", "", "");
		
		$(".guide_item_category_list").each(function()
		{
			var cat = $(this).data('itemttype');
			
			var itemcount = 0;
			$(this).children(".guide_item_item").each(function()
			{
				var name = $(this).data('itemname');
				if (cat == "starting")
				{
					starting[itemcount] = name;
				}
				else if (cat == "core")
				{
					core[itemcount] = name;
				}
				else if (cat == "offense")
				{
					offensive[itemcount] = name;
				}
				else if (cat == "defense")
				{
					defensive[itemcount] = name;
				}
				else if (cat == "situational")
				{
					situational[itemcount] = name;
				}				
				itemcount++;
			});
		});
		
		saveInProgress = true;
		
			$.post( 
             "submitguide.php",
             { 
				title : title,
				shaper : shaper,
				lane : lane,
				loadouturl : loadouturl,
				role : role,
				spell1 : spell1,
				spell2 : spell2,
				spell3 : spell3,
				roleText : guideTextArray[0],
				loadoutText : guideTextArray[1],
				skillText : guideTextArray[2],
				spellText : guideTextArray[3],
				itemText : guideTextArray[4],
				contentText : guideTextArray[5],
				skillPoints : pointAllocation,
				starting1 : starting[0],
				starting2 : starting[1],
				starting3 : starting[2],
				starting4 : starting[3],
				starting5 : starting[4],
				core1 : core[0],
				core2 : core[1],
				core3 : core[2],
				core4 : core[3],
				core5 : core[4],
				offensive1 : offensive[0],
				offensive2 : offensive[1],
				offensive3 : offensive[2],
				offensive4 : offensive[3],
				offensive5 : offensive[4],
				defensive1 : defensive[0],
				defensive2 : defensive[1],
				defensive3 : defensive[2],
				defensive4 : defensive[3],
				defensive5 : defensive[4],
				situational1 : situational[0],
				situational2 : situational[1],
				situational3 : situational[2],
				situational4 : situational[3],
				situational5 : situational[4],
				publish : publish,
				id : guideid,
				privacy : privacy
			},
             function(data) 
			 {
				saveInProgress = false;
				var htmlString = "<p>Guide Saved!</p>";
				$(".guide_savey_output").html(htmlString);
								
				var results = jQuery.parseJSON(data)
				if (results.id != 0)
				{
					window.location.href = "http://www.moba-champion.com/guides/edit.php?id=" + results.id;
				}
             }

          );		
	}
}

function isBlank(str) 
{
    return (!str || /^\s*$/.test(str));
}

function Validate(title, shaper, lane, loadouturl, role, spell1, spell2, spell3, guideText)
{
	var result = true;
	var htmlString = "<p>";
	
	if (isBlank(title))
	{
		htmlString += "<i class=\"icon-exclamation-sign\"> </i>Guide title is blank.<BR>";
		result = false;
	}
	
	if (title.length > 45)
	{
		htmlString += "<i class=\"icon-exclamation-sign\"> </i>Guide title exceeds 45 character limit..<BR>";
		result = false;
	}	
	
	if (shaper == "Select a Shaper...")
	{
		htmlString += "<i class=\"icon-exclamation-sign\"> </i>No shaper selected.<BR>";
		result = false;
	}
	
	if (lane == "Select a Lane...")
	{
		htmlString += "<i class=\"icon-exclamation-sign\"> </i>No lane selected.<BR>";
		result = false;
	}
		
	if (role == "Select a Role...")
	{
		htmlString += "<i class=\"icon-exclamation-sign\"> </i>No role selected.<BR>";
		result = false;
	}
	
	if (loadouturl == "")
	{
		htmlString += "<i class=\"icon-exclamation-sign\"> </i>No loadout URL selected.<BR>";
		result = false;
	}	
	
	if (spell1 == "Select Spell #1...")
	{
		htmlString += "<i class=\"icon-exclamation-sign\"> </i>No spell #1 selected.<BR>";
		result = false;
	}
	
	if (spell2 == "Select Spell #2...")
	{
		htmlString += "<i class=\"icon-exclamation-sign\"> </i>No spell #2 selected.<BR>";
		result = false;
	}

	if (spell3 == "Select Spell #3...")
	{
		htmlString += "<i class=\"icon-exclamation-sign\"> </i>No spell #3 selected.<BR>";
		result = false;
	}
	
	if (spell1 == spell2 || spell1 == spell3 || spell2 == spell3)
	{
		htmlString += ("<i class=\"icon-exclamation-sign\"> </i>Selected spells not unique.<BR>");
		result = false;
	}
	
	if (buildPoints != 18)
	{
		htmlString += "<i class=\"icon-exclamation-sign\"> </i>Not enough points allocated.<BR>";
		result = false;
	}
	
	if (pointAllocation.length != 18)
	{
		result = false;
	}
	
	if (guideText[0].length > 20000)
	{
		htmlString += "<i class=\"icon-exclamation-sign\"> </i>Role guide text exceeds 20000 character limit.<BR>";
		result = false;
	}
	
	if (guideText[1].length > 20000)
	{
		htmlString += "<i class=\"icon-exclamation-sign\"> </i>Loadout guide text exceeds 20000 character limit.<BR>";
		result = false;
	}	

	if (guideText[2].length > 20000)
	{
		htmlString += "<i class=\"icon-exclamation-sign\"> </i>Skill order guide text exceeds 20000 character limit.<BR>";
		result = false;
	}	

	if (guideText[3].length > 20000)
	{
		htmlString += "<i class=\"icon-exclamation-sign\"> </i>Spells guide text exceeds 20000 character limit.<BR>";
		result = false;
	}	

	if (guideText[4].length > 20000)
	{
		htmlString += "<i class=\"icon-exclamation-sign\"> </i>Items guide text exceeds 20000 character limit.<BR>";
		result = false;
	}
	
	if (guideText[5].length > 20000)
	{
		htmlString += "<i class=\"icon-exclamation-sign\"> </i>General guide text exceeds 20000 character limit.<BR>";
		result = false;
	}
		
	if (result == false)
	{
		htmlString += "</p>";
		$(".guide_savey_output").html(htmlString);
	}
	
	return result;
}

 var pointAllocation = "";
 var maxpointsperlevel = [1,1,2,2,3,3,4,4,5,5,5,5,5,5,5,5,5,5];
 var maxpointsperlevelr = [0,0,0,0,0,1,1,1,1,2,2,2,2,2,3,3,3,3];
 var points_q = 0;
 var points_w = 0;
 var points_e = 0;
 var points_r = 0;
 
 function LockInPoints(index, button)
 {
	if (button =="q")
	{
		if (points_q + 1 <=  maxpointsperlevel[index-1])
		{
			buildPoints++;
			points_q++;
			pointAllocation += "q";
			if (points_q > 5)
				points_q = 5;
		}
	}
	
	if (button == "w")
	{
		if (points_w + 1 <=  maxpointsperlevel[index-1])
		{
			buildPoints++;
			points_w++;
			pointAllocation += "w";
			if (points_w > 5)
				points_w = 5;			
		}		
	}
	
	if (button == "e")
	{
		if (points_e + 1 <=  maxpointsperlevel[index-1])
		{
			buildPoints++;
			points_e++;		
			pointAllocation += "e";
			if (points_e > 5)
				points_e = 5;			
		}		
	}
	
	if (button == "r")
	{
		if (points_r + 1 <=  maxpointsperlevelr[index-1])
		{
			buildPoints++;
			points_r++;
			pointAllocation += "r";
			if (points_r > 5)
				points_r = 5;			
		}		
	}
 }
 
 function UnlockPoint(index, button)
 {
	if (button =="q")
	{
		buildPoints--;
		points_q--;
		pointAllocation = pointAllocation.substring(0, pointAllocation.length - 1);
	}
	
	if (button == "w")
	{
		buildPoints--;
		points_w--;	
		pointAllocation = pointAllocation.substring(0, pointAllocation.length - 1);
	}
	
	if (button == "e")
	{
		buildPoints--;
		points_e--;
		pointAllocation = pointAllocation.substring(0, pointAllocation.length - 1);
	}
	
	if (button == "r")
	{
		buildPoints--;
		points_r--;
		pointAllocation = pointAllocation.substring(0, pointAllocation.length - 1);
	}
 }
 
 function ClearCurrentRow()
 {
	$(".skillCol").each(function()
	{
		var index = $(this).data('index');
		if (index == buildPoints + 1)
		{
			$(this).html("");
		}
	});
 }
 
 function HighlightNextRow()
 {
	$(".skillCol").each(function()
	{
		var button = $(this).data('button');	
		var index = $(this).data('index');
		
		if (index == buildPoints + 1)
		{
			if (button =="q")
			{
				if (points_q + 1 > maxpointsperlevel[index-1])
				{
					$(this).html("");
					return;
				}
			}
			
			if (button == "w")
			{
				if (points_w + 1 >  maxpointsperlevel[index-1])
				{
					$(this).html("");
					return;
				}		
			}
			
			if (button == "e")
			{
				if (points_e + 1 >  maxpointsperlevel[index-1])
				{
					$(this).html("");
					return;		
				}		
			}
			
			if (button == "r")
			{
				if (points_r + 1 >  maxpointsperlevelr[index-1])
				{
					$(this).html("");
					return;
				}		
			}
	
			$(this).html('<i class="icon-ok black-icon"></i>');
		}
	});
 }
 
 function AttemptHighlightThisEntry(me, index, button)
 {
	if (button =="q")
	{
		if (points_q + 1 > maxpointsperlevel[index-1])
		{
			return;
		}
	}
	
	if (button == "w")
	{
		if (points_w + 1 >  maxpointsperlevel[index-1])
		{
			return;
		}		
	}
	
	if (button == "e")
	{
		if (points_e + 1 >  maxpointsperlevel[index-1])
		{
			return;		
		}		
	}
	
	if (button == "r")
	{
		if (points_r + 1 >  maxpointsperlevelr[index-1])
		{
			return;
		}		
	}

	me.html('<i class="icon-ok grey-icon"></i>');
 }
 
 function ToggleItemSelector()
 {
	$(".guide_item_picker_window").toggleClass('guide_hidden');
 }
   
 $(function() {
    $("#item_store").click(function(e) 
	{
		
    });
	
	$(".skillCol").hover(
	  function () 
	  {
		var index = $(this).data('index');
		var button = $(this).data('button');
		
		if (buildPoints+1 == index)
		{
			AttemptHighlightThisEntry($(this), index, button);
		}
	  },
	  function () 
	  {
		var index = $(this).data('index');
		var button = $(this).data('button');	  
		if (index == buildPoints + 1)
		{
			HighlightNextRow();
		}		
	  });
	  
    $(".skillCol").click(function() 
	{
		var index = $(this).data('index');
		var button = $(this).data('button');
	
		if (buildPoints == (index-1))
		{
			ClearCurrentRow();
			$(this).html('<i class="icon-ok"></i>');
			LockInPoints(index, button);
			HighlightNextRow();
		}
		else if (buildPoints == index && pointAllocation[index-1] == button)
		{
			ClearCurrentRow();		
			UnlockPoint(index, button);
			$(this).html("");
			HighlightNextRow();
		}
    });
})