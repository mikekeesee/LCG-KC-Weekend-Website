// Grid for displaying players for a specified activity. //
// Define 'var activity_type' and 'var activity_name' prior to using this on the page consuming it.

jQuery(document).ready(function() {
	jQuery("#players").jqGrid({
		url:'db-activity-players.php?activity=' + activity_number,
		datatype: "xml",
		mtype: "GET",
		colNames:['Last Name', 'First Name','Team Name'],
		colModel:[
			{name:'last_name', index:'last_name', width:100},
			{name:'first_name', index:'first_name', width:100},
			{name:'team_name', index:'team_name', width:125}
			],
		width: 330,
		height: 230,
		rowNum: 200,
		sortname: 'last_name,first_name',
		sortorder: 'asc',
		viewrecords: true,
		multiselect: true,
		hidegrid: false,
		caption: activity_name + " Players"
	});
});
