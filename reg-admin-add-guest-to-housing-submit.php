<?
	// Get the database connection information
	include("db-connect.php");

	mysql_connect(localhost,$username,$password) or die("Unable to connect to database");
	mysql_select_db($database) or die("Unable to select database");

	// **********************************************
	// *       Admin Housing Submission Page        *
	// **********************************************

	// Get the database connection information
	include("db-connect.php");

	mysql_connect(localhost,$username,$password) or die("Unable to connect to database");
	mysql_select_db($database) or die("Unable to select database");


	// Main contact info
	$reg_id				= $_POST['gridGuest'];
	$housing_id			= $_POST['gridHost'];
	$how_many			= $_POST['txtHowMany'];

	// This is the opposite of the check box, so reverse the values.  Are we DONE housing?
	$done_housing_ind	= $_POST['chkMoreHousing']=="on"?0:1;


	// Verify there is not already an identical person in the system
	$SQL = "SELECT	COUNT(*) as count
			FROM	Registration_Housing
			WHERE	Registration_ID = $reg_id
					AND Housing_ID = $housing_id";

	$result = mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute Registration SELECT count query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$count = $row['count'];

	// Somehow, this registration was already housed here...  Do not calculate the remainder left in the host household.
	if ($count > 0) {
		$dont_calc = 1;

	// If they're a new registrant, enter their information
	} else {
		// Insert the data into the Registration_Housing table.
		$SQL = "INSERT INTO Registration_Housing
					(Registration_ID,
					 Housing_ID)
				VALUES
					($reg_id,
					 $housing_id)";

		mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Registration_Housing INSERT query.".mysql_error());

		$dont_calc = 0;
	}

	if ($dont_calc == 0) {
		$SQL = "SELECT	how_many
				FROM	Housing_Contact
				WHERE	Housing_ID = $housing_id";

		$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Housing_Contact SELECT How_Many query.".mysql_error());
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$prev_how_many = $row['how_many'];

		$cur_how_many = (int)$prev_how_many - (int)$how_many;

		// If we somehow ended up with a negative number, just set it to zero.
		if ($cur_how_many < 0) $cur_how_many = 0;

		$SQL = "UPDATE	Housing_Contact
				SET		How_Many = $cur_how_many";
		if ($cur_how_many == 0) {
			$SQL .= ", House_More_Ind = 0";
		}
		$SQL .= "		WHERE	Housing_ID = $housing_id";

		mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Housing_Contact UPDATE How_Many query.".mysql_error());
	}

	// Update the registration row, if done.
	if ($done_housing_ind == 1) {
		$SQL = "UPDATE	Registration
				SET		Done_Housing_Ind = 1,
						Housing_Type = 10
				WHERE	Registration_ID = $reg_id";

		mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Registration UPDATE query.".mysql_error());
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend: Registration</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />

	<? include ('google-analytics.php'); ?>
</head>

<body onload="OnLoad();">

	<!-- Add the header to each page -->
	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->

	<div class="main-content">

		<h2>Registration</h2>

		<br/>

		<h3>Guest Successfully Housed!</h3>
		<br/>
		<p>This guest/group was successfully added to the host family selected.</p>

		<p><a href="reg-admin-add-guest-to-housing.php">House another guest/group</a></p>

		<p><a href="reg-admin.php">Registration Administration</a></p>

		<br /><br /><br /><br />

	</div>
	</div>

	<div class="clearthis">&nbsp;</div>

	<!-- End of Main Content Area -->

	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>

</body>
</html>

<?
	mysql_close();
?>
