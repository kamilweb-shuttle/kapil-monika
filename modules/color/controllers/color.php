<?php
class Category extends Public_Controller
{
	
	public function __construct()
	{
		parent::__construct();  
		$this->load->helper(array('category/category'));	 
		$this->load->model(array('category/category_model'));
		
	}
	
	public function index()
	{
		
		
		$data['title'] = "Category";
		
		$record_per_page        = (int) $this->input->post('per_page');
		
		$parent_segment         = (int) $this->uri->segment(3);
		$page_segment           = find_paging_segment();	
		
		$config['per_page']		= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');
		
		$offset                 =  (int) $this->uri->segment($page_segment,0);	
		
		$parent_id              = ( $parent_segment > 0 ) ?  $parent_segment : '0';		
		
		$base_url               = ( $parent_segment > 0 ) ?  "category/index/$parent_id/pg/" : "category/index/pg/";
		
		
		$condtion_array = array(
		'field' =>"*,( SELECT COUNT(category_id) FROM wl_categories AS b
		WHERE b.parent_id=a.category_id ) AS total_subcategories",
		'condition'=>"AND parent_id = '$parent_id' AND status='1' ",
		'limit'=>$config['per_page'],
		'offset'=>$offset	,
		'debug'=>FALSE
		);	
		
		
		$res_array              =  $this->category_model->getcategory($condtion_array);						
		$config['total_rows']	=  $this->category_model->total_rec_found;
		$data['page_links']     = front_pagination("$base_url",$config['total_rows'],$config['per_page'],$page_segment);
		
		
		$data['heading_title'] = 'Category Lists';
		$data['res'] = $res_array; 	
		
		$data['parentres']=isset($parentdata) && is_object($parentdata) ? $parentdata : "";
		
		$data['unq_section'] = isset($parentdata) && is_object($parentdata) ? "Subcategory" : "Category";	
				
		$this->load->view('category/view_category',$data);
		
		
	}
	
	
	
}
/* End of file member.php */
/* Location: .application/modules/products/controllers/products.php */
