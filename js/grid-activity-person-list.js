// The grid for those registered
jQuery(document).ready(function() {
	jQuery("#activity-person-list").jqGrid({
		url:'db-activity-person-list.php',
		datatype: "xml",
		mtype: "GET",
		colNames:['First', 'Last', 'Activity'],
		colModel:[
			{name:'first_name', index:'first_name', width:100},
			{name:'last_name',index:'last_name', width:100},
			{name:'activity_name',index:'activity_name', width:200}],
		rowNum: 1000,
		sortname: 'last_name, first_name',
		sortorder: 'asc',
		viewrecords: true,
		width: 420,
		height: 345,
		hidegrid: false,
		caption:"People Signed Up For Activities"
	});
});