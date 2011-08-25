	<link rel="stylesheet" type="text/css" media="screen" href="css/jquery-ui-1.8.16.custom.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="js/jqgrid/css/ui.jqgrid.css" />

	<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
	<script src="js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jqgrid/js/jquery.jqGrid.min.js"></script>

	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#reg-person").jqGrid({
			url:'db-reg-person.php?admin=0',
			datatype: "xml",
			mtype: "GET",
			colNames:['First', 'Last'],
			colModel:[
				{name:'first_name', index:'first_name', width:150},
				{name:'last_name',index:'last_name', width:200}],
			rowNum: 1500,
			sortname: 'last_name, first_name',
			sortorder: 'asc',
			viewrecords: true,
			width: 450,
			height: 345,
			hidegrid: false,
			caption:"Who's Registered So Far"
		}).navGrid('#reg-person',{edit:false,add:false,del:false});
	});
	</script>

	<table id="reg-person"></table>
