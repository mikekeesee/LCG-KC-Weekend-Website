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
				<label for="txtFirstName" class="required select-first">First Name:</label>
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
				</select>

				<!-- Hide until user selects 'Already housed with brethren' -->
				<div class="toggle">
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

			<input type="submit" value="Next >" />

		</form>


	</div>

	<!-- End of Main Content Area -->

	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>

	<script type="text/javascript">
		$(document).ready(function() {
			$(".select-first").focus();
			$(".toggle").hide("");
			$("input:submit").button();
		});

		var toggle = function() {
			//alert("hi!");
			if ($("option:selected").is(".toggleOnSelected") == true) {
				if ($(".toggle:hidden").length > 0)
					$(".toggle").show("drop");
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
				}
			}
		});
	</script>
</body>
</html>

<?
	mysql_close();
?>
