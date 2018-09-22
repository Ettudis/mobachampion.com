var buildPoints = 0;
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

			$(this).html('<i class="fa fa-check black-icon"></i>');
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

	me.html('<i class="fa fa-check grey-icon"></i>');
}


$(document).ready(function() 
{
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
		MarkModified("skillorder");
		
		if (buildPoints == (index-1))
		{
			ClearCurrentRow();
			$(this).html('<i class="fa fa-check"></i>');
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
	
	if (GuidePointAllocation.length > 17)
	{
		pointAllocation = GuidePointAllocation;
		
		$(".skillCol").each(function()
		{
			var button = $(this).data('button');	
			var index = $(this).data('index');
			
			if (index-1 == 0)
			{
				$(this).html("");
			}
			
			var thischar = pointAllocation[index-1];
			if (button == thischar)
			{
				$(this).html('<i class="fa fa-check"></i>');
			}
		});
			
		buildPoints = 18;
		points_q = 5;
		points_w = 5;
		points_e = 5;
		points_r = 3;
	}
});
