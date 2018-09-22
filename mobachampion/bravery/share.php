<?php
$moba_champ_title = 'Bravery - MOBA-Champion.com';
$moba_champ_desc = 'The ultimate Dawngate bravery!';
include('../header.php');
?>


<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Bravery</div></div></div>
<div class="news_content">


<div class="article_news" style="position: relative">

<?php

echo '<a href="http://www.moba-champion.com/bravery/index.php">
		<button id="submit_button" class="btn btn-large" type="button" style="position: absolute; right: 0; top: 0;">New Bravery!
		</button></a>';

$brav = $_GET['id'];
if (!is_null($brav))
{
	$bravery = R::load('bravery', $brav);
	
	if ($bravery->id > 0)
	{
		echo '<h3 style="color: #FFBF00">Mortal Team</h3>';
		
		echo '<div style="width=700px; height:80px">';
		echo '<h5>' . $bravery->player1 . '</h5>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/shapers/' . $bravery->shaper1 . '.png"></div>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/roles/' . $bravery->role1 . '.png"></div>';
		echo '<B>Items: </B>' . $bravery->items1  . '<BR>';
		echo '<B>Spells: </B>' .  $bravery->spells1  . '<BR>';
		echo '<B>Skills: </B>' . $bravery->order1 . ' (R at 6, 11 and 16)';
		echo '</div>';
		
		echo '<div style="width=700px; height:80px">';
		echo '<h5>' . $bravery->player2 . '</h5>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/shapers/' . $bravery->shaper2 . '.png"></div>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/roles/' . $bravery->role2 . '.png"></div>';
		echo '<B>Items: </B>' . $bravery->items2  . '<BR>';
		echo '<B>Spells: </B>' .  $bravery->spells2  . '<BR>';
		echo '<B>Skills: </B>' . $bravery->order2 . ' (R at 6, 11 and 16)';
		echo '</div>';
		
		echo '<div style="width=700px; height:80px">';
		echo '<h5>' . $bravery->player3 . '</h5>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/shapers/' . $bravery->shaper3 . '.png"></div>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/roles/' . $bravery->role3 . '.png"></div>';
		echo '<B>Items: </B>' . $bravery->items3  . '<BR>';
		echo '<B>Spells: </B>' .  $bravery->spells3  . '<BR>';
		echo '<B>Skills: </B>' . $bravery->order3 . ' (R at 6, 11 and 16)';
		echo '</div>';
		
		echo '<div style="width=700px; height:80px">';
		echo '<h5>' . $bravery->player4 . '</h5>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/shapers/' . $bravery->shaper4 . '.png"></div>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/roles/' . $bravery->role4 . '.png"></div>';
		echo '<B>Items: </B>' . $bravery->items4  . '<BR>';
		echo '<B>Spells: </B>' .  $bravery->spells4  . '<BR>';
		echo '<B>Skills: </B>' . $bravery->order4 . ' (R at 6, 11 and 16)';
		echo '</div>';
		
		echo '<div style="width=700px; height:80px">';
		echo '<h5>' . $bravery->player5 . '</h5>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/shapers/' . $bravery->shaper5 . '.png"></div>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/roles/' . $bravery->role5 . '.png"></div>';
		echo '<B>Items: </B>' . $bravery->items5  . '<BR>';
		echo '<B>Spells: </B>' .  $bravery->spells5  . '<BR>';
		echo '<B>Skills: </B>' . $bravery->order5 . ' (R at 6, 11 and 16)';
		echo '</div>';
		
		echo '<h3 style="color: #FFBF00">Spirit Team</h3>';
		
		echo '<div style="width=700px; height:80px">';
		echo '<h5>' . $bravery->player6 . '</h5>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/shapers/' . $bravery->shaper6 . '.png"></div>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/roles/' . $bravery->role6 . '.png"></div>';
		echo '<B>Items: </B>' . $bravery->items6  . '<BR>';
		echo '<B>Spells: </B>' .  $bravery->spells6  . '<BR>';
		echo '<B>Skills: </B>' . $bravery->order6 . ' (R at 6, 11 and 16)';
		echo '</div>';
		
		echo '<div style="width=700px; height:80px">';
		echo '<h5>' . $bravery->player7 . '</h5>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/shapers/' . $bravery->shaper7 . '.png"></div>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/roles/' . $bravery->role7 . '.png"></div>';
		echo '<B>Items: </B>' . $bravery->items7  . '<BR>';
		echo '<B>Spells: </B>' .  $bravery->spells7  . '<BR>';
		echo '<B>Skills: </B>' . $bravery->order7 . ' (R at 6, 11 and 16)';
		echo '</div>';
		
		echo '<div style="width=700px; height:80px">';
		echo '<h5>' . $bravery->player8 . '</h5>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/shapers/' . $bravery->shaper8 . '.png"></div>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/roles/' . $bravery->role8 . '.png"></div>';
		echo '<B>Items: </B>' . $bravery->items8  . '<BR>';
		echo '<B>Spells: </B>' .  $bravery->spells8  . '<BR>';
		echo '<B>Skills: </B>' . $bravery->order8 . ' (R at 6, 11 and 16)';
		echo '</div>';
		
		echo '<div style="width=700px; height:80px">';
		echo '<h5>' . $bravery->player9 . '</h5>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/shapers/' . $bravery->shaper9 . '.png"></div>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/roles/' . $bravery->role9 . '.png"></div>';
		echo '<B>Items: </B>' . $bravery->items9  . '<BR>';
		echo '<B>Spells: </B>' .  $bravery->spells9  . '<BR>';
		echo '<B>Skills: </B>' . $bravery->order9 . ' (R at 6, 11 and 16)';
		echo '</div>';
		
		echo '<div style="width=700px; height:80px">';
		echo '<h5>' . $bravery->player10 . '</h5>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/shapers/' . $bravery->shaper10 . '.png"></div>';
		echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/roles/' . $bravery->role10 . '.png"></div>';
		echo '<B>Items: </B>' . $bravery->items10  . '<BR>';
		echo '<B>Spells: </B>' .  $bravery->spells10  . '<BR>';
		echo '<B>Skills: </B>' . $bravery->order10 . ' (R at 6, 11 and 16)';
		echo '</div>';
	}
}

?>

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
