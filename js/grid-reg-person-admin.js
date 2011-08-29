jQuery(document).ready(function() {
	jQuery("#reg-person-admin").jqGrid({
		url:'db-reg-person.php?admin=1',
		datatype: "xml",
		mtype: "GET",
		colNames:['First', 'Last', 'Sex', 'Group', 'Email', 'Phone'],
		colModel:[
			{name:'first_name', index:'first_name', width:100},
			{name:'last_name',index:'last_name', width:105},
			{name:'sex',index:'sex', width:50},
			{name:'age_range',index:'age_range', width:70},
			{name:'email',index:'email', width:200},
			{name:'phone',index:'phone', width:130} ],
		pager: jQuery('#reg-person-admin-pager'),
		rowNum:10,
		rowList:[10,20,30],
		sortname: 'last_name, first_name',
		sortorder: 'asc',
		viewrecords: true,
		width: 755,
		height: 235,
		hidegrid: false,
		caption:"Who's Registered"
	}).navGrid('#reg-person=admin',{edit:false,add:false,del:false});
});