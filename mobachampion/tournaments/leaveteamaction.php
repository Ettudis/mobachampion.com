<?php 
require_once('../forum/SSI.php');
require('../rb/rb.php');
require('../rb/connect.php');

$success = false;
$message = "";

$returnid = 0;
if ($context['user']['is_logged'])
{
	$gname  = $context['user']['name'];
	
	// is in team?
	$count = R::count('member','name = :name', array(':name'=>$gname) );
	if ($count == 0)
	{
		$success = false;
		$reason = "You are not in a team.";
	}
	else
	{
		$members = R::find('member',' name = ? ',array($gname));
		foreach($members as $mem)
		{
			R::trash( $mem );
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
