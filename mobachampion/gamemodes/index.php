<?php
$moba_champ_title = 'Custom Game Modes - MOBA-Champion.com';
$moba_champ_desc = 'A collection of community grown custom game modes.';
$msCommunity = true;
$msGameModes = true;
include('../header.php');
?>


<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Custom Game Modes</div></div></div>
<div class="news_content">


<div class="article_news" style="position: relative">
<div class="featured_game_modes">

<div class="featured_game_mode">
	<div class="featured_game_title"><a href="http://www.moba-champion.com/gamemodes/bravery.php">Ultimate Bravery</a></div>
	<div class="featured_game_desc">
		<div class="featured_game_left">
			Ultimate Bravery is a game mode that requires maximum courage. Allow the hamsters that power MOBA-Champion to generate a random shaper, role, spell set, item set and skill order
			for either yourself or your friends and adhere to it strictly!
		</div>
		<div class="featured_game_right">
			<img src="http://www.moba-champion.com/gamemodes/bravery.png">
		</div>
	</div>
</div>

<div style="padding-left:260px;">
	<img src="http://www.moba-champion.com/gamemodes/divider.png" style="width: 300px;">
</div>

<div class="featured_game_mode">
	<div class="featured_game_title"><a href="http://www.moba-champion.com/gamemodes/arab.php">All Random At Bottom</a></div>
	<div class="featured_game_desc">
		<div class="featured_game_left">
			The core concept of ARAB is simple: select a random shaper (don't lock in!) and do not leave the bot lane. The community has developed a few rules about bushes, wards and recalling, so click through to read the full writeup.
		</div>
		<div class="featured_game_right">
			<img src="http://www.moba-champion.com/gamemodes/aram.png">
		</div>
	</div>
</div>

<div style="padding-left:260px;">
	<img src="http://www.moba-champion.com/gamemodes/divider.png" style="width: 300px;">
</div>

<div class="featured_game_mode">
	<div class="featured_game_title">
		Iron Man and Iron Man 2
	</div>
	<div class="featured_game_desc">
		<div class="featured_game_left">
			The Iron Man game modes put a different spin on the Dawngate. Legendary items are for chumps! It takes a true champion to defeat the Guardian with only Advanced items (Iron Man 2). For a true
			test of skill, try the original Iron Man which restricts you to Basic items only.
		</div>
		<div class="featured_game_right">
			<img src="http://www.moba-champion.com/gamemodes/ironman.png">
		</div>
	</div>
</div>

</div> <!-- featured_game_modes -->
</div> <!-- article -->
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
