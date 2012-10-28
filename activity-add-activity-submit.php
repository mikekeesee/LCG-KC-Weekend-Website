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
	$person_id		= $_POST['gridPerson'];
	$activity_id	= $_POST['gridActivity'];

	// Verify that this person is not already signed up for an activity
	$SQL = "SELECT	COUNT(*) as count
			FROM	Person_Activity
			WHERE	Person_ID = $person_id";

	$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Person_Activity SELECT count query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$count = $row['count'];

	// If a row already exists, update their existing activity with their newly selected activity.
	if ($count > 0) {

		$SQL = "UPDATE	Person_Activity
				SET		Activity_ID = $activity_id
				WHERE	Person_ID = $person_id";

		mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Registration UPDATE query.".mysql_error());


	// This is their first time picking an activity.
	} else {

		$SQL = "INSERT INTO Person_Activity
					(Person_ID,
					 Activity_ID)
				VALUES
					($person_id,
					 $activity_id)";

		mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Registration_Housing INSERT query.".mysql_error());

		$dont_calc = 0;
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Activities</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />

	<? include ('google-analytics.php'); ?>
</head>

<body onload="OnLoad();">

	<!-- Add the header to each page -->
	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->

	<div class="main-content">

		<h2>Activities</h2>

		<p>You have successfully signed up!</p>

		<p>You are now participating in the activity selected.</p>

		<p><a href="activity-add-activity.php">Sign-up someone else for an activity</a></p>

		<p><a href="activity-main.php">Back to the Activities Main Page</a></p>

	</div>
	<!-- End of Main Content Area -->

	<!-- Add the footer to each page -->
	<? include ('footer.php'); ?>

</body>
</html>

<?
	mysql_close();
?>
