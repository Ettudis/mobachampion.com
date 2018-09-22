var buildPoints = 0;
var pointAllocation = "";
var maxpointsperlevel = [1,1,2,2,3,3,4,4,5,5,5,5,5,5,5,5,5,5];
var maxpointsperlevelr = [0,0,0,0,0,1,1,1,1,2,2,2,2,2,3,3,3,3];
var points_q = 0;
var points_w = 0;
var points_e = 0;
var points_r = 0;

$(document).ready(function() 
{
	if (GuidePointAllocation===undefined)
	{
	
	}
	else if (GuidePointAllocation.length > 17)
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
