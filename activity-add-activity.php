<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Activities</title>

	<link rel="stylesheet" href="page.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" media="screen" href="js/css/start/jquery-ui-1.7.2.custom.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="js/css/ui.jqgrid.css" />

	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script src="js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.jqGrid.min.js"></script>

	<script type="text/javascript">
	// The grid for those registered
	jQuery(document).ready(function() {
		jQuery("#reg-person").jqGrid({
			url:'db-reg-person.php?admin=0',
			datatype: "xml",
			mtype: "GET",
			colNames:['First', 'Last'],
			colModel:[
				{name:'first_name', index:'first_name', width:120},
				{name:'last_name',index:'last_name', width:150}],
			pager: '#reg-person-pager',
			rowNum: 15,
			sortname: 'last_name, first_name',
			sortorder: 'asc',
			viewrecords: true,
			width: 380,
			height: 345,
			hidegrid: false,
			caption:"Who's Registered So Far"
		}).navGrid('#reg-person',{edit:false,add:false,del:false});
	});

	// The grid for the housing contacts list
	jQuery(document).ready(function() {
		jQuery("#activity-list").jqGrid({
			url:'db-activity-list.php',
			datatype: "xml",
			mtype: "GET",
			colNames:['Activity'],
			colModel:[
				{name:'activity_name', index:'first_name', width:150}],
			sortname: 'activity_name',
			sortorder: 'asc',
			viewrecords: true,
			width: 220,
			height: 140,
			hidegrid: false,
			caption:"Activity List"
		});
	});


	function getSelectedId(objGrid) {
		var selRow = objGrid.getGridParam('selrow');
		if (selRow == null) {
			alert("Please select at least one row from each grid.")
			return false;
		}

		return selRow;
	}

	function VerifyAndSubmit() {

		var person_id = getSelectedId($("#reg-person"));
		if (person_id == "") { return false; }
		document.getElementById("gridPerson").value = person_id;

		var activity_id = getSelectedId($("#activity-list"));
		if (activity_id == "") { return false; }
		document.getElementById("gridActivity").value = activity_id;

		document.getElementById("activity-add-activity").submit();
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

		<h2 class="standout">Activities</h2>
		<p>Use this page to pick the activity you would like to participate in. This year, all of the activities listed below are
		on Sunday, so you can only choose one. That&#39;s not to say that you won&#39;t be able to pop over and play some
		recreational volleyball after your basketball game, but we&#39;d like you to commit to only one for now. Family games are
		for everyone.</p>

		<p>Find your name on the list of registered people (not registered? Click <a href="reg-main.php">here</a>) and
		click that row to highlight it. Then click the row activity of your choice to highlight it. Finally, click Submit at the
		bottom of the page.</p>
		<hr />

		<br/>
		<em><-- <a href="activity-main.php">Back to Activities Main page</a></em>
		<br/>

		<br/>
		<h3>Add/Change Your Activity:</h3>
		<br/>
		<form id="activity-add-activity" action="activity-add-activity-submit.php" method="post">
			<br/>
			<table>
			<tr valign="top">
			<td>
			<table id="reg-person"></table>
			<div id="reg-person-pager"></div>
			<input type="hidden" id="gridPerson" name="gridPerson" />
			</td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td>
			<table id="activity-list"></table>
			<div id="activity-list-pager"></div>
			<input type="hidden" id="gridActivity" name="gridActivity" />
			</td>
			</tr>
			</table>
			<br />
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