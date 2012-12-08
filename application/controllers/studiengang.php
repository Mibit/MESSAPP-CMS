<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
    
class Studiengang extends MA_Controller {

    public function __construct() {
       parent::__construct();
       
       $this->load->model("StudiengangData");
       
       //my_path muss im AC_Controller immer gesetzt werden
       $this->my_path = 'studiengang';
    }
    
    public function index() {
    	// 
        $stg = new StudiengangData();
        
        $variables["page_title"] = "Studieng&auml;nge";
        
        //Listenansicht setzen (Sortierung, Filterfunktion)
        $this->setList(true);
        $this->setListItems( $stg->loadMultipleFromDatabase() );
        
        //AC Methode um Views anzuzeigen
        $this->loadView('studiengang_list', $variables);
    }
    
    public function edit($stgID = null, $stg = null) {
        
    	if(!$stg) {
        	$stg = new StudiengangData($stgID);
    	}
        $variables["page_title"] = $stg;
        
        $variables["stg"] = $stg;
        
        // HTML Editor hinzufügen
        $this->setHtmlEditor(true);
       
        //Sidebar aktivieren
        $this->setIsSidebar(true);
        $this->setSidebar(null,$stg->loadMultipleFromDatabase("", "stgKBez", "asc"), $stg->stgID, "studiengang_sidebar");
       
        
        /*
        //Toolbar setzen
        $toolbar[] = array("name" => "save", "caption" => "Speichern", "url" => "javascript: submitbutton('save')");
        $toolbar[] = array("name" => "back", "caption" => "Zur�ck", "url" => $this->getMyUrl() . "index");
        $variables['toolbar'] = $toolbar;
        */
        
        //AC Methode um Views anzuzeigen
        $this->loadView("studiengang",$variables);
    }
    
