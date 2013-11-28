<?php
// Harris Christiansen
// Created 10-1-12


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
	viewHTML('<form action="'.$siteSettings['siteURLShort'].'login/" method="POST" class="validateForm">');
	viewHTML('Username: <input type="text" name="username" value="" data-bvalidator="required"><br>');
	viewHTML('Password: <input type="password" name="password" value="" data-bvalidator="required"><br>');
	viewHTML('<input type="submit" name="loginSubmitted" value="Login">');
	viewHtml('</form>');
}

function viewRegisterField() {
	global $siteSettings;
	viewHTML('<form action="'.$siteSettings['siteURLShort'].'register/" method="POST" class="validateForm">');
	viewHTML('Username: <input type="text" name="username" value="" data-bvalidator="required"><br>');
	viewHTML('Password: <input type="password" name="password" value="" data-bvalidator="required"><br>');
	viewHTML('Confirm Password: <input type="password" name="passwordCon" value="" data-bvalidator="required"><br>');
	viewHTML('Email: <input type="text" name="email" value="" data-bvalidator="required"><br><br>');
	viewHTML('<input type="submit" name="registerSubmitted" value="Register">');
	viewHtml('</form>');
}

function viewPassResetField() {
	global $siteSettings;
	viewHTML('<form action="'.$siteSettings['siteURLShort'].'resetPassword/" method="POST">');
	viewHTML('<input type="text" name="username" value="Username" placeholder="Username" onfocus="this.value=\'\';">');
	viewHTML('<input type="submit" name="resetSubmitted" value="Reset Password">');
	viewHtml('</form>');
}
?>