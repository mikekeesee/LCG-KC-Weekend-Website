<?
$target_path = "uploads/" . basename( $_FILES['fileActData']['name']);

$result = 0;

if(move_uploaded_file($_FILES['fileActData']['tmp_name'], $target_path)) {
    $result = 1;
}

sleep(1);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<title>Kansas City Regional Family Weekend: Fun Show Upload Page</title>

	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
	
	<? include ('google-analytics.php'); ?>
</head>

<body style="width: 50em;">

<?	if ($result == 1) {
		echo("<p>".$_FILES['fileActData']['name']." was successfully uploaded.</p>");
	} else {
		echo("<p>There was an error. Click <a href='activity-fun-show-file-retriever.php'>here</a> to try again.</p>");
	}
?>

	<script language="javascript" type="text/javascript">
		window.top.window.document.getElementById("hidFilename").value = "<?=$_FILES['fileActData']['name']?>";
	</script> 

</body>