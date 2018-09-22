<?php 
	function CreateButtons($page, $totalPosts, $totalPages)
	{
		$written = 0;
		
		echo '<div class="news_footer" style="padding-left: 250px;">';
		echo '<div class="ot_btn_menu">';
		
		if ($page > 1)
		{
			echo '<a href="http://www.moba-champion.com/index.php?page=' . ($page-1) . '">
					<div class="ot_btn_header_prev ot_btn_header">&larr;</div>
				  </a>';
		}
		else
		{
			echo '<div class="ot_btn_header_prev ot_btn_header">&larr;</div>';		
		}
		$written++;
		
		if ($page == 1)
		{
			echo '<a href="http://www.moba-champion.com/index.php?page=1"><div class="ot_btn_header_prev ot_btn_active">1</div></a>';
		}
		else
		{
			echo '<a href="http://www.moba-champion.com/index.php?page=1">
					<div class="ot_btn_header">1</div>
				  </a>';
		}
		$written++;
		
		if ($page > 4)
		{
			echo '<div class="ot_btn_spacer">...</div>';
			$written++;
		}
		
		if (($totalPages - $page) > 4)
		{
			$written++;
		}
		
		$written++;
		
		$remaining = 9 - $written;
		
		$startIndex = 0;
		$endIndex = 0;
		if ($page < 5)
		{
			$startIndex = 2;
			$endIndex = 2 + $remaining;
		}
		else if (($totalPages - $page) < 5)
		{
			$endIndex = $totalPages-1;
			$startIndex = $endIndex - $remaining;
		}
		else
		{
			$startIndex = $page - floor($remaining/2);
			$endIndex = $page + floor($remaining/2);
		}
		
		for ($i = $startIndex; $i <= $endIndex; $i++) 
		{
			if ($i > 1 && $i < $totalPages)
			{
				if ($i == $page)
				{
					echo '<a href="http://www.moba-champion.com/index.php?page=' . ($i) . '"><div class="ot_btn_header_prev ot_btn_active">' . $i .'</div></a>';
					$written++;
				}
				else
				{
					echo '<a href="http://www.moba-champion.com/index.php?page=' . ($i) . '"><div class="ot_btn_header_prev ot_btn_header">' . $i .'</div></a>';
					$written++;
				}
			}
			else
			{
				break;
			}
		}
		
		if (($totalPages - $page) > 4)
		{
			echo '<div class="ot_btn_spacer">...</div>';
		}
			
		if ($page != $totalPages)
		{
			echo '<a href="http://www.moba-champion.com/index.php?page=' . ($totalPages) . '">
						<div class="ot_btn_header">' . ($totalPages) . '</div>
				  </a>';
			echo '<a href="http://www.moba-champion.com/index.php?page=' . ($page+1) . '">
					<div class="ot_btn_header_next">&rarr;</div>
				  </a>';
		}
		else
		{
			echo '<a href="http://www.moba-champion.com/index.php?page=' . ($totalPages) . '">
					<div class="ot_btn_header ot_btn_active">' . ($totalPages) . '</div>
				  </a>';
			echo '<div class="ot_btn_header_next">&rarr;</div>';
		}
				  
		echo '</div>';
		echo '</div>';
	}
?>