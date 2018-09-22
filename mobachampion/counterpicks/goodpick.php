<?php 
require_once('../forum/SSI.php');
require('../rb/rb.php');
require('../rb/connect.php');

$success = false;
$message = "";

$shaper = $_POST['shaper'];
$target = $_POST['target'];
$vote = $_POST['vote'];

if (!isset($shaper) || !isset($vote) || !isset($target))
{
    $success = false;
	$reason = "Bad shaper name, shaper target or vote";
}
else if ($vote > 1 || $vote < -1)
{
	$success = false;
	$reason = "Bad shaper name or vote";
}
else if ($context['user']['is_logged'])
{
	$success = true;
	$reason = "logged in";

	$shaperData = file_get_contents('../data/shaperdata.json');
	$shaperDataJSON = json_decode($shaperData);
	
	$bFound = false;
	foreach ($shaperDataJSON as $shaper_entry)
	{
		if ($shaper_entry->name == $shaper)
		{
			$bFound = true;
		}
	}
	
	if (!$bFound)
	{
		$success = false;
		$reason = "not logged in";
	}
	else
	{
		$name = $context['user']['username'];
		$strong = R::findOne('goodpick',' name = :name AND shaper = :shaper AND target = :target', array(':name'=>$name,':shaper'=>$shaper, ':target'=>$target) );
		if (is_null($strong))
		{
			$strong = R::dispense('goodpick');
			$strong->name = $name;
			$strong->shaper = $shaper;
			$strong->vote = $vote;
            $strong->target = $target;
			$strong->curdate = date('Y-m-d');
		}
		else
		{
			$strong->vote = $vote;
			$strong->curdate = date('Y-m-d');
		}
		
		$voteid = R::store($strong);
	}
}
else
{
	$success = false;
	$reason = "not logged in";
}

 $data = array('success'=> true,'message'=>$reason);
  echo json_encode($data);

?>
