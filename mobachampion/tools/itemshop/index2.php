<?php
include('../../header.php');
?>

<script src="itemshop2.js"></script> <!-- Including our script -->

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post extra-wide">
<div class="news_header extra-wide"><div class="news_header_text extra-wide-content"><div class="news_title extra-wide-content">Item Store Simulator</div></div></div>
<div class="news_content extra-wide-content">

<div class="article_news">

<p>For a full list of items, check out the <a href="http://www.moba-champion.com/items">Item List</a>!
<div id="item_store">

<div id="store_headers">
<div id="store_header1" class="basic_text">Basic Items</div>
<div id="store_header2" class="advanced_text">Advanced Items</div>
<div id="store_header3" class="legendary_text">Legendary Items</div>
<div id="store_header4">Current Selection</div>
<div class="store_current_sel"></div>
<div class="store_current_sel_text"></div>
</div>

<div id="store_spacer"></div>

<div id="item_store_col1">
	<div class="store_row store_item" id="basic1" data-quality="basic" data-index="1" data-summary="+120 Health, +10 Health Regen per 5 seconds" data-passive1="Consume I: When a nearby enemy dies there is a 25% chance that you will be healed for 8 health.">
		<img src="http://www.moba-champion.com/images/items/Basic_Life.png" class="mobatip" title="Life">
		<span class="basic_text">Life</span>
		<span>420</span>
	</div>
	<div class="store_space"></div>
	
	<div class="store_row store_item" id="basic2" data-quality="basic" data-index="2" data-summary="+18 Armor" data-passive1="Toughness I: Reduces the damage taken from basic attacks by 3. The reduction is tripled against shapers.">
		<img src="http://www.moba-champion.com/images/items/Basic_Resilience.png" class="mobatip" title="Resilience">
		<span class="basic_text">Resilience</span>
		<span>380</span>	
	</div>
	<div class="store_space"></div>
	
	<div class="store_row store_item" id="basic3" data-quality="basic" data-index="3" data-summary="+24 Magic Reisstance" data-passive1="Void I: Reduces any magical damage taken by 10.">
		<img src="http://www.moba-champion.com/images/items/Basic_Will.png" class="mobatip" title="Will">
		<span class="basic_text">Will</span>
		<span>350</span>	
	</div>
	<div class="store_space"></div>
	
	<div class="store_row store_item" id="basic4" data-quality="basic" data-index="4" data-summary="+12 Power" data-passive1="">
		<img src="http://www.moba-champion.com/images/items/Basic_Power.png" class="mobatip" title="Power">
		<span class="basic_text">Power</span>
		<span>375</span>	
	</div>		
	<div class="store_space"></div>
	
	<div class="store_row store_item" id="basic5" data-quality="basic" data-index="5" data-summary="+20 Haste" data-passive1="">
		<img src="http://www.moba-champion.com/images/items/Basic_Time.png" class="mobatip" title="Time">
		<span class="basic_text">Time</span>
		<span>460</span>		
	</div>
	<div class="store_space"></div>
	
	<div class="store_row store_item" id="basic6" data-quality="basic" data-index="6" data-summary="Life Leech: Heals a flat amount per damage dealt. The ammount healed is doubled against shapers." data-passive1="">	
		<img src="http://www.moba-champion.com/images/items/Basic_Hunger.png" class="mobatip" title="Hunger">
		<span class="basic_text">Hunger</span>
		<span>420</span>		
	</div>
</div>

<div id="item_store_col2">
	<div class="store_line_row" id="row_gap1">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
	</div>
	<div class="store_line_row" id="row_gap2">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
	<div class="store_line_row" id="row_gap3">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
	<div class="store_line_row" id="row_gap4">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
	<div class="store_line_row" id="row_gap5">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
	<div class="store_line_row" id="row_gap6">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
</div>

<div id="item_store_col3">
	<div class="store_row store_item item_hidden" id="advanced1" data-quality="advanced" data-index="1" >
	
	</div>
	<div class="store_space"></div>
	
	<div class="store_row store_item item_hidden" id="advanced2" data-quality="advanced" data-index="2" >
	
	</div>
	<div class="store_space"></div>
	
	<div class="store_row store_item item_hidden" id="advanced3" data-quality="advanced" data-index="3" >
	
	</div>
	<div class="store_space"></div>
	
	<div class="store_row store_item item_hidden" id="advanced4" data-quality="advanced" data-index="4" >
	
	</div>
	<div class="store_space"></div>
	
	<div class="store_row store_item item_hidden" id="advanced5" data-quality="advanced" data-index="5" >
	
	</div>
	<div class="store_space"></div>
	
	<div class="store_row store_item item_hidden" id="advanced6" data-quality="advanced" data-index="6" >
	
	</div>
</div>

<div id="item_store_col4">
	<div class="store_line_row" id="row_l_gap1">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
	</div>
	<div class="store_line_row" id="row_l_gap2">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
	<div class="store_line_row" id="row_l_gap3">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
	<div class="store_line_row" id="row_l_gap4">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
	<div class="store_line_row" id="row_l_gap5">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
	<div class="store_line_row" id="row_l_gap6">
		<div class="store_line_row_top">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>
		</div>
		<div class="store_line_row_mid">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>
		<div class="store_line_row_bottom">
			<div class="store_line_row_left"> </div>
			<div class="store_line_row_center"> </div>
			<div class="store_line_row_right"> </div>		
		</div>	
	</div>
</div>


<div id="item_store_col5">
	<div class="store_row store_item item_hidden" id="legendary1" data-quality="legendary" data-index="1" ></div>
	<div class="store_space"></div>
	<div class="store_row store_item item_hidden" id="legendary2" data-quality="legendary" data-index="2" ></div>
	<div class="store_space"></div>
	<div class="store_row store_item item_hidden" id="legendary3" data-quality="legendary" data-index="3" ></div>
	<div class="store_space"></div>
	<div class="store_row store_item item_hidden" id="legendary4" data-quality="legendary" data-index="4" ></div>
	<div class="store_space"></div>
	<div class="store_row store_item item_hidden" id="legendary5" data-quality="legendary" data-index="5" ></div>
	<div class="store_space"></div>
	<div class="store_row store_item item_hidden" id="legendary6" data-quality="legendary" data-index="6" ></div>
</div>

</div> <!-- store -->

</div></div>

</div> <!-- news -->
</div> <!-- content -->

</div> <!-- main container -->
</div> <!-- maincontent -->

<?php
include('../../footer.php');
?>
