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
			viewHTML('<div id="chatWindowHead">Chat</div>');
			viewHTML('<div id="chatWindowCont">');
				include_once('Chats/siteChat.html');
			viewHTML('</div>');
			viewHTML('<div id="chatWindowField">');
				viewHTML('<form id="chatWindowForum" action="">');
					viewHTML('<textarea id="chatWindowTextarea"></textarea>');
				viewHTML('</form>');
			viewHTML('</div>');
		viewHTML('</div>');
	}
}

?>