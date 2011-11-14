jQuery(document).ready(function() {
	jQuery("#reg-statistics").jqGrid({
		url:'db-reg-statistics.php',
		datatype: "xml",
		mtype: "GET",
		colNames:['Type', 'Value'],
		colModel:[
			{name:'type', index:'type', width:200},
			{name:'value', index:'value', width:70}],
		rowNum: 50,
		viewrecords: true,
		width: 300,
		height: 305,
		hidegrid: false,
		caption:"KC Weekend Statistics"
	});
});