<?
	// **********************************************
	// *       Admin Housing Submission Page        *
	// **********************************************

	// Get the database connection information
	include("db-connect.php");

	$link = mysqli_connect(localhost, $username, $password, $database);

	// Main contact info
	$person_id			= $_POST['gridPerson'];
	$activity_id_str	= $_POST['gridActivity'];
	
	$activity_ids		= explode(",", $activity_id_str);
	
	for ($i = 0; $i < count($activity_ids); $i++) {
		$activity_insert_str .= "(".$person_id.",".$activity_ids[$i]."),";
	}
	
	// Get rid of the trailing comma
	$activity_insert_str = rtrim($activity_insert_str, ",");	

	// If the activity's already registered
	if ($person_id > 0) {
		if ($activity_insert_str > "") {
			$SQL = "SELECT	COUNT(*) as count
					FROM	Person_Activity
					WHERE	person_id = ".$person_id;

			$result = mysqli_query($link, $SQL) or die($SQL.mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute family activity SELECT count query.".mysqli_error($link));
			$row = mysqli_fetch_array($result);
			$count = $row['count'];

			// If there's any existing activities, clear them and re-insert
			if ($count > 0) {
				$SQL = "DELETE FROM	Person_Activity
						WHERE		person_id = ".$person_id;

				mysqli_query($link, $SQL) or die($SQL.mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute UPDATE family activity query.".mysqli_error($link));
			
			}

			$SQL = "INSERT INTO	Person_Activity
							(Person_ID,
							 Activity_ID)
					VALUES ".$activity_insert_str;

			mysqli_query($link, $SQL) or die($SQL.mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT family activity query.".mysqli_error($link));
		}			
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Activities</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />

	<? include ("jqgrid-header.php") ?>

	<? include ('google-analytics.php'); ?>
</head>

<body onload="OnLoad();">

	<!-- Add the header to each page -->
	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->

	<div class="main-content">

		<h2>Activities</h2>

		<p>Excellent work! You are now participating in the activities selected.</p>

		<br/>
		
		<p><a href="activity-add-activity.php">Sign-up someone else for an activity</a></p>

		<p><a href="activity-main.php">Back to the Activities Main Page</a></p>

	</div>
	<!-- End of Main Content Area -->

	<!-- Add the footer to each page -->
	<? include ('footer.php'); ?>

</body>
</html>

<?
	mysqli_close($link);
?>
