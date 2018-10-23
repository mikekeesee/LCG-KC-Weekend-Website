<?
	// **********************************************
	// *       Registration Submission Page         *
	// **********************************************

	// Get the database connection information
	include("db-connect.php");
    
	header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

	$link = mysqli_connect(localhost, $username, $password, $database);

	$num_in_party	= $_POST["hid_numInParty"];
	$housing_type	= $_POST["hid_housingType"];
	$mc_person_id	= $_POST["hid_MCPersonID"];
	$reg_id			= $_POST["hid_regID"];
	
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

        // Get the housing ID for the person
        $SQL = "SELECT housing_id
                FROM Housing_Contact
                WHERE Registration_ID = ".$reg_id;

		$result = mysqli_query($link, $SQL) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT housing contract count query.".mysqli_error($link));
		$count = mysqli_num_rows($result);

		if ($count > 0) {
			$row = mysqli_fetch_array($result);
			$housing_id = $row['housing_id'];

			// Update their housing information
			$SQL = "UPDATE	Housing_Contact
					SET		Address1 = '".mysqli_real_escape_string($link, $housing_address1)."',
							Address2 = '".mysqli_real_escape_string($link, $housing_address2)."',
							City = '".mysqli_real_escape_string($link, $housing_city)."',
							State = '".$housing_state."',
							Zip = '".$housing_zip."',
							How_Many = ".$housing_how_many.",
							House_More_Ind = ".$housing_house_more_ind.",
							Guest_Names = '".mysqli_real_escape_string($link, $guest_names)."',
							Pets_Ind = ".$housing_pets_ind.",
							Pets_Info = '".mysqli_real_escape_string($link, $housing_pets_info)."',
							Airport_Transportation_Ind = ".$housing_air_trans.",
							Activity_Transportation_Ind = ".$housing_act_trans.",
							Couples_Ind = ".$housing_couples_ind.",
							Singles_Ind = ".$housing_singles_ind.",
							Girls_Ind = ".$housing_girls_ind.",
							Boys_Ind = ".$housing_boys_ind.",
							Adults_Only_Ind = ".$housing_adults_ind.",
							Babies_Ind = ".$housing_babies_ind.",
							Teens_Ind = ".$housing_teens_ind.",
							Other = '".mysqli_real_escape_string($link, $housing_other)."'
					WHERE	Housing_ID = ".$housing_id;

			mysqli_query($link, $SQL) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT family person query.".mysqli_error($link));

		} else {

			// Insert the new housing information
			$SQL = "INSERT INTO Housing_Contact (
						Housing_ID,
						Registration_ID,
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
						".$reg_id.",
						'".mysqli_real_escape_string($link, $housing_address1)."',
						'".mysqli_real_escape_string($link, $housing_address2)."',
						'".mysqli_real_escape_string($link, $housing_city)."',
						'".$housing_state."',
						'".$housing_zip."',
						".$housing_how_many.",
						".$housing_house_more_ind.",
						'".mysqli_real_escape_string($link, $guest_names)."',
						".$housing_pets_ind.",
						'".mysqli_real_escape_string($link, $housing_pets_info)."',
						".$housing_air_trans.",
						".$housing_act_trans.",
						".$housing_couples_ind.",
						".$housing_singles_ind.",
						".$housing_girls_ind.",
						".$housing_boys_ind.",
						".$housing_adults_ind.",
						".$housing_babies_ind.",
						".$housing_teens_ind.",
						'".mysqli_real_escape_string($link, $housing_other)."')";

			mysqli_query($link, $SQL) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT Housing_Contact query.".mysqli_error($link));
		}
	}
	
	// Get the housing ID for the person
	$SQL = "SELECT dining_id
			FROM Registration
			WHERE Registration_ID = ".$reg_id;

	$result = mysqli_query($link, $SQL) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT housing contract query.".mysqli_error($link));
	$row = mysqli_fetch_array($result);
	$dining_id = $row['dining_id'];
	
	// Use for calculating dinner fees based on demographic
	/*$SQL = "SELECT COUNT(*) as count
			FROM Registration_Person rp
			INNER JOIN Person p
				ON p.Person_ID = rp.Person_ID
			WHERE rp.Registration_ID = $reg_id
			  AND p.Age_Range IN (3,4,5,6,7)";

	$result = mysqli_query($SQL) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT housing contract query.".mysqli_error($link));
	$row = mysqli_fetch_array($result);
	$adult_dining_cnt = $row['count'] + 1; // We're assuming the main contact person is a legal adult or teen.

	$SQL = "SELECT COUNT(*) as count
			FROM Registration_Person rp
			INNER JOIN Person p
				ON p.Person_ID = rp.Person_ID
			WHERE rp.Registration_ID = $reg_id
			  AND p.Age_Range = 2";

	$result = mysqli_query($SQL) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT housing contract query.".mysqli_error($link));
	$row = mysqli_fetch_array($result);
	$child_dining_cnt = $row['count'];
	*/
	
	$SQL = "SELECT rd.Number_In_Party as num,
			       rd.Dining_Type_ID as type
			FROM Registration_Dining rd
			WHERE rd.Registration_ID = $reg_id
			ORDER BY rd.Dining_Type_ID";

	$result = mysqli_query($link, $SQL) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT housing contract query.".mysqli_error($link));
	
	// Use for dining type stored in String_Base
	while ($row = mysqli_fetch_array($result)) {
		// Adult meal
		if ($row['type'] == 15) {
			$adult_dining_cnt += $row['num'];
		}
		// Kid's meal (9-13)
		if ($row['type'] == 16) {
			$child_1_dining_cnt += $row['num'];
		}			
		// Kid's meal (3-8)
		if ($row['type'] == 17) {
			$child_2_dining_cnt += $row['num'];
		}			
		// Donated Adult meal
		if ($row['type'] == 19) {
			$donated_adult_dining_cnt += $row['num'];
		}
		// Donated Kid's meal
		if ($row['type'] == 20) {
			$donated_child_dining_cnt += $row['num'];
		}			
	}
	
	//$total_meals = $row['count'];

	$adult_meal_price = 24.5;
	$child_1_meal_price = 13;
	$child_2_meal_price = 10;
	$max_number = 4;
	
	// Determine the charge for the registration
	// First, calculate if they're getting the catered meal
	if ($dining_id == 13) {

		/********** Use	this section for maximum party calculations ****************
		// If our party is the max number of adults or under, calculations are easy
		if (($adult_dining_cnt + $child_dining_cnt) <= $max_number) {
			$charge = ($adult_dining_cnt * $adult_meal_price) + ($child_dining_cnt * $child_meal_price);
		// If we have more than the max number total, check to see if we have less than the max number of adults and calculate from there...
		} elseif ($adult_dining_cnt <= $max_number) {
			$charge = ($adult_dining_cnt * $adult_meal_price) + (($max_number - $adult_dining_cnt) * $child_meal_price);
		// Otherwise, charge a flat rate
		} else {
			$charge = $max_number + $adult_meal_price;
		}
		/**************************************************************************/
		
		/************ Use this section for maximum child calculations *************/
		$charge = $adult_dining_cnt * $adult_meal_price;
		$child_1_dining_cnt = ($child_1_dining_cnt + $child_2_dining_cnt) > $max_number ? $max_number : $child_1_dining_cnt;
		$child_2_dining_cnt = ($child_1_dining_cnt + $child_2_dining_cnt) > $max_number ? 0 : $child_2_dining_cnt;
		$charge += $child_1_dining_cnt * $child_1_meal_price;
		$charge += $child_2_dining_cnt * $child_2_meal_price;
        $charge += $donated_adult_dining_cnt * $adult_meal_price;
        $charge += $donated_child_dining_cnt * $child_1_meal_price;
		/**************************************************************************/
	
	// Calculate for a basic donation registration fee
	} else {
		if ($num_in_party > $max_number) {
			$charge = 20;
		} else {
			$charge = $num_in_party * 5;
		}
	}
	
	// Get the housing ID for the person
	$SQL = "SELECT Registration_ID
			FROM Registration_Payment
			WHERE Registration_ID = ".$reg_id;

	$result = mysqli_query($link, $SQL) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT housing contract query.".mysqli_error($link));
	if (mysqli_num_rows($result) > 0) {
        $SQL = "UPDATE	Registration_Payment
                SET		Registration_ID = ".$reg_id.",
                        Amount_Due = ".$charge."
                WHERE	Registration_ID = ".$reg_id;

        mysqli_query($link, $SQL) or die("Sorry. There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute main contact UPDATE person query.".mysql_error());

    // If they're a new registrant, enter their information
    } else {

        $SQL = "INSERT INTO Registration_Payment
                    (Registration_ID,
                     Payment_Amount,
                     Amount_Due)
                VALUES
                    (".$reg_id.",
                     0.00,
                     ".$charge.")";

        mysqli_query($link, $SQL) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT family person query.".mysql_error());
        $fam_person_id[$i] = mysqli_insert_id($link);		
    }

    // Create an email to send to the new registrant
	$SQL = "SELECT p.First_Name as first,
			       p.Last_Name as last,
                   p.Email as email,
                   r.Number_In_Party as num
			FROM Person p, Registration_Person rp, Registration r
			WHERE p.Person_ID = $mc_person_id
              AND p.Person_ID = rp.Person_ID
              AND r.Registration_ID = rp.Registration_ID";

	$result = mysqli_query($link, $SQL) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT housing contract query.".mysqli_error($link));
	$row = mysqli_fetch_array($result);
    
    $body = '<p>Hello '.$row['first'].',</p>'.
            '<p>Congrats! You just successfully registered your party of <b><u>'.$row['num'].'</u></b>.</p>'.
            '<p>At your earliest convenience, please pay your registration fee of <b><u>$'.$charge.'</u></b> via '.
            'Paypal using the button below (please add $1.00 for processing):</p>'.
            '<p>'.
                '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">'.
                '<input type="hidden" name="cmd" value="_s-xclick">'.
                '<input type="hidden" name="hosted_button_id" value="5U5775R84R6AS">'.
                '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">'.
                '<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">'.
                '<input type="hidden" name="on0" value="Registration for"><input type="hidden" name="os0" maxlength="200" value="KC Weekend">'.
                '</form>'.
            '</p>'.
            '<p>Alternatively, you can send a check made out to <u>Local Church Activity Fund</u> to the following address:</p>'.
            '<p style="margin:20px"><b>John Wells<br/>2329 Lake Breeze Ln.<br/>Lee&#39;s Summit, MO 64086</b></p>'.
            '<p>Sincerely,</p>'.
            '<p>The KC Weekend Organizers</p>'.
            '<p><a href="mailto:lcgkcweekend@gmail.com">lcgkcweekend@gmail.com</a></p>';
