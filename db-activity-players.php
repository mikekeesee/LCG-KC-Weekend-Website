<?php

// Get the database connection information
include("db-connect.php");

// to the url parameter are added 4 parameters as described in colModel
// we should get these parameters to construct the needed query
// Since we specify in the options of the grid that we will use a GET method
// we should use the appropriate command to obtain the parameters.
// In our case this is $_GET. If we specify that we want to use post
// we should use $_POST. Maybe the better way is to use $_REQUEST, which
// contain both the GET and POST variables. For more information refer to php documentation.
// Get the requested page. By default grid sets this to 1.
$page = $_GET['page'];

// get how many rows we want to have into the grid - rowNum parameter in the grid
$limit = $_GET['rows'];

// get index row - i.e. user click to sort. At first time sortname parameter -
// after that the index from colModel
$sidx = $_GET['sidx'];

// sorting order - at first time sortorder
$sord = $_GET['sord'];

$activity = $_GET['activity'];

$team_id = $_GET['team_id'];

if(!$sidx) $sidx = 1;

$link = mysqli_connect(localhost, $username, $password, $database);

$result = mysqli_query($link, "SELECT COUNT(*) AS count FROM Person_Activity WHERE Activity_ID = $activity");

$row = mysqli_fetch_array($result);
$count = $row['count'];

if( $count > 0 ) {
	$total_pages = ceil($count / $limit);
} else {
	$total_pages = 0;
}

if ($page > $total_pages)
	$page=$total_pages;

$start = $limit * $page - $limit; // do not put $limit*($page - 1)

// If no team, get everyone
// If team = NULL, get players without teams
// IF team != "", get players on a team

$other_players = "
			SELECT	pa.Person_ID as person_id,
					p.Last_Name as last_name,
					p.First_Name as first_name,
					'' as team_name
			
			FROM Person_Activity pa
			
				INNER JOIN Person p
					ON pa.Person_ID = p.Person_ID
						
			WHERE pa.Activity_ID = $activity AND pa.Person_ID NOT IN (
				SELECT pa2.Person_ID
				FROM Person_Activity pa2
					INNER JOIN Team_Member tm2
						ON pa2.Person_ID = tm2.Person_ID
			
					INNER JOIN Team t2
						ON tm2.Team_ID = t2.Team_ID
						AND t2.Activity_ID = $activity)";

$team_players = "
			SELECT	pa.Person_ID as person_id,
					p.Last_Name as last_name,
					p.First_Name as first_name,
					IFNULL(t.Team_Name, '') as team_name
			
			FROM Person_Activity pa
			
				INNER JOIN Person p
					ON pa.Person_ID = p.Person_ID
					
				INNER JOIN Team_Member tm
					ON p.Person_ID = tm.Person_ID
			
				INNER JOIN Team t
					ON tm.Team_ID = t.Team_ID
				   AND t.Activity_ID = $activity
	
			WHERE pa.Activity_ID = $activity";
						
if ($team_id == "NULL") {
	$SQL = $other_players;
} else if ($team_id != "") {
	$SQL = $team_players."	AND t.Team_ID = $team_id";
} else {
	$SQL = $other_players." UNION ".$team_players;
}
					
$SQL .= "			ORDER BY $sidx $sord LIMIT $start , $limit";
$result = mysqli_query($link,  $SQL ) or die("Couldn't execute query.".mysqli_error($link));

// we should set the appropriate header information. Do not forget this.
header("Content-type: text/xml;charset=utf-8");

$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .= "<rows>";
$s .= "<page>".$page."</page>";
$s .= "<total>".$total_pages."</total>";
$s .= "<records>".$count."</records>";

while($row = mysqli_fetch_array($result)) {
	$s .= "<row id='". $row[person_id]."'>";
	$s .= "<cell>". htmlspecialchars($row[last_name])."</cell>";
	$s .= "<cell>". htmlspecialchars($row[first_name])."</cell>";
	$s .= "<cell>". htmlspecialchars($row[team_name])."</cell>";
	$s .= "</row>";
}
$s .= "</rows>";

echo $s;

mysqli_close($link);

?>
