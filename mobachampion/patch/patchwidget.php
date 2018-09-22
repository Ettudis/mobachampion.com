<?php
	if (!is_null($PatchId))
	{
		$path = 'src/patch' . $PatchId . '.json';
		$patchData = file_get_contents($path);
		if ($patchData != false)
		{
			$patchDataJSON = json_decode($patchData);

			foreach ($patchDataJSON->patch as $patch)
			{
				if (!is_null($patch->shaper))
				{
					$data .= '<h5><img src="http://www.moba-champion.com/images/shapers/small/' . strtolower($patch->shaper) . '.png" style="width: 24px; height: 24px;"> ' . $patch->shaper . '</h5>';
				}
				
				if (!is_null($patch->role))
				{
					$data .= '<h5><img src="http://www.moba-champion.com/images/roles/' . strtolower($patch->role) . '.png" style="width: 24px; height: 24px;"> ' . $patch->role . '</h5>';
				}

				if (!is_null($patch->spell))
				{
					$data .= '<h5><img src="http://www.moba-champion.com/images/spells/Spell_' . $patch->spell . '_1.png" style="width: 24px; height: 24px;"> ' . $patch->spell . '</h5>';
				}

				if (!is_null($patch->item))
				{
					$data .= '<h5><img src="http://www.moba-champion.com/images/items/list/' . $patch->item . '.png" style="width: 24px; height: 24px;"> ' . $patch->item . '</h5>';
				}
				
				if (!is_null($patch->itemp))
				{
					$data .= '<h5><img class="iptip" title="'. $patch->itemp .'" src="http://www.moba-champion.com/images/itempalooza/' . $patch->itemp . '.png" style="width: 24px; height: 24px;"> ' . $patch->itemp . '</h5>';
				}

				if (!is_null($patch->loadout))
				{
					$data .= '<h5>' . $patch->loadout . '</h5>';
				}				
				
				$data .= '<p>' . $patch->data . '</p>';
			}
		}
	}
?>