<?
	// **********************************************
	// *     Registration Admin Submission Page     *
	// **********************************************

	// Get the database connection information
	include("db-connect.php");

	mysql_connect(localhost,$username,$password) or die("Unable to connect to database");
	mysql_select_db($database) or die("Unable to select database");

	$person_id = $_GET["id"];
	
	$reg_id = 0;
	$SQL = "SELECT	registration_id,
                    number_in_party,
					housing_type
			FROM	Registration
			WHERE	Main_Contact_Person_Id = ".$person_id;

	$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration SELECT query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$reg_id = $row['registration_id'];
    $num_in_party = $row['number_in_party'];
	$housing_type = $row['housing_type'];
	
	if ($reg_id == 0) {
		$SQL = "SELECT	registration_id
				FROM	Registration_Person
				WHERE	Person_Id = ".$person_id;

		$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration SELECT query.".mysql_error());
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$reg_id = $row['registration_id'];
		$person_id = $row['main_contact_person_id'];

		$SQL = "SELECT	main_contact_person_id,
                        number_in_party,
						housing_type
				FROM	Registration
				WHERE	Registration_Id = ".$reg_id;

		$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration SELECT query.".mysql_error());
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$person_id = $row['main_contact_person_id'];
        $num_in_party = $row['number_in_party'];
		$housing_type = $row['housing_type'];
	}

	$SQL = "SELECT	First_Name,
					Last_Name
			FROM	Person
			WHERE	Person_ID = ".$person_id;
	
	$result = mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute Registration SELECT count query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$person_name = $row["First_Name"]." ".$row["Last_Name"];
?>

<!DOCTYPE html>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Registration Administration</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="js/reveal/reveal.css" type="text/css" media="screen" />
	
	<? include "jqgrid-header.php" ?>
	<script src="js/show-hide.js" type="text/javascript"></script>
	<script src="js/jquery.validate.min.js" type="text/javascript"></script>
	<script src="js/reveal/jquery.reveal.js" type="text/javascript"></script>
<? if ($housing_type == 8) { ?>
	<script type="text/javascript" src="js/grid-reg-whos-not-housed.js"></script>
<? } else if ($housing_type == 9) { ?>
	<script type="text/javascript" src="js/grid-reg-housing.js"></script>
<? } ?>
 
	<? include ('google-analytics.php'); ?>
</head>

<body>

<?	include "header.php"; ?>

	<!-- Start of Main Content Area -->

	<div class="main-content">

		<h2><?= $person_name ?>&#39;s Registration Information</h2>

        <form id="reg-contact">
		<fieldset class="split"><legend>Main Contact Info:</legend>
			<p><label for="txtFirstName" class="required select-first">First Name:</label>
			<input type="text" id="txtFirstName" name="txtFirstName" maxlength="255" size="30" /></p>

			<p><label for="txtLastName" class="required">Last Name:</label>
			<input type="text" id="txtLastName" name="txtLastName" maxlength="255" size="30" />
			<a href="#" id="delete-registration"><img src="images/delete-person.png" alt="Delete Registration" class="action-icon" /></a></p>

			<p><label for="txtEmail" class="required">Email:</label>
			<input type="text" id="txtEmail" name="txtEmail" maxlength="255" size="30" placeholder="user@domain.com" />

			<p><label for="txtPhone" class="required">Phone:</label>
			<input type="text" id="txtPhone" name="txtPhone" maxlength="255" size="30" placeholder="XXX-XXX-XXXX"/></p>

			<div class="show-hide">
					<p><label for="cboAgeRange" class="required">Demographic:</label>
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

					<p><label for="cboHousingType" class="required">Housing Option:</label>
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
						<p><label for="txtHousedBy" class="required indent">Housed By:</label>
						<input type="text" id="txtHousedBy" name="txtHousedBy" maxlength="255" size="30" /></p>
					</div>
					
					<p><label for="txtHomeCity">Home City:</label>
					<input type="text" id="txtHomeCity" name="txtHomeCity" maxlength="255" size="30" placeholder="City, State" /></p>

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
			</div>
			<br/>
			<br/>

            <input type="hidden" id="hidNumInParty" value="<?=$num_in_party?>" />
			<input type="button" id="main-contact-submit" value="Update" />
		</fieldset>
        </form>

