<?php 
require_once('../forum/SSI.php');
require('../rb/rb.php');
require('../rb/connect.php');

$success = false;
$message = "";

$pickemId = $_POST['pickemId'];
$picksId = $_POST['picksId'];
$picks = $_POST['picks'];

if ($context['user']['is_logged'])
{
	$success = true;
	$reason = "Success";
	
	$pickemBean = R::load('pickem', $pickemId);
	if (is_null($pickemBean))
	{
		$reason = 'Invalid Pickem Event';
		$data = array('result'=> false,'message'=>$reason, 'id' => -1);
		echo json_encode($data);
		exit(0);
	}
	
	if ($pickemBean->open == 0)
	{
		$reason = 'Editing this pickem has been disabled as the event is in progress or complete.';
		$data = array('result'=> false,'message'=>$reason, 'id' => -1);
		echo json_encode($data);
		exit(0);
	}

	$pickBean = NULL;
	if ($pickBean == NULL)
	{
		$pickBean = R::findOne('pick',
				' name = :name AND pickem_id = :pickem_id', 
					array( 
						':name' => $context['user']['name'], 
						':pickem_id' => $pickemId 
					)
				);
	}
	
	if (is_null($pickBean) && $picksId >= 0)
	{
		$pickBean = R::load('pick', $picksId);
	}
	
	if ($pickBean == NULL)
	{
		$pickBean = R::dispense('pick');
	}
	else if ($pickBean->name != $context['user']['name'])
	{
		$reason = 'Does not belong to you';
		$data = array('result'=> true,'message'=>$reason, 'id' => -1);
		echo json_encode($data);
		exit(0);
	}

	$pickBean->name = $context['user']['name'];
	$pickBean->pickemId = $pickemId;
	$pickBean->picks = $picks;
	
	$picksId = R::store($pickBean);
}
else
{
	$success = false;
	$reason = "Not logged in.";
}

$data = array('result'=> true,'message'=>$reason, 'id'=>$picksId);
echo json_encode($data);

?>
