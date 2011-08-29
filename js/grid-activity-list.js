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
		//width: 220,
		height: 140,
		hidegrid: false,
		caption:"Activity List"
	});
});