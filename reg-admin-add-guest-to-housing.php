<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend: Add Guests To Housing</title>

	<link rel="stylesheet" href="page.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" media="screen" href="js/css/start/jquery-ui-1.7.2.custom.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="js/css/ui.jqgrid.css" />

	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script src="js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.jqGrid.min.js"></script>

	<script type="text/javascript">
	// The grid for the guest list
	jQuery(document).ready(function() {
		jQuery("#reg-whos-not-housed").jqGrid({
			url:'db-reg-whos-not-housed.php',
			datatype: "xml",
			mtype: "GET",
			colNames:['First', 'Last', 'Email', 'Phone', 'Housing Type', '# in Party', 'Housed By Notes'],
			colModel:[
				{name:'first_name', index:'first_name', width:100},
				{name:'last_name',index:'last_name', width:100},
				{name:'email',index:'email', width:200},
				{name:'phone',index:'phone', width:130},
				{name:'housing_type',index:'housing_type', width:200},
				{name:'num_in_party',index:'num_in_party', width:80},
				{name:'housed_by',index:'housed_by', width:150}
				],
			pager: '#reg-whos-not-housed-pager',
			rowNum:10,
			rowList:[10,20,30],
			sortname: 'last_name, first_name',
			sortorder: 'asc',
			viewrecords: true,
			width: 755,
			height: 230,
			hidegrid: false,
			onSelectRow: function(id) {GetNumInParty();},
			caption:"Who's Not Yet Housed"
		}).navGrid('#reg-whos-not-housed',{edit:false,add:false,del:false});
	});

	// The grid for the housing contacts list
	jQuery(document).ready(function() {
		jQuery("#reg-housing").jqGrid({
			url:'db-reg-housing.php',
			datatype: "xml",
			mtype: "GET",
			colNames:['First',
					  'Last',
					  'More?',
					  'Num Guests',
					  'Guest Names',
					  'Email',
					  'Phone',
					  'Address1',
					  'Addr2',
					  'City',
					  'St',
					  'Zip',
					  'Pets',
					  'Pet Info',
					  'Air Trans',
					  'Act. Trans',
					  'Cpls',
					  'Sngls',
					  'Girls',
					  'Boys',
					  'Adlt',
					  'Baby',
					  'Teen',
					  'Other'],
			colModel:[
				{name:'first_name', index:'first_name', width:80},
				{name:'last_name', index:'last_name', width:80},
				{name:'house_more', index:'house_more', width:30},
				{name:'how_many', index:'how_many', width:30},
				{name:'guest_names', index:'guest_names', width:100},
				{name:'email', index:'email', width:200},
				{name:'phone', index:'phone', width:110},
				{name:'addr1', index:'addr1', width:150},
				{name:'addr2', index:'addr2', width:45},
				{name:'city', index:'city', width:100},
				{name:'state', index:'state', width:30},
				{name:'zip', index:'zip', width:70},
				{name:'pets', index:'pets', width:30},
				{name:'pets_info', index:'pets_info', width:100},
				{name:'air_trans', index:'air_trans', width:30},
				{name:'act_trans', index:'act_trans', width:30},
				{name:'couples', index:'couples', width:30},
				{name:'singles', index:'singles', width:30},
				{name:'girls', index:'girls', width:30},
				{name:'boys', index:'boys', width:30},
				{name:'adults_only', index:'adults_only', width:30},
				{name:'babies', index:'babies', width:30},
				{name:'teens', index:'teens', width:30},
				{name:'other',index:'other', width:100}],
			pager: '#reg-housing-pager',
			rowNum:10,
			rowList:[10,20,30],
			sortname: 'last_name, first_name',
			sortorder: 'asc',
			viewrecords: true,
			width: 1400,
			height: 230,
			hidegrid: false,
			caption:"Housing Contacts"
		}).navGrid('#reg-housing',{edit:false,add:false,del:false});
	});


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

<div id="container">

	<!-- Add the header to each page -->
	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->

	<div id="maincontent_container">
	<div id="maincontent">

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
			<div id="reg-whos-not-housed-pager"></div>
			<input type="hidden" id="gridGuest" name="gridGuest" />

			<br/><br/>

			<table id="reg-housing"></table>
			<div id="reg-housing-pager"></div>
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
	</div>

	<div class="clearthis">&nbsp;</div>

	<!-- End of Main Content Area -->

	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>

</div>

</body>
</html>