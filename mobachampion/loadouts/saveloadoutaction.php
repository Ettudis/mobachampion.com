<?php 
require_once('../forum/SSI.php');
require('../rb/rb.php');
require('../rb/connect.php');

$success = false;
$message = "";

$loadout = $_POST['loadout'];

$returnid = -1;
if (is_null($loadout))
{
	$success = false;
	$reason = "Loadout string is null";
}
else
{
	// find the loadout bean
	$loadoutBean = R::findOne('loadout',' fullstr = ? ',array($loadout));
	if (is_null($loadoutBean))
	{
		$loadoutBean = R::dispense('loadout');
		$loadoutBean->fullstr = $loadout;
		$returnid = R::store($loadoutBean);
		$reason = "Loadout created successfully.";
	}
	else
	{
		$returnid = $loadoutBean->id;
		$reason = "Loadout already exists";
	}
}

$data = array('success'=>$success,'message'=>$reason, 'returnid'=>$returnid);
 echo json_encode($data);

?>
