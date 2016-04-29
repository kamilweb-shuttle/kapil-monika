<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends MY_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	
	
	public function getcategory($opts=array())
	{
		$keyword = trim($this->input->get_post('keyword',TRUE));		
		$keyword = $this->db->escape_str($keyword);
		$status = $this->db->escape_str($this->input->get_post('status',TRUE));
		
		if(!array_key_exists('condition',$opts) || $opts['condition']=='')
		{
			$opts['condition']= "status !='2' ";
			
		}else
		{
			$opts['condition']= "status !='2' ".$opts['condition'];
		}
		
		if($keyword!='')
		{
			$opts['condition'].= " AND category_name like '%".$keyword."%'";
		}
		
		if($status!='')
		{
			$opts['condition'].= " AND status='$status' ";
		}
				
		
	    $opts['order']= "category_id desc ";		
		
		$opts['condition'].= " ";
		
			$fetch_config = array('condition'=>$opts['condition'],
								'order'=>$opts['order'],								
								'return_type'=>"array" );	
								
		if(array_key_exists('debug',$opts) )
		{			
			$fetch_config['debug']=$opts['debug'];
		}
		
		
		if(array_key_exists('field',$opts) && $opts['field']!='' )
		{			
			$fetch_config['field']=$opts['field'];
		}
												
		if(array_key_exists('limit',$opts) && applyFilter('NUMERIC_GT_ZERO',$opts['limit'])>0)
		{
			
			$fetch_config['limit']=$opts['limit'];
		}	
		if(array_key_exists('offset',$opts) && applyFilter('NUMERIC_WT_ZERO',$opts['offset'])!=-1)
		{
			$fetch_config['start']=$opts['offset'];
		}		
		
		//trace($fetch_config);exit;
		$result = $this->findAll('wl_categories as a',$fetch_config);
		return $result;
	}
	
	
	
	
	public function get_category_by_id($id)
	{
		$id = applyFilter('NUMERIC_GT_ZERO',$id);
		
		if($id>0)
		{
			$condtion = "status !='2' AND category_id=$id";
			$fetch_config = array(
														'condition'=>$condtion,							 					 
														'debug'=>FALSE,
														'return_type'=>"array"							  
													 );
			$result = $this->find('wl_categories',$fetch_config);
			return $result;
		}
	}
		
	public function get_featured_category($parent_id,$limit)
	{		
		$condtion = "status = '1'  AND  parent_id='".$parent_id."'";
		$fetch_config = array(
		                      'fields'=>'cat_name,cat_id',
													'condition'=>$condtion,
													'order'=>"display_order ASC ",
													'limit'=>$limit,
													'start'=>'0',							 
													'debug'=>FALSE,
													'return_type'=>"array"							  
												);		
		$result = $this->findAll('wl_categories',$fetch_config);
		return $result;	
	}
	
	public function sitepanel_action_meta($ads_id_array,$action){
	
	
	$ads_id=$ads_id_array;
	
	if($action=='Activate'){			
		$action_taken=1;			
	}else if($action=='Deactivate'){
		$action_taken=0;
	}else if($action=='Delete'){
		$action_taken=2;
	}
	
	if($action=='Activate' or $action=='Deactivate'){
		
		for($i=0;$i<count($ads_id);$i++){
		
			$prd_arr=custom_result_set("select ads_id from wl_cls_ads where ads_id= '".$ads_id[$i]."'");
			foreach($prd_arr as $prd_id){
			
				$this->db->query("update wl_cls_ads_enquiry set status ='".$action_taken."' where ads_id ='".$prd_id[
				'ads_id']."'");
				$this->db->query("update wl_cls_ads_review set status ='".$action_taken."' where entity_id ='".$prd_id[
				'ads_id']."'");
			
			}
			
		}
		
		
	}else if($action=='Delete'){
	
		for($i=0;$i<count($ads_id);$i++){
	
		$prd_arr=custom_result_set("select ads_id from wl_cls_ads where ads_id= '".$ads_id[$i]."'");
		foreach($prd_arr as $prd_id){
		
			$this->db->query("delete from wl_cls_ads_enquiry where ads_id ='".$prd_id['ads_id']."'");
			$this->db->query("delete from wl_cls_ads_review  where entity_id ='".$prd_id['ads_id']."'");
		
		}
		
		}
		
		}
		
	
	
	}
	
}
// model end here