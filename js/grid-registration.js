jQuery(document).ready(function() {
	jQuery("#reg-registration").jqGrid({
		url:'db-registration.php',
		datatype: "xml",
		mtype: "GET",
		colNames:['First', 'Last', 'Email', 'Phone', 'Home City', '# Party', '# Dining', 'Dining', 'Due', 'Paid'],
		colModel:[
			{name:'first_name', index:'first_name', width:55},
			{name:'last_name',index:'last_name', width:55},
			{name:'email', index:'email', width:100},
			{name:'phone', index:'phone', width:60},
			{name:'home_city', index:'home_city', width:80},
			{name:'num_in_party', index:'num_in_party', width:10},
            {name:'num_dining', index:'num_dining', width:100},
			{name:'dining', index:'dining', width:60},
			{name:'due', index:'due', width:60},
			{name:'paid', index:'paid', width:60}],
		rowNum: 1000,
		sortname: 'last_name, first_name',
		sortorder: 'asc',
		viewrecords: true,
		width: 950,
		height: 245,
		hidegrid: false,
		subGrid : true,
		subGridUrl: 'db-sub-reg-person.php',
		subGridModel: [
			{name : ['First','Last','Group','Email','Phone'],
			 width : [60,60,120,160,75] }
			],
		caption:"Registration Information"
	});
});