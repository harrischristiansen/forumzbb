<?php
// Harris Christiansen
// Created 2013-12-23

function viewLoginWindow() {
	global $siteSettings;
	viewHTML('<div id="backgroundFade"></div>');
	viewHTML('<div id="loginWindow">');
		viewHTML('<form action="'.$siteSettings['siteURLShort'].'login/" method="POST" class="validateForm loginField">');
			viewHTML('<table style="width: 100%;">');
				viewHTML('<tr><td style="width: 30%;">Username</td> <td style="width: 70%;"><input type="text" name="username" value="" data-bvalidator="required"></td></tr>');
				viewHTML('<tr><td>Password</td> <td><input type="password" name="password" value="" data-bvalidator="required"></td></tr>');
				viewHTML('<tr><td colspan="2"><input type="submit" name="loginSubmitted" value="Login" class="loginButton"></td></tr>');
				viewHTML('<tr><td>&nbsp;</td><td>&nbsp;</td></tr>');
				viewHTML('<tr style="font-size: 12px; text-align: center;"><td colspan="2"><a href="/register">Create Account</a> | <a href="/resetPassword">Reset Password</a></td></tr>');
			viewHTML('</table>');
		viewHtml('</form>');
	viewHTML('</div>');
}

?>