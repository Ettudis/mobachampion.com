<?php
include('../header.php');
?>

<link rel="stylesheet" type="text/css" href="theorycrafting.css" />
<script type="text/javascript" src="quickcalculator.js"></script>

<script>
			document.title="MOBA-Champion - Morat's Basic Vim Calculator";
</script>

<div id="main_container">
    <div class="article_content">
	
		<div class="news_post" id="vimInstructionPost">
		<div class="news_header_uncollapsed" id="vimInstructionHeader" onclick="toggleVisibility('vimInstruction')"><div class="news_header_text"><div class="news_title">Morat's Basic Vim Calculator</div></div></div>
		<div class="news_content" id="vimInstructionContent" style="display: block">

		<div class="article_news">

		This is the basic version of the vim calculator, which is designed to give you an idea of how much vim you will get for playing each of the lane roles.
		<br/><br/>
		To get started, fill in all the information in the User Information section based on how you think you play in the first 10 minutes of the game.
		<br/><br/>
		The results section will then tell you the approximate amount of vim that you would earn in the first 10 minutes of the game as a Gladiator, Tactician or Predator.
		<br/><br/>
		For more detailed calculations, try the <a href="http://www.moba-champion.com/theorycrafting/vimcrafting.php"target="_blank">advanced version</a>.
		
		<br/><br/>
		<i>
		Last Updated: November 25, 2013<br/>
		Reddit: <a href="http://www.reddit.com/user/MightyMorat" target="_blank">/u/MightyMorat</a><br/>
		Twitter: <a href="https://twitter.com/MoratPOG" target="_blank">@MoratPOG</a>
		</i>			
		
		</div>

		</div> <!-- news content -->
		</div> <!-- news post -->	
	
		<div class="news_post">
		<div class="news_header"><div class="news_header_text"><div class="news_title">User Information</div></div></div>
		<div class="news_content">
		
		Time Spent Out of Lane (After Minions Reach Lane and Before 10:00):<br/>
		<input id="TimeOutsideLane" type="range" value="0" min="0" step="1" max="48" onChange="calculateEarnings();"><br/>
		<div id="TimeOutsideDiv"></div>
		<br/>
		Proportion of Minions Last Hit (While in Lane):<br/>
		<input id="LastHits" type="range" value="0" min="0" step="0.01" max="1" onChange="calculateEarnings();"><br/>
		<div id="PercentLastHits"></div>
		<br/>
		Average Length of Gladiator Chain:<br/>
		<input id="GladChain" type="number" value="1" min="1" step="1" onChange="calculateEarnings();"></br>
		<br/>
		Average Number of Seconds Between Harassing the Enemy (While in Lane):<br/>
		<input id="HarassTime" type="number" value="10" min="5" step="1" onChange="calculateEarnings();"></br>
		<br/>
		Number of Kills (Before 10:00):<br/>
		<input id="NumKills" type="number" value="0" min="0" step="1" onChange="calculateEarnings();"></br>
		<br/>
		Number of Assists (Before 10:00):<br/>
		<input id="NumAssists" type="number" value="0" min="0" step="1" onChange="calculateEarnings();"></br>
		<br/>
		Number of Spirit Well Workers Killed (Before 10:00):<br/>
		<input id="NumWorkers" type="number" value="0" min="0" step="1" onChange="calculateEarnings();"></br>
		<br/>
		
		</div> <!-- news content -->
		</div> <!-- news post -->	
	
	
		<div class="news_post">
		<div class="news_header"><div class="news_header_text"><div class="news_title">Results</div></div></div>
		<div class="news_content">

			<div id="ResultsDiv"></div>

		</div> <!-- news content -->
		</div> <!-- news post -->	
	
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