
function printf(area){
	var newstr = document.getElementById(area).innerHTML;
	var oldstr = document.body.innerHTML; 
	document.body.innerHTML = newstr; 
	window.print(); 
	document.body.innerHTML = oldstr; 
	return false; 
}