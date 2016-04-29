<?php
class Payment extends Public_Controller
{
	
		public function __construct()
		{
		
		  parent::__construct();  			
		  $this->load->helper(array('payment/paypal','cart/cart','file'));
		  $this->load->model(array('order/order_model','payment/payment_model','loyalty/loyalty_model'));
		  $this->load->library(array('Dmailer'));		
		
		}
		
		public function index()
		{
		
			if( $this->input->post()!='' )
			{
			
				if($this->input->post('pay_method') == "paypal" )
				{	
				    $working_order_id =  $this->session->userdata('working_order_id');
				    $order_res = $this->order_model->get_order_master($working_order_id);
				    paypalForm($order_res);
				
				}
				
				if($this->input->post('pay_method') == "cash" )
				{	
						
				    $this->pay_by_check();							
				}
							
			
			}  
		
		}
	   
		public function pay_by_check(){		 
			 $data  = array('payment_method'=>'Cheque','payment_status'=>'Unpaid');
			 $ordId = $this->session->userdata('working_order_id');
			 $where = "order_id = '".$ordId."' ";		 
			 $this->payment_model->safe_update('wl_order',$data,$where,FALSE);	
			 $condition = "&& order_id='".$ordId."'";
			 
			 $cupn = $this->order_model->get_orders(0, 1, $condition);
			 
			 $cupn = $cupn[0];			 
			 
			 $point = $this->loyalty_model->get_loyalty_points($cupn['customers_id']);
			 
			 if(!empty($point) && is_array($point)){
				 $this->loyalty_model->update_loyalty_points($cupn['customers_id'], $ordId);
			 }else{
				 $this->loyalty_model->add_loyalty_points($cupn['customers_id'], $ordId);
			 }
			 
			 $cupndetil = $this->db->query("select coupon_id from wl_coupons where coupon_code = '".$cupn['discount_coupon_id']."' && end_date >= now()")->row_array();
			 
			 $this->payment_model->safe_update('wl_coupon_customers', array('status' => '1'), array('coupon_id' => $cupndetil['coupon_id'], 'customer_id' => $cupn['customers_id']), FALSE);
			 		 
			 $this->session->unset_userdata(array('working_order_id' =>0,'coupon_code'=>''));
			 $ordId = md5($ordId);
			 $this->session->set_flashdata('msg', 'Thanks for Placing Your order.<br/> Our Bank Details Are-<br/>ING Bank<br/>BSB:<br/>923 100<br/>A/C: 70259531');		
			 redirect('payment/thanks/'.$ordId, '');
	 }	 
	 
	   public function order_success()
	   {	
	   	   
		 $ordId = $this->uri->segment(4);
		 $payment_method = $this->uri->segment(3);		 
		 $data  = array('payment_method'=>$payment_method,'payment_status'=>'Unpaid');			 	 
		 $where = "MD5(order_id) = '$ordId' ";		 
		 
	  //	$this->update_stocks($order_id);
		 		 
		   $this->payment_model->safe_update('wl_order',$data,$where,FALSE);			 		
		 
			$ordmaster = $this->order_model->get_order_master( $this->session->userdata('working_order_id') );
			$orddetail = $this->order_model->get_order_detail( $this->session->userdata('working_order_id'));	 
					
		   if( is_array( $ordmaster )  && !empty( $ordmaster ) ) 
			 {
			       /***** Send Invoice mail */
				    ob_start();				
					$mail_subject =$this->config->item('site_name')." Order overview";
					$from_email   = $this->admin_info->admin_email;
					$from_name    = $this->config->item('site_name');
					$mail_to      = $ordmaster['email'];									
					$body         = invoice_content($ordmaster,$orddetail);					
					$msg          = ob_get_contents();
					
					$mail_conf =  array(
					'subject'=>$this->config->item('site_name')." Order overview",
					'to_email'=>$mail_to,
					'from_email'=>$from_email,
					'from_name'=> $this->config->item('site_name'),
					'body_part'=>$msg);							
					$this->dmailer->mail_notify($mail_conf);					
				
				  /******* End Invoice  mail */		 
			 }
		   
			 $condition = "&& MD5(order_id)='".$ordId."'";
			 
			 $cupn = $this->order_model->get_orders(0, 1, $condition);
			 
			 $cupn = $cupn[0];			 
			 
			 $point = $this->loyalty_model->get_loyalty_points($cupn['customers_id']);
			 
			 if(!empty($point) && is_array($point)){
				 $this->loyalty_model->update_loyalty_points($cupn['customers_id'], $cupn['order_id']);
			 }else{
				 $this->loyalty_model->add_loyalty_points($cupn['customers_id'], $cupn['order_id']);
			 }
			 
			 $cupndetil = $this->db->query("select coupon_id from wl_coupons where coupon_code = '".$cupn['discount_coupon_id']."' && end_date >= now()")->row_array();
			 
			 $this->payment_model->safe_update('wl_coupon_customers', array('status' => '1'), array('coupon_id' => $cupndetil['coupon_id'], 'customer_id' => $cupn['customers_id']), FALSE);	 
			 $this->session->unset_userdata(array('working_order_id' =>0,'coupon_code'=>''));
		 $this->session->set_flashdata('msg', $this->config->item('payment_success'));		
	     redirect('payment/thanks/'.$ordId, '');
	   
	 }
	 
	 
	  public function order_cancle()
	  {	 
	  
	   $ordId = $this->uri->segment(4);
		 $payment_method = $this->uri->segment(3);		 
		 $data  = array('payment_method'=>$payment_method,'order_status'=>'Canceled');			 	 
		 $where = "MD5(order_id) = '$ordId' ";
		 $this->payment_model->safe_update('wl_order',$data,$where,FALSE);			 
		 $this->session->unset_userdata(array('working_order_id' =>0));
		 $this->session->set_flashdata('msg', $this->config->item('payment_failed'));		 
	     redirect('payment/thanks/'.$ordId, '');
	   
	 }
	 
	
   
   public function thanks()
   {	   	
	 
	  $this->load->view('payment/pay_thanks');
	  
	 
   }
   
   
   

}
/* End of file member.php */
/* Location: .application/modules/products/controllers/cart.php */
