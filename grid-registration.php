<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KC Weekend Registration</title>

<link rel="stylesheet" type="text/css" media="screen" href="js/css/start/jquery-ui-1.7.2.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="js/css/ui.jqgrid.css" />

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script src="js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.jqGrid.min.js"></script>

<script type="text/javascript">
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
</script>

</head>

<body style="background-color:#5f92d2">

	<table id="reg-registration"></table>
	<div id="reg-registration-pager"></div>

</body>
</html>