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
			<input type="button" id="add-activity-button" value="Select or Update Your Activities" style="width:290px;" />
			<p>&nbsp;</p>
		
			<div id="schedule-sunday" class="daily-schedule">
				<h3>Sunday, Dec. 30th <em>(tentative)</em></h3>
				<ul>
                    <li><b>8:30 a.m.</b> - Sports Bible Study</li>
                    <li><b>9:00 a.m.</b> - Volleyball Tournament Begins</li>
                    <li><b>10:00 a.m.</b> - <a href="activity-family-games-main.php">Family Games</a> - Pt. 1</li>
                    <li><b>11:00 a.m.</b> - V-ball Tournament, B-ball Clinics, Small Children&#39;s Games</li>
                    <li><b>12:30 p.m.</b> - <a href="activity-family-games-main.php">Family Games</a> - Pt. 2</li>
                    <li><b>1:30 p.m.</b> - <a href="activity-vball-main.php">Volleyball</a>, <a href="activity-bball-main.php">Basketball</a> games (11 and up), Gaga Ball!</li>
                    <p><i>** Gaga Ball, Card Tournament available after Family Games</i></p>
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
		
		
		<!--<h3>Concessions:</h3>
		
		<p>Breakfast burritos (turkey sausage, eggs, and cheese) will be available in the morning as well as granola bars, fruit, and juice.</p>
		
		<p>Once again we will offer a $6 lunch deal including a 6 in. Subway sandwich and 2 sides. (Chips, snack, or soda).</p>
		
		<p>If you want something hot you will definitely enjoy Vi’s famous chili. Or a hot dog. Or combine them for the best chili dog in Kansas City!</p>

		<p><b>Cash or credit cards are accepted. </b></p>

		<p>Complementary water and Gatorade will be available	</p>-->

	</div>
	<!-- End of Main Content Area -->

	<? include "footer.php"; ?>

	<script type="text/javascript">
		//$(document).ready(function() {
		//	$("input:button").button();
		//});	
		
		$("#add-activity-button").click(function() {
			url = "activity-add-activity.php";
			document.location.href = url;
		});
	</script>
</body>
</html>