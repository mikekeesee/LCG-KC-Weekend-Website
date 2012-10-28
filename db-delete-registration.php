<?
	// Get the database connection information
	include("db-connect.php");

	mysql_connect(localhost,$username,$password) or die("Unable to connect to database");
	mysql_select_db($database) or die("Unable to select database");


	// Get the POST data
	$person_id = $_GET['person_id'];
	$reg_id = $_GET['reg_id'];

	$SQL = "DELETE	Registration
			FROM	Registration
			WHERE	Registration_ID = ".$reg_id;

	$result = mysql_query( $SQL ) or die(mysql_error());//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysql_error()); 

	// This assumes the person is a guest of someone.
    $SQL = "DELETE	Registration_Housing
			FROM	Registration_Housing
			WHERE	Registration_ID = ".$reg_id;

	$result = mysql_query( $SQL ) or die(mysql_error());//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysql_error()); 

	$SQL = "SELECT	housing_id
			FROM	Housing_Contact
			WHERE	Person_ID = ".$person_id;
	
	$result = mysql_query( $SQL ) or die(mysql_error());//$SQL);//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysql_error()); 
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	// Check to see if this is a host family.
	if ($row == false) {
		$housing_id = $row[housing_id];
		
		$SQL = "DELETE	Housing_Contact
				FROM	Housing_Contact
				WHERE	Person_ID = ".$person_id;

		$result = mysql_query( $SQL ) or die(mysql_error());//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysql_error()); 
		
		$SQL = "DELETE	Registration_Housing
				FROM	Registration_Housing
				WHERE	Housing_ID = ".$housing_id;

		$result = mysql_query( $SQL ) or die(mysql_error());//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysql_error()); 
	}
		
	mysql_close();
?>
