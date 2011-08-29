<!-- Start of Page Header -->

<div class="header">

	<h1><a href="index.php"><img src="images/kc-skyline.png" />KansasCity<b>Family</b>Weekend
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h1>

	<script>
		function mainmenu(){
			$(".navbar ul").css({display: "none"}); // Opera Fix
			$(" .navbar li").hover(function(){
				$(this).find('ul:first').css({visibility: "visible",display: "none"}).show(400);
				},function(){
				$(this).find('ul:first').css({visibility: "hidden"});
				});
		}

		 $(document).ready(function(){
			mainmenu();
		});	
	</script>

	<div>
		<ul class="navbar">
			<li><a href="index.php">Home</a></li>
			<li><a href="reg-main.php">Registration</a></li>
			<li><a href="activity-main.php">Sunday Activities</a>
				<ul>
					<li><a href="activity-bball-main.php">Basketball</a></li>
					<li><a href="activity-vball-main.php">Volleyball</a></li>
				</ul>
			</li>
			<li><a href="information.php">General Information</a></li>
			<li><a href="housing.php">Housing</a></li>
		</ul>

	</div>

	<div class="clear-float"></div>
</div>

<!-- End of Page Header -->