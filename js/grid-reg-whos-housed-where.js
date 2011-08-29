jQuery(document).ready(function() {
	jQuery("#whos-housed-where").jqGrid({
		url:'db-reg-whos-housed.php',
		datatype: "xml",
		mtype: "GET",
		colNames:['First', 'Last', 'Email', 'Phone', 'Housing Type', '# in Party'],
		colModel:[
			{name:'first_name', index:'first_name', width:100},
			{name:'last_name',index:'last_name', width:100},
			{name:'email',index:'email', width:200},
			{name:'phone',index:'phone', width:130},
			{name:'housing_type',index:'housing_type', width:200},
			{name:'num_in_party',index:'num_in_party', width:60}
			],
		pager: '#whos-housed-where-pager',
		rowNum:10,
		rowList:[10,20,30],
		width: 954,
		height: 230,
		sortname: 'last_name,first_name',
		sortorder: 'asc',
		viewrecords: true,
		multiselect: false,
		hidegrid: false,
		subGrid : true,
		subGridUrl: 'db-sub-reg-housing-contacts.php',
		subGridModel: [
			{name : ['First','Last','Email','Phone','Address 1','Address 2','City','State','Zip'],
			 width : [100,100,200,100,150,40,90,40,60] }
			],
		caption:"Who's Staying Where"
	}).navGrid('#whos-housed-where',{edit:false,add:false,del:false});
});