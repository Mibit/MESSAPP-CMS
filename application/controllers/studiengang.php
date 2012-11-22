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
        
        //Sidebar aktivieren
        $this->setIsSidebar(true);
        $this->setSidebar(null,$stg->loadMultipleFromDatabase("", "stgKBez", "asc"),$stg->stgID, "studiengang_sidebar");
        
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
        $this->form_validation->set_rules('stgFKosten', 'Kosten', 'max_length[25]');
        $this->form_validation->set_rules('stgFZugangsvoraussetzung', 'Zugangsvoraussetzungen', 'max_length[250]');
        // stgFImage
        $this->form_validation->set_rules('stgBFelder', 'Berufsfelder', 'max_length[250]');
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
        if($image = getFormFieldImage("stgStgLImage")) {
        	$stg->stgStgLImage = $image;
        }
        $stg->stgStgA = getFormFieldValue("stgStgA");
        if($image = getFormFieldImage("stgStgAImage")) {
        	$stg->stgStgAImage = $image;
        }
        $stg->stgQuote = getFormFieldValue("stgQuote");
        $stg->stgHighlights = getFormFieldValue("stgHighlights");
        $stg->stgStgLInfo = getFormFieldValue("stgStgLInfo");
        $stg->stgStgAInfo = getFormFieldValue("stgStgAInfo");
        if($image = getFormFieldImage("stgHImage1")) {
        	$stg->stgHImage1 = $image;
        }
        if($image = getFormFieldImage("stgHImage2")) {
        	$stg->stgHImage2 = $image;
        }
        $stg->stgBigH = getFormFieldValue("stgBigH");
        if($image = getFormFieldImage("stgCurriculumImage")) {
        	$stg->stgCurriculumImage = $image;
        }
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
        if($image = getFormFieldImage("stgFImage")) {
        	$stg->stgFImage = $image;
        }
        $stg->stgBFelder = getFormFieldValue("stgBFelder");
        if($image = getFormFieldImage("stgBImage1")) {
        	$stg->stgBImage1 = $image;
        }
        if($image = getFormFieldImage("stgBImage2")) {
        	$stg->stgBImage2 = $image;
        }
        $stg->stgKBeschreibung = getFormFieldValue("stgKBeschreibung");
        if($image = getFormFieldImage("stgKImage1")) {
        	$stg->stgKImage1 = $image;
        }
        if($image = getFormFieldImage("stgKImage2")) {
        	$stg->stgKImage2 = $image;
        }
        if($image = getFormFieldImage("stgImage")) {
        	$stg->stgImage = $image;
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
        if($this->form_validation->run()) {
            if($stg->save()) {
                $this->addSuccess("Der Eintrag wurde erfolgreich gespeichert.");
            }else{
                $this->addError("Diese Anrede existiert bereits.");
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