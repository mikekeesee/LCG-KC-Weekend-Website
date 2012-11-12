// Grid for displaying teams for a specified activity. //
// Define 'var activity_type' and 'var activity_name' prior to using this on the page consuming it.

jQuery(document).ready(function() {
	jQuery("#teams").jqGrid({
		url:'db-activity-teams.php?activity=' + activity_number,
		datatype: "xml",
		mtype: "GET",
		colNames:['Team Name','Captain','Team Color', 'Type'],
		colModel:[
			{name:'team_name', index:'team_name', width:200},
			{name:'captain', index:'captain', width:150},
			{name:'shirt_color', index:'shirt_color', width:150},
			{name:'skill_level', index:'skill_level', width:100}
			],
		width: 350,
		height: 230,
		sortname: 'team_name',
		sortorder: 'asc',
		viewrecords: true,
		multiselect: false,
		hidegrid: false,
		subGrid : true,
		subGridUrl: 'db-sub-activity-team-members.php',
		subGridModel: [
			{name : ['First','Last'],
			 width : [150,150] }
			],
		onSelectRow: function(id) {onSelectRow(id);},
		caption: activity_name + " Teams"
	});
});
