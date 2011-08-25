<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
<meta http-equiv="Content-Style-Type" content="text/css" />

<title>Kansas City Regional Family Weekend</title>

<link rel="stylesheet" href="main.css" type="text/css" media="screen" />

<script type="text/javascript">
// This stores the parameters passed in on a page.
var arrPageParams = new Array();
var iPageNum = 1;

function getPageParams() {
	var query = window.location.search.substring(1);
	var parms = query.split('&');
	for (var i = 0; i < parms.length; i++) {
		var pos = parms[i].indexOf('=');
		if (pos > 0) {
			var key = parms[i].substring(0,pos);
			var val = parms[i].substring(pos+1);
			arrPageParams[key] = val;
		}
	}
}

function loadPhotos() {
	// We'll default to page 1
	var iNextNum = 0;


	getPageParams();
	if (arrPageParams["page"] > 0) {
		iPageNum = arrPageParams["page"];
	}

	iPhotoNum = ((iPageNum - 1) * 4) + 1;

	document.getElementById("photo1").src = "images/kcweekend_" + iPageNum + ".jpg";

	if (iPageNum == 1) {
		document.getElementById("a_prev").disabled = true;
	} else {
		document.getElementById("a_prev").href = "photo_viewer.php?page=" + (iPageNum - 1);
	}

	iNextNum = parseInt(iPageNum) + 1;

	document.getElementById("a_next").href = "photo_viewer.php?page=" + iNextNum;
	document.getElementById("a_next_pic").href = "photo_viewer.php?page=" + iNextNum;

}

</script>

</head>

<body onload="loadPhotos();">

	<h2>KC Weekend Pictures</h2>
	<p /><p /><p />

	<div class="pictures_nav">
		<a href="photo_viewer.php?page=1">Start Over</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a id="a_prev" href="photo_viewer.php"><- Previous</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a id="a_next" href="photo_viewer.php">Next -></a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a onclick="self.close();">|X| Close Me</a>
	</div>

	<div class="clearthis">&nbsp;</div>

	<a id="a_next_pic" href="photo_viewer.php">
	<img id="photo1" alt="KC Weekend Photo" />
	</a>

	<div class="clearthis">&nbsp;</div>



</body>
</html>