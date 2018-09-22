<?php 
require_once('../../forum/SSI.php');
require('../../rb/rb.php');
require('../../rb/connect.php');

$success = false;
$message = "";

$gid = $_POST['gid'];

if ($context['user']['is_logged'] &&
	$user_info['is_admin'])
{
	$success = true;
	$reason = "success";

	$guide = R::findOne('guide','id = :gid', array(':gid'=>$gid) );
	if (is_null($guide))
	{
		$success = false;
		$reason = "guide not found";
	}
	else
	{
		if ($guide->featured == 1)
		{
			$guide->featured = 0;
		}
		else
		{
			$guide->featured = 1;
		}
		
		$voteid = R::store($guide);
	}
}
else
{
	$success = false;
	$reason = "not implemented";
}

 $data = array('success'=> true,'message'=>$reason);
  echo json_encode($data);

?>
