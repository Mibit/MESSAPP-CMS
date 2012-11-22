<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MA_Controller extends CI_Controller {

	// Paths
	private $templatePath = "template/";
	protected $my_path = "";
	
    // System messages
    private $info = Array();
    private $success = Array();
    private $alert = Array();
    private $error = Array();

	//Sidebar
	public $isSidebar = false;
	public $sidebar = Array();
	public $sidebarTemplate;
	
	//Listenansicht
	protected $isList = false;
	protected $listItems = array();
	private $limit = 20;
	protected $adjacents = 2;
	protected $totalItemCount = null;
    private $manualList = false;
        
    function __construct(){
		parent::__construct();

		$this->checkAuthentification();
	}
    
	private function checkAuthentification() {
    	$this->load->model("UserData");
    	session_start();
    	
    	if(!isset($_SESSION["user"])) {
    		$_SESSION["redirect_url"] = current_url();
			redirect($this->router->routes["default_login"]);
    	}
  	}
	
	public function getBaseUrl() {
		return base_url() . index_page() ."/";
	}
	
	public function getMyUrl() {
		return $this->getBaseURL() . $this->my_path . "/";
	}
        
	function loadView($view, $variables = null, $returnContent=false) {
		
		$template = $this->templatePath."layout";
            
		if(!isset($variables["header"])) {
			$variables["header"] = "";
		}
		
		$variables['template_url'] = base_url().APPPATH.'views/'.$this->templatePath;
		
		$variables['my_url'] = $this->getMyUrl();
		
        $search = "";
                   
		if($this->isList) {
			$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
			$sortCol = isset($_REQUEST['sortCol']) ? $_REQUEST['sortCol'] : "";
			$sortDir = isset($_REQUEST['sortDir']) ? $_REQUEST['sortDir'] : "";
            $search = isset($_REQUEST['search']) ? $_REQUEST['search'] : "";

			$outputItems = $this->listItems;
			
			if($search != '') {
				$this->objectFilter($outputItems, $search);
			}
						
			if($sortCol != '') {
				$this->objectSort($outputItems, $sortCol, $sortDir);
			}
			
			try {
				$variables['listItems'] = $this->getDisplayItems($outputItems, $page, $search, $sortCol, $sortDir, $variables);
			} catch (Exception $e) {
				$this->addError($e->getMessage());
				$variables['listItems'] = array();
			}
			
			$variables['listPagination'] = $this->getPaginationString($outputItems, $page, 'index');
			$variables['sortCol'] = isset($_REQUEST['sortCol']) ? $_REQUEST['sortCol'] : "";
			$variables['sortDir'] = isset($_REQUEST['sortDir']) ? $_REQUEST['sortDir'] : "";
			$variables['search'] = $search;
		}
		
		if($this->isSidebar) {
			$variablesSidebar = $this->sidebar;
			$variablesSidebar['base_url'] = $this->getBaseUrl();
			$variablesSidebar['my_url'] = $this->getMyUrl();
			$variables['sidebar'] = $this->load->view($this->sidebarTemplate, $variablesSidebar, true);
			
        	$variables['header'] .= "<script src=\"" . $variables['template_url'] . "js/sidebar.js\"></script>";
 
      	} else {
      		$variables['sidebar'] = null;
      	}
		
        $variables["info"] = $this->getInfo();
		$variables["success"] = $this->getSuccess();
		$variables["alert"] = $this->getAlert();
        $variables["error"] = $this->getError();
            
		$variables["mainContent"] = $this->load->view($view, $variables, true);
		
		if($this->isList) {
			$variables["mainContent"] = $this->load->view($this->templatePath."list", $variables, true);
		}
		
		if($returnContent) {
			return $mainContent;
		} else {
            $variables["systemMessages"] = $this->load->view($this->templatePath."system_messages", $variables, true);
			$this->load->view($template, $variables);
		}
				
	}
		
	// function to return the current objects to display
	function getDisplayItems(&$sortedList, $page = 1, $search = null, $sortCol = null, $sortDir = null, &$variables) {
		$lastpage = ceil(count($sortedList)/$this->limit);
		if($page > $lastpage) {
			$page = $lastpage;
		}
		return array_slice($sortedList, ($page-1)*$this->limit, $this->limit );
	}
	
	// function to return the pagination string
	function getPaginationString(&$outputItems, $page = 1, $method = '') {		
		
		$totalitems = $this->totalItemCount != null ? $this->totalItemCount : count($outputItems);
		
		$lastpage = ceil($totalitems / $this->limit);	
		if($page > $lastpage) {
			$page = $lastpage;
		}
	
		$variables = array();
		
		$variables["page"] = $page;
		$variables["lastpage"] = $lastpage;
		$variables["prev"] = $page - 1;
		$variables["next"] = $page + 1;
		$variables["adjacents"] = $this->adjacents;;
		$variables["nextToLastPage"] = $lastpage - 1; //last page minus 1
		
		return $this->load->view($this->templatePath."pagination", $variables, true);
		
		/*
		$pagination = "";
		if($lastpage > 1) {
			$pagination .= "<div class=\"pagination\">";

			//previous button
			if ($page > 1) 
								$pagination .= "<div class=\"button2-right\"><div class=\"prev\"><a href=\"" . $this->getJSPageLink($prev) . "\">Prev</a></div></div>";
			else
				$pagination .= '<div class="button2-right off"><div class="prev"><span>Prev</span></div></div>';

			$pagination .= '<div class="button2-left"><div class="page">';
			//pages	
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination .= "<span class=\"current\">$counter</span>";
					else
						$pagination .= "<a href=\"" . $this->getJSPageLink($counter) . "\">$counter</a>";					
				}
			}
			elseif($lastpage >= 7 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 3))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span class=\"current\">$counter</span>";
						else
							$pagination .= "<a href=\"" . $this->getJSPageLink($counter) . "\">$counter</a>";					
					}
					$pagination .= "<a href=\"#\">...</a>";
					$pagination .= "<a href=\"" . $this->getJSPageLink($lpm1) . "\">$lpm1</a>";
					$pagination .= "<a href=\"" . $this->getJSPageLink($lastpage) . "\">$lastpage</a>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination .= "<a href=\"" . $this->getJSPageLink(1) . "\">1</a>";
					$pagination .= "<a href=\"" . $this->getJSPageLink(2) . "\">2</a>";
					$pagination .= "<a href=\"#\">...</a>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span class=\"current\">$counter</span>";
						else
							$pagination .= "<a href=\"" . $this->getJSPageLink($counter) . "\">$counter</a>";					
					}
					$pagination .= "<a href=\"#\">...</a>";
					$pagination .= "<a href=\"" . $this->getJSPageLink($lpm1) . "\">$lpm1</a>";
					$pagination .= "<a href=\"" . $this->getJSPageLink($lastpage) . "\">$lastpage</a>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination .= "<a href=\"" . $this->getJSPageLink(1) . "\">1</a>";
					$pagination .= "<a href=\"" . $this->getJSPageLink(2) . "\">2</a>";
					$pagination .= "<a href=\"#\">...</a>";
					for ($counter = $lastpage - (1 + ($adjacents * 3)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span class=\"current\">$counter</span>";
						else
							$pagination .= "<a href=\"" . $this->getJSPageLink($counter) . "\">$counter</a>";					
					}
				}
			}
			$pagination .= '</div></div>';
			
			//next button
			if ($page < $lastpage) 
				$pagination .= "<div class=\"button2-left\"><div class=\"next\"><a href=\"" . $this->getJSPageLink($next) . "\">Next</a></div></div>";
			else
				$pagination .= '<div class="button2-left off"><div class="next"><span>Next</span></div></div>';
			
			$pagination .= "<div class=\"limit\">Page $page of $lastpage</div>";
			
			$pagination .= "</div>\n";
		}
		
		return $pagination;
		*/
	}
	
	function objectFilter(&$listItems, $search) {
		$result = array();
		foreach($listItems as $item) {
			$dbFields = $item->getDbFields();
			foreach($dbFields as $field) {
				if(is_string($item->$field) && strpos(strtolower($item->$field), strtolower($search)) !== FALSE) {
					$result[] = $item;
					break;
				}
			}
		}
		$listItems = $result;
	}
	
	function objectSort(&$listItems, $key, $sortDir = 'asc') {

        for ($itemCounter = count($listItems) - 1; $itemCounter >= 0; $itemCounter--) {
       		for ($i = 0; $i < $itemCounter; $i++) {
            	if ($listItems[$i]->$key > $listItems[$i + 1]->$key) {
                    $tmp = $data[$i];
                    $listItems[$i] = $listItems[$i + 1];       
                    $listItems[$i + 1] = $tmp;
                }
          	}
       	}
        if($sortDir == 'desc') {
            $listItems = array_reverse($listItems);
        }
  	}

    protected function getInfo() { return $this->info; }
    protected function getSuccess() { return $this->success; }
    protected function getAlert() { return $this->alert; }
    protected function getError() { return $this->error; }
        
	protected function addInfo($info, $positionAtStart = false) {
    	if($positionAtStart) {
            array_push($this->info, $info);
        }else {
            array_unshift($this->info, $info);
       	}
    }
        
	protected function addSuccess($success, $positionAtStart = false) {
   		if($positionAtStart) {
            array_push($this->success, $success);
        }else {
            array_unshift($this->success, $success);
        }
  	}
        
	protected function addAlert($alert, $positionAtStart = false) {
     	if($positionAtStart) {
            array_push($this->alert, $alert);
       	}else {
            array_unshift($this->alert, $alert);
        }
    }
        
   	protected function addError($error, $positionAtStart = false) {
    	if($positionAtStart) {
        	array_push($this->error, $error);
        }else {
            array_unshift($this->error, $error);
        }
    }
        
    protected function setListItems($listItems) {
    	$this->listItems = $listItems;
    }
 
	function setList($isList) {
		$this->isList = $isList;
	}
        
    function setLimit($limit) {
    	$this->limit = $limit;
    }
        
    function getLimit() {
    	return $this->limit;
    }
		
	function setIsSidebar($isSidebar) {
		$this->isSidebar = $isSidebar;
	}
    
	function setSidebar($diskriminatoren, $items, $activeElementID, $template) {
		$this->sidebar["diskriminatoren"] = $diskriminatoren;
		$this->sidebar["items"] = $items;
		$this->sidebar["activeElementID"] = $activeElementID;
		$this->sidebarTemplate = $template;
	}
}
	
?>