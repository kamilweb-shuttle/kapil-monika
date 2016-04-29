<?php
class Category extends Public_Controller
{
	
	public function __construct(){
		parent::__construct();  
		$this->load->helper(array('category/category', 'products/product'));	 
		$this->load->model(array('category/category_model','products/product_model'));
	}
	
	public function index(){
		$category_id     = (int) $this->meta_info['entity_id'];		  
		$have_sub_cat    = get_db_field_value('wl_categories','parent_id',"WHERE parent_id = '$category_id' ");
		
		if( $category_id  > 0 ){
			if( $have_sub_cat > 0  ){
				$this->category_listing($category_id);					 		 
			}
			else{
				$this->products_listing($category_id);
			}
		}
		else{
			$this->category_listing($category_id);
		}
	}
	
	public function category_listing(){
		
		$data['title'] 			= "Category";
		$record_per_page    = (int) $this->input->post('per_page');
		if(array_key_exists('entity_id',$this->meta_info) && $this->meta_info['entity_id'] > 0 ){
			$parent_segment         = (int) $this->meta_info['entity_id'];
		}
		else{
		  $parent_segment     = (int) $this->uri->segment(3);
		}
		$page_segment           = find_paging_segment();
		$config['per_page']			= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');
		$offset                 =  (int) $this->uri->segment($page_segment,0);	
		$parent_id              = ( $parent_segment > 0 ) ?  $parent_segment : '0';		
		$base_url               = ( $parent_segment > 0 ) ?  "category/category_listing/$parent_id/pg/" : "category/category_listing/pg/";
		
		$condtion_array = array(
			'field' =>"*,( SELECT COUNT(category_id) FROM wl_categories AS b
			WHERE b.parent_id=a.category_id ) AS total_subcategories",
			'condition'=>"AND parent_id = '$parent_id' AND status='1' ",
			'limit'=>$config['per_page'],
			'offset'=>$offset	,
			'debug'=>FALSE
		);	
		$res_array              =  $this->category_model->getcategory($condtion_array);						
		$config['total_rows']	=  $this->category_model->total_rec_found;
		$data['page_links']     = front_pagination("$base_url",$config['total_rows'],$config['per_page'],$page_segment);
		$parentdata = $this->category_model->get_category_by_id($parent_id);
		$data['heading_title'] = 'Category Lists';
		$data['res'] = $res_array; 	
		$data['parentres']=isset($parentdata) && is_array($parentdata) ? $parentdata : "";
		//trace($parentdata);
		$data['unq_section'] = isset($parentdata) && is_object($parentdata) ? "Subcategory" : "Category";
		if($parent_id > 0){
			
			$data['catid'] = $parent_id;
			$conArray = array(
				'field' =>"*,( SELECT COUNT(category_id) FROM wl_categories AS b
				WHERE b.parent_id=a.category_id ) AS total_subcategories",
				'condition'=>"AND parent_id = '0' AND status='1' ",
				//'limit'=>10,
				//'offset'=>$offset	,
				'debug'=>FALSE
			);	
			$resArray            		= $this->category_model->getcategory($conArray);						
			$data['resleft']						=	$resArray;
			$data['totalRecord']		= $this->category_model->total_rec_found;
			
			$this->load->view('category/view_subcategory',$data);
		}
		else{
			$this->load->view('category/view_category',$data);
		}
	}
		
	public function products_listing($category_id){
		
		$this->page_section_ct = 'product';
		$condtion               = array();	
		$cat_res 								= '';
		$record_per_page        = (int) $this->input->post('per_page');	
		$category_id            = (int) $category_id;
		$page_segment           = find_paging_segment();	
		$config['per_page']			= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');
		//$config['per_page']			= 1;	
		$offset                 = (int) $this->uri->segment($page_segment,0);	
		$base_url      					= ( $category_id!='' ) ?   "category/products_listing/$category_id/pg/" : "category/products_listing/pg/";
		$condtion['status']     = '1';
		$condtion['orderby']    = 'products_id asc';
		$page_title             = "Product Lists";
		
		$color        					= $this->input->post('color');
		$size        						= $this->input->post('size');
		$price       						= $this->input->post('price');
		
		if(!empty($color)){
			$colors = implode(',',$color);
			$condtion['color'] = $colors;
		}
		if(!empty($size)){
			$sizes = implode(',',$size);
			$condtion['size'] = $sizes;
		}
		if(!empty($price)){
			$condtion['price'] = $price;
		}
		
		if( $category_id > 0 ){
			$condtion['category_id'] = $category_id;			
			$cat_res = get_db_single_row('wl_categories','*'," category_id='$category_id'");
			$page_title = $cat_res['category_name'];
			$data['catid'] = $category_id;
		}		
		$res_array              = $this->product_model->get_products($config['per_page'],$offset,$condtion);		
		$config['total_rows']   = get_found_rows();			
		$data['page_links']    	= front_pagination("$base_url",$config['total_rows'],$config['per_page'],$page_segment);	 						
		$data['heading_title'] 	= $page_title;
		$data['res']          	= $res_array; 
		$data['cat_res'] 				= $cat_res;				
		$this->load->view('products/view_product_listing',$data);
	}
}
/* End of file member.php */
/* Location: .application/modules/products/controllers/products.php */