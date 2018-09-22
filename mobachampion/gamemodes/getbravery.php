<?php

$shaperCount = 0;
$shaper = null;
while($shaperCount < 1)
{
	$shaper = $shaperDataJSON[array_rand($shaperDataJSON)];
	if (!in_array($shaper->name, $shapers))
	{
		array_push($shapers, $shaper->name);
		$shaperCount++;
	}
}


$role = null;
$roleCount = 0;
while($roleCount < 1)
{
	$role = $roleDataJSON[array_rand($roleDataJSON)];
	if ($role->name == "Hunter")
	{
		if ($numHunters < 2)
		{
			$numHunters++;
			$roleCount++;
		}
	}
	else if ($role->name == "Gladiator")
	{
		if ($numGladiators < 2)
		{
			$numGladiators++;
			$roleCount++;
		}
	}
	else
	{
		$roleCount++;
	}
}

$itemCount = 0;
$items = array();
while($itemCount < 6)
{
	$item = $ipDataJSON[array_rand($ipDataJSON)];
	if (strlen($item->buildsfrom) > 0 && strlen($item->buildsinto) == 0)
	{
		if (!in_array($item->name, $items))
		{
			array_push($items, $item->name);
			$itemCount++;
		}
	}
}

$spellCount = 0;
$spells = array();
while($spellCount < 3)
{
	$spell = $spellDataJSON[array_rand($spellDataJSON)];
	if (!in_array($spell->name, $spells))
	{
		array_push($spells, $spell->name);
		$spellCount++;
	}
}

$ordernum = rand(0,5);
if ($ordernum == 0)
{
	$order = 'Max Q > W > E';
}
else if ($ordernum == 1)
{
	$order = 'Max Q > E > W';
}
else if ($ordernum == 2)
{
	$order = 'Max W > Q > E';
}
else if ($ordernum == 3)
{
	$order = 'Max W > E > Q';
}
else if ($ordernum == 4)
{
	$order = 'Max E > Q > W';
}
else if ($ordernum == 5)
{
	$order = 'Max E > W > Q';
}

$data = array('shaper'=> $shaper->name,'role'=>$role->name,'items'=>$items,'spells'=>$spells,'order'=>$order);

?>