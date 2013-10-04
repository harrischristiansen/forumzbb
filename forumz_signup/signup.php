<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Forumz - Signup</title>
<LINK href="main.css" rel="stylesheet" type="text/css">
	<!--Theme List -->
	<script src="jquery-1.2.6.js" type="text/javascript" charset="utf-8"></script>
    <script src="jquery-ui-full-1.5.2.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
       window.onload = function () {
        var container = $('div.sliderGallery');
        var ul = $('ul', container);
        var itemsWidth = ul.innerWidth() - container.outerWidth();
        $('.slider', container).slider({
            min: 0,
            max: itemsWidth,
            handle: '.handle',
            stop: function (event, ui) {
                ul.animate({'left' : ui.value * -1}, 500);
            },
            slide: function (event, ui) {
                ul.css('left', ui.value * -1);
            }

        });
    $(".point-servers").click(function(){
            $('.slider', container).slider("moveTo","1200px");
    });

};
    </script>


</head>

<body><div id="main">
	<div id="menuBar">
    	<div id="menuLeft">
        	<div id="logo"></div>
        </div>
        <div id="menuRight">
        	<a href="http://www.forumzbb.com" class="menuItem">Home</a>
        	<a href="http://beta.forumzbb.com" class="menuItem">Beta</a>
        	<a href="http://signup.forumzbb.com" class="menuItem">Signup</a>
        </div>
	</div>
    
    <div id="r1">
    	<div class="left">
            	<center><font size="5">Forumz Public Signup</font></center><br><br>
                <a href="http://beta.forumzbb.com" class="link">View the Demo</a><br>
                <a href="http://signup.forumzbb.com/relNotes.txt" class="link">View Release Notes</a><br>
				Contact Email: <a href="mailTo:cloudy243@me.com" style="color: #000000;">cloudy243@me.com</a>
        </div>
        <div class="right">
        	<img src="images/mac.png" alt="Picture of site">
        </div>
    </div>
    
    <div id="r2">
    	<div class="left"><b>Released Version</b> | Forumz 0.5.3</div>
    </div>
    
    <div id="r3"><br>
        <?php
        //Connect To Mysqli
        $mysqliServer = $_ENV['DATABASE_SERVER'];
		$mysqliUser = "db166640_forumz";
		$mysqliPass = "forumzbb";
		$mysqliDatabase = "db166640_forumzPublicActs";
		$mysqliForumzDatabase = "db166640_forumzPublic";
        $con = @mysqli_connect($mysqliServer, $mysqliUser, $mysqliPass, $mysqliDatabase) or die ("Site Not Setup");
        
        //Load Data From Form
        $usernameInput=mysqli_real_escape_string($con,$_POST['username']);
        $passwordInput=mysqli_real_escape_string($con,$_POST['password']);
        $passwordConInput=mysqli_real_escape_string($con,$_POST['passCon']);
        $passwordEncrypted=md5($passwordInput);
        $emailInput=mysqli_real_escape_string($con,$_POST['email']);
        $domainInput=mysqli_real_escape_string($con,$_POST['domainAddress']);
        $invCodeInput=mysqli_real_escape_string($con,$_POST['invCode']);
        $newDatabaseName=$domainInput;
        
        //Load Misc Data
        $ipAddress=$_SERVER['REMOTE_ADDR'];
        $joinDate=date('m-d-y');
        $joinTime=date('H:i:s');
        
        //Get Number Of Users With Username
        $sql = "SELECT * FROM accounts WHERE username='$usernameInput'";
        $result = mysqli_query($con,$sql) or die ("Query failed: usersWithUsername");
        $usersWithUsername=mysqli_num_rows($result);
        
        //Get Number Of Domains With DomainName
        $sql = "SELECT * FROM accounts WHERE domainAddr='$domainInput'";
        $result = mysqli_query($con,$sql) or die ("Query failed: domainsWithDomainName");
        $domainsWithDomainName=mysqli_num_rows($result);
        
        //Get Number Of Valid Invitation Codes With invCodeInput
        $sql = "SELECT * FROM invCodes WHERE invitationCode='$invCodeInput' AND used!='1'";
        $result = mysqli_query($con,$sql) or die ("Query failed: invCodesAvail");
        $invCodesAvail=mysqli_num_rows($result);
        
        
        
        //Check If All Parts Of Form Are Filled Out
        if($usernameInput==""||$usernameInput=="Username"||$passwordInput==""||$passwordInput=="Password"||$domainInput==""||$domainInput=="Domain Address"||$emailInput==""||$emailInput=="Email") {
        	echo '<font size="5" style="color: red;">Please Fill Out All Parts Of Form</font><br>';
        }
        
        //Check If Username Is Available
        elseif($usersWithUsername!="0") {
        	echo '<font size="5" style="color: red;">Username Is Unavailable</font><br>';
        }
        
        //Check If Domain Address Is Available
        elseif($domainsWithDomainName!="0") {
        	echo '<font size="5" style="color: red;">Domain Is Unavailable</font><br>';
        }
        
        //Check If Password and Password Confirmation Match
        elseif($passwordInput!=$passwordConInput) {
        	echo '<font size="5" style="color: red;">Passwords Do Not Match</font><br>';
        }
        
        //Check If Invitation Code Is Valid
        elseif($invCodesAvail!="1") {
        	echo '<font size="5" style="color: red;">Invalid Invitation Code</font><br>';
        }
        
        //Create Site
        else {
        	//Add User To Database
        	$sql = "INSERT INTO accounts (username, password, emailAddr, domainAddr, ipAddress, creationDate, creationTime) VALUES ('$usernameInput','$passwordEncrypted','$emailInput','$domainInput', '$ipAddress', '$joinDate', '$joinTime')";
       		$result = mysqli_query($con,$sql) or die ("Query failed: addAccount");
        	
        	//Update Invitation Code Table
       		$sql = "UPDATE invCodes SET used='1', usedBy='$usernameInput' WHERE invitationCode='$invCodeInput'";
       		$result = mysqli_query($con,$sql) or die ("Query failed: updateInvitationCodeTable");
       		
        	//Fill New Forum Database
        	mysqli_close($con);
        	$con = @mysqli_connect($mysqliServer, $mysqliUser, $mysqliPass, $mysqliForumzDatabase) or die ("Connection Failed: Forumz Public DB");
        	require_once('setupNewDatabase.php');
        	fillDatabase($con,$newDatabaseName,$usernameInput,$passwordEncrypted,$emailInput,$ipAddress,$joinDate,$domainInput);
       		
        	//Confirm Site Creation, Print Site Address
        	echo '<font size="5" style="color: green;">Site Created</font><br>';
        	echo '<font size="5"><a style="color: #000000;" href="http://public.forumzbb.com/'.$domainInput.'/">Click Here To Go To Your Site</a></font><br>';
        	echo '<font size="5"">Website URL: http://public.forumzbb.com/'.$domainInput.'/</font><br>';
        }
        ?>
    </div>
    
    <div id="themeSelector">
    	<center>
        	<font size="6">Our Themes</font><br>
            <div class="sliderGallery">
            <ul>
                <li><img src="images/theme1.png"></li>
                <li><img src="images/theme1.png"></li>
                <li><img src="images/theme1.png"></li>
                <li><img src="images/theme1.png"></li>
                <li><img src="images/theme1.png"></li>
                <li><img src="images/theme1.png"></li> 
                <li><img src="images/theme1.png"></li>              
            </ul>
            <div class="slider">
                <div class="handle"></div>
                <span class="slider-lbl1">Our Themes</span>
            </div>
        </div>
            <br><font color="#666666" size="5">More themes coming soon...</font>
        </center>
    </div>
    
    <div style="font-size: 10px; text-align: center; margin-top: -5px;">Copyright 2013 Forumzbb</div>
</div></body>
</html>
