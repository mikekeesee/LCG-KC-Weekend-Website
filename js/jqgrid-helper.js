// Handy jqGrid functions

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