<?
	// Get the database connection information
	include("db-connect.php");

	header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

	$link = mysqli_connect(localhost, $username, $password, $database);

	// Get the POST data
	$expire = time() + (60*60*24*7);

	$main_contact_first = $_POST['txtFirstName'];
	$main_contact_last = $_POST['txtLastName'];
	$main_contact_age = $_POST['cboAgeRange'];
	$main_contact_email = $_POST['txtEmail'];
	$main_contact_phone = $_POST['txtPhone'];

	$housing_type = $_POST['cboHousingType'];
	setcookie("housing_type", $housing_type, $expire);
	
	$home_city = $_POST['txtHomeCity'];

	$housed_by = $_POST['txtHousedBy'];

	$num_in_party = $_POST['txtNumInParty'];
	setcookie("num_in_party", $num_in_party, $expire);

	$activity = $_POST['cboActivity'];
	
	//$dining_id = 14; // <-- Uncomment when dining numbers must be submitted
	$dining_id = $_POST['cboDining'];
	$dining_type_count = $_POST['hidDiningCount'];

	for($i = 1; $i <= $dining_type_count; $i++) {
		$dining_type[$i] = $_POST['hidDining'.$i];
		$dining_count[$i] = $_POST['txtDiningPref'.$i];
	}

	require('GoogleMapAPI.class.php');

	$map = new GoogleMapAPI('map');
	// enter YOUR Google Map Key
	//$map->setAPIKey('ABQIAAAAYMNY23sJhxC4LyHvhouDAhT7jkmynjE8OMd-ikFKdpPdtz0ExRS8CQW29gereurYlNrENJbQEdpvYQ');
	//$map->setAPIKey('ABQIAAAAYMNY23sJhxC4LyHvhouDAhTO1sTMmm0paPF-NqNRX-WjGyPHxxQNKDjpAKmhd7DBMSBEWqs826zUrw');
    $map->setAPIKey('AIzaSyCay9f5poJilMsp4vzmXEEM-dMM1PwSll8');

	$geoCode = $map->geoGetCoords($home_city);
	$geo_lat = $geoCode[lon];
	$geo_long = $geoCode[lat];
    
	// Verify there is not already an identical person in the system set as the main contact
    //   NOTE: There are sometimes where the husband AND wife will both register independently, setting themselves
    //         as the primary contact. This will hopefully prevent combining the same Person_ID on two different registrations.
	$SQL = "SELECT	p.Person_ID,
                    rp.Registration_ID
                    
			FROM	Person p
                
                INNER JOIN Registration_Person rp
                    ON p.Person_ID = rp.Person_ID
                    AND rp.Main_Contact_Ind = 1
                    
			WHERE	p.First_Name = '".mysqli_real_escape_string($link, $main_contact_first)."'
					AND p.Last_Name = '".mysqli_real_escape_string($link, $main_contact_last)."'
					AND (p.Email = '".$main_contact_email."'
						OR p.Phone = '".$main_contact_phone."')";
    $result = mysqli_query($link, $SQL) or die($SQL."\n\nCouldn't execute main contact SELECT count query.".mysqli_error($link));
	//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact SELECT count query.".mysqli_error($link));
	$count = mysqli_num_rows($result);
	// If the person has already registered, update their information
	if ($count > 0) {
        $row = mysqli_fetch_array($result);
		$mc_person_id = $row['Person_ID'];
        $reg_id = $row['Registration_ID'];

		$SQL = "UPDATE	Person
				SET		First_Name = '".mysqli_real_escape_string($link, $main_contact_first)."',
						Last_Name = '".mysqli_real_escape_string($link, $main_contact_last)."',
						Age_Range = ".$main_contact_age.",
						Email = '".$main_contact_email."',
						Phone = '".$main_contact_phone."'
				WHERE	Person_ID = ".$mc_person_id;
        
		$result = mysqli_query($link,  $SQL ) or die("update person".mysqli_error($link)); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysqli_error($link)); 

		$SQL = "UPDATE	Registration
				SET		Housing_Type = ".$housing_type.",
						Number_In_Party = ".$num_in_party.",
						Housed_By = '".mysqli_real_escape_string($link, $housed_by)."',
						Dining_ID = ".$dining_id.",
						Home_City = '".mysqli_real_escape_string($link, $home_city)."',
						Geo_Lat = '".mysqli_real_escape_string($link, $geo_lat)."',
						Geo_Long = '".mysqli_real_escape_string($link, $geo_long)."'
				WHERE	Registration_ID = ".$reg_id;

		mysqli_query($link, $SQL) or die($SQL."\n\nCouldn't execute registration UPDATE query.".mysqli_error($link));
		//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration UPDATE query.".mysqli_error($link));

	} else { // If they're a new registrant, enter their information
		// Insert the Person table data for the main contact.
		$SQL = "INSERT INTO Person
					(Person_ID,
					 First_Name,
					 Last_Name,
					 Age_Range,
					 Email,
					 Phone)
				VALUES
					(NULL,
					 '".mysqli_real_escape_string($link, $main_contact_first)."',
					 '".mysqli_real_escape_string($link, $main_contact_last)."',
					 ".$main_contact_age.",
					 '".$main_contact_email."',
					 '".$main_contact_phone."')";

		mysqli_query($link, $SQL ) or die("insert person".mysqli_error($link)); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Main Contact Person INSERT query.".mysqli_error($link));

		$mc_person_id = mysqli_insert_id($link);		

		// Insert the Registration table data
		$SQL = "INSERT INTO Registration
					(Registration_ID,
					 Housing_Type,
					 Number_In_Party,
					 Housed_By,
					 Dining_ID,
					 Home_City,
					 Geo_Lat,
					 Geo_Long)
				VALUES
					(NULL,
					 ".$housing_type.",
					 ".$num_in_party.",
					 '".mysqli_real_escape_string($link, $housed_by)."',
					 ".$dining_id.",
					 '".mysqli_real_escape_string($link, $home_city)."',
					 '".mysqli_real_escape_string($link, $geo_lat)."',
					 '".mysqli_real_escape_string($link, $geo_long)."')";

		mysqli_query($link, $SQL) or die("insert reg".mysqli_error($link)); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Registration INSERT query.".mysqli_error($link));

		$reg_id = mysqli_insert_id($link);

		// Insert the data into the Registration_Person table for the main contact.
		$SQL = "INSERT INTO Registration_Person
					(Registration_ID,
                     Person_ID,
					 Main_Contact_Ind)
				VALUES
					(".$reg_id.",
					 ".$mc_person_id.",
					 1)";

		mysqli_query($link, $SQL) or die("insert reg_person".mysqli_error($link)); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Main Contact Person INSERT query.".mysqli_error($link));

    }

    // Set cookies for these values so we can quickly retrieve them in future registration pages.
	setcookie("mc_person_id", $mc_person_id, $expire);
	setcookie("reg_id", $reg_id, $expire);

	// Verify there is not already an identical person in the system
	$SQL = "SELECT	COUNT(*) as count
			FROM	Registration_Dining
			WHERE	Registration_ID = ".$reg_id;

	$result = mysqli_query($link, $SQL) or die("select reg dining".mysqli_error($link)); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Registration SELECT count query.".mysqli_error($link));
	$row = mysqli_fetch_array($result);
	$count = $row['count'];

	// If there is a previously-entered registration, delete the data and start over (we're lazy these days).
	if ($count > 0) {
		$SQL = "DELETE FROM	Registration_Dining
				WHERE		Registration_ID = ".$reg_id;
				
		mysqli_query($link,  $SQL ) or die("delete reg dining".mysqli_error($link)); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute DELETE reg dining query.".mysqli_error($link));
	}

	for ($i = 1; $i <= $dining_type_count; $i++) {
		if ($dining_count[$i] > 0) {
			$SQL = "INSERT INTO	Registration_Dining
								(Registration_ID,
								 Dining_Type_ID,
								 Number_In_Party)
						VALUES (".$reg_id.", ".$dining_type[$i].", ".$dining_count[$i].")";

			mysqli_query($link, $SQL) or die("insert reg dining".mysqli_error($link)); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT family activity query.".mysqli_error($link));
		}
	}
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Family</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />

	<? include "jqgrid-header.php" ?>
	<script src="js/jquery.validate.min.js" type="text/javascript"></script>
	<script src="js/input-placeholder.js" type="text/javascript"></script>

	<? include ('google-analytics.php'); ?>
