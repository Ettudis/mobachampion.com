<?php 
require_once('../../forum/SSI.php');
require('../../rb/rb.php');
require('../../rb/connect.php');

$success = false;
$message = "";

$id = $_GET['id'];

if ($context['user']['is_logged'] && $user_info['is_admin'])
{
	$success = true;
	$reason = "logged in";

	$pickem = R::Load('pickem', $id);
	if ($pickem->id > 0)
	{
		$picks = R::find('pick', ' pickem_id = ? ', array($id));
		foreach($picks as $pick)
		{
			$pts = 0;
			$predict = explode(",", $pick->picks);
			$actual = explode(",", $pickem->results);
			
			if (count($predict) == 18 && count($actual) == 18)
			{
				if ($predict[8] == $actual[8])
					$pts++;
				if ($predict[9] == $actual[9])
					$pts++;
				if ($predict[10] == $actual[10])
					$pts++;
				if ($predict[11] == $actual[11])
					$pts++;
				if ($predict[12] == $actual[12])
					$pts++;
				if ($predict[13] == $actual[13])
					$pts++;
				if ($predict[16] == $actual[16])
					$pts++;
				if ($predict[17] == $actual[17])
					$pts++;
			}
			
			$pickresult = R::findOne('pickresult', ' name = ? ',array($pick->name));
			$totalpts = 0;
			if ($pickresult == NULL)
			{
				$pickresult = R::dispense('pickresult');
				$pickresult->name = $pick->name;
			}
			else
			{
				$totalpts = $pickresult->totalpts;
			}
			
			if ($pickresult->$id > 0)
			{
				
			}
			else
			{
				$totalpts += $pts;
			}
			
			$pickresult->$id = $pts;
			$pickresult->totalpts = $totalpts;
			$prid = R::store($pickresult);
		}
	}
	else
	{
		$success = false;
		$reason = "invalid pickem id";
	}
}
else
{
	$success = false;
	$reason = "admins only (sorry!)";
}

 $data = array('success'=> true,'message'=>$reason);
  echo json_encode($data);

?>
