<?
	// **********************************************
	// *       Admin Money Submission Page          *
	// **********************************************

	// Get the database connection information
	include("db-connect.php");

	$link = mysqli_connect(localhost, $username, $password, $database);

	// Main contact info
	$reg_id			= $_POST['gridReg'];
	$amount			= (float)$_POST['txtHowMuch'];
	$add_payment	= $_POST['chkAddPayment']=="on"?true:false;
	$reset			= (float)$_GET['reset'];

	if ($reset == 1) {
		$batch_amount = 0;
	} else {
		$reset = 0;
		$batch_amount = (float)$_COOKIE["batch_amount"];
		$batch_amount += $amount;
	}
	
	$expire = time() + (60*60*2);
	setcookie("batch_amount", $batch_amount, $expire);

	if ($reset == 0) {
		$SQL = "SELECT	CONCAT(p.First_Name, ' ', p.Last_Name) as name
				FROM	Registration r
                    
                    INNER JOIN Registration_Person rp
                            ON r.Registration_ID = rp.Registration_ID
                            AND rp.Main_Contact_Ind = 1
                    
                    INNER JOIN Person p
                            ON rp.Person_ID = p.Person_ID
				
                WHERE	r.Registration_ID = $reg_id";

		$result = mysqli_query($link,  $SQL ) or die($SQL."\n\nCouldn't execute Registration SELECT count query.".mysqli_error($link));
		$row = mysqli_fetch_array($result);
		$name = $row['name'];


		// Verify there is not already an identical person in the system
		$SQL = "SELECT	COUNT(*) as count
				FROM	Registration_Payment
				WHERE	Registration_ID = $reg_id";

		$result = mysqli_query($link,  $SQL ) or die($SQL."\n\nCouldn't execute Registration SELECT count query.".mysqli_error($link));
		$row = mysqli_fetch_array($result);
		$count = $row['count'];

		// Somehow, this registration was already housed here...  Do not calculate the remainder left in the host household.
		if ($count > 0) {
			if ($add_payment == true) {
				$SQL = "SELECT	payment_amount
						FROM	Registration_Payment
						WHERE	Registration_ID = $reg_id";

				$result = mysqli_query($link, $SQL) or die($SQL."\n\nCouldn't execute Registration SELECT count query.".mysqli_error($link));
				$row = mysqli_fetch_array($result);
				$prev_amount = (int)$row['payment_amount'];

				// Add the previous amount to the amount entered here.
				$amount += $prev_amount;
			}

			$SQL = "UPDATE	Registration_Payment
					SET		Payment_Amount = $amount
					WHERE	Registration_ID = $reg_id";

			mysqli_query($link, $SQL) or die($SQL."\n\nCouldn't execute Registration SELECT count query.".mysqli_error($link));

		// If they're a new registrant, enter their information
		} else {
			// Insert the data into the Registration_Payment table.
			$SQL = "INSERT INTO Registration_Payment
						(Registration_ID,
						 Payment_Amount)
					VALUES
						($reg_id,
						 $amount)";

			mysqli_query($link,  $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Registration_Housing INSERT query.".mysqli_error($link));
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

	<? include ('google-analytics.php'); ?>
</head>

<body onload="OnLoad();">

	<!-- Add the header to each page -->
	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->

	<div class="main-content">

		<h2>Registration</h2>

		<br/>
<? if ($reset == 0) { ?>
		<h3>Payment Successfully Recorded!</h3>
		<br/>
		<p><?=$name?> has currently paid <b>$<?=number_format($amount, 2)?></b>. Money, money, money, money...  MONEY!</p>
<? } ?>		
		<p>The batch total for this session is: <b>$<?=number_format($batch_amount, 2)?></b> <em>(This will reset after two more hours...)</em></p>

		<p><a href="reg-admin-add-money.php">Add another payment</a></p>

		<p><a href="reg-admin-add-money-submit.php?reset=1">Reset Batch Total</a></p>

		<p><a href="reg-admin.php">Registration Administration</a></p>

		<br /><br /><br /><br />

	</div>

	<!-- End of Main Content Area -->

	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>

</body>
</html>

<?
	mysqli_close($link);
?>
