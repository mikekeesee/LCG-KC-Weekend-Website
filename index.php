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

	<title>The Living Church of God - Kansas City Regional Family Weekend</title>

	<script type="text/javascript">
		$(window).load(function() {
			$('#picture-slider').nivoSlider({
				effect: 'slideInRight',
				pauseTime: 5000
			});
		});
	</script>

</head>

<body>

	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->

	<div class="main-content">

		<!-- Start of General Announcements -->
		<div class="whats-new">

			<h3>What&#39;s New</h3>

			<ul>
				<li><b>Parking on Friday and Saturday</b> - Parking is limited at the facility, so please carpool.</li>

				<li><b>Food on Sunday</b> - Okun Fieldhouse will have concessions available. Click to view the menu: <a href="docs/Okun-concession-menu.doc">Okun Concession Menu</a></li>

				<li><b>Team Schedules</b/> - <a href="activity-bball-main.php">Basketball</a> and <a href="activity-vball-main.php">Volleyball</a> team schedules are now posted.</li>
			</ul>

		</div>

		<!-- Picture sliders, picture sliders, time to set up picture sliders... -->
		<div class="slider-wrapper theme-default">
    		<div class="ribbon"></div>
			<div id="picture-slider" class="nivoSlider">
				<img src="images/kcweekend_1.jpg" alt="" />
				<img src="images/kcweekend_2.jpg" alt="" />
				<img src="images/kcweekend_3.jpg" alt="" />
				<img src="images/kcweekend_4.jpg" alt="" />
				<img src="images/kcweekend_5.jpg" alt="" />
				<img src="images/kcweekend_7.jpg" alt="" />
				<img src="images/kcweekend_9.jpg" alt="" />
				<img src="images/kcweekend_10.jpg" alt="" />
				<img src="images/kcweekend_12.jpg" alt="" />
				<img src="images/kcweekend_13.jpg" alt="" />
				<img src="images/kcweekend_14.jpg" alt="" />
				<img src="images/kcweekend_15.jpg" alt="" />
				<img src="images/kcweekend_16.jpg" alt="" />
				<img src="images/kcweekend_17.jpg" alt="" />
				<img src="images/kcweekend_18.jpg" alt="" />
				<img src="images/kcweekend_19.jpg" alt="" />
				<img src="images/kcweekend_20.jpg" alt="" />
				<img src="images/kcweekend_21.jpg" alt="" />
				<img src="images/kcweekend_22.jpg" alt="" />
				<img src="images/kcweekend_24.jpg" alt="" />
			</div>
		</div>

		<div id="htmlcaption" class="nivo-html-caption">
			Volleyball shall be played!
		</div>

		<div class="clear-float"></div>
		<!-- End of General Announcements -->


		<h2>Schedule of Events</h2>

		<!-- Start of Friday -->
		<div class="daily-schedule">

			<h3>Friday, Dec. 31</h3>

			<ul>
				<li><b>6 p.m.</b> - Hall Opens for Fellowship</li>

				<li><b>7 p.m.</b> - Bible Study</li>
			</ul>

		</div>
		<!-- End of Friday -->


		<!-- Start of Saturday -->
		<div class="daily-schedule">

			<h3>Saturday, Jan. 1</h3>

			<ul>
				<li><b>1 p.m.</b> - <a href="information.php">Church Services</a></li>

				<li><b>4:30 p.m.</b> - Dinner</li>

				<li><b>7 p.m.</b> - <a href="information.php#funshow">Fun Show</a> and <a href="information.php#dance">Dance</a></li>

				<li><b>10 p.m.</b> - Clean Up</li>
			</ul>

		</div>
		<!-- End of Saturday -->
			
		<!-- Start of Sunday -->
		<div class="daily-schedule">

			<h3>Sunday, Jan. 2</h3>

			<ul>
				<li><b>9:00 a.m.</b> - <a href="information.php">Okun Fieldhouse</a> Opens</li>

				<li><b>9:20 a.m.</b> - Sports Bible Study</li>

				<li><b>9:30 a.m.</b> - <a href="activity-bootcamp.php">Boot Camp Conditioning</a></li>

				<li><b>9:50 a.m.</b> - <a href="activity-bball-main.php">Basketball</a> and <a href="activity-vball-main.php">Volleyball</a></li>

				<li><b>10:30 a.m.</b> - <a href="activity-main.php">Children&#39;s Activities</a></li>

				<li><b>10:30 a.m.</b> - <a href="activity-main.php">Bible Seminar</a></li>

				<li><b>10:30 a.m.</b> - Recreational Volleyball</a></li>

				<li><b>12:30 p.m.</b> - <a href="activity-main.php">Family Games</a></li>

				<li><b>2 p.m.</b> - Sports Resume</li>

				<li><b>4:30 p.m.</b> - Activities End</li>
			</ul>

		</div>

		<div class="clear-float" />
	</div>

	<!-- End of Main Content Area -->


	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>

</body>
</html>