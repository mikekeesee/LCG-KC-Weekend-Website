<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Sunday Activities</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />

	<? include "jqgrid-header.php" ?>

	<? include ('google-analytics.php'); ?>
</head>

<body>

	<?	include "header.php"; ?>

	<!-- Start of Main Content Area -->

	<div class="main-content">
				
		<h2>Sunday Activities</h2>

		<div class="column">
			<input type="button" id="add-activity-button" value="Select or Update Your Activity" style="width:290px;" />
			<p>&nbsp;</p>
		
			<div class="daily-schedule">
				<h3>Sunday's Schedule:</h3>
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
		
		<div class="column">
			<div class="list-view">
				<script type="text/javascript" src="js/grid-activity-person-list.js"></script>
				<table id="activity-person-list"></table>
			</div>
		</div>

		<div class="clear-float"></div>
		
		
		<h3>Concessions:</h3>
		
		<p>You're going to play hard, so we are going to feed you well.</p>
		
		<p>Like last year, we are going to provide a $5.00 lunch pack. Including: (a 6-inch Subway Sandwich and any two of the following items: Chips, Snack, and Drink)</p>
		
		<p>Also we will have snacks galore.  For breakfast, we will have energy bars, fruits, etc.</p>

		<p><b>We will be able to take Cash or Credit Card.</b></p>

		<p>P.S. We will provide water and gatorade free of charge.</p>

	</div>
	<!-- End of Main Content Area -->

	<? include "footer.php"; ?>

	<script type="text/javascript">
		//$(document).ready(function() {
		//	$("input:button").button();
		//});	
		
		$("#add-activity-button").click(function() {
			url = "http://"+window.location.host + "/activity-add-activity.php";
			document.location.href = url;
		});
	</script>
</body>
</html>