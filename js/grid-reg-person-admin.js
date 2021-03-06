jQuery(document).ready(function() {
	jQuery("#reg-person-admin").jqGrid({
		url:'db-reg-person.php?admin=1',
		datatype: "xml",
		mtype: "GET",
		colNames:['First', 'Last', 'Group', 'Email', 'Phone'],
		colModel:[
			{name:'first_name', index:'first_name', width:100},
			{name:'last_name',index:'last_name', width:105},
			{name:'age_range',index:'age_range', width:70},
			{name:'email',index:'email', width:200},
			{name:'phone',index:'phone', width:130} ],
		rowNum:1000,
		rowList:[10,20,30],
		sortname: 'last_name, first_name',
		sortorder: 'asc',
		viewrecords: true,
		width: 755,
		height: 235,
		hidegrid: false,
		caption:"Who's Registered"
	});
});