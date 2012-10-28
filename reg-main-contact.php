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

		<p>Hi! Welcome to the registration page.  We want to get to know our guests the best we can so
		we can better serve you!</p>

		<p>Please fill out all the fields below.  We need at least one piece of contact information,
		so please enter at least your phone number or email address, but preferrably both.</p>

		<!-- The Registration Form for Main Contact Information -->
		<form id="reg-contact" action="reg-family.php" method="post">

			<fieldset><legend>Name:</legend>
				<p><label for="txtFirstName" class="required select-first">First Name:</label>
				<input type="text" id="txtFirstName" name="txtFirstName" maxlength="255" size="30" /></p>
				<p><label for="txtLastName" class="required">Last Name:</label>
				<input type="text" id="txtLastName" name="txtLastName" maxlength="255" size="30" /></p>
			</fieldset>

			<fieldset><legend>Contact Information:</legend>
				<p><label for="txtEmail" class="required">Email:</label>
				<input type="text" id="txtEmail" name="txtEmail" maxlength="255" size="30" placeholder="user@domain.com" />
				<em>&nbsp;&nbsp;NOTE: If you plan on donating money through PayPal, please use the same email address here.</em></p>
				<p><label for="txtPhone" class="required">Phone:</label>
				<input type="text" id="txtPhone" name="txtPhone" maxlength="255" size="30" placeholder="XXX-XXX-XXXX"/></p>
			</fieldset>

			<fieldset><legend>General Demographics:</legend>
				<p><label for="cboAgeRange" class="required">Description That Best Fits:</label>
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
				</select></p>
			</fieldset>

			<fieldset><legend>Housing:</legend>
				<p><label for="cboHousingType" class="required">Choose a housing option:</label>
				<select id="cboHousingType" name="cboHousingType" >
					<option value="0" selected>--Please Select--</option>
<?
	$SQL = "	SELECT	string_id,
						string
				FROM String_Base
				WHERE string_grouping = 2";

	$result = mysql_query( $SQL ) or die("</select><br/>Couldn't execute query.".mysql_error()."");

	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		if ($row[string_id] == 10) {
			echo "\t\t\t\t\t<option class='toggleOnSelected' value='".$row[string_id]."'>".$row[string]."</option>\n";
		} else {
			echo "\t\t\t\t\t<option value='".$row[string_id]."'>".$row[string]."</option>\n";
		}
	}
?>
				</select></p>

				<!-- Hide until user selects 'Already housed with brethren' -->
				<div class="toggle">
					<p><label for="txtHousedBy">
						If you've already made plans to stay with brethren, would you tell us their name?
					</label>
					<label for="txtHousedBy" class="required">Housed By:</label>
					<input type="text" id="txtHousedBy" name="txtHousedBy" maxlength="255" size="30" /></p>
				</div>
				
				<p><label for="txtHomeCity">If from out of town, where are you from?:</label>
				<input type="text" id="txtHomeCity" name="txtHomeCity" maxlength="255" size="30" placeholder="City, State" /></p>

				<p><label for="txtNumInParty" class="required">Number in Party:</label>
				<input type="text" id="txtNumInParty" name="txtNumInParty" maxlength="2" size="2" /></p>
			</fieldset>

			<fieldset><legend>Additional Preferences:</legend>
				<p><label for="cboActivity">Choose an Activity for yourself:</label>
				<select id="cboActivity" name="cboActivity">
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
				</select><em>&nbsp;&nbsp;(You can fill this out later if you're not sure yet.)</em></p>

				<p><label for="cboDining" class="required">Dining Preference:</label>
				<select id="cboDining" name="cboDining">
					<option value="0" selected>--Please Select--</option>
<?
	$SQL = "	SELECT	string_id,
						string
				FROM String_Base
				WHERE string_grouping = 3";

	$result = mysql_query( $SQL ) or die("</select><br/>Couldn't execute query.".mysql_error()."");

	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo "\t\t\t\t\t<option value='".$row[string_id]."'>".$row[string]."</option>\n";
	}
?>
				</select></p>
			</fieldset>
				
			<!-- <p class="required"><em> - Required field</em></p> -->

			<input type="submit" value="Next >" />

		</form>


	</div>

	<!-- End of Main Content Area -->

	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>

	<script type="text/javascript">
		$(document).ready(function() {
			$(".select-first").focus();
			$("input:submit").button();
		});

		var toggle = function() {
			if ($("option:selected").is(".toggleOnSelected") == true) {
				if ($(".toggle:hidden").length > 0)
					$(".toggle").show("drop", function() {
						if (navigator.appName == 'Microsoft Internet Explorer') {
							this.style.removeAttribute("filter");
						}
					});
			} else {
				if ($(".toggle:visible").length > 0)
					$(".toggle").hide("puff");
			}
		}

		$('select').change(toggle).change();
		$('select').keyup(toggle);
		
		jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
			phone_number = phone_number.replace(/\s+/g, ""); 
			return this.optional(element) || phone_number.length > 9 &&
				phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
		}, "Please specify a valid phone number");

		$('#reg-contact').validate({
			rules: {
				txtFirstName: {
					required: true
				},
				txtLastName: {
					required: true
				},
				txtEmail: {
					required: function () {
						return $("#txtPhone").val().length == 0;
					},
					email: true
				},
				txtPhone: {
					required:  function () {
						return $("#txtEmail").val().length == 0;
					},
					phoneUS: true
				},
				cboAgeRange: {
					required: true,
					min: 1
				},
				cboHousingType: {
					required: true,
					min: 1
				},
				txtHousedBy: {
					required: function () {
						return $("#cboHousingType").val() == 10;
					}
				},
				txtNumInParty: {
					required: true,
					number: true,
					min: 1,
					max: 20
				},
				cboDining: {
					required: true,
					min: 1
				}
			},
			messages: {
				cboAgeRange: "Please enter an age range.",
				cboHousingType: "Please enter a housing type.",
				cboDining: "Please let us know what you'd like to munch on."
			}
		});
	</script>
</body>
</html>

<?
	mysql_close();
?>
