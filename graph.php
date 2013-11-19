<?
	// **********************************************
	// *     Registration Admin Submission Page     *
	// **********************************************

	// Get the database connection information
	include("db-connect.php");

	mysql_connect(localhost,$username,$password) or die("Unable to connect to database");
	mysql_select_db($database) or die("Unable to select database");

	$total = 0;

	// Get the current year's data
	$SQL = "SELECT	WEEK( registration_date ) AS week,
					SUM( number_in_party ) AS total				   
			FROM	Registration
			WHERE	housing_type IN ( 9, 10, 11, 12 ) 
			GROUP BY week
			ORDER BY week ASC";

	$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration SELECT query.".mysql_error());
	$s = "var dataCurrent = [";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		if ($total == 0) {
			$s .= "[".($row[week] - 1).",0],";
		}
		$s .= "[".$row[week].",";
		$total += $row[total];
		$s .= $total."],";
	}
	$s = substr($s, 0, strlen($s) - 1);
	$s .= "];";
	
	// Get the 2011 data
	mysql_select_db("mmoluf_kcweekend_2011") or die("Unable to select database");

	$total = 0;
	$SQL = "SELECT	IFNULL(WEEK( registration_date ),47) AS week,
					SUM( number_in_party ) AS total				   
			FROM	Registration
			WHERE	housing_type IN ( 9, 10, 11, 12 ) 
			GROUP BY week
			ORDER BY week ASC";

	$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration SELECT query.".mysql_error());
	$s .= "\n\nvar data2011 = [";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		if ($total == 0) {
			$s .= "[".($row[week] - 1).",0],";
		}
		$s .= "[".$row[week].",";
		$total += $row[total];
		$s .= $total."],";
	}
	$s = substr($s, 0, strlen($s) - 1);
	$s .= "];";
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Registration Administration</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
	
	<? include "jqgrid-header.php" ?>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot/excanvas.min.js"></script><![endif]-->
    <script language="javascript" type="text/javascript" src="js/flot/jquery.flot.js"></script>
</head>
<body>
    <div id="placeholder" style="width:600px;height:300px;"></div>
	
	<script type="text/javascript">
		<?=$s ?>
		$.plot($("#placeholder"), [
				{label: "2012", data: dataCurrent}, 
				{label: "2011", data: data2011}
			], {
			series: {
				lines: { show: true },
				points: { show: true }
			}
		});
	</script>
</body>
</html>