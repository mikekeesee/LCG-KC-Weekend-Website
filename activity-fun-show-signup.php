<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend: Fun-Show Sign-Up</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
	<? include "jqgrid-header.php" ?>
	<script src="js/jquery.validate.min.js" type="text/javascript"></script>
	<script src="js/jqgrid-helper.js" type="text/javascript"></script>
	<script src="js/input-placeholder.js" type="text/javascript"></script>
</head>

<body>

	<!-- Add the header to each page -->
	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->

	<div class="main-content">

		<h2>Fun Show Sign-Up</h2>

		<p>As of this moment, the &quot;fun show&quot; will be more in the form of after-dinner entertainment. It&#39;s possible we will have a themed show, but that has not been determined at this point.</p>

		<p>Our talent search is on, and we are now accepting applications. <em>The same dress code as the dance (casual) applies, since the dance and fun show will occur in the same building.</em></p>
		
		<p>Space is limited, so we do reserve the right to screen or decline applications. Please email <a href="mailto:davidandsarahmanning@hotmail.com">David and Sarah Manning</a> with any further questions.</p>

		<p>Please fill out all the fields below. Click <u>ALL</u> of the names of those performing from the 
		registry list (if they&#39;re not there, contact them and have them register). If you have accompaniment, lyrics, a script for skits
		or anything that will better help our organizers with planning, please upload them here.</p>

		<!-- The Registration Form for Main Contact Information -->
		<form id="fun-show-signup" action="activity-fun-show-list.php" method="post" onsubmit="Verify();">

			<fieldset><legend>Performers:</legend>
				<script type="text/javascript" src="js/grid-reg-person-multiselect.js"></script>
				<table id="reg-person-multiselect"></table>
				<input type="hidden" id="gridPerson" name="gridPerson" />				
			</fieldset>

			<fieldset><legend>Act Info:</legend>
				<p><label for="txtActType" class="required">Type of act and era:</label>
				<input type="text" id="txtActType" name="txtActType" maxlength="255" size="50" placeholder="Singing, instrumental, skit about cheese, etc."/></p>

				<p><label for="txtActTitle" class="required">Your act's title:</label>
				<input type="text" id="txtActTitle" name="txtActTitle" maxlength="255" size="50" /></p>

				<p><label for="txtLength" class="required">Approximate length of the act:</label>
				<input type="text" id="txtLength" name="txtLength" maxlength="20" size="10" placeholder="3-4 mins. max" /></p>
				
				<br />
				
				<p><label for="txtActDescription" class="required">Enter a description of your act:</label></p>
				<p><textarea id="txtActDescription" name="txtActDescription" rows="3" cols="110"></textarea></p>				
			</fieldset>
			
			<fieldset><legend>Technical Information:</legend>				
				<p><label for="txtAudioNeeds">Enter your audio needs:</label>
				<input type="text" id="txtAudioNeeds" name="txtAudioNeeds" maxlength="255" size="50" placeholder="Number of mics, hook-ups, etc."/></p>

				<p><label for="txtCDTrack">CD and track number:</label>
				<input type="text" id="txtCDTrack" name="txtCDTrack" maxlength="255" size="50" /></p>

				<p><label for="txtProps">Will you be using any props?:</label>
				<input type="text" id="txtProps" name="txtProps" maxlength="255" size="50" placeholder="Tables, chairs, rodeo clowns, etc."/></p>
			</fieldset>
			
			<fieldset><legend>Applicant Information:</legend>
				<p><label for="txtYearsExperience">Years of experience:</label>
				<input type="text" id="txtYearsExperience" name="txtYearsExperience" maxlength="2" size="2" /></p>

				<p><label for="txtChurchArea">Your Local Church Area:</label>
				<input type="text" id="txtChurchArea" name="txtChurchArea" maxlength="255" size="50" /></p>

				<p><label for="txtAnythingElse">Anything else you'd like us to know?:</label>
				<input type="text" id="txtAnythingElse" name="txtAnythingElse" maxlength="255" size="50" placeholder="Age, etc."/></p>				
			</fieldset>
			
			<fieldset><legend>Upload File:</legend>				
				<iframe id="upload_target" name="upload_target" src="activity-fun-show-file-retriever.php" style="width:52em;height:6.5em;border:0px solid #fff;" frameBorder="0"></iframe>
				
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
				},
				txtLength: {
					required: true
				},
				txtActDescription: {
					required: true
				},
				txtAudioNeeds: {
					required: true
				},
				txtProps: {
					required: true
				},
				txtYearsExperience: {
					required: true
				},
				txtChurchArea: {
					required: true
				}				
			}
		});		
	</script>
</body>
</html>