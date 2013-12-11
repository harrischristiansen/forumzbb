$(document).ready(function(){
	//Datepicker Plugin
	$(function() { $( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true
	}); });
	
	//Form Validator
	$('#validateForm').bValidator();
	$('.validateForm').bValidator();
	
	// Chat Toggle
	$("#menuBarChatItem").click(function() {
		$("#chatWindow").slideToggle(500);
  	});
  	
  	// Edit Comment Toggle
  	$(".editButton").click(function() {
    	$(this).closest('.FullWidthPostRow').find('.editCommentDiv').slideToggle(600);
	});
});