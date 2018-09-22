<?php
include('../header.php');
?>

<script src="https://mindmup.s3.amazonaws.com/lib/jquery.hotkeys.js"></script>
<script src="bootstrap-wysiwyg.js"></script>
<script src="guidecreation.js?v=1"></script>

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post extra-wide-guide">
<div class="news_header extra-wide-guide"><div class="news_header_text extra-wide-content-guide"><div class="news_title extra-wide-content-guide">Create a Guide</div></div></div>
<div class="news_content extra-wide-content-guide">

<div class="article_news">

<?php
if ($context['user']['is_logged'] == false)
{
	echo '<p>You must be logged in to create a guide. Please log in or <a href="http://moba-champion.com/forum/index.php?action=register">Register</a>.</p>';
	echo '</div> <!-- news -->
	</div> <!-- content -->

	<div class="guide_item_picker_window guide_hidden">
	<div class="guide_item_background"></div>
	<div class="guide_item_picker">
		<div class="guide_item_close"><i class="icon-remove"> </i> Close</div>
	</div>
	</div>

		</div></div>
	
	</div> <!-- main container -->
	</div> <!-- maincontent -->';

	include('../footer.php');
	exit(0);
}
?>

<div class="guides_create_master">

<div class="guide_create_main_header">

<div class="guide_create_header">

<div class="guide_create_info">
	<div class="guide_create_info_left">Title:</div>
	<div class="guide_create_info_right">
		<input class="guide_create_info_title" type="shaper" name="guidetitle">	
	</div>
</div>

<div class="guide_create_info">
	<div class="guide_create_info_left">Shaper:</div>
	<div class="guide_create_info_right">
		<select class="guide_info_shaper">
			<option value="all">Select a Shaper...</option>
			<option value="all">Amarynth</option>
			<option value="all">Cerulean</option>
			<option value="all">Desecrator</option>
			<option value="all">Dibs</option>
			<option value="all">Faris</option>
			<option value="all">Fenmore</option>
			<option value="all">Freia</option>
			<option value="all">Kel</option>
			<option value="all">Kindra</option>
            <option value="all">King of Masks</option>
			<option value="all">Marah</option>
			<option value="all">Mikella</option>
			<option value="all">Moya</option>
			<option value="all">Nissa</option>
			<option value="all">Petrus</option>
            <option value="all">Raina</option>
            <option value="all">Renzo</option>
            <option value="all">Salous</option>
			<option value="all">Varion</option>
			<option value="all">Vex</option>
            <option value="all">Viyana</option>
			<option value="all">Voluc</option>
            <option value="all">Zalgus</option>
			<option value="all">Zeri</option>
		</select>	
	</div>
</div>

<div class="guide_create_info">
	<div class="guide_create_info_left">Lane:</div>
	<div class="guide_create_info_right">
		<select class="guide_info_lane">
			<option value="all">Select a Lane...</option>
			<option value="all">Solo Lane</option>
			<option value="all">Duo Lane</option>
			<option value="all">Triple Lane</option>
			<option value="all">Jungle</option>
		</select>		
	</div>
</div>

</div> <!-- guide header -->

<div class="guide_create_header_right">
<h5>The following macro types are available:</h5>
<p><b>Ability Icons:</b> [p], [q], [w], [e], [r]</p>
<p><b>Shapers:</b> [shaper]Amarynth[/shaper]</p>
<p><b>Spells:</b> [spell]Blink[/spell]</p>
<p><b>Items:</b> [item]Destruction[/item]</p>
<p><b>Roles:</b> [role]Gladiator[/role]</p>
<p><b>Images:</b> [img]www.imgur.com/example[/img]</p>
<p><b>Youtube:</b></p>
<p>[youtube]http://www.youtube.com/example/[/youtube]</p>
</div>

</div>

<div class="guide_section_list">

<div class="guide_section" data-index="1">
	<div class="guide_section_header">
		<div class="guide_section_header_text">
			Role
		</div>
		<div class="guide_section_header_icon">
			<i class="icon-edit icon-white"></i>
		</div>
	</div>
	
	<div class="guide_role_selector">
		<select class="guide_info_role">
			<option value="all">Select a Role...</option>
			<option value="all">Gladiator</option>
			<option value="all">Tactician</option>
			<option value="all">Predator</option>
			<option value="all">Hunter</option>
		</select>	
	</div>
</div>

