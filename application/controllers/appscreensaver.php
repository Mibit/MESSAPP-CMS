<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
    
class AppScreensaver extends MA_Controller {

    public function __construct() {
       parent::__construct();
       
       $this->load->model("ScreensaverData");
       
       //my_path muss im AC_Controller immer gesetzt werden
       $this->my_path = 'appscreensaver';
    }
    
    public function index() {
    	// 
        $screensaver = new ScreensaverData();
        
        $variables["page_title"] = "App Screensaver";
        
        $variables["screensaver"] = $screensaver->loadMultipleFromDatabase();
        
        //AC Methode um Views anzuzeigen
        $this->loadView('appscreensaver', $variables);
    }
}
    