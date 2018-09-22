<?php
include('../header.php');
?>

<script src="https://mindmup.s3.amazonaws.com/lib/jquery.hotkeys.js"></script>
<script src="bootstrap-wysiwyg.js"></script>
<script src="guidecreation.js"></script>

<div id="main_container">

<div class="article_content">

<div class="news_post ">

<?php
$id = $_GET['id'];
$guide = R::findOne('guide', ' id = ? ',array($id));

$loggedinAuthor = "testtesttesttest";
if ($context['user']['is_logged'] == true)
{
    $loggedinAuthor = $context['user']['name'];
}

if (is_null($guide))
{
	echo '<div class="news_header"><div class="news_header_text"><div class="news_title">404 Guide Not Found</div></div></div>
	<div class="news_content">';

	echo '<div class="article_news">';
	
	echo '<p style="margin-left: 16px;">Oops! We couldn\'t find the guide you have requested!</p>';
}
else if ($guide->privacy == 'Private' && $guide->author != $loggedinAuthor)
{
	echo '<div class="news_header"><div class="news_header_text"><div class="news_title">404 Guide Not Found</div></div></div>
	<div class="news_content">';

	echo '<div class="article_news">';
	
	echo '<p style="margin-left: 16px;">Sorry, this guide is private.</p>';
}
else
{
    global $theShaper, $theShaperSmall;
	global $psaP, $psaQ, $psaW, $psaE, $psaR;
	
    $shaperData = file_get_contents('../data/shaperdata.json');
    $shaperDataJSON = json_decode($shaperData);
    $shaperIndex = 0;
	$theShaper = $guide->shaper;
    $theShaperSmall = strtolower($theShaper);
    
    foreach ($shaperDataJSON as $shaper_entry)
    {
        if ($shaper_entry->name == $theShaper)
        {
		    break;
	    }
	
    	$shaperIndex++;
    }

    $theShaperData = $shaperDataJSON[$shaperIndex];
	$psaP = $theShaperData->skill_p;
	$psaQ = $theShaperData->skill_q;
	$psaW = $theShaperData->skill_w;
	$psaE = $theShaperData->skill_e;
	$psaR = $theShaperData->skill_r;

	echo '<div class="news_header "><div class="news_header_text "><div class="news_title ">' . $guide->archtype . ' ' . $shaper_entry->name . ' Guide by ' . $guide->author . '</div></div></div>
	<div class="news_content ">';
		
	if ($guide->author == $context['user']['username'])
	{
		echo '<div><p><a href="http://www.moba-champion.com/guides/edit.php?id=' . $guide->id . '">
		<button class="btn btn-primary" type="button">Edit Guide</button></a>
		</p></div>';
	}
	
	echo '<div class="guide_display_full">';
	
	echo '<div class="guide_display_fancy_section" style="background-image:url(\'http://www.moba-champion.com/images/shapers/' . strtolower($shaper_entry->name) . '/header.jpg\');">';

	echo '<div class="guide_display_header_content"><p class="guide_header_bigtext">' . $guide->title . '</p></div>';
	
	$name = $context['user']['username'];

	echo '</div>';
    	
	echo '<div class="guide_display_section">';
	echo '<div class="guide_display_section_header">';
	echo 'Role - ' . $guide->role;
	echo '</div>';
	echo '<div class="guide_display_section_content role_content">';
	echo '<p><img src="http://www.moba-champion.com/images/roles/' . strtolower($guide->role) . '.png" class="roletip" title="' . $guide->role . '"></p>';
	echo '<p>' . parseCode($guide->roleText) ;
	echo '</p>';
	echo '</div>';
	echo '</div>';
	if ($guide->loadouturl != "")
	{		echo '<div class="guide_display_section">';
		echo '<div class="guide_display_section_header">';

		echo 'Loadout - <i class="icon-share icon-white"></i> View in <a href="'. $guide->loadouturl . '">Loadout Editor</a>';
		echo '</div>';
		
		echo '<div class="guide_display_section_content loadout_content">';
		echo '<p>' . parseCode($guide->loadoutText) ;
		echo '</p>';
		echo '</div>';
		echo '</div>';	}
	echo '<div class="guide_display_section">';
	echo '<div class="guide_display_section_header">';
	echo 'Spells';
	echo '</div>';
	echo '<div class="guide_display_section_content spell_content">';
	echo '<p><table class="guide_display_spell_table">';
	echo '<tr><td>Level 1</td><td>Level 10</td><td>Level 20</td></tr>';
	echo '<tr><td><img src="http://www.moba-champion.com/images/spells/Spell_' . $guide->spell1 . '.png" class="spelltip" title="' . $guide->spell1 . '"></td>
			<td><img src="http://www.moba-champion.com/images/spells/Spell_' . $guide->spell2 . '.png" class="spelltip" title="' . $guide->spell2 . '"></td>
			<td><img src="http://www.moba-champion.com/images/spells/Spell_' . $guide->spell3 . '.png" class="spelltip" title="' . $guide->spell3 . '"></td></tr>';
	echo '</table></p>';
	echo '<p>' . parseCode($guide->spellText) . '</p>';
	echo '</div>';
	echo '</div>';
    
    echo '<div class="guide_display_section">';
    echo '<div class="guide_display_section_header guide_special_rounded_header">';
	echo 'Abilities <div class="ability_toggler">[+]</div>';
	echo '</div>';
	echo '<div class="guide_display_section_content ability_desc_content" style="display:none">';
    $abilityKeys = array("p", "q", "w", "e", "r" );
    foreach ($abilityKeys as $abilityKey)
    {
		$nameKey = "skill_" . $abilityKey;
		$descKey = "desc_" . $abilityKey;
		$videoKey = "video_" . $abilityKey;
		$imgKey = "thumb_" . $abilityKey;
		$rangeKey = "range_" . $abilityKey;
		$cdKey = "cd_" . $abilityKey;
		
		echo '<div class="shaper_ability_row">
				<div class="shaper_ability_row_c1"><img src="http://www.moba-champion.com/images/shapers/' . $theShaperSmall . '/' . $abilityKey . '.png">';
		
		if ($abilityKey != "p")
		{
			echo '<div class="shaper_ability_row_key">' . strtoupper ($abilityKey) . '</div>';
		}
		else
		{
			echo '<div class="shaper_ability_row_key">Passive</div>';
		}
		
		echo '</div>';
		
		echo '  <div class="shaper_ability_row_c2">';
		echo   '<div class="shaper_ability_row_c2_header">' . $theShaperData->$nameKey . '</div>';
		echo   '<div class="shaper_ability_row_c2_ability">' . $theShaperData->$descKey . '</div>';
		if ($abilityKey != "p")
		{		
			echo '<div class="ability_costs">
						<table>
						<tr><td>Range:</td>		<td>' . $theShaperData->$rangeKey . '</td></tr>
						<tr><td>Cooldown:</td>	<td>' . $theShaperData->$cdKey . '</td></tr>
						</table>
					</div>';
		}				
		echo '</div>';
		echo  '<div class="shaper_ability_row_c3">';
		if ($theShaperData->$videoKey != "")
		{
			echo '<img src="' . $theShaperData->$imgKey . '">';
			echo '<div class="shaper_ability_row_c3_text"><i class="icon-play"></i></div>';
			echo '<div class="shaper_ability_row_c3_overlay overlay_' . $abilityKey . '"></div>';
		}
		echo '</div></div>';
		
		// create hidden frame
		echo '<div class="shaper_ability_hidden guide_hidden video_' . $abilityKey . '">';
		echo '<div class="shaper_ability_hidden_bg">';
		echo '</div>';
		echo '<div class="shaper_ability_hidden_video">';
			echo '<iframe width="560" height="315" src="' . $theShaperData->$videoKey . '" frameborder="0" allowfullscreen></iframe>';
			echo '<div class="shaper_video_close"><i class="icon-remove"> </i> Close</div>';
		echo '</div>';
		echo '</div>';		
	}
	echo '</div>';
	echo '</div>';  
    
    echo '<script>';
    echo '$(".ability_toggler").click(function() 
          {
            $(".ability_desc_content").toggle();
            if ($(".ability_desc_content").is(":visible"))
            {
                $(this).html("[-]");
            }
            else
            {
                $(this).html("[+]");
            }
          });   ';
    echo '</script>';
	
	echo '<div class="guide_display_section">';
	echo '<div class="guide_display_section_header">';
	echo 'Skill Order';
	echo '</div>';
	echo '<div class="guide_display_section_content item_content">';
	
	echo '<div class="guide_skill_order">
		<div class="guide_skill_row guide_skill_header">
			<div class="guide_skill_hcol"><span>Key</span></div>
			<div class="guide_skill_hcol"><span>Skill</span></div>
			<div class="guide_skill_hcol"><span>1</span></div>
			<div class="guide_skill_hcol"><span>2</span></div>
			<div class="guide_skill_hcol"><span>3</span></div>
			<div class="guide_skill_hcol"><span>4</span></div>
			<div class="guide_skill_hcol"><span>5</span></div>
			<div class="guide_skill_hcol"><span>6</span></div>
			<div class="guide_skill_hcol"><span>7</span></div>
			<div class="guide_skill_hcol"><span>8</span></div>
			<div class="guide_skill_hcol"><span>9</span></div>
			<div class="guide_skill_hcol"><span>11</span></div>
			<div class="guide_skill_hcol"><span>12</span></div>
			<div class="guide_skill_hcol"><span>13</span></div>
			<div class="guide_skill_hcol"><span>14</span></div>
			<div class="guide_skill_hcol"><span>15</span></div>
			<div class="guide_skill_hcol"><span>16</span></div>
			<div class="guide_skill_hcol"><span>17</span></div>			
			<div class="guide_skill_hcol"><span>18</span></div>
			<div class="guide_skill_hcolnb"><span>19</span></div>
		</div>
		<div class="guide_skill_row guide_skill_header_q">
			<div class="guide_skill_col">Q</div>
			<div class="guide_skill_col">
			<img src="http://www.moba-champion.com/images/shapers/' . $theShaperSmall . '/q.png" class="image32small abilitytip" title="' . $psaQ . '" data-shaper="' . $theShaper . '">
			</div>';
			
			for ($i = 0; $i < 17; $i++)
			{
				if ($guide->skillPoints[$i] == 'q') {
					echo '<div class="guide_skill_col"><span><i class="icon-ok"></i></span></div>'; }
				else {
					echo '<div class="guide_skill_col"><span></span></div>'; }			
			}
			
			if ($guide->skillPoints[17] == 'q') {
				echo '<div class="guide_skill_colnb"><span><i class="icon-ok"></i></span></div>'; }
			else {
				echo '<div class="guide_skill_colnb"><span></span></div>'; }			

		echo '</div>';
		
		echo '<div class="guide_skill_row guide_skill_header_w">
			<div class="guide_skill_col">W</div>
			<div class="guide_skill_col">
			<img src="http://www.moba-champion.com/images/shapers/' . $theShaperSmall . '/w.png" class="image32small abilitytip" title="' . $psaW . '" data-shaper="' . $theShaper . '">
			</div>';
			
			for ($i = 0; $i < 17; $i++)
			{
				if ($guide->skillPoints[$i] == 'w') {
					echo '<div class="guide_skill_col"><span><i class="icon-ok"></i></span></div>'; }
				else {
					echo '<div class="guide_skill_col"><span></span></div>'; }			
			}
			
			if ($guide->skillPoints[17] == 'w') {
				echo '<div class="guide_skill_colnb"><span><i class="icon-ok"></i></span></div>'; }
			else {
				echo '<div class="guide_skill_colnb"><span></span></div>'; }				
			
		echo '</div>';
		echo '<div class="guide_skill_row guide_skill_header_e">
					<div class="guide_skill_col">E</div>
			<div class="guide_skill_col">
			<img src="http://www.moba-champion.com/images/shapers/' . $theShaperSmall . '/e.png" class="image32small abilitytip" title="' . $psaE . '" data-shaper="' . $theShaper . '">
			</div>';

			for ($i = 0; $i < 17; $i++)
			{
				if ($guide->skillPoints[$i] == 'e') {
					echo '<div class="guide_skill_col"><span><i class="icon-ok"></i></span></div>'; }
				else {
					echo '<div class="guide_skill_col"><span></span></div>'; }			
			}
			
			if ($guide->skillPoints[17] == 'e') {
				echo '<div class="guide_skill_colnb"><span><i class="icon-ok"></i></span></div>'; }
			else {
				echo '<div class="guide_skill_colnb"><span></span></div>'; }				
			
		echo '</div>';
		echo '<div class="guide_skill_row guide_skill_header_r">
					<div class="guide_skill_col">R</div>
			<div class="guide_skill_col">
			<img src="http://www.moba-champion.com/images/shapers/' . $theShaperSmall . '/r.png" class="image32small abilitytip" title="' . $psaR . '" data-shaper="' . $theShaper . '">
			</div>';

			for ($i = 0; $i < 17; $i++)
			{
				if ($guide->skillPoints[$i] == 'r') {
					echo '<div class="guide_skill_col"><span><i class="icon-ok"></i></span></div>'; }
				else {
					echo '<div class="guide_skill_col"><span></span></div>'; }			
			}
			
			if ($guide->skillPoints[17] == 'r') {
				echo '<div class="guide_skill_colnb"><span><i class="icon-ok"></i></span></div>'; }
			else {
				echo '<div class="guide_skill_colnb"><span></span></div>'; }			
			
	echo '</div></div>';	
	
	echo '<p>' . parseCode($guide->skillText) ;
	echo '</p>';
	echo '</div>';
	echo '</div>';
	
	echo '<div class="guide_display_section">';
	echo '<div class="guide_display_section_header">';
	echo 'Items';
	echo '</div>';
	echo '<div class="guide_display_section_content role_content">';
		
	echo '<h5>Starting Items</h5>';
	echo '<p><table class="guide_display_item_table">';	
	echo '<tr>';
	if (!empty($guide->starting1))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->starting1 . '.png" class="mobatip" title="' . $guide->starting1 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->starting2))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->starting2 . '.png" class="mobatip" title="' . $guide->starting2 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->starting3))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->starting3 . '.png" class="mobatip" title="' . $guide->starting3 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->starting4))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->starting4 . '.png" class="mobatip" title="' . $guide->starting4 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->starting5))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->starting5 . '.png" class="mobatip" title="' . $guide->starting5 . '"></td>';
	else
		echo '<td></td>';		
	echo '</tr>';
	echo '</table></p>';	
	
	echo '<h5>Core Items</h5>';
	echo '<p><table class="guide_display_item_table">';	
	echo '<tr>';
	if (!empty($guide->core1))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->core1 . '.png" class="mobatip" title="' . $guide->core1 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->core2))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->core2 . '.png" class="mobatip" title="' . $guide->core2 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->core3))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->core3 . '.png" class="mobatip" title="' . $guide->core3 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->core4))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->core4 . '.png" class="mobatip" title="' . $guide->core4 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->core5))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->core5 . '.png" class="mobatip" title="' . $guide->core5 . '"></td>';
	else
		echo '<td></td>';		
	echo '</tr>';
	echo '</table></p>';	
	
	echo '<h5>Offensive Items</h5>';
	echo '<p><table class="guide_display_item_table">';	
	echo '<tr>';
	if (!empty($guide->offensive1))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->offensive1 . '.png" class="mobatip" title="' . $guide->offensive1 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->offensive2))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->offensive2 . '.png" class="mobatip" title="' . $guide->offensive2 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->offensive3))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->offensive3 . '.png" class="mobatip" title="' . $guide->offensive3 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->offensive4))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->offensive4 . '.png" class="mobatip" title="' . $guide->offensive4 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->offensive5))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->offensive5 . '.png" class="mobatip" title="' . $guide->offensive5 . '"></td>';
	else
		echo '<td></td>';		
	echo '</tr>';
	echo '</table></p>';	
	
	echo '<h5>Defensive Items</h5>';
	echo '<p><table class="guide_display_item_table">';	
	echo '<tr>';
	if (!empty($guide->defensive1))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->defensive1 . '.png" class="mobatip" title="' . $guide->defensive1 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->defensive2))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->defensive2 . '.png" class="mobatip" title="' . $guide->defensive2 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->defensive3))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->defensive3 . '.png" class="mobatip" title="' . $guide->defensive3 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->defensive4))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->defensive4 . '.png" class="mobatip" title="' . $guide->defensive4 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->defensive5))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->defensive5 . '.png" class="mobatip" title="' . $guide->defensive5 . '"></td>';
	else
		echo '<td></td>';		
	echo '</tr>';
	echo '</table></p>';	
	
	echo '<h5>Situational Items</h5>';
	echo '<p><table class="guide_display_item_table">';	
	echo '<tr>';
	if (!empty($guide->situational1))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->situational1 . '.png" class="mobatip" title="' . $guide->situational1 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->situational2))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->situational2 . '.png" class="mobatip" title="' . $guide->situational2 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->situational3))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->situational3 . '.png" class="mobatip" title="' . $guide->situational3 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->situational4))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->situational4 . '.png" class="mobatip" title="' . $guide->situational4 . '"></td>';
	else
		echo '<td></td>';
	if (!empty($guide->situational5))
		echo '<td><img src="http://www.moba-champion.com/images/items/list/' . $guide->situational5 . '.png" class="mobatip" title="' . $guide->situational5 . '"></td>';
	else
		echo '<td></td>';		
	echo '</tr>';	
	echo '</table></p>';	
	
	echo '<p>' . parseCode($guide->itemText) ;
	echo '</p>';
	echo '</div>';
	echo '</div>';
	
	echo '<div class="guide_display_section">';
	echo '<div class="guide_display_section_header">';
	echo 'Content';
	echo '</div>';
	echo '<div class="guide_display_section_content role_content">';
	echo '<p>' . parseCode($guide->contentText) ;
	echo '</p>';
	echo '</div>';
	echo '</div>';	
	
	echo '</div>';
	
	echo '<div class="article_news">';
	
	echo '<script>';	
	echo 'var comment_topic = ' . $id . ';';
	echo '</script>';
	
	echo '<script src="guidecomments.js"></script>';
	
	$startPage = $_GET['page'];
	if (!isset($startPage))
	{
		$startPage = 0;
	}
	
	$postsPerPage = 10;
		
	$commentSQL = 'SELECT 
				*
			FROM
				guidecomment
			WHERE guidecomment.guide_id = "' . $id . '" LIMIT ' . $startPage . ', ' . $postsPerPage;

	$commentData = R::getAll($commentSQL);
	$comments = R::convertToBeans('guidecomment',$commentData);
	$numComments = R::count('guidecomment',' guide_id = :guideid', array(':guideid'=>$id));
	$numButtons = ceil($numComments / $postsPerPage);
	
	if ($numComments > 0)
	{		
		echo '<div class="news_comment_header">';
		echo '<div class="news_comment_h3">Comments</div>';
			
		echo '<div class="news_comment_buttons">';
		echo '<div class="btn-toolbar">';
		
		for ($i = 1; $i <= $numButtons; $i++) 
		{
			echo '<div class="btn-group">';
			echo '<a href="http://www.moba-champion.com/guides/display.php?id=' . $id . '&page=' . ($i-1) .'"><button>';
			echo $i;
			echo '</button></a>';
			echo '</div>';
		}

		echo '</div>'; // button toolbar
		echo '</div>'; // button right floater
		echo '</div>'; // comment header
	}	
	
	echo '<div class="news_comment_section">';
	
	// comment creation
	if ($context['user']['is_logged'] == true)
	{  
	  echo '<div class="news_comment">';
		echo '<div class="news_comment_post">';
		  echo '<div class="news_comment_post_left">';
			echo 'Comment: ';
		  echo '</div>';
		  echo '<div class="news_comment_post_right">';
			echo '<div class="news_comment_post_right_text">';
			  echo '<textarea rows="4" cols="150" maxlength="400" class="news_comment_input" onfocus="if (this.value == \'Comment...\') 
							{
								this.value = \'\';
							}" 
					onblur="if (this.value == \'\') 
							{
								this.value = \'Comment...\';
							}" autocomplete="off"/>Comment...</textarea>';
			echo '</div>';
			echo '<div class="news_comment_post_right_button">';
			  echo '<button class="btn btn-primary" id="comment_button">Post Comment</button>';
			  echo '<span class="news_comment_post_chars_remaining"> 400 characters remaining.</span>';
			echo '</div>';
		  echo '</div>';
		echo '</div>';
	  echo '</div>'; // news_comment
	}
	
	if ($numComments > 0)
	{				
		foreach ($comments as $comment)
		{
		  // comment writing
		  echo '<div class="news_comment">';
			  echo '<div class="news_comment_post_left">';
				echo $comment->user;
			  echo '</div>';
			  echo '<div class="news_comment_right">';
				echo '<div class="news_comment_body">';
					echo $comment->commentText;
				echo '</div>';
			  echo '</div>';
		  echo '</div>'; // news_comment
		}	  
		
    } // numPosts > 0
	
	echo '</div>'; // news_comment_section	
}

