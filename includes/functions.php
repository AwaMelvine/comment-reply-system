<?php 
	$db = mysqli_connect("localhost", "root", "", "comment-reply-system");

	$p_result = mysqli_query($db, "SELECT * FROM posts WHERE id=1");

	$post = mysqli_fetch_assoc($p_result);

	$c_result = mysqli_query($db, "SELECT * FROM comments WHERE post_id=" . $post['id'] . " ORDER BY created_at DESC");
	$comments = mysqli_fetch_all($c_result, MYSQLI_ASSOC);



	// If the user clicked submit on comment form...
	if (isset($_POST['comment_posted'])) {
		
		global $db;

		// grab the comment that was submitted through Ajax call
		$comment_text = $_POST['comment_text']; 

		// insert comment into database
		$sql = "INSERT INTO comments (post_id, user_id, body, created_at, updated_at) VALUES (1, 1, '$comment_text', now(), null)";
		$result = mysqli_query($db, $sql);

		$inserted_id = $db->insert_id;
		$res = mysqli_query($db, "SELECT * FROM comments WHERE id=$inserted_id");
		$inserted_comment = mysqli_fetch_assoc($res);


		// if insert was successful, get that same comment from the database and return it
		if ($result) {
			$comment = "<div class='comment clearfix'>
						<img src='images/profile.png' alt='' class='profile_pic'>
						<div class='comment-details'>
							<span class='comment-name'>" . getUsernameById($inserted_comment['id']) . "</span>
							<span class='comment-date'>" . date('F j, Y ', strtotime($inserted_comment['created_at'])) . "</span>
							<p>" . $inserted_comment['body'] . "</p>
							<a class='reply-btn' href='#'>reply</a> &nbsp;&nbsp; <a class='edit-btn' href='#'>edit</a>
						</div>
						<!-- reply form -->
						<form action='index.php' class='reply_form' data-id='" . $inserted_comment['id'] . "'>
							<textarea class='form-control' name='reply_text' id='reply_text' cols='30' rows='2'></textarea>
							<button class='btn btn-primary btn-xs pull-right submit-reply'>Submit reply</button>
						</form>
					</div>";
			$comment_info = array(
				'comment' => $comment,
				'comments_count' => getCommentsCountByPostId(1)
			);
			echo json_encode($comment_info);
			exit();
		} else {
			echo "error";
			exit();
		}
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

	function getCommentsCountByPostId($post_id)
	{
		global $db;
		$result = mysqli_query($db, "SELECT COUNT(*) AS total FROM comments");
		$data = mysqli_fetch_assoc($result);

		return $data['total'];
	}


?>