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

<link rel="stylesheet" href="page.css" type="text/css" media="screen" />

<script type="text/javascript">

function OnCheck(checkbox) {
	var sDivId = "div-" + checkbox.id.substring(4);
	var sFrameId = checkbox.id.substring(4);

	if (checkbox.checked == true) {
		document.getElementById(sDivId).style.display = "";

		var frame = document.getElementById(checkbox.id.substring(4));
		frame.src = sFrameId + ".php";
	} else {
		document.getElementById(sDivId).style.display = "none";
	}
}

</script>

</head>

<body>

<div id="container">

<?	include "header.php"; ?>

	<!-- Start of Main Content Area -->

	<div id="maincontent_container">
	<div id="maincontent">

		<h2>Registration Administration</h2>

		<p>Welcome to the administration page for registration.</p>

		<br/>
		<ul>
		<li><b>There are currently <?=$num_not_housed?> families/groups not housed.</b></li>
		<li><b>The KC Weekend has currently generated $<?=$total_payment?>.00 in donations.</b></li>
		</ul>
		<br/>
		<hr/>
		<p>Please choose from the links or reports below:</p>

		<p><h3>-->&nbsp;<a href="reg-admin-housing.php">Create a Housing Contact</a></h3></p>
		<p><h3>-->&nbsp;<a href="reg-admin-add-guest-to-housing.php">Add Guests to a Housing Contact</a></h3></p>
		<p><h3>-->&nbsp;<a href="reg-admin-add-money.php">Record a Payment from a Registered Family/Group</a></h3></p>
		<p><h3>-->&nbsp;<a href="activity-vball-team.php" target="_blank">Modify Volleyball Teams</a></h3></p>
		<p><h3>-->&nbsp;<a href="activity-bball-team.php" target="_blank">Modify Basketball Teams</a></h3></p>
		<br/>
		<hr />
		<br/>
		<p><b>Please check a box to view a report:</b></p>

		<br />

		<label><input type="checkbox" id="chk-grid-reg-person-admin" onclick="OnCheck(this);" />Show all people currently registered</label>
		<br />

		<div id="div-grid-reg-person-admin" style="display:none">
			<iframe id="grid-reg-person-admin" width="752" height="421" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" >
			  <p>Your browser does not support iframes.</p>
			</iframe>
		</div>
		<br />

		<label><input type="checkbox" id="chk-grid-registration" onclick="OnCheck(this);" />Show current regististration information</label>
		<br />

		<div id="div-grid-registration" style="display:none">
			<iframe id="grid-registration" width="852" height="421" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" >
			  <p>Your browser does not support iframes.</p>
			</iframe>
		</div>
		<br />

		<label><input type="checkbox" id="chk-grid-reg-whos-not-housed" onclick="OnCheck(this);" />Show all families not currently housed</label>
		<br />

		<div id="div-grid-reg-whos-not-housed" style="display:none">
			<iframe id="grid-reg-whos-not-housed" width="780" height="425" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" >
			  <p>Your browser does not support iframes.</p>
			</iframe>
		</div>
		<br />

		<label><input type="checkbox" id="chk-grid-reg-whos-housed-where" onclick="OnCheck(this);" />Show all families who are housed (click '+' to see who each guest is housed with)</label>
		<br />

		<div id="div-grid-reg-whos-housed-where" style="display:none">
			<iframe id="grid-reg-whos-housed-where" width="959" height="425" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" >
			  <p>Your browser does not support iframes.</p>
			</iframe>
		</div>
		<br />

		<label><input type="checkbox" id="chk-grid-reg-housing" onclick="OnCheck(this);" />Show all housing contacts (click '+' to see everyone they're housing)</label>
		<br />

		<div id="div-grid-reg-housing" style="display:none">
			<iframe id="grid-reg-housing" width="1405" height="425" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" >
			  <p>Your browser does not support iframes.</p>
			</iframe>
		</div>

	</div>
	</div>
	<div class="clearthis">&nbsp;</div>

	<!-- End of Main Content Area -->


	<!-- Start of Page Footer -->

	<div id="page_footer">

	Written by the Keesee team.  Template found at <a href="http://www.freewebsitetemplates.com/">Free Website Templates</a>

	</div>

	<!-- End of Page Footer -->


	<div class="clearthis">&nbsp;</div>

</div>

</body>
</html>