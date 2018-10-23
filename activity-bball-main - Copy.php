<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Family Games</title>

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

	<div class="main-content">

		<h2>Family Games</h2>

		<p><!-- Put text here... --></p>

		<hr />
		<br/>
		<div id="tabs">
			<ul>
				<li><a href="#basic">Basic Info</a></li>
				<li><a href="#rules">Rules</a></li>
				<li><a href="#family-games-teams">Teams</a></li>
			</ul>

			<div id="basic">
				<h3>Basic Information</h3>

				<p>More information to come, but here are the basics... You and your teammates must register for the weekend, first. Then you can build a team using the Teams tab above.</p>
					
			</div>

			<div id="rules">
				<h3>Family Games Rules</h3>

			</div>

			<div id="family-games-teams">
				<iframe src="activity-family-games-team.php" width="725" height="750" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" >
			  		<p>Your browser does not support iframes.</p>
				</iframe>
				
				<!--<script type="text/javascript">
					var activity_number = '1';
					var activity_name = 'Family Games';
				</script>
				<script type="text/javascript" src="js/grid-activity-teams.js"></script>
				<table id="teams"></table>-->
			</div>

		</div>

	</div>
	</div>
	<div class="clearthis">&nbsp;</div>

	<!-- End of Main Content Area -->


	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>

</div>

</body>
</html>