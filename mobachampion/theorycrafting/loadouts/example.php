<?php
$usePerksEditorCSS = true;
$moba_champ_title = 'MOBA-Champion - Loadout Editor';
$moba_champ_desc = 'test';

include('../../header.php');

$loadout = $_GET["l"];
$loadoutUrl = "http://www.moba-champion.com/loadouts/index.php?l=";

echo '<div style="color: white; margin-left: 16px;">';
if (!is_null($loadout))
{
	$loadoutBean = R::load('loadout', $loadout);
	if (!is_null($loadout))
	{
		$loadoutUrl .= $loadout;
		echo $loadoutStr = $loadoutBean->fullstr;
		
		$shapes = explode("_", $loadoutStr);
		echo '<p>Number of Shapes: ' . count($shapes) . '</p>';
		foreach ($shapes as $shape)
		{		
			if ($shape != "")
			{
				echo '<p>' . $shape . ' - ';
				$shapeInfo = explode(",", $shape);
				echo 'Left (' . $shapeInfo[0] . '), '; // positional
				echo 'Top (' . $shapeInfo[1] . '), '; // positional
				echo 'Shape ID (' . $shapeInfo[2] . '), '; // used for lookup into shapes.json
				echo 'Rotation (' . $shapeInfo[3] . '), '; // positional
				echo 'Num Gems(' . $shapeInfo[4] . '), '; // number of gems
				echo 'Gem IDs: remainer of string</p>';
			}
		}
	}
}
echo '</div>';
?>
