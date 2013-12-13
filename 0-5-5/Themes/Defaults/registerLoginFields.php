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
	viewHTML('<form action="'.$siteSettings['siteURLShort'].'login/" method="POST" class="validateForm loginField">');
	viewHTML('<table style="width: 100%;">');
	viewHTML('<tr><td style="width: 30%;">Username</td> <td style="width: 70%;"><input type="text" name="username" value="" data-bvalidator="required"></td></tr>');
	viewHTML('<tr><td>Password</td> <td><input type="password" name="password" value="" data-bvalidator="required"></td></tr>');
	viewHTML('<tr><td colspan="2"><input type="submit" name="loginSubmitted" value="Login" class="loginButton"></td></tr>');
	viewHTML('<tr><td>&nbsp;</td><td>&nbsp;</td></tr>');
	viewHTML('<tr style="font-size: 12px; text-align: center;"><td colspan="2"><a href="/register">Create Account</a> | <a href="/resetPassword">Reset Password</a></td></tr>');
	viewHTML('</table>');
	viewHtml('</form>');
}

function viewRegisterField() {
	global $siteSettings;
	viewHTML('<form action="'.$siteSettings['siteURLShort'].'register/" method="POST" class="validateForm">');
	viewHTML('<table class="centerTable">');
	viewHTML('<tr><td>Username:</td> <td><input type="text" name="username" value="" data-bvalidator="required"></td></tr>');
	viewHTML('<tr><td>Password:</td> <td><input type="password" name="password" value="" data-bvalidator="required"></td></tr>');
	viewHTML('<tr><td>Confirm Password:</td> <td><input type="password" name="passwordCon" value="" data-bvalidator="required"></td></tr>');
	viewHTML('<tr><td>Email:</td> <td><input type="text" name="email" value="" data-bvalidator="required"></td></tr>');
	viewHTML('<tr><td colspan="2"><input type="submit" name="registerSubmitted" value="Register"></td></tr>');
	viewHTML('</table>');
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