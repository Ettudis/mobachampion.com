<?php 
require_once('../../forum/SSI.php');
require('../../rb/rb.php');
require('../../rb/connect.php');

$guideid = $_POST['guideid'];
$id = $_POST['skillorder'];

$descp = $_POST['descp'];
$descq = $_POST['descq'];
$descw = $_POST['descw'];
$desce = $_POST['desce'];
$descr = $_POST['descr'];

$sectionType = 'Ability Description';
$sectionName = 'guidev2abilities';

function ValidateLength($str, $len)
{
	$myLength = strlen($str);
	if ($myLength > $len)
	{
		return false;
	}
	
	return true;
}

function CheckForBadStuff($badstuff)
{
	if (strpos($badstuff,'<script>') !== false ||
		strpos($badstuff,'</script>') !== false ||
		strpos($badstuff,'iframe') !== false) 
	{
		return true;
	}
	
	return false;
}

if ($context['user']['is_logged'])
{	
	if ($_SESSION['ban']['cannot_access'] != NULL)
	{
		$reason = 'Unknown error saving guide (code: 42). Please try again later.';
		$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
		echo json_encode($data);
		exit(0);
	}
	
	if (CheckForBadStuff($guideid) || 
		CheckForBadStuff($id) ||
		CheckForBadStuff($descp) || 
		CheckForBadStuff($descq) ||
		CheckForBadStuff($descw) ||
		CheckForBadStuff($desce) ||
		CheckForBadStuff($descr))
	{
		$reason = 'Javascript injection detected.';
		$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
		echo json_encode($data);
		exit(0);
	}
	
	$section = null;
	if (is_null($id) || $id < 0)
	{
		$section = R::dispense($sectionName);
	}
	else
	{
		$section = R::load($sectionName, $id);
		$guide = R::load('guidev2', $guideid);
		
		// Check
		if ($guide->author != $context['user']['name'] ||
			$section->owner != $context['user']['name'])
		{
			$reason = 'You tried to save to a ' . $sectionType . ' that does not belong to you (' . $guide->author . ',' . $section->owner . ')';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
	}

	if ($section->id >= 0)
	{
		$success = true;
		$reason = $sectionType . 's saved successfully';
	
		// All sections musth ave this variable
		$section->owner = $context['user']['name'];

		// Section Length Validation
		if (!ValidateLength($descp, 10000))
		{
			$reason = $sectionType . ': Passive has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		if (!ValidateLength($descq, 10000))
		{
			$reason = $sectionType . ': (Q) has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		// Section Length Validation
		if (!ValidateLength($descw, 10000))
		{
			$reason = $sectionType . ': (W) has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		// Section Length Validation
		if (!ValidateLength($desce, 10000))
		{
			$reason = $sectionType . ': (E) has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		// Section Length Validation
		if (!ValidateLength($descr, 10000))
		{
			$reason = $sectionType . ': Ultimate (R) has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}

		// Section specific variables
		$section->descp = $descp;
		$section->descq = $descq;
		$section->descw = $descw;
		$section->desce = $desce;
		$section->descr = $descr;
		
		// Store
		$id = R::store($section);
	}
}
else
{
	$success = false;
	$reason = "Not logged in";
}

$data = array('success'=> true,'message'=>$reason, 'id' => $id);
echo json_encode($data);

?>
