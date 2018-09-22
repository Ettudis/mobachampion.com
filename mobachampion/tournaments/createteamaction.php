<?php 
require_once('../forum/SSI.php');
require('../rb/rb.php');
require('../rb/connect.php');

$success = false;
$message = "";

$gname = $_POST['gname'];

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

$returnid = 0;
if (is_null($gname))
{
	$success = false;
	$reason = "Team name is null";
}
else if (strlen($gname) > 35)
{
	$success = false;
	$reason = "Max team length of 35 was exceeded";
}
else if ($context['user']['is_logged'])
{
    if (CheckForBadStuff($gname))
	{
		$reason = 'Javascript injection detected.';
		$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
		echo json_encode($data);
		exit(0);
	}
    
	$gcaptain  = $context['user']['name'];
	
	// is in team?
	$count = R::count('member','name = :name', array(':name'=>$gcaptain) );
	if ($count > 0)
	{
		$success = false;
		$reason = "You are already in a team.";
	}
	else
	{
		$success = true;
		$reason = "logged in";

		$team = R::dispense('team');

		$team->gname = $gname;
		$team->captain = $gcaptain;
		
		$tournamentid = R::store($team);
		$returnid = $tournamentid;
		
		$member = r::dispense('member');
		$member->teamid = $tournamentid;
		$member->name = $gcaptain;
		$memberid = R::store($member);
	}
}
else
{
	$success = false;
	$reason = "Unable to create team while not logged in";
}

 $data = array('success'=>$success,'message'=>$reason, 'returnid'=>$returnid);
  echo json_encode($data);

?>
