<?php
class Home extends Public_Controller
{

	public function __construct()
	{
		parent::__construct();				
		$this->load->model(array('home/home_model','products/product_model'));
		$this->load->helper(array('category/category','products/product'));	 
		
	}
	
	public function index()
	{
		
		$data['page_title']            = "";
		$data['page_keyword']          = "";
		$data['page_description']      = "";
		
		$param1 = array('status'=>'1','where'=>"featured_product ='1'");	
		$featured_product=$this->product_model->get_products(6,0,$param1);
		$data['total_featured_product'] = get_found_rows();
		
		$data['featured_product'] = $featured_product;
		
		$this->load->view('home',$data);	
	}

}