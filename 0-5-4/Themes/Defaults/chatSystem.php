<?php
// Harris Christiansen
// Created 2013-11-28

function displayChatMenuBarItem() {
	if(userCan("useChat")) {
		viewHTML('<div id="menuBarChatItem">');
		viewHTML('</div>');
	}
}

function viewChatWindow() {
	if(userCan("useChat")) {
		viewHTML('<div id="chatWindow">');
		
		viewHTML('</div>');
	}
}

?>