<div class="guide_section" data-index="2">
	<div class="guide_section_header">
		<div class="guide_section_header_text">
			Loadout
		</div>
		<div class="guide_section_header_icon">
			<i class="icon-edit icon-white"></i>
		</div>
	</div>
	<div class="guide_role_selector">
		<div>
			<p>Create a Loadout using our <a href="http://www.moba-champion.com/loadouts/" target="_blank">Loadout Editor</a> and click SHARE to generate a URL to paste into the Guide.</p>
		</div>
		<div>Loadout:</div>
		<input class="guide_create_info_loadout_url" type="shaper" name="loadouturl">
	</div>	
</div>

<div class="guide_section" data-index="3">
	<div class="guide_section_header">
		<div class="guide_section_header_text">
			Skill Order
		</div>
		<div class="guide_section_header_icon">
			<i class="icon-edit icon-white"></i>
		</div>
	</div>
	
	<div class="guide_skill_order" style="margin-left: 16px;">
		<div class="guide_skill_row guide_skill_header">
			<div class="guide_skill_hcol"><span>Slot</span></div>
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
			<div class="guide_skill_col"><span>Q</span></div>
			<div class="guide_skill_col skillCol" data-button="q" data-index="1"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="q" data-index="2"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="q" data-index="3"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="q" data-index="4"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="q" data-index="5"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="q" data-index="6"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="q" data-index="7"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="q" data-index="8"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="q" data-index="9"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="q" data-index="10"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="q" data-index="11"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="q" data-index="12"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="q" data-index="13"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="q" data-index="14"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="q" data-index="15"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="q" data-index="16"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="q" data-index="17"><span></span></div>
			<div class="guide_skill_colnb skillCol" data-button="q" data-index="18"><span></span></div>
		</div>
		<div class="guide_skill_row guide_skill_header_w">
			<div class="guide_skill_col"><span>W</span></div>
			<div class="guide_skill_col skillCol" data-button="w" data-index="1"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="w" data-index="2"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="w" data-index="3"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="w" data-index="4"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="w" data-index="5"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="w" data-index="6"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="w" data-index="7"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="w" data-index="8"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="w" data-index="9"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="w" data-index="10"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="w" data-index="11"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="w" data-index="12"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="w" data-index="13"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="w" data-index="14"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="w" data-index="15"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="w" data-index="16"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="w" data-index="17"><span></span></div>
			<div class="guide_skill_colnb skillCol" data-button="w" data-index="18"><span></span></div>
		</div>
		<div class="guide_skill_row guide_skill_header_e">
			<div class="guide_skill_col"><span>E</span></div>
			<div class="guide_skill_col skillCol" data-button="e" data-index="1"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="e" data-index="2"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="e" data-index="3"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="e" data-index="4"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="e" data-index="5"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="e" data-index="6"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="e" data-index="7"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="e" data-index="8"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="e" data-index="9"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="e" data-index="10"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="e" data-index="11"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="e" data-index="12"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="e" data-index="13"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="e" data-index="14"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="e" data-index="15"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="e" data-index="16"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="e" data-index="17"><span></span></div>
			<div class="guide_skill_colnb skillCol" data-button="e" data-index="18"><span></span></div>
		</div>
		<div class="guide_skill_row guide_skill_header_r">
			<div class="guide_skill_col"><span>R</span></div>
			<div class="guide_skill_col skillCol" data-button="r" data-index="1"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="r" data-index="2"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="r" data-index="3"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="r" data-index="4"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="r" data-index="5"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="r" data-index="6"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="r" data-index="7"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="r" data-index="8"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="r" data-index="9"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="r" data-index="10"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="r" data-index="11"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="r" data-index="12"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="r" data-index="13"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="r" data-index="14"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="r" data-index="15"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="r" data-index="16"><span></span></div>
			<div class="guide_skill_col skillCol" data-button="r" data-index="17"><span></span></div>
			<div class="guide_skill_colnb skillCol" data-button="r" data-index="18"><span></span></div>
		</div>				
	</div>	
	<div id="guide_skill_order_desc">* Spells, instead of skill points, are awarded at levels 10 and 20. Select your spells in the "Spells" section.</div>
</div>

