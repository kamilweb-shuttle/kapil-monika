<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Zip_location_model extends MY_Model{

   public function __construct(){
   
     parent::__construct();
	 
   }
	
	public function get_location($offset=FALSE,$per_page=FALSE)
	{
	    $keyword = $this->db->escape_str(trim($this->input->get_post('keyword',TRUE)));
	   
		$condtion = ($keyword!='')?"status !='2' AND location_name  like '%".$keyword."%' || zip_code='".$keyword."' ":"status !='2'";
				
		$fetch_config = array(
							  'condition'=>$condtion,
							  'order'=>"zip_location_id DESC",
							  'limit'=>$per_page,
							  'start'=>$offset,
							  'debug'=>FALSE,
							  'return_type'=>"array"							  
							  );		
		$result = $this->findAll('tbl_zip_location',$fetch_config);
		return $result;	
	}
	
	public function get_zip_location_by_id($id)
	{
		
		$id = (int) $id;
	    
		if($id!='' && is_numeric($id))
		{
			
			$condtion = "status !='2' AND zip_location_id=$id";
			
			$fetch_config = array(
							  'condition'=>$condtion,							 					 
							  'debug'=>FALSE,
							  'return_type'=>"object"							  
							  );
			
			$result = $this->find('tbl_zip_location',$fetch_config);
			return $result;		
		
		 }
	}
	
	public function add_bulk_upload_location($worksheet)
	{
		//echo "ssss";
		//trace($worksheet);
		//exit;
		for($i=2;$i<=count($worksheet);$i++)
		{
			$location_name		=	(!isset($worksheet[$i][1])) ? '' : addslashes(trim($worksheet[$i][1]));
			$zip_code					=	(!isset($worksheet[$i][2])) ? '' : addslashes(trim($worksheet[$i][2]));
			$cod							=	(!isset($worksheet[$i][3])) ? '' : addslashes(trim($worksheet[$i][3]));
			$status						=	(!isset($worksheet[$i][4])) ? '' : addslashes(trim($worksheet[$i][4]));
			
			//$check_exist="SELECT * FROM tbl_venders WHERE email_id='".$email_id."' ";
			//$query_num=$this->db->query($check_exist);
			
			//if($query_num->num_rows == 0)
			//{
				$data = array(
					'location_name'		=>		$location_name,
					'zip_code'				=>		$zip_code,
					'cod'							=>		$cod,
					'added_date'			=> 		$this->config->item('config.date.time'),	
					'xls_type' 				=> 		'Y',
					'status'					=>		$status
				);
				//trace($data);
				//exit;
				$location_id =  $this->safe_insert('tbl_zip_location',$data,FALSE);
			//}
			//else
			//{
				//$locationId='1';
			//}
		}
		return true;
	}
	
}