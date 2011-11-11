<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend: Add Housing</title>

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
		<p>Fill out at least the name fields, the email or phone number and how many they can house (even if it's zero).
		This form will look up the contact in the table to see if they've already registered and add this data to any
		existing information.</p>
		<hr />

		<br/>
		<a href="reg-admin.php"><-- Back to Registration Admin</a>
		<br/>

		<br/>
		<form id="reg-housing" action="reg-admin-housing-submit.php" method="post">

		<fieldset><legend>Name:</legend>
			<p><label for="txtFirstName" class="required select-first">First Name:</label>
			<input type="text" id="txtFirstName" name="txtFirstName" maxlength="255" size="30" /></p>
			<p><label for="txtLastName" class="required">Last Name:</label>
			<input type="text" id="txtLastName" name="txtLastName" maxlength="255" size="30" /></p>
		</fieldset>

		<fieldset><legend>Contact Information:</legend>
			<p><label for="txtEmail" class="required">Email:</label>
			<input type="text" id="txtEmail" name="txtEmail" maxlength="255" size="30" /></p>
			<p><label for="txtPhone" class="required">Phone [XXX-XXX-XXXX]:</label>
			<input type="text" id="txtPhone" name="txtPhone" maxlength="255" size="30" /></p>
		</fieldset>

		<fieldset><legend>Your Location:</legend>
			<p><label for="address1">Address 1:</label>
			<input type="text" id="address1" name="address1" maxlength="255" size="30" /></p>

			<p><label for="address2">Address 2:</label>
			<input type="text" id="address2" name="address2" maxlength="255" size="30" /></p>

			<p><label class="no-float" for="city">City:</label>
			<input type="text" id="city" name="city" maxlength="255" size="30" />

			<label class="no-float" for="state">State:</label>
			<input type="text" id="state" name="state" maxlength="255" size="2" />

			<label class="no-float" for="zip">Zip Code:</label>
			<input type="text" id="zip" name="zip" maxlength="255" size="10" /></p>
		</fieldset>
				
		<fieldset><legend>Guest Information:</legend>
			<p><label><input type="checkbox" class="required" id="house_more_ind" name="house_more_ind" />  Can you house more guests?</label></p>

			<p><label for="how_many" class="required">How many more guests could you house?:</label>
			<input type="text" class="required" id="how_many" name="how_many" maxlength="255" size="2" /></p>

			<p><label for="guest_names" class="required">If already housing guests, can you give us their name(s)?</label>
			<input type="text" class="required" id="guest_names" name="guest_names" maxlength="255" size="97" /></p>

			<p><label><input type="checkbox" id="pets_ind" name="pets_ind" />  Pets?</label>

			<label for="pets_info">How many?  What kind?:</label>
			<input type="text" id="pets_info" name="pets_info" maxlength="255" size="59" /></p>
		</fieldset>
				
		<fieldset><legend>Transportation Needs:</legend>
			<p><label><input type="checkbox" id="air_trans_ind" name="air_trans_ind" />  Can you give a ride to/from the airport?</label>
			<label><input type="checkbox" id="act_trans_ind" name="act_trans_ind" />  Can you give a ride to/from the activities?</label></p>
		</fieldset>

		<fieldset><legend>Preferences:</legend>
			<p><label><input type="checkbox" id="couples_ind" name="couples_ind" />&nbsp;Couples&nbsp;&nbsp;</label>
			<label><input type="checkbox" id="singles_ind" name="singles_ind" />&nbsp;Singles&nbsp;&nbsp;</label>
			<label><input type="checkbox" id="girls_ind" name="girls_ind" />&nbsp;Girls&nbsp;&nbsp;</label>
			<label><input type="checkbox" id="boys_ind" name="boys_ind" />&nbsp;Boys&nbsp;&nbsp;</label>
			<label><input type="checkbox" id="adults_ind" name="adults_ind" />&nbsp;Adults Only&nbsp;&nbsp;</label>
			<label><input type="checkbox" id="babies_ind" name="babies_ind" />&nbsp;Babies&nbsp;&nbsp;</label>
			<label><input type="checkbox" id="teens_ind" name="teens_ind" />&nbsp;Teens&nbsp;&nbsp;</label></p>

			<p><label for="other">Other:</label>
			<input type="text" id="other" name="other" maxlength="255" size="66" /></p>
		</fieldset>

		<hr />
		<br />
		<input type="submit" value="Submit" />
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

		jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
			phone_number = phone_number.replace(/\s+/g, ""); 
			return this.optional(element) || phone_number.length > 9 &&
				phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
		}, "Please specify a valid phone number");

		$('#reg-housing').validate({
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
				house_more_ind: {
					required: function(element) {
						if ($("#how_many").val == "")
							return true;
						else
							return false;
					}
				},
				how_many: {
					required: function(element) {
						if ($("#house_more_ind:checked").length > 0)
							return true;
						else
							return false;
					},
					number: true
				},
				guest_names: {
					required: function(element) {
						if ($("#house_more_ind:checked").length == 0)
							return true;
						else
							return false;
					}
				}
			},
			messages: {
				house_more_ind: "Please tell us if you're already housing.",
				how_many: "This field is required if you said you can house more.",
				guest_names: "This field is required if you're already housing guests." 
			}
		});
	</script>
	
</body>
</html>