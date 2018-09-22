<?php 
require_once('../forum/SSI.php');
require('../rb/rb.php');
require('../rb/connect.php');

$success = false;
$message = "";
$returnid = 0;

$loadout = $_POST['loadout'];
$title = $_POST['title'];
$shaper = $_POST['shaper'];

if ($context['user']['is_logged'])
{
	$returnid = -1;
	if (is_null($loadout))
	{
		$success = false;
		$message = "Loadout string is null";
	}
	else
	{
		$author = $context['user']['name'];
		// find the loadout bean
		$loadoutBean = R::findOne('loadoutfav',' loadout = :loadout AND author = :author ',
			array(':loadout'=>$loadout,':author'=>$author));
			
		if (is_null($loadoutBean))
		{
			$returnid = -1;
			$message = "Loadout could not be found";
		}
		else if ($loadoutBean->author != $author)
		{
			$returnid = -1;
			$message = "Loadout does not belong to you";
		}
		else
		{
			$loadoutBean->shaper = $shaper;
			$loadoutBean->title = $title;
			$returnid = R::store($loadoutBean);
			$message = "Loadout favorited successfully.";
		}
	}
}
else
{
	$returnid = -2;
	$success = false;
	$message = "You must be logged in to favorite a guide.";
}

$data = array('success'=>$success,'message'=>$message, 'returnid'=>$returnid);
echo json_encode($data);

?>
