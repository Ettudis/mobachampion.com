<?php
$usePerksEditorCSS = true;
$moba_champ_title = 'MOBA-Champion - Loadout Editor';
$moba_champ_desc = 'test';
include('../header.php');
$loadout = $_GET["l"]
?>

<script src="js/loadouts.js?v=3"></script>

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">
<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Test</div></div></div>
<div class="news_content">

<div class="article_news">

<ul>
<li style="background-color: #1c1c1c"><span class="powertext">+10</span> Power</li>
<li style="background-color: #1c1c1c"><span class="hastetext">+10</span> Haste</li>
<li style="background-color: #1c1c1c"><span class="healthtext">+10</span> Health</li>
<li style="background-color: #1c1c1c"><span class="armortext">+10</span> Armor</li>
<li style="background-color: #1c1c1c"><span class="mrtext">+10</span> Magic Resistance</li>
<li style="background-color: #1c1c1c"><span class="lifedraintext">+10%</span> Lifedrain</li>
<li style="background-color: #1c1c1c"><span class="misctext">+10</span> Misc</li>
</ul>

</div>
</div> <!-- news content -->
</div> <!-- news post -->
</div> <!-- article_content-->

<div class="article_column2">
<?php 

if ($user_info['is_admin'])
{	
	echo '<div class="mobawidget">
		<div class="widget_header">
			<div class="widget_header_text">Debug</div>	
		</div>
		
		<div class="widget_debug_rows" style="color: white;">
			<script>
				function UpdateDebugRows()
				{
					$(".widget_debug_rows").empty();
					
					var html = "";
					
					for (i = 0; i < 4 ; i++)
					{
						for (j = 0; j < 4; j++)
						{
							html += shapes[i][j];
						}
						
						html += "<BR>";
					}
					
					$(".widget_debug_rows").html(html);
				}
			</script>
		</div>
	</div>';
}
else
{
echo'
<script>
	function UpdateDebugRows()
	{
	
	}
</script>';
}

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
