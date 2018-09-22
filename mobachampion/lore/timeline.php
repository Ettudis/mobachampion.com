<?php
$moba_champ_title = 'Lore - Dawngate - MOBA-Champion.com';
$moba_champ_desc = 'An interactive timeline of the Lore from Dawngate';
$msLore = true;
$msTimeline = true;
include('../header.php');
?>


<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Lore</div></div></div>
<div class="news_content">

<h2 style="margin-top: 10px;margin-bottom: 20px;" id="timeline"><center>Lore Timeline</center></h2>

<div id="lore-timeline" style="position: relative;height:550px;width:810px;">
<div id="moveLeft" class="visarrows"><i class="fa fa-chevron-left"></i></div>
<div id="moveRight" class="visarrows"><i class="fa fa-chevron-right"></i></div>
<div id="timeline_tooltip" style="display: none;"></div>
<div id="timeline_instructions" style="position: absolute;right:0;bottom:-20px;">Use your Mouse Wheel to Zoom In</div>
</div>

<script type="text/javascript" src="http://www.moba-champion.com/js/jquery.tablesorter.js"></script>

<script type="text/javascript">

	var container = document.getElementById('lore-timeline');

	//custom
	var amarynth = document.createElement('img');
	amarynth.src = "http://www.moba-champion.com/images/shapers/amarynth.png";
	amarynth.className = "vis_img_sm";
	amarynth.setAttribute('title', 'Amarynth');
	
	var marah = document.createElement('img');
	marah.src = "http://www.moba-champion.com/images/shapers/marah.png";
	marah.className = "vis_img_sm";
	marah.setAttribute('title', 'Marah');
	
	var faris = document.createElement('img');
	faris.src = "http://www.moba-champion.com/images/shapers/faris.png";
	faris.className = "vis_img_sm";
	faris.setAttribute('title', 'Faris');
	
	var eidolus = document.createElement('img');
	eidolus.src = "http://www.moba-champion.com/images/shapers/eidolus.png";
	eidolus.className = "vis_img_sm";
	eidolus.setAttribute('title', 'Eidolus');
	
	var petrus = document.createElement('img');
	petrus.src = "http://www.moba-champion.com/images/shapers/petrus.png";
	petrus.className = "vis_img_sm";
	petrus.setAttribute('title', 'Petrus');
	
	var viyana = document.createElement('img');
	viyana.src = "http://www.moba-champion.com/images/shapers/viyana.png";
	viyana.className = "vis_img_sm";
	viyana.setAttribute('title', 'Viyana');
	
	var kom = document.createElement('img');
	kom.src = "http://www.moba-champion.com/images/shapers/king of masks.png";
	kom.className = "vis_img_sm";
	kom.setAttribute('title', 'King of Masks');
	
	var mikella = document.createElement('img');
	mikella.src = "http://www.moba-champion.com/images/shapers/mikella.png";
	mikella.className = "vis_img_sm";
	mikella.setAttribute('title', 'Mikella');
	
	var voluc = document.createElement('img');
	voluc.src = "http://www.moba-champion.com/images/shapers/voluc.png";
	voluc.className = "vis_img_sm";
	voluc.setAttribute('title', 'Voluc');
	
	var salous = document.createElement('img');
	salous.src = "http://www.moba-champion.com/images/shapers/salous.png";
	salous.className = "vis_img_sm";
	salous.setAttribute('title', 'Salous');
	
	var fenmore = document.createElement('img');
	fenmore.src = "http://www.moba-champion.com/images/shapers/fenmore.png";
	fenmore.className = "vis_img_sm";
	fenmore.setAttribute('title', 'Fenmore');
	
	var freia = document.createElement('img');
	freia.src = "http://www.moba-champion.com/images/shapers/freia.png";
	freia.className = "vis_img_sm";
	freia.setAttribute('title', 'Freia');
	
	var zalgus = document.createElement('img');
	zalgus.src = "http://www.moba-champion.com/images/shapers/zalgus.png";
	zalgus.className = "vis_img_sm";
	zalgus.setAttribute('title', 'Zalgus');
	
	var raina = document.createElement('img');
	raina.src = "http://www.moba-champion.com/images/shapers/raina.png";
	raina.className = "vis_img_sm";
	raina.setAttribute('title', 'Raina');
	
	var mikella = document.createElement('img');
	mikella.src = "http://www.moba-champion.com/images/shapers/mikella.png";
	mikella.className = "vis_img_sm";
	mikella.setAttribute('title', 'Mikella');
	
	var vex = document.createElement('img');
	vex.src = "http://www.moba-champion.com/images/shapers/vex.png";
	vex.className = "vis_img_sm";
	vex.setAttribute('title', 'Vex');
	
	var renzo = document.createElement('img');
	renzo.src = "http://www.moba-champion.com/images/shapers/renzo.png";
	renzo.className = "vis_img_sm";
	renzo.setAttribute('title', 'Renzo');
	
	var kindra = document.createElement('img');
	kindra.src = "http://www.moba-champion.com/images/shapers/kindra.png";
	kindra.className = "vis_img_sm";
	kindra.setAttribute('title', 'Kindra');
	
	var varion = document.createElement('img');
	varion.src = "http://www.moba-champion.com/images/shapers/varion.png";
	varion.className = "vis_img_sm";
	varion.setAttribute('title', 'Varion');
	
	var viridian = document.createElement('img');
	viridian.src = "http://www.moba-champion.com/images/shapers/viridian.png";
	viridian.className = "vis_img_sm";
	viridian.setAttribute('title', 'Viridian');
	
	var kensu = document.createElement('img');
	kensu.src = "http://www.moba-champion.com/images/shapers/kensu.png";
	kensu.className = "vis_img_sm";
	kensu.setAttribute('title', 'Kensu');
	
	var mina = document.createElement('img');
	mina.src = "http://www.moba-champion.com/images/shapers/mina.png";
	mina.className = "vis_img_sm";
	mina.setAttribute('title', 'Mina');
	
	var kahgen = document.createElement('img');
	kahgen.src = "http://www.moba-champion.com/images/shapers/kahgen.png";
	kahgen.className = "vis_img_sm";
	kahgen.setAttribute('title', 'Kahgen');
	
	var ashabel = document.createElement('img');
	ashabel.src = "http://www.moba-champion.com/images/shapers/ashabel.png";
	ashabel.className = "vis_img_sm";
	ashabel.setAttribute('title', 'Ashabel');
	
	var kel = document.createElement('img');
	kel.src = "http://www.moba-champion.com/images/shapers/kel.png";
	kel.className = "vis_img_sm";
	kel.setAttribute('title', 'Kel');
	
	var nissa = document.createElement('img');
	nissa.src = "http://www.moba-champion.com/images/shapers/nissa.png";
	nissa.className = "vis_img_sm";
	nissa.setAttribute('title', 'Nissa');
	
	var dibs = document.createElement('img');
	dibs.src = "http://www.moba-champion.com/images/shapers/dibs.png";
	dibs.className = "vis_img_sm";
	dibs.setAttribute('title', 'Dibs');
	
	var dawngate = document.createElement('img');
	dawngate.src = "http://www.moba-champion.com/images/dawngate.png";
	dawngate.className = "vis_img_sm";
	dawngate.setAttribute('title', 'The Dawngate Opens');
	
	var zeri = document.createElement('img');
	zeri.src = "http://www.moba-champion.com/images/shapers/zeri.png";
	zeri.className = "vis_img_sm";
	zeri.setAttribute('title', 'Zeri');
		
	var desecrator = document.createElement('img');
	desecrator.src = "http://www.moba-champion.com/images/shapers/desecrator.png";
	desecrator.className = "vis_img_sm";
	desecrator.setAttribute('title', 'Desecrator');
	
	var anzerani = document.createElement('img');
	anzerani.src = "http://www.moba-champion.com/images/shapers/anzerani.png";
	anzerani.className = "vis_img_sm";
	anzerani.setAttribute('title', 'Duke Anzerani');
	
	var sereyn = document.createElement('img');
	sereyn.src = "http://www.moba-champion.com/images/shapers/sereyn.png";
	sereyn.className = "vis_img_sm";
	sereyn.setAttribute('title', 'Queen Sereyn');
	
	var basko = document.createElement('img');
	basko.src = "http://www.moba-champion.com/images/shapers/basko.png";
	basko.className = "vis_img_sm";
	basko.setAttribute('title', 'Basko');
	
	// hybrids
	var eidolusanzeranimikella = document.createElement('div');
	$(eidolusanzeranimikella).append($(eidolus).clone());
	$(eidolusanzeranimikella).append($(anzerani).clone());
	$(eidolusanzeranimikella).append($(mikella).clone());
	
	var eidolusmikella = document.createElement('div');
	$(eidolusmikella).append($(eidolus).clone());
	$(eidolusmikella).append($(mikella).clone());
	
	var eidolusvoluc = document.createElement('div');
	$(eidolusvoluc).append($(eidolus).clone());
	$(eidolusvoluc).append($(voluc).clone());
	
	var eidoluspetrus = document.createElement('div');
	$(eidoluspetrus).append($(eidolus).clone());
	$(eidoluspetrus).append($(petrus).clone());
	
	var desecratorpetrus = document.createElement('div');
	$(desecratorpetrus).append($(desecrator).clone());
	$(desecratorpetrus).append($(petrus).clone());
	
	var rainazalgus = document.createElement('div');
	$(rainazalgus).append($(raina).clone());
	$(rainazalgus).append($(zalgus).clone());
	
	var rainazalguskindra = document.createElement('div');
	$(rainazalguskindra).append($(raina).clone());
	$(rainazalguskindra).append($(zalgus).clone());
	$(rainazalguskindra).append($(kindra).clone());
	
	var rainazalgussereyn = document.createElement('div');
	$(rainazalgussereyn).append($(raina).clone());
	$(rainazalgussereyn).append($(zalgus).clone());
	$(rainazalgussereyn).append($(sereyn).clone());
	
	var fenmorefreia = document.createElement('div');
	$(fenmorefreia).append($(fenmore).clone());
	$(fenmorefreia).append($(freia).clone());
	
	var varionanzeranipetrusmikella = document.createElement('div');
	$(varionanzeranipetrusmikella).append($(varion).clone());
	$(varionanzeranipetrusmikella).append($(anzerani).clone());
	$(varionanzeranipetrusmikella).append($(mikella).clone());
	$(varionanzeranipetrusmikella).append($(petrus).clone());
	
	var fenmoresereyn = document.createElement('div');
	$(fenmoresereyn).append($(fenmore).clone());
	$(fenmoresereyn).append($(sereyn).clone());
	
	var fenmorekindra = document.createElement('div');
	$(fenmorekindra).append($(fenmore).clone());
	$(fenmorekindra).append($(kindra).clone());
	
	var fenmorefreia = document.createElement('div');
	$(fenmorefreia).append($(fenmore).clone());
	$(fenmorefreia).append($(freia).clone());
	
	var nissadibs = document.createElement('div');
	$(nissadibs).append($(nissa).clone());
	$(nissadibs).append($(dibs).clone());
	
	var kindrafenmore = document.createElement('div');
	$(kindrafenmore).append($(kindra).clone());
	$(kindrafenmore).append($(fenmore).clone());
	
	var fenmorefreianissakindra = document.createElement('div');
	$(fenmorefreianissakindra).append($(freia).clone());
	$(fenmorefreianissakindra).append($(fenmore).clone());
	$(fenmorefreianissakindra).append($(kindra).clone());
	$(fenmorefreianissakindra).append($(nissa).clone());
	
	var renzozerikom = document.createElement('div');
	$(renzozerikom).append($(kom).clone());
	$(renzozerikom).append($(zeri).clone());
	$(renzozerikom).append($(renzo).clone());
	
	var renzozerikahgen = document.createElement('div');
	$(renzozerikahgen).append($(kom).clone());
	$(renzozerikahgen).append($(zeri).clone());
	$(renzozerikahgen).append($(kahgen).clone());
	
	var mikellavex = document.createElement('div');
	$(mikellavex).append($(mikella).clone());
	$(mikellavex).append($(vex).clone());
	
	// Create a DataSet (allows two way data-binding)
	var items = new vis.DataSet([
  
<?php
	function DGtoReal($d)
	{
		$str = $d;
		// Janviar_Fevriar_Markkun_Aprelle_Mai_Junil_Gillai_Augente_Heptaver_Oberta_Navamara_Decerta
		$str = str_replace('Janviar ', '01-', $str);
		$str = str_replace('Fevriar ', '02-', $str);
		$str = str_replace('Markkun ', '03-', $str);
		$str = str_replace('Aprelle ', '04-', $str);
		$str = str_replace('Mai ', '05-', $str);
		$str = str_replace('Junil ', '06-', $str);
		$str = str_replace('Gillai ', '07-', $str);
		$str = str_replace('Augente ', '08-', $str);
		$str = str_replace('Heptaver ', '09-', $str);
		$str = str_replace('Oberta ', '10-', $str);
		$str = str_replace('Navamara ', '11-', $str);
		$str = str_replace('Decerta ', '12-', $str);
		$str = str_replace(',', '-', $str);
		$str = str_replace('The Beginning', '01-01-1000', $str);
		$str = str_replace('N/A', '01-01-1000', $str);
		return $str;
	}
	
	$loreData = file_get_contents('loretimeline.json');
	$loreDataJSON = json_decode($loreData);
	$i = 0;
	foreach ($loreDataJSON as $lore)
	{
		if ($lore->date == "The Beginning" || $lore->date == "N/A")
		{
			$i++;
			continue;
		}
		
		$theDate = DGtoReal($lore->date);
		$theDateExp = explode("-", $theDate);
		$year = $theDateExp[2];
		$month = $theDateExp[0];
		$day = $theDateExp[1];
		
		if (strlen($month) == 1)
		{
			$month = '0' . $month;
		}
		
		if (strlen($day) == 1)
		{
			$day = '0' . $day;
		}
		
		$dFormat = $year . '-' . $month . '-' . $day;
		
		$plural = "";
		if (strpos($lore->tags, ',') !== FALSE)
		{
			$plural = "s";
		}
		
		$characters = str_replace(",", ", ", $lore->tags);
		
		$links = explode(",", $lore->link);
		$linkHtml = "";
		$linkit = 0;
		$numLinks = count($links);
		for ($linkit = 0; $linkit < $numLinks; $linkit++)
		{
			$newLink = '<a href="' . $links[$linkit] . '" target="_blank">Link</a>';
			if ($linkit < ($numLinks-1))
			{
				$newLink .= ' ';
			}
			
			$linkHtml .= $newLink;
		}
		
		if ($lore->title != "")
		{
			$tooltip = '<h4><center> ' . $lore->title . '</center></h4><b>Character' . $plural . ':</b><BR> ' . $characters . '<BR><BR>' . $linkHtml;
		}
		else
		{
			$tooltip = '<h4><center> ' . $lore->name . '</center></h4><b>Character' . $plural . ':</b><BR> ' . $characters . '<BR><BR>' . $linkHtml;
		}
		
		if ($lore->content != "")
		{
			echo '{id: ' . $i . ', content: $(' . $lore->content . ').clone()[0], start: "' . $dFormat . '", tt: \'' . $tooltip . '\' },' . PHP_EOL;
		}
		else
		{
			echo '{id: ' . $i . ', content: "' . $lore->name . '", start: "' . $dFormat . '", tt: \'' . $tooltip . '\' },' . PHP_EOL;
		}
		
		$i++;
	}
?>

	]);

	// Configuration for the Timeline
	var options = 
	{
		min: '1515-01-01',
		max: '1550-01-01',
		start: '1515-01-01',
		end: '1550-01-01',
		height: 550
	};

	var timeline = new vis.Timeline(container, items, options);
	
	function ActivateOverlay(selItem)
	{
		if (typeof selItem === 'undefined')
		{
			$("#timeline_tooltip").html("");
			$("#timeline_tooltip").hide();
		}
		else
		{
			$("#timeline_tooltip").html(items._data[selItem].tt);
			$("#timeline_tooltip").show();
		}
		console.log(selItem);
		console.log(items._data[selItem]);
	}
	
	timeline.on('select', function (properties) 
	{
		var numSel = properties.items.length;
		selItem = properties.items[numSel-1];
		ActivateOverlay(selItem);
	});
		
	/**
	 * Move the timeline a given percentage to left or right
	 * @param {Number} percentage   For example 0.1 (left) or -0.1 (right)
	 */
	function move (percentage) {
		var range = timeline.getWindow();
		var interval = range.end - range.start;

		timeline.setWindow({
			start: range.start.valueOf() - interval * percentage,
			end:   range.end.valueOf()   - interval * percentage
		});
	}

	/**
	 * Zoom the timeline a given percentage in or out
	 * @param {Number} percentage   For example 0.1 (zoom out) or -0.1 (zoom in)
	 */
	function zoom (percentage) {
		var range = timeline.getWindow();
		var interval = range.end - range.start;

		timeline.setWindow({
			start: range.start.valueOf() - interval * percentage,
			end:   range.end.valueOf()   + interval * percentage
		});
	}
		
	var myTextExtraction = function(node)  
	{  
		return $(node).data('mcsort'); 
	} 
	
	$( document ).ready(function() 
	{
		// attach events to the navigation buttons
		var interval;
		$("#moveLeft i").mousedown(function(e) 
		{
			interval = setInterval(function() 
			{
				move( 0.025);
			},25); // 500ms between each frame
		})
		.mouseup(function(e) 
		{
			clearInterval(interval);
		})
		.mouseout(function(e) 
		{
			clearInterval(interval);
		})
		.mouseleave(function(e) 
		{
			clearInterval(interval);
		});
		
		$("#moveRight i").mousedown(function(e) 
		{
			interval = setInterval(function() 
			{
				move( -0.025);
			},25); // 500ms between each frame
		})
		.mouseup(function(e) 
		{
			clearInterval(interval);
		})
		.mouseout(function(e) 
		{
			clearInterval(interval);
		})
		.mouseleave(function(e) 
		{
			clearInterval(interval);
		});
		
		$("#myTable").tablesorter(
		{
			textExtraction: myTextExtraction,
			sortList: [[0,0]] 
		});
		
		$(".timeline_link").click(function()
		{
			var checker = $(this).data('timeline');
			var id = new Array();
			var tlid = $(this).data('tlid');
			id.push(tlid);
			if (checker != "01-01-1000");
			{
				var d = new Date(checker);
				var d1 = new Date(d);
				var d2 = new Date(d);
				d1.setMonth(d.getMonth() - 3);
				d2.setMonth(d.getMonth() + 3);
				timeline.setWindow(d1,d2);
				timeline.setSelection(id);
			}
		});
		
		$(".vis_img_sm").tooltipster();
	});
	

    //document.getElementById('moveLeft').onmousedown  = function () { move( 0.2); };
    //document.getElementById('moveRight').onmousedown = function () { move(-0.2); };
	