    public function save() {
    	$validation = "validation";
    	
    	try {
        $stg = new StudiengangData( getFormFieldValue("stgID") );

        $this->form_validation->set_rules('stgKBez', 'Kurzbezeichnung des Studiengangs', 'required|max_length[5]');
        $this->form_validation->set_rules('stgBez', 'Voller Studiengangsname', 'required|max_length[60]');
        $this->form_validation->set_rules('stgArt', 'Studiengangsart', 'required|max_length[1]');
        $this->form_validation->set_rules('stgStgL', 'Name der Studiengangsleitung', 'max_length[75]');
        // stgStgLImage
        $this->form_validation->set_rules('stgStgA', 'Name der Studiengangsassistenz', 'max_length[75]');
        // stgStgAImage
        $this->form_validation->set_rules('stgQuote', 'Zitat', 'max_length[500]');
        $this->form_validation->set_rules('stgHighlights', 'Kurze Highlights', 'max_length[500]');
        $this->form_validation->set_rules('stgStgLInfo', 'Info zum Studiengangsleiter', 'max_length[150]');
        $this->form_validation->set_rules('stgStgAInfo', 'Info zur Studiengangsassistenz', 'max_length[150]');
        // stgHImage1
        // stgHImage2
        $this->form_validation->set_rules('stgBigH', 'Gro&szlig;e Highlights', 'max_length[750]');
        // stgCurriculumImage
        $this->form_validation->set_rules('stgFOrganisationsform', 'Organisationsform', 'required|max_length[2]');
        $this->form_validation->set_rules('stgFStudienplaetze', 'Anzahl der Studienpl&auml;tze', 'max_length[3]');
        $this->form_validation->set_rules('stgFBewerbungsmodus', 'Bewerbungsmodus', 'max_length[100]');
        $this->form_validation->set_rules('stgFDauer', 'Dauer', 'max_length[15]');
        $this->form_validation->set_rules('stgFAkadGrad', 'Akademischer Grad', 'max_length[45]');
        $this->form_validation->set_rules('stgFUnterrichtssprache', 'Unterrichtssprache', 'max_length[75]');
        $this->form_validation->set_rules('stgFBesonderheit', 'Besonderheit', 'max_length[150]');
        $this->form_validation->set_rules('stgFAuslandsaufenthalt', 'Auslandsaufenthalt', 'max_length[150]');
        $this->form_validation->set_rules('stgFKosten', 'Kosten', 'max_length[75]');
        $this->form_validation->set_rules('stgFZugangsvoraussetzung', 'Zugangsvoraussetzungen', 'max_length[250]');
        // stgFImage
        $this->form_validation->set_rules('stgBFelder', 'Berufsfelder', 'max_length[750]');
        // stgBImage1
        // stgBImage2
        $this->form_validation->set_rules('stgKBeschreibung', 'Kurzbeschreibung', 'max_length[1000]');
        // stgKImage1
        // stgKImage2
        // stgImage
        // freigabe
        
        $this->form_validation->set_message('required', 'Geben Sie einen Wert in das Feld %s ein!');
        $this->form_validation->set_message('max_length', 'Sie haben zu viele Zeichen in das Feld %s eingegeben!');

        $stg->stgKBez = getFormFieldValue("stgKBez");
        $stg->stgBez = getFormFieldValue("stgBez");
        $stg->stgArt = getFormFieldValue("stgArt");
        $stg->stgStgL = getFormFieldValue("stgStgL");
        $stg->stgQuote = getFormFieldValue("stgQuote");
        $stg->stgHighlights = getFormFieldValue("stgHighlights");
        $stg->stgStgLInfo = getFormFieldValue("stgStgLInfo");
        $stg->stgStgAInfo = getFormFieldValue("stgStgAInfo");
    
        $stg->stgBigH = getFormFieldValue("stgBigH");
    
        $stg->stgFOrganisationsform = getFormFieldValue("stgFOrganisationsform");
        $stg->stgFStudienplaetze = getFormFieldValue("stgFStudienplaetze");
        $stg->stgFBewerbungsmodus = getFormFieldValue("stgFBewerbungsmodus");
        $stg->stgFDauer = getFormFieldValue("stgFDauer");
        $stg->stgFAkadGrad = getFormFieldValue("stgFAkadGrad");
        $stg->stgFUnterrichtssprache = getFormFieldValue("stgFUnterrichtssprache");
        $stg->stgFBesonderheit = getFormFieldValue("stgFBesonderheit");
        $stg->stgFAuslandsaufenthalt = getFormFieldValue("stgFAuslandsaufenthalt");
        $stg->stgFKosten = getFormFieldValue("stgFKosten");
        $stg->stgFZugangsvoraussetzungen = getFormFieldValue("stgFZugangsvoraussetzungen");
        $stg->stgBFelder = getFormFieldValue("stgBFelder");
        $stg->stgStgA = getFormFieldValue("stgStgA");
    	$stg->stgKBeschreibung = getFormFieldValue("stgKBeschreibung");
    	
    	if(!$this->form_validation->run() || !$stg->save()) {
			throw new Exception($validation);
    	}
    	
        if($image = getFormFieldImage("stgStgLImage")) {
        	$stg->stgStgLImage = $image;
        }
    	if(!$stg->save("stgStgLImage")) {
			throw new Exception($validation);
    	}
    	
        if($image = getFormFieldImage("stgStgAImage")) {
        	$stg->stgStgAImage = $image;
        }
    	if(!$stg->save("stgStgAImage")) {
			throw new Exception($validation);
    	}
    	
        if($image = getFormFieldImage("stgHImage1")) {
        	$stg->stgHImage1 = $image;
        }
    	if(!$stg->save("stgHImage1")) {
			throw new Exception($validation);
    	}
    	
        if($image = getFormFieldImage("stgHImage2")) {
        	$stg->stgHImage2 = $image;
        }
    	if(!$stg->save("stgHImage2")) {
			throw new Exception($validation);
    	}
    	
        if($image = getFormFieldImage("stgCurriculumImage")) {
        	$stg->stgCurriculumImage = $image;
        }
    	if(!$stg->save("stgCurriculumImage")) {
			throw new Exception($validation);
    	}
    	
        if($image = getFormFieldImage("stgFImage")) {
        	$stg->stgFImage = $image;
        }
    	if(!$stg->save("stgFImage")) {
			throw new Exception($validation);
    	}
    	
        if($image = getFormFieldImage("stgBImage1")) {
        	$stg->stgBImage1 = $image;
        }
    	if(!$stg->save("stgBImage1")) {
			throw new Exception($validation);
    	}
    	
        if($image = getFormFieldImage("stgBImage2")) {
        	$stg->stgBImage2 = $image;
        }
    	if(!$stg->save("stgBImage2")) {
			throw new Exception($validation);
    	}
    	
        if($image = getFormFieldImage("stgKImage1")) {
        	$stg->stgKImage1 = $image;
        }
    	if(!$stg->save("stgKImage1")) {
			throw new Exception($validation);
    	}
    	
        if($image = getFormFieldImage("stgKImage2")) {
        	$stg->stgKImage2 = $image;
        }
    	if(!$stg->save("stgKImage2")) {
			throw new Exception($validation);
    	}
    	
        if($image = getFormFieldImage("stgImage")) {
        	$stg->stgImage = $image;
        }
    	if(!$stg->save("stgImage")) {
			throw new Exception($validation);
    	}
        
        $stg->freigabe = getFormFieldBoolean("freigabe");

        if($stg->freigabe) {
        	/*
        	// Freigabe nur wenn alle Felder ausgef�llt sind
        	if(!($stg->stgName && $stg->stgArt && $stg->highlights && $stg->titelbild)) {
        		$stg->freigabe = false;
        		$this->addAlert("Der Studiengang kann nicht freigegeben werden, da nicht alle Felder ausgef&uuml;llt wurden.");
        	}
        	*/
        }
        
        if($stg->save()) {
            if($target = getFormFieldValue("target")) {
            	redirect($target);
            } else {
                $this->addSuccess("Der Eintrag wurde erfolgreich gespeichert.");
            }
       	}else{
			$this->addError("Der Studiengang konnte nicht gespeichert werden.");
       	}
        
    	} catch(Exception $ex) {
    		if($ex->getMessage()!=$validation) {
    			$this->addError($ex->getMessage());
    		}
    	}
    	
        $this->edit(null,$stg);
    }
    
    public function delete($stgID) {
        try {
            $stg = new StudiengangData($stgID);
            $stg->delete();
        } catch(Exception $e) {
        	$this->addError($e->getMessage());
        }
        $this->index();
    } 

}