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
				<li><a href="reg-main.php"><b>Registration</b></a> - Your path to the KC Weekend starts here!</li>
				<li><a href="housing.php"><b>Housing</b></a> - Holiday Inn and CoCo Key Water Resort or stay with brethren? Deadline for reservations on our special rate of $79/night is <b>Nov. 27th</b>.</li>
				<li><a href="information.php#food"><b>Food</b></a> - The Holiday Inn is catering an Italian feast for us for a ridiculously low price! See our Food section for what&#39;s included in the meal and payment details.</li>
				<li><b>Sunday Sports</b> - Click <a href="activity-main.php">here</a> to sign up for an activity, <a href="activity-bball-main.php">here</a> to see basketball info, or <a href="activity-vball-main.php">here</a> for volleyball.</li>
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
				<a href="information.php"><img src="images/kcweekend_3.jpg" title="#caption-overview" /></a>
				<a href="housing.php"><img src="images/coco_key.jpg" title="#caption-hotel" /></a>
				<a href="information.php#dance"><img src="images/kcweekend_61.jpg" title="#caption-dance" /></a>
				<a href="activity-vball-main.php"><img src="images/kcweekend_4.jpg" title="#caption-volleyball" /></a>
				<a href="activity-bball-main.php"><img src="images/kcweekend_12.jpg" title="#caption-basketball" /></a>
			</div>

			<div id="caption-overview" class="nivo-html-caption">
				Come to the KC Family Weekend - December 27th-29th
			</div>
			<div id="caption-hotel" class="nivo-html-caption">
				Holiday Inn and CoCo Key Water Resort -- Come play!
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