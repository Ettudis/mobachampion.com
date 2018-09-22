var degrees = 0;
var divPos = {}
var col = 0;
var row = 0;
var prevCol = 0;
var prevRow = 0;

var subType = 0;
var prevSubType = 0;
var subType2 = 0;
var prevSubType2 = 0;
	
var shapes = new Array(4);

var bSaveInProgress = false;

for (i = 0; i < 4 ; i++)
{
	shapes[i] = new Array(4);
	for (j = 0; j < 4; j++)
	{
		shapes[i][j] = 0;
	}
}

function IsEven(n) 
{
  n = Number(n);
  return n === 0 || !!(n && !(n%2));
}

var rotate = false;
	
function GetShapePos(p)
{
	var a = Math.round(p / 128);
	if (a < 0)
		a = 0;
	if (a > 3)
		a = 3;
		
	return a;
}

function GetShapePosFloor(p)
{
	var a = Math.floor(p / 128);
	if (a < 0)
		a = 0;
	if (a > 3)
		a = 3;
		
	return a;
}

function GetShapeSubType(a,b)
{
	var x = a % 128;
	var y = b % 128;
	var dy = 128 - y;
	
	if (y > x)
	{
		subType = 2;
	}
	else
	{
		subType = 3;
	}
	
	if (x > dy)
	{
		subType2 = 5;
	}
	else
	{
		subType2 = 4;
	}
}

function HasMouseMovedGrid()
{
	if (row != prevRow)
	{
		return true;
	}
	
	if (col != prevCol)
	{
		return true;
	}
	
	if (subType != prevSubType)
	{
		return true;
	}
	
	if (subType2 != prevSubType2)
	{
		return true;
	}
}

function GetLocation()
{
	if (IsEven(row))
	{
		if (IsEven(col))
		{
			if (degrees < 225)
			{
				rotate = 180;
			}
			else
			{
				rotate = 0;
			}
		}
		else
		{
			if (degrees < 134)
			{
				rotate = 270;
			}
			else
			{
				rotate = 90;
			}
		}
	}
	else
	{
		if (IsEven(col))
		{
			if (degrees < 315)
			{
				rotate = 90;
			}
			else
			{
				rotate = 270;
			}
		}
		else
		{
			if (degrees < 45)
			{
				rotate = 0;
			}
			else
			{
				rotate = 180;
			}
		}
	}
}

var wasValid = false;
var isPositioning = false;
var $currentDragShape;
var $currentGem;

function IsOverShape(x,y,area,rot)
{
	var vR = area.split("_");
	var vRes = "";
	
	vRes = vR[rot];
	
	var a = vRes.split(",");
	
	var ix = y; // swap rows here
	var iy = x;
	
	for (i = 0; i < a.length; i++) 
	{
		var str = a[i];
		var jy = iy;
		
		for (var j = 0, len = str.length; j < len; j++) 
		{
			if (ix < 0 || jy < 0)
			{
				return false;
			}
			
			if (ix > 3 || jy > 3)
			{
				return false;
			}
			
			if (ix == row && jy == col)
			{
				if (str[j] == 1)
				{
					return true;
				}
				else if (str[j] == subType || str[j] == subType2)
				{
					return true;
				}
			}
			
			jy++;
		}
		
		ix++;
	}
	
	return false;
}

function IsValidPosition(x,y,area,rot)
{
	var vR = area.split("_");
	var vRes = "";
	
	vRes = vR[rot];
	
	var a = vRes.split(",");
	
	var ix = y; // swap rows here
	var iy = x;
	
	for (i = 0; i < a.length; i++) 
	{
		var str = a[i];
		var jy = iy;
		
		for (var j = 0, len = str.length; j < len; j++) 
		{
			if (ix < 0 || jy < 0)
			{
				return false;
			}
			
			if (ix > 3 || jy > 3)
			{
				return false;
			}
				
			if (str[j] == 1)
			{					
				if (shapes[ix][jy] != 0)
				{
					return false;
				}
			}
			else if (str[j] == 2)
			{
				if (shapes[ix][jy] != 3 && shapes[ix][jy] != 0)
				{
					return false;
				}
			}
			else if (str[j] == 3)
			{
				if (shapes[ix][jy] != 2 && shapes[ix][jy] != 0)
				{
					return false;
				}
			}
			else if (str[j] == 4)
			{
				if (shapes[ix][jy] != 5 && shapes[ix][jy] != 0)
				{
					return false;
				}
			}
			else if (str[j] == 5)
			{
				if (shapes[ix][jy] != 4 && shapes[ix][jy] != 0)
				{
					return false;
				}
			}
			
			jy++;
		}
		
		ix++;
	}
	
	return true;
}

