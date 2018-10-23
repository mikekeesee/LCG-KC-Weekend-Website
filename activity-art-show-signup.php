<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend: Art Show Sign-Up</title>

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

		<h2>Art Show Sign-Up</h2>

		<p>An Art Show? At the Kansas City Weekend?!? You bet! We want to see your talent put on display. Paintings,
		drawings, sculpture, tapestries, knitting, stitching... you name it. <b>Please bring any easel(s) or such 
		that you may have to display your artwork.</b></p>

		<p>We will not be judging the artwork as we want to truly appreciate the art rather than judge it. If you feel
		you are just an amateur or if you&#39;ve been doing this for years, we want to see your talent! Of course, since
		this is a church event, we ask for tasteful entries.</p>

		<p>Please fill out all the fields below. Click your name from the 
		registry list (if you don&#39;t see your name, be sure to register).</p>

		<!-- The Registration Form for Main Contact Information -->
		<form id="fun-show-signup" action="activity-art-show-list.php" method="post" onsubmit="Verify();">

			<fieldset><legend>Artist:</legend>
				<script type="text/javascript" src="js/grid-reg-person-multiselect.js"></script>
				<table id="reg-person-multiselect"></table>
				<input type="hidden" id="gridPerson" name="gridPerson" />				
			</fieldset>

			<fieldset><legend>Artwork Info:</legend>
				<p><label for="txtActType" class="required">Type of art:</label>
				<input type="text" id="txtActType" name="txtActType" maxlength="255" size="50" placeholder="Painting, sculpture, quilting, etc."/></p>

				<p><label for="txtActTitle" class="required">Your artwork&#39;s title:</label>
				<input type="text" id="txtActTitle" name="txtActTitle" maxlength="255" size="50" /></p>

				<!--<p><label for="txtLength" class="required">Approximate length of the act:</label>
				<input type="text" id="txtLength" name="txtLength" maxlength="20" size="10" placeholder="3-4 mins. max" /></p>-->
				
				<br />
				
				<p><label for="txtActDescription" class="required">Give us a description of or the inspiration for your artwork:</label></p>
				<p><textarea id="txtActDescription" name="txtActDescription" rows="3" cols="110"></textarea></p>				

				<p><label for="txtChurchArea">Your Local Church Area:</label>
				<input type="text" id="txtChurchArea" name="txtChurchArea" maxlength="255" size="50" /></p>

				<p><label for="txtAnythingElse">Anything else you'd like us to know?:</label>
				<input type="text" id="txtAnythingElse" name="txtAnythingElse" maxlength="255" size="50" placeholder="Age, etc."/></p>				
			</fieldset>
			
			<!--<fieldset><legend>Technical Information:</legend>				
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
			</fieldset>-->
			
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
				//txtLength: {
				//	required: true
				//},
				txtActDescription: {
					required: true
				},
				//txtAudioNeeds: {
				//	required: true
				//},
				//txtProps: {
				//	required: true
				//},
				//txtYearsExperience: {
				//	required: true
				//},
				txtChurchArea: {
					required: true
				}				
			}
		});		
	</script>
</body>
</html>