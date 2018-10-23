<?php
$password = "security";
$nonsense = "hithertoIhavedeclaredthewondersthouhastwrought";

if (isset($_COOKIE['KCWeekendPageLogin'])) {
   if ($_COOKIE['KCWeekendPageLogin'] == md5($password.$nonsense)) {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Information</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />

	<? include "jqgrid-header.php" ?>
	
	<script type="text/javascript">
		$(function(){
			// Tabs
			$('#tabs').tabs();
		});
	</script>

	<? include ('google-analytics.php'); ?>
</head>

<body>

	<!-- Add the header to each page -->
	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->
	<div id="main-content">

		<h2>Maps and Information</h2>
	
		<div class="clear-float"></div>
		<div id="tabs">
			<ul>
				<li><a href="#locations">Locations</a></li>
				<li><a href="#sat-night">Saturday Night</a></li>
				<li><a href="#food">Dinner</a></li>
			</ul>

			<div id="locations">
		
				<h3>Locations and Schedule</h3>

				<p>Our facility for Friday night and Saturday will be the Embassy Suites at KCI, 7640 Tiffany Springs Parkway in Kansas City, MO.</p>
				
				<p>Sunday's sports and family activities will again be at Okun Fieldhouse, 20200 Johnson Drive in Shawnee, KS.</p>

				<br/>

				<div class="column">

	<? include "calendar.php" ?>					
	
					<p>All Friday and Saturday activities will be at the Embassy Suites in Kansas City, MO:</p>
					<p style="margin:20px"><b>
						<b>Embassy Suites at KCI</b><br />
						7640 Tiffany Springs Parkway<br />
						Kansas City, MO 64153
					</b></p>
					<br />
					<p>All Sunday activities will be at the Okun Fieldhouse in Shawnee, KS:</p>
					<p style="margin:20px"><b>
						Okun Fieldhouse<br/>
						20200 Johnson Dr.<br/>
						Shawnee, KS 66218
					</b></p>
				</div>
				
				<div class="map-column">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6177.30420166625!2d-94.67247246756402!3d39.27345956620335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3017c2d2c8e21b1b!2sEmbassy+Suites+by+Hilton+Kansas+City+International+Airport!5e0!3m2!1sen!2sus!4v1474219246493" width="425" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>

					<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?q=39.03427,-94.819672&amp;num=1&amp;t=h&amp;vpsrc=6&amp;ie=UTF8&amp;ll=39.032186,-94.82141&amp;spn=0.011668,0.018239&amp;z=15&amp;output=embed"></iframe><br />
				</div>
				
				<div class="clear-float"></div>
			</div>

			<div id="food">
				<h3>Meal Options</h3>
				
				<img src="images/beef-brisket.jpg" alt="Beef Brisket" style="float:left;margin:0 1em 0 0;" height="180" width="270"/>
				
				<p>We have arranged a catered meal of <b>beef brisket</b>, salad, roll, potato side, vegetable side and dessert.</p>
				
				<p>In order to sign up for the dinner, please <a href="reg-main-contact.php">register</a> and choose Catered Meal 
				under Dining Preference. Then quickly send in your payment of <b>$24.50 per adult meal, $13 for children 9-12 or $10 for children 3-8</b>
				in your group. We cut you a break in price if bringing over 4 children. <b>NOTE: If you&#39;re using PayPal, please pay $1 per party for 
				the additional processing charges.</b> If this seems waaaaay too confusing, don&#39;t worry, we calculate it for
				you when you register. You can either click the PayPal Pay Now button in the upper-right corner of the web page, or 
				send a check.</p>
				
				<p>If writing a check, please make checks payable to <u>Local Church Activity Fund</u>.  Please send all checks to:</p>
				
				<p style="margin:20px;"><b>
					John Wells<br/>
					2329 Lake Breeze Ln.<br/>
					Lee&#39;s Summit, MO 64086
				</b></p>
				
				<h3>Eating Out</h3>
				<p>There are several eating options around the Embassy Suites, including the Zona Rosa shopping district. Some restuarants are
                Cracker Barrel, Smokehouse BBQ, Abuelo's Mexican Restaurant, Granite City Brewery, The Hereford House, BRAVO Cucina, Outback Steakhouse,
                and many more! There are also plenty of fast food restaurants, too.</p>

			</div>

			<div id="sat-night">
				<h3>Saturday Night Activities</h3>

				<img src="images/red-carpet.jpg" alt="Roll Out the Red Carpet" style="float:left;margin:0 1em 0 0;" height="300" width="450"/>
				
                <h4>Costume Theme</h4>
                
                <p>This information is top secret. That is, we still don&#39;t know what it is. Details are coming soon!</p>
                
                
				<h4>The Show</h4>
				
				<p>The show will begin at 7:00 p.m. Brisket is for dinner, but entertainment is for dessert. That is all we can say.</p>
				
				<br />
				
				<h4>Dance</h4>
				
				<p>The dance will be its usual, wonderful self. Please dress formal or Sabbath wear.</p>
				
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				
				<!--<h4>Photography</h4>
				
				<p>The Photo Area was so popular last year, we are bringing it back! There will be two sessions:</p>
				<ul>
					<li>5:30p - 6:15p - Before dinner, there will be two photo booths open, each with a photographer.</li>
					<li>8:30p - 9:00p - After the fun show and during the dance. One photo booth with a photographer.</li>
				</ul>
				<p><i>NOTE: One session per family, please.</i></p>
				
				<p>There will also be an open photo area available during the dance, complete with props, so you can make your own memories! 
				<i>Please, no selfies... Okay, who are we kidding?? :) Take all you want!</p> -->
			</div>

		</div>

	</div>
	<!-- End of Main Content Area -->


	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>

	<script type="text/javascript">
		$(function() {
			$('.daily-schedule').hide();
			
			// Start showing the divs
			showDiv();
		});

		var divCnt = 0;
		var timer;
		
		function showDiv() {				
			$('.daily-schedule').each(function(index) {
				if (index == divCnt) {
					$(this).fadeIn();
				} else {
					$(this).hide();
				}
			});
			
			divCnt = (divCnt + 1) % 3;
			
			// And wait one second before fading in the next one
			timer = setTimeout(showDiv, 4000);
		}

		$('.daily-schedule').hover(
			function() { clearTimeout(timer); },
			function() { timer = setTimeout(showDiv, 4000); }
		);
	</script>	
</body>
</html>

<?
      exit;
   } else {
		setcookie("KCWeekendPageLogin", "", time()-3600);
		header("Location: $_SERVER[PHP_SELF]");
   }
}

if (isset($_GET['p']) && $_GET['p'] == "login") {
	if ($_POST['keypass'] != $password) {
      echo "Sorry, that password does not match. Press Back to try again...";
      exit;
   } else if ($_POST['keypass'] == $password) {
      setcookie('KCWeekendPageLogin', md5($_POST['keypass'].$nonsense), time() + 60*60*24*30);
      header("Location: $_SERVER[PHP_SELF]");
   } else {
      echo "Sorry, something is not working correctly. Perhaps you don't have cookies enabled, or it's time to buy that new computer you want. :) Press Back to try again...";
   }
}

include('secure.php');

?>