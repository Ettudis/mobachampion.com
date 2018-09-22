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
	$application = R::findOne('teamapp',' teamid = :teamid AND name = :name ',array( 
							':teamid' => $gid, 
							':name' => $name 
						));		
						
	if (!is_null($application))
	{
		$gcaptain  = $context['user']['name'];
		$team = R::load('team', $gid);
		if ($gcaptain == $team->captain)
		{
			R::trash($application);		
		}	
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
