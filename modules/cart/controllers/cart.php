<?php
class Cart extends Public_Controller
{
    public function __construct()
    {

            parent::__construct();
            $this->load->helper(array('cart','products/product'));	 
            $this->load->model(array('products/product_model','members/members_model','cart_model'));
            $this->load->library(array('safe_encrypt','securimage_library','Auth'));			 
            $this->form_validation->set_error_delimiters("<div class='required fs12'>","</div>");
            $this->page_section_ct = 'common';
    }
    
    public function index()
    {			
            $order_cart_id = $this->session->userdata('working_order_id');
            if($order_cart_id!='')
            {
              $this->session->unset_userdata('working_order_id');
            }

            if( $this->input->post('EmptyCart')!="")
            {
                    $this->empty_cart();
                    $this->session->set_userdata(array('msg_type'=>'success'));
                    $this->session->set_flashdata('success',$this->config->item('cart_empty')); 
                    redirect('cart');
            }


//            $shipping_methods           =  $this->product_model->get_shipping_methods();				
//            $posted_shipping_method     =  $this->input->post('shipping_method');
//
//            if( $posted_shipping_method!='' )
//            {
//                    $this->session->set_userdata('shipping_id',$posted_shipping_method);
//            }

//            if( $posted_coupon_code!='' )
//            {
//                    $this->session->set_userdata('coupon_id',$posted_coupon_code);
//            }

//            $set_shipping_id = $this->session->userdata('shipping_id');
//            $shipping_id     = ($set_shipping_id!='' ) ? $set_shipping_id : $posted_shipping_method;		
//            $shipping_res    =  $this->cart_model->get_shipping_rate( $shipping_id );
//            $shipping_res    = is_array($shipping_res) ? $shipping_res  : array();

            $tax_cent = $this->cart_model->get_vat();

           // $data['shipping_methods']   = $shipping_methods;	
         //   $data['shipping_res']       = $shipping_res;
           // $data['discount_res']       = $discount_res;
            $data['tax_cent']           = $tax_cent;	
				
            $data['title']              = "Shopping Cart";	
            //$this->load->view('view_my_cart',$data);
            $this->load->view('view_cart_detail',$data);


    }
	
/*	
    public function apply_coupon_code($discount_res)
    {
       if( is_array($discount_res) && !empty($discount_res) && $discount_res['minimum_order_amount'] <=  $this->cart->total())
       {
                $cart_total      = $this->cart->total();
                $discount_type   =  $discount_res['coupon_type'];

              if( $discount_res['minimum_order_amount']!='' && $discount_res['minimum_order_amount']!='0.0000'  )
              {

                    if( $discount_type=='p' )
                     {

                                    $discount_amount  = ($cart_total*$discount_res['coupon_discount']/100);

                                     if( ($cart_total >= $discount_amount) &&  ($cart_total >= $discount_res['minimum_order_amount']) )
                                     {	
                                         $this->session->set_userdata(array('coupon_id'=>$discount_res['coupon_id'],
                                                                                                                                                                                                    'coupon_code'=>$discount_res['coupon_code'],
                                                                                  'discount_amount'=>$discount_amount) );

                                     }

                     }else
                     {
                              $discount_amount  = $discount_res['coupon_discount'];	

                              if( ($cart_total >= $discount_amount)  &&  ($cart_total >= $discount_res['minimum_order_amount']) )
                              {	
                                     $this->session->set_userdata(array('coupon_id'=>$discount_res['coupon_id'],
                                                                                                                                                                                    'coupon_code'=>$discount_res['coupon_code'],
                                                                        'discount_amount'=>$discount_amount) );

                              }

                     }


             }else
              {		

                     if( $discount_type=='p' )
                     {

                                     $discount_amount  = ($cart_total*$discount_res['coupon_discount']/100);

                                     if( $cart_total >= $discount_amount )
                                     {	
                                         $this->session->set_userdata(array('coupon_id'=>$discount_res['coupon_id'],
                                                                                                                                                                                                    'coupon_code'=>$discount_res['coupon_code'],
                                                                                'discount_amount'=>$discount_amount) );

                                     }

                     }else
                     {
                              $discount_amount  = $discount_res['coupon_discount'];		

                              if( $cart_total >= $discount_amount )
                              {	
                                     $this->session->set_userdata(array('coupon_id'=>$discount_res['coupon_id'],																							'coupon_code'=>$discount_res['coupon_code'],
                                                                        'discount_amount'=>$discount_amount) );

                              }

                     }


              }

            }else{
                    //echo '<script type="application/javascript" language="javascript">alert("Not enough cart amount to apply coupon")<script>;
              $this->session->set_userdata(array('msg_type'=>'error'));
              $this->session->set_flashdata('error','Not enough cart amount to apply coupon');	
              redirect('cart');	  
            }

    }
*/
	public function make_payment(){
		$posted_data = $this->session->userdata('posted_data');
		if(is_array($posted_data) && !empty($posted_data) && $this->cart->total_items() > 0 ){
			$this->form_validation->set_rules('pay_method', 'Payment Method', 'trim|required');
			if($this->input->post('pay_method') == 'cod'){
				$this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code');
			}
      if($this->form_validation->run() == TRUE){
				if($this->input->post('pay_method') == 'cod'){
					$posted_data['cod_amount'] = $this->cart_model->get_cod($this->cart->total());
					//$posted_data['cod_amount'] = $this->cart_model->get_cod($this->cart->total());
				}
				else{
					$posted_data['cod_amount'] = 0.00;
				}
				$this->add_customer_order($posted_data,$this->session->userdata('is_same_bill_ship'));
        $this->session->unset_userdata('posted_data');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('is_same_bill_ship');
        redirect('payment?pay_method='.$this->input->post('pay_method'));
      }
      $data['title'] = 'Make Payment';
      $this->load->view('view_make_payment',$data);            
    }
		else{
			redirect('category');
    }	
  }
    
