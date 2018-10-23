<?
$password = "Mr. Millich";
$nonsense = "hithertoIhavedeclaredthewondersthouhastwrought";

if (isset($_COOKIE['KCWeekendRegAdminPageLogin'])) {
   if ($_COOKIE['KCWeekendRegAdminPageLogin'] == md5($password.$nonsense)) {
	// **********************************************
	// *     Registration Admin Submission Page     *
	// **********************************************

	// Get the database connection information
	include("db-connect.php");

	$link = mysqli_connect(localhost, $username, $password, $database);


	$SQL = "SELECT	SUM(Payment_Amount) as total,
                    SUM(Amount_Due) as due
			FROM	Registration_Payment";
	
	$result = mysqli_query($link, $SQL) or die($SQL."\n\nCouldn't execute Registration SELECT count query.".mysqli_error($link));
	$row = mysqli_fetch_array($result);
	$total_payment = $row['total'];
    $total_due = $row['due'];
	
	$SQL = "SELECT	COUNT(*) as count
			FROM 	Registration
			WHERE	done_housing_ind = 0
					AND Housing_Type IN (9)";

	$result = mysqli_query($link, $SQL) or die($SQL."\n\nCouldn't execute Registration SELECT count query.".mysqli_error($link));
	$row = mysqli_fetch_array($result);
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

	$result = mysqli_query($link, $SQL) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute registration SELECT query.".mysqli_error($link));
	$graphData = "var dataCurrent = [";
	$bIsData = false;
	while($row = mysqli_fetch_array($result)) {
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
	
	// Get the 2014 data
	mysqli_select_db($link, "awesom72_kcweekend_2014") or die("Unable to select database - 2014");

	$total = 0;
	$graphDataQL = "SELECT	IFNULL(WEEK( registration_date ),47) AS week,
					SUM( number_in_party ) AS total				   
			FROM	Registration
			WHERE	housing_type IN ( 9, 10, 11, 12 ) 
			GROUP BY week
			ORDER BY week ASC";

	$result = mysqli_query($link, $graphDataQL) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$graphDataQL."\n\nCouldn't execute registration SELECT query.".mysqli_error($link));
	$graphData .= "\n\nvar data2014 = [";
	while($row = mysqli_fetch_array($result)) {
		if ($total == 0) {
			$graphData .= "[".($row[week] - 1).",0],";
		}
		$graphData .= "[".$row[week].",";
		$total += $row[total];
		$graphData .= $total."],";
	}
	$graphData = substr($graphData, 0, strlen($graphData) - 1);
	$graphData .= "];";	
	

	// Get the 2015 data
	mysqli_select_db($link, "awesom72_kcweekend_2015") or die("Unable to select database - 2015");

	$total = 0;
	$graphDataQL = "SELECT	IFNULL(WEEK( registration_date ),47) AS week,
					SUM( number_in_party ) AS total				   
			FROM	Registration
			WHERE	housing_type IN ( 9, 10, 11, 12 ) 
			GROUP BY week
			ORDER BY week ASC";

	$result = mysqli_query($link, $graphDataQL) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$graphDataQL."\n\nCouldn't execute registration SELECT query.".mysqli_error($link));
	$graphData .= "\n\nvar data2015 = [";
	while($row = mysqli_fetch_array($result)) {
		if ($total == 0) {
			$graphData .= "[".($row[week] - 1).",0],";
		}
		$graphData .= "[".$row[week].",";
		$total += $row[total];
		$graphData .= $total."],";
	}
	$graphData = substr($graphData, 0, strlen($graphData) - 1);
	$graphData .= "];";	

    // This line resets back to the LIVE database set up for this domain...
	mysqli_select_db($link, $database) or die("Unable to select database - 2015");	

	// Get the 2016 data
	mysqli_select_db($link, "awesom72_kcweekend_2016") or die("Unable to select database - 2016");

	$total = 0;
	$graphDataQL = "SELECT	IFNULL(WEEK( registration_date ),47) AS week,
					SUM( number_in_party ) AS total				   
			FROM	Registration
			WHERE	housing_type IN ( 9, 10, 11, 12 ) 
			GROUP BY week
			ORDER BY week ASC";

	$result = mysqli_query($link, $graphDataQL) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$graphDataQL."\n\nCouldn't execute registration SELECT query.".mysqli_error($link));
	$graphData .= "\n\nvar data2016 = [";
	while($row = mysqli_fetch_array($result)) {
		if ($total == 0) {
			$graphData .= "[".($row[week] - 1).",0],";
		}
		$graphData .= "[".$row[week].",";
		$total += $row[total];
		$graphData .= $total."],";
	}
	$graphData = substr($graphData, 0, strlen($graphData) - 1);
	$graphData .= "];";	

	// Get the 2017 data
	mysqli_select_db($link, "awesom72_kcweekend_2017") or die("Unable to select database - 2017");

	$total = 0;
	$graphDataQL = "SELECT	IFNULL(WEEK( registration_date ),47) AS week,
					SUM( number_in_party ) AS total				   
			FROM	Registration
			WHERE	housing_type IN ( 9, 10, 11, 12 ) 
			GROUP BY week
			ORDER BY week ASC";

	$result = mysqli_query($link, $graphDataQL) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$graphDataQL."\n\nCouldn't execute registration SELECT query.".mysqli_error($link));
	$graphData .= "\n\nvar data2017 = [";
	while($row = mysqli_fetch_array($result)) {
		if ($total == 0) {
			$graphData .= "[".($row[week] - 1).",0],";
		}
		$graphData .= "[".$row[week].",";
		$total += $row[total];
		$graphData .= $total."],";
	}
	$graphData = substr($graphData, 0, strlen($graphData) - 1);
	$graphData .= "];";	

    // This line resets back to the LIVE database set up for this domain...
	mysqli_select_db($link, $database) or die("Unable to select database - 2016");	

    // This line resets back to the LIVE database set up for this domain...
	mysqli_select_db($link, $database) or die("Unable to select database - 2016");	

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

	$result = mysqli_query($link, $SQL) or die("</select><br/>Couldn't execute query.".mysqli_error($link)."");

	while($row = mysqli_fetch_array($result)) {
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
				<li><a href="activity-add-activity.php" target="_blank">Add/Modify Individual Activities</a></li>
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
				<b>The KC Weekend has currently generated $<?=$total_payment?> in donations with the amount owed of $<?=intval($total_due + 300) ?>.00.</b>
				<br/>
				<div class="progress-bar green glow">
					<span style="width: <?=intval(($total_payment/intval($total_due + 300))*100) ?>%"></span>
				</div>
			</p>
		</div>
	</div>
	<div class="clear-float"></div>
	
	<!-- End of Main Content Area -->

	<!-- Start of Page Footer -->

	<? include "footer.php" ?>

	<script type="text/javascript" src="js/grid-reg-statistics.js"></script>
	<script type="text/javascript" src="js/select2/select2.js"></script>
	<script src="js/reveal/jquery.reveal.js" type="text/javascript"></script>
	
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot/excanvas.min.js"></script><![endif]-->
    <script language="javascript" type="text/javascript" src="js/flot/jquery.flot.js"></script>
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
					{label: "2018", data: dataCurrent}, 
					{label: "2017", data: data2017}, 
					{label: "2016", data: data2016}, 
					{label: "2015", data: data2015}, 
					{label: "2014", data: data2014}
					//{label: "2013", data: data2013}, 
					//{label: "2012", data: data2012}, 
					//{label: "2011", data: data2011}
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

<? 			mysqli_close($link);
		exit;
   } else { // The cookie is bad, so expire it and reload the page. It will delete the cookie on most browsers (I hope).
		setcookie("KCWeekendRegAdminPageLogin", "", time()-3600);
		header("Location: $_SERVER[PHP_SELF]");
   }
}

if (isset($_GET['p']) && $_GET['p'] == "login") {
	if ($_POST['keypass'] != $password) {
      echo "Sorry, that password does not match. Press Back to try again...";
      exit;
   } else if ($_POST['keypass'] == $password) {
      setcookie('KCWeekendRegAdminPageLogin', md5($_POST['keypass'].$nonsense), time() + 60*60*24*30);
      header("Location: $_SERVER[PHP_SELF]");
   } else {
      echo "Sorry, something is not working correctly. Perhaps you don't have cookies enabled, or it's time to buy that new computer you want. :) Press Back to try again...";
   }
}

include('secure.php');
?>

