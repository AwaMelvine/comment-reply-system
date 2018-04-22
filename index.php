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
			<h2><?php echo count($comments) ?> Comment(s)</h2>
			<hr>

			<form class="clearfix" action="index.php" method="post" id="comment_form">
				<textarea name="comment_text" id="comment_text" class="form-control" cols="30" rows="3"></textarea>
				<button class="btn btn-primary btn-sm pull-right" id="comment_btn" style="margin: 5px 0px;">Submit comment</button>
			</form>

			<div class="well">
				<h4 class="text-center"><a href="#">Sign in</a> to post a comment</h4>
			</div>

			<?php if (isset($comments)): ?>
				<!-- Display comments -->
				
				<?php foreach ($comments as $comment): ?>
					<!-- comment -->
					<div class="comment clearfix">
						<img src="images/profile.png" alt="" class="profile_pic">
						<div class="comment-details">
							<span><b><?php echo getUsernameById($comment['id']) ?></b> 
								<small><i><?php echo date("F j, Y ", strtotime($comment["created_at"])); ?></i></small>
							</span>
							<p><?php echo $comment['body']; ?></p>
							<small><a href="#">reply</a></small> &nbsp;&nbsp; <small><a href="#">edit</a></small>
						</div>
					</div>

						<!-- GET ALL REPLIES -->
						<?php $replies = getRepliesByCommentId($comment['id']) ?>
						<?php if (isset($replies)): ?>
							<?php foreach ($replies as $reply): ?>
								<!-- reply -->
								<div class="comment reply clearfix">
									<img src="images/profile.png" alt="" class="profile_pic">
									<div class="comment-details">
										<span><b><?php echo getUsernameById($reply['id']) ?></b> 
											<small><i><?php echo date("F j, Y ", strtotime($reply["created_at"])); ?></i></small>
										</span>
										<p><?php echo $reply['body']; ?></p>
										<small><a href="#">reply</a></small> &nbsp;&nbsp; <small><a href="#">edit</a></small>
									</div>
								</div>
							<?php endforeach ?>
						<?php endif ?>
				<?php endforeach ?>
			<?php else: ?>
				<h2>Be the first to comment on this post</h2>
			<?php endif ?>

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