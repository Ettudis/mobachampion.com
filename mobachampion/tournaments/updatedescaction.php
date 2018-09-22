<?php 
require_once('../forum/SSI.php');
require('../rb/rb.php');
require('../rb/connect.php');

$success = false;
$message = "";

$gid = $_POST['gid'];
$desc = $_POST['desc'];

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
if ($context['user']['is_logged'] && !is_null($gid))
{
    if (CheckForBadStuff($gid) ||
        CheckForBadStuff($desc))
    {
		$reason = 'Javascript injection detected.';
		$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
		echo json_encode($data);
		exit(0);
	}
    
	$gcaptain  = $context['user']['name'];
	$team = R::load('team', $gid);
	if ($gcaptain == $team->captain)
	{
		$success = true;
		$reason = "okay";
		$returnid = 0;

		$team->desc = $desc;
		R::store($team);
	}
	

}
else
{
	$success = false;
	$reason = "";
}

 $data = array('success'=>$success,'message'=>$reason, 'returnid'=>$returnid);
  echo json_encode($data);

?>