<?  if ($num_in_party > 1) { ?>
		<form id="reg-family">
            <fieldset><legend>Family Information</legend>
<?     for($i = 1; $i < $num_in_party; $i++) { ?>
                    <input type="hidden" id="hidPersonId<?=$i?>" name="hidPersonId<?=$i?>" />

				    <p><label for="txtFirstName<?=$i?>" class="required">First Name:</label>
				    <input type="text" id="txtFirstName<?=$i?>" name="txtFirstName<?=$i?>" maxlength="255" size="30" /></p>

				    <p><label for="txtLastName<?=$i?>" class="required">Last Name:</label>
				    <input type="text" id="txtLastName<?=$i?>" name="txtLastName<?=$i?>" maxlength="255" size="30" />
                    <a href="#" id="delete-person<?=$i?>"><img src="images/delete-person.png" alt="Delete Person" class="action-icon" /></a></p>

				    <p><label for="txtEmail<?=$i?>" class="required">Email (if different):</label>
				    <input type="text" id="txtEmail<?=$i?>" name="txtEmail<?=$i?>" maxlength="255" size="30" placeholder="user@domain.com" /></p>

				    <p><label for="txtPhone<?=$i?>" class="required">Phone (if different):</label>
				    <input type="text" id="txtPhone<?=$i?>" name="txtPhone<?=$i?>" maxlength="255" size="30" placeholder="XXX-XXX-XXXX" /></p>
<?            if ($i == 1) { ?>
                <div class="show-hide">
<?          } ?>
				<p><label for="cboAgeRange<?=$i?>" class="required">Description That Fits Best:</label>
				<select id="cboAgeRange<?=$i?>" name="cboAgeRange<?=$i?>">
					<option value="0" selected>--Please Select--</option>
<?
		// Get the database connection information
		$SQL = "	SELECT	string_id,
							string
					FROM String_Base
					WHERE string_grouping = 1";

		$result = mysql_query( $SQL ) or die("</select><br/>Couldn't execute query.".mysql_error());

		    while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			    echo "\t\t\t\t\t<option value='".$row[string_id]."'>".$row[string]."</option>\n";
		    }
?>
			    </select></p>
                <br />				
<?
	    }
?>
                </div>

                <br />				
		        <br />
		        <input type="button" id="family-submit" value="Update" />
            </fieldset>
        </form>
<?  } ?>

		<div class="clear-float"></div>