//die($body);    

    require_once "js/mail/Mail.php";

    $from = "LCG KC Weekend <lcgkcweekend@gmail.com>";
    $to = $row['first'].' '.$row['last'].' <'.$row['email'].'>';
    $subject = "LCG KC Weekend Registration";

    $headers = array ('From' => $from,
      'To' => $to,
      'Subject' => $subject,
      'Content-Type' => 'text/html',
      'MIME-Version' => '1.0');
    $smtp = Mail::factory('smtp',
      array ('host' => "ssl://smtp.gmail.com",
        'port' => "465",
        'auth' => true,
        'username' => "lcgkcweekend",
        'password' => "Mr. Millich"));

    $mail = $smtp->send($to, $headers, $body);

    if (PEAR::isError($mail)) {
      echo("<p>There was an error sending a registration email: " . $mail->getMessage() . "</p>");
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

	<? include ('google-analytics.php'); ?>
</head>

<body>

	<!-- Add the header to each page -->
	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->

	<div class="main-content">

		<h2 class="standout">Registration</h2>

		<h3>Submission Confirmed:</h3>
		
		<p>You have successfully registered! And you did it without any help from Google, Alexa or that kid that knows everything about computers. We appreciate you registering for this year&#39;s KC Family Weekend... We'll see you soon!</p>

		<? if ($dining_id == 13) { ?>
			<p><h3>The amount owed for the catered meal: <? print('$'.$charge); ?> <i>(<? print('$'.($charge + 1)); ?> if using PayPal for added processing charges.)</i></h3>
		<? } else { ?>
			<p><h3>The amount requested as a donation: <? print('$'.$charge); ?> <i>(<? print('$'.($charge + 1)); ?> if using PayPal for added processing charges.)</i></h3>		
		<? } ?>
		
        <p><b>Note: Once in PayPal, simply enter a Quantity of 1 and enter the amount you owe in the &#39;Price per item&#39; field.</b></p>
		<p>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="5U5775R84R6AS">
            <table>
            <tr><td><input type="hidden" name="on0" value="Registration for">Memo Field: Registration for</td></tr><tr><td><input type="text" name="os0" maxlength="200" value="KC Weekend"></td></tr>
            </table>
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
			<!--<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="JFMRJ5UHHCZK4">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_xpressCheckout.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>-->
		</p>
		
		<p>Please send in the registration costs as quickly as possible so we can reserve a place for you.</p>
		
		<p>You can either click the PayPal Pay Now button to pay by eCheck or a credit or debit card, or send a check. If writing a check, please make checks payable to <u>Local Church Activity Fund</u> and send it to:</p>
		
		<p style="margin:20px"><b>
			John Wells<br/>
			2329 Lake Breeze Ln.<br/>
			Lee's Summit, MO 64086
		</b></p>
		
		<p>Please click on <a href="housing.php">Housing</a> to get more information about our hotel
		arrangement or the contact number of our wonderful and lovely Housing Coordinator, Beryl Wilson.</p>

		<p>Click on <a href="activity-main.php">Activities</a> to sign up for an activity.</p>

		<p>Or click on <a href="reg-main.php">Registration</a> to see if your name is now on the list.
		Or you can see what part of the country people are coming from on the map!</p>


		<br />

		<p>If you forgot anything, click Back and fix whatever you need.</p>
		<br/><hr/><br/>

		<? if ($housing_type == 8) { ?>
			<input type="button" value="< Back" onclick="history.go(-1);" />
		<? } else { ?>
			<input type="button" value="< Back" onclick="history.go(-2);" />
		<? } ?>

		<br /><br /><br />

	</div>

	<!-- End of Main Content Area -->

	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>

	<script type="text/javascript">
		$(document).ready(function() {
			$("input:button").button();
		});
	</script>	
</body>
</html>

<?
	mysqli_close($link);
?>
