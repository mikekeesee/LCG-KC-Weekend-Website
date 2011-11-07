<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Activities</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />

	<? include "jqgrid-header.php" ?>
	
	<script type="text/javascript" src="js/grid-reg-person.js"></script>	
	<script type="text/javascript" src="js/grid-activity-list.js"></script>
	
	<script type="text/javascript">	
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

	<!-- Add the header to each page -->
	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->
	<div class="main-content">

		<-- <a href="activity-main.php">Back to Activities Main page</a>

		<h2>Activities</h2>

		<p>Use this page to pick the activity you would like to participate in. This year, all of the activities listed below are
		on Sunday, so you can only choose one. That&#39;s not to say that you won&#39;t be able to pop over and play some
		recreational volleyball after your basketball game, but we&#39;d like you to commit to only one for now. Family games are
		for everyone.</p>

		<p>Find your name on the list of registered people (not registered? Click <a href="reg-main.php">here</a>) and
		click that row to highlight it. Then click the row activity of your choice to highlight it. Finally, click Submit at the
		bottom of the page.</p>

		<hr />

		<h3>Add/Change Your Activity:</h3>

		<form id="activity-add-activity" action="activity-add-activity-submit.php" method="post">
			<div class="grid-inline">
				<table id="reg-person"></table>
				<input type="hidden" id="gridPerson" name="gridPerson" />
			</div>
			
			<div class="grid-inline">
				<table id="activity-list"></table>
				<input type="hidden" id="gridActivity" name="gridActivity" />
			</div>
			
			<div class="clear-float" />
			
			<br />
			
			<input type="button" value="Submit" onclick="VerifyAndSubmit();" />
		</form>

	</div>
	<!-- End of Main Content Area -->

	<!-- Add the footer to each page -->
	<? include ('footer.php'); ?>

	<script type="text/javascript">
			$("input:button").button();		
	</script>
</body>
</html>