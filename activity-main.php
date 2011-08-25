<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Housing</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />

	<link rel="stylesheet" type="text/css" media="screen" href="js/css/start/jquery-ui-1.7.2.custom.css" />

	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>

	<? include "jqgrid-header.php" ?>

</head>

<body>

<div id="container">

	<?	include "header.php"; ?>

	<!-- Start of Main Content Area -->

	<div id="maincontent_container">
	<div id="maincontent">

		<? include "activity-buttons.php"; ?>

		<h2>Sunday Activities</h2>

		<br/>

		<div id="column_container">
		<div id="column">

			<p>Welcome to the activities page.</p>

			<p>We have a new facility this year, the Okun Fieldhouse in Shawnee, Kansas. It has enough room for us to offer
			two full-court basketball areas, three volleyball courts, a court for Lori's Boot Camp and later children's games,
			plus a large foyer, a lecture room and tons of bleachers for fellowship.</p>

			<p>Doors will open at 9 a.m. Sunday, December 2.</p>

			<p><b>Food:</b></p>
			<p>The fieldhouse will have concession stands available (click to view <a href="docs/Okun-concession-menu.doc">menu</a>). We will
			also provide free bagels and desserts in the foyer.</p>

			<p>The closest restaurants are about a mile west, then a mile south. We plan to have maps available at the fieldhouse for those who
			would like to eat out after the activities end.</p>

			<p><b>Schedule:</b></p>
							<p><b>9:00 a.m.</b> - <a href="information.php">Okun Fieldhouse</a> Opens</p>

							<p><b>9:20 a.m.</b> - Sports Bible Study</p>

							<p><b>9:30 a.m.</b> - <a href="activity-bootcamp.php">Boot Camp Conditioning</a></p>

							<p><b>9:50 a.m.</b> - <a href="activity-bball-main.php">Basketball</a> and <a href="activity-vball-main.php">Volleyball</a></p>

							<p><b>10:30 a.m.</b> - <a href="activity-main.php">Children&#39;s Activities</a></p>

							<p><b>10:30 a.m.</b> - <a href="activity-main.php">Bible Seminar</a></p>

							<p><b>10:30 a.m.</b> - Recreational Volleyball</a></p>

							<p><b>12:30 p.m.</b> - <a href="activity-main.php">Family Games</a> (organized sports will take a break)</p>

							<p><b>2 p.m.</b> - Sports Resume

							<p><b>4:30 p.m.</b> - Activities End


		</div>
		</div>

		<div id="map_container">
		<div id="map">
			<div id="list-view">
				<script type="text/javascript" src="js/grid-activity-person-list.js"></script>
				<table id="activity-person-list"></table>
			</div>
		</div>
		</div>

	</div>
	</div>
	<div class="clearthis">&nbsp;</div>

	<!-- End of Main Content Area -->

	<? include "footer.php"; ?>

</div>

</body>
</html>