<?
	// **********************************************
	// *     Registration Admin Submission Page     *
	// **********************************************

	// Get the database connection information
	include("db-connect.php");

	mysql_connect(localhost,$username,$password) or die("Unable to connect to database");
	mysql_select_db($database) or die("Unable to select database");


	$SQL = "SELECT	SUM(Payment_Amount) as total
			FROM	Registration_Payment";
	
	$result = mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute Registration SELECT count query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$total_payment = $row['total'];
	
	$SQL = "SELECT	COUNT(*) as count
			FROM 	Registration
			WHERE	done_housing_ind = 0
					AND Housing_Type IN (9)";

	$result = mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute Registration SELECT count query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$num_not_housed = $row['count'];

	// *** Get the visitor's graph information ***/
	$total = 0;
	// Get the current year's data
	$SQL = "SELECT	WEEK( registration_date ) AS week,
					SUM( number_in_party ) AS total				   
			FROM	Registration
			WHERE	housing_type IN ( 9, 10, 11, 12 ) 
			GROUP BY week
			ORDER BY week ASC";

	$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration SELECT query.".mysql_error());
	$graphData = "var dataCurrent = [";
	$bIsData = false;
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$bIsData = true;
		if ($total == 0) {
			$graphData .= "[".($row[week] - 1).",0],";
		}
		$graphData .= "[".$row[week].",";
		$total += $row[total];
		$graphData .= $total."],";
	}
	
	// Defensive code: If there's nothing to graph, this will cut off the [ of $graphData
	if ($bIsData == true) {
		$graphData = substr($graphData, 0, strlen($graphData) - 1);
	}
	$graphData .= "];";
	
	// Get the 2011 data
	mysql_select_db("mmoluf_kcweekend_2011") or die("Unable to select database");

	$total = 0;
	$graphDataQL = "SELECT	IFNULL(WEEK( registration_date ),47) AS week,
					SUM( number_in_party ) AS total				   
			FROM	Registration
			WHERE	housing_type IN ( 9, 10, 11, 12 ) 
			GROUP BY week
			ORDER BY week ASC";

	$result = mysql_query( $graphDataQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$graphDataQL."\n\nCouldn't execute registration SELECT query.".mysql_error());
	$graphData .= "\n\nvar data2011 = [";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		if ($total == 0) {
			$graphData .= "[".($row[week] - 1).",0],";
		}
		$graphData .= "[".$row[week].",";
		$total += $row[total];
		$graphData .= $total."],";
	}
	$graphData = substr($graphData, 0, strlen($graphData) - 1);
	$graphData .= "];";	
	
	// Get the 2012 data
	mysql_select_db("mmoluf_kcweekend_2012") or die("Unable to select database");

	$total = 0;
	$graphDataQL = "SELECT	IFNULL(WEEK( registration_date ),47) AS week,
					SUM( number_in_party ) AS total				   
			FROM	Registration
			WHERE	housing_type IN ( 9, 10, 11, 12 ) 
			GROUP BY week
			ORDER BY week ASC";

	$result = mysql_query( $graphDataQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$graphDataQL."\n\nCouldn't execute registration SELECT query.".mysql_error());
	$graphData .= "\n\nvar data2012 = [";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		if ($total == 0) {
			$graphData .= "[".($row[week] - 1).",0],";
		}
		$graphData .= "[".$row[week].",";
		$total += $row[total];
		$graphData .= $total."],";
	}
	$graphData = substr($graphData, 0, strlen($graphData) - 1);
	$graphData .= "];";	
	
	mysql_select_db($database) or die("Unable to select database");	
?>

<!DOCTYPE HTML>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Registration Administration</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="js/select2/select2.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="js/reveal/reveal.css" type="text/css" media="screen" />

	<? include "jqgrid-header.php" ?>
	<script type="text/javascript" src="js/grid-reg-statistics.js"></script>
	<script type="text/javascript" src="js/select2/select2.js"></script>
	<script src="js/reveal/jquery.reveal.js" type="text/javascript"></script>
	
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot/excanvas.min.js"></script><![endif]-->
    <script language="javascript" type="text/javascript" src="js/flot/jquery.flot.js"></script>
	
	<? include ('google-analytics.php'); ?>
</head>

<body>

<?	include "header.php"; ?>

	<!-- Start of Main Content Area -->

	<div class="main-content">

		<h2>Registration Administration</h2>

		<p><b>Registration Information Search:</b></p>
		<select id="reg-info-search" multiple>
<?
	$SQL = "	SELECT	person_id,
						CONCAT(last_name, ', ', first_name) AS full_name
				FROM Person
				ORDER BY last_name, first_name";

	$result = mysql_query( $SQL ) or die("</select><br/>Couldn't execute query.".mysql_error()."");

	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo "\t\t\t<option value='".$row[person_id]."'>".htmlspecialchars($row[full_name])."</option>\n";
	}
