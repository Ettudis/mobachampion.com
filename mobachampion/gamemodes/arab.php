<?php
$moba_champ_title = 'Bravery - MOBA-Champion.com';
$moba_champ_desc = 'The ultimate Dawngate bravery!';
$msCommunity = true;
$msGameModes = true;
include('../header.php');
?>

<script src="http://www.moba-champion.com/gamemodes/bravery.js?v=12"></script>

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title"><a href="http://www.moba-champion.com/gamemodes/">Custom Game Modes</a> > All Random At Bottom</div></div></div>
<div class="news_content">


<div class="article_news" style="position: relative">
<h4>All Random At Bottom Rules</h4>
<ol>
<li>At shaper select, hit random, but DO NOT LOCK IN!</li>
<li>Stay in bottom lane!</li>
<li>You may not enter any bushes other than the 2 in the middle of the bottom lane.</li>
<li>You may not walk behind any wall</li>
<li>Wards are allowed everywhere you are allowed to walk.</li>
<li>You may not retreat to the top binding near your guardian for safety.</li>
<li>You may not retreat to the base for safety or healing</li>
<li>You may not buy anything unless you die (or at beginning of the match)</li>
</ol>

</div>
</div>

</div></div>

<div class="article_column2">
<?php 
include('../widgets/tournamentwidget.php');
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
