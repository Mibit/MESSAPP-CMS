
// needed for Table Column ordering
function tableOrdering( order, dir, task ) {
	$("#listForm #sortCol").val(order);
	$("#listForm #sortDir").val(dir);
	$("#listForm").submit();
}
