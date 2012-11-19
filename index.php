<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

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
				<li><b>Registration</b> - Please fill out our <a href="reg-main-contact.php">Registration Information</a> so we can begin planning for your arrival!</li>
				<li><b>Housing</b> - Check out the options for <a href="housing.php">housing</a> whether you're staying with brethren or at our hotel.</li>
				<li><b>Theme</b> - What does &quot;Through the Ages&quot; mean, anyway? Click <a href="information.php#dance">here</a> for a brief interpretation...</li>
			</ul>

		</div>

		<br/><br/>
		
		<div class="column">
			<div id="schedule-friday" class="daily-schedule">
				<h3>Friday, Dec. 28</h3>
				<ul>
					<li><b>6:00 p.m.</b> - <a href="information.php">Hall Opens for Fellowship</a></li>
					<li><b>7:00 p.m.</b> - Bible Study</li>
				</ul>
			</div>

			<div id="schedule-saturday" class="daily-schedule">
				<h3>Saturday, Dec. 29</h3>
				<ul>
					<li><b>1:00 p.m.</b> - <a href="information.php">Church Services</a></li>
					<li><b>4:00 p.m.</b> - Dinner</li>
					<li><b>6:00 p.m.</b> - <a href="activity-fun-show-signup.php">&quot;Through the Ages&quot; Radio Show</a></li>
					<li><b>8:00 p.m.</b> - <a href="information.php#dance">Dance</a></li>
					<li><b>10:30 p.m.</b> - Clean Up</li>
				</ul>
			</div>

			<div id="schedule-sunday" class="daily-schedule">
				<h3>Sunday, Dec. 30</h3>
				<ul>
					<li><b>TBD</b> - Okun Fieldhouse Opens</li>
					<li><b>TBD</b> - Sports Bible Study</li>
					<li><b>TBD</b> - Fitness Conditioning Class</li>
					<li><b>TBD</b> - Basketball and Volleyball</li>				
					<!-- <li><b>TBD</b> - <a href="activity-bball-main.php">Basketball</a> and <a href="activity-vball-main.php">Volleyball</a></li> -->
					<li><b>TBD</b> - Children Activities</li>
					<li><b>TBD</b> - Lunch</li>				
				</ul>
			</div>
		</div>
		
		<!-- Picture sliders, picture sliders, time to set up picture sliders... -->
		<div class="map-column">
		<div class="slider-wrapper theme-default">
    		<div class="ribbon"></div>
			<div id="picture-slider" class="nivoSlider">
				<a href="information.php"><img src="images/kcweekend_3.jpg" title="#caption-overview" /></a>
				<a href="information.php"><img src="images/okun_fieldhouse.jpg" title="#caption-locations" /></a>
				<a href="activity-fun-show-signup.php"><img src="images/kcweekend_5.jpg" title="#caption-fun-show" /></a>
				<a href="information.php#dance"><img src="images/kcweekend_61.jpg" title="#caption-dance" /></a>
				<a href="activity-vball-main.php"><img src="images/kcweekend_4.jpg" title="#caption-volleyball" /></a>
				<a href="activity-bball-main.php"><img src="images/kcweekend_12.jpg" title="#caption-basketball" /></a>
			</div>

			<div id="caption-overview" class="nivo-html-caption">
				Come to the KC Family Weekend - December 27th-29th
			</div>
			<div id="caption-locations" class="nivo-html-caption">
				Held at the Liberty Community Center and Theatre and at the Okun Fieldhouse
			</div>
			<div id="caption-fun-show" class="nivo-html-caption">
				Through the Ages Radio Show
			</div>
			<div id="caption-dance" class="nivo-html-caption">
				Get your groove on... Or your swing... Or mambo... Or...
			</div>
			<div id="caption-volleyball" class="nivo-html-caption">
				Care to play some volleyball?
			</div>
			<div id="caption-basketball" class="nivo-html-caption">
				B-ball... Who can outlast the rest?
			</div>
		</div>

		<div class="clear-float"></div>
		<!-- End of General Announcements -->


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
			setTimeout(showDiv, 5000);
		}
	</script>
	
</body>
</html>