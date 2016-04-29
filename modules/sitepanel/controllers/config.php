<?php class Config extends Admin_Controller {			
		public function __construct() {			
		parent::__construct();				
		$this->load->model(array("sitepanel/sitepanel_model"));	
		}
                
                }