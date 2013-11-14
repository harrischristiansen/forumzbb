<?php
// Harris Christiansen
// Created 10-29-12
// Updated 10-29-12

function displayChangeRankList($formURL,$actID) {
	viewHTML('<form action="'.$formURL.'" method="POST">');
	viewHTML('Rank: <select name="newRank" onchange="this.form.submit()">');
	getChangeRankListOptions($actID);
	viewHTML('</select>');
	viewHtml('</form>');
}

function displayChangeRankListOption($optName, $optValue, $optSelected) {
	viewHTML('<option value="'.$optValue.'" '.$optSelected.'>'.$optName.'</option>');
}

?>