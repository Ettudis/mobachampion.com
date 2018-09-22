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
		$tournyteams = R::findOne('tournyteams',' tournamentid = :tournamentid AND teamid = :teamid  ', array( 
								':tournamentid' => $tournamentid, 
								':teamid' => $teamid 
							));
		if (is_null($tournyteams))
		{
			$tournyteams = R::dispense('tournyteams');
		}
		
		$tournyteams->tournamentid = $tournamentid;
		$tournyteams->teamid = $teamid;
		$returnid = R::store($tournyteams);
		
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
