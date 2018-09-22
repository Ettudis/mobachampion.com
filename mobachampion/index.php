<?php
$msHome = true;
include('header.php');
?>

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

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<?php
// echo '<div class="alert alert-info">Updating site - be wary of dragons.</div>';
?>

<?php
require_once('forum/Sources/Display.php');

$page = 0;
$postsPerPage = 6;
$startPage = 0;
if (isset($_GET['page']) && is_numeric($_GET['page']))
{
	$page = $_GET['page'];
	$startPage = $page * $postsPerPage;
}

if ($page < 1)
{
	$page = 1;
}

$startPage = ($page-1) * $postsPerPage;

// todo: replace with function to grab posts 'm-->n' instead of recent 8 
$PostList = ssi_recentTopics_newsPage($startPage, $postsPerPage, null, array(2,8,9,10), 'array');

	$totalPosts = ssi_recentTopics_countNewsPage(2);
	$totalPages = ceil($totalPosts / $postsPerPage);
	
	if ($page != 1)
	{
		CreateButtons($page, $totalPosts, $totalPages);
	}
	
$postCount = 0;
foreach ($PostList as $Post) 
{	
    $link = 'http://www.moba-champion.com/news/' . $Post['topic'];
	echo '<div class="news_post">';
	echo '<div class="news_header">';
	echo '<div class="news_header_text">';
	echo '<div class="news_title"><a href="' . $link . '">' . $Post['subject'] . '</a></div>';
	echo '</div>';
	echo '</div>';
	
	$topic = $Post['topic'];
	$board = 2; // news
	
	Display();
	$message = prepareDisplayContext();
	
	echo '<div class="news_content">';
	echo '<p>';
    
    $shouldWeJump = strpos($message['body'], '!JUMP!');
    if ($shouldWeJump == false)
    {
	    echo $message['body'];
    }
    else
    {
        echo substr($message['body'], 0, $shouldWeJump);
        echo '<div class="moreinfo"><a href="' . $link . '"><i class="fa fa-share-square"></i> Continue reading for more info.</a></div>';
    }
	echo '</p>';
	
	if ($Post['topic'] == 268)
	{
		echo '<div><iframe src="http://www.gamespot.com/videos/embed/6418298/" width="640" height="400" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
	}
	
	echo '</div>';
		
    echo '<div class="news_comment_footer">';
	echo '<div class="news_poster"><i>By&nbsp;<b>', $Post['poster']['name'], '</b>,&nbsp;', $Post['time'], '</i></div>';	
	echo '<div class="news_comment_num">';
    echo '<a href="' . $link . '#comments" class="nounderline"><i class="fa fa-comment"></i></a> <a href="' . $link . '#comments">' . $Post['replies'] . ' comments</a>';
	echo '</div>';
    echo '</div>';
	
	echo '</div>';
	
	$postCount++;
	
	if ($postCount == 3)
	{
		include('widgets/adwidget2.php');
	}
}

	unset($PostList);

	CreateButtons($page, $totalPosts, $totalPages);
	
?>
		
</div>

<div class="article_column2">
<?php 
include('widgets/sidebar.php');
?>
</div>

</div> <!-- main container -->
</div> <!-- maincontent -->
</div>

<?php
include('footer.php');
?>
