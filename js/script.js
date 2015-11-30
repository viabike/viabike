$(document).ready(function(){
	$("#menu").hide();
	var aux = 0;
	
	$("#nav" ).click(function() {
		if (aux == 0) {
			aux = 1;
			$("#menu" ).show();
		}
		else {
			$("#menu").hide();
			aux = 0;
		}
	});	
});