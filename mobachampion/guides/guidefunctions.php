<?php
require('./SBBCodeParser.php');

function ParseText($input)
{
	try
	{
		$Parser = new SBBCodeParser\Node_Container_Document();
		$out = $Parser->parse($input)->detect_links()->get_html();
		return parseCode($out);
	}
	catch(Exception $e)
	{
		return '<p><b>BBCode Parsing Error: </b>' . $e->getMessage() . '</p>' . $input;
	}
}

function parseCode($txt)
{
   // these functions will clean the code first
   $ret = $txt;
   
   // abilities
   global $GuideShaper, $GuideShaperSmall;
	
   $ret = str_replace('[p]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/p.png" class="image32small abilitytip" title="p" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="p"></span>', $ret);
   $ret = str_replace('[q]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/q.png" class="image32small abilitytip" title="q" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="q"></span>', $ret);
   $ret = str_replace('[w]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/w.png" class="image32small abilitytip" title="w" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="w"></span>', $ret);
   $ret = str_replace('[e]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/e.png" class="image32small abilitytip" title="e" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="e"></span>', $ret);
   $ret = str_replace('[r]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/r.png" class="image32small abilitytip" title="r" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="r"></span>', $ret);
   $ret = str_replace('[P]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/p.png" class="image32small abilitytip" title="p" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="p"></span>', $ret);
   $ret = str_replace('[Q]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/q.png" class="image32small abilitytip" title="q" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="q"></span>', $ret);
   $ret = str_replace('[W]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/w.png" class="image32small abilitytip" title="w" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="w"></span>', $ret);
   $ret = str_replace('[E]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/e.png" class="image32small abilitytip" title="e" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="e"></span>', $ret);
   $ret = str_replace('[R]', '<img src="http://www.moba-champion.com/images/shapers/' . $GuideShaperSmall . '/r.png" class="image32small abilitytip" title="r" data-shaper="' . $GuideShaper . '"> <span class="orange_text abilitytip" title="r"></span>', $ret);
   
   // spells
   $ret = preg_replace_callback ('#\[spell\](.+)\[\/spell\]#iUs', function ($matches) 
	{
		return '<img src="http://www.moba-champion.com/images/spells/Spell_' . ucwords(strtolower($matches[1])) . '.png" class="image32small spelltip" title="' . ucwords(strtolower($matches[1])) . '"></img> <span class="orange_text spelltip" title="' . ucwords(strtolower($matches[1])) . '">' . ucwords(strtolower($matches[1])) . '</span>';
	}, $ret);
			
   // items
   $ret = preg_replace_callback('#\[item\](.+)\[\/item\]#iUs', function ($matches)
   {
		return '<img src="http://www.moba-champion.com/images/itempalooza/' . ucwords($matches[1]) . '.png" class="image32small iptip" title="' . ucwords($matches[1]) . '"></img> <span class="orange_text iptip" title="' . ucwords($matches[1]) . '">' . ucwords($matches[1]) . '</span>';
   }, $ret);
   
   // roles
   $ret = preg_replace_callback ('#\[role\](.+)\[\/role\]#iUs', function ($matches) 
			{
				return '<img src="http://www.moba-champion.com/images/roles/' . strtolower($matches[1]) . '.png" class="image32small roletip" title="' . ucwords($matches[1]) . '"></img> <span class="orange_text roletip" title="' . ucwords($matches[1]) . '">' . ucwords($matches[1]) . '</span>';
			}, $ret);
			
   //shapers
   $ret = preg_replace_callback ('#\[shaper\](.+)\[\/shaper\]#iUs', function ($matches) 
			{
				return '<img src="http://www.moba-champion.com/images/shapers/' . strtolower($matches[1]) . '.png" class="image32small shapertip" title="' . ucwords($matches[1]) . '"></img> <span class="orange_text shapertip" title="' . ucwords($matches[1]) . '">' . ucwords($matches[1]) . '</span>';
			}, $ret);
   
   // return parsed string
   return $ret;
}


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

function startsWith($haystack, $needle)
{
    return $needle === "" || strpos($haystack, $needle) === 0;
}
function endsWith($haystack, $needle)
{
    return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
}


function FormatLoadoutText($text)
{
	$textExp = explode(" ", $text, 2);
	if (count($textExp) == 2)
	{
		switch($textExp[1])
		{
			case "Haste":
				return '<span class="hastetext">+' . $textExp[0] . '</span> ' . $textExp[1];
				break;
			case "Power":
				return '<span class="powertext">+' . $textExp[0] . '</span> ' . $textExp[1];
				break;
			case "Health":
				return '<span class="healthtext">+' . $textExp[0] . '</span> ' . $textExp[1];
				break;
			case "Health Regeneration":
				return '<span class="regentext">+' . $textExp[0] . '</span> ' . $textExp[1];
				break;
			case "Armor":
				return '<span class="armortext">+' . $textExp[0] . '</span> ' . $textExp[1];
				break;
			case "Magic Resistance":
				return '<span class="mrtext">+' . $textExp[0] . '</span> ' . $textExp[1];
				break;
			case "Lifedrain":
				return '<span class="lifedraintext">+' . $textExp[0] . '</span> ' . $textExp[1];
				break;
			default:
				return '<span class="misctext">+' . $textExp[0] . '</span> ' . $textExp[1];
		}
	}
	else
	{
		return $text;
	}
}


?>