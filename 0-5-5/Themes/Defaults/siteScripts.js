$(document).ready(function(){
	// Datepicker Plugin
	$(function() { $( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true
	}); });
	
	// Form Validator
	$('#validateForm').bValidator();
	$('.validateForm').bValidator();
	
	// Chat Toggle
	$("#menuBarChatItem").click(function() {
		$("#chatWindow").slideToggle(500);
  	});
  	
  	// Chat Reload
  	setInterval(loadSiteChat, 5000);
});

// Chat System
$(function() {
	$('#chatWindowTextarea').keyup(function(e) {
        if(e.keyCode == 13) {
            var userMsg = $(this).val();
			$.post("/Chats/chatSend.php", {text: userMsg, sessionName: phpSessionName});                
			$(this).val("");
			setTimeout(loadSiteChat, 500);
        }
    });
});
var firstLoad=true;
function loadSiteChat(){
    $.ajax({
        url: "/Chats/siteChat.html",
        cache: false,
        success: function(html){
        	if(html!=$("#chatWindowCont").html()) {
	        	$("#chatWindowCont").html(html);
	        	if(firstLoad) { firstLoad=false; }
	        	else { $("#chatWindow").slideDown(); $("#chatWindowCont").scrollTop($("#chatWindowCont")[0].scrollHeight); }
        	}
        },
    });
}

// SCEditor
$(function() {
    // Replace all textarea's
    // with SCEditor
    $(".sceditor").sceditor({
        plugins: "bbcode",
        toolbar: "bold,italic,underline,strike,subscript,superscript|left,center,right|font,size,color,removeformat|pastetext|bulletlist,orderedlist|table|code,quote|horizontalrule,image,email,link,unlink|emoticon,youtube,date,time|maximize,source",
		style: "/Resources/plugins/sceditor/minified/jquery.sceditor.default.min.css",
		emoticonsRoot: "/Resources/plugins/sceditor/"
    });
});