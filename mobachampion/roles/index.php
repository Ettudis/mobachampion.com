<?php
$moba_champ_title = 'Roles - MOBA-Champion.com';
$moba_champ_desc = 'A comprehensive list of Roles from Dawngate';
$msRoles = true;
$msGameInfo = true;
include('../header.php');
?>


<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Roles</div></div></div>
<div class="news_content">


<div class="article_news">

<table>

<?php
	$roleData = file_get_contents('../data/roledata.json');
	$roleDataJSON = json_decode($roleData);
	echo '<div class="item_group">';	
	foreach ($roleDataJSON as $role_entry)
	{
		echo '<div class="new_ability_row"  id="' . $role_entry->name . '">';
		echo '<div class="new_spell_summary_desc">';
		
			// img
			echo '<div class="new_spell_header">';
				echo '<div class="new_spell_header_img">';
					echo '<img src="' . $role_entry->icon . '" class="img-rounded roletip" title="' . $role_entry->name . '">';
				echo '</div>';	
				
				echo '<div class="new_spell_header_text2">';
					// name					
					echo '<p class="bold_text orange_text">' . $role_entry->name . '</p>';
					// speciality
					echo '<p><b>Speciality: </b>' . $role_entry->simple . '</p>';					
				echo '</div>';
								
			echo '</div>';
			
			// summary				
			echo '<p>' . $role_entry->desc . '</p>';				
				
		echo '</div>'; // new_spell_summary_desc
		echo '</div>'; // new_ability_row
	}
	echo '</div>';
?>
	
</table>
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
