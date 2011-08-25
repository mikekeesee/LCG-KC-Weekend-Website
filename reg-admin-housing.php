<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend: Add Housing</title>

	<link rel="stylesheet" href="page.css" type="text/css" media="screen" />

	<script type="text/javascript">
	function OnLoad() {
		document.getElementById("txtFirstName").focus();
		return true;
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
			alert("Please fill out First Name field, if you would.");
			return false;
		}

		if (document.getElementById("txtLastName").value == '') {
			alert("Please fill out the Last Name field, if you would.");
			return false;
		}

		// Allow either phone or email to be used
		if ((document.getElementById("txtEmail").value == '') &&
			(document.getElementById("txtPhone").value == '')) {
			alert("Please fill out either the Email or Phone Number field.");
			return false;
		}

		if (document.getElementById("house_more_ind").checked == true) {
			if (document.getElementById("how_many").value == '' ||
				IsNumeric(document.getElementById("how_many").value) == false) {
				alert("Please enter a number into the 'How many more guests could you house?' field.");
				return false;
			}
		} else {
			if (document.getElementById("guest_names").value == '') {
				alert("Please review the check box 'Can you house any more guests?' If correct, please fill out the guests that are staying with them.");
				return false;
			}
		}

		// Remove any apostrophes because they make PHP and database unhappy. :,(
		document.getElementById("txtFirstName").value = document.getElementById("txtFirstName").value.replace("\'", "");
		document.getElementById("txtLastName").value = document.getElementById("txtLastName").value.replace("\'", "");
		document.getElementById("address1").value = document.getElementById("address1").value.replace("\'", "");
		document.getElementById("address2").value = document.getElementById("address2").value.replace("\'", "");
		document.getElementById("city").value = document.getElementById("city").value.replace("\'", "");
		document.getElementById("guest_names").value = document.getElementById("guest_names").value.replace("\'", "");
		document.getElementById("pets_info").value = document.getElementById("pets_info").value.replace("\'", "");
		document.getElementById("other").value = document.getElementById("other").value.replace("\'", "");

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

		<h2>Registration</h2>
		<p>Fill out at least the name fields, the email or phone number and how many they can house (even if it's zero).
		This form will look up the contact in the table to see if they've already registered and add this data to any
		existing information.</p>
		<hr />

		<br/>
		<em><-- <a href="reg-admin.php">Back to Registration Admin</a></em>
		<br/>

		<br/>
		<h3>Housing Information:</h3>
		<br/>
		<form id="reg-family" action="reg-admin-housing-submit.php" method="post">

		<table border="0">
			<tr>
				<td>
					<h3><u>Name:</u></h3>
				</td>
			</tr>
		</table>
		<table border="0">
			<tr>
				<td class="label">
					*First Name:
				</td>
				<td>
					<input type="text" id="txtFirstName" name="txtFirstName" maxlength="255" size="30" />
				</td>
			</tr>
			<tr>
				<td class="label">
					*Last Name:
				</td>
				<td>
					<input type="text" id="txtLastName" name="txtLastName" maxlength="255" size="30" />
				</td>
			</tr>
		</table>
		<table border="0">
			<tr>
				<td>
					<h3><u>Contact Information:</u></h3>
				</td>
			</tr>
		</table>
		<table border="0">
			<tr>
				<td class="label">
					*Email:
				</td>
				<td>
					<input type="text" id="txtEmail" name="txtEmail" maxlength="255" size="30" />
				</td>
			</tr>
			<tr>
				<td class="label">
					*Phone [XXX-XXX-XXXX]:
				</td>
				<td>
					<input type="text" id="txtPhone" name="txtPhone" maxlength="255" size="30" />
				</td>
			</tr>
		</table>
		<table border="0">
			<tr>
				<td>
					<h3><u>Housing Address Information:</u></h3>
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
					<label><input type="checkbox" id="house_more_ind" name="house_more_ind" />  *Can you house any more guests?</label>
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

		<p><em>* - Required field</em></p>
		<hr />
		<br />
		<input type="button" value="Submit" onclick="VerifyAndSubmit();" />
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