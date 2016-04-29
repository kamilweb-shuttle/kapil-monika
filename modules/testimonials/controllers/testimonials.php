<?php
class Testimonials extends Public_Controller
{

	public function __construct(){
		parent::__construct(); 
		$this->load->model(array('testimonials/testimonial_model'));
		$this->load->helper(array('category/category'));
    $this->form_validation->set_error_delimiters("<div class='required'>","</div>");
	}

	public function index(){
		
		$record_per_page         = (int) $this->input->post('per_page');		
		$parent_segment          = (int) $this->uri->segment(3);
		$page_segment            =  find_paging_segment();
		
		if($this->input->post('action')!=''){
			$this->form_validation->set_rules('name','Name','trim|required|alpha|xss_clean|max_length[30]');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[80]');
			$this->form_validation->set_rules('comments','Comment','trim|required|xss_clean|max_length[8500]');
			$this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code');
			
			if($this->form_validation->run()==TRUE){
				$posted_data=array(
				'poster_name'             => $this->input->post('name'),
				'email'                   => $this->input->post('email'),
				'testimonial_description' => $this->input->post('comments'),						
				'posted_date'            =>$this->config->item('config.date.time')
				);			
				$this->testimonial_model->safe_insert('tbl_testimonial',$posted_data,FALSE); 
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success','Your testimonial has been posted successfully.');
				redirect($_SERVER['HTTP_REFERER'].'#testimonial'); 
				exit;
			}
		}				
		$config['per_page']	  =  ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');				
		$offset                  =  (int) $this->uri->segment($page_segment,0);								
		$base_url                =   "testimonials/index/pg/";
		$param = array('status'=>'1');	
		if($this->input->get_post('testo_order_change')!=''){
			$order=$this->input->get_post('testo_order_change');
			if($order=='1')
				$param['orderby']="posted_date desc";
			else
				$param['orderby']="posted_date asc";
		}
		$res_array              = $this->testimonial_model->get_testimonial($config['per_page'],$offset,$param);		
		$config['total_rows']	=  $data['total_rows'] = get_found_rows();	
	  $data['page_links']      = front_pagination("$base_url",$config['total_rows'],$config['per_page'],$page_segment);				
		$data['title'] = 'Testimonials';
		$data['res'] = $res_array;
		$data['include']='testimonials/view_testimonials';
		$this->load->view('view_testimonials',$data);		
	}		

	public function details(){
		//$id = (int) $this->uri->segment(3);	
		$id = (int) $this->meta_info['entity_id'];	
		//exit;
		$param     = array('status'=>'1','where'=>"testimonial_id ='$id' ");	
		$res       = $this->testimonial_model->get_testimonial(1,0,$param);	
		if($this->input->post('action')!=''){
			$this->form_validation->set_rules('poster_name','Name','trim|required|alpha|xss_clean|max_length[30]'); 
			$this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[80]');
			$this->form_validation->set_rules('testimonial_description','Comment','trim|required|xss_clean|max_length[8500]');
			$this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code');
			
			if($this->form_validation->run()==TRUE){
				$posted_data=array(				
					'poster_name'             => $this->input->post('poster_name'),
					'email'                   => $this->input->post('email'),
					'testimonial_description' => $this->input->post('testimonial_description'),						
					'posted_date'            =>$this->config->item('config.date.time')
				);			
				$this->testimonial_model->safe_insert('tbl_testimonial',$posted_data,FALSE); 
				$message = $this->config->item('testimonial_post_success');			
				$message = str_replace('<site_name>',$this->config->item('site_name'),$message);
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',$message);
				redirect($_SERVER['HTTP_REFERER']); 
				exit;
			}
		}
		if(is_array($res) && !empty($res)){
			$data['title'] = 'Testimonials';
		  $data['res'] = $res; 
			$this->load->view('testimonials_details_view',$data);					
		}
		else{
			redirect('testimonials', ''); 
		}
	}	
}
/* End of file pages.php */
?>
