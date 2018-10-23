<!DOCTYPE html>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name="organization" content="Living Church of God - Kansas City" />
	<meta name="description" content="LCG Kansas City Regional Family Weekend (KC Weekend)" />

	<? include "jqgrid-header.php" ?>
	<script src="js/nivo-slider/jquery.nivo.slider.pack.js" type="text/javascript"></script>
	
	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="js/nivo-slider/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="js/nivo-slider/themes/default/default.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/countdown.css" type="text/css" media="screen" />

	<title>The Living Church of God - Kansas City Regional Family Weekend</title>

	<script type="text/javascript">
		$(window).load(function() {
			$('#picture-slider').nivoSlider({
				effect: 'slideInRight',
				pauseTime: 5000
			});
		});
	</script>

	<? include ('google-analytics.php'); ?>
</head>

<body>

	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->

	<div class="main-content">
		<!--<h3>The countdown for next year has begun...</h3>
        [if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		  <div id="note"></div>
        <![endif]-->
		<!--<div id="countdown"></div>
		<script src="js/countdown.js"></script>-->


		<br/>
		
		<!-- Start of General Announcements -->
		<div class="whats-new">

			<h3>What You Need to Know</h3>

			<ul>			
                <li><b><a href="reg-main-contact-page.php">Registration</a></b> - Register for the weekend! We look forward to seeing you!</li>
                <li><b><a href="information.php#food">Dinner Payment</a></b> - Have you paid yet? Click the PayPal link in the upper-right corner, or 
				look at the Maps &amp; Info -> Dinner tab for a mailing address.</li>
				<li><b><a href="activity-art-show-signup.php">Art Show Sign-Up</a></b> - We <u>really</u> want to see your talent put on display!</li>
                <li><b><a href="activity-family-games-main.php">The Contest of the Christians</a></b> - Our family games has a new name. Sign up your team soon...</li>
                <li><b><a href="activity-main.php">Sunday Sports</a></b> - Sign up for the <a href="activity-bball-main.php">basketball</a> or <a href="activity-vball-main.php">volleyball</a> tournaments</li>
                
                <!--<li><b>Fun Show Mystery</b> - What is this years&#39s Fun Show all about??? The Big Show starts at 7pm, Saturday night!</li>
                <li><b>Photo Booth</a></b> - 5:00pm - 6:00pm - One session to get your family picture taken! Real props, real photographers! <i>(Limit 1 per family, please.)</i></li>
                <li><b>Sleep in!</b> - Family Games begin at 10am, sharp! If not participating in volleyball or basketball, take an extra few minutes to sleep and grab breakfast.</li>
                <li><b>Sunday Card Tournament</a></b> - Begins after the Family Games around 1:00 p.m.</li>
                <li><b>Young Children&#39;s Activities</b> - Are your kids a little small for GaGa Ball? We have activities to suit us all! Safe obstacle course, reading time and coloring activities.</li>
                <li><b>Hotel Update</b> - King-size rooms are all that are left at $110. You can still house up to 6 (1-2 in sleeping bags... no cots left), but you have to enter a total of 4 on the online site to see those rooms.</li>
                <li><b><a href="information.php">Dinner Payment</a></b> - Have you paid yet? Click the PayPal link in the upper-right corner, or 
				look at the Maps &amp; Info -> Dinner tab for a mailing address.</li>
                <li><b>Build Your Team!</b> - Last call for building teams for <a href="activity-family-games-main.php">Family Games</a> and <a href="activity-vball-main.php">volleyball</a>.</li>
                <li><b>Young Children&#39;s Activities</b> - Are your kids a little small for GaGa Ball?
				We have activities to suit us all! Safe obstacle course, reading time and coloring activities.</li>
                <li><b>Step in Time Show</b> - Get ready to be entertained! Doors open after 6:45 p.m. Show at 7 p.m.</li>
                <li><b>Theme!</b> - "Step in Time" - Dress in formal or Sabbath-wear from any recent era</li>-->
                                
				<!--<li><b>Young Children&#39;s Activities</b> - Are your kids a little small for GaGa Ball?
				We have activities to suit us all! Safe obstacle course, reading time and coloring activities.</li>
				<li><b>Seasoned "Children&#39;s" Activities</b> - AKA "Redneck Games" like beanbag toss, ladder toss and other games
				for those who like a more relaxed pace in their play. If you play these games and don&#39;t see yourself as a "redneck",
				feel free to call them something else instead! Ooh, Sophisticated Parlor Games...</li>
				<li><b>Photo Booth</a></b> - Two sessions to get your family picture taken! Real props, real photographers! 
				5:30pm - 6:15pm and 8:30pm - 9:00pm.  <i>(Limit 1 per family, please.)</i></li>
				<li><b><a href="information.php">Dinner Payment</a></b> - Have you paid yet? Click the PayPal link in the upper-right corner, or 
				look at the Maps &amp; Info -> Dinner tab for a mailing address.</li>
				<li><b><a href="activity-art-show-signup.php">Art Show Sign-Up</a></b> - We <u>really</u> want to see your talent put on display!</li>-->

				<!--<li><b>Photos!</b> - <a href="https://goo.gl/photos/v1hmzjnSY98iUgoU6">Get your photos from the KC Weekend right here!</a></li>
				<li>See you next year!</li>-->				
			</ul>

		</div>

		<br/><br/>
		
		<div class="column">
		
	<? include "calendar.php" ?>	
		
		</div>
		
		<!-- Picture sliders, picture sliders, time to set up picture sliders... -->
		<div class="map-column">
		<div class="slider-wrapper theme-default">
    	<div class="ribbon"></div>
			<div id="picture-slider" class="nivoSlider">
				<img src="images/cover-slide.jpg" title="#caption-overview" />
				<img src="images/embassy-atrium.jpg" title="#caption-embassy-atrium" />
				<img src="images/embassy-reception.jpg" title="#caption-embassy-reception" />
				<img src="images/embassy-breakfast.jpg" title="#caption-embassy-breakfast" />
				<img src="images/embassy-suite.jpg" title="#caption-embassy-suite" />
				<img src="images/embassy-bedroom.jpg" title="#caption-embassy-bedroom" />
				<img src="images/embassy-pool.jpg" title="#caption-embassy-pool" />
				<img src="images/kcweekend_45.jpg" title="#caption-family-games" />
				<img src="images/kcweekend_4.jpg" title="#caption-volleyball" />
				<img src="images/kcweekend_12.jpg" title="#caption-basketball" />

				<!--
				<a href="information.php"><img src="images/cover-slide.jpg" title="#caption-overview" /></a>
				<!--<a href="information.php#sat-night"><img src="images/red-carpet-slideshow.jpg" title="#caption-awards" /></a>
				<a href="activity-family-games-main.php"><img src="images/kcweekend_45.jpg" title="#caption-family-games" /></a>
				<a href="activity-vball-main.php"><img src="images/kcweekend_4.jpg" title="#caption-volleyball" /></a>
				<a href="activity-bball-main.php"><img src="images/kcweekend_12.jpg" title="#caption-basketball" /></a>-->
			</div>

			<div id="caption-overview" class="nivo-html-caption">
				Come to the KC Family Weekend next year!
			</div>
			<div id="caption-embassy-atrium" class="nivo-html-caption">
				A Millennial setting for fellowship...
			</div>
			<div id="caption-embassy-reception" class="nivo-html-caption">
				Appetizers and drinks in the evening...
			</div>
			<div id="caption-embassy-breakfast" class="nivo-html-caption">
				Gourmet breakfast is free for hotel guests
			</div>
			<div id="caption-embassy-suite" class="nivo-html-caption">
				Suites for parties up to 6
			</div>
			<div id="caption-embassy-bedroom" class="nivo-html-caption">
				What a &quot;suite&quot; bedroom!
			</div>
			<div id="caption-embassy-pool" class="nivo-html-caption">
				Hotel swimming pool
			</div>
            
			<!--<div id="caption-awards" class="nivo-html-caption">
				What will you be wearing on the red carpet? Join us at the Ambassador Awards Show!
			</div>-->
			<div id="caption-family-games" class="nivo-html-caption">
				Remember last years&#39; family games? This year will be better!
			</div>
			<div id="caption-volleyball" class="nivo-html-caption">
				Join the Volleyball Tournament!
			</div>
			<div id="caption-basketball" class="nivo-html-caption">
				Got skillz? Show &#39;em off in our Basketball Tournament!
			</div>
		</div>

		<div class="clear-float"></div>
		<!-- End of General Announcements -->

		<fieldset><legend>LCG Contact Information</legend>
			<p>This event is a Living Church of God activity. If you have questions about the Living Church of God
			and would like to speak with a representative, please email our Regional Pastor: 
			<a href="mailto:rmillich@lcg.org">Rand Millich</a>.</p>
		</fieldset>

	</div>

	<!-- End of Main Content Area -->

	<!-- Add the footer to each page -->
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