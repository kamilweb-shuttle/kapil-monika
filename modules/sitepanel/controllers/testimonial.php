<?php
class Testimonial extends Admin_Controller
{
	public function __construct(){
		parent::__construct(); 				
		$this->load->model(array('testimonials/testimonial_model'));  		
		$this->config->set_item('menu_highlight','other management');				
	}
	 
	public  function index(){
		
		$pagesize               =  (int) $this->input->get_post('pagesize');
		$config['limit']			 	=  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');
		$offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	
		$base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));
		$res_array              =  $this->testimonial_model->get_testimonial($config['limit'],$offset);
		$config['total_rows']   =  get_found_rows();
		$data['page_links']     =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);
		$data['heading_title']  =  'Testimonial';
		$data['res']            =  $res_array; 
		
		if($this->input->post('status_action')!=''){
			
			if( $this->input->post('status_action')=='Delete'){
				$prod_id=$this->input->post('arr_ids');
				foreach($prod_id as $v){
					$where = array('entity_type'=>'testimonials/details/'.$v,'entity_id'=>$v);
					$this->testimonial_model->safe_delete('wl_meta_tags',$where,TRUE);
				}
			}
			
			$this->update_status('wl_testimonial','testimonial_id');
		}		
		$this->load->view('testimonial/view_testimonial_list',$data);		
	}
	
	public function post(){
		
		//$this->form_validation->set_rules('testimonial_title','Title','trim|required|xss_clean|max_length[150]');
		//$this->form_validation->set_rules('email','Email','trim|valid_email|xss_clean|max_length[80]');
		$this->form_validation->set_rules('poster_name','Name','trim|required|alpha|xss_clean|max_length[30]');
		$this->form_validation->set_rules('testimonial_description','Comment','trim|required|xss_clean|max_length[8500]');
		$data['ckeditor']  =  set_ck_config(array('textarea_id'=>'testimonial_description'));		
		if($this->form_validation->run()==TRUE){
			$maxID = get_db_field_value('wl_testimonial','MAX(testimonial_id)',' WHERE 1');
			//echo_sql();
			$maxID = $maxID+1;
			//exit;
			$postedURL = $this->input->post('poster_name').'-'.$maxID;
			$posted_data=array(				
			//'testimonial_title'      => $this->input->post('testimonial_title',TRUE),
			'poster_name'             => $this->input->post('poster_name'),
			//'email'                   => $this->input->post('email'),
			'friendly_url'						=> seo_url_title($postedURL),
			'testimonial_description' => $this->input->post('testimonial_description'),
			'status'=>'1',						
			'posted_date'            =>$this->config->item('config.date.time')
			);
			
			$insertId = $this->testimonial_model->safe_insert('wl_testimonial',$posted_data,FALSE); 			
			
			if( $insertId > 0 ){
				$posted_friendly_url = $this->input->post('poster_name');
				$posted_friendly_url = $posted_friendly_url.'-'.$insertId;
				$this->cbk_friendly_url = seo_url_title($posted_friendly_url);
				$redirect_url = "testimonials/details/".$insertId;
				
				$meta_array  = array(
					'entity_type'=>$redirect_url,
					'entity_id'=>$insertId,
					'page_url'=>$this->cbk_friendly_url,
					'meta_title'=>get_text($this->input->post('poster_name'),80),
					'meta_description'=>get_text($this->input->post('testimonial_description')),
					'meta_keyword'=>get_keywords($this->input->post('testimonial_description'))
				);
				create_meta($meta_array);
			}
			
			$message = $this->config->item('testimonial_post_success');			
			$message = str_replace('<site_name>',$this->config->item('site_name'),$message);									
			$this->session->set_userdata(array('msg_type'=>'success'));
			$this->session->set_flashdata('success',$message);
			redirect('sitepanel/testimonial', ''); 
		}		
		$data['heading_title'] = "Post Testimonial";	
		$this->load->view('testimonial/view_post_testimonials',$data);	
	}
	
	
	public function edit(){
		
		$id = (int) $this->uri->segment(4);		
		$param     = array('where'=>"testimonial_id ='$id' ");	
	  $res       = $this->testimonial_model->get_testimonial(1,0,$param);	
		if( is_array($res) && !empty($res) ){
			$seo_url_length = $this->config->item('seo_url_length');
			$this->cbk_friendly_url = seo_url_title($this->input->post('friendly_url',TRUE));
				
			//$this->form_validation->set_rules('testimonial_title','Title','trim|required|xss_clean|max_length[150]');
			//$this->form_validation->set_rules('email','Email','trim|valid_email|xss_clean|max_length[80]');
			$this->form_validation->set_rules('poster_name','Name','trim|required|alpha|xss_clean|max_length[30]');
			$this->form_validation->set_rules('testimonial_description','Comment','trim|required|xss_clean|max_length[8500]');
			$this->form_validation->set_rules('friendly_url','Page URL',"trim|required|max_length[$seo_url_length]|xss_clean|unique[wl_meta_tags.page_url ='".$this->cbk_friendly_url."' AND entity_id!='".$id."'] ");
				
			$data['ckeditor']  =  set_ck_config(array('textarea_id'=>'testimonial_description'));		
			
			if($this->form_validation->run()==TRUE){
				
				
				
				$posted_data=array(				
					//'testimonial_title'     => $this->input->post('testimonial_title',TRUE),
					'poster_name'             => $this->input->post('poster_name'),
					//'email'                 => $this->input->post('email'),
					'friendly_url'						=> $this->cbk_friendly_url,
					'testimonial_description' => $this->input->post('testimonial_description')
				);					
				$where = "testimonial_id = '".$res['testimonial_id']."'"; 				
				$insertId = $this->testimonial_model->safe_update('wl_testimonial',$posted_data,$where,FALSE);
				update_meta_page_url('testimonials/details/'.$id,$id,$this->cbk_friendly_url);
				
				$this->session->set_userdata(array('msg_type'=>'success'));				
				$this->session->set_flashdata('success',lang('successupdate'));	
				redirect('sitepanel/testimonial', ''); 
			}		
			$data['heading_title'] = "Edit Testimonial";	
			$data['res'] = $res;	
			$this->load->view('testimonial/view_edit_testimonials',$data);	
		}
		else{
			redirect('sitepanel/testimonial', ''); 
		}
	}	
}
// End of controller