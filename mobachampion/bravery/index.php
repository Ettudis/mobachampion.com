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
echo '<button id="submit_button" class="btn btn-large" type="button" style="position: absolute; right: 0; top: 0;">SHARE BRAVERY!</button>';

$displayIndex = 1;

$shapers = array();
$numGladiators = 0;
$numHunters = 0;

$shaperData = file_get_contents('../data/shaperdata.json');
$shaperDataJSON = json_decode($shaperData);

$roleData = file_get_contents('../data/roledata.json');
$roleDataJSON = json_decode($roleData);

$ipData = file_get_contents('../data/itempalooza.json');
$ipDataJSON = json_decode($ipData);

$spellData = file_get_contents('../data/spelldata.json');
$spellDataJSON = json_decode($spellData);

for ($i = 1; $i <= 10; $i++) 
{
	if ($i == 1)
	{
		echo '<h3>Mortal Team</h3>';
	}
	else if ($i == 6)
	{
		echo '<h3>Spirit Team</h3>';
		$displayIndex = 1;
		$shapers = array();
		$numGladiators = 0;
		$numHunters = 0;
	}
	
    include("getbravery.php");
	echo '<div style="width=700px; height:100px">';
	echo '<input id="player' . $i . '" placeholder="Player ' . $displayIndex . '"/ style="float: left; margin-right: 700px">';
	echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/shapers/' . strtolower($data["shaper"]) . '.png"></div>';
	echo '<div class="widget_shaper_entry"><img src="http://www.moba-champion.com/images/roles/' . strtolower($data["role"]) . '.png"></div>';
	$displayItems = $items[0] . ', ' . $items[1] . ', ' . $items[2] . ', ' . $items[3] . ', ' . $items[4] . ' and ' . $items[5];
	$displaySpells = $spells[0] . ', ' . $spells[1] . ' and ' . $spells[2];
	echo '<B>Items: </B>' . $displayItems  . '<BR>';;
	echo '<B>Spells: </B>' .  $displaySpells  . '<BR>';;
	echo '<B>Order: </B>' . $order;
	
	echo '<script>';
	echo 'var shaper' . $i . '="' . strtolower($data["shaper"]) . '";'.PHP_EOL;
	echo 'var role' . $i . '="' . strtolower($data["role"]) . '";'.PHP_EOL;
	echo 'var items' . $i . '="' . $displayItems . '";'.PHP_EOL;
	echo 'var spells' . $i . '="' . $displaySpells . '";'.PHP_EOL;
	echo 'var order' . $i . '="' . $order . '";'.PHP_EOL;
	echo '</script>';
	echo '</div>';
	
	$displayIndex++;
}
	
?>

<script type="text/javascript">
$(document).ready(function() 
{
    $("#submit_button").click(function(e)
	{
		var url = "savebravery.php";

		var player1 = $("#player1").val();
		var player2 = $("#player2").val();
		var player3 = $("#player3").val();
		var player4 = $("#player4").val();
		var player5 = $("#player5").val();
		var player6 = $("#player6").val();
		var player7 = $("#player7").val();
		var player8 = $("#player8").val();
		var player9 = $("#player9").val();
		var player10 = $("#player10").val();
		
		$.post(url,
		{ 
            player1 : player1,
			player2 : player2,
			player3 : player3,
			player4 : player4,
			player5 : player5,
			player6 : player6,
			player7 : player7,
			player8 : player8,
			player9 : player9,
			player10 : player10,
            shaper1 : shaper1,
			shaper2 : shaper2,
			shaper3 : shaper3,
			shaper4 : shaper4,
			shaper5 : shaper5,
			shaper6 : shaper6,
			shaper7 : shaper7,
			shaper8 : shaper8,
			shaper9 : shaper9,
			shaper10 : shaper10,
            role1 : role1,
			role2 : role2,
			role3 : role3,
			role4 : role4,
			role5 : role5,
			role6 : role6,
			role7 : role7,
			role8 : role8,
			role9 : role9,
			role10 : role10,
			spells1 : spells1,
			spells2 : spells2,
			spells3 : spells3,
			spells4 : spells4,
			spells5 : spells5,
			spells6 : spells6,
			spells7 : spells7,
			spells8 : spells8,
			spells9 : spells9,
			spells10 : spells10,
			items1 : items1,
			items2 : items2,
			items3 : items3,
			items4 : items4,
			items5 : items5,
			items6 : items6,
			items7 : items7,
			items8 : items8,
			items9 : items9,
			items10 : items10,
			order1 : order1,
			order2 : order2,
			order3 : order3,
			order4 : order4,
			order5 : order5,
			order6 : order6,
			order7 : order7,
			order8 : order8,
			order9 : order9,
			order10 : order10
		},
		function(data) 
		{	
			var results = jQuery.parseJSON(data);
			location.href='http://www.moba-champion.com/bravery/share.php?id=' + results.returnid;
		});
	});
});
</script>
	
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
