function SortTable(table, sortType)
{
	console.log(table);
	console.log(sortType);
}

 $(function() {
    $(".tier_chart_header td").click(function(e) 
	{
		SortTable($(this).parent, $(this).html());
    });
})