</head>

<body>

	<!-- Add the header to each page -->
	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->

	<div class="main-content">

		<h2>Registration</h2>

		<p>We would like to get to know about your family and/or traveling group a little better, too.</p>

		<p>Please fill all of the applicable fields below about yourselves.
		We will use this information for future activities as well as an emergency contact list should
		something of yours get lost... or someone :)</p>

		<hr />
		<br/>
		<h3>Enter Family Information:</h3>
		<br/>

		<form id="reg-family" action="reg-activity.php" method="post">

<?	for ($i = 1; $i < $num_in_party; $i++) { ?>
			<fieldset><legend>Family Member #<?=($i + 1)?></legend>
				<p><label for="txtFirstName" class="required">First Name:</label>
				<input type="text" id="txtFirstName<?=$i?>" name="txtFirstName<?=$i?>" maxlength="255" size="30" /></p>

				<p><label for="txtLastName<?=$i?>" class="required">Last Name:</label>
				<input type="text" id="txtLastName<?=$i?>" name="txtLastName<?=$i?>" maxlength="255" size="30" /></p>

				<p><label for="txtEmail<?=$i?>" class="required">Email (if different):</label>
				<input type="text" id="txtEmail<?=$i?>" name="txtEmail<?=$i?>" maxlength="255" size="30" placeholder="user@domain.com" /></p>

				<p><label for="txtPhone<?=$i?>" class="required">Phone (if different):</label>
				<input type="text" id="txtPhone<?=$i?>" name="txtPhone<?=$i?>" maxlength="255" size="30" placeholder="XXX-XXX-XXXX" /></p>

				<p><label for="cboAgeRange<?=$i?>" class="required">Description That Fits Best:</label>
				<select id="cboAgeRange<?=$i?>" name="cboAgeRange<?=$i?>">
					<option value="0" selected>--Please Select--</option>
<?
		// Get the database connection information
		$SQL = "	SELECT	string_id,
							string
					FROM String_Base
					WHERE string_grouping = 1";

		$result = mysqli_query($link, $SQL) or die("</select><br/>Couldn't execute query. ".mysqli_error($link));

		while($row = mysqli_fetch_array($result)) {
			echo "\t\t\t\t\t<option value='".$row[string_id]."'>".$row[string]."</option>\n";
		}
?>
				</select></p>
				
			</fieldset>
<?
	}
