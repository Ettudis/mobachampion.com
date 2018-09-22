<?php
include('../header.php');
?>

<script src="filter.js"></script> <!-- Including our script -->
<script src="voting.js"></script> <!-- Including our script -->

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">

<div class="article_news">

<?php
$testid = $_GET['shaper'];

if (!isset($testid))
{
	$testid = 'Amarynth';
}

$guideSql = 'SELECT 
				guide.title, guide.author, guide.shaper, guide.id,
				SUM(vote.type) AS vote_total
			FROM
				guide
				INNER JOIN vote ON guide.id = vote.guideid
			WHERE guide.shaper = "' . $testid . '" GROUP BY
				guide.id
			ORDER BY vote_total DESC';
 $guideRows = R::getAll($guideSql);
 $guideBeans = R::convertToBeans('guide',$guideRows);
 
$myCount = 0;
foreach($guideBeans as $guide)
{
	echo $guide->title;
	echo $guide->vote_total;
	echo '<BR>';
	$myCount++;
}
	
?>

</div>

</div> <!-- news -->
</div> <!-- content -->

</div>

</div> <!-- main container -->
</div> <!-- maincontent -->

<?php
include('../footer.php');
?>
