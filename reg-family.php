<?
	// Get the database connection information
	include("db-connect.php");

	mysql_connect(localhost,$username,$password) or die("Unable to connect to database");
	mysql_select_db($database) or die("Unable to select database");


	// Get the POST data
	$expire = time() + (60*60*2);

	$main_contact_first = $_POST['txtFirstName'];
	$main_contact_last = $_POST['txtLastName'];
	$main_contact_sex = $_POST['cboSex'];
	$main_contact_age = $_POST['cboAgeRange'];
	$main_contact_email = $_POST['txtEmail'];
	$main_contact_phone = $_POST['txtPhone'];

	$housing_type = $_POST['cboHousingType'];
	setcookie("housing_type", $housing_type, $expire);

	$housed_by = $_POST['txtHousedBy'];

	$num_in_party = $_POST['txtNumInParty'];
	setcookie("num_in_party", $num_in_party, $expire);


	// Verify there is not already an identical person in the system
	$SQL = "SELECT	COUNT(*) as count
			FROM	Person
			WHERE	First_Name = '".$main_contact_first."'
					AND Last_Name = '".$main_contact_last."'
					AND (Email = '".$main_contact_email."'
						OR Phone = '".$main_contact_phone."')";

	$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact SELECT count query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$count = $row['count'];

	// If the person has already registered, update their information
	if ($count > 0) {
		$SQL = "SELECT	person_id
				FROM	Person
				WHERE	First_Name = '".$main_contact_first."'
						AND Last_Name = '".$main_contact_last."'
						AND (Email = '".$main_contact_email."'
							OR Phone = '".$main_contact_phone."')";

		$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact SELECT person query.".mysql_error());
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$mc_person_id = $row['person_id'];

		$SQL = "UPDATE	Person
				SET		First_Name = '".$main_contact_first."',
						Last_Name = '".$main_contact_last."',
						Sex = ".$main_contact_sex.",
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
					 Sex,
					 Age_Range,
					 Email,
					 Phone)
				VALUES
					(NULL,
					 '".$main_contact_first."',
					 '".$main_contact_last."',
					 ".$main_contact_sex.",
					 ".$main_contact_age.",
					 '".$main_contact_email."',
					 '".$main_contact_phone."')";

		mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Main Contact Person INSERT query.".mysql_error());

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
						Housed_By = '".$housed_by."'
				WHERE	Registration_ID = ".$reg_id;

		mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration UPDATE query.".mysql_error());

	} else {
		// Insert the Registration table data
		$SQL = "INSERT INTO Registration
					(Registration_ID,
					 Main_Contact_Person_ID,
					 Housing_Type,
					 Number_In_Party,
					 Housed_By)
				VALUES
					(NULL,
					 ".$mc_person_id.",
					 ".$housing_type.",
					 ".$num_in_party.",
					 '".$housed_by."')";

		mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Registration INSERT query.".mysql_error());

		$reg_id = mysql_insert_id();
	}

	setcookie("reg_id", $reg_id, $expire);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Family</title>

	<link rel="stylesheet" href="page.css" type="text/css" media="screen" />

	<script type="text/javascript">
	function OnLoad() {
	<? if ($num_in_party <= 1) { ?>
		document.getElementById("reg-family").submit();
	<? } else { ?>
		document.getElementById("txtFirstName1").focus();
		return true;
	<? } ?>
	}

	function VerifyAndSubmit() {
		// Check the fields to see if any are empty
		for (var i=1; i < <?=$num_in_party?>; i++) {
			if (document.getElementById("txtFirstName" + i.toString()).value == '') {
				alert("Please fill out Family Member #" + i + "'s First Name field, if you would... I would hope you'd know them on a first-name basis by now!");
				return false;
			}

			if (document.getElementById("txtLastName" + i.toString()).value == '') {
				alert("Please fill out Family Member #" + i + "'s Last Name field...  I would hope you'd know their names by now!");
				return false;
			}

			if (document.getElementById("cboSex" + i.toString()).value == '0') {
				alert("Please fill out Family Member #" + i + "'s Gender field. I would think that's public knowledge...");
				return false;
			}

			if (document.getElementById("cboAgeRange" + i.toString()).value == '0') {
				alert("Please fill out Family Member #" + i + "'s Description That Best Fits field.");
				return false;
			}

			// Remove any apostrophes because they make PHP and database unhappy. :,(
			document.getElementById("txtFirstName" + i.toString()).value = document.getElementById("txtFirstName" + i.toString()).value.replace("\'", "");
			document.getElementById("txtLastName" + i.toString()).value = document.getElementById("txtLastName" + i.toString()).value.replace("\'", "");
		}

		document.getElementById("reg-family").submit();
	}
	</script>

</head>

<body onload="OnLoad();">

<div id="container">

	<!-- Add the header to each page -->
	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->

	<div id="maincontent_container">
	<div id="maincontent">

		<h2 class="standout">Registration</h2>

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
		<table border="0">

<?	for ($i = 1; $i < $num_in_party; $i++) { ?>
			<tr></tr><tr>
				<td>
					<h3><u>Family Member #<?=($i + 1)?></u></h3>
				</td>
			</tr>
			<tr>
				<td class="label">
					*First Name:
				</td>
				<td>
					<input type="text" id="txtFirstName<?=$i?>" name="txtFirstName<?=$i?>" maxlength="255" size="30" />
				</td>
				<td class="label">
					*Last Name:
				</td>
				<td>
					<input type="text" id="txtLastName<?=$i?>" name="txtLastName<?=$i?>" maxlength="255" size="30" />
				</td>
			</tr>
			<tr>
				<td class="label">
					Email (if different):
				</td>
				<td>
					<input type="text" id="txtEmail<?=$i?>" name="txtEmail<?=$i?>" maxlength="255" size="30" />
				</td>
				<td class="label">
					Phone (if different)  [XXX-XXX-XXXX]:
				</td>
				<td>
					<input type="text" id="txtPhone<?=$i?>" name="txtPhone<?=$i?>" maxlength="255" size="30" />
				</td>
			</tr>
			<tr>
				<td class="label">
					*Gender:
				</td>
				<td>
					<select id="cboSex<?=$i?>" name="cboSex<?=$i?>">
						<option value="0" selected>--Please Select--</option>
						<option value="2">Female</option>
						<option value="1">Male</option>
					</select>
				</td>
				<td class="label">
					*Description That Fits Best:
				</td>
				<td>
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
			echo "\t\t\t\t\t\t<option value='".$row[string_id]."'>".$row[string]."</option>\n";
		}
?>
					</select>
				</td>
			</tr>
<?
	}
?>
		</table>

		<p><em>* - Required field</em></p>
		<hr />
		<br />
		<input type="button" value="< Back" onclick="history.go(-1);" />
		<input type="button" value="Next >" onclick="VerifyAndSubmit();" />
		</form>

	</div>
	</div>

	<div class="clearthis">&nbsp;</div>

	<!-- End of Main Content Area -->

	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>

</div>

</body>
</html>

<?
	mysql_close();
?>
