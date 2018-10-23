<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Housing</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />

	<? include "jqgrid-header.php" ?>
	
	<? include ('google-analytics.php'); ?>
</head>

<body>

	<? include "header.php"; ?>

	<!-- Start of Main Content Area -->

	<div id="main-content">

		<h2>Registration</h2>

		<p>Welcome to the registration page. Click the button below to begin registering or scroll
		down to see who's already coming.</p>

		<p>&nbsp;</p>

		<div class="column">
			<input type="button" id="register-button" value="Register Here" style="width:250px" />
			<p>&nbsp;</p>
			<div class="list-view">
				<script type="text/javascript" src="js/grid-reg-person.js"></script>
				<table id="reg-person"></table>
			</div>
		</div>
		
		<div class="column">
			<iframe src="reg-home-city-map.php" style="width:550px;height:500px;border:0px solid #fff;" frameBorder="0" scrolling="no">
			</iframe>
		</div>

		<div class="clear-float"></div>
		
	</div>

	<!-- End of Main Content Area -->

	<? include "footer.php"; ?>

	<script type="text/javascript">
		//$(document).ready(function() {
		//	$("input:button").button();
		//});	
		
		$("#register-button").click(function() {
			url = "reg-main-contact-page.php";
			document.location.href = url;
		});
	</script>
	
</body>
</html>