?>
		</select>
		<input type="button" id="get-reg-info" value="Go" />

		<br/>
		<hr/>
		<br/>
		
		<div class="column">
			<div id="div-grid-reg-statistics">
				<table id="reg-statistics"></table>
			</div>		
		</div>
			
		<div>
			<p><a href="#" id="not-housed-link" data-reveal-id="not-housed-modal"><b>There are currently <?=$num_not_housed?> families/groups not housed.</b></a></p>
			
			<p>Please choose from the links or reports below:</p>
			<ul>
				<li><a href="reg-admin-housing.php">Create a Housing Contact</a></li>
				<li><a href="reg-admin-add-guest-to-housing.php">Add Guests to a Housing Contact</a></li>
				<li><a href="reg-admin-add-money.php">Record a Payment from a Registered Family/Group</a></li>
				<li><a href="reg-admin-email-lists.php">Generate an Email List</a></li>
				<li><a href="activity-vball-team.php" target="_blank">Modify Volleyball Teams</a></li>
				<li><a href="activity-bball-team.php" target="_blank">Modify Basketball Teams</a></li>
			</ul>
		</div>
		
		<div id="not-housed-modal" class="reveal-modal">
			<h2>Families Not Housed</h2>
			<p id="not-housed-label">Click a family below to show their registration details.</p>
			<a class="close-reveal-modal" id="close-add-guests">&#215;</a>
		</div>
		
		<div class="clear-float">
		</div>
		
		<br/>
		<hr/>
		<br/>

		<div class="column">
			<b>Visitor's Registration Graph</b>
			<br/><br/>
			<div id="regGraph" style="width:300px;height:400px;"></div>
		</div>
		<div class="column">
			<p>
				<b>The KC Weekend has currently generated $<?=$total_payment?>.00 in donations with a goal of $3700.</b>
				<br/>
				<div class="progress-bar green glow">
					<span style="width: <?=intval(($total_payment/3700)*100) ?>%"></span>
				</div>
			</p>
		</div>
	</div>
	<div class="clear-float"></div>
	
	<!-- End of Main Content Area -->

	<!-- Start of Page Footer -->

	<? include "footer.php" ?>

	<script type="text/javascript">		
		$("#reg-info-search").select2({
			placeholder: "Search for a person...",
			width: "40em"
		});

		$(document).ready(function() {
			$("#get-reg-info").button().click(function() {
				personIds = $("#reg-info-search").select2("val") || [];
				for (var i = 0; i < personIds.length; i++) {
					window.open("reg-admin-person.php?id=" + personIds[i], '_blank');
				}				
				
				$("#reg-info-search").select2("val", "");
			});

			function ShowWhosNotHoused(data) {
				$(".guest-name").remove();
				
				if (data.records > 0) {
					for (var i = 0; i < data.records; i++) {
						var row = data.rows[i];
						if (row.cell[9] == 9) {
							$("#not-housed-label").after("<h3 class='guest-name'><a href='reg-admin-person.php?id=" + row.cell[8] + "' target='_blank'>" + row.cell[0] + " " + row.cell[1] + "</a></h3>");
						}
					}
				} else {
					$("#not-housed-label").after("<h3 class='guest-name'>Good job! No one needs our services today...</h3>");
				}
			}
			
			$("#not-housed-link").bind("click", function() {
				$.ajax({
					url:"db-reg-whos-not-housed.php", 
					async: true, 
					type: "get", 
					data: {page: 1,
						   rows: 100,
						   sidx: 1,
						   sord: "asc"},
					success: ShowWhosNotHoused,
					error: function(xhr, text, e) {alert("Error getting data - " + text); return;}
				});						
			});

			<?=$graphData ?>		

			var p = $.plot($("#regGraph"), [
					{label: "2013", data: dataCurrent}, 
					{label: "2012", data: data2012}, 
					{label: "2011", data: data2011}
				], {legend: {position: "nw"}}, {
				series: {
					lines: { show: true },
					points: { show: true }
				}
			});

			$.each(p.getData(), function(idx, el){
				$.each(p.getData()[idx].data, function(i, el){
				  var o = p.pointOffset({x: el[0], y: el[1]});
				  $('<div class="data-point-label">' + el[1] + '</div>').css( {
					left: o.left + 4,
					top: o.top + 4,
					display: 'none',
					font: '9px arial',
					color: '#ABABAB',
					position: 'absolute'
				  }).appendTo(p.getPlaceholder()).fadeIn("slow");
				});
			});
		});
	</script>
	
</body>
</html>

<? mysql_close(); ?>