function UsePosition(x,y,area,enable,rot)
{
	var vR = area.split("_");
	var vRes = "";
	
	vRes = vR[rot]
	
	var a = vRes.split(",");
	var ix = y; // swap rows here
	var iy = x;
	
	for (i = 0; i < a.length; i++) 
	{
		var str = a[i];
		var jy = iy;
		
		for (var j = 0, len = str.length; j < len; j++) 
		{
			if (str[j] == 1)
			{
				if (shapes[ix][jy] == 0)
				{
					if (enable == true)
					{
						shapes[ix][jy] = str[j];
					}
				}
				else if (enable == false)
				{
					shapes[ix][jy] = 0;
				}
			}
			else if (str[j] == 2)
			{
				if (shapes[ix][jy] == 0)
				{
					if (enable == true)
					{
						shapes[ix][jy] = str[j];
					}
				}
				else if (shapes[ix][jy] == 3)
				{
					if (enable == true)
					{
						shapes[ix][jy] = 9;
					}
				}
				else if (enable == false)
				{
					if (shapes[ix][jy] == 9)
					{
						shapes[ix][jy] = 3;
					}
					else
					{
						shapes[ix][jy] = 0;
					}
				}
			}
			else if (str[j] == 3)
			{
				if (shapes[ix][jy] == 0)
				{
					if (enable == true)
					{
						shapes[ix][jy] = str[j];
					}
				}
				else if (shapes[ix][jy] == 2)
				{
					if (enable == true)
					{
						shapes[ix][jy] = 9;
					}
				}
				else if (enable == false)
				{
					if (shapes[ix][jy] == 9)
					{
						shapes[ix][jy] = 2;
					}
					else
					{
						shapes[ix][jy] = 0;
					}
				}
			}
			else if (str[j] == 4)
			{
				if (shapes[ix][jy] == 0)
				{
					if (enable == true)
					{
						shapes[ix][jy] = str[j];
					}
				}
				else if (shapes[ix][jy] == 5)
				{
					if (enable == true)
					{
						shapes[ix][jy] = 9;
					}
				}
				else if (enable == false)
				{
					if (shapes[ix][jy] == 9)
					{
						shapes[ix][jy] = 5;
					}
					else
					{
						shapes[ix][jy] = 0;
					}
				}
			}
			else if (str[j] == 5)
			{
				if (shapes[ix][jy] == 0)
				{
					if (enable == true)
					{
						shapes[ix][jy] = str[j];
					}
				}
				else if (shapes[ix][jy] == 4)
				{
					if (enable == true)
					{
						shapes[ix][jy] = 9;
					}
				}
				else if (enable == false)
				{
					if (shapes[ix][jy] == 9)
					{
						shapes[ix][jy] = 4;
					}
					else
					{
						shapes[ix][jy] = 0;
					}
				}
			}
			
			jy++;
		}

		ix++;
	}
}

function ApplyRotation(shape)
{
	var rot = shape.data("rot");
	
	var w = shape.width();
	var h = shape.height();
	var d = w - h;
	
	shape.width(h);
	shape.height(w);
	$("#selector_underlay").width(h);
	$("#selector_underlay").height(w);
	
	shape.children(".gem_socket").each(function()
	{
		var gemPos = $(this).attr("pos").split("_");
		var gP = gemPos[rot].split(",");
		
		$(this).css({top: gP[1] + "px", left: gP[0] + "px", position:"absolute"});
	});
	
	if (rot == 0)
	{					
		shape.children(".loadout_shape_img").removeClass("L90");
		shape.children(".loadout_shape_img").removeClass("L180");
		shape.children(".loadout_shape_img").removeClass("L270");
		shape.children(".loadout_shape_img").css({top: 0, left: 0, position:"absolute"});
		
		$("#selector_underlay").children().removeClass("L90");
		$("#selector_underlay").children().removeClass("L180");
		$("#selector_underlay").children().removeClass("L270");
		$("#selector_underlay").children().css({top: 0, left: 0, position:"absolute"});
	}
	else if (rot == 1)
	{
		shape.children(".loadout_shape_img").addClass("L90");
		shape.children(".loadout_shape_img").removeClass("L180");
		shape.children(".loadout_shape_img").removeClass("L270");
		shape.children(".loadout_shape_img").css({top: d/2, left: -d/2, position:"absolute"});
		
		$("#selector_underlay").children().addClass("L90");
		$("#selector_underlay").children().removeClass("L180");
		$("#selector_underlay").children().removeClass("L270");
		$("#selector_underlay").children().css({top: d/2, left: -d/2, position:"absolute"});
	}
	else if (rot == 2)
	{
		shape.children(".loadout_shape_img").removeClass("L90");
		shape.children(".loadout_shape_img").addClass("L180");
		shape.children(".loadout_shape_img").removeClass("L270");
		shape.children(".loadout_shape_img").css({top: 0, left: 0, position:"absolute"});
		
		$("#selector_underlay").children().removeClass("L90");
		$("#selector_underlay").children().addClass("L180");
		$("#selector_underlay").children().removeClass("L270");
		$("#selector_underlay").children().css({top: 0, left: 0, position:"absolute"});
	}
	else if (rot == 3)
	{
		shape.children(".loadout_shape_img").removeClass("L90");
		shape.children(".loadout_shape_img").removeClass("L180");
		shape.children(".loadout_shape_img").addClass("L270");
		shape.children(".loadout_shape_img").css({top: d/2, left: -d/2, position:"absolute"});
		
		$("#selector_underlay").children().removeClass("L90");
		$("#selector_underlay").children().removeClass("L180");
		$("#selector_underlay").children().addClass("L270");
		$("#selector_underlay").children().css({top: d/2, left: -d/2, position:"absolute"});
	}
}

