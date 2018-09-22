<?php 
require_once('../../forum/SSI.php');
require('../../rb/rb.php');
require('../../rb/connect.php');

$id = $_POST['id'];
$title = $_POST['title'];
$ign = $_POST['ign'];
$shaper = $_POST['shaper'];
$type = $_POST['type'];

function CheckForBadStuff($badstuff)
{
	if (strpos($badstuff,'<script>') !== false ||
		strpos($badstuff,'</script>') !== false ||
		strpos($badstuff,'iframe') !== false ||
		strpos($badstuff,'<') !== false ||
		strpos($badstuff,'>') !== false)
	{
		return true;
	}
	
	return false;
}

if ($context['user']['is_logged'])
{	
	if ($_SESSION['ban']['cannot_access'] != NULL)
	{
		$reason = 'Unknown error saving guide (code: 36). Please try again later.';
		$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
		echo json_encode($data);
		exit(0);
	}
	
	if (CheckForBadStuff($id) || 
		CheckForBadStuff($title) ||
		CheckForBadStuff($ign) ||
		CheckForBadStuff($shaper) ||
		CheckForBadStuff($type))
	{
		$reason = 'Javascript injection detected.';
		$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
		echo json_encode($data);
		exit(0);
	}
	
	$guide = null;
	if (is_null($id) || $id < 0)
	{
		$guide = R::dispense('guidev2');
	}
	else
	{
		$guide = R::load('guidev2', $id);
		if (is_null($guide))
		{
			$reason = 'Invalid guide id';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		if ($guide->author != $context['user']['name'])
		{
			$reason = 'You tried to save to a guide that does not belong to you.';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
	}

	if ($guide->id >= 0)
	{
		$success = true;
		$reason = "Guide created successfully";
		
		$guide->author = $context['user']['name'];
		$guide->updatetime = time();
		$guide->title = $title;
		$guide->ign = $ign;
		$guide->shaper = $shaper;
		$guide->featured = 0;
		$guide->privacy = 'Private';
		$guide->type = $type;
		
		$id = R::store($guide);
	}
}
else
{
	$success = false;
	$reason = "Not logged in";
}

$data = array('success'=> true,'message'=>$reason, 'id' => $id);
echo json_encode($data);

?>