</script>

<h2 style="margin-top: 40px;margin-bottom: 40px;"><center>Lore Database</center></h2>

<table id="myTable" class="tablesorter tier_list_chart"> 
<thead> 
<tr> 
    <th style="width:110px;">Date</th>
	<th style="width:110px;">Real Date</th>
    <th style="width:110px;">Characters</th>
	<th style="width:110px;">Timeline</th>
	<th>Links</th>
</tr> 
</thead> 
<tbody> 

<?
$tlid = 0;
foreach ($loreDataJSON as $lore)
{
	echo '<tr>';
	echo '<td data-mcsort="' . DGtoReal($lore->date) . '">' . $lore->date . '</td>';
	echo '<td data-mcsort="' . $lore->real . '">' . $lore->real . '</td>';
	
	$tags = explode(",", $lore->tags);
	$names = explode(",", $lore->name);
	$links = explode(",", $lore->link);
	
	// tags
	echo '<td data-mcsort="' . $tags . '">';
	foreach ($tags as $tag)
	{
		echo '<div style="float:center;margin:4px;"><img src="http://www.moba-champion.com/images/shapers/' . strtolower($tag) . '.png" style="width:32px;height:32px;background:#3c3c3c"> ' . $tag . '</div>';
	}
	echo '</td>';
	
	// timeline
	if ($lore->date == "The Beginning" || $lore->date == "N/A")
	{
		echo '<td></td>';
	}
	else
	{
		echo '<td><a href="#timeline" class="timeline_link" data-tlid="' . $tlid . '" data-timeline="' . DGtoReal($lore->date) . '">View in Timeline</a></td>';
	}
	
	// links
	$len = count($names);
	echo '<td data-mcsort="' . $names . '">';
	for ($it = 0; $it < $len; $it++)
	{
		echo '<a href="' . $links[$it] . '"">' . $names[$it] . '</a>';
		if ($it < ($len-1))
		{
			echo '<BR>';
		}
	}
	echo '</td>';
	
	echo '</tr>';
	$tlid++;
}
?>
</table>

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
