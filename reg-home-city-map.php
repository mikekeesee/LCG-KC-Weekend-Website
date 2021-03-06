<?php
	// Get the database connection information
	include("db-connect.php");

	require('GoogleMapAPI.class.php');

	$map = new GoogleMapAPI('map');
	// enter YOUR Google Map Key
	//$map->setAPIKey('ABQIAAAAYMNY23sJhxC4LyHvhouDAhT7jkmynjE8OMd-ikFKdpPdtz0ExRS8CQW29gereurYlNrENJbQEdpvYQ');
	//$map->setAPIKey('ABQIAAAAYMNY23sJhxC4LyHvhouDAhTO1sTMmm0paPF-NqNRX-WjGyPHxxQNKDjpAKmhd7DBMSBEWqs826zUrw');
    //$map->setAPIKey('AIzaSyCay9f5poJilMsp4vzmXEEM-dMM1PwSll8');
    $map->setAPIKey('AIzaSyAKzpDaa0hmqDyz3hcFgLctLxAB6Vm-LrQ');
	$map->disableSidebar();
	
	$link = mysqli_connect(localhost, $username, $password, $database);
	//$connection = @mysql_select_db($database) or die( "Unable to select database");

	$SQL = "	SELECT DISTINCT p.first_name,
								p.last_name,
								r.home_city,
								r.geo_lat,
								r.geo_long
						
				FROM Registration r
					INNER JOIN Registration_Person rp
                        ON r.Registration_ID = rp.Registration_ID AND
                           rp.Main_Contact_Ind = 1
                        
					INNER JOIN Person p
						ON rp.Person_ID = p.Person_ID
				
				WHERE r.geo_lat IS NOT NULL
				  AND TRIM(r.geo_lat) <> ''
				  AND r.geo_long IS NOT NULL
  				  AND TRIM(r.geo_long) <> ''";

	$result = mysqli_query($link, $SQL) or die("Couldn't execute query.".mysql_error());	
	
	while($row = mysqli_fetch_assoc($result)) {	
		// create some map markers
		$map->addMarkerByCoords($row[geo_lat],$row[geo_long],'<b>'.$row[first_name].' '.$row[last_name].'<br/>'.$row[home_city].'</b>');
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Housing</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />

    <? $map->printHeaderJS(); ?>
    <? $map->printMapJS(); ?>
    <!-- necessary for google maps polyline drawing in IE -->
    <style type="text/css">
      v\:* {
        behavior:url(#default#VML);
      }
    </style>	

	<? include ('google-analytics.php'); ?>
</head>

<body onload="onLoad()">
	<!-- Start of Main Content Area -->

	<div id="main-content">

		<h3>Where Are You From??</h3>
		<? $map->printMap(); ?>

		<div class="clear-float"></div>
		
	</div>

	<!-- End of Main Content Area -->

</body>
</html>