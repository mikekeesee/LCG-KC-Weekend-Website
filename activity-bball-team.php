<?
	// **********************************************
	// *       Basketball Team Building Page        *
	// **********************************************

	// Get the database connection information
	include("db-connect.php");

	mysql_connect(localhost,$username,$password) or die("Unable to connect to database");
	mysql_select_db($database) or die("Unable to select database");

	// Get the stuff from the previous submit.
	$action			= $_POST["cboAction"];
	$action_index	= $_POST["hidActionIndex"];
	$team_name		= $_POST["team_name"];
	$change_name	= $_POST["change_name"];
	$team_id		= $_POST["gridTeam"];
	$person_id		= $_POST["gridPlayer"];
	$shirt_color	= $_POST["shirt_color"];
	$change_color	= $_POST["change_color"];

	if ($action_index == "") {
		$action_index = 0;
	}

	// Do nothing on page-load, at first
	$onLoadMessageBox = "\n";

	// Get the number of teams currently created
	$SQL = "SELECT COUNT(*) as count
			FROM Team
			WHERE Activity_ID = 1";

	$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT team count query.".mysql_error());
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$team_count = $row['count'];

	// Creating a New Team
	if ($action == "create_team") {
		// Defensive coding...  The check in Javascript should catch this.
		//if ($team_count >= 8) {
		//	$onLoadMessageBox = "alert('Sorry...  The maximum number of teams have been created. Check with one of the other teams to see if you can join them. Or bug Jake to make room for more teams.');";

		//} else {
			// Create the team
			$SQL = "INSERT INTO Team (
						Team_ID,
						Activity_ID,
						Team_Name,
						Shirt_Color)

					VALUES (
						NULL,
						1,
						'$team_name',
						'$shirt_color')";

			mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute INSERT Team query.".mysql_error());
			$team_id = mysql_insert_id();

			$SQL = "INSERT INTO Team_Member (
						Team_ID,
						Person_ID,
						Team_Captain_Ind)

					VALUES (
						$team_id,
						$person_id,
						1)";

			mysql_query( $SQL ) or die($SQL."\n\nCouldn't execute INSERT Team_Member query.".mysql_error());
		//}
	}

	// Adding a New Player
	if ($action == "add_player") {
		$SQL = "SELECT COUNT(*) as count
				FROM Team_Member
				WHERE Team_ID = $team_id";

		$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT team_member count query.".mysql_error());
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$team_member_count = $row['count'];

		if ($team_member_count >= 8) {
			$onLoadMessageBox = "alert('That team already has the maximum number of 8 players.');";

		} else {

			if ($arrPerson = explode(",", $person_id)) {
				if ($team_member_count + count($arrPerson) <= 8) {

					foreach ($arrPerson as $pid) {
						$SQL = "INSERT INTO Team_Member (
									Team_ID,
									Person_ID,
									Team_Captain_Ind)

								VALUES (
									$team_id,
									$pid,
									0)";

						mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT Team_Member query.".mysql_error());
					}
				} else {
					$onLoadMessageBox = "alert('This action would take you over the maximum number of 8 players.');";
				}
			}
		}
	}


	// Change the Team Name
	if ($action == "change_name") {
		$SQL = "UPDATE Team
				SET Team_Name = '$change_name'
				WHERE Team_ID = $team_id";

		mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute UPDATE Team query.".mysql_error());
	}

	// Changing the Team Captain
	if ($action == "change_captain") {
		$SQL = "SELECT	COUNT(*) as count
				FROM	Team_Member
				WHERE	Person_ID = $person_id
						AND Team_ID = $team_id";

		$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT team_member count query.".mysql_error());
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$team_member_count = $row['count'];

		if ($team_member_count == 0) {
			$onLoadMessageBox = "alert('Choose a player that\'s already on your team.');";

		} else {
			$SQL = "UPDATE	Team_Member
					SET		Team_Captain_Ind = 0
					WHERE	Team_ID = $team_id";

			mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT Team_Member query.".mysql_error());

			$SQL = "UPDATE	Team_Member
					SET		Team_Captain_Ind = 1
					WHERE	Team_ID = $team_id
							AND Person_Id = $person_id";

			mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT Team_Member query.".mysql_error());
		}
	}

	// Change the Team Color
	if ($action == "change_color") {
		$SQL = "UPDATE Team
				SET Shirt_Color = '$change_color'
				WHERE Team_ID = $team_id";

		mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute UPDATE Team query.".mysql_error());
	}

	// Removing a Player
	if ($action == "remove_player") {
		$SQL = "SELECT	COUNT(*) as count
				FROM	Team_Member
				WHERE	Person_ID IN ($person_id)
						AND Team_Captain_Ind = 1";

		$result = mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute SELECT team_member count query.".mysql_error());
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$team_captain_count = $row['count'];

		if ($team_captain_count == 1) {
			$onLoadMessageBox = "alert('You cannot remove a team captain.  Use the Change Team Captain action to choose another one before removing this player.');";

		} else {
			$SQL = "DELETE FROM Team_Member
					WHERE Person_Id IN ($person_id)";

			mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute INSERT Team_Member query.".mysql_error());
		}
	}

	// Delete the Team
	if ($action == "delete_team") {
		$SQL = "DELETE FROM Team
				WHERE Team_ID = $team_id";

		mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute DELETE Team query.".mysql_error());

		$SQL = "DELETE FROM Team_Member
				WHERE Team_ID = $team_id";

		mysql_query( $SQL ) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute DELETE Team_Member query.".mysql_error());
	}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Basketball</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />

	<? include "jqgrid-header.php" ?>
	
	<script type="text/javascript">
		var activity_number = '1';
		var activity_name = 'Basketball';
		var max_teams = 8; // this isn't currently used	

		function onLoad() {
			<? echo($onLoadMessageBox); ?>
			
			//document.getElementById("cboAction").selectedIndex = <?=$action_index?>;

			cboAction_onChange();

			return true;
		}
	</script>

	<script src="js/grid-activity-teams.js" type="text/javascript" ></script>
	<script src="js/grid-activity-players.js" type="text/javascript"></script>
	<script src="js/team-building.js" type="text/javascript"></script>
	
