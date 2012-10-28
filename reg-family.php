<?
	// Get the database connection information
	include("db-connect.php");

	header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

	mysql_connect(localhost,$username,$password) or die("Unable to connect to database");
	mysql_select_db($database) or die("Unable to select database");

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
	$dining_id = $_POST['cboDining'];

	require('GoogleMapAPI.class.php');

	$map = new GoogleMapAPI('map');
	// enter YOUR Google Map Key
	//$map->setAPIKey('ABQIAAAAYMNY23sJhxC4LyHvhouDAhT7jkmynjE8OMd-ikFKdpPdtz0ExRS8CQW29gereurYlNrENJbQEdpvYQ');
	$map->setAPIKey('ABQIAAAAYMNY23sJhxC4LyHvhouDAhTO1sTMmm0paPF-NqNRX-WjGyPHxxQNKDjpAKmhd7DBMSBEWqs826zUrw');

	$geoCode = $map->geoGetCoords($home_city);
	$geo_lat = $geoCode[lon];
	$geo_long = $geoCode[lat];

	// Verify there is not already an identical person in the system
	$SQL = "SELECT	COUNT(*) as count
			FROM	Person
			WHERE	First_Name = '".mysql_real_escape_string($main_contact_first)."'
					AND Last_Name = '".mysql_real_escape_string($main_contact_last)."'
					AND (Email = '".$main_contact_email."'
						OR Phone = '".$main_contact_phone."')";

	$result = mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute main contact SELECT count query.".mysql_error());
	//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact SELECT count query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$count = $row['count'];
	
	// If the person has already registered, update their information
	if ($count > 0) {
		$SQL = "SELECT	person_id
				FROM	Person
				WHERE	First_Name = '".mysql_real_escape_string($main_contact_first)."'
						AND Last_Name = '".mysql_real_escape_string($main_contact_last)."'
						AND (Email = '".$main_contact_email."'
							OR Phone = '".$main_contact_phone."')";

		$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact SELECT person query.".mysql_error());
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$mc_person_id = $row['person_id'];

		$SQL = "UPDATE	Person
				SET		First_Name = '".mysql_real_escape_string($main_contact_first)."',
						Last_Name = '".mysql_real_escape_string($main_contact_last)."',
						Age_Range = ".$main_contact_age.",
						Email = '".$main_contact_email."',
						Phone = '".$main_contact_phone."'
				WHERE	Person_ID = ".$mc_person_id;

		$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysql_error()); 

	// If they're a new registrant, enter their information
	} else {
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
					 '".mysql_real_escape_string($main_contact_first)."',
					 '".mysql_real_escape_string($main_contact_last)."',
					 ".$main_contact_age.",
					 '".$main_contact_email."',
					 '".$main_contact_phone."')";

		mysql_query($SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Main Contact Person INSERT query.".mysql_error());

		$mc_person_id = mysql_insert_id();		
	}

	setcookie("mc_person_id", $mc_person_id, $expire);

	// Verify there is not already an identical person in the system
	$SQL = "SELECT	COUNT(*) as count
			FROM	Registration
			WHERE	Main_Contact_Person_Id = ".$mc_person_id;

	$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Registration SELECT count query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$count = $row['count'];

	// If there is a previously-entered registration, just get the ID and move on.
	if ($count > 0) {
		$SQL = "SELECT	registration_id
				FROM	Registration
				WHERE	Main_Contact_Person_Id = ".$mc_person_id;

		$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration SELECT query.".mysql_error());
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$reg_id = $row['registration_id'];

		$SQL = "UPDATE	Registration
				SET		Housing_Type = ".$housing_type.",
						Number_In_Party = ".$num_in_party.",
						Housed_By = '".mysql_real_escape_string($housed_by)."',
						Dining_ID = ".$dining_id.",
						Home_City = '".mysql_real_escape_string($home_city)."',
						Geo_Lat = '".mysql_real_escape_string($geo_lat)."',
						Geo_Long = '".mysql_real_escape_string($geo_long)."'
				WHERE	Registration_ID = ".$reg_id;

		mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute registration UPDATE query.".mysql_error());
		//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration UPDATE query.".mysql_error());

	} else {
		// Insert the Registration table data
		$SQL = "INSERT INTO Registration
					(Registration_ID,
					 Main_Contact_Person_ID,
					 Housing_Type,
					 Number_In_Party,
					 Housed_By,
					 Dining_ID,
					 Home_City,
					 Geo_Lat,
					 Geo_Long)
				VALUES
					(NULL,
					 ".$mc_person_id.",
					 ".$housing_type.",
					 ".$num_in_party.",
					 '".mysql_real_escape_string($housed_by)."',
					 ".$dining_id.",
					 '".mysql_real_escape_string($home_city)."',
					 '".mysql_real_escape_string($geo_lat)."',
					 '".mysql_real_escape_string($geo_long)."')";

		mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute Registration INSERT query.".mysql_error());
		//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Registration INSERT query.".mysql_error());

		$reg_id = mysql_insert_id();
	}

	// Insert the activity data for the primary contact
	if ($activity > 0) {

		$SQL = "SELECT	COUNT(*) as count
				FROM	Person_Activity
				WHERE	person_id = ".$mc_person_id;

		$result = mysql_query( $SQL ) or die($SQL.mysql_error());//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute family activity SELECT count query.".mysql_error());
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$count = $row['count'];

		if ($count > 0) {
			$SQL = "UPDATE	Person_Activity
					SET		activity_id = ".$activity."
					WHERE	person_id = ".$mc_person_id;

			mysql_query( $SQL ) or die($SQL.mysql_error());//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute UPDATE family activity query.".mysql_error());

		} else {
			$SQL = "INSERT INTO	Person_Activity
							(Person_ID,
							 Activity_ID)
					VALUES
						(".$mc_person_id.",
						 ".$activity.");";


			mysql_query( $SQL ) or die($SQL.mysql_error());//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT family activity query.".mysql_error());
		}				
	}

	setcookie("reg_id", $reg_id, $expire);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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

		<p>We are trying to collect more information about who's attending the KC Weekend and what
		demographics to target in the future. This year, we're trying to add activities that all ages
		can enjoy.</p>

		<p>With that in mind, please fill all of the applicable fields below about your family/group.
		We will use this information for future activities as well as an emergency contact list should
		something of yours get lost... or someone :) All but the email and phone number fields are required
		since we already have yours...</p>

		<hr />
		<br/>
		<h3>Enter Family Information:</h3>
		<br/>

		<form id="reg-family" action="reg-housing.php" method="post">

