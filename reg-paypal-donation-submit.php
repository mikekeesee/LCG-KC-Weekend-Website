<?
	// **********************************************
	// *       PayPal Payment Submission Page       *
	// **********************************************


	
	// read the post from PayPal system and add 'cmd'
	$req = 'cmd=_notify-validate';

	foreach ($_POST as $key => $value) {
		$value = urlencode(stripslashes($value));
		$req .= "&$key=$value";
	}

	// post back to PayPal system to validate
	//$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
	//$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	//$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
	//$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

	// assign posted variables to local variables
	$item_name = $_POST['item_name'];
	$item_number = $_POST['item_number'];
	$payment_status = $_POST['payment_status'];
	$payment_amount = $_POST['mc_gross'];
	$payment_currency = $_POST['mc_currency'];
	$txn_id = $_POST['txn_id'];
	$receiver_email = $_POST['receiver_email'];
	$payer_email = $_POST['payer_email'];

	/*mail("mkeesee@gmail.com", "test", 
			"itemname=".$item_name.
			"\r\nitemnumber=".$item_number.
			"\r\npaymentstatus=".$payment_status.
			"\r\npaymentamount=".$payment_amount.
			"\r\npaymentcurrency=".$payment_currency.
			"\r\nrecemail=".$receiver_email.
			"\r\npayeremail=".$payer_email, "FROM: mkeesee@gmail.com");
	*/


	// Get the database connection information
	include("db-connect.php");

	mysql_connect(localhost,$username,$password) or die("Unable to connect to database");
	mysql_select_db($database) or die("Unable to select database");
	
	//if (!$fp) {
		// HTTP ERROR
	//} else {
	//	fputs ($fp, $header . $req);
	//	while (!feof($fp)) {
	//		$res = fgets ($fp, 1024);
	//		if (strcmp ($res, "VERIFIED") == 0) {
				// check the payment_status is Completed
				// check that txn_id has not been previously processed
				// check that receiver_email is your Primary PayPal email
				// check that payment_amount/payment_currency are correct
				// process payment
				if (strcmp($payment_status, "Completed") == 0) {
				
					$SQL = "SELECT	r.Registration_ID AS reg_id
							FROM 	Person AS p
								INNER JOIN Registration AS r
									ON r.Main_Contact_Person_ID = p.Person_ID
							WHERE	p.Email = '$payer_email'";

					$result = mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute SELECT payment amount query.".mysql_error());

					$row = mysql_fetch_array($result, MYSQL_ASSOC);
						
					// If it's not the main contact's email, let's check the other people in the party
					if (is_null($row['reg_id'])) {
						$SQL = "SELECT	rp.Registration_ID AS reg_id
								FROM 	Person p
									INNER JOIN Registration_Person rp
										ON rp.Person_ID = p.Person_ID
								WHERE	p.Email = '$payer_email'";

						$result = mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute SELECT payment amount query.".mysql_error());
						$row = mysql_fetch_array($result, MYSQL_ASSOC);
					}
					
					if (is_null($row['reg_id'])) {
						// Update the UNKNOWN payment field
						$SQL = "SELECT	Payment_Amount as amount
								FROM Registration_Payment
								WHERE	Registration_ID = 0";

						$result = mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute SELECT payment amount query.".mysql_error());
						$row = mysql_fetch_array($result, MYSQL_ASSOC);
						
						if(!is_null(intval($row['amount'])))
							$payment_amount = $payment_amount + intval($row['amount']);
						
						$SQL = "UPDATE	Registration_Payment
								SET		Payment_Amount = $payment_amount
								WHERE	Registration_ID = 0";

						mysql_query($SQL) or die($SQL."\n\nCouldn't execute Registration SELECT count query.".mysql_error());		

					} else { // The email address was found
						$reg_id = $row['reg_id'];

						$SQL = "SELECT	Payment_Amount as amount
								FROM Registration_Payment
								WHERE	Registration_ID = $reg_id";

						$result = mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute SELECT payment amount query.".mysql_error());
						$row = mysql_fetch_array($result, MYSQL_ASSOC);
					}
					
					// They've never paid in the past
					if (is_null($row['amount'])) {

						// Insert the data into the Registration_Payment table.
						$SQL = "INSERT INTO Registration_Payment
									(Registration_ID,
									 Payment_Amount)
								VALUES
									($reg_id,
									 $payment_amount)";

						mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute Registration_Housing INSERT query.".mysql_error());

					} else {				
						$payment_amount = $payment_amount + intval($row['amount']);
						
						$SQL = "UPDATE	Registration_Payment
								SET		Payment_Amount = $payment_amount
								WHERE	Registration_ID = $reg_id";

						mysql_query($SQL) or die($SQL."\n\nCouldn't execute Registration SELECT count query.".mysql_error());		
					}
				}
			//}
	//		else if (strcmp ($res, "INVALID") == 0) {
				// log for manual investigation
	//		}
	//	}
	//	fclose ($fp);
	//}
?>