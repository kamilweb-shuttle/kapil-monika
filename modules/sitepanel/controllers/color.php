<?php
class Color extends Admin_Controller
{
	public function __construct()
	{		
		parent::__construct(); 				
		$this->load->model(array('color/color_model'));
		$this->config->set_item('menu_highlight','product management');				
	}
	 
	public  function index()
	{
		
		
		 $pagesize               =  (int) $this->input->get_post('pagesize');
	     $config['limit']		 =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');		 		 				
		 $offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;		
		 $base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));				 
		 $parent_id              =   (int) $this->uri->segment(4,0);			
	     
		 $keyword = trim($this->input->get_post('keyword',TRUE));		
		 $keyword = $this->db->escape_str($keyword);
	     $condtion = " ";
		 
		
									
		$condtion_array = array(
		                'field' =>"*",
						 'index'=>'color_id',
						 'condition'=>$condtion,
						 'limit'=>$config['limit'],
						  'offset'=>$offset	,
						  'debug'=>FALSE
						 );							 						 	
		$res_array              =  $this->color_model->getcolors($condtion_array);

		$config['total_rows']	=  $this->color_model->total_rec_found;	
		
		$data['page_links']     =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);
				
		$data['heading_title']  =  'Colors';
						
		$data['res']            =  $res_array; 	
		
		$data['parent_id']      =  $parent_id; 	
		
		
		if( $this->input->post('status_action')!='')
		{			
			$this->update_status('wl_colors','color_id');			
		}
		if( $this->input->post('update_order')!='')
		{			
			$this->update_displayOrder('wl_colors','sort_order','color_id');			
		}
						
		$this->load->view('catalog/view_color_list',$data);		
		
		
	}	
	
	public function add()
	{
		 $data['heading_title'] = 'Add Color';
		
		
		
		 $this->form_validation->set_rules('color_name','Color Name',"trim|required|max_length[32]|xss_clean|unique[wl_colors.color_name='".$this->db->escape_str($this->input->post('color_name'))."' AND status!='2']");
		$this->form_validation->set_rules('color_code','Color Code',"trim|required|max_length[6]|xss_clean");
		
		 
		if($this->form_validation->run()===TRUE)
		{
			    $posted_data = array(
					'color_name'=>$this->input->post('color_name'),
					'color_code'=>$this->input->post('color_code'),
					'color_date_added'=>$this->config->item('config.date.time')
				 );
								
		    $this->color_model->safe_insert('wl_colors',$posted_data,FALSE);	
								
			$this->session->set_userdata(array('msg_type'=>'success'));			
			$this->session->set_flashdata('success',lang('success'));				
			redirect('sitepanel/color', '');		
					
		}	
		$this->load->view('catalog/view_color_add',$data);		  
		  
	}
	
	
	public function edit()
	{
		$colorId = (int) $this->uri->segment(4);
		
		$rowdata=$this->color_model->get_color_by_id($colorId);
				
		
		
		$data['heading_title'] = 'Color';
		
		if( !is_array($rowdata) )
		{
			$this->session->set_flashdata('message', lang('idmissing'));	
			redirect('sitepanel/color', ''); 	
			
		}
		$colorId = $rowdata['color_id'];		

			$this->form_validation->set_rules('color_name','Color Name',"trim|required|max_length[32]|xss_clean|unique[wl_colors.color_name='".$this->db->escape_str($this->input->post('color_name'))."' AND status!='2' AND color_id!='".$rowdata['color_id']."']");

			$this->form_validation->set_rules('color_code','Color Code',"trim|required|max_length[6]|xss_clean");
			 		
			
			if($this->form_validation->run()==TRUE)
			{	
				$posted_data = array(
					'color_name'=>$this->input->post('color_name'),
					'color_code'=>$this->input->post('color_code'),
					'color_date_updated'=>$this->config->item('config.date.time')
				 );
				 
			 	$where = "color_id = '".$colorId."'"; 				
				$this->color_model->safe_update('wl_colors',$posted_data,$where,FALSE);	
							
				$this->session->set_userdata(array('msg_type'=>'success'));				
				$this->session->set_flashdata('success',lang('successupdate'));								
				
				redirect('sitepanel/color'.'/'.query_string(), ''); 	
							
			}						
			
		$data['edit_result']=$rowdata;		
		$this->load->view('catalog/view_color_edit',$data);				
		
	}
	
	
}
// End of controller