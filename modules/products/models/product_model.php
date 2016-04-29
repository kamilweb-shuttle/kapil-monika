<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_model extends MY_Model
 {

		 
	public function get_products($limit='10',$offset='0',$param=array()){
		$category_id		=   @$param['category_id'];
		$status			    =   @$param['status'];	
		$productid			=   @$param['productid'];
		$orderby				=		@$param['orderby'];	
		$where			    =		@$param['where'];	
		$color			    =		@$param['color'];	
		$size			    	=		@$param['size'];
		$price		    	=		@$param['price'];	
		$hot			    	=		@$param['hot'];
		$featured	    	=		@$param['featured'];	
		$keyword				=   trim($this->input->get_post('keyword',TRUE));						
		$keyword				=   $this->db->escape_str($keyword);
		
		if(!empty($color)){
			$this->db->where("wlp.color_ids IN ($color)");
		}
		if(!empty($size)){
			$this->db->where("wlp.size_ids IN ($size)");
		}
		if(!empty($hot)){
			$this->db->where("wlp.hot_product = '".$hot."'");
		}
		if(!empty($featured)){
			$this->db->where("wlp.featured_product = '".$featured."'");
		}
		if(!empty($price)){
			$price = explode('-',$price);
			if($price[0] <= 0){
				$this->db->where("wlp.product_price <= '$price[1]'");
			}
			elseif($price[1] <= 0){
				$this->db->where("wlp.product_price >= '$price[0]'");
			}
			else{
				$this->db->where("wlp.product_price between '$price[0]' AND '$price[1]'");
			}
		}
		if($category_id!=''){
			$this->db->where("wlp.category_id ","$category_id");
		}
		if($productid!=''){
			$this->db->where("wlp.products_id  ","$productid");
		}
		if($status!=''){
			$this->db->where("wlp.status","$status");
		}
		if($where!=''){
			$this->db->where($where);
		}
		if($keyword!=''){
			$this->db->where("(wlp.product_name LIKE '%".$keyword."%' OR wlp.product_code LIKE '%".$keyword."%' )");
		}
		if($orderby!=''){
			$this->db->order_by($orderby);
		}
		else{
			$this->db->order_by('wlp.products_id ','desc');
		}
		if($limit > 0){
			if(applyFilter('NUMERIC_WT_ZERO',$offset)==-1){
				$offset = 0;
		  }
		  $this->db->limit($limit,$offset);
		}
		$this->db->group_by("wlp.products_id"); 	
		$this->db->select('SQL_CALC_FOUND_ROWS wlp.*,wlpm.media,wlpm.media_type,wlpm.is_default',FALSE);
		$this->db->from('wl_products as wlp');
		$this->db->where('wlp.status !=','2');
		$this->db->join('wl_products_media AS wlpm','wlp.products_id=wlpm.products_id','left');
		$q=$this->db->get();
		//echo_sql();
		$result = $q->result_array();	
		return $result;
	}
		  
	public function get_product_media($limit='5',$offset='0',$param=array())
    {		  
		
		 $default			    =   @$param['default'];	
		 $productid			    =   @$param['productid'];
		 $media_type			=   @$param['media_type'];
		 		
		 if( is_array($param) && !empty($param) )
		 {			
			$this->db->select('SQL_CALC_FOUND_ROWS *',FALSE);
			$this->db->limit($limit,$offset);
			$this->db->from('wl_products_media');
			$this->db->where('products_id',$productid);	
			
			if($default!='')
			{
				$this->db->where('is_default',$default);	
			}
			if($media_type!='')
			{
				$this->db->where('media_type',$media_type);	
			}
							
			$q=$this->db->get();
			$result = $q->result_array();	
			$result = ($limit=='1') ? $result[0]: $result;	
			return $result;	
			
		 }				
		
	}

	public function related_products_added($productId,$limit='NULL',$start='NULL')
	{
		$res_data =  array();
		$condtion = ($productId!='') ? "status ='1' AND product_id = '$productId' ":"status ='1'";
		$fetch_config = array(
													'condition'=>$condtion,
													'order'=>"id DESC",
													'limit'=>$limit,
													'start'=>$start,							 
													'debug'=>FALSE,
													'return_type'=>"array"							  
												 );		
		$result = $this->findAll('wl_products_related',$fetch_config);
		if( is_array($result) && !empty($result) )
		{
			foreach ($result as $val )
			{ 
				$res_data[$val['id']] =$val['related_id'];
			}
		}
		return $res_data;		
	}

	public function update_viewed($id,$counter=0){
	  $id = (int) $id;
	  if($id>0){
			$posted_data = array(
				'products_viewed'=>($counter+1)
			);
			$where = "products_id = '".$id."'"; 				
		  $this->category_model->safe_update('wl_products',$posted_data,$where,FALSE);	
	  }
	}
	
	public function get_related_products($condition){
		$condtion = (!empty($condition)) ? "status !='2'  $condition" :"status !='2'";
		$fetch_config = array(
			'condition'=>$condtion,
			'order'=>"products_id DESC",
			'limit'=>'NULL',
			'start'=>'NULL',							 
			'debug'=>FALSE,
			'return_type'=>"array"							  
		);		
		$result = $this->findAll('wl_products',$fetch_config);
		return $result;	
	}
	
	
	public function related_products($res,$limit='NULL',$start='NULL'){
		$condtion = array();
		$condtion['where']     = "wlp.status ='1' AND wlp.products_id IN(SELECT wpr.related_id FROM wl_products_related as wpr WHERE wpr.product_id ='".$res['products_id']."') ";
		$res_data = $this->get_products($limit,$start, $condtion);
		return $res_data;		
	}
	
	public function hot_products(){
		$condtion = array();
		$limit = 10;
		$start=0;
		$condtion['where']     = "wlp.status ='1' AND wlp.hot_product = '1'";
		$res_data = $this->get_products($limit,$start, $condtion);
		return $res_data;		
	}
	
	public function featured_products(){
		$condtion = array();
		$limit = 10;
		$start=0;
		$condtion['where']     = "wlp.status ='1' AND wlp.featured_product = '1'";
		$res_data = $this->get_products($limit,$start, $condtion);
		return $res_data;		
	} 
		
	public function related_sizes($param=array()){
		$where			=	@$param['where'];
	  $limit			=   @$param['limit'];
	  $offset			=	@$param['offset'];	

	  $query_size = "SELECT SQL_CALC_FOUND_ROWS wls.size_name,wls.size_id,wls.status as size_status FROM wl_sizes as wls WHERE wls.status!='2' AND ";
		if($where!=''){
			$query_size .= $where;
	  }
		$query_size = trim($query_size,"AND");
	  if($limit>0){
			$query_size .= " LIMIT $offset,$limit";
	  }
		$q = $this->db->query($query_size);
		$result = $q->result_array();
		$res_total =  $this->db->query("Select FOUND_ROWS() as total")->row_array();
		$this->total_recs = $res_total['total'];
		return $result;		
	}

	public function related_colors($param=array())
	{
	  $res_data =  array();

	  $where			=	@$param['where'];
	  $limit			=   @$param['limit'];
	  $offset			=	@$param['offset'];	

	  

	  $query_size = "SELECT SQL_CALC_FOUND_ROWS wlc.color_name,wlc.status as color_status,wlc.color_code,wlc.color_id FROM wl_colors as wlc WHERE wlc.status!='2' AND ";

	  if($where!='')
	  {	
		$query_size .= $where;
	  }

	  $query_size = trim($query_size,"AND");
	  
	  if($limit>0)
	  {	
		$query_size .= " LIMIT $offset,$limit";
	  }

	  $q = $this->db->query($query_size);

	  $result = $q->result_array();

	  $res_total =  $this->db->query("Select FOUND_ROWS() as total")->row_array();
		
	  $this->total_recs = $res_total['total'];

	  return $result;		
	}
 
	public function product_attributes($param=array())
	{
	  $res_data =  array();

	  $where			=	@$param['where'];
	  $limit			=   @$param['limit'];
	  $offset			=	@$param['offset'];	

	  
	  $query_attr = "SELECT * FROM wl_product_attributes  as wlc WHERE status!='2' AND ";

	  if($where!='')
	  {	
		$query_attr .= $where;
	  }

	  $query_attr = trim($query_attr,"AND");
	  
	  if($limit>0)
	  {	
		$query_attr .= " LIMIT $offset,$limit";
	  }
	  
	  $q = $this->db->query($query_attr);

	  $result = $q->result_array();

	  //$res_total =  $this->db->query("Select FOUND_ROWS() as total")->row_array();
		
	  //$this->total_recs = $res_total['total'];

	  return $result;		
	}
	
	public function get_product_base_price($param=array()){
		$where	 =   @$param['where'];	
		$this->db->select('*',FALSE);
		$this->db->from('wl_product_attributes');
		if($where!=''){
			$this->db->where($where);	
		}
		$q=$this->db->get();
		// echo_sql();
		$result = $q->row_array();	
		return $result;	
	}   
	
	public function add_bulk_upload_product($worksheet)
	{
		//echo "ssss";
		//trace($worksheet);
		//exit;
		for($i=2;$i<=count($worksheet);$i++)
		{
			$category_id					=	(!isset($worksheet[$i][1])) ? '' : addslashes(trim($worksheet[$i][1]));
			$product_name					=	(!isset($worksheet[$i][2])) ? '' : addslashes(trim($worksheet[$i][2]));
			$product_code					=	(!isset($worksheet[$i][3])) ? '' : addslashes(trim($worksheet[$i][3]));
			$price								=	(!isset($worksheet[$i][4])) ? '' : addslashes(trim($worksheet[$i][4]));
			$discounted_price			=	(!isset($worksheet[$i][5])) ? '' : addslashes(trim($worksheet[$i][5]));
			$description					=	(!isset($worksheet[$i][6])) ? '' : addslashes(trim($worksheet[$i][6]));
			$size									=	(!isset($worksheet[$i][7])) ? '' : addslashes(trim($worksheet[$i][7]));
			$color								=	(!isset($worksheet[$i][8])) ? '' : addslashes(trim($worksheet[$i][8]));
			$product_material			=	(!isset($worksheet[$i][9])) ? '' : addslashes(trim($worksheet[$i][9]));			
			$delivery_text				=	(!isset($worksheet[$i][10])) ? '' : addslashes(trim($worksheet[$i][10]));
			$product_alt					=	(!isset($worksheet[$i][11])) ? '' : addslashes(trim($worksheet[$i][11]));
			$status								=	(!isset($worksheet[$i][12])) ? '' : addslashes(trim($worksheet[$i][12]));
			
			$category_links = get_parent_categories($category_id,"AND status='1'","category_id,parent_id");		
			$category_links = array_keys($category_links);
			$category_links = implode(",",$category_links);
			
			//$check_exist="SELECT * FROM tbl_venders WHERE email_id='".$email_id."' ";
			//$query_num=$this->db->query($check_exist);
			
			//if($query_num->num_rows == 0)
			//{
				//$this->load->helper('seo/seo_helper');
				$seo_url = seo_url_title($product_name);
				$data = array(
					'category_id'								=>		$category_id,
					'category_links'						=>		$category_links,
					'size_ids'									=>		$size,
					'color_ids'									=>		$color,
					'product_name'							=>		$product_name,
					'product_alt'								=>		$product_alt,
					'friendly_url'							=>		$seo_url,
					'product_code'							=>		$product_code,
					'products_description'			=>		$description,
					'product_material' 					=>  	$product_material,
					'delivery_text' 						=>  	$delivery_text,
					'product_price'							=> 		$price,	
					'product_discounted_price' 	=> 		$discounted_price,
					'product_added_date'				=> 		$this->config->item('config.date.time'),	
					'product_updated_date' 			=> 		$this->config->item('config.date.time'),
					'status'										=>		$status
				);
				//trace($data);
				//exit;
				$product_id =  $this->safe_insert('wl_products',$data,FALSE);
				$redirect_url = "products/detail";
				$meta_array  = array(
					'entity_type'=>$redirect_url,
					'entity_id'=>$product_id,
					'page_url'=>$seo_url,
					'meta_title'=>get_text($product_name,80),
					'meta_description'=>get_text($description),
					'meta_keyword'=>get_keywords($description)
				);
				create_meta($meta_array);
			//}
			//else
			//{
				//$locationId='1';
			//}
		}
		return true;
	}
	
}