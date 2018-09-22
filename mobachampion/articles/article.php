<?php
include('../header.php');
?>

<div id="main_container">

<div id="header_spacer"></div>

<div class="article_content">

<?php
require_once('../forum/Sources/Display.php');

$newsId = $_GET['id'];
$numNews = 0;
if (!isset($newsId))
{
  echo '<div class="news_post">
        <div class="news_header"><div class="news_header_text"><div class="news_title">News page could be found.</div></div></div>
        <div class="news_content">';
  echo 'You have reached this page in error because a News ID was not specified';
  echo '</div></div>';
  $numNews = 1;
}
else if (!is_numeric($newsId))
{
  echo $newsId;
}
else
{	
	$topic = $newsId;
	$board = 8; // articles
	
	echo '<script>';	
	echo 'var comment_topic = ' . $topic . ';';
	echo '</script>';
	
	echo '<script src="newcomments.js"></script>';

	Display();
	$message = prepareDisplayContext();
	
	echo '<div class="news_post">';
	echo '<div class="news_header">';
	echo '<div class="news_header_text">';
	echo '<div class="news_title">', $message['link'], '</div>';
	echo '<div class="news_poster">By&nbsp;', $message['member']['name'], ',&nbsp;', $message['time'], '</div>';
	echo '</div>';
	echo '</div>';


	echo '<div class="news_content">';
	echo '<p>';
    $theMessage = str_replace("!JUMP!", "<BR>", $message['body']);
	echo $theMessage;
	echo '</p>';
	echo '</div>';

	echo '</div>';
	$numNews++;
}

if ($numNews == 0)
{
    echo '<div class="news_post">
        <div class="news_header"><div class="news_header_text"><div class="news_title">News page could be found.</div></div></div>
        <div class="news_content">';
  echo 'You have reached this page in error because an invalid ID was specified';
  echo '</div></div>';
}
else
{
	$numPosts = $context['total_visible_posts'];
	$postsPerPage = intval($context['messages_per_page']);
	$numButtons = ceil($numPosts / $postsPerPage);
	
	if ($numPosts > 1)
	{		
		echo '<div class="news_comment_header">';
		echo '<div class="news_comment_h3">Comments</div>';
			
		echo '<div class="news_comment_buttons">';
		echo '<div class="btn-toolbar">';
		
		for ($i = 1; $i <= $numButtons; $i++) 
		{
			echo '<div class="btn-group">';
			echo '<a href="http://www.moba-champion.com/news/index.php?id=' . $topic . '&page=' . ($i-1) .'"><button>';
			echo $i;
			echo '</button></a>';
			echo '</div>';
		}

		echo '</div>'; // button toolbar
		echo '</div>'; // button right floater
		echo '</div>'; // comment header
	}
        
		echo '<div class="news_comment_section" id="comments">';
	  
	  // comment creation
		if ($context['user']['is_logged'] == true)
		{  
		  echo '<div class="news_comment">';
			echo '<div class="news_comment_post">';
			  echo '<div class="news_comment_post_left">';
				echo 'Comment: ';
			  echo '</div>';
			  echo '<div class="news_comment_post_right">';
				echo '<div class="news_comment_post_right_text">';
				  echo '<textarea rows="4" cols="150" maxlength="400" class="news_comment_input" onfocus="if (this.value == \'Comment...\') 
								{
									this.value = \'\';
								}" 
						onblur="if (this.value == \'\') 
								{
									this.value = \'Comment...\';
								}" autocomplete="off"/>Comment...</textarea>';
				echo '</div>';
				echo '<div class="news_comment_post_right_button">';
				  echo '<button class="btn btn-primary" id="comment_button">Post Comment</button>';
				  echo '<span class="news_comment_post_chars_remaining"> 400 characters remaining.</span>';
				echo '</div>';
			  echo '</div>';
			echo '</div>';
		  echo '</div>'; // news_comment
		}
		
	if ($numPosts > 1)
	{				
		$topic = $newsId;
		$startPage = $_GET['page'];
		$board = 2; // news
		
		if (!isset($startPage))
		{
			$startPage = 0;
		}
		
		$startId = $startPage * 15;
		$_REQUEST['start'] = $startId;
		Display();
		
		$first = true;
		while ($message = $context['get_message']())
		{
		  if ($first == false)
		  {
			  // comment writing
			  echo '<div class="news_comment">';
				  echo '<div class="news_comment_post_left">';
					echo '<B>' . $message['member']['username'] . '</B>, ' . $message['time'];
					
					$msgId = $message['id'];
					
					if ($context['user']['is_logged'] == true &&
						$message['member']['username'] == $context['user']['username'])
					{
						$editUrl = 'http://moba-champion.com/forum/index.php?action=post;msg=' . $msgId . ';topic=' . $newsId . '';
						echo ' (' . '<a href="' . $editUrl . '">Edit</a>' . ')';
					}
					else
					{
						$quoteURL = 'http://moba-champion.com/forum/index.php?action=post;quote=' . $msgId . ';topic=' . $newsId . '';
						echo ' (' . '<a href="' . $quoteURL . '">Quote</a>' . ')';
					}
					
				  echo '</div>';
				  echo '<div class="news_comment_right">';
					echo '<div class="news_comment_body">';
						echo $message['body'];
					echo '</div>';
				  echo '</div>';
			  echo '</div>'; // news_comment
		  }
		  else
		  {
			$first = false;
		  }
		}	  
		
    } // numPosts > 0
	
	echo '</div>'; // news_comment_section
}

?>

<script>
$(".news_comment_input").bind("keyup", function(event, ui) 
{                          
	// Write your code here
	var numRemaining = 400 - $(this).val().length;
	if (numRemaining < 25)
	{
		$(".news_comment_post_chars_remaining").html("<font color=\"red\"> " + numRemaining + " characters remaining.</font>");
	}
	else if (numRemaining < 5)
	{
		$(".news_comment_post_chars_remaining").html("<font color=\"yellow\"> " + numRemaining + " characters remaining.</font>");
	}
	else
	{
		$(".news_comment_post_chars_remaining").html(" " + numRemaining + " characters remaining.");
	}
	
	if ($(this).val() != "" && $(this).val() != "Comment...")
	{
		$(this).css('border', 'none');
	}
});
</script>

</div>

<div class="article_column2">
<?php 
include('../widgets/shaperwidget.php');
include('../widgets/adwidget.php');
include('../widgets/streamwidget.php');
include('../widgets/guidewidget.php');
?>
</div>

</div> <!-- main container -->
</div> <!-- maincontent -->

<?php
include('../footer.php');
?>
