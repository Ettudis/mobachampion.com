<?php 
require('rb/rb.php');
require('rb/connect.php');
require_once('db.php');
?>

<!DOCTYPE HTML>
<HTML>
<!-- MAIN INDEX -->
<head>

<?php
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
?>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="Dawngate, Waystone, Shapers, Moba, Moba-Champion, Amarynth, Cerulean, Desecrator, Dibs, Fenmore, Freia, Kel, Mikella, Moya, Nissa, Raina, Renzo, Salous, Varion, Vex, Voluc, Zalgus, Zeri">
  <meta property="og:image" content="http://www.moba-champion.com/images/twitter.png" />
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/css/main.css?v=49" />
  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/css/stats.css?v=49" />
  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/guides/guidesv2.css?v=49" />
  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/css/bootstrap.css?v=49">
  <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css">
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/css/tooltipster.css" />
  
  <link rel="shortcut icon" href="http://www.moba-champion.com/images/icon.ico">
  
</head>

<body class="mainbody">

<?php include_once("analytics.php") ?>

<script src="http://code.jquery.com/jquery.js"></script>
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
</script>

<script type="text/javascript" src="http://www.moba-champion.com/js/itemtooltips.js?v=1"></script>
<script type="text/javascript" src="http://www.moba-champion.com/js/itempaloozatooltips.js?v=1"></script>
<script type="text/javascript" src="http://www.moba-champion.com/js/spelltooltips.js?v=1"></script>
<script type="text/javascript" src="http://www.moba-champion.com/js/roletooltips.js?v=1"></script>
<script type="text/javascript" src="http://www.moba-champion.com/js/shapertooltips.js?v=1"></script>
<script type="text/javascript" src="http://www.moba-champion.com/js/jquery.tooltipster.js?v=1"></script>
<script type="text/javascript" src="http://www.moba-champion.com/js/bootstrap.js?v=1"></script>

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

	<script>
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

<div id="header_navbar">  
<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <div class="container">
 	
	<ul class="nav">
	  <li><a href="http://www.moba-champion.com/"><b>Home</b></a></li>
	  
