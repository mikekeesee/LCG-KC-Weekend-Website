<?
	// Get the database connection information
	include("db-connect.php");

	mysql_connect(localhost,$username,$password) or die("Unable to connect to database");
	mysql_select_db($database) or die("Unable to select database");


	// Get the POST data
	$person_id = $_GET['person_id'];
	$reg_id = $_GET['reg_id'];
	$host_housing_id = $_GET['host_housing_id'];
	$num_in_party = $_GET['num_in_party'];
	
	// Insert the data into the Registration_Housing table.
	$SQL = "INSERT INTO Registration_Housing
				(Registration_ID,
				 Housing_ID)
			VALUES
				($reg_id,
				 $host_housing_id)";

	mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Registration_Housing INSERT query.".mysql_error());

	$SQL = "SELECT	how_many
			FROM	Housing_Contact
			WHERE	Housing_ID = $host_housing_id";

	$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Housing_Contact SELECT How_Many query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$prev_how_many = $row['how_many'];

	$cur_how_many = (int)$prev_how_many - (int)$num_in_party;

	// If we somehow ended up with a negative number, just set it to zero.
	if ($cur_how_many < 0) $cur_how_many = 0;

	$SQL = "UPDATE	Housing_Contact
			SET		How_Many = $cur_how_many";
	if ($cur_how_many == 0) {
		$SQL .= ", House_More_Ind = 0";
	}
	$SQL .= "		WHERE	Housing_ID = $host_housing_id";

	mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Housing_Contact UPDATE How_Many query.".mysql_error());
	
	$SQL = "UPDATE	Registration
			SET		Done_Housing_Ind = 1,
					Housing_Type = 10
			WHERE	Registration_ID = $reg_id";

	mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Registration UPDATE query.".mysql_error());

	mysql_close();
?>
