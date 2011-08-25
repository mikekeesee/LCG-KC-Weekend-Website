<?
	// Get the database connection information
	include("db-connect.php");

	mysql_connect(localhost,$username,$password) or die("Unable to connect to database");
	mysql_select_db($database) or die("Unable to select database");

	// Get the POST data and write it to a cookie
	$num_in_party = $_COOKIE["num_in_party"];
	$housing_type = $_COOKIE["housing_type"];
	$reg_id	= $_COOKIE["reg_id"];

	$expire = time() + (60*60*2);

	for ($i=1; $i < $num_in_party; $i++) {
		$first[$i]	= $_POST["txtFirstName".$i];
		$last[$i]	= $_POST["txtLastName".$i];
		$email[$i]	= $_POST["txtEmail".$i];
		$phone[$i]	= $_POST["txtPhone".$i];
		$sex[$i]	= $_POST["cboSex".$i];
		$age[$i]	= $_POST["cboAgeRange".$i];
	}


	// Insert the Person table data for each family member
	for ($i=1; $i < $num_in_party; $i++) {

		// First, check if the family member already exists on this registration.
		$SQL = "SELECT	COUNT(*) as count
				FROM	Person p, Registration_Person rp
				WHERE	p.Person_ID = rp.Person_ID
						AND rp.Registration_ID = ".$reg_id."
						AND p.First_Name = '".$first[$i]."'
						AND p.Last_Name = '".$last[$i]."'
						AND (p.Email = '".$email[$i]."'
							OR p.Phone = '".$phone[$i]."')";

		$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact SELECT count query.".mysql_error());
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$count = $row['count'];

		// If the person has already registered, update their information
		if ($count > 0) {
			$SQL = "SELECT	p.person_id as person_id
					FROM	Person p, Registration_Person rp
					WHERE	p.Person_ID = rp.Person_ID
							AND rp.Registration_ID = ".$reg_id."
							AND p.First_Name = '".$first[$i]."'
							AND p.Last_Name = '".$last[$i]."'
							AND (p.Email = '".$email[$i]."'
								OR p.Phone = '".$phone[$i]."')";

			$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact SELECT person query.".mysql_error());
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			$fam_person_id = $row['person_id'];

			$SQL = "UPDATE	Person
					SET		First_Name = '".$first[$i]."',
							Last_Name = '".$last[$i]."',
							Sex = ".$sex[$i].",
							Age_Range = ".$age[$i].",
							Email = '".$email[$i]."',
							Phone = '".$phone[$i]."'
					WHERE	Person_ID = ".$fam_person_id;

			mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysql_error());

		// If they're a new registrant, enter their information
		} else {

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
						 '".$first[$i]."',
						 '".$last[$i]."',
						 ".$sex[$i].",
						 ".$age[$i].",
						 '".$email[$i]."',
						 '".$phone[$i]."')";

			mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT family person query.".mysql_error());

			// Insert the Registration table data
			$SQL = "INSERT INTO Registration_Person
						(Registration_ID,
						 Person_ID)
					VALUES
						(".$reg_id.",
						 ".mysql_insert_id().");";

			mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT registration person query.".mysql_error());
		}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Housing</title>

	<link rel="stylesheet" href="page.css" type="text/css" media="screen" />

	<script type="text/javascript">
	function OnLoad() {
	<? if ($housing_type == 8) { ?>
		document.getElementById("chkHousing").focus();
		return true;
	<? } else { ?>
		document.getElementById("reg-housing").submit();
	<? } ?>
	}

	function CheckClick(check) {
		if (check.checked == true) {
			document.getElementById("divHousingForm").style.display = "";
		} else {
			document.getElementById("divHousingForm").style.display = "none";
		}
	}

	function IsNumeric(sText) {
	   var ValidChars = "0123456789.";
	   var IsNumber = true;
	   var Char;


	   for (i = 0; i < sText.length && IsNumber == true; i++) {
		  Char = sText.charAt(i);
		  if (ValidChars.indexOf(Char) == -1) {
			 IsNumber = false;
		  }
	   }

	   return IsNumber;
	}

	function VerifyAndSubmit() {
		// Check the fields to see if any are empty
		if (document.getElementById("chkHousing").checked == true) {
			if (document.getElementById("house_more_ind").checked == true) {
				if (document.getElementById("how_many").value == '' ||
					IsNumeric(document.getElementById("how_many").value) == false) {
					alert("Please enter a number into the 'How many more guests could you house?' field.");
					return false;
				}
			} else {
				if (document.getElementById("guest_names").value == '') {
					alert("If you're already full, our Housing Coordinator would love to know who's staying with you.");
					return false;
				}
			}
		}

		// Remove any apostrophes because they make PHP and database unhappy. :,(
		document.getElementById("address1").value = document.getElementById("address1").value.replace("\'", "");
		document.getElementById("address2").value = document.getElementById("address2").value.replace("\'", "");
		document.getElementById("city").value = document.getElementById("city").value.replace("\'", "");
		document.getElementById("guest_names").value = document.getElementById("guest_names").value.replace("\'", "");
		document.getElementById("pets_info").value = document.getElementById("pets_info").value.replace("\'", "");
		document.getElementById("other").value = document.getElementById("other").value.replace("\'", "");

		document.getElementById("reg-housing").submit();
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

		<p>As it has been in years past, many of our guests do stay in a hotel or with family.
		However, there are many more that do not have family in the area, nor do they have the
		resources to spend on a hotel.  And most would like to get to know YOU!</p>

		<p>In order to take advantage of this wonderful opportunity to get to know your fellow
		brethren, if you have the space and resources available, please help us out by filling
		out the housing information below.  It would really help us out, and you might make a
		new friend or five in the process...</p>
		<hr />

		<br/>
		<h3>Housing Information:</h3>
		<br/>
		<form id="reg-housing" action="reg-submit.php" method="post">
		<label><b><input type="checkbox" id="chkHousing" name="chkHousing" onclick="CheckClick(this);" />&nbsp;*If you would like to house or are already housing people, check this box.</b></label>
		<br/>
		<br/>

		<div id="divHousingForm" style="display:none">
		<table border="0">
			<tr>
				<td>
					<h3><u>Your Location:</u></h3>
				</td>
			</tr>
		</table>
		<table border="0">
			<tr>
				<td class="label">
					Address 1:
				</td>
				<td>
					<input type="text" id="address1" name="address1" maxlength="255" size="30" />
				</td>
			</tr>
			<tr>
				<td class="label">
					Address 2:
				</td>
				<td>
					<input type="text" id="address2" name="address2" maxlength="255" size="30" />
				</td>
			</tr>
			<tr>
				<td class="label">
					City:
				</td>
				<td>
					<input type="text" id="city" name="city" maxlength="255" size="30" />
				</td>
			</tr>
			<tr>
				<td class="label">
					State:
				</td>
				<td>
					<input type="text" id="state" name="state" maxlength="255" size="2" />
				</td>
			</tr>
			<tr>
				<td class="label">
					Zip Code:
				</td>
				<td>
					<input type="text" id="zip" name="zip" maxlength="255" size="10" />
				</td>
			</tr>
		</table>
		<table border="0">
			<tr>
				<td>
					<h3><u>Guest Information:</u></h3>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label><input type="checkbox" id="house_more_ind" name="house_more_ind" />  *Can you house more guests?</label>
				</td>
			</tr>
			<tr>
				<td class="label">
					*How many more guests could you house?:
				</td>
				<td>
					<input type="text" id="how_many" name="how_many" maxlength="255" size="2" />
				</td>
			</tr>
		</table>
		<table border="0">
			<tr>
				<td class="label">
					*If already housing guests, can you give us their name(s)?
				</td>
			</tr>
		</table>
		<table border="0">
			<tr>
				<td>
					&nbsp;&nbsp;<input type="text" id="guest_names" name="guest_names" maxlength="255" size="97" />
				</td>
			</tr>
		</table>
		<table border="0">
			<tr>
				<td class="label">
					<label><input type="checkbox" id="pets_ind" name="pets_ind" />  Pets?</label>
				</td>
				<td class="label">
					How many?  What kind?:
				</td>
				<td>
					<input type="text" id="pets_info" name="pets_info" maxlength="255" size="59" />
				</td>
			</tr>
		</table>
		<table border="0">
			<tr>
				<td>
					<h3><u>Transportation Needs:</u></h3>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label><input type="checkbox" id="air_trans_ind" name="air_trans_ind" />  Can you give a ride to/from the airport?</label>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label><input type="checkbox" id="act_trans_ind" name="act_trans_ind" />  Can you give a ride to/from the activities?</label>
				</td>
			</tr>
		</table>
		<table border="0">
			<tr>
				<td>
					<h3><u>Preferences:</u></h3>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label><input type="checkbox" id="couples_ind" name="couples_ind" />&nbsp;Couples&nbsp;&nbsp;</label>
				</td>
				<td class="label">
					<label><input type="checkbox" id="singles_ind" name="singles_ind" />&nbsp;Singles&nbsp;&nbsp;</label>
				</td>
				<td class="label">
					<label><input type="checkbox" id="girls_ind" name="girls_ind" />&nbsp;Girls&nbsp;&nbsp;</label>
				</td>
				<td class="label">
					<label><input type="checkbox" id="boys_ind" name="boys_ind" />&nbsp;Boys&nbsp;&nbsp;</label>
				</td>
				<td class="label">
					<label><input type="checkbox" id="adults_ind" name="adults_ind" />&nbsp;Adults Only&nbsp;&nbsp;</label>
				</td>
				<td class="label">
					<label><input type="checkbox" id="babies_ind" name="babies_ind" />&nbsp;Babies&nbsp;&nbsp;</label>
				</td>
				<td class="label">
					<label><input type="checkbox" id="teens_ind" name="teens_ind" />&nbsp;Teens&nbsp;&nbsp;</label>
				</td>
			</tr>
		</table>
		<table border="0">
			<tr>
				<td class="label">
					Other:
				</td>
				<td>
					<input type="text" id="other" name="other" maxlength="255" size="66" />
				</td>
			</tr>
		</table>
		</div>

		<p><em>* - Required field</em></p>
		<hr />
		<br />
	<? if ($num_in_party == 1) { ?>
		<input type="button" value="< Back" onclick="history.go(-2);" />
	<? } else { ?>
		<input type="button" value="< Back" onclick="history.go(-1);" />
	<? } ?>
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