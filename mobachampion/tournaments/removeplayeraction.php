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
	$gcaptain  = $context['user']['name'];
	$team = R::load('team', $gid);
	if ($gcaptain == $team->captain)
	{
		$member = R::findOne('member',' name = :name AND teamid = :teamid ', array(':name' => $name, ':teamid' => $team->id ));
		if (!is_null($member))
		{
			R::trash($member);
		}
	}
	
	$success = true;
	$reason = "okay";
	$returnid = 0;
}
else
{
	$success = false;
	$reason = "";
}

 $data = array('success'=>$success,'message'=>$reason, 'returnid'=>$returnid);
  echo json_encode($data);

?>
