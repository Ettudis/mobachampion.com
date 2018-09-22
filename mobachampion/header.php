<?php 

function myException($e)
{
	echo '<p><b>Database connection error: </b></p>';
	echo '<script>console.log(' . $e->getMessage() . ');</script>';
}

set_exception_handler('myException');

require_once('forum/SSI.php');
require_once('db.php');
$_SESSION['login_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$_SESSION['logout_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

require('rb/rb.php');
require('rb/connect.php');
?>

<!DOCTYPE HTML>
<HTML>
<!-- MAIN INDEX -->
<head>

<?php
  // TITLE AND DESCRIPTION
  if (isset($moba_champ_title))
  {
	echo '<title>' . $moba_champ_title . '</title>';
  }
  else
  {
	echo '<title>MOBA-Champion - Dawngate News, Shaper Guides and Game Info</title>';
  }
  
  if (isset($moba_champ_desc))
  {
	echo '<meta name="description" content="' . $moba_champ_desc . '">';
  }
  else
  {
	echo '<meta name="description" content="The #1 source for Dawngate news, guides and info!">';
  }
  // END TITLE AND DESCRIPTION
?>

  <!-- Meta, CSS, etc -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="Dawngate, Waystone, Shapers, Moba, Moba-Champion, Amarynth, Cerulean, Desecrator, Dibs, Faris, Fenmore, Freia, Kel, Mikella, Moya, Nissa, Salous, Varion, Viyana, Voluc, Zeri">
  <meta property="og:image" content="http://www.moba-champion.com/images/twitter.png" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/lore/vis/dist/vis.css?v=50">
  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/css/main.css?v=50" />
  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/css/stats.css?v=50" />
  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/guides/guidesv2.css?v=50" />
  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/css/bootstrap.css?v=50">
  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/guides/development/themes/default.css" media="all" />
  <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css">
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/css/tooltipster.css" />  
  <link rel="shortcut icon" href="http://www.moba-champion.com/images/icon.ico">
  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/loadouts/perks.css?v=1" />

</head>

<body class="mainbody">

<?php include_once("analytics.php") ?>

<script src="http://code.jquery.com/jquery.js"></script>
<script type="text/javascript" src="http://www.moba-champion.com/js/jquery-ui.js"></script>
<script type="text/javascript" src="http://www.moba-champion.com/js/trie.js"></script>
<script type="text/javascript" src="http://www.moba-champion.com/js/mobasearch.js"></script>
<script type="text/javascript" src="http://www.moba-champion.com/lore/vis/dist/visdg.js"></script>

<script>
var shaperData;
var shaperDataLoaded = false;
var itemData;
var itemDataLoaded = false;
var itempaloozaData;
var itempaloozaDataLoaded = false;
var roleData = null;
var roleDataLoaded = false;
var spellData = null;
var spellDataLoaded = false;
var stoneData = null;
var stoneDataLoaded = false;
var sparkData = null;
var sparkDataLoaded = false;
</script>

<script type="text/javascript" src="http://www.moba-champion.com/js/itemtooltips.js?v=1"></script>
<script type="text/javascript" src="http://www.moba-champion.com/js/itempaloozatooltips.js?v=1"></script>
<script type="text/javascript" src="http://www.moba-champion.com/js/spelltooltips.js?v=1"></script>
<script type="text/javascript" src="http://www.moba-champion.com/js/roletooltips.js?v=1"></script>
<script type="text/javascript" src="http://www.moba-champion.com/js/shapertooltips.js?v=1"></script>
<script type="text/javascript" src="http://www.moba-champion.com/js/jquery.tooltipster.js?v=1"></script>
<script type="text/javascript" src="http://www.moba-champion.com/js/bootstrap.js?v=1"></script>
<script type="text/javascript" src="http://www.moba-champion.com/js/stonetips.js?v=1"></script>

<?php
  if (isset($includeMixitUp))
  {
	echo '<script type="text/javascript" src="http://www.moba-champion.com/js/jquery.mixitup.min.js"></script>';
	echo '<script type="text/javascript" src="http://www.moba-champion.com/js/shaper_filter.js"></script>';
  }
?>

<div id="main_content">
<div id="header_top">

<div id="header_rich">
	
	<div id="header_rich_col1">
		<div class="header_col1_logo">
			<a href="http://www.moba-champion.com"><img src="http://www.moba-champion.com/images/logo8.png"></a>
		</div>
	</div>
	
	<div id="header_rich_col2">
		
		<form id="search_form" action="http://www.moba-champion.com/search.php" method="get">
		<input type="text" id="shaper_search" name="search"  value="Search for a Shaper, Item, Spell, etc..." 
				onfocus="if (this.value == 'Search for a Shaper, Item, Spell, etc...') 
						{
							this.value = '';
						}" 
				onblur="if (this.value == '') 
						{
							this.value = 'Search for a Shaper, Item, Spell, etc...';
						}" autocomplete="off"  />
		</form>	
		
		<div id="moba_search_glass"><i class="icon-search"></i></div>
		<div id="moba_search_result" class="moba_search_hidden"></div>
		
	</div>

	<div id="header_rich_col3">
		<div id="header_rich_login_box">
			<?php
						
			if ($context['user']['is_guest'])
			{		
				ssi_login();
			}
			else
			{
				//You can show other stuff here.  Like ssi_welcome().  That will show a welcome message like.
				//Hey, username, you have 552 messages, 0 are new.\
				echo '<p>',ssi_welcome(),'</p>';
				echo '<p>',ssi_logout(),'</p>';
			}
			?>			
		</div>
	</div>

	<script>
	$( document ).ready(function() 
	{

	});

	if (navigator.userAgent.toLowerCase().indexOf("chrome") >= 0) {
		$(window).load(function(){
			$('input:-webkit-autofill').each(function(){
				var text = $(this).val();
				var name = $(this).attr('name');
				$(this).after(this.outerHTML).remove();
				$('input[name=' + name + ']').val(text);
			});
		});
	}
	</script>
	
</div>

<?php 
function ActiveClass(&$activePage)
{
	if ($activePage == true)
	{
		echo 'class="active"';
	}
}

function ActiveText(&$activeText)
{
	if ($activeText == true)
	{
		echo 'active';
	}
}
?>
	
<div id="header_navbar">  
<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <div class="container">
 	
	<ul class="nav">
	  <li><a href="http://www.moba-champion.com/" <?php ActiveClass($msHome); ?>><b>Home</b></a></li>
	  
<?php
if ($context['user']['is_logged'] == true)
{
  echo '<li class="dropdown">';
  
	if (isset($msGuides) && $msGuides == true)
	{
		echo '<a href="http://www.moba-champion.com/guides" class="active dropdown-toggle disabled" data-toggle="dropdown">
					<b>Guides</b><b class="caret"></b>
				</a>';
	}
	else
	{
		echo '<a href="http://www.moba-champion.com/guides" class="dropdown-toggle disabled" data-toggle="dropdown">
					<b>Guides</b><b class="caret"></b>
			  </a>';
	}
	
	echo '<ul class="dropdown-menu">
		<li>
			<a href="http://www.moba-champion.com/guides/list.php?author=' . $context['user']['name'] . '" '; ActiveClass($msGuideList); echo '><b>My Guides</b></a>
		</li>
		<li>
			<a href="http://www.moba-champion.com/guides/editor.php" '; ActiveClass($msGuidesEdit); echo '><b>Create a Guide</b></a>
		</li>
	</ul>			
  </li>';
}
else
{
	echo '<li><a href="http://www.moba-champion.com/guides" class="'; ActiveText($msGuides); echo ' "><b>Guides</b></a></li>';
}
?>
	  <li class="dropdown">
		<a href="http://www.moba-champion.com/gameinfo" class="dropdown-toggle <?php ActiveText($msGameInfo); ?>" data-toggle="dropdown"><b>Game Info</b><b class="caret"></b></a>
		<ul class="dropdown-menu">
		<li><a href="http://www.moba-champion.com/shapers" <?php ActiveClass($msShapers); ?>><b>Shapers</b></a></li>
        <li><a href="http://www.moba-champion.com/items" <?php ActiveClass($msItems); ?>><b>Items</b></a></li>
		<li><a href="http://www.moba-champion.com/spells" <?php ActiveClass($msSpells); ?>><b>Spells</b></a></li>
		<li><a href="http://www.moba-champion.com/roles" <?php ActiveClass($msRoles); ?>><b>Roles</b></a></li>
		<li><a href="http://www.moba-champion.com/map" <?php ActiveClass($msMap); ?>><b>Map</b></a></li>
		<li><a href="http://www.moba-champion.com/patch" <?php ActiveClass($msPatch); ?>><b>Patch History</b></a></li>
		</ul>
	  </li>
	 	  	  
	  <li class="dropdown">
		<a href="http://www.moba-champion.com/articles/" class="dropdown-toggle <?php ActiveText($msLore); ?>" data-toggle="dropdown"><b>Lore</b><b class="caret"></b></a>
		<ul class="dropdown-menu">
		<li><a href="http://www.moba-champion.com/lore/" <?php ActiveClass($msLoreMain); ?>><b>General Lore</b></a></li>
		<li><a href="http://www.moba-champion.com/lore/timeline.php" <?php ActiveClass($msTimeline); ?>><b>Lore Timeline</b></a></li>
		</ul>
	  </li>
	  
	  <li class="dropdown">
		<a href="http://www.moba-champion.com/articles/" class="dropdown-toggle <?php ActiveText($msSoloQueue); ?>" data-toggle="dropdown"><b>Solo Queue</b><b class="caret"></b></a>
		<ul class="dropdown-menu">
		<li><a href="http://www.moba-champion.com/tierlist" <?php ActiveClass($msTierList); ?>><b>Tier List</b></a></li>
		<li><a href="http://www.moba-champion.com/counterpicks" <?php ActiveClass($msCounterPicks); ?>><b>Counterpicks</b></a></li>
		</ul>
	  </li>
      
     <li class="dropdown">
		<a href="http://www.moba-champion.com/theorycrafting" class="dropdown-toggle <?php ActiveText($msTheorycrafting); ?>" data-toggle="dropdown"><b>Theorycrafting</b><b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li><a href="http://www.moba-champion.com/loadouts" <?php ActiveClass($msLoadouts); ?>><b>Loadout Editor</b></a></li>
			<li><a href="http://www.moba-champion.com/theorycrafting/itembuilder.php" <?php ActiveClass($msItemBuilder); ?>><b>Item Builder</b></a></li>
			<li><a href="http://www.moba-champion.com/theorycrafting/quickcalculator.php" <?php ActiveClass($msQuickCalculator); ?>><b>Vim Calculator (Basic)</b></a></li>			
			<li><a href="http://www.moba-champion.com/theorycrafting/vimcrafting.php" <?php ActiveClass($msVimCrafting); ?>><b>Vim Calculator (Advanced)</b></a></li>
			<li><a href="http://www.moba-champion.com/items/efficiency.php" <?php ActiveClass($msItemEfficiency); ?>><b>Item Vim Efficiency</b></a></li>
		</ul>			
	  </li>      
	  
	 <li class="dropdown">
		<a href="http://www.moba-champion.com/community" class="dropdown-toggle <?php ActiveText($msCommunity); ?>" data-toggle="dropdown"><b>Community</b> <b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li><a href="http://www.moba-champion.com/forum" <?php ActiveClass($msForum); ?>><b>Forum</b></a></li>
			<li><a href="http://www.moba-champion.com/streams" <?php ActiveClass($msStreams); ?>><b>Live Streams</b></a></li>			
			<li><a href="http://www.moba-champion.com/contests" <?php ActiveClass($msContests); ?>><b>Contests</b></a></li>
			<li><a href="http://www.moba-champion.com/orangetracker" <?php ActiveClass($msOrangeTracker); ?>><b>Orange Tracker</b></a></li>
			<li><a href="http://www.moba-champion.com/gamemodes" <?php ActiveClass($msGameModes); ?>><b>Custom Game Modes</b></a></li>
			<li><a href="http://www.moba-champion.com/pickem" <?php ActiveClass($msPickem); ?>><b>Pick'em</b></a></li>
		</ul>			
	  </li>
	  
	 <li class="dropdown moba-nav-ender">
		<a href="http://www.moba-champion.com/tournaments" class="dropdown-toggle disabled <?php ActiveText($msTournaments); ?>" data-toggle="dropdown"><b>Tournaments </b><b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li><a href="http://www.moba-champion.com/tournaments/teams.php" <?php ActiveClass($msTeams); ?>><b>Teams</b></a></li>
		</ul>			
	  </li>
		  	  
	</ul>
	
  <div class="server_status">

<?php        
	include('serverstatus.php');
?>  
  </div>

  </div>
  
</div>

</div> <!-- header_navbar -->

</div>