function DoRotation(shape)
{
	var rot = shape.data("rot");
	rot++;
	
	if (rot > 3)
	{
		rot = 0;
	}
	
	shape.data("rot", rot);
	shape.data("refresh", "true");
	
	ApplyRotation(shape);

	return false;
}

function UpdateStat(stat, add)
{
	if (stat.substring(0, 6) == "Unique")
	{
		if (add == true)
		{	
			var printStr = stat.replace("-"," ");
			d=document.createElement("p");
			$(d).html(printStr)
				.addClass("loadout_editor_summary_content_row")
				.attr("stat", "custom")
				.attr("val", 1)
				.attr("name", stat)
				.appendTo($(".loadout_editor_summary_content"));
		}
		else
		{
			$(".loadout_editor_summary_content").children().each(function () 
			{
				var srcStat = $(this).attr("name");
				if (srcStat == stat)
				{
					$(this).remove();
					return;
				}
			});
		}
		
		return;
	}
	
	var a = stat.split(",");
	
	for (i = 0; i < a.length; i++) 
	{
		var str = a[i];
		var b = str.split(" ");
		
		if (add == true)
		{	
			var found = false;
			$(".loadout_editor_summary_content").children().each(function () 
			{
				if ($(this).attr("name") == b[1])
				{
					var scoreStr = $(this).attr("val");
					var score = parseFloat(scoreStr);
					score += parseFloat(b[0]);
					$(this).attr("val", score.toFixed(1));
					
					var scoreStr = "+" + (score.toFixed(1) + " " + $(this).attr("name")).replace(/-/g, " ").replace(" Percent","%");
					$(this).html(scoreStr);
					found = true;
					return false;
				}
			});
		
			if (found == false)
			{
				var printStr = str.replace(/-/g, " ");
				printStr = printStr.replace(" Percent","%");
				d=document.createElement("p");
				$(d).html(printStr)
					.addClass("loadout_editor_summary_content_row")
					.attr("stat", str)
					.attr("val", b[0])
					.attr("name", b[1])
					.appendTo($(".loadout_editor_summary_content"));
			}
		}
		else
		{
			var found = false;
			$(".loadout_editor_summary_content").children().each(function () 
			{
				if ($(this).attr("name") == b[1])
				{
					var scoreStr = $(this).attr("val");
					var score = parseFloat(scoreStr);
					score -= parseFloat(b[0]);
					$(this).attr("val", score.toFixed(1));
					
					var scoreStr = "+" + (score.toFixed(1) + " " + $(this).attr("name")).replace(/-/g, " ").replace(" Percent","%");
					$(this).html(scoreStr);
					
					if (score == 0)
					{
						$(this).remove();
					}
					
					found = true;
					return false;
				}
			});
		}
	}
}

function SaveFavorite()
{
	var url = "favoriteloadoutaction.php";
	bSaveInProgress = true;
	
	$.post(url,
	{ 
		loadout : LoadoutSaveId,
	},
	function(data) 
	{		
		bSaveInProgress = false;
		var results = jQuery.parseJSON(data);
		if (results.returnid > 0)
		{
			$(".loadout_editor_button_favorite").html('Favorite (Y)');
		}
	})
	.error(function() 
	{ 
		bSaveInProgress = false;
	});
}

