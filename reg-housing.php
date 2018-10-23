<?
	// Get the database connection information
	include("db-connect.php");

	header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

	$link = mysqli_connect(localhost, $username, $password, $database);

	// Get the POST data and write it to a cookie
	$num_in_party	= $_POST["hid_numInParty"];
	$housing_type	= $_POST["hid_housingType"];
	$mc_person_id	= $_POST["hid_MCPersonID"];
	$reg_id			= $_POST["hid_regID"];

	$expire = time() + (60*60*2);

	// Get each person's activities
	for ($i=0; $i < $num_in_party; $i++) {
		$fam_person_id[$i]		= $_POST["hid_personid".$i];
		
		// Re-Initialize the string for each time through the loop
		$activity_insert_str	 = "";
		
		// Build an insert string for each person's activity list
		$activity_insert_str	 = $_POST["chkFamilyGames".$i]=="on" ? "(".$fam_person_id[$i].",1)," : "";
		$activity_insert_str	.= $_POST["chkChildBball".$i]=="on" ? "(".$fam_person_id[$i].",2)," : "";
		$activity_insert_str	.= $_POST["chkTeenBball".$i]=="on" ? "(".$fam_person_id[$i].",3)," : "";
		$activity_insert_str	.= $_POST["chkVballClinic".$i]=="on" ? "(".$fam_person_id[$i].",4)," : "";
		$activity_insert_str	.= $_POST["chkBball".$i]=="on" ? "(".$fam_person_id[$i].",5)," : "";
		$activity_insert_str	.= $_POST["chkVball".$i]=="on" ? "(".$fam_person_id[$i].",6)," : "";
		$activity_insert_str	.= $_POST["chkGagaBall".$i]=="on" ? "(".$fam_person_id[$i].",7)," : "";
		
		// Get rid of the trailing comma
		$activity_insert_str = rtrim($activity_insert_str, ",");
				
		// If the activity's already registered
		if ($fam_person_id[$i] > 0) {
			if ($activity_insert_str > "") {
				$SQL = "SELECT	COUNT(*) as count
						FROM	Person_Activity
						WHERE	person_id = ".$fam_person_id[$i];

				$result = mysqli_query($link, $SQL) or die($SQL.mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute family activity SELECT count query.".mysqli_error($link));
				$row = mysqli_fetch_array($result);
				$count = $row['count'];

				// If there's any existing activities, clear them and re-insert
				if ($count > 0) {
					$SQL = "DELETE FROM	Person_Activity
							WHERE		person_id = ".$fam_person_id[$i];

					mysqli_query($link, $SQL) or die($SQL.mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute UPDATE family activity query.".mysqli_error($link));
				
				}

				$SQL = "INSERT INTO	Person_Activity
								(Person_ID,
								 Activity_ID)
						VALUES ".$activity_insert_str;

				mysqli_query($link, $SQL) or die($SQL.mysqli_error($link));//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT family activity query.".mysqli_error($link));
			}			
		}
	}
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Housing</title>

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
		<label for="chkHousing"><b><input type="checkbox" class="select-first" id="chkHousing" name="chkHousing" />&nbsp;If you plan to house people, check this box.</b></label>
		<br/>
		<br/>

		<div class="toggle">
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
				<input type="text" id="how_many" name="how_many" maxlength="255" size="2" /></p>

				<p><label for="guest_names" class="required">If already housing guests, can you give us their name(s)?</label>
				<input type="text" id="guest_names" name="guest_names" maxlength="255" size="97" placeholder="The Merediths, etc." /></p>

				<p><label><input type="checkbox" id="pets_ind" name="pets_ind" />  Pets?</label>

				<label for="pets_info">How many?  What kind?:</label>
				<input type="text" id="pets_info" name="pets_info" maxlength="255" size="59" placeholder="4 Llamas, 2 platypi, etc."/></p>
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
				<input type="text" id="other" name="other" maxlength="255" size="66" placeholder="2 beds, floorspace only, etc." /></p>
			</fieldset>
		</div>

		<hr />
		<br />

		<input type="button" value="< Back" onclick="history.go(-1);" />
		<input type="submit" value="Next >" />

		
		<input type="hidden" id="hid_numInParty" name="hid_numInParty" value="<?=$num_in_party?>">
		<input type="hidden" id="hid_housingType" name="hid_housingType" value="<?=$housing_type?>">
		<input type="hidden" id="hid_MCPersonID" name="hid_MCPersonID" value="<?=$mc_person_id?>">
		<input type="hidden" id="hid_regID" name="hid_regID" value="<?=$reg_id?>">
		
		</form>

	</div>
	</div>

	<div class="clearthis">&nbsp;</div>

	<!-- End of Main Content Area -->

	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>

	<script type="text/javascript">
		$(document).ready(function() {
		<? if ($housing_type == 8) { ?>
			if ($("#chkHousing:checked").length > 0) {
				$(".toggle").show("drop");
			}
			
			$(".select-first").focus();
			$("input:button").button();
			$("input:submit").button();
		<? } else { ?>
			document.getElementById("reg-housing").submit();
		<? } ?>
		});

		$('#chkHousing').click(function() {
			if ($("#chkHousing:checked").length > 0) {
				$(".toggle").show("drop", function() {
					if (navigator.appName == 'Microsoft Internet Explorer') {
						this.style.removeAttribute("filter");
					}
				});
			} else {
				$(".toggle").hide("puff");
			}
		});
	
		$('#reg-housing').validate({
			rules: {
				house_more_ind: {
					required: function(element) {
						if ($("#chkHousing:checked").length > 0 && $("#how_many").val == "")
							return true;
						else
							return false;
					},
				},
				how_many: {
					required: function(element) {
						if ($("#chkHousing:checked").length > 0 && $("#house_more_ind:checked").length > 0)
							return true;
						else
							return false;
					},
					number: true
				},
				guest_names: {
					required: function(element) {
						if ($("#chkHousing:checked").length > 0 && $("#house_more_ind:checked").length == 0)
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

<?
	mysqli_close($link);
?>