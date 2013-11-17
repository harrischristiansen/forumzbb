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
}