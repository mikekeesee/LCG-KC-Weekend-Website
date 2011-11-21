<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend: Fun-Show Sign-Up</title>

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
		<form id="fun-show-signup" action="activity-fun-show-list.php" method="post" onsubmit="Verify();">

			<fieldset><legend>Performers:</legend>
				<script type="text/javascript" src="js/grid-reg-person-multiselect.js"></script>
				<table id="reg-person-multiselect"></table>
				<input type="hidden" id="gridPerson" name="gridPerson" />				
			</fieldset>

			<fieldset><legend>Act Info:</legend>
				<p><label for="txtActType" class="required">Type of Act (singing, dancing, skit, etc.):</label>
				<input type="text" id="txtActType" name="txtActType" maxlength="255" size="50" /></p>

				<p><label for="txtActTitle" class="required">Your act's title:</label>
				<input type="text" id="txtActTitle" name="txtActTitle" maxlength="255" size="50" /></p>

				<p><label for="txtLength" class="required">Approximate length of the act (please keep them less than 3-4 minutes):</label>
				<input type="text" id="txtLength" name="txtLength" maxlength="20" size="10" /></p>
				
				<br />
				
				<p><label for="txtActDescription" class="required">Enter a description of your act:</label></p>
				<p><textarea id="txtActDescription" name="txtActDescription" rows="3" cols="110"></textarea></p>				
			</fieldset>
			
			<fieldset><legend>Technical Information:</legend>				
				<p><label for="txtAudioNeeds">Enter your audio needs (number of mics, hook-ups, etc.):</label>
				<input type="text" id="txtAudioNeeds" name="txtAudioNeeds" maxlength="255" size="50" /></p>

				<p><label for="txtCDTrack">CD and Track Number:</label>
				<input type="text" id="txtCDTrack" name="txtCDTrack" maxlength="255" size="50" /></p>

				<p><label for="txtProps">Will you be using any props? (tables, chairs, rodeo clowns, etc.):</label>
				<input type="text" id="txtProps" name="txtProps" maxlength="20" size="10" /></p>
			</fieldset>			
			
			<fieldset><legend>Applicant Information:</legend>
				<p><label for="txtYearsExperience">Years of Experience:</label>
				<input type="text" id="txtYearsExperience" name="txtYearsExperience" maxlength="2" size="2" /></p>

				<p><label for="txtChurchArea">Your Local Church Area:</label>
				<input type="text" id="txtChurchArea" name="txtChurchArea" maxlength="255" size="50" /></p>

				<p><label for="txtAnythingElse">Anything else you'd like us to know (age, etc.):</label>
				<input type="text" id="txtAnythingElse" name="txtAnythingElse" maxlength="255" size="50" /></p>				
			</fieldset>
			
			<fieldset><legend>Upload File:</legend>				
				<iframe id="upload_target" name="upload_target" src="activity-fun-show-file-retriever.php" style="width:52em;height:8em;border:0px solid #fff;" frameBorder="0"></iframe>
				
				<input type="hidden" id="hidFilename" name="hidFilename" />
			</fieldset>
			
			<input type="submit" value="Submit" />

		</form>


	</div>

	<!-- End of Main Content Area -->

	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>

	<script type="text/javascript">
		$(document).ready(function() {
			$("input:submit").button();
		});

		function getSelectedItems(objGrid) {
			var strRtnValue = "";
			var arrData = objGrid.getGridParam('selarrrow');
			if (arrData.length > 0) {
				for (var i = 0; i < arrData.length; i++) {
					strRtnValue += (arrData[i] + ",");
				}

				// Now strip out the trailing comma
				if (strRtnValue != "") {
					strRtnValue = strRtnValue.substr(0, strRtnValue.length - 1);
				}
			} else {
				var selRow = objGrid.getGridParam('selrow');
				if (selRow == null) {
					return "";
				}

				strRtnValue = selRow;
			}

			return strRtnValue;
		}

		function Verify() {
			var person_id = getSelectedItems($("#reg-person-multiselect"));
			if (person_id == "") { 
				alert("Please choose at least one performer.");
				return false;
			}
			document.getElementById("gridPerson").value = person_id;
		}
		
		$('#fun-show-signup').validate({
			rules: {
				txtActType: {
					required: true
				},
				txtActTitle: {
					required: true
				}
			}
		});		
	</script>
</body>
</html>