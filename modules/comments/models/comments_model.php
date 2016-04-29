<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Comments_model extends MY_Model
 {

		 
	 public function get_comments($cfg=array())
	 {		
		
		$sql_keys='';
		$limit_clause='';
		$excond='';
		if(array_key_exists('limit',$cfg) && applyFilter('NUMERIC_GT_ZERO',$cfg['limit'])>0)
		{
			$sql_keys = "SQL_CALC_FOUND_ROWS";
			$limit_clause=" limit ".$cfg['limit'];
		}	
		if(array_key_exists('offset',$cfg) && applyFilter('NUMERIC_WT_ZERO',$cfg['offset'])!=-1)
		{
			$limit_clause=" limit ".$cfg['offset'].",".$cfg['limit'];
		}
		if(array_key_exists('condition',$cfg) && $cfg['condition']!='')
		{
			$excond .= $cfg['condition'];
		}

		if(!array_key_exists('order',$cfg) || $cfg['order']=='')
		{
			$order_by= "b.review_date DESC ";
		}
		else
		{
		  $order_by= $cfg['order'];
		}

		if(!array_key_exists('exjoin',$cfg) || $cfg['exjoin']=='')
		{
			$exjoin= "";
		}
		else
		{
		  $exjoin= $cfg['exjoin'];
		}

		if(!array_key_exists('exselect',$cfg) || $cfg['exselect']=='')
		{
			$exselect= "";
		}
		else
		{
		  $exselect= $cfg['exselect'];
		}

		$query = "SELECT $sql_keys b.*,a.customers_id as poster_ref_id,IF(ISNULL(a.customers_id),b.author,CONCAT_WS(' ',first_name,last_name)) as mem_name $exselect FROM wl_review as b LEFT JOIN wl_customers as a ON  b.customer_id=a.customers_id $exjoin WHERE (b.status!='2' AND (a.status='1' OR  ISNULL(a.customers_id)) )   $excond  ORDER BY $order_by ";
		$query.=$limit_clause;
		$comment_query=$this->db->query($query);
		$result=$comment_query->result_array();
		return $result;
				
	}
	
	public function get_count_comments($cfg=array())
	{
	   $query = "SELECT count(review_id) as gtotal FROM wl_review as a LEFT JOIN wl_customers as b ON a.customer_id=b.customers_id  WHERE   (a.status!='2' AND (b.status='1' OR  ISNULL(b.customers_id)) ) ".$cfg['condition'];
	  $result = $this->db->query($query)->row();
	  return $result->gtotal;
	}	  
	
	public function get_abuse_report($cfg=array())
    {		
	  
	  $sql_keys='';
	  $limit_clause='';
	  $excond='';
	  if(array_key_exists('limit',$cfg) && applyFilter('NUMERIC_GT_ZERO',$cfg['limit'])>0)
	  {
		  $sql_keys = "SQL_CALC_FOUND_ROWS";
		  $limit_clause=" limit ".$cfg['limit'];
	  }	
	  if(array_key_exists('offset',$cfg) && applyFilter('NUMERIC_WT_ZERO',$cfg['offset'])!=-1)
	  {
		  $limit_clause=" limit ".$cfg['offset'].",".$cfg['limit'];
	  }
	  if(array_key_exists('condition',$cfg) && $cfg['condition']!='')
	  {
		  $excond .= $cfg['condition'];
	  }

	  if(!array_key_exists('order',$cfg) || $cfg['order']=='')
	  {
		  $order_by= "b.abuse_id DESC ";
	  }
	  else
	  {
		$order_by= $cfg['order'];
	  }

	  if(!array_key_exists('exjoin',$cfg) || $cfg['exjoin']=='')
	  {
		  $exjoin= "";
	  }
	  else
	  {
		$exjoin= $cfg['exjoin'];
	  }

	  if(!array_key_exists('exselect',$cfg) || $cfg['exselect']=='')
	  {
		  $exselect= "";
	  }
	  else
	  {
		$exselect= $cfg['exselect'];
	  }

	  $query = "SELECT $sql_keys b.*,a.customers_id as poster_ref_id, CONCAT_WS(' ',first_name,last_name) as mem_name $exselect FROM wl_abuse_report as b INNER JOIN wl_customers as a ON  b.user_id=a.customers_id $exjoin WHERE (b.status!='2' AND (a.status='1' OR  ISNULL(a.customers_id)) )   $excond  ORDER BY $order_by ";
	  $query.=$limit_clause;
	  $comment_query=$this->db->query($query);
	  $result=$comment_query->result_array();
	  return $result;
			  
   }
	 
}
?>