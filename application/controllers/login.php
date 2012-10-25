<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

class Login extends CI_Controller {

    protected $testmodeLogin = false;
    
	function __construct() {
		parent::__construct();
		
        $this->load->model("UserData");
	
        if(!isset($_SESSION)) {
            session_start();
        }
	}

	function index($error = null, $username = null, $password = null) {
		$variables = new stdClass();
		$variables->username = $username;
		if($error) {
			$variables->error = array($error);
		}
		$variables->template_url = base_url()."/".APPPATH."views/template/";
		$variables->my_url = base_url().index_page()."/login";
        $variables->systemMessages =  $this->load->view("template/system_messages", $variables, true);
		$this->load->view("login", $variables);
	}

	function authentification() {
		try{
			$user = $_POST["username"];
			$password = $_POST["password"];
			$thisUser = $this->authenticate($user, $password);
            
			if(isset($_SESSION["redirect_url"])) {
			   redirect($_SESSION["redirect_url"]);
			} else {
	           redirect($this->router->routes["default_controller"]);
			}
		} catch(Exception $e) {
			$this->index($e->getMessage(),$user,$password);
		}
	}
    
    private function authenticate($username, $password) {

        if($username == "" || $password == "") {
            throw new Exception("Geben Sie Username und Passwort ein.");
        }

        $thisUser = UserData::checkAuthentification($username, $password);
        
        $_SESSION["user"] = $thisUser;
        
        return $thisUser;
    }

	/**
	 * Logout user
	 *
	 * @access	public
	 * @return	void
	 */
	function logout() {
		session_destroy();
		redirect("login");
	}
}
?>