function SaveLoadout(bFavorite)
{
	var exportPrefix = "http://www.moba-champion.com/loadouts/index.php?l=";
	var exportUrl = "";
	
	$(".loadout_shape").each(function()
	{
		var placed = $(this).attr("placed");
		if (placed == "true")
		{
			var l = GetShapePos($(this).position().left);
			var t = GetShapePos($(this).position().top);
			var id = $(this).attr("id");
			var rot = $(this).data("rot");
			
			if (id === undefined)
			{
				alert("no idea associated with this shape");
			}
			
			var shapeExport = l + "," +
								t + "," +
								id + "," +
								rot + ","
								;
								
			
			var gemExports = "";
			var numGems = 0;
			$(this).children(".gem_socket").each(function()
			{
				var gemId = $(this).attr("id");
				if (gemId === undefined || gemId == "")
				{
					gemExports += "-1,";
				}
				else
				{
					gemExports += gemId + ",";
				}
				numGems++;
			});
			
			gemExports = numGems + "," + gemExports.substring(0, gemExports.length - 1);
			
			exportUrl += shapeExport;
			exportUrl += gemExports;
			exportUrl += "_";
		}
	});
	
	var url = "saveloadoutaction.php";
	bSaveInProgress = true;
	
	$.post(url,
	{ 
		loadout : exportUrl,
	},
	function(data) 
	{		
		bSaveInProgress = false;
		var results = jQuery.parseJSON(data);
		if (results.returnid > 0)
		{
			var niceUrl = exportPrefix + results.returnid;
			LoadoutSaveId = results.returnid;
			$(".loadout_editor_save_url_input").val(niceUrl);
			$(".loadout_editor_save_url_upd").clearQueue();
			$('.loadout_editor_save_url_upd').fadeIn('slow');
			$('.loadout_editor_save_url_upd').delay(2000).fadeOut('slow');
		}
		
		if (bFavorite)
		{
			SaveFavorite();
		}
	})
	.error(function() 
	{ 
		bSaveInProgress = false;
	});
}

function EnableGemSelector()
{
	ToggleGemSelectorVisiblity();
}

function DisableGemSelector()
{
	ToggleGemSelectorVisiblity();
	$currentGem = null;
}

function ToggleGemSelectorVisiblity()
{
	$(".gem_picker_window").toggle(0);
}

function EvaluateGemBonuses(shape)
{
	var tt_gemlist = "";
	
	var bonus = $(shape).attr("bonus");
	var bonusValid = true;
	$(shape).children(".gem_socket").each(function()
	{
		var clr = $(this).attr("color");
		var gem = $(this).attr("gem");
		var gemclr = $(this).attr("gemclr");
		var gembonus = $(this).attr("bonus");
		
		if (gem == "")
		{
			bonusValid = false;
		}
		else if (clr != gemclr && clr != "combo" && gemclr != "combo")
		{
			bonusValid = false;
		}
		
		if (gem != "")
		{
			var tt_gem = "<BR><div class=\"shape_tt_header\">" + gem + "</div><div class=\"shape_tt_body\">" + gembonus.replace(",", "<BR>").replace(/-/g, " ") + "</div>";
			tt_gemlist = tt_gemlist + tt_gem;
		}
	});
			
	if (bonusValid && bonus == "false")
	{
		var srcStat = $(shape).attr("stat");
		UpdateStat(srcStat, true);
		$(shape).attr("bonus", true);
		
	}
	else if (!bonusValid && bonus == "true")
	{
		var srcStat = $(shape).attr("stat");
		UpdateStat(srcStat, false);
		$(shape).attr("bonus", false);
	}
	
	var srcTitle = $(shape).attr("name");
	var srcStat = $(shape).attr("stat");
	
	var tt_title = "";
	if (bonusValid)
	{
		tt_title = "<div class=\"shape_tooltip\"><div class=\"shape_tt_header\">" + srcTitle + "</div><div class=\"shape_tt_body\">" + srcStat.replace(",", "<BR>").replace(/-/g, " ") + "</div>";
	}
	else
	{
		tt_title = "<div class=\"shape_tooltip\"><div class=\"shape_tt_header\">" + srcTitle + "</div><div class=\"shape_tt_body_dis\">" + srcStat.replace(",", "<BR>").replace(/-/g, " ") + "</div>";
	}
	
	tt_title = tt_title + tt_gemlist + "</div>"; // close div
	
	tt_title = tt_title.replace(/-/g, " ");
	tt_title = tt_title.replace(" Percent","%");
				
	$(shape).data("tooltipsterContent", tt_title);
}

