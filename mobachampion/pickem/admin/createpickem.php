<?php 
require_once('../../forum/SSI.php');
require('../../rb/rb.php');
require('../../rb/connect.php');

$success = false;
$message = "";

$name = $_POST['name'];
$utcfinal = $_POST['utcfinal'];
$icon = $_POST['icon'];
$banner = $_POST['banner'];
$format = $_POST['format'];
$nummatchups = $_POST['nummatchups'];
$pickem1 = $_POST['pickem1'];
$pickem2 = $_POST['pickem2'];
$pickem3 = $_POST['pickem3'];
$pickem4 = $_POST['pickem4'];
$pickem5 = $_POST['pickem5'];
$pickem6 = $_POST['pickem6'];
$pickem7 = $_POST['pickem7'];
$pickem8 = $_POST['pickem8'];

if ($context['user']['is_logged'] &&
	$user_info['is_admin'])
{
	$success = true;
	$reason = "logged in";

	$pickem = R::dispense('pickem');

	$pickem->name = $name;
	$pickem->utcfinal = $utcfinal;
	$pickem->icon = $icon;
	$pickem->banner = $banner;
	$pickem->format = $format;
	$pickem->nummatchups = $nummatchups;
	$pickem->pickem1 = $pickem1;
	$pickem->pickem2 = $pickem2;
	$pickem->pickem3 = $pickem3;
	$pickem->pickem4 = $pickem4;
	$pickem->pickem5 = $pickem5;
	$pickem->pickem6 = $pickem6;
	$pickem->pickem7 = $pickem7;
	$pickem->pickem8 = $pickem8;
	$pickem->results = "na";
	
	$pickemid = R::store($pickem);
}
else
{
	$success = false;
	$reason = "Create Pickem Restricted";
}

 $data = array('success'=> true,'message'=>$reason);
  echo json_encode($data);

?>
