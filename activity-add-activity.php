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
	function getSelectedItems(objGrid) {
		var strRtnValue = "";
		var arrData = objGrid.getGridParam('selarrrow');
		if (arrData.length > 0) {
			for (var i = 0; i < arrData.length; i++) {
				strRtnValue += (arrData[i] + ",");
			}

			// Now strip out the trailing comma
			if (strRtnValue != "") {
				strRtnValue = strRtnValue.substr(0, strRtnValue.length - 1);
			}
		} else {
			var selRow = objGrid.getGridParam('selrow');
			if (selRow == null) {
				return "";
			}

			strRtnValue = selRow;
		}

		return strRtnValue;
	}
	
	function VerifyAndSubmit() {

		var person_id = getSelectedItems($("#reg-person"));
		if (person_id == "") { return false; }
		document.getElementById("gridPerson").value = person_id;

		var activity_ids = getSelectedItems($("#activity-list"));

		if (activity_ids == "") { return false; }
		document.getElementById("gridActivity").value = activity_ids;

		document.getElementById("activity-add-activity").submit();
	}
	</script>

	<? include ('google-analytics.php'); ?>
</head>

<body>

	<!-- Add the header to each page -->
	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->
	<div class="main-content">

		<h2>Activities</h2>

		<p>Sign up here for your activities.</p>
		
		<p><b>Important: Minimum age for sports tournaments is 13. Those with bad backs or other similar injuries should not
		participate. Due to the inherent risk of such activities, all participates must sign a liability waiver. Those
		under 18 will need a parent or legal guardian&#39;s signature before they can participate.</b></p>

		<p>Find your name on the list of registered people (not registered? Click <a href="reg-main.php">here</a>) and
		click that row to highlight it. Then click <u>ALL</u> the activities you want to participate in. Finally, click Submit at the
		bottom of the page.</p>

		<hr />

		<h3>Add/Change Your Activity:</h3> 
		
		<p><i>(Note: When changing an activity, please choose all the activities you wish to participate in, not just the one
		you&#39;re changing.)</i></p>

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