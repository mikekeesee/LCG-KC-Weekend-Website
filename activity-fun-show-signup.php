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

		<h2>Fun Show Sign-Up</h2>

		<p>Please fill out all the fields below. Click the names of those performing from the registry list. 
		If you don't know exactly what you'll be performing yet, that's fine; fill out what you know so far.
		If you have accompaniment, lyrics, a script for skits or anything that will better help our organizers
		with planning, please upload them here. We'll send you a special, <em>secret</em> (not really) link
		where you can update your performance information or upload a file later, if you so choose.</p>

		<!-- The Registration Form for Main Contact Information -->
		<form id="fun-show-signup" action="activity-fun-show-list.php" method="post">

			<fieldset><legend>Performers:</legend>
				<script type="text/javascript" src="js/grid-reg-person-multiselect.js"></script>
				<table id="reg-person-multiselect"></table>
			</fieldset>

			<fieldset><legend>Act Info:</legend>
				<p><label for="txtActTitle" class="required">Your act's title:</label>
				<input type="text" id="txtActTitle" name="txtActTitle" maxlength="255" size="50" /></p>

				<p><label for="txtActDescription" class="required">Enter a description of your act:</label></p>
				<p><textarea id="txtActDescription" name="txtActDescription" rows="3" cols="80"></textarea></p>				

				<p><label for="txtStageNeeds">Enter your stage needs (piano, number of mics, chairs, rodeo clowns, etc.):</label></p>
				<p><textarea id="txtStageNeeds" name="txtStageNeeds" rows="3" cols="80"></textarea></p>

				<input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
				
				<form enctype="multipart/form-data" action="file-uploader.php" method="POST">
					<p><label for="txtActFile">File for your act (accompaniment, lyrics, script, etc.):</label>
					<input type="file" id="fileActData" name="fileActData" /><em>&nbsp;(If you have multiple files, put them in a ZIP file.)</em></p>
					<p><input type="submit" value="Upload File" /></p>
				</form>
			</fieldset>			
					
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
