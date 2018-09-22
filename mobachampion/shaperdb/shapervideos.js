$(document).ready(function() 
{
	$(".overlay_q").click(function()
	{
		$(".video_q").show();
	});
	
	$(".overlay_w").click(function()
	{
		$(".video_w").show();
	});

	$(".overlay_e").click(function()
	{
		$(".video_e").show();
	});

	$(".overlay_r").click(function()
	{
		$(".video_r").show();
	});	
	
	$(".shaper_video_close").click(function()
	{
		$(".video_q").hide();
		$(".video_w").hide();
		$(".video_e").hide();
		$(".video_r").hide();
	});	
});