	public function checkout(){
		if(!$this->cart->total_items() > 0 ){
			redirect('category');	
		}
		if( !$this->auth->is_user_logged_in() ){
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[80]');
			if($this->input->post('checkout_type') == 'User'){
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
			}
			if($this->form_validation->run() == TRUE){
				$username  =  $this->input->post('email');
				if($this->input->post('checkout_type') == 'User'){
					$password  =  $this->input->post('password');
					//   $rember    =  ($this->input->post('remember')!="") ? TRUE : FALSE;
					if( $this->input->post('remember')=="Y" ) {
						set_cookie('userName',$this->input->post('email'), time()+60*60*24*30 );
            set_cookie('pwd',$this->input->post('password'), time()+60*60*24*30 );
          }
					else{
						delete_cookie('userName');
            delete_cookie('pwd');
          }	
					$this->auth->verify_user($username,$password);	
					if( $this->auth->is_user_logged_in() ){
						redirect('cart/delivery_info','');
					}
					else{
						$this->session->set_flashdata('error',$this->config->item('login_failed'));
						redirect('cart/checkout', '');
          }	
        }
				else{
					$this->session->set_userdata('username', $username);
					redirect('cart/delivery_info',''); 
				}
			}
			else{
				$data['title'] = "Checkout Info";			
        $this->load->view('view_cart_checkout',$data); 				
      }
    }
		else{
			redirect('cart/delivery_info',''); 			
    }
  }
  
