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
	jQuery("#whos-housed-where").jqGrid({
		url:'db-reg-whos-housed.php',
		datatype: "xml",
		mtype: "GET",
		colNames:['First', 'Last', 'Email', 'Phone', 'Housing Type', '# in Party'],
		colModel:[
			{name:'first_name', index:'first_name', width:100},
			{name:'last_name',index:'last_name', width:100},
			{name:'email',index:'email', width:200},
			{name:'phone',index:'phone', width:130},
			{name:'housing_type',index:'housing_type', width:200},
			{name:'num_in_party',index:'num_in_party', width:60}
			],
		pager: '#whos-housed-where-pager',
		rowNum:10,
		rowList:[10,20,30],
		width: 954,
		height: 230,
		sortname: 'last_name,first_name',
		sortorder: 'asc',
		viewrecords: true,
		multiselect: false,
		hidegrid: false,
		subGrid : true,
		subGridUrl: 'db-sub-reg-housing-contacts.php',
		subGridModel: [
			{name : ['First','Last','Email','Phone','Address 1','Address 2','City','State','Zip'],
			 width : [100,100,200,100,150,40,90,40,60] }
			],
		caption:"Who's Staying Where"
	}).navGrid('#whos-housed-where',{edit:false,add:false,del:false});
});
</script>

</head>

<body style="background-color:#5f92d2">

	<table id="whos-housed-where"></table>
	<div id="whos-housed-where-pager"></div>

</body>
</html>