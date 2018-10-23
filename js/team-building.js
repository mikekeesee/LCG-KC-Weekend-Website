// Team building code
// Requires activity_number, activity_name and max_teams, onload_msgbox

function onSelectRow(id) {
	var cboAction = document.getElementById("cboAction");
	var action = cboAction.options[cboAction.selectedIndex].value;

	switch (action) {
		case "change_captain":
		case "remove_player":
			$("#players").setGridParam({url: "db-activity-players.php?activity=" + activity_number + "&team_id=" + id});
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

			$("#players").setGridParam({url: "db-activity-players.php?activity=" + activity_number + "&team_id=NULL"});
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

			$("#players").setGridParam({url: "db-activity-players.php?activity=" + activity_number + "&team_id=NULL"});
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

			$("#players").setGridParam({url: "db-activity-players.php?activity=" + activity_number + "&team_id=NULL"});
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

			$("#players").setGridParam({url: "db-activity-players.php?activity=" + activity_number});
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

			$("#players").setGridParam({url: "db-activity-players.php?activity=" + activity_number});
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
			//if (<?=$team_count?> == max_teams) {
			//	alert("Sorry...  The maximum number of teams have been created. Check with one of the other teams to see if you can join them. Or bug Jake to make room for more teams.");
			//	return false;
			//}

			if (document.getElementById("team_name").value == "") {
				alert("Please enter a team name.");
				return false;
			}

			var slComp = document.getElementById("skill_level_competitive");
			var slRec = document.getElementById("skill_level_rec");
			if (slComp != null && slRec != null) {
				if (slComp.checked == false &&
					slRec.checked == false) {
					alert("Please choose a tournament type.");
					return false;
				}
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
            
            var team_id = getSelectedItems($("#teams"));
			if (team_id == "") {
				alert("Please select at least one team.");
				return false;
			}
			document.getElementById("gridTeam").value = team_id;

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

	document.getElementById("activity-team").submit();
}
