$(document).ready(function(){

  	// Edit Comment Toggle
  	$(".editButton").click(function() {
    	$(this).closest('.FullWidthPostRow').find('.editCommentDiv').slideToggle(600);
    	$(this).closest('.FullWidthTable').find('.editCommentDiv').slideToggle(600);
    	$(this).closest('.siteContPanel').find('.editCommentDiv').slideToggle(600);
	});
	
	// Login Window
  	$(".loginWindButton").click(function() {
    	$("#loginWindow").fadeToggle(600);
    	$("#backgroundFade").fadeToggle(600);
	});
  	$("#backgroundFade").click(function() {
    	$("#loginWindow").fadeOut(600);
    	$("#backgroundFade").fadeOut(600);
	});
	
	// Mini Nav Menu
  	$("#navHandle").click(function() {
    	$("#navMenu").slideToggle(600);
	});
	
});

// Show Menu When Large Window
$(window).resize(function(){  
    var w = $(window).width();  
    if(w > 480) {  
        $("#navMenu").show(); 
    }  
});  