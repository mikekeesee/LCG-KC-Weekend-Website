jQuery(document).ready(function() {
	jQuery("#reg-whos-not-housed").jqGrid({
		url:'db-reg-whos-not-housed.php',
		datatype: "json",
		mtype: "GET",
		colNames:['First', 'Last', 'Email', 'Phone', 'Home City', 'Housing Type', '# in Party', 'Housed By Notes'],
		colModel:[
			{name:'first_name', index:'first_name', width:100},
			{name:'last_name',index:'last_name', width:100},
			{name:'email',index:'email', width:175},
			{name:'phone',index:'phone', width:130},
			{name:'home_city', index:'home_city', width:150},
			{name:'housing_type',index:'housing_type', width:200},
			{name:'num_in_party',index:'num_in_party', width:80},
			{name:'housed_by',index:'housed_by', width:150}
			],
		rowNum:1000,
		rowList:[10,20,30],
		sortname: 'last_name, first_name',
		sortorder: 'asc',
		viewrecords: true,
		width: 500,
		height: 230,
		shrinkToFit: false,
		onSelectRow: function(id) {try {GetNumInParty();} catch(err){}},
		hidegrid: false,
		caption:"Who's Not Yet Housed"
	});
});