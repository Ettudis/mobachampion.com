<?php 
require_once('../forum/SSI.php');
require('../rb/rb.php');
require('../rb/connect.php');

$success = false;
$message = "";

$teamid = $_POST['teamid'];
$tournamentid = $_POST['tournamentid'];

$returnid = 0;
if ($context['user']['is_logged'] && !is_null($teamid) && !is_null($tournamentid))
{
	$gcaptain = $context['user']['name'];
	$team = R::load('team', $teamid);
	
	if ($gcaptain == $team->captain)
	{
		$query = 'DELETE FROM tournyteams WHERE tournamentid = "' . $tournamentid . '" AND teamid = ' . $teamid;
		R::exec($query);
		
		$success = true;
		$message = "";			
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
