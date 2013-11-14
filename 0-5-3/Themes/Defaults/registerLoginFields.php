<?php
// Harris Christiansen
// Created 10-1-12
// Updated 10-20-12


function viewSingleLineLoginField() {
	global $siteSettings;
	viewHTML('<form action="'.$siteSettings['siteURLShort'].'login/" method="POST" class="singleLineLoginField">');
	viewHTML('<input type="text" name="username" value="Username" placeholder="Username" onfocus="this.value=\'\';">');
	viewHTML('<input type="password" name="password" value="Password" placeholder="Password" onfocus="this.value=\'\';">');
	viewHTML('<input type="submit" name="loginSubmitted" value="Login">');
	viewHtml('</form>');
}

function viewMultiLineLoginField() {
	global $siteSettings;
	viewHTML('<form action="'.$siteSettings['siteURLShort'].'login/" method="POST">');
	viewHTML('Username: <input type="text" name="username" value=""><br>');
	viewHTML('Password: <input type="password" name="password" value=""><br>');
	viewHTML('<input type="submit" name="loginSubmitted" value="Login">');
	viewHtml('</form>');
}

function viewRegisterField() {
	global $siteSettings;
	viewHTML('<form action="'.$siteSettings['siteURLShort'].'register/" method="POST">');
	viewHTML('Username: <input type="text" name="username" value=""><br>');
	viewHTML('Password: <input type="password" name="password" value=""><br>');
	viewHTML('Confirm Password: <input type="password" name="passwordCon" value=""><br>');
	viewHTML('Email: <input type="text" name="email" value=""><br><br>');
	viewHTML('<input type="submit" name="registerSubmitted" value="Register">');
	viewHtml('</form>');
}
?>