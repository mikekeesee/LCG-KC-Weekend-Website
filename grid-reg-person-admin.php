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
	jQuery("#reg-person-admin").jqGrid({
		url:'db-reg-person.php?admin=1',
		datatype: "xml",
		mtype: "GET",
		colNames:['First', 'Last', 'Sex', 'Group', 'Email', 'Phone'],
		colModel:[
			{name:'first_name', index:'first_name', width:100},
			{name:'last_name',index:'last_name', width:105},
			{name:'sex',index:'sex', width:50},
			{name:'age_range',index:'age_range', width:70},
			{name:'email',index:'email', width:200},
			{name:'phone',index:'phone', width:130} ],
		pager: jQuery('#reg-person-admin-pager'),
		rowNum:10,
		rowList:[10,20,30],
		sortname: 'last_name, first_name',
		sortorder: 'asc',
		viewrecords: true,
		width: 755,
		height: 235,
		hidegrid: false,
		caption:"Who's Registered"
	}).navGrid('#reg-person=admin',{edit:false,add:false,del:false});
});
</script>

</head>

<body style="background-color:#5f92d2">

	<table id="reg-person-admin"></table>
	<div id="reg-person-admin-pager"></div>

</body>
</html>