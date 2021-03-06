<?php 
require_once('../../forum/SSI.php');
require('../../rb/rb.php');
require('../../rb/connect.php');

$guideid = $_POST['guideid'];
$id = $_POST['introid'];
$desc = $_POST['desc'];

$sectionName = 'guidev2intro';

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
		$reason = 'Unknown error saving guide (code: 38). Please try again later.';
		$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
		echo json_encode($data);
		exit(0);
	}
	
	if (CheckForBadStuff($guideid) || 
		CheckForBadStuff($id) ||
		CheckForBadStuff($desc))
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
			$reason = 'You tried to save to an introduction that does not belong to you (' . $guide->author . ',' . $section->owner . ')';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
	}

	if ($section->id >= 0)
	{
		$success = true;
		$reason = "Introduction saved successfully";
	
		// All sections musth ave this variable
		$section->owner = $context['user']['name'];

		// Section Length Validation
		if (!ValidateLength($desc, 15000))
		{
			$reason = 'Introduction: has a description that is too long (max 15000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
				
		// Section specific variables
		$section->desc	= $desc;
		
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
