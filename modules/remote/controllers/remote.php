<?php
class Remote extends MY_Controller {

	public function __construct() {
		parent::__construct(); 
	}
	 
	public  function index($page = null){	
		
	}	 
	
	public function remote_community(){	
	
		$cat_id                       = $this->input->post('cat_id');
		$community_id                 = $this->input->post('community_id');
		$data['cat_id']               = $cat_id;
		$data['community_id']         = $community_id;
		
		$this->load->view('remote/view_community_remote',$data);		
	}
	
	
	

	public function getstate(){
	  $data['ctry_id']=$this->input->post('ctry');
	  $data['state']=$this->input->post('state');
	  $this->load->view('view_state_dn',$data);	
	}

	public function getcity(){
	  $data['state_id']=$this->input->post('state');
	  $data['city']=$this->input->post('city');
	  $this->load->view('view_city_dn',$data);	
	}

	public function getpackage(){
	  $data['ctry_id']=$this->input->post('ctry');
	  $data['package_catid']=$this->input->post('package_catid');
	  $this->load->view('view_package_dk',$data);	
	}

	public function deleteProfileImage(){
		$decrypted_req_id=applyFilter('NUMERIC_GT_ZERO',$_REQUEST['propId']);
		$rqimg = $this->input->post('rmimg');
		if($rqimg!='' && $decrypted_req_id>0){
			$this->db->select('sl');
			$this->db->from('tbl_profile_images');
			$this->db->where(array('img'=>$rqimg,'ref_mem_id'=>$decrypted_req_id));
			$query = $this->db->get();  
			
			if($query->num_rows()>0){
			  $result = $query->row();
			  $jfile_dir=UPLOAD_DIR."/profiles/".$this->userId."/photos/".$rqimg;
			  if(file_exists($jfile_dir)){
				unlink($jfile_dir);
				$this->db->query("delete from tbl_profile_images where sl='".$result->sl."'");
			  }
			  echo 'success';
		   }
		}
		exit;
	}

	public function getReligionList(){
	  $data = array();
	  $this->load->view('view_religion_refine_list',$data);	
	}

	public function getCasteList(){
	  $data = array();
	  $religionId = $this->input->get_post('religion');
	  $religionId=applyFilter('NUMERIC_GT_ZERO',$religionId);
	  if($religionId!='')
	  {
		$data['caste'] = getCaste($religionId);
		$this->load->view('view_caste_refine_list',$data);	
	  }
	}

	public function getProfessionnList(){
	  $data = array();
	  $this->load->view('view_profession_refine_list',$data);	
	} 

	public function getCountryList(){
	  $data = array();
	  $data['country'] = getCountry();
	  $this->load->view('view_country_refine_list',$data);	
	}
	
	public function getStateList(){
	  $data = array();
	  $ctryId = $this->input->get_post('ctry');
	  $ctryId=applyFilter('NUMERIC_GT_ZERO',$ctryId);
	  if($ctryId!='')
	  {
		$data['state'] = getState($ctryId);
		$this->load->view('view_state_refine_list',$data);	
	  }
	}

	public function getCityList(){
	  $data = array();
	  $stateId = $this->input->get_post('state');
	  $stateId=applyFilter('NUMERIC_GT_ZERO',$stateId);
	  if($stateId!='')
	  {
		$data['city'] = getCity($stateId);
		$this->load->view('view_city_refine_list',$data);	
	  }
	}
}
// End of controller