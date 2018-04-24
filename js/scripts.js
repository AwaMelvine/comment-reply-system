$(document).ready(function(){
	// When user clicks on submit comment to add comment under post
	$(document).on('click', '#submit_comment', function(e) {
		e.preventDefault();
		var comment_text = $('#comment_text').val();

		if (comment_text === "" ) return;

		var url = $('#comment_form').attr('action');

		$.ajax({
			url: url,
			type: "POST",
			data: {
				comment_text: comment_text,
				comment_posted: 1
			},
			success: function(data){
				var response = JSON.parse(data);
				if (data === "error") {
					alert('There was an error adding comment. Please try again');
				} else {
					$('#comments-wrapper').prepend(response.comment)
					$('#comments_count').text(response.comments_count); 
					$('#comment_text').val('');
				}
			}
		});
	});

	// When user clicks on submit reply to add reply under comment
	$(document).on('click', '.reply-btn', function(e){
		e.preventDefault();

		var comment_id = $(this).data('id');

		// show/hide the input form for a reply
		$(this).parent().siblings('form.comment_reply_form_' + comment_id).toggle(500);

		$(document).on('click', '.submit-reply', function(e){
			e.preventDefault();

			// elements
			var reply_form = $(this).parent(); // the comment element being replied to
			var comment_elt = $(this).parent().parent(); // the comment element being replied to
			var reply_textarea_elt = $(this).siblings('textarea'); // reply textarea element
			
			// values
			var comment_id = reply_form.data('id');
			var reply_text = $(this).siblings('textarea').val();
			var url = reply_form.attr('action');

			$.ajax({
				url: url,
				type: "POST",
				data: {
					comment_id: comment_id,
					reply_text: reply_text,
					reply_posted: 1
				},
				success: function(data){
					if (data === "error") {
						alert('There was an error adding reply. Please try again');
					} else {
						$('.replies_wrapper_' + comment_id).prepend(data);
						reply_textarea_elt.val('');
					}
				}
			});
		});

	});

});