<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_enquiry_model extends MY_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_enquiry($offset,$per_page,$condition='')
	{
		$status_flag=FALSE;
		
		$fetch_config = array(
							  'condition'=>$condition,
							  'order'=>"id DESC",
							  'limit'=>$per_page,
							  'start'=>$offset,							 
							  'debug'=>FALSE,
							  'return_type'=>"array"							  
							  );		
		$result = $this->findAll('wl_product_enquiry',$fetch_config);
		return $result;	
		
	}

	public function update_reply_status($rid){
	
		$id =(int) $rid;
		
		if($id!='' && is_numeric($id)){
		
			 $data = array('reply_status' =>'Y');
				
				$where = "id = '".$id."'"; 
				
				$this->safe_update('wl_product_enquiry',$data,$where,FALSE);
				
				
		
		}
	
	}
	
}
// model end here