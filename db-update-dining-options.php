<?
	// Get the database connection information
	include("db-connect.php");

	$link = mysqli_connect(localhost, $username, $password, $database);
    
	$reg_id			    = $_GET["reg_id"];
	$dining_type_count	= $_GET["dining_count"];
    
    if ($dining_type_count > 0) {
        for ($i=1; $i <= $dining_type_count; $i++) {
            $dining_type[$i] = $_GET['hidDining'.$i];
            $dining_count[$i] = $_GET['txtDiningPref'.$i];
        }

        // Verify there is not already an identical person in the system
        $SQL = "SELECT	COUNT(*) as count
                FROM	Registration_Dining
                WHERE	Registration_ID = ".$reg_id;

        $result = mysqli_query($link,  $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Registration SELECT count query.".mysqli_error($link));
        $row = mysqli_fetch_array($result);
        $count = $row['count'];

        // If there is a previously-entered registration, delete the data and start over (we're lazy these days).
        if ($count > 0) {
            $SQL = "DELETE FROM	Registration_Dining
                    WHERE		Registration_ID = ".$reg_id;
                    
            mysqli_query($link,  $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute DELETE reg dining query.".mysqli_error($link));
        }

        for ($i = 1; $i <= $dining_type_count; $i++) {
            if ($dining_count[$i] > 0) {
                $SQL = "INSERT INTO	Registration_Dining
                                    (Registration_ID,
                                     Dining_Type_ID,
                                     Number_In_Party)
                            VALUES (".$reg_id.", ".$dining_type[$i].", ".$dining_count[$i].")";

                mysqli_query($link,  $SQL ) or die($SQL.mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT family activity query.".mysqli_error($link));
            }
        }
    }
	
	// Now get the data to return via JSON
	$SQL = "SELECT	dining_type_id,
                    number_in_party
			FROM	Registration_Dining
			WHERE	Registration_ID = ".$reg_id;

	$result = mysqli_query($link,  $SQL ) or die($SQL."\n\nCouldn't execute registration dining SELECT query.".mysqli_error($link));
	//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration SELECT query.".mysqli_error($link));

    // Set up the return type header
    header("Content-type: application/json;charset=utf-8");

    $i = 1;
    $s = "[";
	while($row = mysqli_fetch_array($result)) {
        if ($i != 1) $s.= ',';
	    $s .= '{"diningType": "'.$row['dining_type_id'].'",';
	    $s .= ' "diningNum": '.$row['number_in_party'].'}';
        $i++;
    }
    
    $s .= ']';
    echo $s;
	
	mysqli_close($link);
?>
