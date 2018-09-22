<?php 
require_once('../../forum/SSI.php');
require('../../rb/rb.php');
require('../../rb/connect.php');

$id = $_POST['id'];
$title = $_POST['title'];
$ign = $_POST['ign'];
$shaper = $_POST['shaper'];
$roles = $_POST['roles'];
$loadouts = $_POST['loadouts'];
$spells = $_POST['spells'];
$items = $_POST['items'];
$skillorder = $_POST['skillorder'];
$abilities = $_POST['abilities'];
$privacy = $_POST['privacy'];
$customs = $_POST['customs'];
$intro = $_POST['intro'];
$type = $_POST['type'];

if (is_null($id))
{
	$reason = 'Invalid guide id';
	$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
	echo json_encode($data);
	exit(0);
}

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
		$reason = 'Unknown error saving guide (code: 37). Please try again later.';
		$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
		echo json_encode($data);
		exit(0);
	}
	
	if (CheckForBadStuff($id) || 
		CheckForBadStuff($title) ||
		CheckForBadStuff($ign) ||
		CheckForBadStuff($shaper) ||
		CheckForBadStuff($intro) ||
		CheckForBadStuff($roles) ||
		CheckForBadStuff($loadouts) ||
		CheckForBadStuff($spells) ||
		CheckForBadStuff($items) ||
		CheckForBadStuff($skillorder) ||
		CheckForBadStuff($privacy) ||
		CheckForBadStuff($customs) ||
		CheckForBadStuff($type))
	{
		$reason = 'Javascript injection detected.';
		$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
		echo json_encode($data);
		exit(0);
	}
	
	$guide = R::load('guidev2', $id);
	if ($guide->id == 0 || is_null($guide))
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

	if ($guide->id > 0)
	{
		$success = true;
		$reason = "Guide updated successfully";
		
		$guide->author = $context['user']['name'];
		$guide->updatetime = time();
		$guide->title = $title;
		$guide->ign = $ign;
		$guide->shaper = $shaper;
		$guide->featured = 0;
		$guide->privacy = $privacy;
		$guide->intro = $intro;
		$guide->roles = $roles;
		$guide->loadouts = $loadouts;
		$guide->spells = $spells;
		$guide->items = $items;
		$guide->skillorder = $skillorder;
		$guide->abilities = $abilities;
		$guide->privacy = $privacy;
		$guide->customs = $customs;
		$guide->type = $type;
		
		$id = R::store($guide);
	}
	else
	{
		$success = false;
		$reason = 'Bad guide id: ' . $guide->id;
	}
}
else
{
	$success = false;
	$reason = "Not logged in";
}

$data = array('success'=> $success,'message'=>$reason, 'id' => $id);
echo json_encode($data);

?>
