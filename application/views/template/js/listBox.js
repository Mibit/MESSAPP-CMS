
		function addEntry() {
			$('div.stgForm').append($('div.template').html());
			$('div.stgForm > fieldset').last().find("*.tooltip").each(function() {
				$(this).tooltip({
					position: {
				        my: offset,
					}
				});
			});
			$('div.stgForm > fieldset').last().find("td.editorField").each(function() {
				$(this).html( $(this).html().replace("<!--", "").replace("-->", "") );
			});
			if(typeof(tinyMCE)!="undefined") {
				editorInit();
			}
		}
		
		function removeEntry(removeButton) {
			$(removeButton).parent().parent().remove();
		}

		function addIndizes() {
			$("div.stgForm > fieldset").each(function(index) {
				$(this).find("*[name]").each(function() {
					if($(this).attr("name").indexOf("_hidden") !== -1) {
						$(this).attr("name", $(this).attr("name").replace("_hidden","")+index+"_hidden");
					} else {
						$(this).attr("name", $(this).attr("name")+index);
					}
				});
			});
		}