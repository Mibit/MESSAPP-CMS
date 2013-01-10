<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

class AppScreensaver extends MA_Controller {

	public function __construct() {
		parent::__construct();
		 
		$this->load->model("ScreensaverData");
		 
		//my_path muss im AC_Controller immer gesetzt werden
		$this->my_path = 'appscreensaver';
	}

	public function index($scr = null) {
		//
		$screensaver = new ScreensaverData();

		$variables["page_title"] = "App Screensaver";

		if ($scr = null){
			$variables["screensaver"] = $screensaver->loadMultipleFromDatabase();
		} else if ($scr != null) {
			$variables["screensaver"] = $scr;
		}

		//AC Methode um Views anzuzeigen
		$this->loadView('appscreensaver', $variables);
	}

	public function save() {
		 
		$validation = "validation";
		$noInput = "noInput";
		$noChange = "noChange";
		 
		/* Deklarierung der Bildvariable */
		$scrImage;
		 
		$scrArray = array();
		 
		try {
			for($i=0; array_key_exists("scrID$i", $_POST); $i++){
				 
				$scr = new screensaverData( getFormFieldValue("scrID$i") );
				$this->form_validation->set_rules('scrText1'.$i, 'Text 1', 'required|max_length[50]');
				$this->form_validation->set_rules('scrText2'.$i, 'Text 2', 'required|max_length[50]');

				$scrImage = getFormFieldImage("scrImage$i");

				$scr->scrText1 = getFormFieldValue("scrText1$i");
				$scr->scrText2 = getFormFieldValue("scrText2$i");

				$scr->scrImage = getFormFieldImage("scrImage$i");

				$scrArray[] = clone $scr;
			}
			
			$this->form_validation->set_message('max_length', 'Sie haben zu viele Zeichen in das Feld %s eingegeben!');
			
			if($scr == new screensaverData() && getFormFieldValue("target")) {
				throw new Exception($noInput);
			}

			if(!$this->form_validation->run()) {
				throw new Exception($validation);
			}
		}
		 
		 
	}
}
