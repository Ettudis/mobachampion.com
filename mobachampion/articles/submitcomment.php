<?php 
require_once('../forum/SSI.php');
require_once('../forum/Sources/Subs-Post.php');
require('../rb/rb.php');
require('../rb/connect.php');

if ($context['user']['is_logged'] == false)
{
  $data = array('success'=> success,'message'=>$message);
  echo json_encode($data);
}
else
{
	$success = false;
	$message = "";

	$topic = $_POST['topic'];
	$output = $_POST['comment'];
	$subject = "";
	$board = 8;

	// Collect all necessary parameters for the creation of the post.
	$msgOptions = array(
		'id' =>  0,
		'subject' => $subject,
		'body' => $output,
		'smileys_enabled' => true,
	);

	$topicOptions = array(
		'id' => $topic,
		'board' => $board,
		'mark_as_read' => true,
	);

	$posterOptions = array(
		'id' => $context['user'][id],
		'poster' => $context['user']['username'],
	);

	//	Finally create the post!!! :D
	if (createPost($msgOptions, $topicOptions, $posterOptions))
	{
		$success = true;
		$message = "success";
	}
	else
	{
		$success = true;
		$message = "failure";
	}

	$data = array('success'=> success,'message'=>$message);
	echo json_encode($data);
}

?>