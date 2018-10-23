<?
	// Get the database connection information
	include("db-connect.php");

	$link = mysqli_connect(localhost, $username, $password, $database);

	// Get the POST data
	$person_id = $_GET['person_id'];
	$reg_id = $_GET['reg_id'];
	$guest_reg_id = $_GET['guest_reg_id'];
	
	$SQL = "SELECT	number_in_party
			FROM	Registration
			WHERE	Registration_ID = $guest_reg_id";

	$result = mysqli_query($link,  $SQL ) or die(mysqli_error($link)); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT housing contract query.".mysqli_error($link));
	$row = mysqli_fetch_array($result);
	$num_in_party = $row['number_in_party'];

	// Get the housing ID for the person
	$SQL = "SELECT housing_id
			FROM Housing_Contact
			WHERE Registration_ID = ".$reg_id;

	$result = mysqli_query($link,  $SQL ) or die(mysqli_error($link)); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT housing contract query.".mysqli_error($link));
	$row = mysqli_fetch_array($result);
	$housing_id = $row['housing_id'];

	// Insert the data into the Registration_Housing table.
	$SQL = "INSERT INTO Registration_Housing
				(Registration_ID,
				 Housing_ID)
			VALUES
				($guest_reg_id,
				 $housing_id)";

	mysqli_query($link,  $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Registration_Housing INSERT query.".mysqli_error($link));

	$SQL = "SELECT	how_many
			FROM	Housing_Contact
			WHERE	Housing_ID = $housing_id";

	$result = mysqli_query($link,  $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Housing_Contact SELECT How_Many query.".mysqli_error($link));
	$row = mysqli_fetch_array($result);
	$prev_how_many = $row['how_many'];

	$cur_how_many = (int)$prev_how_many - (int)$num_in_party;

	// If we somehow ended up with a negative number, just set it to zero.
	if ($cur_how_many < 0) $cur_how_many = 0;

	$SQL = "UPDATE	Housing_Contact
			SET		How_Many = $cur_how_many";
	if ($cur_how_many == 0) {
		$SQL .= ", House_More_Ind = 0";
	}
	$SQL .= "		WHERE	Housing_ID = $housing_id";

	mysqli_query($link,  $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Housing_Contact UPDATE How_Many query.".mysqli_error($link));
	
	$SQL = "UPDATE	Registration
			SET		Done_Housing_Ind = 1,
					Housing_Type = 10
			WHERE	Registration_ID = $guest_reg_id";

	mysqli_query($link,  $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Registration UPDATE query.".mysqli_error($link));

	mysqli_close($link);
?>
