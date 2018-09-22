<?php 
require_once('../../forum/SSI.php');
require('../../rb/rb.php');
require('../../rb/connect.php');

$success = false;
$message = "";

$guideId = $_POST['topic'];
$commentText = $_POST['comment'];

if ($context['user']['is_logged'])
{
	$success = true;
	$reason = "logged in";
	
	$guide_comment = R::dispense('guidecommentv2');
	$guide_comment->commentText = $commentText;
	$guide_comment->guideId  = $guideId;
	$guide_comment->user = $context['user']['username'];
	$guide_comment->posttime = time();
	
	$id = R::store($guide_comment);
}
else
{
	$success = false;
	$reason = "not logged in";
}

$data = array('success'=> true,'message'=>$reason);
echo json_encode($data);

?>
