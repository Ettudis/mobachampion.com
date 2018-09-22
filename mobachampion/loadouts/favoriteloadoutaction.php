<?php 
require_once('../forum/SSI.php');
require('../rb/rb.php');
require('../rb/connect.php');

$success = false;
$message = "";
$returnid = 0;
$loadout = $_POST['loadout'];

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
			$loadoutBean = R::dispense('loadoutfav');
			$loadoutBean->loadout = $loadout;
			$loadoutBean->author = $author;
			$loadoutBean->shaper = null;
			$loadoutBean->title = null;
			$returnid = R::store($loadoutBean);
			$message = "Loadout favorited successfully.";
		}
		else
		{
			R::trash( $loadoutBean );
			$returnid = -1;
			$message = "Loadout unfavorited successfully";
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
