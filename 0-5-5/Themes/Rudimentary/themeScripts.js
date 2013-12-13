$(document).ready(function(){
  	// Edit Comment Toggle
  	$(".editButton").click(function() {
    	$(this).closest('.FullWidthPostRow').find('.editCommentDiv').slideToggle(600);
    	$(this).closest('.FullWidthTable').find('.editCommentDiv').slideToggle(600);
	});
});