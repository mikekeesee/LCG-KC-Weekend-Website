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
	var iPhotoNum = 1;
	var iNextNum = 0;


	getPageParams();
	if (arrPageParams["page"] > 0) {
		iPageNum = arrPageParams["page"];
	}

	iPhotoNum = ((iPageNum - 1) * 5) + 1;

	for (var i = 1; i <= 5; i++) {
		document.getElementById("anchor" + i).href = "photo_viewer.php?page=" + (parseInt(iPhotoNum) + i - 1);
		document.getElementById("photo" + i).src = "images/kcweekend_" + (parseInt(iPhotoNum) + i - 1) + ".jpg";
	}

	if (iPageNum == 1) {
		document.getElementById("a_prev").disabled = true;
	} else {
		document.getElementById("a_prev").href = "photos.php?page=" + (iPageNum - 1);
	}

	iNextNum = parseInt(iPageNum) + 1;

	document.getElementById("a_next").href = "photos.php?page=" + iNextNum;

}

</script>

</head>

<body onload="loadPhotos();" style="background: #5f92d2">

	<div id="pictures_container">
	<div id="pictures">

		<h3 class="standout">Pictures</h3>

		<div id="pictures_images">

			<ul>
			<li><a id="anchor1" href="photo_viewer.php" target="_blank"><img id="photo1" width="105" height="82" alt="KC Weekend Photo" /></a></li>
			<li><a id="anchor2" href="photo_viewer.php" target="_blank"><img id="photo2" width="105" height="82" alt="KC Weekend Photo" /></a></li>
			<li><a id="anchor3" href="photo_viewer.php" target="_blank"><img id="photo3" width="105" height="82" alt="KC Weekend Photo" /></a></li>
			<li><a id="anchor4" href="photo_viewer.php" target="_blank"><img id="photo4" width="105" height="82" alt="KC Weekend Photo" /></a></li>
			<li class="end"><a id="anchor5" href="photo_viewer.php" target="_blank"><img id="photo5" width="105" height="82" alt="KC Weekend Photo" /></a></li>
			</ul>

			<div class="clearthis">&nbsp;</div>

		</div>

		<div class="pictures_nav">
		<a id="a_prev" href="photos.php"><- Previous</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a id="a_next" href="photos.php">Next -></a>
		</div>


		<div class="clearthis">&nbsp;</div>
	</div>
	</div>

	<div class="clearthis">&nbsp;</div>

</body>
</html>