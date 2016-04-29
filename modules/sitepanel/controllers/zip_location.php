<?php
class Zip_location extends Admin_Controller
{

	public function __construct(){
		parent::__construct();
		$this->config->set_item('menu_highlight','other management');	
		$this->load->model(array('zip_location_model')); 	
	}
	
	public  function index(){
		$pagesize               =  (int) $this->input->get_post('pagesize');
		$config['limit']	    =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');
		$offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	
		$base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));
		$res_array              =  $this->zip_location_model->get_location($offset,$config['limit']);
		$config['total_rows']	= 	$this->zip_location_model->total_rec_found;	
		$data['page_links']     =  admin_pagination("$base_url",$config['total_rows'],$config['limit'],$offset);
		$data['heading_title']  =   'Manage Zip Location';
		$data['res']            =  $res_array; 
		if($this->input->post('status_action')!=''){
			$this->update_status('tbl_zip_location','zip_location_id');
		}
		
		/* upload Excel */
		if($this->input->post('action')=='submit_excel'){
			$this->form_validation->set_rules('excel_file','Upload Excel File','required|callback_check_upload_excel');
			if($this->form_validation->run()==TRUE){
				require_once FCPATH.'apps/third_party/Excel/reader.php';
				$data = new Spreadsheet_Excel_Reader();
				$data->setOutputEncoding('CP1251');		
				
				//$data->setUTFEncoder('');
				chmod($_FILES["excel_file"]["tmp_name"], 0777);
				$data->read($_FILES["excel_file"]["tmp_name"]);
				$worksheet=$data->sheets[0]['cells'];
				
				$process_add = $this->zip_location_model->add_bulk_upload_location($worksheet);
				//echo "sss";
				if($process_add===TRUE){
					$this->session->set_userdata(array('msg_type'=>'success'));
					$this->session->set_flashdata('success','Excel file inserted successfully!!!');	
					redirect('sitepanel/zip_location','');
				}
				else{
					$this->form_validation->_error_array['image']='Uploading Failed.Please Try Again';	  
				}				
			}
		}
		
		$this->load->view('zip_location/view_list',$data);	
	}
	
	public function add(){
		$data['heading_title'] = 'Add Zip Location';			
		$this->form_validation->set_rules('location_name','Location Name',"trim|required|max_length[50]|xss_clean|unique[tbl_zip_location.location_name='".$this->db->escape_str($this->input->post('location_name'))."' AND status!='2']");
		$this->form_validation->set_rules('zip_code','Zip Code',"trim|required|max_length[50]|xss_clean");
		$this->form_validation->set_rules('cod','COD Available',"required");
		
		if($this->form_validation->run()==TRUE){
			$posted_data = array(
				'location_name'		=>	$this->input->post('location_name',TRUE),
				'zip_code'				=>	$this->input->post('zip_code',TRUE),
				'cod'							=>	$this->input->post('cod',TRUE),
				'added_date'   		=>	$this->config->item('config.date.time')
			);
			$this->zip_location_model->safe_insert('tbl_zip_location',$posted_data,FALSE);
			$this->session->set_userdata(array('msg_type'=>'success'));
			$this->session->set_flashdata('success',lang('success'));		
			redirect('sitepanel/zip_location', '');
		}
		$this->load->view('zip_location/view_add',$data);		
	}
	
	public function edit(){
		$data['heading_title'] = 'Edit Zip Location';
		$Id = (int) $this->uri->segment(4);
		$rowdata=$this->zip_location_model->get_zip_location_by_id($Id);
			
		if( is_object($rowdata) ){
			$this->form_validation->set_rules('location_name','Location Name',"trim|required|xss_clean|max_length[50]|unique[tbl_zip_location.location_name='".$this->db->escape_str($this->input->post('location_name'))."' AND status!='2' AND zip_location_id!='".$Id."']");
			$this->form_validation->set_rules('zip_code','Zip Code',"trim|required|max_length[50]|xss_clean");
			
			if($this->form_validation->run()==TRUE){
				$posted_data = array(
					'location_name'	=>	$this->input->post('location_name',TRUE),
				  'zip_code'	=>	$this->input->post('zip_code',TRUE),
					'cod'							=>	$this->input->post('cod',TRUE),
				);
				$where = "zip_location_id = '".$rowdata->zip_location_id."'"; 						
				$this->zip_location_model->safe_update('tbl_zip_location',$posted_data,$where,FALSE);	
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',lang('successupdate'));		
				redirect('sitepanel/zip_location/'.query_string(), ''); 	
			}
			$data['res']=$rowdata;
			$this->load->view('zip_location/view_edit',$data);
		}
		else{
			redirect('sitepanel/zip_location', ''); 	 
		}
	}
	   
	public function check_upload_excel(){
		$filearrext=array('xls');
		if($_FILES['excel_file']['name']==''){
			$this->form_validation->set_message('check_upload_excel', 'Please upload excel file.');
			return FALSE;
		}
		if($_FILES['excel_file']['name']!=''){
			$extension = substr(strrchr($_FILES['excel_file']['name'], '.'), 1);
			if(!in_array($extension, $filearrext)){
				$this->form_validation->set_message('check_upload_excel', 'Please upload (xls) file only.');
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
	}
}
//controllet end