<div class="guide_section" data-index="4">
	<div class="guide_section_header">
		<div class="guide_section_header_text">
			Spells
		</div>
		<div class="guide_section_header_icon">
			<i class="icon-edit icon-white"></i>
		</div>
	</div>
	
	<div class="guide_role_selector">	
		<select class="guide_info_spell1">
			<option value="all">Select Spell #1...</option>
			<option value="all">Bastion</option>
			<option value="all">Blink</option>
            <option value="all">Blitz</option>
			<option value="all">Deflect</option>
			<option value="Dispel">Dispel</option>
			<option value="Drain">Drain</option>
			<option value="all">Exceed</option>
			<option value="Stagger">Stagger</option>
			<option value="all">Stasis</option>
			<option value="all">Tailwind</option>
			<option value="all">Vanquish</option>
			<option value="all">Wither</option>
		</select>
		
		<select class="guide_info_spell2">
			<option value="all">Select Spell #2...</option>
			<option value="all">Bastion</option>
			<option value="all">Blink</option>
            <option value="all">Blitz</option>
			<option value="all">Deflect</option>
			<option value="Dispel">Dispel</option>
			<option value="Drain">Drain</option>
			<option value="all">Exceed</option>
			<option value="Stagger">Stagger</option>
			<option value="all">Stasis</option>
			<option value="all">Tailwind</option>
			<option value="all">Vanquish</option>
			<option value="all">Wither</option>
		</select>

		<select class="guide_info_spell3">
			<option value="all">Select Spell #3...</option>
			<option value="all">Bastion</option>			
			<option value="all">Blink</option>
            <option value="all">Blitz</option>
			<option value="all">Deflect</option>
			<option value="Dispel">Dispel</option>
			<option value="Drain">Drain</option>
			<option value="all">Exceed</option>
			<option value="Stagger">Stagger</option>
			<option value="all">Stasis</option>
			<option value="all">Tailwind</option>
			<option value="all">Vanquish</option>
			<option value="all">Wither</option>
		</select>
	</div>
</div>

<div class="guide_section" data-index="5">
	<div class="guide_section_header">
		<div class="guide_section_header_text">
			Items
		</div>
		<div class="guide_section_header_icon">
			<i class="icon-edit icon-white"></i>
		</div>
	</div>
		
	<div class="guide_item_selector">
		<div class="guide_item_category">
			<div class="guide_item_category_title">Starting Items</div>
			<div class="guide_item_category_list" data-itemttype="starting">
				<div class="guide_item_entry starting_button" data-itemttype="starting">
					<span><i class="icon-plus"></i></span>
				</div>
			</div>
		</div>
		
		<div class="guide_item_category">
			<div class="guide_item_category_title">Core Items</div>
			<div class="guide_item_category_list" data-itemttype="core">
				<div class="guide_item_entry core_button" data-itemttype="core">
					<span><i class="icon-plus"></i></span>
				</div>	
			</div>
		</div>

		<div class="guide_item_category">
			<div class="guide_item_category_title">Offensive Items</div>
			<div class="guide_item_category_list" data-itemttype="offense">
				<div class="guide_item_entry offense_button" data-itemttype="offense">
					<span><i class="icon-plus"></i></span>
				</div>			
			</div>
		</div>
		
		<div class="guide_item_category">
			<div class="guide_item_category_title">Defensive Items</div>
			<div class="guide_item_category_list" data-itemttype="defense">
				<div class="guide_item_entry defense_button" data-itemttype="defense">
					<span><i class="icon-plus"></i></span>
				</div>			
			</div>
		</div>
		
		<div class="guide_item_category">
			<div class="guide_item_category_title">Situational Items</div>
			<div class="guide_item_category_list" data-itemttype="situational">
				<div class="guide_item_entry situational_button" data-itemttype="situational">
					<span><i class="icon-plus"></i></span>
				</div>			
			</div>
		</div>		
		
	</div>
</div>

<div class="guide_section" data-index="6">
	<div class="guide_section_header">
		<div class="guide_section_header_text">
			Content
		</div>
		<div class="guide_section_header_icon">
			<i class="icon-edit icon-white"></i>
		</div>
	</div>
</div>

<div class="guide_save_section">
	<div class="guide_section_header">
		<div class="guide_section_header_text">
			Save Guide
		</div>
	</div>
	
	<div class="guide_savey_selector input-append">
		<select class="guide_savey_privacy round_override">
			<option value="Public">Public</option>
			<option value="Private">Private</option>			
		</select>
		<button class="btn round_override" id="save_button">Save</button>
	</div>
	
	<div class="guide_savey_output">
		
	</div>
</div>

</div> <!-- guide_sections -->
</div> <!-- guides_create_master -->

</div> <!-- news -->
</div> <!-- content -->

<div class="guide_item_picker_window guide_hidden">
	<div class="guide_item_background"></div>
	<div class="guide_item_picker">
		<div class="guide_item_close"><i class="icon-remove"> </i> Close</div>
	</div>
</div>

</div></div>

</div> <!-- main container -->
</div> <!-- maincontent -->

<?php
include('../footer.php');
?>
