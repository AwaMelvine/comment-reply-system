$(document).ready(function(){
	$(document).on('click', '#comment_btn', function(e) {
		e.preventDefault();
		var comment_text = $('#comment_text').val();
		var url = $('#comment_form').attr('action');

		$.ajax({
			url: url,
			type: "POST",
			data: {
				comment_text: comment_text,
				comment_posted: 1
			},
			success: function(data){
				alert(data);
			}
		})
	});
});