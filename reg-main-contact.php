<?
	// Get the database connection information
	include("db-connect.php");

	mysql_connect(localhost,$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend: Registration</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/jquery-ui-1.8.16.custom.css" />

	<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript">
	function OnLoad() {
		document.getElementById("txtFirstName").focus();
		$("#jqToggle").hide("");
	}

	function CheckHousing() {
		var cboHousing = document.getElementById("cboHousingType");
		if (cboHousing.options[cboHousing.selectedIndex].value == '10') {
			$("#jqToggle").show("drop");
//			document.getElementById("txtHousedBy").style.display = "";
//			document.getElementById("lblHousedBy").style.display = "";
//			document.getElementById("tdHousedBy").style.display = "";
		} else {
			$("#jqToggle").hide("puff");

//			document.getElementById("txtHousedBy").style.display = "none";
//			document.getElementById("lblHousedBy").style.display = "none";
//			document.getElementById("tdHousedBy").style.display = "none";
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
		if (document.getElementById("txtFirstName").value == '') {
			alert("Please fill out First Name field, if you would...  Thanks!");
			return false;
		}

		if (document.getElementById("txtLastName").value == '') {
			alert("Please fill out the Last Name field, if you would...  Thanks!");
			return false;
		}


		// Allow either phone or email to be used
		if ((document.getElementById("txtEmail").value == '') &&
			(document.getElementById("txtPhone").value == '')) {
			alert("Please fill out either the Email or Phone Number field, if you would...  Thanks!");
			return false;
		}


		if (document.getElementById("cboSex").value == '0') {
			alert("Please fill out the Gender field, if you would...  Thanks!");
			return false;
		}

		if (document.getElementById("cboAgeRange").value == '0') {
			alert("Please fill out Description That Best Fits field, if you would...  Thanks!");
			return false;
		}

		if (document.getElementById("cboHousingType").value == '0') {
			alert("Please fill out the Housing Type field, if you would...  Thanks!");
			return false;
		}

		var num = document.getElementById("txtNumInParty").value;
		if (num == '') {
			alert("Please fill out Number in Party field, if you would...  Thanks!");
			return false;
		}

		if (IsNumeric(num) == false) {
			alert("Please make sure the Number in Party field is a number.");
			return false;
		}

		if (parseInt(num) < 1) {
			alert("You know that's impossible... Please enter 1 or more for the Number in Party field.");
			return false;
		}

		var cboHousing = document.getElementById("cboHousingType");
		if (cboHousing.options[cboHousing.selectedIndex].value == '10') {
			if (document.getElementById("txtHousedBy").value == '') {
				alert("Please fill out the Housed By field.  It greatly helps our housing coordinator... Thanks!");
				return false;
			}
		}

		// Remove any apostrophes because they make PHP and database unhappy. :,(
		document.getElementById("txtFirstName").value = document.getElementById("txtFirstName").value.replace("\'", "");
		document.getElementById("txtLastName").value = document.getElementById("txtLastName").value.replace("\'", "");

		document.getElementById("reg-contact").submit();
	}
	</script>

</head>

<body onload="OnLoad();">

	<!-- Add the header to each page -->
	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->

	<div id="main-content">

		<h2>Registration</h2>

		<p>Hi! Welcome to the registration page.  We want to get to know our guests the best we can so
		we can better serve you!</p>

		<p>Please fill out all the fields below.  We need at least one piece of contact information,
		so please enter at least your phone number or email address, but preferrably both.</p>

		<!-- The Registration Form for Main Contact Information -->
		<form id="reg-contact" action="reg-family.php" method="post">

			<fieldset><legend>Name:</legend>
				<label for="txtFirstName" class="required">First Name:</label>
				<input type="text" id="txtFirstName" name="txtFirstName" maxlength="255" size="30" />
				<label for="txtLastName" class="required">Last Name:</label>
				<input type="text" id="txtLastName" name="txtLastName" maxlength="255" size="30" />
			</fieldset>

			<fieldset><legend>Contact Information:</legend>
				<label for="txtEmail" class="required">Email:</label>
				<input type="text" id="txtEmail" name="txtEmail" maxlength="255" size="30" />
				<label for="txtPhone" class="required">Phone [XXX-XXX-XXXX]:</label>
				<input type="text" id="txtPhone" name="txtPhone" maxlength="255" size="30" />
			</fieldset>

			<fieldset><legend>General Demographics:</legend>
				<label for="cboAgeRange" class="required">Description That Best Fits:</label>
				<select id="cboAgeRange" name="cboAgeRange">
					<option value="0" selected>--Please Select--</option>
<?
	$SQL = "	SELECT	string_id,
						string
				FROM String_Base
				WHERE string_grouping = 1";

	$result = mysql_query( $SQL ) or die("</select><br/>Couldn't execute query.".mysql_error()."");

	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo "\t\t\t\t\t<option value='".$row[string_id]."'>".$row[string]."</option>\n";
	}
?>
				</select>
			</fieldset>

			<fieldset><legend>Housing:</legend>
				<label for="cboHousingType" class="required">Choose a housing option:</legend>
				<select id="cboHousingType" name="cboHousingType" onchange="CheckHousing();" onkeyup="CheckHousing();">
					<option value="0" selected>--Please Select--</option>
<?
	$SQL = "	SELECT	string_id,
						string
				FROM String_Base
				WHERE string_grouping = 2";

	$result = mysql_query( $SQL ) or die("</select><br/>Couldn't execute query.".mysql_error()."");

	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo "\t\t\t\t\t<option value='".$row[string_id]."'>".$row[string]."</option>\n";
	}
?>
				</select>

				<!-- Hide until user selects 'Already housed with brethren' -->
				<div id="jqToggle">
					<label for="txtHousedBy">
						If you've already made plans to stay with brethren, would you tell us their name?
					</label>
					<label for="txtHousedBy" class="required">Housed By:</label>
					<input type="text" id="txtHousedBy" name="txtHousedBy" maxlength="255" size="30" />
				</div>

				<label for="txtNumInParty" class="required">Number in Party:</label>
				<input type="text" id="txtNumInParty" name="txtNumInParty" maxlength="2" size="2" />
			</fieldset>

			<p class="required"><em> - Required field</em></p>

			<input type="button" value="Next >" onclick="VerifyAndSubmit();" class="ui-state-default ui-corner-all" />

		</form>


	</div>

	<!-- End of Main Content Area -->

	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>

</body>
</html>

<?
	mysql_close();
?>
