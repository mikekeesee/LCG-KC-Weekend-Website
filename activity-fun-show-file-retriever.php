<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend: File Retriever</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />	

	<? include ('google-analytics.php'); ?>
</head>

<body style="width: 50em;">
	<form enctype="multipart/form-data" action="activity-fun-show-file-uploader.php" method="POST">
		<p><label for="fileActData">File for your act (accompaniment, lyrics, script, etc.):</label>
		<input type="file" id="fileActData" name="fileActData" onchange="Verify();" /></p>
		
		<p><em>&nbsp;(If you have multiple files, please put them in a ZIP file.)</em></p>
		
		<p><input type="submit" id="btnSubmit" value="Upload File" disabled="true" /></p>
	</form>

	<script language="javascript" type="text/javascript">
		function Verify() {
			if (document.getElementById("fileActData").value.length > 0) {
				document.getElementById("btnSubmit").disabled = false;
			} else {
				document.getElementById("btnSubmit").disabled = true;
			}
		}
	</script>
		
</body>