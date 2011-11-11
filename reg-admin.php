<?
	// **********************************************
	// *     Registration Admin Submission Page     *
	// **********************************************

	// Get the database connection information
	include("db-connect.php");

	mysql_connect(localhost,$username,$password) or die("Unable to connect to database");
	mysql_select_db($database) or die("Unable to select database");


	$SQL = "SELECT	SUM(Payment_Amount) as total
			FROM	Registration_Payment";
	
	$result = mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute Registration SELECT count query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$total_payment = $row['total'];
	
	$SQL = "SELECT	COUNT(*) as count
			FROM 	Registration
			WHERE	done_housing_ind = 0
					AND Housing_Type IN (9,10)";

	$result = mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute Registration SELECT count query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$num_not_housed = $row['count'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Registration Administration</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />

	<? include "jqgrid-header.php" ?>

	<script type="text/javascript" src="js/grid-reg-person-admin.js"></script>
	<script type="text/javascript" src="js/grid-registration.js"></script>
	<script type="text/javascript" src="js/grid-reg-whos-not-housed.js"></script>
	<script type="text/javascript" src="js/grid-reg-whos-housed-where.js"></script>
	<script type="text/javascript" src="js/grid-reg-housing.js"></script>

	<script type="text/javascript">

	function OnCheck(checkbox) {
		var sDivId = "div-" + checkbox.id.substring(4);
		var sFrameId = checkbox.id.substring(4);

		if (checkbox.checked == true) {
			document.getElementById(sDivId).style.display = "";

		} else {
			document.getElementById(sDivId).style.display = "none";
		}
	}

	</script>

</head>

<body>

<?	include "header.php"; ?>

	<!-- Start of Main Content Area -->

	<div class="main-content">

		<h2>Registration Administration</h2>

		<p>Welcome to the administration page for registration.</p>

		<p><br/>
			<b>There are currently <?=$num_not_housed?> families/groups not housed.</b>
			<br/>
			<b>The KC Weekend has currently generated $<?=$total_payment?>.00 in donations.</b>
		</p>
		<hr/>
		<p>Please choose from the links or reports below:</p>

		<ul>
			<li><a href="reg-admin-housing.php">Create a Housing Contact</a></li>
			<li><a href="reg-admin-add-guest-to-housing.php">Add Guests to a Housing Contact</a></li>
			<li><a href="reg-admin-add-money.php">Record a Payment from a Registered Family/Group</a></li>
			<li><a href="activity-vball-team.php" target="_blank">Modify Volleyball Teams</a></li>
			<li><a href="activity-bball-team.php" target="_blank">Modify Basketball Teams</a></li>
		</ul>
		
		<hr />
		<br/>
		<p><b>Please check a box to view a report:</b></p>

		<br />

		<label><input type="checkbox" id="chk-grid-reg-person-admin" onclick="OnCheck(this);" />Show all people currently registered</label>
		<br />

		<div id="div-grid-reg-person-admin" style="display:none">
			<table id="reg-person-admin"></table>
		</div>
		<br />

		<label><input type="checkbox" id="chk-grid-registration" onclick="OnCheck(this);" />Show current regististration information</label>
		<br />

		<div id="div-grid-registration" style="display:none">
			<table id="reg-registration"></table>
		</div>
		<br />

		<label><input type="checkbox" id="chk-grid-reg-whos-not-housed" onclick="OnCheck(this);" />Show all families not currently housed</label>
		<br />

		<div id="div-grid-reg-whos-not-housed" style="display:none">
			<table id="reg-whos-not-housed"></table>
		</div>
		<br />

		<label><input type="checkbox" id="chk-grid-reg-whos-housed-where" onclick="OnCheck(this);" />Show all families who are housed (click '+' to see who each guest is housed with)</label>
		<br />

		<div id="div-grid-reg-whos-housed-where" style="display:none">
			<table id="reg-whos-housed-where"></table>
		</div>
		<br />

		<label><input type="checkbox" id="chk-grid-reg-housing" onclick="OnCheck(this);" />Show all housing contacts (click '+' to see everyone they're housing)</label>
		<br />

		<div id="div-grid-reg-housing" style="display:none">
			<table id="reg-housing"></table>
		</div>

	</div>

	<!-- End of Main Content Area -->

	<!-- Start of Page Footer -->

	<? include "footer.php" ?>

</body>
</html>