  public function checkout_user(){
      
      $data['user_add']=$this->db->query("select * from wl_customers_address_book where customer_id='".$this->session->userdata('user_id')."' ")->row_array();
       $this->form_validation->set_rules('check_email', 'Email ID', 'trim|required|valid_email|max_length[80]');
        $this->form_validation->set_rules('check_name', 'First Name', 'trim|required|alpha|max_length[32]|xss_clean');
        $this->form_validation->set_rules('check_mobile', 'Mobile No', 'trim|required|numeric|max_length[10]|xss_clean');
        $this->form_validation->set_rules('check_state', 'State', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('check_country', 'Country', 'trim|required|max_length[32]|xss_clean');
        $this->form_validation->set_rules('check_city', 'City', 'trim|required|max_length[30]|xss_clean');
        $this->form_validation->set_rules('check_address', 'Address', 'trim|required|max_length[80]');
        $this->form_validation->set_rules('check_zipcode', 'Zipcode', 'trim|required|numeric|max_length[32]|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            	$this->add_customer_order($this->input->post(),$is_same_bill_ship='Y');
                   redirect('home');
        
      
      
        }
      $this->load->view('checkout_user',$data);
  
  
  } 
  
  
	public function delivery_info(){
		if ( !$this->cart->total_items() > 0 ){
			redirect('category');	
		}
		// trace($this->input->post());
    $data['title'] =  'Delivery Information'; 
		//trace($this->session->userdata);
		$is_same_bill_ship =   $this->input->post('is_same',TRUE);
		$mres = $this->members_model->get_member_row( $this->session->userdata('user_id') );
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required|alpha|max_length[80]');
		$this->form_validation->set_rules('mobile', 'Mobile No.', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('phone', 'Phone No.', 'trim|max_length[20]');
		$this->form_validation->set_rules('zipcode', 'Pin Code', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('landmark', 'Landmark', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('city', 'City', 'trim|required|max_length[40]');
		$this->form_validation->set_rules('state', 'State', 'trim|required|max_length[40]');
		$this->form_validation->set_rules('country', 'Country', 'trim|required|max_length[80]');
//	$this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code');

    if(is_array($mres) && !empty($mres)){
			$email = $mres['user_name'];
		}
		else{
			$email = $this->session->userdata['username'];
		}
		
		$posted_data = array(
			'customer_id'				=>	$this->session->userdata('user_id'),
			'name'							=>	$this->input->post('name'),
			'mobile'						=>	$this->input->post('mobile'),
			'phone'							=>	$this->input->post('phone'),
			'zipcode'						=>	$this->input->post('zipcode'),
			'address'						=>	$this->input->post('address'),
			'landmark'					=>	$this->input->post('landmark'),
			'city'							=>	$this->input->post('city'),
			'state'							=>	$this->input->post('state'),
			'country'						=>	$this->input->post('country'),
		);
		
		if( is_array($mres) && !empty($mres) ){
			if ($this->form_validation->run() === FALSE){
				$mres_address=$this->db->query("select * from wl_customers_address_book where  customer_id='".$mres['customers_id']."' order by default_address desc limit 0, 1")->row_array();
				$mres =array(
					'name'        => $mres_address['name'],
        	'phone'       => $mres_address['phone'],	
					'mobile'      => $mres_address['mobile'],									
					'address'     => $mres_address['address'],	
					'landmark'    => $mres_address['landmark'],			
					'zipcode'     => $mres_address['zipcode'],
					'country'     => $mres_address['country'],
					'state'       => $mres_address['state'],
					'city'        => $mres_address['city'],
					'address_id' 	=> $mres_address['address_id'],		
				);
				$data['mres'] = $mres;		
        $this->load->view('view_cart_delivery',$data);
			}
			else{
				
				$my_address=$this->db->query("select address_id from wl_customers_address_book where  customer_id='".$mres['customers_id']."' AND mobile = '".$this->db->escape_str($this->input->post('mobile'))."' AND address = '".$this->db->escape_str($this->input->post('address'))."' AND city = '".$this->db->escape_str($this->input->post('city'))."' AND state = '".$this->db->escape_str($this->input->post('state'))."' AND country = '".$this->input->post('country')."'")->row_array();
				$addressCount = get_found_rows();
				//exit;
				if($addressCount == 0){
					$addressData =array(
						'customer_id'			=> $mres['customers_id'],
						'name'        		=> $this->input->post('name'),
						'phone'       		=> $this->input->post('phone'),	
						'mobile'      		=> $this->input->post('mobile'),									
						'address'     		=> $this->input->post('address'),	
						'landmark'    		=> $this->input->post('landmark'),			
						'zipcode'     		=> $this->input->post('zipcode'),
						'country'     		=> $this->input->post('country'),
						'state'       		=> $this->input->post('state'),
						'city'        		=> $this->input->post('city'),
						'default_address' => 'Y',
						'default_status' 	=> 'Y'
					);
					//trace($addressData);
					//exit;
					$addressIDs = $this->cart_model->safe_insert('wl_customers_address_book',$addressData);	
					//exit;
				}
						
				if($this->input->post('default_address') != ''){
					$this->db->query("update wl_customers_address_book SET default_address = 'N' where customer_id = '".$mres['customers_id']."'");
					$this->db->query("update wl_customers_address_book SET default_address = 'Y' where address_id = '".$this->input->post('default_address')."'");
				}
				
				$shipcharge = 20;
        $cart_total = $this->cart->total();
        //$rate_dhl = $this->DHLShipPrice($totweight);
        
				$this->session->set_userdata('posted_data',$posted_data);
	      $this->session->set_userdata('is_same_bill_ship',$is_same_bill_ship);
  	    redirect('cart/make_payment');
    	  //   $this->add_customer_order($posted_data,$is_same_bill_ship);
	    } 
  	}
		else{
			if ($this->form_validation->run() == FALSE){
				$data['mres']  =  $posted_data; 
      	$this->load->view('view_cart_delivery',$data);				
			}
			else{
				$shipcharge = 20;
      	$cart_total = $this->cart->total();
				$this->session->set_userdata('posted_data',$posted_data);
  	    $this->session->set_userdata('is_same_bill_ship',$is_same_bill_ship);  
    	  redirect('cart/make_payment');
      	// $this->add_customer_order($posted_data,$is_same_bill_ship);					 
	    }					
	  }
	}

	private function add_customer_order($costumer_data = array(),$is_same_bill_ship){
		if( $this->cart->total_items() > 0 ){
			//trace($this->session->userdata);
			$userId            = $this->session->userdata('user_id');				
			$invoice_number    = "Wl_".get_auto_increment('wl_order');	
			$coupon_id         = $this->session->userdata('coupon_id');
			$discount_amount   = $this->session->userdata('discount_amount');
			$currency_code     = $this->session->userdata('currency_code');
			$currency_value    = $this->session->userdata('currency_value');
			$customers_id   =  ( $userId!='') ? $userId : 0;
			
			$cart_total 	= $this->cart->total();
			$tax_cent 		= $this->cart_model->get_vat();
			$ship_method 	= 'none';
			$ship_amount 	= $this->cart_model->get_shipping($cart_total);
			//$cod_amount 	= $this->cart_model->get_cod($cart_total);
			
			$tax = ($cart_total*$tax_cent)/100;
			if($is_same_bill_ship=='Y'){
				$costumer_data['shipping_name']    = $costumer_data['check_name'];
				$costumer_data['shipping_address'] = $costumer_data['check_address'];
				$costumer_data['shipping_landmark']= $costumer_data['check_landmark'];
				$costumer_data['shipping_mobile']  = $costumer_data['check_mobile'];
				$costumer_data['shipping_phone']   = $costumer_data['check_mobile'];
				$costumer_data['shipping_zipcode'] = $costumer_data['check_zipcode'];
				$costumer_data['shipping_country'] = $costumer_data['check_country'];
				$costumer_data['shipping_state']   = $costumer_data['check_state'] ;
				$costumer_data['shipping_city']    = $costumer_data['check_city'];
			}
			$data_order = array(
				'customers_id'        => $customers_id,
				'invoice_number'      => $invoice_number,					
				'first_name'          => $costumer_data['check_name'],
				'last_name'           => '',
				'email'               => $this->session->userdata('username'),					
				'billing_name'        => $costumer_data['check_name'],
				'billing_address'     => $costumer_data['check_address'],					
				'billing_phone'       => $costumer_data['check_mobile'],					
				'billing_zipcode'     => $costumer_data['check_zipcode'],
				'billing_country'     => $costumer_data['check_country'],
				'billing_state'       => $costumer_data['check_state'],
				'billing_city'        => $costumer_data['check_city'],					
				'shipping_name'       => $costumer_data['check_name'],
				'shipping_address'    => $costumer_data['check_address'],					
				'shipping_phone'      => $costumer_data['check_mobile'],					
				'shipping_zipcode'    => $costumer_data['check_zipcode'],
				'shipping_country'    => $costumer_data['check_country'],
				'shipping_state'      => $costumer_data['check_state'],
				'shipping_city'       => $costumer_data['check_city'],						
				'shipping_method'     => $ship_method,
				'discount_coupon_id'  => $coupon_id,
				'coupon_discount_amount'=>$discount_amount,
				'shipping_amount'     => $ship_amount,
				'cod_amount'     			=> $cart_total,
				'total_amount'        => $cart_total,
				'vat_amount'					=> $tax,
				'vat_applied_cent'		=> $tax_cent,
				'currency_code'       => $currency_code ,
				'currency_value'      => $currency_value,				
				'order_status'        => 'Pending',
				'order_received_date' => $this->config->item('config.date.time'),
				'payment_method'      => 'COD',
				'payment_status'      => 'Unpaid'
			);
			//trace($data_order);
			//exit;
			if(!$this->cart_model->is_order_no_exits($invoice_number) ){
				$orderId = $this->cart_model->safe_insert('wl_order',$data_order,FALSE);		
				$this->session->set_userdata( array('working_order_id'=>$orderId) );				
				foreach($this->cart->contents() as $items){
					$thumbc['width'] =195;
					$thumbc['height']=150;
					$thumb_name = "thumb_".$thumbc['width']."_".$thumbc['height']."_".$items['img'];					
					$image_file  = IMG_CACH_DIR."/".$thumb_name;
					$default_no_img = FCROOT."assets/developers/images/noimg1.gif";

					$file_data   = ( file_exists($image_file) ) ?  file_get_contents($image_file) : file_get_contents($default_no_img);

					/*if($items['options']['Color']>0){		
						$color_id = $items['options']['Color'];
						$product_color = 	color_name($color_id);
					}
					else{
						$product_color = 	"";
					}
					
					
					if($items['options']['Size']>0){
						$size_id = $items['options']['Size'];
						$product_size = 	size_name($size_id);
					}
					else{
						$product_size = 	"";
					}*/
					
					$data = array(
						'order_id'       		=> $orderId,							
						'products_id'    		=> $items['pid'],
						'product_name'   		=> $items['origname'],
						//'product_brand'  		=> $product_brand,
						//'product_color'  		=> $product_color,
						//'product_size'   		=> $product_size,
						//'product_color_id'  => $color_id,
						//'product_size_id'   => $size_id,
						'product_code'   		=> $items['code'],
						'product_image'  		=> $file_data,							
						'product_price'  		=> $items['price'],						
						'quantity'       		=> $items['qty']
					);						
					/*
					$data_qty_used  = array('used_qty' =>$items['qty']);
					$where          = "product_id = ".$items['pid']." ";
					$this->cart_model->safe_update('tbl_products',$data_qty_used,$where,FALSE);
					*/
					$this->cart_model->safe_insert('wl_orders_products',$data,FALSE);
				}    
				$user_id = $this->session->userdata('user_id');
				if( $coupon_id!="" && $user_id!='' ){
					$this->db->from('wl_coupons');
					$this->db->where(array('coupon_code ='=>$coupon_id,'status = '=>'1', 'end_date <=' => $this->config->item('config.date.time'), 'start_date >=' => $this->config->item('config.date.time')));
					$qry_coup = $this->db->get();
					$res_coup = $qry_coup->row_array();	

					$where = "coupon_id = '". $res_coup['coupon_id']."' AND customer_id ='".$user_id ."' ";
					$data = array('status'=>'1');
					$this->cart_model->safe_update('wl_coupon_customers',$data,$where,FALSE);
				}

				$this->cart->destroy();
				$data = array('shipping_id' => 0,'coupon_id'=>0,'discount_amount'=>0,'posted_data'=>0,'is_same_bill_ship'=>0);
				$this->session->unset_userdata($data);
				
			}		
		}
	}
    
    public function DHLShipPrice($weight=2){
        $SiteID = 'MibanEntre';
        $password = 'uhbCXS23wS';
        $to_country_code = 'IN';
        $to_zip = '110015';
        $to_city = 'New Delhi';
        $data ='<?xml version="1.0" encoding="UTF-8"?>
		<p:DCTRequest xmlns:p="http://www.dhl.com" xmlns:p1="http://www.dhl.com/datatypes" xmlns:p2="http://www.dhl.com/DCTRequestdatatypes" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dhl.com DCT-req.xsd ">
		<GetQuote xmlns="">
                    <Request>
                            <ServiceHeader>
                                <MessageTime>'.date('c').'</MessageTime>
                                <MessageReference>1234567890123456789012345678901</MessageReference>
			 	<SiteID>'.$SiteID.'</SiteID>
	        		<Password>'.$password.'</Password>
	        	</ServiceHeader>
                </Request>
	      <From>
	      	<CountryCode>US</CountryCode>
	      	<Postalcode>11234</Postalcode>
	      	<City>BROOKLYN</City>
	      </From>
	      <BkgDetails>
	      	<PaymentCountryCode>US</PaymentCountryCode>
	      	<Date>'.date("Y-m-d").'</Date>
	      	<ReadyTime>PT0H00M</ReadyTime>
	      	<DimensionUnit>CM</DimensionUnit>
	      	<WeightUnit>KG</WeightUnit>
                <Pieces>
                  <Piece>
                        <PieceID>1235</PieceID>
                        <Weight>'.$weight.'</Weight>  
                    </Piece>
                </Pieces>
	      	<PaymentAccountNumber>846430151</PaymentAccountNumber>
	      	<IsDutiable>N</IsDutiable>
	      	</BkgDetails>
	      	<To>
                    <CountryCode>'.$to_country_code.'</CountryCode>
                    <Postalcode>'.$to_zip.'</Postalcode>
                    <City>'.$to_city.'</City>
	      	</To>
	      	<Dutiable><DeclaredCurrency>USD</DeclaredCurrency>
                    <DeclaredValue>150</DeclaredValue>
	      	</Dutiable></GetQuote>
	     </p:DCTRequest>';

                $ch = curl_init("http://xmlpi-ea.dhl.com/XMLShippingServlet");  
                curl_setopt($ch, CURLOPT_HEADER, 1);  
                curl_setopt($ch,CURLOPT_POST,1);  
                curl_setopt($ch,CURLOPT_TIMEOUT, 60);  
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
                curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);  
                curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
                curl_setopt($ch,CURLOPT_POSTFIELDS,$data); 
                
               $result=curl_exec ($ch);  
               echo "<pre>";
               echo $data = strstr($result, '<?'); 
               $xml=simplexml_load_string($data);
               print_r($xml);
    }

    public function invoice_mail_data($ordId)
    {
        if( $ordId !="")
        {
            $msgdata      = invoice_data($ordId);	
            $msgdata      = str_replace('bgcolor="#333333"','',$msgdata);
            $msgdata      = str_replace('Print','',$msgdata);
            $msgdata      = str_replace('Close','',$msgdata);
            return $msgdata;
        }
    }

    public function invoice()
    {
			
            if( $this->session->userdata('working_order_id') > 0 )
            {
                    $this->load->model(array('order/order_model'));
                    $data['title'] = "Checkout";
                    $order_res = $this->order_model->get_order_master( $this->session->userdata('working_order_id') );
                    $order_details_res = $this->order_model->get_order_detail($order_res['order_id']);			
                    $data['orddetail']  = $order_details_res;
                    $data['ordmaster']  = $order_res;				
                    $data['ordId']      = $order_res['order_id'];			
                    $data['unq_section'] = "Checkout";	
                    $this->load->view('view_cart_invoice',$data);

            }else
            {
                    redirect('cart', '');
            }
    }

	public function print_invoice(){
		$this->load->model(array('order/order_model'));
		$ordId  = $this->uri->segment(3,$this->session->userdata('working_order_id'));
		$order_res          = $this->order_model->get_order_master( $ordId );
		$order_details_res  = $this->order_model->get_order_detail($order_res['order_id']);	
		$data['orddetail']  = $order_details_res;
		$data['ordmaster']  = $order_res;			
		$data['ordId'] = $ordId;		 
		$this->load->view('view_invoice_print',$data);
	}
	
	public function add_to_wishlist()
    {		

            if( $this->session->userdata('user_id') > 0 )
            {
                    $product_id = (int) $this->uri->segment(3);
                    $this->cart_model->add_wislists($product_id,$this->session->userdata('user_id'));					
                    redirect('members/favourites');

            }else
            {

                    redirect('users/login?ref='.$this->input->server('HTTP_REFERER').''); 
            }
    }

    public function add_to_cart()
    {		
       
         $this->add_cart();			
    }

	public function check_product_exits_into_cart($pres){
		//trace($pres);
		$prod_size = (int)$this->input->post('size');
    $prod_color = (int)$this->input->post('color');
    $cart_array =  $this->cart->contents();
		//trace($cart_array);
		//exit;
		$insert_flag=0;
		if( is_array( $cart_array ) && !empty($cart_array)){
			foreach($this->cart->contents() as $item ){
				if(array_key_exists('pid',$item )){
					if( $item['pid']==$pres['products_id'] && $item['options']['Size']==$prod_size && $item['options']['Color']==$prod_color){
						//echo "true";
						$insert_flag=1;
					}					
				}				
			}
    }
		//exit;
		return $insert_flag;
  }   

	private function add_cart(){
		//$productId  = (int) $this->uri->segment(3);
               $productId  = $this->input->post('product_cart_id');
		$color  		= $this->input->get_post('color');
		$size  			= $this->input->get_post('size');
						
    $option     = array('productid'=>$productId);		
    $pres       =  $this->product_model->get_products(1,0, $option);
		$pres				= $pres[0];
				
		if($color != '' || $size != ''){
			$base_price_cond = array(
			'where'=>"product_id ='".$pres['products_id']."' AND color_id ='".$color."' AND  size_id = '".$size."'"
			);
    	$res_base_price = $this->product_model->get_product_base_price($base_price_cond);
		}
		else{
			$res_base_price=array();
			$res_base_price['product_discounted_price'] = $pres['product_discounted_price'];
			$res_base_price['product_price'] = $pres['product_price'];
			$res_base_price['quantity'] = $pres['product_qty'];
		}
		
		if( (is_array($pres) && !empty($pres)) && (is_array($res_base_price) && !empty($res_base_price))){
			$qty         = applyFilter('NUMERIC_GT_ZERO',$this->input->post('qty'));		
      $qty         = ($qty > 0) ? $qty: 1;		
      $cart_price  = ((int)$res_base_price['product_discounted_price'] > 0) ? $res_base_price['product_discounted_price'] : $res_base_price['product_price'];
			$is_exits_inot_cart = $this->check_product_exits_into_cart($pres);
			//trace($is_exits_inot_cart);
			//exit;
			if($is_exits_inot_cart == 1){
				//echo "fail";
				$this->session->set_userdata(array('msg_type'=>'success'));
        $this->session->set_flashdata('success','Product already exists to cart.');								
        redirect('cart','refresh');
			}
			else{
				echo "pass";
				$prod_size 	= $size;
				$prod_color = $color;
				$availableqty = ( $res_base_price['quantity'] );// - $res_base_price['used_quantity'] );
				$availableqty = ($availableqty < 0 )  ? 0 :  $availableqty;
				$cart_data  = array(
					'id'             	=> random_string('numeric',6),		   
					'qty'            	=> $qty,
					'availableqty'   	=> $availableqty,
					'price'          	=> $cart_price,
					'product_price'  	=> $res_base_price['product_price'],
					'discount_price' 	=> $res_base_price['product_discounted_price'],
					'name'           	=> url_title($pres['product_name']),
					'origname'       	=> $pres['product_name'],												
					'pid'            	=> $pres['products_id'],												
					'img'            	=> $pres['media'],												
					'code'           	=> $pres['product_code'],
					'product_weight'	=> '',
					'options'	 				=> array(
																'Size'=>$prod_size,
																'Color'=>$prod_color
																)
				);
				
				
				$this->cart->insert($cart_data);
			
				//trace($this->cart->contents());
				//exit;
				
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success','Product has been added to cart.');
				redirect('cart','refresh');
			}
		}
		else{
			redirect("category");
		}

  }

    public function empty_cart()
    {
            $this->cart->destroy();
            $data2 = array(
              'shipping_id' => 0,
              'coupon_id' => 0,
              'discount_amount'=>0
            );

            $this->session->unset_userdata($data2);
            redirect('cart');

    }

    public function remove_item()
    {
            $data = array(
             //'rowid' =>$this->uri->segment(3),
                'rowid' =>$this->input->post('row_id'),
             'qty' => 0
            );

            $data2 = array(
              'shipping_id' => 0,
              'coupon_id' => 0,
              'discount_amount'=>0
            );

            $this->session->unset_userdata($data2);

            $this->cart->update($data);	

            if($this->cart->total_items()==0)
            {
                    $this->session->unset_userdata(array('coupon_id'=>0,'discount_amount'=>0));

            }else
            {		 	
                  $discount_res          =  $this->cart_model->get_discount( $this->session->userdata('coupon_id') );	
             // $this->apply_coupon_code( $discount_res );	
            }		

            $this->session->set_userdata(array('msg_type'=>'success'));
            $this->session->set_flashdata('success',$this->config->item('cart_delete_item'));

            redirect($_SERVER['HTTP_REFERER'],'refresh');  

    }

	public function update_cart_qty(){
		$cart = $this->cart->contents();
                //print_r($this->input->post());die;
		$item=$this->input->post('row_id');
                $qty=$this->input->post('qty');
                 $avail_qty=$this->input->post('max_qty');
                for($i=0; $i< count($cart); $i++){
                    
			//$item = $this->input->post($i);
			//$cart_id = $item['rowid'];
                        //$cart[$cart_id]['availableqty'];die;
			if($qty[$i] <= 0){
				$res = array('error_type'=>'error','error_msg'=>"Can not update less then 0"); 
			}
			elseif($avail_qty[$i] >= $qty[$i]){
				$data = array(
					'rowid' => $item[$i],
					'qty' => $qty[$i]
        );
				$this->cart->update($data);
				//  $this->session->set_userdata(array('msg_type'=>'uccess'));
        //  $this->session->set_flashdata('success',$this->config->item('cart_quantity_update'));
        $res = array('error_type'=>'pass','error_msg'=>$this->config->item('cart_quantity_update'));
      }
			else{
				// $this->session->set_userdata(array('msg_type'=>'error'));
        //  $msg = str_replace('<quantity>',$cart[$item['rowid']]['availableqty'],lang('Msg_cart_avail_qty'));
        //  $this->session->set_flashdata('error'," can not update more then available quantity");
        $res = array('error_type'=>'error','error_msg'=>"Can not update more then available quantity");
      }
     	//redirect('cart','refresh');
      echo json_encode($res);
    }
}

    public function count_cart_item()
    {
            return $this->cart->total_items();
    }

    public function cart_total_amount()
    {
            $total = $this->cart->total();	
            return $total;
    }

    public function display_cart_image($orders_products_id)
    { 	
             $binary_data =  get_db_field_value('wl_orders_products','product_image',array('orders_products_id'=>$orders_products_id));
             header("Content-Type: image/jpeg");			 
             echo $binary_data; 

    }

    public function thanksorder()
    {

            $data['page_text']=cms_page_content(15);		
            $data['page_title'] = "Thanks";		 
            $this->load->view('view_order_thanks',$data);
    }
}
/* End of file member.php */
/* Location: .application/modules/products/controllers/cart.php */