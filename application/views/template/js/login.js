
$(document).ready(function() {
	if($("#username").val()=="" || $("#password").val()!="") {
		$("#username").select();
	} else {
		$("#password").select();
	}
});