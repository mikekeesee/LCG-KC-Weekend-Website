<?
	// **********************************************
	// *       Registration Submission Page         *
	// **********************************************

	// Get the database connection information
	include("db-connect.php");

	mysql_connect(localhost,$username,$password) or die("Unable to connect to database");
	mysql_select_db($database) or die("Unable to select database");

	$mc_person_id = $_COOKIE["mc_person_id"];
	$num_in_party = $_COOKIE["num_in_party"];
	$housing_type = $_COOKIE["housing_type"];


	// Housing contact info
	$housing_can_house		= $_POST["chkHousing"]=="on"?1:0;
	$housing_address1		= $_POST["address1"];
	$housing_address2		= $_POST["address2"];
	$housing_city			= $_POST["city"];
	$housing_state			= $_POST["state"];
	$housing_zip			= $_POST["zip"];
	$housing_how_many		= $_POST["how_many"];
	$housing_house_more_ind	= $_POST["house_more_ind"]=="on"?1:0;
	$guest_names			= $_POST["guest_names"];
	$housing_pets_ind		= $_POST["pets_ind"]=="on"?1:0;
	$housing_pets_info		= $_POST["pets_info"];
	$housing_air_trans		= $_POST["air_trans_ind"]=="on"?1:0;
	$housing_act_trans		= $_POST["act_trans_ind"]=="on"?1:0;
	$housing_couples_ind	= $_POST["couples_ind"]=="on"?1:0;
	$housing_singles_ind	= $_POST["singles_ind"]=="on"?1:0;
	$housing_girls_ind		= $_POST["girls_ind"]=="on"?1:0;
	$housing_boys_ind		= $_POST["boys_ind"]=="on"?1:0;
	$housing_adults_ind		= $_POST["adults_ind"]=="on"?1:0;
	$housing_babies_ind		= $_POST["babies_ind"]=="on"?1:0;
	$housing_teens_ind		= $_POST["teens_ind"]=="on"?1:0;
	$housing_other			= $_POST["other"];

	if ($housing_how_many == '') $housing_how_many = '0';

	// Fill out the Housing information
	if ($housing_can_house == 1) {

		// Check to see if housing was already set up for this person.
		$SQL = "SELECT COUNT(*) as count
				FROM Housing_Contact
				WHERE Person_ID = ".$mc_person_id;

		$result = mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute SELECT housing contract count query.".mysql_error()); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$count = $row['count'];

		if ($count > 0) {

			// Get the housing ID for the person
			$SQL = "SELECT housing_id
					FROM Housing_Contact
					WHERE Person_ID = ".$mc_person_id;

			$result = mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute SELECT housing contract query.".mysql_error()); //"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT housing contract query.".mysql_error());
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			$housing_id = $row['housing_id'];

			// Update their housing information
			$SQL = "UPDATE	Housing_Contact
					SET		Address1 = '".$housing_address1."',
							Address2 = '".$housing_address2."',
							City = '".$housing_city."',
							State = '".$housing_state."',
							Zip = '".$housing_zip."',
							How_Many = ".$housing_how_many.",
							House_More_Ind = ".$housing_house_more_ind.",
							Guest_Names = '".$guest_names."',
							Pets_Ind = ".$housing_pets_ind.",
							Pets_Info = '".$housing_pets_info."',
							Airport_Transportation_Ind = ".$housing_air_trans.",
							Activity_Transportation_Ind = ".$housing_act_trans.",
							Couples_Ind = ".$housing_couples_ind.",
							Singles_Ind = ".$housing_singles_ind.",
							Girls_Ind = ".$housing_girls_ind.",
							Boys_Ind = ".$housing_boys_ind.",
							Adults_Only_Ind = ".$housing_adults_ind.",
							Babies_Ind = ".$housing_babies_ind.",
							Teens_Ind = ".$housing_teens_ind.",
							Other = '".$housing_other."'
					WHERE	Housing_ID = ".$housing_id;

			mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute SELECT family person query.".mysql_error());//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //

		} else {

			// Insert the new housing information
			$SQL = "INSERT INTO Housing_Contact (
						Housing_ID,
						Person_ID,
						Address1,
						Address2,
						City,
						State,
						Zip,
						How_Many,
						House_More_Ind,
						Guest_Names,
						Pets_Ind,
						Pets_Info,
						Airport_Transportation_Ind,
						Activity_Transportation_Ind,
						Couples_Ind,
						Singles_Ind,
						Girls_Ind,
						Boys_Ind,
						Adults_Only_Ind,
						Babies_Ind,
						Teens_Ind,
						Other)
					VALUES (
						NULL,
						".$mc_person_id.",
						'".$housing_address1."',
						'".$housing_address2."',
						'".$housing_city."',
						'".$housing_state."',
						'".$housing_zip."',
						".$housing_how_many.",
						".$housing_house_more_ind.",
						'".$guest_names."',
						".$housing_pets_ind.",
						'".$housing_pets_info."',
						".$housing_air_trans.",
						".$housing_act_trans.",
						".$housing_couples_ind.",
						".$housing_singles_ind.",
						".$housing_girls_ind.",
						".$housing_boys_ind.",
						".$housing_adults_ind.",
						".$housing_babies_ind.",
						".$housing_teens_ind.",
						'".$housing_other."')";

			mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute INSERT Housing_Contact query.".mysql_error());//"Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //
		}
	}
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

		<h2 class="standout">Registration</h2>

		<br/>

		<h3>Submission Confirmed:</h3>
		<br/>
		<p>You have successfully registered! You deserve something nice... Perhaps a night on the town,
		a trip to your favorite store, or even... dare I say, a long weekend break where a ton of people
		will be gathered together to have a great time eating, dancing, learning and playing together.  We'll
		see you soon!</p>

		<p>We do ask that you would quickly send in the <b>registration fee</b> of <b>$5 per person</b> in your
		group or <b>$25 per family</b>, whichever is lowest.  Please make checks payable to <u>Local Church Activity
		Fund</u>.  Please send all checks to:
		<p style="margin:20px"><b>
			John Wells<br/>
			2329 Lake Breeze Ln.<br/>
			Lee's Summit, MO 64086
		</b></p>

		<p>Please click on <a href="housing.php">Housing</a> to get more information about our hotel
		arrangement or the contact number of our wonderful and lovely Housing Coordinator, Beryl Wilson.</p>

		<p>Click on <a href="activity-main.php">Activities</a> to sign up for an activity.</p>

		<p>Or click on <a href="reg-main.php">Registration</a> to see if your name is now on the list.
		Go ahead, Mike worked really hard to make this automated...  :)</p>


		<br />

		<p>If you forgot anything, click Back and fix whatever you need.</p>
		<br/><hr/><br/>
		<? if ($housing_type != 8 && $num_in_party == 1) { ?>
			<input type="button" value="< Back" onclick="history.go(-3);" />
		<? } else if ($housing_type != 8) { ?>
			<input type="button" value="< Back" onclick="history.go(-2);" />
		<? } else { ?>
			<input type="button" value="< Back" onclick="history.go(-1);" />
		<? } ?>

		<br /><br /><br />

	</div>

	<!-- End of Main Content Area -->

	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>

</body>
</html>

<?
	mysql_close();
?>
