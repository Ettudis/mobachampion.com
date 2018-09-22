<?php 
require_once('../forum/SSI.php');
require('../rb/rb.php');
require('../rb/connect.php');

$success = false;
$message = "";

$gid = $_POST['gid'];

$returnid = 0;
if ($context['user']['is_logged'] && !is_null($gid))
{
	$gcaptain  = $context['user']['name'];
	$team = R::load('team', $gid);
	if ($gcaptain == $team->captain)
	{
		$query = 'DELETE FROM member WHERE teamid = ' . $team->id;
		R::exec($query);
		
    	$query = 'DELETE FROM tournyteams WHERE teamid = ' . $team->id;
		R::exec($query);
        
		R::trash($team);
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
