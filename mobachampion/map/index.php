<?php 
require_once('../forum/SSI.php');
?>

<?php
$moba_champ_title = 'Dawngate Map - MOBA-Champion.com';
$moba_champ_desc = 'Dawngate Map and Jungle Camp Info';
$msGameInfo = true;
$msMap = true;
include('../header.php');
?>

<script src="mapv2.js?v=1"></script>

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Interactive Map</div></div></div>
<div class="news_content">

<div id="dawngate_map2" style="position: relative;width: 790px; height: 800px;background-image:url('http://www.moba-champion.com/map/MapV2.jpg');background-repeat:no-repeat;margin-bottom: 12px;border-radius: 8px;border: 1px solid black;margin-left: 8px;margin-top: 16px;">
<!-- para -->
<div id="para_icon" class="dawngate_map2_icon" style="left:384px; top: 384px; background-image:url('Icons/parasite-icon.png');background-repeat:no-repeat;"></div>
<!-- t1 bindings -->
<div class="t1b_icon dawngate_map2_icon" style="left:210px; top: 347px; background-image:url('Icons/binding-icon.png');background-repeat:no-repeat;"></div>
<div class="t1b_icon dawngate_map2_icon" style="left:338px; top: 214px; background-image:url('Icons/binding-icon.png');background-repeat:no-repeat;"></div>
<div class="t1b_icon dawngate_map2_icon" style="left:430px; top: 559px; background-image:url('Icons/binding-icon.png');background-repeat:no-repeat;"></div>
<div class="t1b_icon dawngate_map2_icon" style="left:559px; top: 427px; background-image:url('Icons/binding-icon.png');background-repeat:no-repeat;"></div>
<!-- t2 bindings -->
<div class="t2b_icon dawngate_map2_icon" style="left:201px; top: 456px; background-image:url('Icons/binding-icon.png');background-repeat:no-repeat;"></div>
<div class="t2b_icon dawngate_map2_icon" style="left:447px; top: 200px; background-image:url('Icons/binding-icon.png');background-repeat:no-repeat;"></div>
<div class="t2b_icon dawngate_map2_icon" style="left:322px; top: 574px; background-image:url('Icons/binding-icon.png');background-repeat:no-repeat;"></div>
<div class="t2b_icon dawngate_map2_icon" style="left:569px; top: 317px; background-image:url('Icons/binding-icon.png');background-repeat:no-repeat;"></div>
<!-- t3 bindings -->
<div class="t3b_icon dawngate_map2_icon" style="left:152px; top: 555px; background-image:url('Icons/binding-icon.png');background-repeat:no-repeat;"></div>
<div class="t3b_icon dawngate_map2_icon" style="left:547px; top: 146px; background-image:url('Icons/binding-icon.png');background-repeat:no-repeat;"></div>
<div class="t3b_icon dawngate_map2_icon" style="left:223px; top: 624px; background-image:url('Icons/binding-icon.png');background-repeat:no-repeat;"></div>
<div class="t3b_icon dawngate_map2_icon" style="left:618px; top: 215px; background-image:url('Icons/binding-icon.png');background-repeat:no-repeat;"></div>
<!-- sw -->
<div class="sw_icon dawngate_map2_icon" style="left:113px; top: 351px; background-image:url('Icons/spiritwell-icon.png');background-repeat:no-repeat;"></div>
<div class="sw_icon dawngate_map2_icon" style="left:340px; top: 115px; background-image:url('Icons/spiritwell-icon.png');background-repeat:no-repeat;"></div>
<div class="sw_icon dawngate_map2_icon" style="left:437px; top: 656px; background-image:url('Icons/spiritwell-icon.png');background-repeat:no-repeat;"></div>
<div class="sw_icon dawngate_map2_icon" style="left:658px; top: 424px; background-image:url('Icons/spiritwell-icon.png');background-repeat:no-repeat;"></div>
<!-- fountain -->
<div class="fountain_icon dawngate_map2_icon" style="left:46px; top: 732px; background-image:url('Icons/fountain-icon.png');background-repeat:no-repeat;"></div>
<div class="fountain_icon dawngate_map2_icon" style="left:719px; top: 36px; background-image:url('Icons/fountain-icon.png');background-repeat:no-repeat;"></div>
<!-- guardian -->
<div class="guardian_icon1 dawngate_map2_icon" style="left:115px; top: 660px; background-image:url('Icons/guardian-icon.png');background-repeat:no-repeat;"></div>
<div class="guardian_icon2 dawngate_map2_icon" style="left:650px; top: 108px; background-image:url('Icons/guardian-icon.png');background-repeat:no-repeat;"></div>
<!-- money pigs -->
<div class="mp_icon dawngate_map2_icon" style="left:120px; top: 170px; background-image:url('Icons/moneypig-icon.png');background-repeat:no-repeat;"></div>
<div class="mp_icon dawngate_map2_icon" style="left:650px; top: 590px; background-image:url('Icons/moneypig-icon.png');background-repeat:no-repeat;"></div>
<!-- blue buff -->
<div class="haste_icon dawngate_map2_icon" style="left:302px; top: 457px; background-image:url('Icons/bluebuff-icon.png');background-repeat:no-repeat;"></div>
<div class="haste_icon dawngate_map2_icon" style="left:455px; top: 300px; background-image:url('Icons/bluebuff-icon.png');background-repeat:no-repeat;"></div>
<!-- green buff -->
<div class="power_icon dawngate_map2_icon" style="left:285px; top: 135px; background-image:url('Icons/greenbuff-icon.png');background-repeat:no-repeat;"></div>
<div class="power_icon dawngate_map2_icon" style="left:490px; top: 620px; background-image:url('Icons/greenbuff-icon.png');background-repeat:no-repeat;"></div>
<!-- orange buff -->
<div class="armor_icon dawngate_map2_icon" style="left:140px; top: 285px; background-image:url('Icons/orangebuff-icon.png');background-repeat:no-repeat;"></div>
<div class="armor_icon dawngate_map2_icon" style="left:635px; top: 482px; background-image:url('Icons/orangebuff-icon.png');background-repeat:no-repeat;"></div>
<!-- fish camps -->
<div class="fish_icon dawngate_map2_icon" style="left:385px; top: 620px; background-image:url('Icons/smallcamp3-icon.png');background-repeat:no-repeat;"></div>
<div class="fish_icon dawngate_map2_icon" style="left:480px; top: 575px; background-image:url('Icons/smallcamp3-icon.png');background-repeat:no-repeat;"></div>
<div class="fish_icon dawngate_map2_icon" style="left:285px; top: 190px; background-image:url('Icons/smallcamp3-icon.png');background-repeat:no-repeat;"></div>
<div class="fish_icon dawngate_map2_icon" style="left:390px; top: 140px; background-image:url('Icons/smallcamp3-icon.png');background-repeat:no-repeat;"></div>
<!-- ugger camps -->
<div class="ugger_icon dawngate_map2_icon" style="left:50px; top: 270px; background-image:url('Icons/smallcamp1-icon.png');background-repeat:no-repeat;"></div>
<div class="ugger_icon dawngate_map2_icon" style="left:130px; top: 400px; background-image:url('Icons/smallcamp1-icon.png');background-repeat:no-repeat;"></div>
<div class="ugger_icon dawngate_map2_icon" style="left:635px; top: 365px; background-image:url('Icons/smallcamp1-icon.png');background-repeat:no-repeat;"></div>
<div class="ugger_icon dawngate_map2_icon" style="left:720px; top: 490px; background-image:url('Icons/smallcamp1-icon.png');background-repeat:no-repeat;"></div>
<!-- shroom camps -->
<div class="shroom_icon dawngate_map2_icon" style="left:285px; top: 380px; background-image:url('Icons/smallcamp2-icon.png');background-repeat:no-repeat;"></div>
<div class="shroom_icon dawngate_map2_icon" style="left:250px; top: 460px; background-image:url('Icons/smallcamp2-icon.png');background-repeat:no-repeat;"></div>
<div class="shroom_icon dawngate_map2_icon" style="left:310px; top: 520px; background-image:url('Icons/smallcamp2-icon.png');background-repeat:no-repeat;"></div>
<div class="shroom_icon dawngate_map2_icon" style="left:460px; top: 250px; background-image:url('Icons/smallcamp2-icon.png');background-repeat:no-repeat;"></div>
<div class="shroom_icon dawngate_map2_icon" style="left:520px; top: 305px; background-image:url('Icons/smallcamp2-icon.png');background-repeat:no-repeat;"></div>
<div class="shroom_icon dawngate_map2_icon" style="left:480px; top: 390px; background-image:url('Icons/smallcamp2-icon.png');background-repeat:no-repeat;"></div>
<!-- core1 -->
<div class="core_icon1 dawngate_map2_icon" style="left:50px; top: 655px; background-image:url('Icons/core.png');background-repeat:no-repeat;"></div>
<div class="core_icon2 dawngate_map2_icon" style="left:95px; top: 600px; background-image:url('Icons/core.png');background-repeat:no-repeat;"></div>
<div class="core_icon3 dawngate_map2_icon" style="left:125px; top: 730px; background-image:url('Icons/core.png');background-repeat:no-repeat;"></div>
<div class="core_icon4 dawngate_map2_icon" style="left:165px; top: 615px; background-image:url('Icons/core.png');background-repeat:no-repeat;"></div>
<div class="core_icon5 dawngate_map2_icon" style="left:185px; top: 685px; background-image:url('Icons/core.png');background-repeat:no-repeat;"></div>
<!-- core2 -->
<div class="core_icon1 dawngate_map2_icon" style="left:720px; top: 115px; background-image:url('Icons/core.png');background-repeat:no-repeat;"></div>
<div class="core_icon2 dawngate_map2_icon" style="left:675px; top: 175px; background-image:url('Icons/core.png');background-repeat:no-repeat;"></div>
<div class="core_icon3 dawngate_map2_icon" style="left:650px; top: 45px; background-image:url('Icons/core.png');background-repeat:no-repeat;"></div>
<div class="core_icon4 dawngate_map2_icon" style="left:605px; top: 160px; background-image:url('Icons/core.png');background-repeat:no-repeat;"></div>
<div class="core_icon5 dawngate_map2_icon" style="left:590px; top: 85px; background-image:url('Icons/core.png');background-repeat:no-repeat;"></div>


</div>

<p>Last Updated: May 4th, 2014</p>
</div>

</div></div>

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
