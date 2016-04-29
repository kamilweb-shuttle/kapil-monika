<?php
class Orders extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct(); 
		
		$this->load->model(array('order/order_model'));  
		  $this->load->helper(array('cart/cart','file'));		
		$this->config->set_item('menu_highlight','orders management');	
		$this->load->library(array('Dmailer'));
		
	}

	public  function index($page = NULL)
	{
		
		
		$pagesize               =  (int) $this->input->get_post('pagesize');
		
		$config['limit']		=  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');
		
		$offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	
		
		$base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));
		
		$res_array              =  $this->order_model->get_orders($offset,$config['limit']);	
		
		$config['total_rows']   =  $this->order_model->total_rec_found;		
		
		$data['page_links']     =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);	
		
		
		/* Order oprations  */
		
		
		if(  $this->input->post('unset_as')!='' )
		{			
			$this->set_as('wl_order','order_id',array('payment_status'=>'Unpaid'));			
		}
		
		if(  $this->input->post('ord_status')!='' ){
			$posted_order_status = $this->input->post('ord_status');		
			$this->set_as('wl_order','order_id',array('order_status'=>$posted_order_status));			
		}
		
		if($this->input->post('courier_status')!='' ){
			$courier_order_id = $this->input->post('courier_status');		
			$this->set_as('wl_order','order_id',array('courier_company_id'=>$courier_order_id));			
		}
		
		if(  $this->input->post('Delete')!='' )
		{	
		    $posted_order_status = $this->input->post('ord_status');		
			$this->set_as('wl_order','order_id',array('order_status'=>'Deleted'));			
		}	
		
		/* End order oprations  */
				
		$data['heading_title']  = 'Order Lists';
		$data['res']            = $res_array; 			
		$this->load->view('order/view_order_list',$data);		
	}
	
	
	
	public function make_paid($order_id)
	{
		
		$order_id = (int) $order_id;		
		$where = "order_id = '".$order_id."'"; 		
		$this->order_model->safe_update('wl_order',array('payment_status'=>'Paid'),$where,FALSE);
		$this->update_stocks($order_id);
		
	  $ordmaster = $this->order_model->get_order_master( $order_id );		
		$orddetail = $this->order_model->get_order_detail($order_id);	 
			
		/* Start  send mail */
		
		ob_start();	
		$mail_subject =$this->config->item('site_name')." Order overview";
		$from_email   = $this->admin_info->admin_email;
		$from_name    = $this->config->item('site_name');
		$mail_to      = $ordmaster['email'];
		
		$body         = invoice_content_print($ordmaster,$orddetail);
		$msg         	= ob_get_contents();
		
		$mail_conf =  array(
		'subject'=>$this->config->item('site_name')." Order overview",
		'to_email'=>$mail_to,
		'from_email'=>$from_email,
		'from_name'=> $this->config->item('site_name'),
		'body_part'=>$msg);
		//trace($mail_conf);
		//exit;						
		$this->dmailer->mail_notify($mail_conf);		
		
		
		/* End  send mail */
		
		$this->session->set_userdata(array('msg_type'=>'success'));
		 $this->session->set_flashdata('success', $this->config->item('payment_success'));		
		 redirect('sitepanel/orders', '');
		
	}
	
	public function update_stocks($order_id){
		$order_id = (int) $order_id;
		$condtion = array('field'=>"products_id,quantity, product_color_id, product_size_id",'condition'=>"order_id ='$order_id'",'index'=>'products_id') ;
		$orders_res =  $this->order_model->findAll('wl_orders_products',$condtion);
		if( is_array($orders_res) && !empty($orders_res)){
			foreach($orders_res as $v){
				$qty = $v['quantity']; 
				if($v['product_color_id']!='' && $v['product_size_id']!=''){
					$sql = "UPDATE wl_product_attributes  SET quantity = quantity-$qty, used_quantity = used_quantity+$qty WHERE product_id = '".$v['products_id']."' AND color_id='".$v['product_color_id']."' AND size_id='".$v['product_size_id']."'";
				}
				else{
					$sql = "UPDATE wl_products  SET product_qty = product_qty-$qty WHERE products_id = '".$v['products_id']."'";
				}
				$this->db->query($sql);
			}
		}			 
	}
	 
	
	public function print_invoice()
	{
		$this->load->helper(array('cart/cart'));	
		$this->load->model(array('order/order_model'));
		$ordId              = (int) $this->uri->segment(4);
		$order_res          = $this->order_model->get_order_master( $ordId );
		$order_details_res  = $this->order_model->get_order_detail($order_res['order_id']);			
		$data['orddetail']  = $order_details_res;
		$data['ordmaster']  = $order_res;			
		$this->load->view('cart/view_invoice_print',$data);		
		
	}
	
	public function shipping_cod(){
		
		$sql 		= "SELECT * FROM wl_shipping_cod WHERE 1";
		$result = $this->db->query($sql)->row_array();
		if(is_array($result) && !empty($result)){
			$this->form_validation->set_rules('free_cod_amt','Free Cod Amount','trim|is_numeric|required|is_valid_amount');
			$this->form_validation->set_rules('cod_amt','Cod Amount','trim|required|is_numeric|is_valid_amount');
			$this->form_validation->set_rules('free_ship_amt','Free Shipping Amount','trim|required|is_numeric|is_valid_amount');			
			$this->form_validation->set_rules('ship_amt','Shipping Amount','trim|required|is_numeric|is_valid_amount');
			if($this->form_validation->run()==TRUE){
				$posted_data=array(				
					'free_cod_amt'  => $this->input->post('free_cod_amt'),
					'cod_amt'    		=> $this->input->post('cod_amt'),
					'free_ship_amt' => $this->input->post('free_ship_amt'),
					'ship_amt'  		=> $this->input->post('ship_amt'),
				);
				$where = "id = ".$result['id'];
				$this->order_model->safe_update('wl_shipping_cod',$posted_data,$where,FALSE);
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success', 'Record has been Updated!!!');
				redirect('sitepanel/orders/shipping_cod', '');
			}
		}		
		$data['result']  = $result;	
		$data['heading_title']  = "Manage Shipping and COD";			
		$this->load->view('order/view_shipping_cod',$data);		
	}
	
	
	public function tracking_details(){
		$id = $this->uri->segment(4);
		
		$this->form_validation->set_rules('tracking_code','Tracking Code','trim|required|max_length[200]');
		$this->form_validation->set_rules('tracking_text','Tracking Details','trim|required|max_length[450]');
		$this->form_validation->set_error_delimiters("<div class='required fs12'>","</div>");
		if($this->form_validation->run()==TRUE){
			$posted_data=array(				
				'tracking_code'  => $this->input->post('tracking_code'),
				'tracking_text'    		=> $this->input->post('tracking_text'),
			);
			$where = "order_id = ".$id;
			
			$this->order_model->safe_update('wl_order',$posted_data,$where,FALSE);
			$this->session->set_userdata(array('msg_type'=>'success'));
			$this->session->set_flashdata('success', 'Tracking Details have been Updated!!!');
			redirect('sitepanel/orders/tracking_details/'.$id, '');
		}
		
		$sql 		= "SELECT tracking_code, tracking_text FROM wl_order WHERE order_id = '".$id."'";
		$result = $this->db->query($sql)->row_array();
		$data['result']  = $result;
		$data['heading_title']  = "Manage Shipping and COD";			
		$this->load->view('order/view_tracking_details',$data);		
	}	


	
}
// End of controller