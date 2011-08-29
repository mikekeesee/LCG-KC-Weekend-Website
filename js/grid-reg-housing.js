jQuery(document).ready(function() {
	jQuery("#reg-housing").jqGrid({
		url:'db-reg-housing.php',
		datatype: "xml",
		mtype: "GET",
		colNames:['First',
				  'Last',
				  'More?',
				  'Num Guests',
				  'Guest Names',
				  'Email',
				  'Phone',
				  'Address1',
				  'Addr2',
				  'City',
				  'St',
				  'Zip',
				  'Pets',
				  'Pet Info',
				  'Air Trans',
				  'Act. Trans',
				  'Cpls',
				  'Sngls',
				  'Girls',
				  'Boys',
				  'Adlt',
				  'Baby',
				  'Teen',
				  'Other'],
		colModel:[
			{name:'first_name', index:'first_name', width:80},
			{name:'last_name', index:'last_name', width:80},
			{name:'house_more', index:'house_more', width:30},
			{name:'how_many', index:'how_many', width:30},
			{name:'guest_names', index:'guest_names', width:100},
			{name:'email', index:'email', width:200},
			{name:'phone', index:'phone', width:110},
			{name:'addr1', index:'addr1', width:150},
			{name:'addr2', index:'addr2', width:45},
			{name:'city', index:'city', width:100},
			{name:'state', index:'state', width:30},
			{name:'zip', index:'zip', width:70},
			{name:'pets', index:'pets', width:30},
			{name:'pets_info', index:'pets_info', width:100},
			{name:'air_trans', index:'air_trans', width:30},
			{name:'act_trans', index:'act_trans', width:30},
			{name:'couples', index:'couples', width:30},
			{name:'singles', index:'singles', width:30},
			{name:'girls', index:'girls', width:30},
			{name:'boys', index:'boys', width:30},
			{name:'adults_only', index:'adults_only', width:30},
			{name:'babies', index:'babies', width:30},
			{name:'teens', index:'teens', width:30},
			{name:'other',index:'other', width:100}],
		rowNum:1000,
		rowList:[10,20,30],
		sortname: 'last_name, first_name',
		sortorder: 'asc',
		viewrecords: true,
		width: 1400,
		height: 230,
		hidegrid: false,
		subGrid : true,
		subGridUrl: 'db-sub-reg-housing-guests.php',
		subGridModel: [
			{name : ['First','Last','Email','Phone','# in Party'],
			 width : [100,100,200,100,60] }
			],
		caption:"Housing Contacts"
	});
});