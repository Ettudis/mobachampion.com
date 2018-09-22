<?php 
require_once('../forum/SSI.php');
require('../rb/rb.php');
require('../rb/connect.php');

$success = false;
$message = "";

$gkey = $_POST['gkey'];

if ($context['user']['is_logged'] &&
	$user_info['is_admin'])
{
	$success = true;
	$reason = "logged in";

	$giveaway = R::findOne('giveaways','gkey = :gkey', array(':gkey'=>$gkey) );
	if (is_null($strong))
	{
		$giveaway = R::dispense('giveaways');
		$giveaway->gkey = $gkey;
	}
	else
	{
		$giveaway->gkey = $gkey;
	}
	
	$voteid = R::store($giveaway);
}
else
{
	$success = false;
	$reason = "add key not key implemented";
}

 $data = array('success'=> true,'message'=>$reason);
  echo json_encode($data);

?>