?>

		<hr />
		<br />
		<input type="button" value="< Back" onclick="history.go(-1);" />
		<input type="submit" value="Next >" />
		
		<input type="hidden" id="hid_numInParty" name="hid_numInParty" value="<?=$num_in_party?>">
		<input type="hidden" id="hid_housingType" name="hid_housingType" value="<?=$housing_type?>">
		<input type="hidden" id="hid_MCPersonID" name="hid_MCPersonID" value="<?=$mc_person_id?>">
		<input type="hidden" id="hid_regID" name="hid_regID" value="<?=$reg_id?>">
		</form>

	</div>

	<!-- End of Main Content Area -->

	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>

	<script type="text/javascript">
		$(document).ready(function() {
		<? if ($num_in_party <= 1) { ?>
			document.getElementById("reg-family").submit();
		<? } else { ?>
			$(".select-first").focus();
			$("input:button").button();
			$("input:submit").button();
		<? } ?>
		});

		$('#reg-family').validate({
			rules: {
<?	for ($i = 1; $i < $num_in_party; $i++) { ?>
				txtFirstName<?=$i?>: {
					required: true
				},
				txtLastName<?=$i?>: {
					required: true
				},
				cboAgeRange<?=$i?>: {
					required: true,
					min: 1
<?		if ($i < $num_in_party - 1) { ?>
				},
<?		} else { ?>
				}
<?		}
	} ?>
			},
			messages: {
<?	for ($i = 1; $i < $num_in_party; $i++) { ?>
				cboAgeRange<?=$i?>: "Please enter an age range."<?		if ($i < $num_in_party - 1) { ?>,
<?		}
	} ?>
			}
		});
	</script>
	
</body>
</html>

<?

	mysqli_close($link);
?>
