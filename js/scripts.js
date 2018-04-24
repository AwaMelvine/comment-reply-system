$(document).ready(function(){
	$(document).on('click', '.reply-btn', function(e){
		e.preventDefault();

		$(this).parent().siblings('form').toggle(500);
		$(document).on('click', '.submit-reply', function(e){
			e.preventDefault();
			var comment_id = $(this).parent().data('id');
			var comment_text = $(this).siblings('textarea').val();
			alert(comment_text); 
		});

	});

	// When user clicks on submit comment to add comment under post
	$(document).on('click', '#comment_btn', function(e) {
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
		})
	});
});