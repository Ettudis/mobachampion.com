<?php
include('../header.php');
?>

<link rel="stylesheet" type="text/css" href="theorycrafting.css" />
<script type="text/javascript" src="vimcalculator.js"></script>

<script>
			document.title="MOBA-Champion - Morat's Advanced Vim Calculator";
</script>

<div id="main_container">
    <div class="article_content">
	
		<!-- TODO: Finish writing instructions -->
		<div class="news_post" id="vimInstructionPost">
		<div class="news_header_uncollapsed" id="vimInstructionHeader" onclick="toggleVisibility('vimInstruction')"><div class="news_header_text"><div class="news_title">Morat's Advanced Vim Calculator</div></div></div>
		<div class="news_content" id="vimInstructionContent" style="display: block">

		<div class="article_news">

		This vim calculator is an advanced tool for determining, based on your role, how much vim you will earn performing certain actions. For a less complicated version of the tool, try the <a href="http://www.moba-champion.com/theorycrafting/quickcalculator.php"target="_blank">basic version</a>.
		<br/><br/>
		To get started, click 'Add New Calculation' and choose one of the four roles.
		<br/><br/>
		You may then use the 'add income source' option and select from a variety of possible income types. Mouse over the help icons <i class='icon-question-sign vim_help_icon' title='Information and tips appear like this!'></i> for additional information.
		<br/><br/>
		I would also suggest watching the <a href="http://www.youtube.com/watch?v=ZSAGd-MvW1E" target="_blank">video tutorial</a> if you are new to the tool.
		<br/><br/>
		<i>
		Last Updated: November 25, 2013<br/>
		Reddit: <a href="http://www.reddit.com/user/MightyMorat" target="_blank">/u/MightyMorat</a><br/>
		Twitter: <a href="https://twitter.com/MoratPOG" target="_blank">@MoratPOG</a>
		</i>		
		
		</div>

		</div> <!-- news content -->
		</div> <!-- news post -->

		<script>
			$('.vim_help_icon').tooltipster();
		</script>
	
		<div id="CalculationsContainer">
			<!-- Calculations will appear in here -->
		</div>
		
		<div class="news_post_collapsed">
		<div class="news_header_collapsed" onClick="addNewCalculation();"><div class="news_header_text"><div class="news_title">Add New Calculation</div></div></div>
		</div> <!-- news post -->	
  
		<div class="popupbox" id="popupID">
		<div class="popup_header"><div class="news_title" id="PopupTitle" style="">Popup Title</div></div>
		<div class="popup_content" id="PopupContent">
		</div>
		<div class="popup_buttons">
			<button type="button" id="SaveButton">Save</button>&nbsp;<button type="button" onClick="hidePopup();">Cancel</button>
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
