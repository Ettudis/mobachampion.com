<?php
$msTournaments = true;
$msTeams = true;
include('../header.php');
?>


<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">


<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Team Search</div></div></div>
<div class="news_content">


<div class="article_news">

<?php

$team = $_GET['team'];

echo '<h4>Search results for "'. $team .'"</h4>';

$tournamentSQL = 'SELECT * FROM team WHERE team.gname LIKE \'%' . $team . '%\'';
$tournamentRows = R::getAll($tournamentSQL);
$teams = R::convertToBeans('team',$tournamentRows);

foreach($teams as $team_entry)
{
    echo '<p><a href="http://www.moba-champion.com/tournaments/team.php?id=' . $team_entry->id . '">' . $team_entry->gname . '</a></p>';
}

?>

</div>
</div>

</div>
</div>

<div class="article_column2">
<?php 
include('../widgets/shaperwidget.php');
include('../widgets/adwidget.php');
include('../widgets/streamwidget.php');
include('../widgets/guidewidget.php');
?>
</div>

</div> <!-- main container -->
</div> <!-- maincontent -->

<?php
include('../footer.php');
?>
