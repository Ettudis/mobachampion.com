<?php 
require_once('../../forum/SSI.php');
require('../../rb/rb.php');
require('../../rb/connect.php');

$success = false;
$message = "";

$monday_article = $_POST["monday_article"];
$wednesday_article = $_POST["wednesday_article"];
$friday_article = $_POST["friday_article"];
$monday_thumb = $_POST["monday_thumb"];
$wednesday_thumb = $_POST["wednesday_thumb"];
$friday_thumb = $_POST["friday_thumb"];

if ($context['user']['is_logged'] && $user_info['is_admin'])
{
	$success = true;
	$reason = "lamentz updated";

	$lamentz = R::load('lamentz', 1);
	$lamentz->monday_article = $monday_article;
	$lamentz->wednesday_article = $wednesday_article;
	$lamentz->friday_article = $friday_article;
	$lamentz->monday_thumb = $monday_thumb;
	$lamentz->wednesday_thumb = $wednesday_thumb;
	$lamentz->friday_thumb = $friday_thumb;
	
	$lamentzid = R::store($lamentz);
}
else
{
	$success = false;
	$reason = "lamentz not updated";
}

 $data = array('success'=> true,'message'=>$reason);
  echo json_encode($data);

?>
