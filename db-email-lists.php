<?
	// **********************************************
	// *     Registration Admin Submission Page     *
	// **********************************************

	// Get the database connection information
	include("db-connect.php");

	mysql_connect(localhost,$username,$password) or die("Unable to connect to database");
	mysql_select_db($database) or die("Unable to select database");

	$email_list_type = $_GET["emailListType"];
	switch($email_list_type) {
		case "basketball":
			$SQL = "SELECT distinct email 
					FROM `Person` p
					inner join Person_Activity a on a.person_id = p.person_id
					WHERE p.email is not null
					and p.email != ''
					and a.activity_id = 1";
			break;
			
		case "volleyball":
			$SQL = "SELECT distinct email 
					FROM `Person` p
					inner join Person_Activity a on a.person_id = p.person_id
					WHERE p.email is not null
					and p.email != ''
					and a.activity_id = 2";
			break;
			
		case "basketball_no_team":
			$SQL = "SELECT distinct email 
					FROM `Person` p
					inner join Person_Activity a on a.person_id = p.person_id
					left outer join Team_Member t on p.person_id = t.person_id
					WHERE p.email is not null
					and p.email != ''
					and a.activity_id = 1
					and t.person_id is null";
			break;
			
		case "volleyball_no_team":
			$SQL = "SELECT distinct email 
					FROM `Person` p
					inner join Person_Activity a on a.person_id = p.person_id
					left outer join Team_Member t on p.person_id = t.person_id
					WHERE p.email is not null
					and p.email != ''
					and a.activity_id = 2
					and t.person_id is null";
			break;
			
		case "all":
		default:
			$SQL = "SELECT distinct email 
					FROM `Person` p";		
			break;
	}
	
	$result = mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute Registration SELECT count query.".mysql_error());

	$email_string = "";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {	
		if (trim($row[email]) != "")
			$email_string .= $row[email]."; ";
	}
	$email_string = substr($email_string, 0, strlen($email_string) - 2);
	
	
	// Set up the return type header
	header("Content-type: text/plain;charset=utf-8");
	echo $email_string;
	
	mysql_close(); 
?>