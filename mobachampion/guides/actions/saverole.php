<?php 
require_once('../../forum/SSI.php');
require('../../rb/rb.php');
require('../../rb/connect.php');

$guideid = $_POST['guideid'];
$id = $_POST['roleid'];

$role1 = $_POST['role1'];
$role1desc = $_POST['role1desc'];
$role2 = $_POST['role2'];
$role2desc = $_POST['role2desc'];
$role3 = $_POST['role3'];
$role3desc = $_POST['role3desc'];
$role4 = $_POST['role4'];
$role4desc = $_POST['role4desc'];
$selrole = $_POST['selrole'];

$sectionName = 'guidev2role';

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
		CheckForBadStuff($role1) || 
		CheckForBadStuff($role1desc) ||
		CheckForBadStuff($role2) ||
		CheckForBadStuff($role2desc) || 
		CheckForBadStuff($role3) ||
		CheckForBadStuff($role3desc) ||
		CheckForBadStuff($role4) || 
		CheckForBadStuff($role4desc) ||
		CheckForBadStuff($selrole))
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
			$reason = 'You tried to save to a role that does not belong to you (' . $guide->author . ',' . $section->owner . ')';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
	}

	if ($section->id >= 0)
	{
		$success = true;
		$reason = "Roles saved successfully";
	
		// All sections musth ave this variable
		$section->owner = $context['user']['name'];

		// Section Length Validation
		if (!ValidateLength($role1desc, 10000))
		{
			$reason = 'Role: "' . $role1 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		if (!ValidateLength($role2desc, 10000))
		{
			$reason = 'Role: "' . $role2 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		if (!ValidateLength($role3desc, 10000))
		{
			$reason = 'Role: "' . $role3 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason, 'id' => 0);
			echo json_encode($data);
			exit(0);
		}
		
		if (!ValidateLength($role4desc, 10000))
		{
			$reason = 'Role: "' . $role4 . '" has a description that is too long (max 10000 characters)';
			$data = array('fail'=> true,'message'=>$reason);
			echo json_encode($data);
			exit(0);
		}
				
		// Section specific variables
		$section->role1	= $role1;
		$section->role1desc	= $role1desc;
		$section->role2	= $role2;
		$section->role2desc	= $role2desc;
		$section->role3	= $role3;
		$section->role3desc	= $role3desc;
		$section->role4	= $role4;
		$section->role4desc	= $role4desc;
		$section->selrole = $selrole;
		
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
