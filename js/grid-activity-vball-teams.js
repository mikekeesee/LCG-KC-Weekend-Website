jQuery(document).ready(function() {
	jQuery("#volleyball-teams").jqGrid({
		url:'db-activity-teams.php?activity=2',
		datatype: "xml",
		mtype: "GET",
		colNames:['Team Name','Captain','Team Color'],
		colModel:[
			{name:'team_name', index:'team_name'},
			{name:'captain', index:'captain'},
			{name:'shirt_color', index:'shirt_color'}
			],
		width: 550,
		height: 330,
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
		caption:"Volleyball Teams"
	});
});
