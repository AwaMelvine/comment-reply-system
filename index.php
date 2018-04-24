<?php include('includes/functions.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Comment and reply system in PHP</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 post">
			<h2><?php echo $post['title'] ?></h2>
			<p><?php echo $post['body']; ?></p>
		</div>

		<div class="col-md-6 col-md-offset-3 comments">
			<form class="clearfix" action="index.php" method="post" id="comment_form">
				<textarea name="comment_text" id="comment_text" class="form-control" cols="30" rows="3"></textarea>
				<button class="btn btn-primary btn-sm pull-right" id="comment_btn">Submit comment</button>
			</form>

			<div class="well">
				<h4 class="text-center"><a href="#">Sign in</a> to post a comment</h4>
			</div>

			<h2><span id="comments_count"><?php echo count($comments) ?></span> Comment(s)</h2>
			<hr>

			<!-- comments wrapper -->
			<div id="comments-wrapper">

			<?php if (isset($comments)): ?>
				<!-- Display comments -->
				<?php foreach ($comments as $comment): ?>
					<!-- comment -->
					<div class="comment clearfix">
						<img src="images/profile.png" alt="" class="profile_pic">
						<div class="comment-details">
							<span class="comment-name"><?php echo getUsernameById($comment['id']) ?></span>
							<span class="comment-date"><?php echo date("F j, Y ", strtotime($comment["created_at"])); ?></span>
							<p><?php echo $comment['body']; ?></p>
							<a class="reply-btn" href="#">reply</a> &nbsp;&nbsp; <a class="edit-btn" href="#">edit</a>
						</div>
						<!-- reply form -->
						<form action="index.php" class="reply_form" data-id="<?php echo $comment['id']; ?>">
							<textarea class="form-control" name="reply_text" id="reply_text" cols="30" rows="2"></textarea>
							<button class="btn btn-primary btn-xs pull-right submit-reply">Submit reply</button>
						</form>
					</div>

						<!-- GET ALL REPLIES -->
						<?php $replies = getRepliesByCommentId($comment['id']) ?>
						<?php if (isset($replies)): ?>
							<?php foreach ($replies as $reply): ?>
								<!-- reply -->
								<div class="comment reply clearfix">
									<img src="images/profile.png" alt="" class="profile_pic">
									<div class="comment-details">
										<span class="comment-name"><?php echo getUsernameById($reply['id']) ?></span>
										<span class="comment-date"><?php echo date("F j, Y ", strtotime($reply["created_at"])); ?></span>
										<p><?php echo $reply['body']; ?></p>
										<a class="reply-btn" href="#">reply</a> &nbsp;&nbsp; <a class="edit-btn" href="#">edit</a>
									</div>
								</div>
								<!-- reply form -->
								<form action="index.php" class="reply_form">
									<div class="form-group">
										<textarea class="form-control" name="reply_text" id="reply_text" cols="30" rows="2"></textarea>
										<button class="btn btn-primary btn-xs pull-right">Submit reply</button>
									</div>
								</form>
							<?php endforeach ?>
						<?php endif ?>
				<?php endforeach ?>
			<?php else: ?>
				<h2>Be the first to comment on this post</h2>
			<?php endif ?>
			</div><!-- comments wrapper -->
		</div>
	</div>
</div>

<!-- Javascripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Bootstrap Javascript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>


<script src="js/scripts.js"></script>

</body>
</html>