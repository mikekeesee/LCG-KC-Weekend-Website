jQuery(document).ready(function() {
	jQuery("#reg-person").jqGrid({
		url:'db-reg-person.php?admin=0',
		datatype: "xml",
		mtype: "GET",
		colNames:['First', 'Last'],
		colModel:[
			{name:'first_name', index:'first_name', width:100},
			{name:'last_name',index:'last_name', width:100}],
		rowNum: 1500,
		sortname: 'last_name, first_name',
		sortorder: 'asc',
		viewrecords: true,
		width: 250,
		height: 345,
		hidegrid: false,
		caption:"Who's Registered So Far"
	}).navGrid('#reg-person',{edit:false,add:false,del:false});
});
