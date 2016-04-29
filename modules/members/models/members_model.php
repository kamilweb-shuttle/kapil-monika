<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Members_model extends MY_Model
 {

		 
	 public function get_members($limit='10',$offset='0',$param=array())
	 {		
		
		$status			    =   @$param['status'];	
		$customer_id		=   @$param['customer_id'];		
		$keyword			=   trim($this->input->get_post('keyword',TRUE));		
		$keyword			=   $this->db->escape_str($keyword);
		
		if($customer_id!='')
		{
			$this->db->where("customers_id","$customer_id");
		}		
		if($status!='')
		{
			$this->db->where("status","$status");
		}
		
		if($keyword!='')
		{
			
			$this->db->where("(user_name LIKE '%".$keyword."%' OR CONCAT_WS(' ',first_name,last_name) LIKE '%".$keyword."%' OR gender LIKE '%".$keyword."%' )");
			
		}
		
     	$this->db->order_by('customers_id','desc');	
		$this->db->limit($limit,$offset);
		$this->db->select("SQL_CALC_FOUND_ROWS *,CONCAT_WS(' ',first_name,last_name) AS name ",FALSE);
		$this->db->from('wl_customers');
		$this->db->where('status !=','2');
		$q=$this->db->get();
		//echo_sql();
		$result = $q->result_array();	
		$result = ($limit=='1') ? $result[0]: $result;	
		return $result;
				
	}
	
	public function get_member_row($id,$condtion='')
	{
		$id = (int) $id;
		
		if($id!='' && is_numeric($id))
		{
			$condtion = "status !='2' AND customers_id=$id $condtion ";
			
			$fetch_config = array(
			  'condition'=>$condtion,							 					 
			  'debug'=>FALSE,
			  'return_type'=>"array"							  
			);
			
			$result = $this->find('wl_customers',$fetch_config);
			return $result;		
		}
	
	}
	
	public function add_newsletter_member($email, $name=NULL)
	{
		 
			$query = $this->db->query("SELECT * FROM wl_newsletters  WHERE subscriber_email='".$email."' ");
			if ($query->num_rows() > 0)
			{
			
				$row = $query->row_array();
				if($row['status']==1)
				{
					$error_type = "error";
					$error_msg = $this->config->item('newsletter_already_subscribed');
				
				}
				else
				{
				
					$where = "subscriber_email = '".$row['subscriber_email']."'"; 						
					$this->safe_update('wl_newsletters',array('status'=>'1'),$where,FALSE);

					$error_type = "success";
					$error_msg = $this->config->item('newsletter_subscribed');
				}
			}
			else
			{
			 $data =  array('status'=>'1',
							 'subscriber_name'=>$name,
							 'subscriber_email'=>$email
							);
			 $this->safe_insert('wl_newsletters',$data); 	
			}

	}
	
	public function get_member_address_book($customer_id,$offset='', $limit='', $address_type='', $default_status='Y')
	{
		$customer_id 	= (int) $customer_id;
		$offset 			= $offset;
		$limit 				= $limit;
		
		if($customer_id!='' )
		{
			$condtion = "customer_id =$customer_id AND default_status='$default_status'  ";
			
			if( $address_type!='')
			{
				
				$condtion .= "AND address_type ='$address_type'";
			}
			
			$fetch_config = array(
			  'condition'=>$condtion,							 					 
			  'debug'=>FALSE,
			  'return_type'=>"array"							  
			);
			if($offset!=-1){
				$fetch_config['start']=$offset;
			}
			if($limit>0){
				$fetch_config['limit']=$limit;
			}
			
			//trace($fetch_config);
			
			$result = $this->findAll('wl_customers_address_book',$fetch_config);
			return $result;		
		}
	
	}
	
	
	public function get_wislists($offset=FALSE,$per_page=FALSE, $param=array())
	{
		
			$keyword = trim($this->db->escape_str($this->input->post('keyword')));
			$id      = (int)trim($this->db->escape_str($this->input->post('wislist_id')));
			
			$from_date = $this->input->post('from_date');
			$to_date   = $this->input->post('to_date');
			
			$condition="wp.status ='1'";
			
			if($this->session->userdata('user_id') !=''){
				$condition .="AND wis.customer_id = ".$this->session->userdata('user_id');
			}
			
			if($id!='')
			{
			    $condition.=" AND  wis.wishlists_id = '".$id."'";
			}
						
			if(in_array($param['condition'], $param) && $param['condition'] != ''){
				$condition .= $param['condition'];
			}
			
			if($keyword!='')
			{
			    $condition.=" AND ( wp.product_name LIKE '%".$keyword."%' OR wp.product_code LIKE '%".$keyword."%' ) ";
			}
			if($from_date!='' ||  $to_date!='')
			{
				$condition_date=array();
				$condtion.=" AND (";
			if($from_date!='')
			{
			   $condition_date[]="wis.wishlists_date_added>='$from_date'";
			}else
			{
			   $condition_date[]="wis.wishlists_date_added<='$to_date'";
			}
		    	$condtion.=implode(" AND ",$condition_date)." )";
			}
			$opts=array(
			'condition'=>$condition,
			'limit'=>$per_page,
			'offset'=>$offset,
			'debug'=> FALSE,
			'fromcond'=>'wl_products AS wp',
			'selectcond'=>'wp.*, wis.customer_id, wis.notify, wis.message, wis.wishlists_id',
			'joins'=>array(array('tblname'=>'wl_wishlists AS wis','jclause'=>'wis.product_id=wp.products_id'))	
			);	
			return $this->myCustomJoin($opts);
	}
	 
}