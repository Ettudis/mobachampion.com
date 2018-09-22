$(document).ready(function() 
{
	DefaultToAll();
	FilterGuideChamps();

});

var activeNameFilter;
var activeRoleFilter;
function DefaultToAll()
{
	var activeButton = "All";
	activeRoleFilter = $("." + activeButton);
	activeRoleFilter.addClass('active');
	
	activeNameFilter = "";
}

function FilterGuideChamps()
{

	
	$(".guide_shaper_link").each(function() 
	{
		var text = activeRoleFilter.text().toLowerCase();	
		var archtype = $(this).data('archtype');
		
		var ranged = $(".guide_filter_range :selected").text().toLowerCase();
		var shaperranged = $(this).data('range').toLowerCase();
		
		var filter = $(".guide_filter_search_text").val().toLowerCase();
		activeNameFilter = filter;
		
		var shapernameDisplay = $(this).data('name');
		var shapername = shapernameDisplay.toLowerCase();
		var indexOf = shapername.indexOf(filter);
				
		if ((archtype == text || text == "all") && (ranged == shaperranged || ranged == "all") && (indexOf !== -1 || filter == ""))
		{
			htmlString = "<ul><li><img src=\"http://www.moba-champion.com/images/shapers/" + shapername + ".png\"></li><li>" + shapernameDisplay + "</li></ul>";
			$(this).html(htmlString);
			$(this).show();
		}
		else
		{
			$(this).hide();
		}
	});	
}

$(function() {
    $(".ArcheTypeButton").click(function(e) 
	{
		activeRoleFilter.removeClass('active');
		activeRoleFilter = $(e.target);	
		activeRoleFilter.addClass('active');
		
		FilterGuideChamps();
    });
	
	$(".guide_filter_range").change( function () {
		FilterGuideChamps();
	});	
	
	$(".guide_filter_search_text").keyup(function ()
	{
		var filter = $(".guide_filter_search_text").val().toLowerCase();
		if (filter !== activeNameFilter)
		{
			FilterGuideChamps();
		}
	});		
})