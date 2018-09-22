<?php 
require_once('../../forum/SSI.php');
require('../../rb/rb.php');
require('../../rb/connect.php');

$success = false;
$message = "";

$guideid = $_POST['id'];
$type = $_POST['type'];

// make sure user is logged in
if ($context['user']['is_logged'])
{	
	$guide = null;
	
	// make sure guideid is valid
	if (is_null($guideid) || $guideid < 0)
	{
		$success = false;
		$message = "bad guide ID";

		$data = array('success'=> true,'message'=>$message, 'id' => $guideid, 'type' => 0);
		echo json_encode($data);
		exit(0);
	}
	else
	{
		$guide = R::load('guidev2', $guideid);
	}

	// guide ID > 0 (guide exists)
	if ($guide->id > 0)
	{
		$name = $context['user']['name'];
		$vote = R::findOne('votev2',' name = :name AND guideid = :id ', array(':name'=>$name,':id'=>$guideid) );
		if (is_null($vote))
		{
			$vote = R::dispense('votev2');
			$vote->name = $name;
			$vote->type = $type;
			$vote->guideid = $guideid;
			$vote->curdate = date('Y-m-d');
		}
		else
		{
			$vote->type = $type;
			$vote->curdate = date('Y-m-d');
		}
		
		$success = true;
		$message = 'voted for guide';
		$voteid = R::store($vote);
		$id = $voteid;
	}
}
else
{
	$success = false;
	$message = "not logged in";
}

$data = array('success'=> $success,'message'=>$message,'id' => $id,'type' => $type);
echo json_encode($data);

?>
