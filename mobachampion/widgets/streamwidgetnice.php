<!DOCTYPE HTML>
<HTML>
<!-- MAIN INDEX -->
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="Dawngate, Waystone, Shapers, Moba, Moba-Champion, Amarynth, Cerulean, Desecrator, Dibs, Faris, Fenmore, Freia, Kel, Mikella, Moya, Nissa, Salous, Varion, Viyana, Voluc, Zeri">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/css/main.css?v=33" />
  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/css/stats.css?v=33" />
  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/guides/guidesv2.css?v=33" />
  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/css/bootstrap.css?v=33">
  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/guides/development/themes/default.css" media="all" />
  <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css">
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.0/css/font-awesome.css" rel="stylesheet">
  
  <link rel="stylesheet" type="text/css" href="http://moba-champion.com/css/tooltipster.css" />
  
</head>

<body>

<div class="mobawidget" style="width:300px;margin-top:0px;">
	<div class="widget_header">
		<div class="widget_header_text"><a href="http://www.moba-champion.com/streams">Live Streams</a></div>
	</div>
	
<div class="widget_stream_list">
	
<?php
$streams = json_decode(get_url_contents2("https://api.twitch.tv/kraken/streams?game=Dawngate&limit=8"));
$i = 0;

if (!is_null($streams))
{
	$featuredstreams = json_decode(file_get_contents("http://www.moba-champion.com/streams/featured.json"));
	
	foreach ($streams->streams as $stream)
	{   
		foreach ($featuredstreams as $featured)
		{
			if ($featured->link == $stream->channel->url)
			{
				echo '<div class="stream_widget_row featured_row">';
				
				$showLogo = "http://s.jtvnw.net/jtv_user_pictures/hosted_images/GlitchIcon_PurpleonWhite.png";
				if (!is_null($stream->channel->logo) && $stream->channel->logo != "")
				{
					$showLogo = $stream->channel->logo;
				}
				
				echo "<div class=\"stream_widget_row_icon\"><img src=\"" . $showLogo . "\"></div>";
				echo "<div class=\"stream_widget_row_content\"><a href=\"" . $stream->channel->url . "\">" . $stream->channel->display_name . "</a></div>";
				echo '<div class="stream_widget_row_viewers"><span class="label label-success" style="margin-right: 4px;">Partner</span> <icon class="icon-eye-open"></i> ' . $stream->viewers . '</div>';
				echo "</div>";	
				$i++;
				break;
			}
		}
	}
	
	foreach ($streams->streams as $stream)
	{   
		$bShow = true;
		
		foreach ($featuredstreams as $featured)
		{
			if ($featured->link == $stream->channel->url)
			{
				$bShow = false;
				break;
			}
		}
		
		if ($i >= 5)
		{
			$bShow = false;
		}
		
		if ($bShow == true)
		{
			echo '<div class="stream_widget_row">';
			
			$showLogo = "http://s.jtvnw.net/jtv_user_pictures/hosted_images/GlitchIcon_PurpleonWhite.png";
			if (!is_null($stream->channel->logo) && $stream->channel->logo != "")
			{
				$showLogo = $stream->channel->logo;
			}
			
			echo "<div class=\"stream_widget_row_icon\"><img src=\"" . $showLogo . "\"></div>";
			echo "<div class=\"stream_widget_row_content\"><a href=\"" . $stream->channel->url . "\">" . $stream->channel->display_name . "</a></div>";
			echo '<div class="stream_widget_row_viewers"><icon class="icon-eye-open"></i> ' . $stream->viewers . '</div>';
			echo "</div>";
			$i++;
		}
	}
}

if ($i == 0)
{
	echo '<div class="stream_widget_row"><p>There are currently no users streaming Dawngate on Twitch.tv</p></div>';
}

echo '</div></div>';
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

function get_url_contents2($url)
{
    $crl = curl_init();
    $timeout = 5;
    curl_setopt ($crl, CURLOPT_URL,$url);
    curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}

?>	

</body>
</html>

