<?php 
require_once('../forum/SSI.php');
require('../rb/rb.php');
require('../rb/connect.php');

$success = false;
$message = "";

$gid = $_POST['gid'];
$gurl = $_POST['gurl'];
$gname = $_POST['gname'];
$gdate = $_POST['gdate'];
$gcheckin = $_POST['gcheckin'];
$gblurb = $_POST['gblurb'];
$grules = $_POST['grules'];
$gformat = $_POST['gformat'];
$gmaxteams = $_POST['gmaxteams'];
$girc = $_POST['girc'];

if ($context['user']['is_logged'] &&
	$user_info['is_admin'])
{
	$success = true;
	$reason = "logged in";

	$tournament = null;
	if (!is_null($gid))
	{
		$tournament = R::findOne('tournament','gid = :gid', array(':gid'=>$gid) );
	}
	
	if (is_null($tournament))
	{
		$tournament = R::dispense('tournament');
	}

	$tournament->gurl = $gurl;
	$tournament->gname = $gname;
	$tournament->gdate = $gdate;
	$tournament->gcheckin = $gcheckin;
	$tournament->gblurb = $gblurb;
	$tournament->status = "open";
	$tournament->grules = $grules;
	$tournament->gformat = $gformat;
	$tournament->gmaxteams = $gmaxteams;
	$tournament->girc = $girc;
	
	$tournamentid = R::store($tournament);
}
else
{
	$success = false;
	$reason = "create tournament implemented";
}

 $data = array('success'=> true,'message'=>$reason);
  echo json_encode($data);

?>