<?php
if ($context['user']['is_logged'] == true)
{
  echo '<li class="dropdown">
		<a href="http://www.moba-champion.com/guides" class="dropdown-toggle disabled" data-toggle="dropdown"><b>Guides</b><b class="caret"></b></a>
		<ul class="dropdown-menu">
		<li><a href="http://www.moba-champion.com/guides/list.php?author=' . $context['user']['name'] . '"><b>My Guides</b></a></li>
		<li><a href="http://www.moba-champion.com/guides/editor.php"><b>Create a Guide</b></a></li>
		</ul>			
	  </li>';
}
else
{
	echo '<li><a href="http://www.moba-champion.com/guides"><b>Guides</b></a></li>';
}
?>
			
	  <li class="dropdown">
		<a href="http://www.moba-champion.com/gameinfo" class="dropdown-toggle" data-toggle="dropdown"><b>Game Info</b><b class="caret"></b></a>
		<ul class="dropdown-menu">
		<li><a href="http://www.moba-champion.com/shapers"><b>Shapers</b></a></li>
        <li><a href="http://www.moba-champion.com/items"><b>Items</b></a></li>
		<li><a href="http://www.moba-champion.com/spells"><b>Spells</b></a></li>
		<li><a href="http://www.moba-champion.com/roles"><b>Roles</b></a></li>
		<li><a href="http://www.moba-champion.com/map"><b>Map</b></a></li>
		<li><a href="http://www.moba-champion.com/patch"><b>Patch History</b></a></li>
		</ul>			
	  </li>	  
	  
	  <li class="dropdown">
		<a href="http://www.moba-champion.com/articles/" class="dropdown-toggle" data-toggle="dropdown"><b>Lore</b><b class="caret"></b></a>
		<ul class="dropdown-menu">
		<li><a href="http://www.moba-champion.com/lore/"><b>Quick Lore</b></a></li>
		<li><a href="http://www.moba-champion.com/lore/timeline.php"><b>Lore Timeline</b></a></li>
		</ul>
	  </li>
	  
	  <li class="dropdown">
		<a href="http://www.moba-champion.com/articles/" class="dropdown-toggle" data-toggle="dropdown"><b>Solo Queue</b><b class="caret"></b></a>
		<ul class="dropdown-menu">
		<li><a href="http://www.moba-champion.com/tierlist"><b>Tier List</b></a></li>
		<li><a href="http://www.moba-champion.com/counterpicks"><b>Counterpicks</b></a></li>
		</ul>
	  </li>
           
     <li class="dropdown">
		<a href="http://www.moba-champion.com/theorycrafting" class="dropdown-toggle" data-toggle="dropdown"><b>Theorycrafting</b><b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li><a href="http://www.moba-champion.com/loadouts"><b>Loadout Editor</b></a></li>
			<li><a href="http://www.moba-champion.com/theorycrafting/itembuilder.php"><b>Item Builder</b></a></li>
			<li><a href="http://www.moba-champion.com/theorycrafting/quickcalculator.php"><b>Vim Calculator (Basic)</b></a></li>			
			<li><a href="http://www.moba-champion.com/theorycrafting/vimcrafting.php"><b>Vim Calculator (Advanced)</b></a></li>
			<li><a href="http://www.moba-champion.com/items/efficiency.php"><b>Item Vim Efficiency</b></a></li>
		</ul>			
	  </li>     
	  
	 <li class="dropdown">
		<a href="http://www.moba-champion.com/community" class="dropdown-toggle" data-toggle="dropdown"><b>Community</b> <!--<font color="#DAA520"><i class="icon-exclamation-sign"></i> NEW </font>--><b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li><a href="http://www.moba-champion.com/forum"><b>Forum</b></a></li>
			<li><a href="http://www.moba-champion.com/streams"><b>Live Streams</b></a></li>			
			<li><a href="http://www.moba-champion.com/contests"><b>Contests</b></a></li>
			<li><a href="http://www.moba-champion.com/orangetracker"><b>Orange Tracker</b></a></li>
			<li><a href="http://www.moba-champion.com/gamemodes"><b>Custom Game Modes</b></a></li>
			<li><a href="http://www.moba-champion.com/pickem"><b>Pick'em</b></a></li>
		</ul>			
	  </li>
	  
	 <li class="dropdown moba-nav-ender">
		<a href="http://www.moba-champion.com/tournaments" class="dropdown-toggle disabled" data-toggle="dropdown"><b>Tournaments</b><b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li><a href="http://www.moba-champion.com/tournaments/teams.php"><b>Teams</b></a></li>
		</ul>			
	  </li>
	  
	</ul>
	
	<script>
	$(document).ready(function() 
	{	
		$('.inner').each(function()
		{
			$(this).html($(this).html().split("!JUMP!").join(""));
		});

		var url = window.location.pathname;
		if(url.substr(-1) == '/') 
		{
			url = url.substr(0, url.length - 1);
		}		
		
		var activePage = url.substring(url.lastIndexOf('/')+1);
		$('.nav li a').each(function()
		{  	
			var currentPage = this.href.substring(this.href.lastIndexOf('/')+1);
			
			if (activePage == currentPage) 
			{
				$(this).parent().addClass('active'); 
			}
			
			// extra checks for tools or item shop
			if ((activePage == 'itemshop' && currentPage == 'tools') || (activePage == 'streambrowser' && currentPage == 'tools'))
			{
				$(this).parent().addClass('active'); 
			}
			
			// extra checks for shapers
			if (url.indexOf("shaper") !== -1 && currentPage == 'shapers' && url.indexOf("counterpick") == -1)
			{
				$(this).parent().addClass('active'); 
			}
			
			// extra checks for counterpick
			if (currentPage == 'counterpicks' && url.indexOf("counterpick") !== -1)
			{
				$(this).parent().addClass('active'); 
			}			
			
			// guides
			if ((window.location.pathname.indexOf("/guides/") !== -1 && currentPage == 'guides'))
			{
				$(this).parent().addClass('active'); 
			}
			
			// news
			if ((window.location.pathname.indexOf("/news/") !== -1 && currentPage == ''))
			{
				$(this).parent().addClass('active'); 
			}
			
			// forum
			if ((window.location.pathname.indexOf("/forum/") !== -1 && currentPage == 'forum'))
			{
				$(this).parent().addClass('active'); 
			}				
			
			// extra checks for community
			if ((window.location.pathname.indexOf("forum/") !== -1 && currentPage == 'community') || (url.indexOf("streams") !== -1 && currentPage == 'community') || 
				(url.indexOf("contests") !== -1 && currentPage == 'community') || (url.indexOf("orangetracker") !== -1 && currentPage == 'community'))
			{
				$(this).parent().addClass('active');
			}		
            
            // extra checks for theorycrafting
    		if (window.location.pathname.indexOf("theorycrafting") !== -1 && currentPage == 'theorycrafting')
			{
				$(this).parent().addClass('active');
			}
            
            // extra checks for tournaments
        	if (window.location.pathname.indexOf("tournament") !== -1 && currentPage == 'tournaments')
			{
				$(this).parent().addClass('active');
			} 
			
			// extra checks for game info
			if ((window.location.pathname.indexOf("items/") !== -1 && currentPage == 'gameinfo') || (url.indexOf("spells") !== -1 && currentPage == 'gameinfo') || 
				(url.indexOf("map") !== -1 && currentPage == 'gameinfo') || (url.indexOf("roles") !== -1 && currentPage == 'gameinfo') || 
				(url.indexOf("loadouts") !== -1 && currentPage == 'gameinfo') || (url.indexOf("shapers") !== -1 && currentPage == 'gameinfo'))
			{
				$(this).parent().addClass('active');
			}
		});	
	});
	</script>	
 
 	
  <div class="server_status">
<?php        
	include('serverstatus.php');
?>  
  </div>
  
    </div>
  </div>
</div>
</div> <!-- header_navbar -->

</div>
