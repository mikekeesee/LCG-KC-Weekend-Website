jQuery(document).ready(function() {
	jQuery("#reg-whos-housed-where").jqGrid({
		url:'db-reg-whos-housed.php',
		datatype: "xml",
		mtype: "GET",
		colNames:['First', 'Last', 'Email', 'Phone', 'Home City', 'Housing Type', '# in Party'],
		colModel:[
			{name:'first_name', index:'first_name', width:100},
			{name:'last_name',index:'last_name', width:100},
			{name:'email',index:'email', width:175},
			{name:'phone',index:'phone', width:130},
			{name:'home_city', index:'home_city', width:150},
			{name:'housing_type',index:'housing_type', width:200},
			{name:'num_in_party',index:'num_in_party', width:60}
			],
		rowNum:1000,
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
	});
});