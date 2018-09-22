<?php 
require_once('../forum/SSI.php');
?>

<?php
$moba_champ_title = 'Spells - MOBA-Champion.com';
$moba_champ_desc = 'A comprehensive list of spells from Dawngate';
$msSpells = true;
$msGameInfo = true;
include('../header.php');
?>

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Spells</div></div></div>
<div class="news_content">

<p>
During gameplay, spells can be selected from the Spellbook. They are unlocked at levels 1, 10, and 20, and can be unlearned for 400 vim.
</p>
		
<?php
	echo '<div class="item_group">';
	
	$spellData = file_get_contents('../data/spelldata.json');
	$spellDataJSON = json_decode($spellData);
	
	foreach ($spellDataJSON as $spell_entry)
	{
		echo '<div class="new_ability_row"  id="' . $item_entry->name . '">';
		echo '<div class="new_spell_summary_desc">';
		
			// img
			echo '<div class="new_spell_header">';
				echo '<div class="new_spell_header_img">';
					echo '<img src="' . $spell_entry->icon . '" class="img-rounded spelltip" title="' . $spell_entry->name . '">';
				echo '</div>';	
				
				echo '<div class="new_spell_header_text2">';
					// name					
					echo '<p class="bold_text orange_text">' . $spell_entry->name . '</p>';		
					// cd
					echo '<p><b>Cooldown: </b>' . $spell_entry->cooldown . '</p>';
				echo '</div>';
								
			echo '</div>';
			
			// summary				
			echo '<p>' . $spell_entry->desc . '</p>';				
				
		echo '</div>'; // new_spell_summary_desc
		echo '</div>'; // new_ability_row
	}
	
    echo '</div>'; // item_group
?>

</div> <!-- news_content -->
</div> <!-- news_post -->
</div> <!-- article_content -->

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
