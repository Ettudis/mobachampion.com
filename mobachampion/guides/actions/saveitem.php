<?php 
require_once('../../forum/SSI.php');
require('../../rb/rb.php');
require('../../rb/connect.php');

$guideid = $_POST['guideid'];
$id = $_POST['itemid'];

$itemName1 = $_POST['itemName1'];
$itemDesc1 = $_POST['itemDesc1'];
$itemSets1 = $_POST['itemSets1'];
$itemName2 = $_POST['itemName2'];
$itemDesc2 = $_POST['itemDesc2'];
$itemSets2 = $_POST['itemSets2'];
$itemName3 = $_POST['itemName3'];
$itemDesc3 = $_POST['itemDesc3'];
$itemSets3 = $_POST['itemSets3'];
$itemName4 = $_POST['itemName4'];
$itemDesc4 = $_POST['itemDesc4'];
$itemSets4 = $_POST['itemSets4'];
$itemName5 = $_POST['itemName5'];
$itemDesc5 = $_POST['itemDesc5'];
$itemSets5 = $_POST['itemSets5'];
$itemName6 = $_POST['itemName6'];
$itemDesc6 = $_POST['itemDesc6'];
$itemSets6 = $_POST['itemSets6'];
$itemName7 = $_POST['itemName7'];
$itemDesc7 = $_POST['itemDesc7'];
$itemSets7 = $_POST['itemSets7'];
$itemName8 = $_POST['itemName8'];
$itemDesc8 = $_POST['itemDesc8'];
$itemSets8 = $_POST['itemSets8'];
$itemName9 = $_POST['itemName9'];
$itemDesc9 = $_POST['itemDesc9'];
$itemSets9 = $_POST['itemSets9'];
$itemName10 = $_POST['itemName10'];
$itemDesc10 = $_POST['itemDesc10'];
$itemSets10 = $_POST['itemSets10'];
$selitem = $_POST['selitem'];

$sectionType = 'Item Set';
$sectionName = 'guidev2item';

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
		$reason = 'Unknown error saving guide (code: 44). Please try again later.';
		$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
		echo json_encode($data);
		exit(0);
	}
	
	if (CheckForBadStuff($guideid) || 
		CheckForBadStuff($id) ||
		CheckForBadStuff($itemName1) ||
	    CheckForBadStuff($itemDesc1) ||
	    CheckForBadStuff($itemSets1) ||
	    CheckForBadStuff($itemName2) ||
	    CheckForBadStuff($itemDesc2) ||
	    CheckForBadStuff($itemSets2) ||
	    CheckForBadStuff($itemName3) ||
		CheckForBadStuff($itemDesc3) ||
		CheckForBadStuff($itemSets3) ||
		CheckForBadStuff($itemName4) ||
		CheckForBadStuff($itemDesc4) ||
		CheckForBadStuff($itemSets4) ||
		CheckForBadStuff($itemName5) ||
		CheckForBadStuff($itemDesc5) ||
		CheckForBadStuff($itemSets5) ||
		CheckForBadStuff($itemName6) ||
		CheckForBadStuff($itemDesc6) ||
		CheckForBadStuff($itemSets6) ||
		CheckForBadStuff($itemName7) ||
		CheckForBadStuff($itemDesc7) ||
		CheckForBadStuff($itemSets7) ||
		CheckForBadStuff($itemName8) ||
		CheckForBadStuff($itemDesc8) ||
		CheckForBadStuff($itemSets8) ||
		CheckForBadStuff($itemName9) ||
		CheckForBadStuff($itemDesc9) ||
		CheckForBadStuff($itemSets9) ||
		CheckForBadStuff($itemName10) ||
		CheckForBadStuff($itemDesc10) ||
		CheckForBadStuff($itemSets10) ||
		CheckForBadStuff($selitem))
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
		if (!ValidateLength($itemDesc1, 10000))
		{
			$reason = $sectionType . ': "' . $itemName1 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		// Section Length Validation
		if (!ValidateLength($itemDesc2, 10000))
		{
			$reason = $sectionType . ': "' . $itemName2 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}

		// Section Length Validation
		if (!ValidateLength($itemDesc3, 10000))
		{
			$reason = $sectionType . ': "' . $itemName3 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		// Section Length Validation
		if (!ValidateLength($itemDesc4, 10000))
		{
			$reason = $sectionType . ': "' . $itemName4 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		// Section Length Validation
		if (!ValidateLength($itemDesc5, 10000))
		{
			$reason = $sectionType . ': "' . $itemName5 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		// Section Length Validation
		if (!ValidateLength($itemDesc6, 10000))
		{
			$reason = $sectionType . ': "' . $itemName6 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		// Section Length Validation
		if (!ValidateLength($itemDesc7, 10000))
		{
			$reason = $sectionType . ': "' . $itemName7 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		// Section Length Validation
		if (!ValidateLength($itemDesc8, 10000))
		{
			$reason = $sectionType . ': "' . $itemName8 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		// Section Length Validation
		if (!ValidateLength($itemDesc9, 10000))
		{
			$reason = $sectionType . ': "' . $itemName9 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		// Section Length Validation
		if (!ValidateLength($itemDesc10, 10000))
		{
			$reason = $sectionType . ': "' . $itemName10 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}

		// Section specific variables
		$section->itemName1 = $itemName1;
		$section->itemDesc1 = $itemDesc1;
		$section->itemSets1 = $itemSets1;
		$section->itemName2 = $itemName2;
		$section->itemDesc2 = $itemDesc2;
		$section->itemSets2 = $itemSets2;
		$section->itemName3 = $itemName3;
		$section->itemDesc3 = $itemDesc3;
		$section->itemSets3 = $itemSets3;
		$section->itemName4 = $itemName4;
		$section->itemDesc4 = $itemDesc4;
		$section->itemSets4 = $itemSets4;
		$section->itemName5 = $itemName5;
		$section->itemDesc5 = $itemDesc5;
		$section->itemSets5 = $itemSets5;
		$section->itemName6 = $itemName6;
		$section->itemDesc6 = $itemDesc6;
		$section->itemSets6 = $itemSets6;
		$section->itemName7 = $itemName7;
		$section->itemDesc7 = $itemDesc7;
		$section->itemSets7 = $itemSets7;
		$section->itemName8 = $itemName8;
		$section->itemDesc8 = $itemDesc8;
		$section->itemSets8 = $itemSets8;
		$section->itemName9 = $itemName9;
		$section->itemDesc9 = $itemDesc9;
		$section->itemSets9 = $itemSets9;
		$section->itemName10 = $itemName10;
		$section->itemDesc10 = $itemDesc10;
		$section->itemSets10 = $itemSets10;
		$section->selitem = $selitem;
		
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
