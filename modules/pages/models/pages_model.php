<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pages_model extends MY_Model
{
	
	public  function get_cms_page($page=array())
	{		
		if( is_array($page) && !empty($page) )
		{			
			$result =  $this->db->get_where('wl_cms_pages',$page)->row_array();

			if( is_array($result) && !empty($result) )
			{
				return $result;
			}
			
		}	
			
	}
	
	
	public function get_all_cms_page($offset='0',$limit='10')
	{
		
		$keyword = $this->db->escape_str($this->input->get_post('keyword'));
		
		$condtion = ($keyword!='') ? "status !='2' AND page_name LIKE '%".$keyword."%'" :
		"status !='2' ";
		
		$fetch_config = array(
							  'condition'=>$condtion,
							  'order'=>"page_name DESC",
							  'limit'=>$limit,
							  'start'=>$offset,							 
							  'debug'=>FALSE,
							  'return_type'=>"array"							  
							  );		
							  
							  
		$result = $this->findAll('wl_cms_pages',$fetch_config);
		return $result;	
	
	}
	
	
	
		
}