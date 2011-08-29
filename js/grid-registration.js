jQuery(document).ready(function() {
	jQuery("#reg-registration").jqGrid({
		url:'db-registration.php',
		datatype: "xml",
		mtype: "GET",
		colNames:['First', 'Last', 'Email', 'Phone', 'Housing', '# in Party', 'Housed By', 'Done Housing'],
		colModel:[
			{name:'first_name', index:'first_name', width:120},
			{name:'last_name',index:'last_name', width:150},
			{name:'email', index:'email', width:250},
			{name:'phone', index:'phone', width:150},
			{name:'housing', index:'housing', width:250},
			{name:'num_in_party', index:'num_in_party', width:110},
			{name:'housed_by', index:'housed_by', width:150},
			{name:'done_housing', index:'done_housing', width:150}],
		pager: '#reg-registration-pager',
		rowNum: 1000,
		sortname: 'last_name, first_name',
		sortorder: 'asc',
		viewrecords: true,
		width: 850,
		height: 245,
		hidegrid: false,
		caption:"Registration Information"
	});
});