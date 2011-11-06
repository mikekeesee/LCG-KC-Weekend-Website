<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend: Add Money</title>

	<link rel="stylesheet" href="page.css" type="text/css" media="screen" />

	<? include "jqgrid-header.php" ?>

	<script type="text/javascript">
	// The grid for the guest list
	jQuery(document).ready(function() {
		jQuery("#reg-registration").jqGrid({
			url:'db-registration.php',
			datatype: "xml",
			mtype: "GET",
			colNames:['First', 'Last', 'Email', 'Phone', 'Housing', '# in Party', 'Housed By', 'Done Housing'],
			colModel:[
				{name:'first_name', index:'first_name', width:120},
				{name:'last_name',index:'last_name', width:150},
				{name:'email', index:'email', width:250},
				{name:'phone', index:'phone', width:150},
				{name:'housing', index:'housing', width:250},
				{name:'num_in_party', index:'num_in_party', width:110},
				{name:'housed_by', index:'housed_by', width:150},
				{name:'done_housing', index:'done_housing', width:150}],
			pager: '#reg-registration-pager',
			rowNum: 10,
			sortname: 'last_name, first_name',
			sortorder: 'asc',
			viewrecords: true,
			width: 850,
			height: 245,
			hidegrid: false,
			caption:"Registration Information"
		}).navGrid('#reg-registration',{edit:false,add:false,del:false});
	});


	function getSelectedId(objGrid) {
		var selRow = objGrid.getGridParam('selrow');
		if (selRow == null) {
			alert("Please select at least one row from each grid.")
			return false;
		}

		return selRow;
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

		var reg_id = getSelectedId($("#reg-registration"));
		if (reg_id == "") { return false; }
		document.getElementById("gridReg").value = reg_id;

		// Check the fields to see if any are empty
		if (document.getElementById("txtHowMuch").value == '') {
			alert("Please fill out much money they paid.");
			return false;
		}

		if (IsNumeric(document.getElementById("txtHowMuch").value) == false) {
			alert("Please enter a number in the 'How much money?' text box.");
			return false;
		}

		document.getElementById("reg-registration").submit();
	}
	</script>

</head>

<body>

	<!-- Add the header to each page -->
	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->

	<div class="main-content">

		<h2>Registration</h2>
		<p>Use this page to add money each group paid.  Pick a registration entry.
		Then enter the amount in dollars that they paid.  Finally, click Submit.</p>
		<hr />

		<br/>
		<em><-- <a href="reg-admin.php">Back to Registration Admin</a></em>
		<br/>

		<br/>
		<h3>Add Payment Information:</h3>
		<br/>
		<form id="reg-admin-add-money" action="reg-admin-add-money-submit.php" method="post">
			<table id="reg-registration"></table>
			<div id="reg-registration-pager"></div>
			<input type="hidden" id="gridReg" name="gridReg" />

			<br/><br/>

			<label class="label">How much money?&nbsp;&nbsp;&nbsp;$<input type="text" id="txtHowMuch" name="txtHowMuch" maxlength=3 size=3 /></label>
			<br/><br/>
			<hr />
			<br />
			<input type="button" value="Submit" onclick="VerifyAndSubmit();" />
		</form>

	</div>

	<div class="clearthis">&nbsp;</div>

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