function afterLower($txt)
{
	$outStr = "";
	
	foreach($txt as $value)
	{
		$outStr += strtolower('<img src="http://www.moba-champion.com/images/shapers/' . $value . '.png" class="shapertip" title="' . $value . '"></img>');
	}
	
	return $outStr;
}

function parseCode($txt)
{
   // these functions will clean the code first
   $ret = $txt;
    
   // img replacements
   $ret = preg_replace('#\[img\](.+)\[\/img\]#iUs', '<img src="$1" class="guide_default"></img>', $ret);
   
   // youtube
   $ret = preg_replace('#\[youtube\](.+)\[\/youtube\]#iUs', '<iframe width="420" height="315" src="$1" frameborder="0" allowfullscreen></iframe>', $ret);
   $ret = str_replace('watch?v=', 'embed/', $ret);
   
   // abilities
   global $theShaper, $theShaperSmall;
   global $psaP, $psaQ, $psaW, $psaE, $psaR;
	
   $ret = str_replace('[p]', '<img src="http://www.moba-champion.com/images/shapers/' . $theShaperSmall . '/p.png" class="image32small abilitytip" title="' . $psaP . '" data-shaper="' . $theShaper . '"> <span class="orange_text abilitytip" title="' . $psaP . '">' . $psaP . '</span>', $ret);
   $ret = str_replace('[q]', '<img src="http://www.moba-champion.com/images/shapers/' . $theShaperSmall . '/q.png" class="image32small abilitytip" title="' . $psaQ . '" data-shaper="' . $theShaper . '"> <span class="orange_text abilitytip" title="' . $psaQ . '">' . $psaQ . '</span>', $ret);
   $ret = str_replace('[w]', '<img src="http://www.moba-champion.com/images/shapers/' . $theShaperSmall . '/w.png" class="image32small abilitytip" title="' . $psaW . '" data-shaper="' . $theShaper . '"> <span class="orange_text abilitytip" title="' . $psaW . '">' . $psaW . '</span>', $ret);
   $ret = str_replace('[e]', '<img src="http://www.moba-champion.com/images/shapers/' . $theShaperSmall . '/e.png" class="image32small abilitytip" title="' . $psaE . '" data-shaper="' . $theShaper . '"> <span class="orange_text abilitytip" title="' . $psaE . '">' . $psaE . '</span>', $ret);
   $ret = str_replace('[r]', '<img src="http://www.moba-champion.com/images/shapers/' . $theShaperSmall . '/r.png" class="image32small abilitytip" title="' . $psaR . '" data-shaper="' . $theShaper . '"> <span class="orange_text abilitytip" title="' . $psaR . '">' . $psaR . '</span>', $ret);

   // spells
   $ret = preg_replace('#\[spell\](.+)\[\/spell\]#iUs', '<img src="http://www.moba-champion.com/images/spells/Spell_$1_1.png" class="image32small spelltip" title="$1"> <span class="orange_text spelltip" title="$1">$1</span>', $ret);
   
   // items
   $ret = preg_replace('#\[item\](.+)\[\/item\]#iUs', '<img src="http://www.moba-champion.com/images/items/list/$1.png" class="image32small mobatip" title="$1"></img> <span class="orange_text mobatip" title="$1">$1</span>', $ret);
   
   // roles
   $ret = preg_replace_callback ('#\[role\](.+)\[\/role\]#iUs', function ($matches) 
			{
				return '<img src="http://www.moba-champion.com/images/roles/' . strtolower($matches[1]) . '.png" class="image32small roletip" title="' . $matches[1] . '"></img> <span class="orange_text roletip" title="' . $matches[1] . '">' . $matches[1] . '</span>';
			}, $ret);
			
   //shapers
   $ret = preg_replace_callback ('#\[shaper\](.+)\[\/shaper\]#iUs', function ($matches) 
			{
				return '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($matches[1]) . '.png" class="image32small shapertip" title="' . $matches[1] . '"></img> <span class="orange_text shapertip" title="' . $matches[1] . '">' . $matches[1] . '</span>';
			}, $ret);
   
   // return parsed string
   return $ret;
}
?>

<script>
$(".news_comment_input").bind("keyup", function(event, ui) 
{                          
	// Write your code here
	var numRemaining = 400 - $(this).val().length;
	if (numRemaining < 25)
	{
		$(".news_comment_post_chars_remaining").html("<font color=\"red\"> " + numRemaining + " characters remaining.</font>");
	}
	else if (numRemaining < 5)
	{
		$(".news_comment_post_chars_remaining").html("<font color=\"yellow\"> " + numRemaining + " characters remaining.</font>");
	}
	else
	{
		$(".news_comment_post_chars_remaining").html(" " + numRemaining + " characters remaining.");
	}
	
	if ($(this).val() != "" && $(this).val() != "Comment...")
	{
		$(this).css('border', 'none');
	}
});
</script>

</div>

</div> <!-- news -->
</div> <!-- content -->

<?php
include('../widgets/adwidget2.php');
?>
</div>

<div class="article_column2">
<?php 
include('../widgets/tournamentwidget.php');
include('../widgets/guidewidget.php');
include('../widgets/adwidget.php');
include('../widgets/shaperguidewidget.php');
include('../widgets/streamwidget.php');
?>
</div>

</div>

</div> <!-- main container -->
</div> <!-- maincontent -->

<?php
include('../footer.php');
?>
