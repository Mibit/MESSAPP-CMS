
function redirectWithSave(url, active) {
	if(active) {
		window.location.replace(url);
	} else {
		$("form#form input[name=\"target\"]").val(url);
		$("#form input[type=\"submit\"]").trigger("click");
	}
}

function changeSubcategoryState(opener, subCategory) {
	if($(opener).attr("opened") != 0) {
		$(opener).html("+");
		$(opener).attr("opened", 0);
		$(subCategory).hide();
	} else {
		$(opener).html("-");
		$(opener).attr("opened", 1);
		$(subCategory).show();
	}
}