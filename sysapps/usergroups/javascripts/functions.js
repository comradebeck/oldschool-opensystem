function gpAjaxer(vOper, vID) {
	var gpAjaxPerform;		
	try {		
		gpAjaxPerform = new XMLHttpRequest();	
	} catch (e) {		
		try {			
			gpAjaxPerform = new ActiveXObject("Msxml2.XMLHTTP");		
		} catch (e) {			
			try {				
				gpAjaxPerform = new ActiveXObject("Microsoft.XMLHTTP");			
			} catch (e) {				
				alert("Your browser sucks!");				
				return false;			
			}		
		}	
	}			
	gpAjaxPerform.onreadystatechange = function() {		
		if(gpAjaxPerform.readyState == 4) {
			if (gpAjaxPerform.responseText.length != 0) {									
				if (vOper == 'Delete') {
					document.getElementById("idList_" + vID).style.display = "none";
				}													
			}	
		} 	
	}
	
	gpAjaxPerform.open("GET", "includes/ajax.php?vOper=" + vOper + "&vID=" + vID, true);
	gpAjaxPerform.send(null);
}

function jsConfirmDelete(vID) {
	var vAns = confirm("You are about to delete this entry. Are you sure?");
	if (vAns) {
		return gpAjaxer("Delete", vID);		
	}
	return false;
}