<? if ($housing_type == 8) { ?>
		<form id="reg-hosts">
		<fieldset><legend>Housing Info:</legend>
			<p><label>Confirmed Guests: </label><label id="confirmed_guests">None</label>
			<br/><a href="#" data-reveal-id="add-guest-modal">Add Guests</a></p>
			
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

			<p><label><input type="checkbox" class="required" id="house_more_ind" name="house_more_ind" />  Can you house more guests?</label></p>

			<p><label for="how_many" class="required">How many more guests could you house?:</label>
			<input type="text" id="how_many" name="how_many" maxlength="255" size="2" /></p>

			<p><label for="guest_names" class="required">If already housing guests, can you give us their name(s)?</label>
			<input type="text" id="guest_names" name="guest_names" maxlength="255" size="97" placeholder="The Merediths, etc." /></p>

			<p><label><input type="checkbox" id="pets_ind" name="pets_ind" />  Pets?</label>

			<label for="pets_info">How many?  What kind?:</label>
			<input type="text" id="pets_info" name="pets_info" maxlength="255" size="59" placeholder="4 Llamas, 2 platypi, etc."/></p>

			<p><label><input type="checkbox" id="air_trans_ind" name="air_trans_ind" />  Can you give a ride to/from the airport?</label>
			<label><input type="checkbox" id="act_trans_ind" name="act_trans_ind" />  Can you give a ride to/from the activities?</label></p>

			<p><label><input type="checkbox" id="couples_ind" name="couples_ind" />&nbsp;Couples&nbsp;&nbsp;</label>
			<label><input type="checkbox" id="singles_ind" name="singles_ind" />&nbsp;Singles&nbsp;&nbsp;</label>
			<label><input type="checkbox" id="girls_ind" name="girls_ind" />&nbsp;Girls&nbsp;&nbsp;</label>
			<label><input type="checkbox" id="boys_ind" name="boys_ind" />&nbsp;Boys&nbsp;&nbsp;</label>
			<label><input type="checkbox" id="adults_ind" name="adults_ind" />&nbsp;Adults Only&nbsp;&nbsp;</label>
			<label><input type="checkbox" id="babies_ind" name="babies_ind" />&nbsp;Babies&nbsp;&nbsp;</label>
			<label><input type="checkbox" id="teens_ind" name="teens_ind" />&nbsp;Teens&nbsp;&nbsp;</label></p>

			<p><label for="other">Other:</label>
			<input type="text" id="other" name="other" maxlength="255" size="66" placeholder="2 beds, floorspace only, etc." /></p>

			<br/>
			<br/>

			<input type="button" id="housing-submit" value="Update" />
		</fieldset>
        </form>
		
		<div id="add-guest-modal" class="reveal-modal">
			<h2>Add Guests</h2>
			<p>Click a row with the guest to house and click Add.</p>
			
			<table id="reg-whos-not-housed"></table>

			<input type="button" id="add-guest-submit" value="Add" />
			
			<a class="close-reveal-modal" id="close-add-guests">&#215;</a>
		</div>

	
<? } else if ($housing_type == 9 || $housing_type == 10) { ?>
		<form id="reg-hosts">
		<fieldset><legend>Housing Info:</legend>
			<p><label>Host: </label><label id="confirmed_hosts">None</label>
<? 		if ($housing_type == 9) { ?>
			<p><a href="#" id="open-host-modal" data-reveal-id="add-host-modal">Assign Housing</a></p>
<?		} ?>
		</fieldset>
        </form>

<? 		if ($housing_type == 9) { ?>
		<div id="add-host-modal" class="reveal-modal">
			<h2>Pick a Host:</h2>
			<p>Click the row of the host with the most and click Add.</p>
			
			<table id="reg-housing"></table>

			<input type="button" id="add-host-submit" value="Add" />
			
			<a class="close-reveal-modal" id="close-add-hosts">&#215;</a>
		</div>
<?		}		
   } ?>

	</div>
	
	<!-- End of Main Content Area -->

	<!-- Start of Page Footer -->

	<? include "footer.php" ?>

	<script type="text/javascript">
		$(document).ready(function() {
			$("input[type=button]").button();
			
			// Fill out data first
			var fillOutMainContact = function(data) {
				$("#txtFirstName").val(data.firstName);
				$("#txtLastName").val(data.lastName);
				$("#txtPhone").val(data.phone);
				$("#txtEmail").val(data.email);
				$("#cboAgeRange").val(data.ageRange);
				$("#cboHousingType").val(data.housingType);
				$("#txtHousedBy").val(data.housedBy);
				$("#txtHomeCity").val(data.homeCity);
				$("#cboDining").val(data.dining);				
			};
			
			var fillOutFamily = function(data) {
                var numInParty = $("#hidNumInParty").val();

				// Closure for saving the person ID selected in the array
				function createClickFunction(id){
					return function(){deletePerson(id)};
				}

                for (var i = 0; i < (numInParty - 1); i++) {
                    $("#hidPersonId" + (i+1)).val(data[i].personId);
				    $("#txtFirstName" + (i+1)).val(data[i].firstName);
				    $("#txtLastName" + (i+1)).val(data[i].lastName);
				    $("#txtPhone" + (i+1)).val(data[i].phone);
				    $("#txtEmail" + (i+1)).val(data[i].email);
				    $("#cboAgeRange" + (i+1)).val(data[i].ageRange);
                    $("#delete-person" + (i+1)).click(createClickFunction(data[i].personId));
                }	
			};

			$("#delete-registration").click(function() {
				if (confirm("Are you sure you want to delete the entire registration?")) {
					var numInParty = $("#hidNumInParty").val();
					for (var i = 0; i < (numInParty - 1); i++) {
						var pid = $("#hidPersonId" + (i+1)).val();

						$.ajax({
							url:"db-delete-person.php", 
							async: false, 
							type: "get", 
							data: {person_id: pid,
								   reg_id: <?=$reg_id?>},
							success: function() {},
							error: function(xhr, text, e) {alert("Error deleting person - " + text); return;}
						});						
					}
						
					$.ajax({
						url:"db-delete-person.php", 
						async: false, 
						type: "get", 
						data: {person_id: <?=$person_id?>,
							   reg_id: <?=$reg_id?>},
						success: function() {},
						error: function(xhr, text, e) {alert("Error deleting person - " + text); return;}
					});						

					$.ajax({
				        url:"db-delete-registration.php", 
				        async: false, 
				        type: "get", 
				        data: {person_id: <?=$person_id?>,
                               reg_id: <?=$reg_id?>},
				        success: function() {},
				        error: function(xhr, text, e) {alert("Error deleting registration  - " + text); return;}
                    });
					
					setTimeout('window.close()', 1000)
					return;
				}
			});
			
            var deletePerson = function(id) {
                //alert(id);
                if (confirm("Are you sure you want to delete this person?")) {
                    $.ajax({
				        url:"db-delete-person.php", 
				        async: false, 
				        type: "get", 
				        data: {person_id: id,
                               reg_id: <?=$reg_id?>},
				        success: function() {location.reload();},
				        error: function(xhr, text, e) {alert("Error deleting person - " + text); return;}
                    });
                }
            };

			var fillOutHousing = function(data) {
				$("#address1").val(data.address1);
				$("#address2").val(data.address2);
				$("#city").val(data.city);
				$("#state").val(data.state);
				$("#zip").val(data.zip);
				$("#how_many").val(data.howMany);
				$("#house_more_ind").attr("checked", data.houseMore==1?true:false);
				$("#guest_names").val(data.guestNames);
				$("#pets_ind").attr("checked", data.petsInd==1?true:false);				
				$("#pets_info").val(data.petsInfo);				
				$("#air_trans_ind").attr("checked", data.airportTransportationInd==1?true:false);
				$("#act_trans_ind").attr("checked", data.activityTransportationInd==1?true:false);
				$("#couples_ind").attr("checked", data.couples==1?true:false);
				$("#singles_ind").attr("checked", data.singles==1?true:false);
				$("#girls_ind").attr("checked", data.girls==1?true:false);
				$("#boys_ind").attr("checked", data.boys==1?true:false);
				$("#adults_ind").attr("checked", data.adults==1?true:false);
				$("#babies_ind").attr("checked", data.babies==1?true:false);
				$("#teens_ind").attr("checked", data.teens==1?true:false);
				$("#other").val(data.other);
				if (data.confirmedGuests.length > 0) {
					$("#confirmed_guests").text(data.confirmedGuests);
				} else {
					$("#confirmed_guests").text("None");
				}
			};
			
			var fillOutHosts = function(data) {
				if (data.confirmedHosts.length > 0) {
					$("#confirmed_hosts").text(data.confirmedHosts);
					if (document.getElementById("open-host-modal") != null) {
						$("#open-host-modal").hide();
					}
				} else {
					$("#confirmed_hosts").text("None");
				}
			};

			$.ajax({
				url:"db-update-main-contact.php", 
				async: true, 
				type: "get", 
				data: {person_id: <?=$person_id?>,
					   reg_id: <?=$reg_id?>}, 
				success: fillOutMainContact,
				error: function(xhr, text, e) {alert("Error filling out Main Contact data - " + text)}
			});

			$.ajax({
				url:"db-update-family.php",
				async: true,
				type: "get",
				data: {reg_id: <?=$reg_id?>,
                       num_in_party: $("#hidNumInParty").val()}, 
				success: fillOutFamily,
				error: function(xhr, text, e) {alert("Error filling out Family data - " + text)}
			});

			var updateHousing = function() {
				$.ajax({
					url:"db-update-housing.php", 
					async: true, 
					type: "get", 
					data: {person_id: <?=$person_id?>,
						   reg_id: <?=$reg_id?>}, 
					success: fillOutHousing,
					error: function(xhr, text, e) {alert("Error filling out Housing data - " + text)}
				});
			};
			
			updateHousing();

			var updateHosts = function() {
				$.ajax({
					url:"db-update-guest-housing.php", 
					async: true, 
					type: "get", 
					data: {person_id: <?=$person_id?>,
						   reg_id: <?=$reg_id?>}, 
					success: fillOutHosts,
					error: function(xhr, text, e) {alert("Error filling out Housing data - " + text)}
				});
			};
			
			updateHosts();
				
			$("#main-contact-submit").click(function() {
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
        
                var reqMC = {};
				reqMC.person_id = <?=$person_id?>;
                reqMC.reg_id = <?=$reg_id?>;
				reqMC.txtFirstName = $("#txtFirstName").val();
				reqMC.txtLastName = $("#txtLastName").val();
				reqMC.txtPhone = $("#txtPhone").val();
				reqMC.txtEmail = $("#txtEmail").val();
				reqMC.cboAgeRange = $("#cboAgeRange").val();
				reqMC.cboHousingType = $("#cboHousingType").val();
				reqMC.txtHousedBy = $("#txtHousedBy").val();
				reqMC.txtHomeCity = $("#txtHomeCity").val();
				reqMC.cboDining = $("#cboDining").val();
				
				var ajax_response = $.ajax({
					url:"db-update-main-contact.php", 
					async: true, 
					type: "get", 
					data: reqMC,
					dataType: "json",
					success: fillOutMainContact,
					error: function() {alert("Error filling out Main Contact data...")}
				});
			});

			$("#family-submit").click(function() {        
                var numInParty = $("#hidNumInParty").val();
                var reqFamily = {};
                var formData = "reg_id=<?=$reg_id?>";
                formData += "&num_in_party=" + $("#hidNumInParty").val();
                formData += "&" + $("#reg-family").serialize();

				var ajax_response = $.ajax({
					url:"db-update-family.php", 
					async: true, 
					type: "get",
					data: formData,
					dataType: "json",
					success: fillOutFamily,
					error: function(x,s,e) {alert("Error filling out Family data...")}
				});
			});

			$("#housing-submit").click(function() {
		        $('#reg-hosts').validate({
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

				var reqHousing = {};
				reqHousing.person_id = <?=$person_id?>;
				reqHousing.reg_id = <?=$reg_id?>;
				reqHousing.address1 = $("#address1").val();
				reqHousing.address2 = $("#address2").val();
				reqHousing.city = $("#city").val();
				reqHousing.state = $("#state").val();
				reqHousing.zip = $("#zip").val();
				reqHousing.how_many = $("#how_many").val();
				reqHousing.house_more_ind = ($("#house_more_ind").is(":checked")?"1":"0");
				reqHousing.guest_names = ($("#guest_names").val());
				reqHousing.pets_ind = ($("#pets_ind").is(":checked")?"1":"0");
				reqHousing.pets_info = $("#pets_info").val();
				reqHousing.air_trans_ind = ($("#air_trans_ind").is(":checked")?"1":"0");
				reqHousing.act_trans_ind = ($("#act_trans_ind").is(":checked")?"1":"0");
				reqHousing.couples_ind = ($("#couples_ind").is(":checked")?"1":"0");
				reqHousing.singles_ind = ($("#singles_ind").is(":checked")?"1":"0");
				reqHousing.girls_ind = ($("#girls_ind").is(":checked")?"1":"0");
				reqHousing.boys_ind = ($("#boys_ind").is(":checked")?"1":"0");
				reqHousing.adults_ind = ($("#adults_ind").is(":checked")?"1":"0");
				reqHousing.babies_ind = ($("#babies_ind").is(":checked")?"1":"0");
				reqHousing.teens_ind = ($("#teens_ind").is(":checked")?"1":"0");
				reqHousing.other = $("#other").val();

				var ajax_response = $.ajax({
					url:"db-update-housing.php", 
					async: true, 
					type: "get", 
					data: reqHousing,
					dataType: "json",
					success: fillOutHousing,
					error: function() {alert("Error filling out Housing data...")}
				});
			});

			function getSelectedId(objGrid) {
				var selRow = objGrid.getGridParam('selrow');
				if (selRow == null) {
					alert("Please select at least one row.")
					return false;
				}

				return selRow;
			}

			$("#add-guest-submit").click(function() {
				var guest_id = getSelectedId($("#reg-whos-not-housed"));
				if (guest_id == "") { return false; }

				var ajax_response = $.ajax({
					url:"db-update-guests.php", 
					async: true, 
					type: "get",
					data: {person_id: <?=$person_id?>,
						   reg_id: <?=$reg_id?>,
						   guest_reg_id: guest_id}, 
					dataType: "json",
					success: updateHousing,
					error: function(x,s,e) {alert("Error filling out Family data...")}
				});
				
				$("#close-add-guests").click();
				
			});

			$("#add-host-submit").click(function() {
				var housing_id = getSelectedId($("#reg-housing"));
				if (housing_id == "") { return false; }

				var ajax_response = $.ajax({
					url:"db-update-host.php", 
					async: true, 
					type: "get",
					data: {person_id: <?=$person_id?>,
						   reg_id: <?=$reg_id?>,
						   host_housing_id: housing_id,
						   num_in_party: $("#hidNumInParty").val()},
					dataType: "json",
					success: updateHosts,
					error: function(x,s,e) {alert("Error filling out Family data..." + e)}
				});
				
				$("#close-add-hosts").click();
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
			setTimeout(toggle, 1000);
		});
		
		jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
			phone_number = phone_number.replace(/\s+/g, ""); 
			return this.optional(element) || phone_number.length > 9 &&
				phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
		}, "Please specify a valid phone number");
		
	</script>
	
</body>
</html>

<? mysql_close(); ?>
