jQuery(document).ready(function() {
	jQuery("#teams").jqGrid({
		url:'db-activity-teams.php?activity=2',
		datatype: "xml",
		mtype: "GET",
		colNames:['Team Name','Captain','Team Color'],
		colModel:[
			{name:'team_name', index:'team_name', width:200},
			{name:'captain', index:'captain', width:150},
			{name:'shirt_color', index:'shirt_color', width:150}
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
		caption:"Volleyball Teams"
	});
});

jQuery(document).ready(function() {
	jQuery("#players").jqGrid({
		url:'db-activity-players.php?activity=2',
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
		rowNum: 100,
		sortname: 'last_name,first_name',
		sortorder: 'asc',
		viewrecords: true,
		multiselect: true,
		hidegrid: false,
		caption:"Volleyball Players"
	});
});
