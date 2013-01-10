<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

class AppScreensaver extends MA_Controller {

	public function __construct() {
		parent::__construct();
		 
		$this->load->model("ScreensaverData");
		 
		//my_path muss im AC_Controller immer gesetzt werden
		$this->my_path = 'appscreensaver';
	}

	public function index($scr = null) {
		
		$screensaver = new ScreensaverData();

		$variables["page_title"] = "App Screensaver";

		if (!$scr){
			$variables["screensaver"] = $screensaver->loadMultipleFromDatabase();
		} else {
			$variables["screensaver"] = $scr;
		}

		//AC Methode um Views anzuzeigen
		$this->loadView('appscreensaver', $variables);
	}

	public function save() {
		
		$validation = "validation";
		 
		 
		$scrArray = array();
		 
		try {
			
			for($i=0; array_key_exists("scrID$i", $_POST); $i++){
				$scrArray[] = new ScreensaverData( getFormFieldValue("scrID$i") );
				$this->form_validation->set_rules('scrText1'.$i, ($i+1).' Eintrag Text 1', 'required|max_length[50]');
				$this->form_validation->set_rules('scrText2'.$i, ($i+1).' Eintrag Text 2', 'required|max_length[50]');

				$scrArray[$i]->scrText1 = getFormFieldValue("scrText1$i");
				$scrArray[$i]->scrText2 = getFormFieldValue("scrText2$i");

				$scrArray[$i]->scrImage = getFormFieldImage("scrImage$i");
			}
			
			$this->form_validation->set_message('required', 'Geben Sie einen Wert in das Feld %s ein.');
			$this->form_validation->set_message('max_length', 'Sie haben zu viele Zeichen in das Feld %s eingegeben.');
			
			foreach($scrArray as $key=>$scr) {
				if(!$scr->scrImage) {
					$this->addError("Die Eintr&auml;ge konnten nicht gespeichert werden, da das Bild im ".($key+1).". Eintrag fehlt.");
				}
			}
			if(!$this->form_validation->run() || count($this->getError())) {
				throw new Exception($validation);
			}
			
			$scrIDArray = array();
			foreach($scrArray as $scr) {
				if(!$scr->save()) {
					$this->addError("Die Eintr&auml;ge konnten nicht gespeichert werden.");
					throw new Exception($validation);
				}
				
				if($scr->scrID) {
					$scrIDArray[] = $scr->scrID;
				}
			}
			
			// delete Entries which are not in $scrIDArray --> deleted from user			
			$oldScr = new ScreensaverData();
			$oldScr->deleteMode();
			if(count($scrIDArray)) {
				$oldScr = $oldScr->loadMultipleFromDatabase("scrID not in (".implode(",",$scrIDArray).")");
			} else {
				$oldScr = $oldScr->loadMultipleFromDatabase();
			}
			foreach($oldScr as $deleteScr) {
				$deleteScr->delete();
			}	
			
			$this->addSuccess("Die Eintr&auml;ge wurden erfolgreich gespeichert.");
			
		} catch(Exception $e) {
			if($e->getMessage()!=$validation) {
				$this->addError($e->getMessage());
			}
		}
		 
		$this->index($scrArray);
	}
}
