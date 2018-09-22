<?php 
require_once('../forum/SSI.php');
require('../rb/rb.php');
require('../rb/connect.php');

$success = false;
$message = "";

$gid = $_POST['gid'];
$name = $_POST['name'];

$returnid = 0;
if ($context['user']['is_logged'] && !is_null($gid))
{
	$gname  = $context['user']['name'];
	
	// is in team?
	$count = R::count('member','name = :name', array(':name'=>$gname) );
	if ($count > 0)
	{
		$success = false;
		$reason = "You are already in a team.";
	}
	else
	{
		$success = true;
		$reason = "logged in";

		$teamapp = R::dispense('teamapp');

		$teamapp->teamid = $gid;
		$teamapp->name = $gname;
		
		$teamappid = R::store($teamapp);
		$returnid = $teamappid;
	}
}
else
{
	$success = false;
	$reason = "not logged in or no team id";
}

 $data = array('success'=>$success,'message'=>$reason, 'returnid'=>$returnid);
  echo json_encode($data);

?>
