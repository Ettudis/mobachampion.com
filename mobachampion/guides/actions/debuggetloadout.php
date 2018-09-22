<?php 
require_once('../../forum/SSI.php');
require('../../rb/rb.php');
require('../../rb/connect.php');

function AddSpecial(&$Bonuses, $special)
{
	$specialStr = "Z " . $special;
	array_push($Bonuses, $specialStr);
}

function AddBonus(&$Bonuses, $bonus)
{
	$bonuses = explode(' ', $bonus);
	$val = $bonuses[0];
	$type = $bonuses[1];
	
	$arrlength=count($Bonuses);
	$bFound = false;
	for($x=0;$x<$arrlength;$x++)
	{
		$b = $Bonuses[$x];
		$bstr = explode(' ', $b);
		$bVal = $bstr[0];
		$bType = $bstr[1];
		
		if ($bType == $type)
		{
			$newVal = $bVal + $val;
			$newStr = $newVal . ' ' . $bType;
			$Bonuses[$x] = $newStr;
			$bFound = true;
		}
	}
	
	if ($bFound == false)
	{
		array_push($Bonuses, $bonus);
	}
}

$Bonuses = array();

$getLoadout = $_GET["id"];

$shapeData = file_get_contents('../../loadouts/shapes.json');
$shapeDataJSON = json_decode($shapeData);

$gemData = file_get_contents('../../loadouts/gems.json');
$gemDataJSON = json_decode($gemData);	

if (!is_null($getLoadout))
{			
	$loadoutBean = R::load('loadout', $getLoadout);

	if (!is_null($loadoutBean))
	{	
		$loadoutStr = $loadoutBean->fullstr;
		
		$shapes = explode("_", $loadoutStr);
				
		foreach ($shapes as $shape)
		{		
			if ($shape != "")
			{
				$strs = explode(',', $shape);
				$shapeId = $strs[2];
				$numGems = $strs[4];
				
				$found = false;
				foreach ($shapeDataJSON->special as $shape_entry)
				{
					if ($shape_entry->id == $shapeId)
					{
						AddSpecial($Bonuses, $shape_entry->special);
						$found = true;
						break;
					}
				}
				
				if ($found == false)
				{
					foreach ($shapeDataJSON->health as $shape_entry)
					{
						if ($shape_entry->id == $shapeId)
						{
							$bonusStrs = explode(',', $shape_entry->bonus);
							foreach($bonusStrs as $bonusStr)
							{
								AddBonus($Bonuses, $bonusStr);
							}
							
							$found = true;
							break;
						}
					}
				}
				
				if ($found == false)
				{
					foreach ($shapeDataJSON->utility as $shape_entry)
					{
						if ($shape_entry->id == $shapeId)
						{
							$bonusStrs = explode(',', $shape_entry->bonus);
							foreach($bonusStrs as $bonusStr)
							{
								AddBonus($Bonuses, $bonusStr);
							}
							$found = true;
							break;
						}
					}
				}
				
				if ($found == false)
				{
					foreach ($shapeDataJSON->offense as $shape_entry)
					{
						if ($shape_entry->id == $shapeId)
						{
							$bonusStrs = explode(',', $shape_entry->bonus);
							foreach($bonusStrs as $bonusStr)
							{
								AddBonus($Bonuses, $bonusStr);
							}
							$found = true;
							break;
						}
					}
				}
				
				if ($found == false)
				{
					foreach ($shapeDataJSON->mitigation as $shape_entry)
					{
						if ($shape_entry->id == $shapeId)
						{
							$bonusStrs = explode(',', $shape_entry->bonus);
							foreach($bonusStrs as $bonusStr)
							{
								AddBonus($Bonuses, $bonusStr);
							}
							$found = true;
							break;
						}
					}
				}
				
				$endIter = 5 + $numGems;
				for ($i = 5; $i < $endIter; $i++) 
				{
					foreach ($gemDataJSON as $gem)
					{
						if ($gem->id == $strs[$i])
						{
							$bonusStrs = explode(',', $gem->bonus);
							foreach($bonusStrs as $bonusStr)
							{
								AddBonus($Bonuses, $bonusStr);
							}
							break;
						}
					}
					
				}
			}
		}
		
		$arrlength=count($Bonuses);
		if ($arrlength == 0)
		{
			echo 'none';
		}
		else
		{
			for($x=0;$x<$arrlength;$x++)
			{
				echo $Bonuses[$x];
				if ($x < $arrlength-1)
				{
					echo ',';
				}
			}
		}
	}
	else
	{
		echo 'invalid';
	}
}
else
{
	echo 'invalid';
}

?>