<?	for ($i = 1; $i < $num_in_party; $i++) { ?>
			<fieldset><legend>Family Member #<?=($i + 1)?></legend>
				<p><label for="txtFirstName" class="required">First Name:</label>
<?		if ($i == 1) { ?>
				<input type="text" class="select-first" id="txtFirstName<?=$i?>" name="txtFirstName<?=$i?>" maxlength="255" size="30" /></p>
<?		} else { ?>
				<input type="text" id="txtFirstName<?=$i?>" name="txtFirstName<?=$i?>" maxlength="255" size="30" /></p>
<?		} ?>
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

		$result = mysql_query( $SQL ) or die("</select><br/>Couldn't execute query.".mysql_error());

		while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			echo "\t\t\t\t\t<option value='".$row[string_id]."'>".$row[string]."</option>\n";
		}
?>
				</select></p>
				
				<p><label for="cboActivity<?=$i?>">Choose an Activity:</label>
				<select id="cboActivity<?=$i?>" name="cboActivity<?=$i?>">
						<option value="0" selected>--Please Select--</option>
<?
		// Get the database connection information
		$SQL = "	SELECT	activity_id,
							activity_name
					FROM	Activity_Type";

		$result = mysql_query( $SQL ) or die("</select><br/>Couldn't execute query.".mysql_error());

		while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			echo "\t\t\t\t\t\t<option value='".$row[activity_id]."'>".$row[activity_name]."</option>\n";
		}
?>
				</select><em>(You can fill this out later if you're not sure yet.)</em></p>
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

	mysql_close();
?>