</head>

<body onload="onLoad();" style="background: #ffffff;">

	<p><b>What would you like to do?</b></p>

	<form id="activity-team" action="activity-bball-team.php" method="post">

		<select id="cboAction" name="cboAction" onchange="cboAction_onChange();">
			<option value="view_teams">View Current Teams</option>
			<option value="create_team">Create a New Team</option>
			<option value="add_player">Add a Player</option>
			<option value="change_name">Change Your Team Name</option>
			<option value="change_captain">Change Your Team Captain</option>
			<option value="change_color">Change Your Team Color</option>
			<option value="remove_player">Remove a Player</option>
			<option value="delete_team">Delete a Team</option>
		</select>

		<input type="hidden" name="hidActionIndex" id="hidActionIndex" />

		<br/>
		<br/>

		<div id="divCreateTeam" style="display:none">
			<p><b>First, type the name of your new team above.</b></p>

			<input type="text" id="team_name" name="team_name" size="40" maxlength="255" />

			<br/>
			<p><b>Next, if determined yet, enter your team color (shirt or jersey).</b></p>

			<input type="text" id="shirt_color" name="shirt_color" size="40" maxlength="255" />

			<br/><br/>
			<p><b>Then click the player below to be team captain (if they don&#39;t already have a team).</b></p>
		</div>

		<div id="divAddPlayer" style="display:none">
			<p><b>First, click your team, then highlight the player. <i>(Max. 8 players)</i></b></p>
		</div>

		<div id="divChangeName" style="display:none">
			<p><b>Type in the new name of your team.</p>

			<input type="text" id="change_name" name="change_name" size="40" maxlength="255" />

			<br/><br/>
			<p><b>Click the team to change.</b></p>
		</div>

		<div id="divChangeCaptain" style="display:none">
			<p><b>Click your team. Then click on the new team captain (that is
			already on the team selected).</b></p>
		</div>

		<div id="divChangeColor" style="display:none">
			<p><b>Next, if determined yet, enter your team color (shirt or jersey).</b></p>

			<input type="text" id="change_color" name="change_color" size="40" maxlength="255" />

			<br/><br/>
			<p><b>Then click the team below to change.</b></p>
		</div>

		<div id="divRemovePlayer" style="display:none">
			<p><b>Click your team. Then click the player to remove.</b></p>
		</div>

		<div id="divDeleteTeam" style="display:none">
			<p><b>Click the team to delete.</b></p>
		</div>

		<div style="position:relative;width:760px;height:250px;">
			<div id="divTeams" style="float:left;display:none;">
				<table id="teams"></table>
				<div id="teams-pager"></div>
				<input type="hidden" id="gridTeam" name="gridTeam" />
				<br/>
			</div>
			<div id="divSep" style="float:left;width:20px">&nbsp;&nbsp;&nbsp;&nbsp;</div>
			<div id="divPlayers" style="float:left;display:none">
				<table id="players"></table>
				<div id="players-pager"></div>
				<input type="hidden" id="gridPlayer" name="gridPlayer" />
				<br/>
			</div>
		</div>

		<div style="clear:both">
			<br /><br />
			<p>Finally, click Submit.</p>
			<input type="button" onclick="VerifyAndSubmit();" value="Submit" style="float:none" />
		</div>

	</form>

	<div class="clearthis">&nbsp;</div>

	<!-- End of Main Content Area -->

	<script type="text/javascript">
		$("input:button").button();
	</script>

</body>
</html>