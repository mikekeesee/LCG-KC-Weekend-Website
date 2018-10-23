<?
	// Get the database connection information
	include("db-connect.php");

	$link = mysqli_connect(localhost, $username, $password, $database);

	// Get the POST data
	$person_id = $_GET['person_id'];
	$reg_id = $_GET['reg_id'];

	$SQL = "DELETE	Person
			FROM	Person
			WHERE	Person_ID = ".$person_id;

	$result = mysqli_query($link, $SQL) or die(mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysqli_error($link)); 

	// This assumes the person isn't a main contact, otherwise their data would be in the Registration table.
    $SQL = "DELETE	Registration_Person
			FROM	Registration_Person
			WHERE	Person_ID = ".$person_id;

	$result = mysqli_query($link, $SQL) or die(mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysqli_error($link)); 
	
	$SQL = "DELETE	Person_Activity
			FROM	Person_Activity
			WHERE	Person_ID = ".$person_id;

	$result = mysqli_query($link, $SQL) or die(mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysqli_error($link)); 
	
	$SQL = "DELETE	Team_Member
			FROM	Team_Member
			WHERE	Person_ID = ".$person_id;

	$result = mysqli_query($link, $SQL) or die(mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysqli_error($link)); 
	
	$SQL = "DELETE	Fun_Show_Person
			FROM	Fun_Show_Person
			WHERE	Person_ID = ".$person_id;

	$result = mysqli_query($link, $SQL) or die(mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysqli_error($link)); 
	
    // This assumes the person deleted isn't a main contact.
	$SQL = "UPDATE  Registration
			SET     Number_In_Party = (Number_In_Party - 1)
			WHERE	Registration_ID = ".$reg_id;

	$result = mysqli_query($link, $SQL) or die(mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysqli_error($link)); 
	
	mysqli_close($link);
?>
