<?php 
require_once('../../forum/SSI.php');
require('../../rb/rb.php');
require('../../rb/connect.php');

$guideid = $_POST['guideid'];
$id = $_POST['loadoutid'];

$loadoutNames1 = $_POST['loadoutNames1'];
$loadoutIds1 = $_POST['loadoutIds1'];
$loadoutDescs1 = $_POST['loadoutDescs1'];
$loadoutNames2 = $_POST['loadoutNames2'];
$loadoutIds2 = $_POST['loadoutIds2'];
$loadoutDescs2 = $_POST['loadoutDescs2'];
$loadoutNames3 = $_POST['loadoutNames3'];
$loadoutIds3 = $_POST['loadoutIds3'];
$loadoutDescs3 = $_POST['loadoutDescs3'];
$selloadout = $_POST['selloadout'];

$sectionType = 'Loadout';
$sectionName = 'guidev2loadout';

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
		$reason = 'Unknown error saving guide (code: 47). Please try again later.';
		$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
		echo json_encode($data);
		exit(0);
	}
	
	if (CheckForBadStuff($guideid) || 
		CheckForBadStuff($id) ||
		CheckForBadStuff($loadoutNames1) || 
		CheckForBadStuff($loadoutIds1) ||
		CheckForBadStuff($loadoutDescs1) ||
		CheckForBadStuff($loadoutNames2) || 
		CheckForBadStuff($loadoutIds2) ||
		CheckForBadStuff($loadoutDescs2) ||
		CheckForBadStuff($loadoutNames3) || 
		CheckForBadStuff($loadoutIds3) ||
		CheckForBadStuff($loadoutDescs3) ||
		CheckForBadStuff($selloadout))
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
		if (!ValidateLength($loadoutDescs1, 10000))
		{
			$reason = $sectionType . ': "' . $loadoutNames1 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		if (!ValidateLength($loadoutDescs2, 10000))
		{
			$reason = $sectionType . ': "' . $loadoutNames2 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		if (!ValidateLength($loadoutDescs3, 10000))
		{
			$reason = $sectionType . ': "' . $loadoutNames3 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
				
		// Section specific variables
		$section->loadoutNames1 = $loadoutNames1;
		$section->loadoutIds1 = $loadoutIds1;
		$section->loadoutDescs1 = $loadoutDescs1;
		$section->loadoutNames2 = $loadoutNames2;
		$section->loadoutIds2 = $loadoutIds2;
		$section->loadoutDescs2 = $loadoutDescs2;
		$section->loadoutNames3 = $loadoutNames3;
		$section->loadoutIds3 = $loadoutIds3;
		$section->loadoutDescs3 = $loadoutDescs3;
		$section->selloadout = $selloadout;
		
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
