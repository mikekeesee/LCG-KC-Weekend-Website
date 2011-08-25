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

	<link rel="stylesheet" href="page.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" media="screen" href="js/css/start/jquery-ui-1.7.2.custom.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="js/css/ui.jqgrid.css" />

	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script src="js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.jqGrid.min.js"></script>

	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery("#teams").jqGrid({
				url:'db-activity-teams.php?activity=1',
				datatype: "xml",
				mtype: "GET",
				colNames:['Team Name','Captain','Team Color'],
				colModel:[
					{name:'team_name', index:'team_name', width:200},
					{name:'captain', index:'captain', width:150},
					{name:'shirt_color', index:'shirt_color', width:150}
					],
				width: 350,
				height: 230,
				sortname: 'team_name',
				sortorder: 'asc',
				viewrecords: true,
				multiselect: false,
				hidegrid: false,
				subGrid : true,
				subGridUrl: 'db-sub-activity-team-members.php',
				subGridModel: [
					{name : ['First','Last'],
					 width : [150,150] }
					],
				onSelectRow: function(id) {onSelectRow(id);},
				caption:"Basketball Teams"
			});
		});

		jQuery(document).ready(function() {
			jQuery("#players").jqGrid({
				url:'db-activity-players.php?activity=1',
				datatype: "xml",
				mtype: "GET",
				colNames:['Last Name', 'First Name','Team Name'],
				colModel:[
					{name:'last_name', index:'last_name', width:100},
					{name:'first_name', index:'first_name', width:100},
					{name:'team_name', index:'team_name', width:125}
					],
				width: 330,
				height: 230,
				rowNum: 100,
				sortname: 'last_name,first_name',
				sortorder: 'asc',
				viewrecords: true,
				multiselect: true,
				hidegrid: false,
				caption:"Basketball Players"
			});
		});

		function onLoad() {
			<?=$onLoadMessageBox?>

			//document.getElementById("cboAction").selectedIndex = <?=$action_index?>;

			cboAction_onChange();

			return true;
		}

		function onSelectRow(id) {
			var cboAction = document.getElementById("cboAction");
			var action = cboAction.options[cboAction.selectedIndex].value;

			switch (action) {
				case "change_captain":
				case "remove_player":
					$("#players").setGridParam({url: "db-activity-players.php?activity=1&team_id=" + id});
					$("#players").trigger("reloadGrid");
			}
		}

		// This function handles what the page displays.
		function cboAction_onChange() {
			var cboAction = document.getElementById("cboAction");
			var action = cboAction.options[cboAction.selectedIndex].value;

			switch (action) {
				case "view_teams":
					document.getElementById("divTeams").style.display = "";
					document.getElementById("divSep").style.display = "none";
					document.getElementById("divPlayers").style.display = "none";
					document.getElementById("divCreateTeam").style.display = "none";
					document.getElementById("divAddPlayer").style.display = "none";
					document.getElementById("divChangeName").style.display = "none";
					document.getElementById("divChangeCaptain").style.display = "none";
					document.getElementById("divChangeColor").style.display = "none";
					document.getElementById("divRemovePlayer").style.display = "none";
					document.getElementById("divDeleteTeam").style.display = "none";

					$("#players").setGridParam({url: "db-activity-players.php?activity=1&team_id=NULL"});
					$("#players").trigger("reloadGrid");

					$("#teams").resetSelection();
					$("#players").resetSelection();
				break;

				case "create_team":
					document.getElementById("divTeams").style.display = "none";
					document.getElementById("divSep").style.display = "none";
					document.getElementById("divPlayers").style.display = "";
					document.getElementById("divCreateTeam").style.display = "";
					document.getElementById("divAddPlayer").style.display = "none";
					document.getElementById("divChangeName").style.display = "none";
					document.getElementById("divChangeCaptain").style.display = "none";
					document.getElementById("divChangeColor").style.display = "none";
					document.getElementById("divRemovePlayer").style.display = "none";
					document.getElementById("divDeleteTeam").style.display = "none";

					$("#players").setGridParam({url: "db-activity-players.php?activity=1&team_id=NULL"});
					$("#players").trigger("reloadGrid");

					$("#teams").resetSelection();
					$("#players").resetSelection();
				break;

				case "add_player":
					document.getElementById("divTeams").style.display = "";
					document.getElementById("divSep").style.display = "";
					document.getElementById("divPlayers").style.display = "";
					document.getElementById("divCreateTeam").style.display = "none";
					document.getElementById("divAddPlayer").style.display = "";
					document.getElementById("divChangeName").style.display = "none";
					document.getElementById("divChangeCaptain").style.display = "none";
					document.getElementById("divChangeColor").style.display = "none";
					document.getElementById("divRemovePlayer").style.display = "none";
					document.getElementById("divDeleteTeam").style.display = "none";

					$("#players").setGridParam({url: "db-activity-players.php?activity=1&team_id=NULL"});
					$("#players").trigger("reloadGrid");

					$("#teams").resetSelection();
					$("#players").resetSelection();
				break;

				case "change_name":
					document.getElementById("divTeams").style.display = "";
					document.getElementById("divSep").style.display = "none";
					document.getElementById("divPlayers").style.display = "none";
					document.getElementById("divCreateTeam").style.display = "none";
					document.getElementById("divAddPlayer").style.display = "none";
					document.getElementById("divChangeName").style.display = "";
					document.getElementById("divChangeCaptain").style.display = "none";
					document.getElementById("divChangeColor").style.display = "none";
					document.getElementById("divRemovePlayer").style.display = "none";
					document.getElementById("divDeleteTeam").style.display = "none";

					$("#teams").resetSelection();
					$("#players").resetSelection();
				break;

				case "change_captain":
					document.getElementById("divTeams").style.display = "";
					document.getElementById("divSep").style.display = "";
					document.getElementById("divPlayers").style.display = "";
					document.getElementById("divCreateTeam").style.display = "none";
					document.getElementById("divAddPlayer").style.display = "none";
					document.getElementById("divChangeName").style.display = "none";
					document.getElementById("divChangeCaptain").style.display = "";
					document.getElementById("divChangeColor").style.display = "none";
					document.getElementById("divRemovePlayer").style.display = "none";
					document.getElementById("divDeleteTeam").style.display = "none";

					$("#players").setGridParam({url: "db-activity-players.php?activity=1"});
					$("#players").trigger("reloadGrid");

					$("#teams").resetSelection();
					$("#players").resetSelection();
				break;

				case "change_color":
					document.getElementById("divTeams").style.display = "";
					document.getElementById("divSep").style.display = "none";
					document.getElementById("divPlayers").style.display = "none";
					document.getElementById("divCreateTeam").style.display = "none";
					document.getElementById("divAddPlayer").style.display = "none";
					document.getElementById("divChangeName").style.display = "none";
					document.getElementById("divChangeCaptain").style.display = "none";
					document.getElementById("divChangeColor").style.display = "";
					document.getElementById("divRemovePlayer").style.display = "none";
					document.getElementById("divDeleteTeam").style.display = "none";

					$("#teams").resetSelection();
					$("#players").resetSelection();
				break;

				case "remove_player":
					document.getElementById("divTeams").style.display = "";
					document.getElementById("divSep").style.display = "";
					document.getElementById("divPlayers").style.display = "";
					document.getElementById("divCreateTeam").style.display = "none";
					document.getElementById("divAddPlayer").style.display = "none";
					document.getElementById("divChangeName").style.display = "none";
					document.getElementById("divChangeCaptain").style.display = "none";
					document.getElementById("divChangeColor").style.display = "none";
					document.getElementById("divRemovePlayer").style.display = "";
					document.getElementById("divDeleteTeam").style.display = "none";

					$("#players").setGridParam({url: "db-activity-players.php?activity=1"});
					$("#players").trigger("reloadGrid");

					$("#teams").resetSelection();
					$("#players").resetSelection();
				break;

				case "delete_team":
					document.getElementById("divTeams").style.display = "";
					document.getElementById("divSep").style.display = "none";
					document.getElementById("divPlayers").style.display = "none";
					document.getElementById("divCreateTeam").style.display = "none";
					document.getElementById("divAddPlayer").style.display = "none";
					document.getElementById("divChangeName").style.display = "none";
					document.getElementById("divChangeCaptain").style.display = "none";
					document.getElementById("divChangeColor").style.display = "none";
					document.getElementById("divRemovePlayer").style.display = "none";
					document.getElementById("divDeleteTeam").style.display = "";

					$("#teams").resetSelection();
					$("#players").resetSelection();
				break;

			}

			return true;
		}

		function getSelectedItems(objGrid) {
			var strRtnValue = "";
			var arrData = objGrid.getGridParam('selarrrow');
			if (arrData.length > 0) {
				for (var i = 0; i < arrData.length; i++) {
					strRtnValue += (arrData[i] + ",");
				}

				// Now strip out the trailing comma
				if (strRtnValue != "") {
					strRtnValue = strRtnValue.substr(0, strRtnValue.length - 1);
				}
			} else {
				var selRow = objGrid.getGridParam('selrow');
				if (selRow == null) {
					return "";
				}

				strRtnValue = selRow;
			}

			return strRtnValue;
		}

		function VerifyAndSubmit() {

			var cboAction = document.getElementById("cboAction");
			var action = cboAction.options[cboAction.selectedIndex].value;
			document.getElementById("hidActionIndex").value = cboAction.selectedIndex;

			switch (action) {
				case "view_teams":
					return false;
				break;

				case "create_team":
					// Check to see if the max has been reached.
					//if (<?=$team_count?> == 8) {
					//	alert("Sorry...  The maximum number of teams have been created. Check with one of the other teams to see if you can join them. Or bug Jake to make room for more teams.");
					//	return false;
					//}

					if (document.getElementById("team_name").value == "") {
						alert("Please enter a team name.");
						return false;
					}

					var person_id = getSelectedItems($("#players"));
					if (person_id == "") {
						alert("Please select at least one player.");
						return false;
					}

					if (person_id.indexOf(',') >= 0) {
						alert("Please select only one player to be captain. Can't have too many roosters ruling the pen...");
						return false;
					}

					document.getElementById("gridPlayer").value = person_id;
				break;

				case "add_player":
					var team_id = getSelectedItems($("#teams"));
					if (team_id == "") {
						alert("Please select at least one team.");
						return false;
					}
					document.getElementById("gridTeam").value = team_id;

					var person_id = getSelectedItems($("#players"));
					if (person_id == "") {
						alert("Please select at least one player.");
						return false;
					}

					document.getElementById("gridPlayer").value = person_id;
				break;

				case "change_name":
					if (document.getElementById("change_name").value == "") {
						alert("Please enter a team name.");
						return false;
					}

					var team_id = getSelectedItems($("#teams"));
					if (team_id == "") {
						alert("Please select at least one team.");
						return false;
					}
					document.getElementById("gridTeam").value = team_id;
				break;

				case "change_captain":
					var team_id = getSelectedItems($("#teams"));
					if (team_id == "") {
						alert("Please select at least one team.");
						return false;
					}
					document.getElementById("gridTeam").value = team_id;

					var person_id = getSelectedItems($("#players"));
					if (person_id == "") {
						alert("Please select at least one player.");
						return false;
					}

					if (person_id.indexOf(',') >= 0) {
						alert("Please select only one player to be captain. Can't have too many roosters ruling the pen...");
						return false;
					}

					document.getElementById("gridPlayer").value = person_id;
				break;

				case "change_color":
					if (document.getElementById("change_color").value == "") {
						alert("Please enter a team color.");
						return false;
					}

					var team_id = getSelectedItems($("#teams"));
					if (team_id == "") {
						alert("Please select at least one team.");
						return false;
					}
					document.getElementById("gridTeam").value = team_id;
				break;

				case "remove_player":
					var person_id = getSelectedItems($("#players"));
					if (person_id == "") {
						alert("Please select at least one player.");
						return false;
					}
					document.getElementById("gridPlayer").value = person_id;

					if (confirm ("Are you sure you want to remove this player?") == false) {
						return false;
					}
				break;

				case "delete_team":
					if (confirm ("Are you sure you want to delete this team?") == false) {
						return false;
					}

					var team_id = getSelectedItems($("#teams"));
					if (team_id == "") {
						alert("Please select at least one team.");
						return false;
					}
					document.getElementById("gridTeam").value = team_id;
				break;
			}

			// Replace naughty characters with more pleasing ones.
			document.getElementById("team_name").value = document.getElementById("team_name").value.replace(new RegExp("\'", "g"), "&#39;");
			document.getElementById("team_name").value = document.getElementById("team_name").value.replace(new RegExp("&", "g"), "&amp;");
			document.getElementById("team_name").value = document.getElementById("team_name").value.replace(new RegExp("\"", "g"), "&quot;");
			document.getElementById("shirt_color").value = document.getElementById("shirt_color").value.replace(new RegExp("\'", "g"), "&#39;");
			document.getElementById("shirt_color").value = document.getElementById("shirt_color").value.replace(new RegExp("&", "g"), "&amp;");
			document.getElementById("shirt_color").value = document.getElementById("shirt_color").value.replace(new RegExp("\"", "g"), "&quot;");
			document.getElementById("change_name").value = document.getElementById("change_name").value.replace(new RegExp("\'", "g"), "&#39;");
			document.getElementById("change_name").value = document.getElementById("change_name").value.replace(new RegExp("&", "g"), "&amp;");
			document.getElementById("change_name").value = document.getElementById("change_name").value.replace(new RegExp("\"", "g"), "&quot;");
			document.getElementById("change_color").value = document.getElementById("change_color").value.replace(new RegExp("\'", "g"), "&#39;");
			document.getElementById("change_color").value = document.getElementById("change_color").value.replace(new RegExp("&", "g"), "&amp;");
			document.getElementById("change_color").value = document.getElementById("change_color").value.replace(new RegExp("\"", "g"), "&quot;");

			document.getElementById("activity-bball-team").submit();
		}
	</script>

</head>

<body onload="onLoad();" style="background: #ffffff;">

	<p><b>What would you like to do?</b></p>

	<form id="activity-bball-team" action="activity-bball-team.php" method="post">

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
			<p>Finally, click Submit.</p>
			<input type="button" onclick="VerifyAndSubmit();" value="Submit" style="float:none" />
		</div>

	</form>

	<div class="clearthis">&nbsp;</div>

	<!-- End of Main Content Area -->

</body>
</html>