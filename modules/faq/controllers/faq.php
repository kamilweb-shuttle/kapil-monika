<?php
class Faq extends Public_Controller
{
	public function __construct(){
		parent::__construct(); 
		$this->load->model(array('faq/faq_model'));
		$this->form_validation->set_error_delimiters("<div class='required'>","</div>");
	}
	
	public function index(){
		$record_per_page        = (int) $this->input->get_post('per_page');		
		$parent_segment         = (int) $this->uri->segment(3);
		$page_segment           = find_paging_segment();		
		$config['per_page']			= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');		
		$offset                 =  (int) $this->uri->segment($page_segment,0);			
		$base_url               = "faq/index/pg/";
			
		$param = array('status'=>'1');
		$res_array               = $this->faq_model->get_faq($config['per_page'],$offset,$param);	
		
		$config['total_rows']	 = $data['total_rows'] = get_found_rows();			
                $data['page_links']      = front_pagination("$base_url",$config['total_rows'],$config['per_page'],$page_segment);			
                $data['title'] = "FAQ's";
		$data['res'] = $res_array; 	
		$data['include']='faq/view_faq';
		$this->load->view('view_faq', $data);		
	}
}
?>