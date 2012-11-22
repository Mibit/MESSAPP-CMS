
function redirectWithSave( url ) {
	$("form#form input[name=\"target\"]").val(url);
	$("#form input[type=\"submit\"]").trigger("click");
}