function ToggleGemBonuses(shape, add)
{		
	$(shape).children(".gem_socket").each(function()
	{
		var clr = $(this).attr("color");
		var gem = $(this).attr("gem");
		var gemclr = $(this).attr("gemclr");
		var gembonus = $(this).attr("bonus");
		var bonusValid = true;
		
		if (gem == "")
		{
			bonusValid = false;
		}
		else if (clr != gemclr && clr != "combo" && gemclr != "combo")
		{
			bonusValid = false;
		}
		
		if (bonusValid)
		{
			UpdateStat(gembonus, add);
		}
	});
}

function AddShape(input)
{
	var inputs = input.split(",");
	var numParams = inputs.length;
	if (numParams < 4)
	{
		return;
	}
	
	var l = inputs[0];
	var t = inputs[1];
	var id = inputs[2];
	var rot = inputs[3];
	
	$(".loadout_editor_mini_shape").each(function () 
	{
		var srcId = $(this).attr("id");
		var srcArea = $(this).attr("area");
		if (id == srcId)
		{
			var d = AddShapeToGrid(this, l, t, "true", rot);
			var vR = srcArea.split("_");
			var vRes = vR[0];
			var a = vRes.split(",");
			
			var maxHeight = a.length;
			var maxWidth = 0;
			for (i = 0; i < a.length; i++)
			{
				if (a[i].length > maxWidth)
				{
					maxWidth = a[i].length;
				}
			}
			$(d).width(maxWidth * 128);
			$(d).height(maxHeight * 128);
			
			UsePosition(l,t,srcArea,true,rot);
			UpdateDebugRows();
			ApplyRotation($(d));
			
			var totgems = inputs[4];
			var numgems = 0;
			var iter = 5;

			$(d).children(".gem_socket").each(function()
			{
				if (numgems >= totgems)
				{
					return;
				}
				
				var g = this;
				
				var gemid = inputs[iter];
				$(".gem_picker_gem").each(function()
				{
					var pickerId = $(this).attr("id");
					if (pickerId == gemid)
					{
						var path = $(this).attr("path");
						var _gname = $(this).attr("name");
						var _gcolor = $(this).attr("color");
						var _gid = $(this).attr("id");
						var _gbonus = $(this).attr("bonus");
						
						var fullPath = "http://www.moba-champion.com/loadouts/gems/purchase_" + path + ".png";
						$(g).children().attr("src", fullPath);
						$(g).attr("gem", _gname);
						$(g).attr("gemclr", _gcolor);
						$(g).attr("id", _gid);
						$(g).attr("bonus", _gbonus);
						
						return;
					}
				});
				
				iter++;
				numgems++;
			});
			
			ToggleGemBonuses(d, true);
			EvaluateGemBonuses(d);
				
			return;
		}
	});
}

