<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Registration Administration</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="js/select2/select2.css" type="text/css" media="screen" />

	<? include "jqgrid-header.php" ?>
	<script type="text/javascript" src="js/grid-reg-statistics.js"></script>
	<script type="text/javascript" src="js/select2/select2.js"></script>

	<? include ('google-analytics.php'); ?>
</head>

<body>

<?	include "header.php"; ?>

	<!-- Start of Main Content Area -->

	<div class="main-content">

		<h2>Email Lists</h2>

		<input type="radio" name="emailListType" id="emailListTypeAll" value="all" />
		<label for="emailListTypeAll">&nbsp;All</label>
		<br />
		<input type="radio" name="emailListType" id="emailListTypeBball" value="basketball" />
		<label for="emailListTypeBball">&nbsp;Basketball Players</label>
		<br />
		<input type="radio" name="emailListType" id="emailListTypeBBallNoTeam" value="basketball_no_team" />
		<label for="emailListTypeBBallNoTeam">&nbsp;Basketball Players w/ No Team</label>
		<br />
		<input type="radio" name="emailListType" id="emailListTypeVBall" value="volleyball" />
		<label for="emailListTypeVBall">&nbsp;Volleyball Players</label>
		<br />
		<input type="radio" name="emailListType" id="emailListTypeVBallNoTeam" value="volleyball_no_team" />
		<label for="emailListTypeVBallNoTeam">&nbsp;Volleyball Players w/ No Team</label>
		<br />
		<br />
		<input type="button" id="get-emails" value="Get Emails" />

		<br /><br />
		<textarea id="email_results" rows="10" cols="80"></textarea>
		<br />
		<input type="button" id="mailTo" value="Generate Email" />

	<!-- End of Main Content Area -->

	<!-- Start of Page Footer -->

	<? include "footer.php" ?>

	<script type="text/javascript">
		$(document).ready(function() {
			$("#get-emails").button().click(function() {
				sUrl = "db-email-lists.php?emailListType=" + $("input[@name=emailListType]:checked").val();
				var ajax_response = $.ajax({url:sUrl, async:false, type:"post"});
				$("#email_results").val(ajax_response.responseText);
			});
		});
		
		$(document).ready(function() {
			$("#mailTo").button().click(function() {
				window.location.href = "mailto:" + $("#email_results").val();
			});
		});
	</script>
	
</body>
</html>
