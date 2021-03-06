<?php

function charCounter($numberOfChars){
	echo "<div class=\"limit\"><input type='hidden' value='$numberOfChars'/>Sie haben noch <span>&nbsp;</span> Zeichen zur Verf&uuml;gung.</div>";
}

function listBoxElements() {
	
	$removeButton = '<div class="removeButtonContainer">
						<div class="removeButton tooltip" onClick="javascript: removeEntry(this);" title="Eintrag entfernen">x</div>
					</div>';
	
	return $removeButton;
}

function sort_header($field, $caption, $sortCol, $sortDir) {
    $template_url = base_url() . 'application/views/template/';
    $html = '<a title="Click to sort by this column" href="javascript: ';
    if ($field == $sortCol && $sortDir == 'desc') {
        $html .= "tableOrdering('$field','asc','');\">$caption&nbsp;<img alt=\"\" src=\"{$template_url}images/sort_desc.png\"></a>";
    } else if ($field == $sortCol && $sortDir == 'asc') {
        $html .= "tableOrdering('$field','desc','');\">$caption&nbsp;<img alt=\"\" src=\"{$template_url}images/sort_asc.png\"></a>";
    } else {
        $html .= "tableOrdering('$field','asc','');\">$caption</a>";
    }
    return $html;

}

function getFormFieldValue($fieldname, $method = "post") {
    if (strtolower($method) == "post") {
        if (isset($_POST[$fieldname]))
            return $_POST[$fieldname];
    } else if (strtolower($method) == "get") {
        if (isset($_GET[$fieldname]))
            return $_GET[$fieldname];
    } else if (strtolower($method) == "request") {
        if (isset($_REQUEST[$fieldname]))
            return $_REQUEST[$fieldname];
    }

    return null;
}

function getFormFieldArray($fieldname, $method = "post") {
    return is_array(getFormFieldValue($fieldname,$method)) ? getFormFieldValue($fieldname,$method) : ( getFormFieldValue($fieldname,$method) ? Array(getFormFieldValue($fieldname,$method)) : Array() );
}

function getFormFieldBoolean($fieldname, $method = "post") {
	return getFormFieldValue($fieldname, $method) ? true : false;
}

function getFormFieldImage($fieldname) {
    if(array_key_exists($fieldname, $_FILES) && $tmpName = $_FILES[$fieldname]["tmp_name"]) {
    	$_FILES[$fieldname]["tmp_name"];
		$fp = fopen($tmpName, 'r');
    	$data = fread($fp, filesize($tmpName));
    	fclose($fp);
    
    	return $data;
  	} else if(array_key_exists("{$fieldname}_hidden", $_POST)) {
  		return base64_decode(getFormFieldValue("{$fieldname}_hidden", "post"));
  	} else {
    	return null;
  	}
}

function translateNullToHTML($value) {
    if ($value == null)
        return "&nbsp;";

    return $value;
}