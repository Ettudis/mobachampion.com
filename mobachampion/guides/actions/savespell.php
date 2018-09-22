<?php 
require_once('../../forum/SSI.php');
require('../../rb/rb.php');
require('../../rb/connect.php');

$guideid = $_POST['guideid'];
$id = $_POST['spellid'];

$spellNames1 = $_POST['spellNames1'];
$spellDescs1 = $_POST['spellDescs1'];
$spellNames2 = $_POST['spellNames2'];
$spellDescs2 = $_POST['spellDescs2'];
$spellNames3 = $_POST['spellNames3'];
$spellDescs3 = $_POST['spellDescs3'];
$selspell = $_POST['selspell'];

$sectionType = 'Spell';
$sectionName = 'guidev2spell';

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
		strpos($badstuff,'iframe') !== false ) 
	{
		return true;
	}
	
	return false;
}

if ($context['user']['is_logged'])
{
	if ($_SESSION['ban']['cannot_access'] != NULL)
	{
		$reason = 'Unknown error saving guide (code: 41). Please try again later.';
		$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
		echo json_encode($data);
		exit(0);
	}
	
	if (CheckForBadStuff($spellNames1) ||
		CheckForBadStuff($spellDescs1) ||
		CheckForBadStuff($spellNames2) ||
		CheckForBadStuff($spellDescs2) ||
		CheckForBadStuff($spellNames3) ||
		CheckForBadStuff($spellDescs3) ||
		CheckForBadStuff($spellNames1) ||
		CheckForBadStuff($spellNames1) ||
		CheckForBadStuff($spellDescs2) ||
		CheckForBadStuff($spellDescs2) ||
		CheckForBadStuff($spellNames3) ||
		CheckForBadStuff($spellDescs3) ||
		CheckForBadStuff($spellNames1) ||
		CheckForBadStuff($spellNames1) ||
		CheckForBadStuff($spellDescs2) ||
		CheckForBadStuff($spellDescs2) ||
		CheckForBadStuff($spellNames3) ||
		CheckForBadStuff($spellDescs3) ||
		CheckForBadStuff($selspell))
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
		if (!ValidateLength($spellDescs1, 10000))
		{
			$reason = $sectionType . ': "' . $spellNames1 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		if (!ValidateLength($spellDescs2, 10000))
		{
			$reason = $sectionType . ': "' . $spellNames2 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		if (!ValidateLength($spellDescs3, 10000))
		{
			$reason = $sectionType . ': "' . $spellNames3 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
				
		// Section specific variables
		$section->spellNames1 = $spellNames1;
		$section->spellDescs1 = $spellDescs1;
		$section->spellNames2 = $spellNames2;
		$section->spellDescs2 = $spellDescs2;
		$section->spellNames3 = $spellNames3;
		$section->spellDescs3 = $spellDescs3;
		$section->selspell = $selspell;
		
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
