var buildPoints = 0;
 
$(document).ready(function() 
{
	CreateSectionInputs();
	initToolbarBootstrapBindings();
	$(".guide_section").each(function()
	{
		var divIndex = $( this ).data('index');	
		$('#editor' + divIndex).wysiwyg( { toolbarSelector: '[data-role=editor' + divIndex + '-toolbar]'} );
	});
	
	HighlightNextRow();
 });
 
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
	if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
	else {
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
          <ul class="dropdown-menu">\
          </ul>\
        </div>\
      <div class="btn-group">\
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="icon-text-height"></i>&nbsp;<b class="caret"></b></a>\
          <ul class="dropdown-menu">\
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
        <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="icon-picture"></i></a>\
        <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />\
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
		}
	}
	
	if (button == "w")
	{
		if (points_w + 1 <=  maxpointsperlevel[index-1])
		{
			buildPoints++;
			points_w++;
		}		
	}
	
	if (button == "e")
	{
		if (points_e + 1 <=  maxpointsperlevel[index-1])
		{
			buildPoints++;
			points_e++;			
		}		
	}
	
	if (button == "r")
	{
		if (points_r + 1 <=  maxpointsperlevelr[index-1])
		{
			buildPoints++;
			points_r++;
		}		
	}
 }
 
 function UnlockPoint(index, button)
 {
	if (button =="q")
	{
		buildPoints--;
		points_q--;
	}
	
	if (button == "w")
	{
		buildPoints--;
		points_w--;	
	}
	
	if (button == "e")
	{
		buildPoints--;
		points_e--;	
	}
	
	if (button == "r")
	{
		buildPoints--;
		points_r--;	
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
 
 function AddItem(itemName)
 {
	alert(itemName);
 }
 
 function RemoveItem()
 {
 
 }
 
 var numStarting = 0;
 var numCore  = 0;
 var numOffensive = 0;
 var numDefensive = 0;
 var numSituational = 0;
 
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
		else if (buildPoints == index)
		{
			ClearCurrentRow();		
			UnlockPoint(index, button);
			$(this).html("");
			HighlightNextRow();
		}
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
})
$(document).ready(function() 
{	
	$.getJSON('http://www.moba-champion.com/js/itemdata.json', function(data) 
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
				
				console.log(img);
				
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
				console.log(htmlString);
				$(this).attr('title', htmlString);
			}
				
			$(this).tooltipster();			
		});
	});
});

function PopulateItemList()
{
	var itemListDiv;
	itemListDiv = $(".guide_item_picker");
	if (itemListDiv)
	{
		$.each(itemData, function()
		{
			itemListDiv.append('<div class="guide_item_picker_item mobatip" data-itemname="' + this.name + '" title="' + this.name + '"><img src="' + this.img + '"></div>');
		});	
		
		$(".guide_item_picker_item").click(function()
		{
			ToggleItemSelector();
		});
	}
}
