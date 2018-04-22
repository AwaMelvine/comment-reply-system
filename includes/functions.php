<?php 
	$db = mysqli_connect("localhost", "root", "", "comment-reply-system");

	$p_result = mysqli_query($db, "SELECT * FROM posts WHERE id=1");

	$post = mysqli_fetch_assoc($p_result);

	$c_result = mysqli_query($db, "SELECT * FROM comments WHERE post_id=" . $post['id']);
	$comments = mysqli_fetch_all($c_result, MYSQLI_ASSOC);



	// If the user clicked submit on comment form...
	if (isset($_POST['comment_posted'])) {
		
		global $db;
		$comment_text = $_POST['comment_text']; 

		$sql = "INSERT INTO comments (post_id, user_id, body, created_at, updated_at) VALUES (1, 1, '$comment_text', now())"
		$result = mysqli_query($db, $sql);

		$comment_text = $_POST['comment_text']; 
		exit();
	}


	function getUsernameById($id)
	{
		global $db;
		$result = mysqli_query($db, "SELECT username FROM users WHERE id=" . $id . " LIMIT 1");

		// return the username
		return mysqli_fetch_assoc($result)['username'];
	}

	function getRepliesByCommentId($id)
	{
		global $db;

		$result = mysqli_query($db, "SELECT * FROM replies WHERE id=$id");

		$replies = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $replies;
	}


?>