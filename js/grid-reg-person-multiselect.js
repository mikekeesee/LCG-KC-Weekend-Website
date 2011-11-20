jQuery(document).ready(function() {
	jQuery("#reg-person-multiselect").jqGrid({
		url:'db-reg-person.php?admin=0',
		datatype: "xml",
		mtype: "GET",
		colNames:['First', 'Last'],
		colModel:[
			{name:'first_name', index:'first_name', width:150},
			{name:'last_name',index:'last_name', width:200}],
		rowNum: 1500,
		sortname: 'last_name, first_name',
		sortorder: 'asc',
		viewrecords: true,
		multiselect: true,
		width: 450,
		height: 345,
		hidegrid: false,
		caption:"Who's Registered So Far"
	}).navGrid('#reg-person',{edit:false,add:false,del:false});
});