function AddShapeToGrid(mini_shape, srcLeft, srcTop, placed, rot)
{
	var srcImg = $(mini_shape).attr("path");
	var srcArea = $(mini_shape).attr("area");
	var srcStat = $(mini_shape).attr("stat");
	var srcTitle = $(mini_shape).attr("name");
	var srcFilter = $(mini_shape).attr("filter");
	var srcId = $(mini_shape).attr("id");
	
	var tt_title = "<div class=\"shape_tooltip\"><div class=\"shape_tt_header\">" + srcTitle + "</div><div class=\"shape_tt_body_dis\">" + srcStat.replace(",", "<BR>").replace(/-/g, " ") + "</div></div>";
	
	var src = "<img src=\"http://www.moba-champion.com/loadouts/" + srcImg + ".png\" class=\"loadout_shape_img\">";
	
	d=document.createElement("div");
	$(d).addClass("loadout_shape")
		.html(src)
		.data("rot", rot)
		.attr("path", srcImg)
		.attr("area", srcArea)
		.attr("stat", srcStat)
		.attr("placed", placed)
		.attr("title", tt_title)
		.attr("bonus", "false")
		.attr("name", srcTitle)
		.attr("filter", srcFilter)
		.css({top: (srcTop * 128), left: (srcLeft * 128)})
		.attr("id", srcId)
		.zIndex(14)
		.appendTo($(".loadout_editor_left"))
		.dblclick(function()
		{

		})
		.mousedown(function(e){ 
			if( e.button == 2 ) 
			{ 
			
			} 
			return true; 
		  })
		.mousemove(function(e)
		{
			
		})
		.bind("contextmenu", function () 
		{
			if ($currentDragShape != null)
			{
				if ($currentDragShape != null)
				{
					DoRotation($currentDragShape);
				}
				
				return false;
			}
			else
			{
				var srcArea = $(this).attr("area");
				var l = GetShapePos($(this).position().left);					
				var t = GetShapePos($(this).position().top);
				
				var rot = $(this).data("rot");
				
				UsePosition(l,t,srcArea,false,rot);
				UpdateDebugRows();
				
				var srcPlaced = $(this).attr("placed");
				if (srcPlaced == "true")
				{
					var srcStat = $(this).attr("stat");
					var srcBonus = $(this).attr("bonus");
					if (srcBonus == "true")
					{
						UpdateStat(srcStat, false);
					}
				}
				
				ToggleGemBonuses(this, false);
				
				$(this).remove();
				return false;
			}
		})
		.tooltipster()
		;
		
	$(d).draggable(
	{ 
		containment: ".loadout_editor_left",
		start: function( event, ui ) 
		{
			$currentDragShape = ui.helper;
			
			// create underlay
			var mySrc = ui.helper.attr("path");
			var fullSrc = "http://www.moba-champion.com/loadouts/" + mySrc + "_green.png";
			var imghtml = "<img src=\"" + fullSrc + "\" class=\"loadout_underlay_img\" style=\"position: absolute;\">";
			
			var $newJQ = jQuery("<div/>", {
				id: "selector_underlay",
				html: imghtml,
			}).appendTo(".loadout_editor_left");
			
			// clear tootlip
			ui.helper.tooltipster("hide");
			
			// get rotation
			var rot = ui.helper.data("rot");
			
			var w = ui.helper.width();
			var h = ui.helper.height();
			var d = h - w;
										
			if (rot == 0)
			{					
				$newJQ.children().removeClass("L90");
				$newJQ.children().removeClass("L180");
				$newJQ.children().removeClass("L270");
				$newJQ.children().css({top: 0, left: 0, position:"absolute"});
			}
			else if (rot == 1)
			{
				$newJQ.width(h);
				$newJQ.height(w);
			
				$newJQ.children().addClass("L90");
				$newJQ.children().removeClass("L180");
				$newJQ.children().removeClass("L270");
				$newJQ.children().css({top: d/2, left: -d/2, position:"absolute"});
			}
			else if (rot == 2)
			{
				$newJQ.children().removeClass("L90");
				$newJQ.children().addClass("L180");
				$newJQ.children().removeClass("L270");
				$newJQ.children().css({top: 0, left: 0, position:"absolute"});
			}
			else if (rot == 3)
			{
				$newJQ.width(h);
				$newJQ.height(w);
				
				$newJQ.children().removeClass("L90");
				$newJQ.children().removeClass("L180");
				$newJQ.children().addClass("L270");
				$newJQ.children().css({top: d/2, left: -d/2, position:"absolute"});
			}

			var srcArea = ui.helper.attr("area");
			var l = GetShapePos(ui.position.left);					
			var t = GetShapePos(ui.position.top);
			
			var srcPlaced = ui.helper.attr("placed");
			if (srcPlaced == "true")
			{
				UsePosition(l,t,srcArea,false,rot);
				UpdateDebugRows();
			
				ToggleGemBonuses(this, false);
				
				var srcStat = ui.helper.attr("stat");
				var srcBonus = $(this).attr("bonus");
				if (srcBonus == "true")
				{
					UpdateStat(srcStat, false);
				}
				
				$(this).children(".gem_bonus").each(function()
				{
					var gembonus = $(this).attr("bonus");
					var gem = $(this).attr("gem");
					if (gem != "")
					{
						UpdateStat(gembonus, false);
					}
				});
			}
			
			ui.helper.zIndex(14);
			wasValid = true;
		},
		drag: function( event, ui )
		{
			var l = GetShapePos(ui.position.left);
			$("#selector_underlay").css({ left: l * 128 });
			
			var t = GetShapePos(ui.position.top);
			$("#selector_underlay").css({ top: t * 128 });
			
			var srcArea = ui.helper.attr("area");
			var rot = ui.helper.data("rot");
			
			if (IsValidPosition(l,t,srcArea, rot))
			{
				if (!wasValid)
				{
					var mySrc = ui.helper.attr("path");
					var fullSrc = "http://www.moba-champion.com/loadouts/" + srcImg + "_green.png";
					$("#selector_underlay").children().attr("src", fullSrc);
				}
				wasValid = true;
			}
			else if (wasValid)
			{
				var mySrc = ui.helper.attr("path");
				var fullSrc = "http://www.moba-champion.com/loadouts/" + srcImg + "_red.png";
				$("#selector_underlay").children().attr("src", fullSrc);
				wasValid = false;
			}
		},
		stop: function( event, ui ) 
		{			
			ui.helper.zIndex(3);
			
			$currentDragShape = null;
			var l = GetShapePos(ui.position.left);
			ui.helper.css({ left: l * 128 });
			
			var t = GetShapePos(ui.position.top);
			ui.helper.css({ top: t * 128 });
			
			$("#selector_underlay").remove();
			
			var srcArea = ui.helper.attr("area");
			var srcStat = ui.helper.attr("stat");
			var rot = ui.helper.data("rot");
			
			if (IsValidPosition(l,t,srcArea, rot))
			{
				ToggleGemBonuses(this, true);
				
				UsePosition(l,t,srcArea,true,rot);
				UpdateDebugRows();
				
				var srcBonus = $(this).attr("bonus");
				
				if (srcBonus == "true")
				{
					UpdateStat(srcStat, true);
				}
				
				ui.helper.attr("placed", "true");
			}
			else
			{
				ui.helper.remove();
			}
		},
		refreshPositions: true,
	});
	
	$(mini_shape).children(".loadout_editor_mini_shape_img").children(".loadout_editor_mini_shape_gem").each(function () 
	{
		var srcClr = $(this).attr("color");
		var srcOffset = $(this).attr("offset");
		var dOffset = srcOffset.split(",");
		
		var gemAll = $(this).attr("pos");
		var gemPos = gemAll.split("_");
		var dPos = gemPos[0].split(",");
		
		var gem = "<img src=\"http://www.moba-champion.com/loadouts/gemslot/" + srcClr + ".png\">";
		g=document.createElement("div");
		$(g).addClass("gem_socket")
			.html(gem)
			.attr("color", srcClr)
			.attr("offset", srcOffset)
			.attr("pos", gemAll)
			.attr("gem", "")
			.appendTo($(d))
			.css({top: dPos[1] + "px", left: dPos[0] + "px" })
			.dblclick(function(e)
			{
				var srcPlaced = $($(this).parent().get(0)).attr("placed");
				if (srcPlaced == "true")
				{
					var gemName = $(this).attr("gem");
					if (gemName == "")
					{
						EnableGemSelector();
						$currentGem = $(this);
						e.stopPropagation();
					}
				}
				else
				{
					alert("This shape has not yet been placed.");
				}
			})
			.bind("contextmenu", function () 
			{
				if ($currentDragShape != null)
				{
					return true;
				}
				
				var gemName = $(this).attr("gem");
				
				if (gemName == "")
				{
					return true;
				}
				else
				{
					var color = $(this).attr("color");
					var newSrc = "http://www.moba-champion.com/loadouts/gemslot/" + color + ".png";
					$(this).children().attr("src", newSrc);
					$(this).attr("gem", "");
					$(this).attr("id", "");
					
					var gembonus = $(this).attr("bonus");
					UpdateStat(gembonus, false);
					
					EvaluateGemBonuses($(this).parent().get(0));
					return false;
				}
			})
			;
	});
	
	return d;
}

