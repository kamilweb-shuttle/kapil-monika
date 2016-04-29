<?php
class Products extends Public_Controller
{

	
	public function __construct(){
		parent::__construct();  		
		$this->load->model(array('category/category_model','products/product_model'));	
		$this->load->helper(array('products/product','category/category'));
		$this->form_validation->set_error_delimiters("<div class='required'>","</div>");
		$this->page_section_ct = 'product';
	}
	
	public function index(){
		$this->page_section_ct = 'product';
		$condtion               = array();	
		$cat_res = '';
		$record_per_page        = (int) $this->input->post('per_page');	
		$category_id            =  (int) $this->uri->segment(3);
		$page_segment           = find_paging_segment();	
		$config['per_page']		= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');	
		$offset                 = (int) $this->uri->segment($page_segment,0);	
		$base_url      = ( $category_id!='' ) ?   "products/index/$category_id/pg/" : "products/index/pg/";
		$condtion['status']     = '1';
		$condtion['orderby']     = 'products_id asc';
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
		}
		$data['catid']='';
		$res_array               =  $this->product_model->get_products($config['per_page'],$offset,$condtion);		
		//echo_sql();
		$config['total_rows']    =  get_found_rows();			
		$data['page_links']    = front_pagination("$base_url",$config['total_rows'],$config['per_page'],$page_segment);	 						
		$data['heading_title'] = $page_title;
		$data['res']           = $res_array; 
		$data['cat_res'] = $cat_res;				
		$this->load->view('products/view_product_listing',$data);
	}
	
	public function hot_products(){
		$this->page_section_ct = 'product';
		$condtion               = array();	
		$cat_res = '';
		$record_per_page        = (int) $this->input->post('per_page');	
		$category_id            =  (int) $this->uri->segment(3);
		$page_segment           = find_paging_segment();	
		$config['per_page']		= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');	
		$offset                 = (int) $this->uri->segment($page_segment,0);	
		$base_url      = ( $category_id!='' ) ?   "products/index/$category_id/pg/" : "products/index/pg/";
		$condtion['status']     = '1';
		$condtion['hot']     = '1';
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
		
		$condtion['orderby']     = 'products_id asc';
		$page_title             = "Hot Product Lists";
				
		$res_array               =  $this->product_model->get_products($config['per_page'],$offset,$condtion);
		//echo_sql();		
		$config['total_rows']    =  get_found_rows();			
		$data['page_links']    = front_pagination("$base_url",$config['total_rows'],$config['per_page'],$page_segment);	 						
		$data['heading_title'] = $page_title;
		$data['catid']					= "";
		$data['category_id']					= "";
		$data['res']           = $res_array; 
		$data['cat_res'] = $cat_res;				
		$this->load->view('products/view_product_listing',$data);
	}
	
	
	public function featured_products(){
		$this->page_section_ct = 'product';
		$condtion               = array();	
		$cat_res = '';
		$record_per_page        = (int) $this->input->post('per_page');	
		$category_id            =  (int) $this->uri->segment(3);
		$page_segment           = find_paging_segment();	
		$config['per_page']		= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');	
		$offset                 = (int) $this->uri->segment($page_segment,0);	
		$base_url      = ( $category_id!='' ) ?   "products/index/$category_id/pg/" : "products/index/pg/";
		$condtion['status']     = '1';
		$condtion['featured']   = '1';
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
		
		$condtion['orderby']     = 'products_id asc';
		$page_title             = "Featured Product Lists";
				
		$res_array               =  $this->product_model->get_products($config['per_page'],$offset,$condtion);
		echo_sql();		
		$config['total_rows']    =  get_found_rows();			
		$data['page_links']    = front_pagination("$base_url",$config['total_rows'],$config['per_page'],$page_segment);	 						
		$data['heading_title'] = $page_title;
		$data['catid']					= "";
		$data['category_id']					= "";
		$data['res']           = $res_array; 
		$data['cat_res'] = $cat_res;				
		$this->load->view('products/view_product_listing',$data);
	}
	
	
	public function detail(){
		
		$this->page_section_ct = 'product';
		$data['unq_section'] = "Product";
		$productId = (int) $this->meta_info['entity_id'];
		$where = "wlp.products_id = '".$productId."'";
		$option = array(
			'fields'=>"SQL_CALC_FOUND_ROWS wlp.*,wlc.first_name,wlc.user_name,wlc.mobile_number,wlcat.category_id",
			'where'=>$where
		);
		$res =  $this->product_model->get_products('1','',$option);
		if( is_array($res) && !empty($res)){
			$res = $res[0];
			// Recent View
			$id = $res['products_id'];
			$ee=$this->session->userdata('recent_view');
			if(is_array($ee)){
				if(!@in_array($id,$ee)){
					@array_push($ee,$id);
					$this->session->set_userdata('recent_view',$ee);
				}
			}
			else{
				$this->session->set_userdata('recent_view',array($id));
			}
			// End Here
			//trace($this->session->userdata('recent_view'));
			
			$this->load->model('comments/comments_model');
			$data['error_validate'] = TRUE;;
			if($this->input->post('post_review')!=''){
				$this->form_validation->set_error_delimiters("<div class='required'>","</div>");
				
				$this->form_validation->set_rules('name','Name','trim|required|max_length[70]');
				$this->form_validation->set_rules('email','Email','trim|required|max_length[80]|valid_email');	
			  $this->form_validation->set_rules('rating','Rating','trim|required|max_length[1]');			  
			  $this->form_validation->set_rules('reviews','Review','trim|required|max_length[450]');
				$this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code[review]');
			  if($this->form_validation->run()===TRUE){
					$mem_id = $this->session->userdata('user_id');
				 	$posted_data=array(
						'entity_id'  		=> $res['products_id'],
						'entity_type' 	=> 'product',
						'customer_id'   => '',	
						'ads_rating'		=> $this->input->post('rating'),
						'author'  			=> $this->input->post('name'),
						'author_email'  => $this->input->post('email'),
						'text'  				=> $this->input->post('reviews'),
						'status'				=> '1',						
						'review_date'		=> $this->config->item('config.date.time')
					);			
				  $this->comments_model->safe_insert('wl_review',$posted_data,FALSE); 
					$red_links = $res['friendly_url'].'#postreviews';
				  $this->session->set_userdata('msg_type','success');
				  $this->session->set_flashdata('success','Thank you. Your review has been submitted successfully'); 
				  redirect($red_links, ''); 
			  }
			  $data['error_validate'] = FALSE;
			}
			$data['title'] = "Product";
			$data['res']       = $res;	
			$this->product_model->update_viewed($res['products_id'],$res['products_viewed']);
			$qry_options = array(
				'limit'	  => 200,
				'offset'	  => 0,
				'condition' => " AND entity_id ='".$res['products_id']."' AND entity_type='product' AND b.status='1'"
			);
			$media_res         = $this->product_model->get_product_media(5,0,array('productid'=>$res['products_id']));
			$data['media_res'] = $media_res;
			
			$review_res = $this->comments_model->get_comments($qry_options);	
			$data['review_count'] = get_found_rows();
			$data['review_res'] = $review_res;
			
			$this->load->view('products/view_product_details',$data);
		}
		else{
			redirect('products', ''); 	
		}
	}
	
	public function get_product_price(){
		$sid = (int) $this->input->post('sid');
		$cid = (int) $this->input->post('cid');
		$pid = (int) $this->input->post('pid');
		
		if($cid > 0 && $sid > 0){
			$res = $this->db->select('quantity,product_price,product_discounted_price')->get_where('wl_product_attributes',array('color_id'=>$cid,'size_id'=>$sid,'product_id'=>$pid))->row();
	  	if(is_object($res)){
				echo $res->quantity.'-'.$res->product_price.'-'.$res->product_discounted_price;
	  	}
		}
  }
	
	public function check_zipcode(){
		//$zipcode=$this->input->post("zipcode");
		$this->form_validation->set_rules('zip_code','Zipcode','trim|required|is_numeric|max_length[6]|callback_is_zipcode_exist');

		if($this->form_validation->run()===TRUE){
			$this->session->set_userdata("zip_code",$this->input->post("zip_code"));
			print json_encode(array("success"=>''));
		}else{
			print json_encode(array("error"=>form_error("zip_code",'<span>','</span>')));
		}
	}

	public function is_zipcode_exist(){
		$zipcode=$this->input->post("zip_code");
		
		$zc=$this->db->query("select zip_code, cod from tbl_zip_location where zip_code='".$this->input->post("zip_code")."' AND status='1'")->row_array();
		
		if(empty($zc)){
			$this->form_validation->set_message('is_zipcode_exist', 'COD not available at your location and not servicable.');
			return FALSE;
		}
		elseif($zc['cod'] == 'N'){
			$this->form_validation->set_message('is_zipcode_exist', 'COD not available at your location.');
			return FALSE;
		}
	}
}
?>