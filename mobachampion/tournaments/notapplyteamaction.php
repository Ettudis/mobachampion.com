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
		$application = R::findOne('teamapp',' teamid = :teamid AND name = :name ',array( 
								':teamid' => $gid, 
								':name' => $gname 
							));		
							
		if (!is_null($application))
		{
			R::trash($application);
			$success = true;
			$message = "";			
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