$(document).ready(function()
{		
	$(".loadout_editor_save_url_input").delay(1000).fadeIn("slow");
	
	$(".gem_picker_gem").click(function()
	{
		if ($currentGem != null)
		{
			var path = $(this).attr("path");
			var gem = $(this).attr("name");
			var gemclr = $(this).attr("color");
			var gemId = $(this).attr("id");
			
			var fullPath = "http://www.moba-champion.com/loadouts/gems/purchase_" + path + ".png";
			$currentGem.children().attr("src", fullPath);
			$currentGem.attr("gem", gem);
			$currentGem.attr("gemclr", gemclr);
			$currentGem.attr("id", gemId);
			
			var gbonus = $(this).attr("bonus");
			UpdateStat(gbonus, true);
			$currentGem.attr("bonus", gbonus);
			
			var shape = $currentGem.parent().get(0);
			var srcTitle = $(shape).attr("name");
			var srcStat = $(shape).attr("stat");

			EvaluateGemBonuses(shape);
		}
		
		DisableGemSelector();
	});
	
	$(".gem_picker_close").click(function ()
	{
		DisableGemSelector();
	});
	
	$(".loadout_editor_mini_shape").each(function () 
	{
		var srcImg = $(this).attr("path");
		var srcArea = $(this).attr("area");
		var srcStat = $(this).attr("stat");
		var srcTitle = $(this).attr("name");
		
		var tt_title = "<div class=\"shape_tooltip\"><div class=\"shape_tt_header\">" + srcTitle + "</div><div class=\"shape_tt_body_dis\">" + srcStat.replace(",", "<BR>").replace(/-/g, " ") + "</div></div>";
		$(this).attr("title",tt_title);
		
		$(this).tooltipster();
	});
	
	$(".loadout_editor_left").bind("contextmenu", function () 
	{
		if ($currentDragShape != null)
		{
			DoRotation($currentDragShape);
		}
		
		return false;
	});
	
	$(".loadout_editor_right").bind("contextmenu", function () 
	{
		if ($currentDragShape != null)
		{
			DoRotation($currentDragShape);
		}
		
		return false;
	});
	
	$(".loadout_editor_mini_shape").click(function()
	{
		AddShapeToGrid(this, 0, 0, "false", 0);
	});
	
	$(".loadout_editor_button_clear").click(function(e)
	{
		$(".loadout_editor_left").empty();
		$(".loadout_editor_summary_content").empty();
		
		for (i = 0; i < 4 ; i++)
		{
			for (j = 0; j < 4; j++)
			{
				shapes[i][j] = 0;					
			}
		}
		
		UpdateDebugRows();
	});
	
	$(".loadout_editor_button_save").click(function(e)
	{		
		SaveLoadout(false);
	});
	
	$(".loadout_editor_button_favorite").click(function(e)
	{
		SaveFavorite(true);
	});
	
	$(".loadout_editor_left").click(function(e)
	{
		
	});

	$(".gemfilterall").click(function(e)
	{
		$(".gem_picker_list").children().each(function()
		{
			$(this).show(0);
		});
	});
	
	$(".gemfilterred").click(function(e)
	{
		$(".gem_picker_list").children().each(function()
		{
			var gmclr = $(this).attr("color");
			if (gmclr == "red")
			{
				$(this).show(0);
			}
			else
			{
				$(this).hide(0);
			}
		});
	});
	
	$(".gemfiltergreen").click(function(e)
	{
		$(".gem_picker_list").children().each(function()
		{
			var gmclr = $(this).attr("color");
			if (gmclr == "green")
			{
				$(this).show(0);
			}
			else
			{
				$(this).hide(0);
			}
		});
	});
	
	$(".gemfilterblue").click(function(e)
	{
		$(".gem_picker_list").children().each(function()
		{
			var gmclr = $(this).attr("color");
			if (gmclr == "blue")
			{
				$(this).show(0);
			}
			else
			{
				$(this).hide(0);
			}
		});
	});
	
	$(".loadout_editor_filter").each(function()
	{
		$(this).tooltipster();
	});
	
	$(".loadout_editor_filter").click(function(e)
	{
		var filter = $(this).attr("filter");
		$(".loadout_editor_filter").each(function()
		{
			var otherFilter = $(this).attr("filter");
			
			$(".loadout_editor_mini_shape").each(function()
			{
				var subFilter = $(this).attr("filter");
				if (subFilter != filter)
				{
					$(this).hide(0);
				}
				else
				{
					$(this).show(0);
				}
			});
					
			if (otherFilter != filter)
			{
				if ($(this).hasClass("active_filter"))
				{
					$(this).removeClass("active_filter");
				}
			}
			else
			{
				$(this).addClass("active_filter");
			}
		});
	});
	
	var controlInfo = "<div>To add a shape to the grid, <B>left click</B> its mini icon in the bottom menu.<BR><BR><B>Click and drag</B> to move shapes around. <B>Right click</B> while dragging to rotate.<BR><BR>To add a gem, <B>double click</B> an empty gem slot to open the Gem Selector.</B><BR><BR>Remove gems and shapes by <B>right clicking</B> on them.</div>";
	$(".loadout_editor_control").attr("title", controlInfo);
	$(".loadout_editor_control").tooltipster();
			
	$(".loadout_editor_left").mousemove(function(event)
	{
		var offset = $(this).offset();
		var x = event.pageX - offset.left;
		var y = event.pageY - offset.top;
		
		col = GetShapePosFloor(x);
		row = GetShapePosFloor(y);
		GetShapeSubType(x,y);
		
		if (HasMouseMovedGrid())
		{
			$(".loadout_shape").each(function()
			{
				var srcPlaced = $(this).attr("placed");
				var l = GetShapePos($(this).position().left);					
				var t = GetShapePos($(this).position().top);
				
				var srcArea = $(this).attr("area");
				var srcStat = $(this).attr("stat");
				var rot = $(this).data("rot");
				
				if (IsOverShape(l,t,srcArea, rot))
				{
					if ($currentDragShape == null)
					{
						$(this).zIndex( 12 );
						$(this).draggable( "enable" );
					}
				}
				else
				{
					if ($currentDragShape == null && srcPlaced == "true")
					{
						$(this).zIndex( 3 );
						$(this).draggable( "disable" );
					}
				}
			});
		}
		prevCol = col;
		prevRow = row;
		prevSubType = subType;
		prevSubType2 = subType2;
		
		return true;
	});
	
	AddShapesFromURL();
});	