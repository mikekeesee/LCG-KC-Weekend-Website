<?
	// **********************************************
	// *     Registration Admin Submission Page     *
	// **********************************************

	// Get the database connection information
	include("db-connect.php");

	$email_list_type = $_GET["emailListType"];
	$database = $_GET["database"];
	
	$link = mysqli_connect(localhost, $username, $password, $database);
	$email_list_type = $_GET["emailListType"];
	switch($email_list_type) {
		case "kc_brethren":
            if ($database == "awesom72_kcweekend_2016" || $database == "awesom72_kcweekend_2015") {
                $SQL = "SELECT distinct email 
                        FROM `Person` p
                        inner join Registration r on r.Main_Contact_Person_ID = p.Person_ID
                        WHERE p.email is not null
                        and p.email != ''
                        and r.housing_type = 8";            
            } else {            
                $SQL = "SELECT distinct email 
                        FROM `Person` p
                        inner join Registration_Person rp on p.Person_ID = rp.Person_ID and rp.Main_Contact_Ind = 1
                        inner join Registration r on rp.Registration_ID = r.Registration_ID
                        WHERE p.email is not null
                        and p.email != ''
                        and r.housing_type = 8";
            }
			break;

		case "guests":
            if ($database == "awesom72_kcweekend_2016" || $database == "awesom72_kcweekend_2015") {
                $SQL = "SELECT distinct email 
                        FROM `Person` p
                        inner join Registration r on r.Main_Contact_Person_ID = p.Person_ID
                        WHERE p.email is not null
                        and p.email != ''
                        and r.housing_type IN (9, 10, 11, 12)";
            } else {            
                $SQL = "SELECT distinct email 
                        FROM `Person` p
                        inner join Registration_Person rp on p.Person_ID = rp.Person_ID and rp.Main_Contact_Ind = 1
                        inner join Registration r on rp.Registration_ID = r.Registration_ID
                        WHERE p.email is not null
                        and p.email != ''
                        and r.housing_type IN (9, 10, 11, 12)";
            }
			break;

		case "basketball":
			$activity_id = 5;
			$SQL = "SELECT distinct email 
					FROM `Person` p
					inner join Person_Activity a on a.person_id = p.person_id
					WHERE p.email is not null
					and p.email != ''
					and a.activity_id = $activity_id";
			break;
			
		case "volleyball":
			$activity_id = 6;
			$SQL = "SELECT distinct email 
					FROM `Person` p
					inner join Person_Activity a on a.person_id = p.person_id
					WHERE p.email is not null
					and p.email != ''
					and a.activity_id = $activity_id";
			break;
			
		case "family_games":
			$activity_id = 1;
			$SQL = "SELECT distinct email 
					FROM `Person` p
					inner join Person_Activity a on a.person_id = p.person_id
					WHERE p.email is not null
					and p.email != ''
					and a.activity_id = $activity_id";
			break;
			
		case "basketball_no_team":
			$activity_id = 5;
			$SQL = "SELECT distinct email 
					FROM `Person` p
					inner join Person_Activity a on a.person_id = p.person_id
					WHERE p.email is not null
					and p.email != ''
					and a.activity_id = $activity_id
					and p.person_id not in (
                        select tm.person_id
                        from Team_Member tm
                        inner join Team t on t.Team_ID = tm.Team_ID and t.Activity_ID = $activity_id)";
			break;
			
		case "volleyball_no_team":
			$activity_id = 6;
			$SQL = "SELECT distinct email 
					FROM `Person` p
					inner join Person_Activity a on a.person_id = p.person_id
					WHERE p.email is not null
					and p.email != ''
					and a.activity_id = $activity_id
					and p.person_id not in (
                        select tm.person_id
                        from Team_Member tm
                        inner join Team t on t.Team_ID = tm.Team_ID and t.Activity_ID = $activity_id)";
			break;
			
		case "family_games_no_team":
			$activity_id = 1;
			$SQL = "SELECT distinct email 
					FROM `Person` p
					inner join Person_Activity a on a.person_id = p.person_id
					WHERE p.email is not null
					and p.email != ''
					and a.activity_id = $activity_id
					and p.person_id not in (
                        select tm.person_id
                        from Team_Member tm
                        inner join Team t on t.Team_ID = tm.Team_ID and t.Activity_ID = $activity_id)";
			break;
			
		case "all":
		default:
			$SQL = "SELECT distinct email 
					FROM `Person` p";		
			break;
	}
	
	$result = mysqli_query($link, $SQL) or die($SQL."\n\nCouldn't execute Registration SELECT count query.".mysqli_error($link));

	$email_string = "";
	while($row = mysqli_fetch_array($result)) {	
		if (trim($row[email]) != "")
			$email_string .= $row[email]."; ";
	}
	$email_string = substr($email_string, 0, strlen($email_string) - 2);
	
	
	// Set up the return type header
	header("Content-type: text/plain;charset=utf-8");
	echo $email_string;
	
	mysqli_close($link); 
?>