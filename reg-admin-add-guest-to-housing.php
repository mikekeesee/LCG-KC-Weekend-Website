<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend: Add Guests To Housing</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />

	<? include "jqgrid-header.php" ?>
	
	<script type="text/javascript" src="js/grid-reg-whos-not-housed.js"></script>
	<script type="text/javascript" src="js/grid-reg-housing.js"></script>

	<script type="text/javascript">
		function getSelectedId(objGrid) {
			var selRow = objGrid.getGridParam('selrow');
			if (selRow == null) {
				alert("Please select at least one row from each grid.")
				return false;
			}

			return selRow;
		}


		function GetNumInParty() {
			var rowid = getSelectedId($("#reg-whos-not-housed"));
			if (rowid == "") { return false; }
			num_in_party = $("#reg-whos-not-housed").getCell(rowid, 5);
			document.getElementById("txtHowMany").value = num_in_party;
		}

		function IsNumeric(sText) {
		   var ValidChars = "0123456789.";
		   var IsNumber = true;
		   var Char;


		   for (i = 0; i < sText.length && IsNumber == true; i++) {
			  Char = sText.charAt(i);
			  if (ValidChars.indexOf(Char) == -1) {
				 IsNumber = false;
			  }
		   }

		   return IsNumber;
		}

		function VerifyAndSubmit() {
			var reg_id = getSelectedId($("#reg-whos-not-housed"));
			if (reg_id == "") { return false; }
			document.getElementById("gridGuest").value = reg_id;

			var housing_id = getSelectedId($("#reg-housing"));
			if (housing_id == "") { return false; }
			document.getElementById("gridHost").value = housing_id;

			// Check the fields to see if any are empty
			if (document.getElementById("txtHowMany").value == '') {
				alert("Please fill out the number of people being housed.");
				return false;
			}

			if (IsNumeric(document.getElementById("txtHowMany").value) == false) {
				alert("Please enter a number in the 'How many are being housed here?' text box.");
				return false;
			}

			document.getElementById("reg-add-guest-to-housing").submit();
		}
	</script>

</head>

<body>

	<!-- Add the header to each page -->
	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->

	<div class="main-content">

		<h2>Registration</h2>

		<p>Use this page to match brethren needing housing with with brethren who are hosting.  Pick a guest and then pick a host.
		Check the box if they will require additional housing.  Finally, fill out the number in the party being housed with
		the selected host and then click Submit.</p>
		<hr />

		<br/>
		<em><-- <a href="reg-admin.php">Back to Registration Admin</a></em>
		<br/>

		<br/>
		<h3>Match Guests to a Host:</h3>
		<br/>
		<form id="reg-add-guest-to-housing" action="reg-admin-add-guest-to-housing-submit.php" method="post">
			<br/>

			<table id="reg-whos-not-housed"></table>
			<input type="hidden" id="gridGuest" name="gridGuest" />

			<br/><br/>

			<table id="reg-housing"></table>
			<input type="hidden" id="gridHost" name="gridHost" />

			<br/>
			<label class="label">How many are being housed here?&nbsp;&nbsp;&nbsp;<input type="text" id="txtHowMany" name="txtHowMany" maxlength=2 size=2 /></label>
			<br/><br/>
			<label class="label"><input type="checkbox" id="chkMoreHousing" name="chkMoreHousing" />  Does this group need further housing? (Checking this will leave them in the list.)</label>

			<hr />
			<br />
			<input type="button" value="Submit" onclick="VerifyAndSubmit();" />
		</form>

	</div>

	<!-- End of Main Content Area -->

	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>

	<script type="text/javascript">
			$("input:button").button();		
	</script>

</body>
</html>