<?php
echo '<div class="tournament_widget">';

$randWidgetDisplay = rand( 1 , 3 );
if ($randWidgetDisplay == 0)
{
	echo '<a href="http://www.moba-champion.com/tournaments/event.php?id=15"><img src="http://www.moba-champion.com/news/bib.png"></a>';
}
else if ($randWidgetDisplay == 1)
{
	echo '<a href="http://www.moba-champion.com/news/index.php?id=264"><img src="http://www.moba-champion.com/news/breakdown1.png"></a>';
}
else if ($randWidgetDisplay == 2)
{
	echo '<a href="http://www.moba-champion.com/contests/"><img src="http://www.moba-champion.com/news/contest_mini.png"></a>';
}
else
{
	echo '<a href="http://www.dawnscout.com"><img src="http://www.moba-champion.com/news/ds.png"></a>';
}
echo '</div>';
?>