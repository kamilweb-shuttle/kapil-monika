<?php
class Courier_Company extends Admin_Controller
{

	public function __construct(){
		parent::__construct();
		$this->config->set_item('menu_highlight','other management');	
		$this->load->model(array('courier_company_model', 'zip_location_model')); 	
	}
	
	public  function index(){
		$pagesize               =  (int) $this->input->get_post('pagesize');
		$config['limit']	    	=  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');
		$offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	
		$base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));
		
		$res_array              =  $this->courier_company_model->get_location($offset,$config['limit']);
		$config['total_rows']		=  $this->courier_company_model->total_rec_found;
		
		$data['page_links']     =  admin_pagination("$base_url",$config['total_rows'],$config['limit'],$offset);
		$data['heading_title']  =  'Manage Courier Company';
		$data['res']            =  $res_array;
		
		if($this->input->post('status_action')!=''){
			$this->update_status('tbl_courier_company','company_id');
		}
		$this->load->view('courier_company/view_list',$data);	
	}
	
	public function add(){
		$data['heading_title'] 	=	'Add Zip Location';			
		$pin_res              	= $this->zip_location_model->get_location(0, 1000000);
		$data['pin_res']				=	$pin_res;
		//trace($pin_res);
		
		$this->form_validation->set_rules('company_name','Courier Company Name',"trim|required|max_length[80]|xss_clean|unique[tbl_courier_company.company_name = '".$this->db->escape_str($this->input->post('company_name'))."' AND status!='2']");
		$this->form_validation->set_rules('picode','Pincode',"required");
		
		if($this->form_validation->run()==TRUE){
			//trace($this->input->post('picode'));
			//exit;
			$pincodes = implode(',',$this->input->post('picode'));
			$posted_data = array(
				'company_name'		=>	$this->input->post('company_name',TRUE),
				'zip_code'				=>	$pincodes,
				'added_date'   		=>	$this->config->item('config.date.time')
			);
			$this->courier_company_model->safe_insert('tbl_courier_company',$posted_data,FALSE);
			$this->session->set_userdata(array('msg_type'=>'success'));
			$this->session->set_flashdata('success',lang('success'));		
			redirect('sitepanel/courier_company', '');
		}
		$this->load->view('courier_company/view_add',$data);		
	}
	
	public function edit(){
		$data['heading_title'] 	= 'Edit Courier Company';
		$pin_res              	= $this->zip_location_model->get_location(0, 1000000);
		$data['pin_res']				=	$pin_res;
		
		$Id = (int) $this->uri->segment(4);
		$rowdata=$this->courier_company_model->get_zip_location_by_id($Id);
			
		if( is_object($rowdata) ){
			$this->form_validation->set_rules('company_name','Company Name',"trim|required|xss_clean|max_length[80]|unique[tbl_courier_company.company_name = '".$this->db->escape_str($this->input->post('company_name'))."' AND status!='2' AND company_id!='".$Id."']");			
			$this->form_validation->set_rules('picode','Pincode',"required");
			
			if($this->form_validation->run()==TRUE){
				$pincodes = implode(',',$this->input->post('picode'));
				$posted_data = array(
					'company_name'		=>	$this->input->post('company_name',TRUE),
					'zip_code'				=>	$pincodes,
				);
				$where = "company_id = '".$rowdata->company_id."'"; 						
				$this->courier_company_model->safe_update('tbl_courier_company',$posted_data,$where,FALSE);	
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',lang('successupdate'));		
				redirect('sitepanel/courier_company/'.query_string(), ''); 	
			}
			$data['res']=$rowdata;
			$this->load->view('courier_company/view_edit',$data);
		}
		else{
			redirect('sitepanel/courier_company', ''); 	 
		}
	}
	   
	/*---------Bulk Upload Location---------*/
	
	public function uploads_location(){
		$data['heading_title']	=	'Bulk Upload Location';
		if($this->input->post('action')=='excel_file'){
			$this->form_validation->set_rules('excel_file','Upload Excel File','required|file_allowed_type[xls]');
			if($this->form_validation->run()==TRUE){
				require_once FCPATH.'apps/third_party/Excel/reader.php';
				$data = new Spreadsheet_Excel_Reader();
				$data->setOutputEncoding('CP1251');
				
				//$data->setUTFEncoder('');
				chmod($_FILES["excel_file"]["tmp_name"], 0777);
				$data->read($_FILES["excel_file"]["tmp_name"]);
				$worksheet=$data->sheets[0]['cells'];
				//trace($worksheet);exit;
				if(is_array($worksheet) && !empty($worksheet)){
					for($i=2;$i<=count($worksheet);$i++){
						$location_name	=	(!isset($worksheet[$i][1])) ? '' : addslashes(trim($worksheet[$i][1]));
						$zip_code		=	(!isset($worksheet[$i][2])) ? '' : addslashes(trim($worksheet[$i][2]));
						
						$check_exist="SELECT * FROM tbl_zip_location WHERE zip_code='".$zip_code."' AND location_name='".$location_name."' ";
						$query_num=$this->db->query($check_exist);
						if($query_num->num_rows == 0){
							$data = array(
								'location_name'		=>	$location_name,
								'zip_code'			=>	$zip_code,
								'added_date' 		=>  date('Y-m-d h:i:s'),
								'status' 			=>  '1',
								'xls_type' 			=>  'Y',
							);
							$locationId =  $this->zip_location_model->safe_insert('tbl_zip_location',$data,FALSE);
						}
					}
					$this->session->set_userdata(array('msg_type'=>'success'));
					$this->session->set_flashdata('success',lang('success')); 
					redirect('sitepanel/zip_location/uploads_location', 'refresh');
					exit;
				}
				else{
					$this->form_validation->_error_array['image']='Uploading Failed.Please Try Again';	  
				}				
			}
		}
		$this->load->view('zip_location/view_bulk_upload',$data);
	}
	/*---------End Bulk Upload Location---------*/
}
//controllet end