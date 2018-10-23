<?
	// Get the database connection information
	include("db-connect.php");

	$link = mysqli_connect(localhost, $username, $password, $database);

	// Get the POST data
	$expire = time() + (60*60*24*7);

	$performers = $_POST['gridPerson'];
	$act_type = $_POST['txtActType'];
	$act_title = $_POST['txtActTitle'];
	$length = $_POST['txtLength'];
	$act_description = $_POST['txtActDescription'];
	$audio_needs = $_POST['txtAudioNeeds'];
	$cd_track = $_POST['txtCDTrack'];
	$props = $_POST['txtProps'];
	$years_experience = $_POST['txtYearsExperience'];
	$church_area = $_POST['txtChurchArea'];
	$anything_else = $_POST['txtAnythingElse'];
	$filename = "uploads/" . $_POST['hidFilename'];
	
	// This page can be accessed without submitting data, so check the POST first.
	if (strlen($performers) > 0) {
		// Insert the Fun_Show_Act table data first
		$SQL = "INSERT INTO Fun_Show_Act
					(Act_ID,
					 Type,
					 Title,
					 Length,
					 Description,
					 Audio_Needs,
					 CD_Track,
					 Props,
					 Years_Experience,
					 Church_Area,
					 Anything_Else,
					 Filename)
				VALUES
					(NULL,
					 '".mysqli_real_escape_string($link, $act_type)."',
					 '".mysqli_real_escape_string($link, $act_title)."',
					 '".mysqli_real_escape_string($link, $length)."',
					 '".mysqli_real_escape_string($link, $act_description)."',
					 '".mysqli_real_escape_string($link, $audio_needs)."',
					 '".mysqli_real_escape_string($link, $cd_track)."',
					 '".mysqli_real_escape_string($link, $props)."',
					 '".mysqli_real_escape_string($link, $years_experience)."',
					 '".mysqli_real_escape_string($link, $church_area)."',
					 '".mysqli_real_escape_string($link, $anything_else)."',
					 '".mysqli_real_escape_string($link, $filename)."')";

		mysqli_query($link, $SQL) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Fun_Show_Act INSERT query.".mysqli_error($link));

		$act_id = mysqli_insert_id($link);		

		if ($arrPerson = explode(",", $performers)) {
			foreach ($arrPerson as $person_id) {
		
				// Insert the Registration table data
				$SQL = "INSERT INTO Fun_Show_Person
							(Act_ID,
							 Person_ID)
						VALUES
							(".$act_id.",
							 ".$person_id.")";

				mysqli_query($link, $SQL) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Fun_Show_Person INSERT query.".mysqli_error($link));
			}
		}
	}	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend - Art Show</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />

	<? include "jqgrid-header.php" ?>
	<script src="js/jquery.validate.min.js" type="text/javascript"></script>
	<script src="js/show-hide.js" type="text/javascript"></script>

	<? include ('google-analytics.php'); ?>
</head>

<body>

	<!-- Add the header to each page -->
	<? include ('header.php'); ?>

	<!-- Start of Main Content Area -->

	<div class="main-content">

		<h2>Art Show Entries</h2>
		
<?		
	$SQL = "SELECT	fsa.Act_ID,
					fsa.Type,
					fsa.Title,
					fsa.Length,
					fsa.Description,
					fsa.Audio_Needs,
					fsa.CD_Track,
					fsa.Props,
					fsa.Years_Experience,
					fsa.Church_Area,
					fsa.Anything_Else,
					fsa.Filename,
					GROUP_CONCAT(CONCAT(p.First_Name, ' ', p.Last_Name) SEPARATOR ', ') AS Performers,
					GROUP_CONCAT(DISTINCT p.Email SEPARATOR '; ') AS Email
								
			FROM	Fun_Show_Act fsa
			
				INNER JOIN Fun_Show_Person fsp
					ON fsa.Act_ID = fsp.Act_ID
						
				INNER JOIN Person p
					ON fsp.Person_ID = p.Person_ID		
			
			GROUP BY	fsa.Act_ID,
						fsa.Type,
						fsa.Title,
						fsa.Length,
						fsa.Description,
						fsa.Audio_Needs,
						fsa.CD_Track,
						fsa.Props,
						fsa.Years_Experience,
						fsa.Church_Area,
						fsa.Anything_Else,
						fsa.Filename
						
			ORDER BY fsa.Title, p.Last_Name, p.First_Name";
	
	$result = mysqli_query($link, $SQL) or die("Sorry.  There was a database error - Contact <a href='mailto:mkeesee@gmail.com'>Mike</a> to report that he left a bug in his code."); //$SQL."\n\nCouldn't execute Fun_Show_Act SELECT query.".mysqli_error($link));

	while($row = mysqli_fetch_array($result)) {
		
		echo("\t\t<fieldset><legend>".$row[Title]."</legend>");
		echo("\t\t\t<p><b>Type of Art:</b>&nbsp;".$row[Type]."</p>");
		echo("\t\t\t<p><b>Artist:</b>&nbsp;".$row[Performers]."</p>");
		echo("\t\t\t<div class='show-hide'>");
		echo("\t\t\t<p><b>Performer Emails:</b>&nbsp;".$row[Email]."</p>");
		//echo("\t\t\t<p><b>Estimated Length:</b>&nbsp;".$row[Length]."</p>");
		echo("\t\t\t<p><b>Description:</b>&nbsp;".$row[Description]."</p>");
		//echo("\t\t\t<p><b>Audio Needs:</b>&nbsp;".$row[Audio_Needs]."</p>");
		//echo("\t\t\t<p><b>CD & Track #:</b>&nbsp;".$row[CD_Track]."</p>");
		//echo("\t\t\t<p><b>Props:</b>&nbsp;".$row[Props]."</p>");
		//echo("\t\t\t<p><b>Years of Experience:</b>&nbsp;".$row[Years_Experience]."</p>");
		echo("\t\t\t<p><b>Church Area:</b>&nbsp;".$row[Church_Area]."</p>");
		echo("\t\t\t<p><b>Anything Else:</b>&nbsp;".$row[Anything_Else]."</p>");
		//echo("\t\t\t<p><b>Act File:</b>&nbsp;<a href='".$row[Filename]."'>".str_replace("uploads/", "", $row[Filename])."</a></p>");
		echo("\t\t\t</div>");
		echo("\t\t</fieldset>");
	}
?>	
	</div>
	<!-- End of Main Content Area -->

	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>
		
</body>
</html>

<?
	mysqli_close($link);
?>
