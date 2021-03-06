<!-- Start of Page Header -->
<div class="header">
	<h1><a href="index.php"><img src="images/kc-skyline.png" />KansasCity<b>Family</b>Weekend
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h1>

	<script src="js/header-actions.js" type="text/javascript"></script>

	<div>
		<ul class="navbar">
			<li><a href="index.php">Home</a></li>
			<li><a href="reg-main.php">Registration</a></li>
			<li><a href="housing.php">Housing</a></li>
			<li><a href="information.php">Maps &amp; Info</a></li>
			<li class="navbar-submenu-icon"><a href="#">Sunday Activities</a>
				<ul class="child-menu">
					<li><a href="activity-main.php">&nbsp;&nbsp;Schedule &amp; Food</a></li>
					<li><a href="activity-family-games-main.php">&nbsp;&nbsp;Contest of Christians</a></li>
					<li><a href="activity-bball-main.php">&nbsp;&nbsp;Basketball</a></li>
					<li><a href="activity-vball-main.php">&nbsp;&nbsp;Volleyball</a></li>
					<li><a href="activity-add-activity.php">&nbsp;&nbsp;Select Activities</a></li>
				</ul>
			</li>
			<li><a href="activity-art-show-signup.php">Art Show Signup</a></li>
			
		</ul>
	</div>

	<div class="register-button">
		<a href="reg-main-contact-page.php"><img class="register-img" alt="Register Here" border="0" src="images/register.png" />	</a>
	</div>
	
    <div class="paypalbutton">
		<!--<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="JFMRJ5UHHCZK4">
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_xpressCheckout.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>-->
        
        <!--<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="KHFJ28V2KC3ZJ">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_xpressCheckout.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>-->
        
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="5U5775R84R6AS">
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>
	</div>
	
	<div class="facebook-content">
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		<div class="fb-like" data-href="http://www.facebook.com/lcgkcweekend" data-send="false" data-layout="button_count" data-width="50" data-show-faces="true" data-font="tahoma"></div>
	</div>
	
	<a href="https://twitter.com/lcgkcweekend" class="twitter-follow-button" data-show-count="false">Follow @lcgkcweekend</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	
	<div class="clear-float"></div>
    
    <div class="dev-site-warning-hide"><b>WARNING: You have stumbled onto the DEVELOPER&#39;S website.</b> 
    Click <a href='http://www.kclcg.org/kcweekend'>here</a> to go to the real one!</div>
    
</div>

<script>
    $(document).ready(function() {
        if (window.location.hostname != "www.kclcg.org" && window.location.hostname != "kclcg.org") {
            $(".dev-site-warning-hide")[0].className = "dev-site-warning";
        }
    });
</script>

<!-- End of Page Header -->