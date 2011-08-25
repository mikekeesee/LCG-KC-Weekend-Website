<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Basketball</title>

	<link rel="stylesheet" href="page.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" media="screen" href="js/css/start/jquery-ui-1.7.2.custom.css" />

	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>

	<? include "jqgrid-header.php" ?>
	
	<script type="text/javascript">
		$(function(){
			// Tabs
			$('#tabs').tabs();
		});
	</script>

</head>

<body>

<div id="container">

	<!-- Add the header to each page -->
	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->

	<div id="maincontent_container">
	<div id="maincontent">


		<? include "activity-buttons.php"; ?>


		<h2>Basketball</h2>

		<p>Welcome to the basketball page. You can check out the game rules, schedule or the teams that are
		already signed up. Sign up your team under the Teams tab. <b style="color:red">Teams must be finalized by Dec. 20th!</b></p>

		<p>All basketball-related questions may be directed to Peder Moluf at
		<a href="mailto:moluf_pt@yahoo.com">moluf_pt@yahoo.com</a>.</p>

		<p><b>Important: Minimum age for sports is 13. Those with bad backs or other similar injuries should not
		participate. Due to the inherent risk of such activities, all participants must sign a liability waiver. Those
		under 18 will need a parent or legal guardian’s signature before they can participate.</b></p>

		<hr />

		<hr />
		<br/>
		<div id="tabs">
			<ul>
				<li><a href="#general">General</a></li>
				<li><a href="#rules">Rules</a></li>
				<li><a href="#teams">Teams</a></li>
				<li><a href="#schedule">Game Schedule</a></li>
			</ul>

			<div id="general">
				<h3>General Information</h3>

					<p>This year, we look forward to having TWO FULL-SIZED courts to play on. That&#39;s right, full-court basketball,
					so bring your inhalers, boys!</p>

					<p>The Kansas City Weekend provides a rare opportunity for Church members from around the country to get
					together and play organized sports. Our overall goals for sports this year are to promote teamwork,
					sportsmanship, camaraderie, playing within the rules of the game, strategy and, most
					importantly, fun.</p>

					<p>With these in mind, the following items have been determined:

					<ul class="bullets">
						<li class="bullets"><b>Sports Bible Study at 9:20 Sunday morning:</b> Attendance is <u>mandatory</u> to play.
						<li class="bullets"><b>Schedule of Games:</b> Teams will follow a set schedule to allow each team to play at least <u>3
						games</u>. We will do our best to create a schedule that makes the most even match-ups possible.</li>
						<li class="bullets"><b>Games Lengths:</b> There will likely be 12 minutes per half. Time will be allotted for warm-ups after the previous game ends
						and a 3-minute halftime. (All subject to change based on the number of teams that sign up.)</li>
						<li class="bullets"><b>Rosters:</b> Teams need a minimum of 5 people per team (8 max.). All team members must register
						to play.</li>
						<li class="bullets"><b>12:30 Break:</b> All sports will halt for family games, then resume at 2 p.m.</li>
					</ul>

					<p><b>Please register your team by <span style="color:red;">December 20th</span></b>.</p>

			</div>

			<div id="rules">
				<h3>Kansas City Regional Family Weekend Basketball Rules</h3>

				<p>National Federation rules will serve as a basis for all situations not specified below. Normal full-court
				rules will apply, with an emphasis on the following rules or changes to the rules:</p>

				<ul class="bullets">
					<li class="bullets"><u>Start of Game:</u> Each game will begin with a jump ball.</li>
					<li class="bullets"><u>Personal Fouls:</u> Each player has four (4) personal fouls to give before fouling out.</li>
					<li class="bullets"><u>Team Fouls:</u> One-and-one situations will occur starting with the seventh (7th) team foul (no 2-shot bonus
					beyond this point).</li>
					<li class="bullets"><u>Free Throws:</u> The ball is live after the shot leaves the player&#39;s hands, not
					after it hits the rim of the basket.</li>
					<li class="bullets"><u>Substitutions:</u> Allowed only during a dead ball after checking in	with the scorekeeper.</li>
					<li class="bullets"><u>Timeouts:</u> There are no team timeouts.</li>
					<li class="bullets"><u>Clock:</u> Time will not stop during the first half except under referee discretion.
					The clock will stop in the last minute of the second half for dead ball situations if the difference in scores
					is 10 points or less.</li>
					<li class="bullets"><u>Overtime:</u> If the score is tied, a free throw shoot-off will determine the winner.
					Three players from each team will alternate shooting free throws two at a time per player.
					If it&#39;s tied after 6 shots, then the 4th player from each team shoots a single free throw, then the 5th player,
					and so forth until one team makes a free throw and the other misses.</li>

				<p>All basketball-related questions may be directed to Peder Moluf at <a href="mailto:moluf_pt@yahoo.com">moluf_pt@yahoo.com</a>.</p>

			</div>

			<div id="teams">
				<p><h3 style="color:red">Team registration is now closed. Please contact Peder Moluf at
				<a href="mailto:moluf_pt@yahoo.com">moluf_pt@yahoo.com</a> to request changes to team information, including team
				names, captains, jersey colors, roster changes, etc.</h3></p>

				<br />

				<div class="list-view">
					<script type="text/javascript" src="js/grid-activity-bball-teams.js"></script>
					<table id="activity-person-list"></table>
				</div>
			</div>


			<div id="schedule">

				<h3>Game Schedule</h3>

				<p>Here is the basketball schedule.</p>

				<img src="docs/bball_final_schedule.jpg"/>

			</div>

		</div>

	</div>
	</div>
	<div class="clearthis">&nbsp;</div>

	<!-- End of Main Content Area -->


	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>

</div>

</body>
</html>