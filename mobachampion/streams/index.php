<?php
$moba_champ_title = 'MOBA-Champion - Dawngate Stream List';
$moba_champ_desc = 'A list of active Dawngate streams on MOBA-Champion.com!';
$msCommunity = true;
$msStreams = true;
include('../header.php');
?>


<script src="streams.js"></script>

<div id="main_container">

<div class="article_content">

<?php

$featuredstreams = json_decode(file_get_contents("featured.json"));
$bNeedsUpdate = false;
$numFeaturedOnline = 0;

$onlineArray = array();
$numLookups = 0;
foreach ($featuredstreams as $featured)
{
	$diff = (time() - $featured->time);
	if ($diff > 600 && $numLookups < 2)
	{
        $numLookups++;
		$url = "https://api.twitch.tv/kraken/streams/" . $featured->channel;
		$channel = json_decode(get_url_contents($url));
		if ($featured->online == true)
		{
			if ($channel->stream == null)
			{
				$featured->online = false;
			}
		}
		else
		{
			if ($channel->stream != null)
			{
				$featured->online = true;
			}			
		}
		
		$featured->time = time();
		$bNeedsUpdate = true;
	}
	
	if ($featured->online == true)
	{
		$onlineArray[] = $featured;
	}
}

if ($bNeedsUpdate)
{
	$fp = fopen('featured.json', 'w');
	fwrite($fp, json_encode($featuredstreams));
	fclose($fp);
}

$numOnline = count($onlineArray);
if ($numOnline > 0)
{
	echo '<div class="news_post">
			<div class="news_header"><div class="news_header_text"><div class="news_title">Featured Streams</div></div></div>
			<div class="news_content">';

	$pickedStreams = array_rand($onlineArray, min(2, $numOnline));

	if (is_array($pickedStreams))
	{
		foreach ($pickedStreams as $index)
		{
			echo '<div style="margin-right: 8px; float: left;">';
			echo '<object type="application/x-shockwave-flash" height="292" width="390" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=' . $onlineArray[$index]->channel . '">
					<param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf?channel=' . $onlineArray[$index]->channel . '"></param><param name="allowScriptAccess" value="always"></param>
					<param name="allowNetworking" value="all"></param>
					<param name="allowFullScreen" value="true"></param>
					<param name="wmode" value="transparent">
					<param name="flashvars" value="hostname=www.twitch.tv&start_volume=25&channel=' . $onlineArray[$index]->channel . '&auto_play=false"></param>
				  </object>';
			echo '</div>';
		}
	}
	else
	{
		echo '<div style="margin-right: 8px; float: left;">';
		echo '<object style="margin-right=8px;" type="application/x-shockwave-flash" height="292" width="390" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=' . $onlineArray[$pickedStreams]->channel . '">
			<param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf?channel=' . $onlineArray[$pickedStreams]->channel . '"></param><param name="allowScriptAccess" value="always"></param>
			<param name="allowNetworking" value="all"></param>
			<param name="allowFullScreen" value="true"></param>
			<param name="wmode" value="transparent">
			<param name="flashvars" value="hostname=www.twitch.tv&start_volume=25&channel=' . $onlineArray[$pickedStreams]->channel . '&auto_play=false"></param>
		  </object>';
		echo '</div>';
	}
			
	echo '</div></div>';
}

?>


<div class="news_post">
<div class="news_header"><div class="news_header_text"><div class="news_title">Streams</div></div></div>
<div class="news_content">

<div class="article_news">

<p>Check out the Dawngate Stream Viewer <a href="https://chrome.google.com/webstore/detail/dawngate-stream-browser-m/jggggbjablhbpnnpjlagjclfofkjmaef">extension</a> for Google Chrome!</p>


<?php
$streams = json_decode(get_url_contents("https://api.twitch.tv/kraken/streams?game=Dawngate&limit=20"));
$numItems = count($streams);

$streamCount = 0;
foreach ($streams->streams as $stream)
{
	$streamCount++;
}

if ($streamCount > 0)
{
	echo '<div class="stream_browser">';
}

foreach ($streams->streams as $stream)
{
    echo "<div class=\"stream_row\">";
    
    $i++;
        
    $output = $stream->channel->status;
    $output = preg_replace('/[^(\x20-\x7F)]*/','', $output);
    
    $extra = "";
    if (strlen($output) > 80)
    {
        $extra = " ...";
    }
    
    $status = substr($output, 0, 80) . $extra;
    
    $showLogo = "http://s.jtvnw.net/jtv_user_pictures/hosted_images/GlitchIcon_PurpleonWhite.png";
    if (!is_null($stream->channel->logo) && $stream->channel->logo != "")
    {
        $showLogo = $stream->channel->logo;
    }
	
    echo "<div class=\"stream_row_icon\"><img src=\"" . $showLogo . "\"></div>";
    echo "<div class=\"stream_row_content\"><a href=\"" . $stream->channel->url . "\">" . $stream->channel->display_name . "</a><BR>" . $status . "</div>";
    echo "<div class=\"stream_row_viewers\">" . $stream->viewers . " viewers</div>";
    echo "</div>";
}
  
function get_url_contents($url){
    $crl = curl_init();
    $timeout = 5;
    curl_setopt ($crl, CURLOPT_URL,$url);
    curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}

function post_url_contents($url, $fields) {

    foreach($fields as $key=>$value) { $fields_string .= $key.'='.urlencode($value).'&'; }
    rtrim($fields_string, '&');

    $crl = curl_init();
    $timeout = 5;

    curl_setopt($crl, CURLOPT_URL,$url);
    curl_setopt($crl,CURLOPT_POST, count($fields));
    curl_setopt($crl,CURLOPT_POSTFIELDS, $fields_string);

    curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}

if ($streamCount > 0)
{
	echo '</div>';
}
else
{
	echo '<p>There are currently no users streaming Dawngate on Twitch.tv</p>';
}

?>

</div>
</div>

</div>
<?php
include('../widgets/adwidget2.php');
?>
</div>

<div class="article_column2">
<?php 
include('../widgets/shaperwidget.php');
include('../widgets/guidewidget.php');
?>
</div>

</div> <!-- main container -->
</div> <!-- maincontent -->

<?php
include('../footer.php');
?>