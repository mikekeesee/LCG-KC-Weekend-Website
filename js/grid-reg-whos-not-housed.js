jQuery(document).ready(function() {
	jQuery("#reg-whos-not-housed").jqGrid({
		url:'db-reg-whos-not-housed.php',
		datatype: "xml",
		mtype: "GET",
		colNames:['First', 'Last', 'Email', 'Phone', 'Housing Type', '# in Party', 'Housed By Notes'],
		colModel:[
			{name:'first_name', index:'first_name', width:100},
			{name:'last_name',index:'last_name', width:100},
			{name:'email',index:'email', width:200},
			{name:'phone',index:'phone', width:130},
			{name:'housing_type',index:'housing_type', width:200},
			{name:'num_in_party',index:'num_in_party', width:80},
			{name:'housed_by',index:'housed_by', width:150}
			],
		pager: '#reg-whos-not-housed-pager',
		rowNum:10,
		rowList:[10,20,30],
		sortname: 'last_name, first_name',
		sortorder: 'asc',
		viewrecords: true,
		width: 775,
		height: 230,
		hidegrid: false,
		caption:"Who's Not Yet Housed"
	}).navGrid('#reg-whos-not-housed',{edit:false,add:false,del:false});
});