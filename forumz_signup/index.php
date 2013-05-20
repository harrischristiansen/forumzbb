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
        	<table border="0" id="r1c1" cellpadding="0">
            	<center><font size="5">Forumz Public Signup</font></center>
            	<tr width="100%"><td width="50%">
                	Description:<br><br>
                	-Start of CMS<br>
                	-Basic Blog System
                </td><td width="50%">
                	Features:<br><br>
                	-Blog System<br>
                    -Accounts<br>
                    -Ranks<br>
                    -Free For Use ATM
                </td></tr></table>
                <a href="http://beta.forumzbb.com" class="link">View the Demo</a><br>
				Contact Email: <a href="mailTo:cloudy243@me.com" style="color: #000000;">cloudy243@me.com</a>
        </div>
        <div class="right">
        	<img src="images/mac.png" alt="Picture of site">
        </div>
    </div>
    
    <div id="r2">
    	<div class="left"><b>Released Version</b> | Forumz 0.5.2</div>
    </div>
    
    <div id="r3"><br>
        <font size="5">Signup</font><br>
        <form action="signup.php" method="POST">
			Username: <input type="text" name="username" value="Username" placeholder="Username" onfocus="this.value='';"><br>
			Domain Address (/domainAddress, enter without /): <input type="text" name="domainAddress" value="Domain Address" placeholder="Domain Address" onfocus="this.value='';"><br>
			Password: <input type="password" name="password" value="Password" placeholder="Password" onfocus="this.value='';"><br>
			Confirm Password: <input type="password" name="passCon" value="Password" placeholder="Confirm Password" onfocus="this.value='';"><br>
			Email: <input type="text" name="email" value="Email" placeholder="Email" onfocus="this.value='';"><br>
			Invitation Code: <input type="text" name="invCode" value="<?php if(isset($_GET['invCode'])) { echo $_GET['invCode']; } else { echo "Invitation Code"; }?>" placeholder="<?php if(isset($_GET['invCode'])) { echo $_GET['invCode']; } else { echo "Invitation Code"; }?>" onfocus="this.value='<?php echo $_GET['invCode'];?>';">
			<span style="font-size: 9px;">Notice: Each Invitation Code Works Only Once.</span><br>
			<input type="submit" name="signupSubmitted" value="Signup">
		</form>
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
