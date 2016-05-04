<?php
class Pages extends Public_Controller
{

	public function __construct() {
	           
			parent::__construct(); 
			$this->load->helper(array('file','category/category','currency'));	 
			$this->load->library(array('Dmailer'));	
                        $this->load->library(array('mailer'));	
			$this->load->model(array('pages/pages_model'));
			$this->form_validation->set_error_delimiters("<div class='required'>","</div>");
			$this->page_section_ct = 'static';
	
	}
		
		
	public function index(){
		$friendly_url    = $this->uri->uri_string;				 		 
		$condition       = array('friendly_url'=>$friendly_url,'status'=>'1');			 
		$content         =  $this->pages_model->get_cms_page( $condition );				 
		$data['content'] = $content;	
		$this->load->view('pages/cms_page_view',$data);	
	}			
	
		
	public function contactus()
	{
            
           
            
            
             //  echo "<pre>";
              // print_r($this->input->post()); 
		$this->form_validation->set_rules('customer_name','Name','trim|alpha|required|max_length[30]');
		$this->form_validation->set_rules('customer_mail','Email','trim|required|valid_email|max_length[80]');
		$this->form_validation->set_rules('subject','Subject','trim|max_length[20]');			
		$this->form_validation->set_rules('mobile_number','Mobile Number','trim|required|max_length[20],|numeric');	
		$this->form_validation->set_rules('comments','Message','trim|required|max_length[8500]');		
		//$this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code');
		
		
		if($this->form_validation->run()==TRUE)
		{			
							
			$posted_data=array(				
				'first_name'    => $this->input->post('customer_name'),
				'last_name'     => '',
				'email'         => $this->input->post('customer_mail'),
				'phone_number'  => $this->input->post('subject'),
				'mobile_number' => $this->input->post('mobile_number'),
				'message'       => $this->input->post('verification_code'),	
				'receive_date'     =>$this->config->item('config.date.time')
			);
			$this->pages_model->safe_insert('wl_enquiry',$posted_data,FALSE); 
			
			/********* Send  mail to admin ***********/
			$fullname =$this->input->post('customer_name');
			$admin_email  = get_site_email();
			$content    	=  get_content('wl_auto_respond_mails','5');	
			$body       	=  $content->email_content;	
			$body					=	str_replace('{mem_name}','Admin',$body);
			$body					=	str_replace('{body_text}','You have received an enquiry and details are given below.',$body);
			$body					=	str_replace('{name}',$fullname,$body);
			$body					=	str_replace('{email}',$this->input->post('customer_mail'),$body);
			$body					=	str_replace('{mobile}',$this->input->post('mobile_number'),$body);
			if($this->input->post('mobile_number')!=''){
				$body			=	str_replace('{phone}',$this->input->post('mobile_number'),$body);
			}
			else{
				$body			=	str_replace('{phone}','',$body);
				$body			=	str_replace('Phone No :','',$body);
			}
			$body			=	str_replace('{comments}',$this->input->post('comments'),$body);					
			$body			=	str_replace('{site_name}',$this->config->item('site_name'),$body);
			$body			=	str_replace('{admin_email}',$admin_email->admin_email,$body);
			$body			=	str_replace('{url}',base_url(),$body);
			
			 // die($body);
			$mail_conf =  array(
				'subject'=>"Enquiry from ".$this->input->post('customer_mail')." ",
				'to_email'=>$admin_email->admin_email,
				'from_email'=>$this->input->post('customer_mail'),
				'from_name'=>$this->input->post('first_name'),
				'body_part'=>$body
			);
			//trace($mail_conf);
			//exit;
			//echo $this->dmailer->mail_notify($mail_conf);die;
                        $this->mailer->sending_mail($mail_conf);
	
			/* End Send  mail to admin */
			/********* Send  mail to user ***********/
			$content    = get_content('wl_auto_respond_mails','5');				
			$body       = $content->email_content;	
			$body				=	str_replace('{mem_name}',$fullname,$body);
			$body				=	str_replace('{body_text}','You have placed an enquiry and details are given below.',$body);
			$body				=	str_replace('{name}',$fullname,$body);
			$body				=	str_replace('{email}',$this->input->post('customer_mail'),$body);
			$body				=	str_replace('{mobile}',$this->input->post('mobile_number'),$body);
			if($this->input->post('mobile_number')!=''){
				$body			=	str_replace('{phone}',$this->input->post('mobile_number'),$body);
			}
			else{
				$body			=	str_replace('{phone}','',$body);
				$body			=	str_replace('Phone No :','',$body);
			}
			$body			=	str_replace('{comments}',$this->input->post('comments'),$body);				
			$body			=	str_replace('{site_name}',$this->config->item('site_name'),$body);
			$body			=	str_replace('{url}',base_url(),$body);
			
	
			$mail_conf =  array(
				'subject'=>"Enquiry placed at ".$this->config->item('site_name')." ",
				'to_email'=>$this->input->post('customer_mail'),
				'from_email'=>$admin_email->admin_email,
				'from_name'=>$this->config->item('site_name'),
				'body_part'=>$body
			);
                        //print $mail_conf;die;
			//$this->dmailer->mail_notify($mail_conf);	
                        $this->mailer->sending_mail($mail_conf);
			/* End Send  mail to user */
			$this->session->set_userdata(array('msg_type'=>'success'));
			$this->session->set_flashdata('success', 'Your feedback has been added successfully.We will get back to you soon.'); 
			redirect('thanks', ''); 
		}
		$friendly_url = $this->uri->segment(1);			
		$condition       = array('friendly_url'=>$friendly_url,'status'=>'1');			 
		$content         =  $this->pages_model->get_cms_page( $condition );
		$data['content'] = $content['page_description'];				
		$data['title'] = "Contact Us";
		$this->load->view('contactus',$data);	
	}
		
		
	public function sitemap(){
		$data['title'] = "Site Map";
		$this->load->view('sitemap',$data);	
	}	  
	
	public function sendenquiry()
	{
						
		$productId        = (int) $this->uri->segment(3);
		$data['heading_title'] = "Send Enquiry";	
		$this->form_validation->set_rules('first_name','First Name','trim|alpha|required|max_length[30]');
		$this->form_validation->set_rules('last_name','Last Name','trim|alpha|max_length[30]');
		$this->form_validation->set_rules('company_name','Company Name','trim|max_length[100]');	
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[80]');
		$this->form_validation->set_rules('phone_number','Phone','trim|max_length[20]');			
		$this->form_validation->set_rules('address','Address','trim|max_length[100]');	
		$this->form_validation->set_rules('message','Message','trim|required|max_length[8500]');		
		$this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code');
		
		
		if($this->form_validation->run()==TRUE)
		{			
							
			$posted_data=array(				
			'first_name'    => $this->input->post('first_name'),
			'last_name'     => $this->input->post('last_name'),
			'product_service'	=> $this->input->post('product_name'),
			'product_id'		=> $this->input->post('product_id'),
			'company_name'     => $this->input->post('company_name'),
			'email'         => $this->input->post('email'),
			'phone_number'  => $this->input->post('phone_number'),
			'message'       => $this->input->post('message'),	
			'address'		=> $this->input->post('address'),	
			'type'				=>'1',	
			'receive_date'     =>$this->config->item('config.date.time')
			);
			
			$this->pages_model->safe_insert('wl_product_enquiry',$posted_data,FALSE); 
			
			
			/********* Send  mail to admin ***********/
			$fullname=$this->input->post('first_name').' '.$this->input->post('last_name');
			$admin_email  = get_site_email();
			$content    =  get_content('wl_auto_respond_mails','5');	
			$body       =  $content->email_content;	
			$body			=	str_replace('{recv_name}','Admin',$body);
			$body			=	str_replace('{body_text}','You have received an enquiry and details are given below.',$body);
			if($this->input->post('product_name')!=''){
			$body			=	str_replace('{product}',$this->input->post('product_name'),$body);
			
			}else{
			$body			=	str_replace('{product}','',$body);
			$body			=	str_replace('Product :','',$body);
			}
			$body			=	str_replace('{name}',$fullname,$body);
			$body			=	str_replace('{email}',$this->input->post('email'),$body);
			if($this->input->post('phone_number')!=''){
			$body			=	str_replace('{phone}',$this->input->post('phone_number'),$body);
			
			}else{
			$body			=	str_replace('{phone}','',$body);
			$body			=	str_replace('Phone No :','',$body);
			}
			if($this->input->post('company_name')!=''){
			$body			=	str_replace('{company_name}',$this->input->post('company_name'),$body);
			}else{
			$body			=	str_replace('{company_name}','',$body);
			$body			=	str_replace('company name :','',$body);
			}
			if($this->input->post('address')!=''){
			$body			=	str_replace('{address}',$this->input->post('address'),$body);
			}else{
			$body			=	str_replace('{address}','',$body);
			$body			=	str_replace('address :','',$body);
			}
			$body			=	str_replace('{comments}',$this->input->post('message'),$body);					
			$body			=	str_replace('{site_name}',$this->config->item('site_name'),$body);
			$body			=	str_replace('{url}',base_url(),$body);
			
			 //  die($body);
			$mail_conf =  array(
													'subject'=>"Enquiry from ".$this->input->post('first_name')." ",
													'to_email'=>$admin_email->admin_email,
													'from_email'=>$this->input->post('email'),
													'from_name'=>$this->input->post('first_name'),
													'body_part'=>$body
												);
			
			echo $this->dmailer->mail_notify($mail_conf);die;				
	
			/* End Send  mail to admin */
			/********* Send  mail to user ***********/
			$content    =  get_content('wl_auto_respond_mails','5');	
			$body       =  $content->email_content;	
			$body			=	str_replace('{recv_name}',$this->input->post('first_name'),$body);
			$body			=	str_replace('{body_text}','You have placed an enquiry and details are given below.',$body);
			if($this->input->post('product_name')!=''){
			$body			=	str_replace('{product}',$this->input->post('product_name'),$body);
			
			}else{
			$body			=	str_replace('{product}','',$body);
			$body			=	str_replace('Product :','',$body);
			}
			$body			=	str_replace('{name}',$fullname,$body);
			$body			=	str_replace('{email}',$this->input->post('email'),$body);
			if($this->input->post('phone_number')!=''){
			$body			=	str_replace('{phone}',$this->input->post('phone_number'),$body);
			
			}else{
			$body			=	str_replace('{phone}','',$body);
			$body			=	str_replace('Phone No :','',$body);
			}
			if($this->input->post('company_name')!=''){
			$body			=	str_replace('{company_name}',$this->input->post('company_name'),$body);
			}else{
			$body			=	str_replace('{company_name}','',$body);
			$body			=	str_replace('company name :','',$body);
			}
			if($this->input->post('address')!=''){
			$body			=	str_replace('{address}',$this->input->post('address'),$body);
			}else{
			$body			=	str_replace('{address}','',$body);
			$body			=	str_replace('address :','',$body);
			}
			$body			=	str_replace('{comments}',$this->input->post('message'),$body);				
			$body			=	str_replace('{site_name}',$this->config->item('site_name'),$body);
			$body			=	str_replace('{url}',base_url(),$body);
			
	
			$mail_conf =  array(
													'subject'=>"Enquiry placed at ".$this->config->item('site_name')." ",
													'to_email'=>$this->input->post('email'),
													'from_email'=>$admin_email->admin_email,
													'from_name'=>$this->config->item('site_name'),
													'body_part'=>$body
												);
			$this->dmailer->mail_notify($mail_conf);				
	
			/* End Send  mail to user */
		
			$this->session->set_userdata(array('msg_type'=>'success'));
			$this->session->set_flashdata('success', 'Your Product Enquiry has been added successfully.We will get back to you soon.'); 
			redirect('thanks', ''); 
			
		}
		 $friendly_url = 'contactus';			
		 $condition       = array('friendly_url'=>$friendly_url,'status'=>'1');			 
		 $content         =  $this->pages_model->get_cms_page( $condition );
		 $data['content'] = $content['page_description'];				
		 $data['title'] = "Contact Us";
		 $this->load->view('view_sendenquiry',$data);	
		
	}
	
	
	public function thanks()
	{
		$data['heading_title'] = "Thanks";			
		$this->load->view('pages/thanks',$data);	
	}
        public function whowear()
	{
		$data['heading_title'] = "Whowear";			
		$this->load->view('pages/whowear',$data);	
	}
	
         
        public function media()
	{
		$data['heading_title'] = "Media";			
		$this->load->view('pages/media',$data);	
	}
        
        
	public function order_tracking()
	{
		$data['track'] = '';
		$this->form_validation->set_rules('invoice_number','Order Number','trim|required|max_length[100]');	
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code');
		
		if($this->form_validation->run()==TRUE){
			$sql 		= "SELECT tracking_code, tracking_text, courier_company_id, order_received_date, order_status FROM wl_order WHERE invoice_number = '".$this->input->post('invoice_number')."' AND email = '".$this->input->post('email')."'";
			$result = $this->db->query($sql)->row_array();
			
			if(is_array($result) && !empty($result)){				
				
				$data['track'] = 'Yes';
				
				$data['order_received_date'] 	= $result['order_received_date'];
				$data['order_status'] 				= $result['order_status'];
				
				if($result['tracking_code']!='')$data['tracking_code']				= $result['tracking_code'];
				else $data['tracking_code']				= 'Pending';
				if($result['tracking_text']!= '') $data['tracking_text'] 				= $result['tracking_text'];
				else $data['tracking_text'] = 'No Details Found';
				
				if($result['courier_company_id']!=''){
					$comp_name = $this->db->query("SELECT company_name FROM tbl_courier_company WHERE status = '1' AND company_id = '".$result['courier_company_id']."'")->row_array();
					if(is_array($comp_name) && !empty($comp_name)){
						if($comp_name['company_name']!='')$data['company_name'] 				= $comp_name['company_name'];
					}
					else $data['company_name'] = 'No Assigned';
				}
				else{
					$data['company_name'] = 'No Assigned';
				}
			}
			else{
				$data['track'] = 'No';
			}
		}
				
		$data['heading_title'] = "Thanks";			
		$this->load->view('pages/order_tracking',$data);	
	}
	
	public function page_not_found() { 
		$this->meta_info['meta_title']='404 page not found'; 
		$this->load->view('pages/view_404');//loading in my template 
	} 

	
	private function subscribe_newsletter($posted_data)
	{
		$query = $this->db->query("SELECT subscriber_email,status FROM  tbl_newsletters WHERE subscriber_email='$posted_data[subscriber_email]'");
		$subscribe_me  = $posted_data['subscribe_me'];
		
		if( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			if( $row['status']=='0' && ($subscribe_me=='Y') )
			{
				$where = "subscriber_email = '".$row['subscriber_email']."'";
				$this->pages_model->safe_update('tbl_newsletters',array('status'=>'1'),$where,FALSE);
				$msg =  $this->config->item('newsletter_subscribed');
				return $msg;
			}else if($row['status']=='0' && ($subscribe_me=='N'))
			{
				$msg =  $this->config->item('newsletter_not_subscribe');
				return $msg;
			}else if($row['status']=='1' && ($subscribe_me=='Y'))
			{
				$msg =  $this->config->item('newsletter_already_subscribed');
				return $msg;
			}else if($row['status']=='1' && ($subscribe_me=='N'))
			{
				$where = "subscriber_email = '".$row['subscriber_email']."'";
				$this->pages_model->safe_update('tbl_newsletters',array('status'=>'0'),$where,FALSE);
				$msg =  $this->config->item('newsletter_unsubscribed');
			  return $msg;
		  }
	  }else
	  {
		  if($subscribe_me=='N' )
		  {
			  $msg =  $this->config->item('newsletter_not_subscribe');
			  return $msg;
		  }else
		  {
			  $data =  array('status'=>'1', 'subscriber_name'=>$posted_data['subscriber_name'], 'subscriber_email'=>$posted_data['subscriber_email']);
			  $this->pages_model->safe_insert('tbl_newsletters',$data);
				$msg =  $this->config->item('newsletter_subscribed');
				return $msg;
			}
		}
	}
	
	public function newsletter()
	{
		$data['default_email_text']= "Email Id";
		$this->form_validation->set_rules('subscriber_name','Name','trim|required|max_length[225]');
		$this->form_validation->set_rules('subscriber_email','Email','trim|required|valid_email|max_length[255]');
		$this->form_validation->set_rules('subscribe_me','Status','trim|required');
		$this->form_validation->set_rules('verification_code','Verification Code','trim|required|valid_captcha_code');
		if($this->form_validation->run()==TRUE)
		{
			$res = $this->pages_model->add_newsletter_member();
			$this->session->set_userdata('msg_type',$res['error_type']);
			$this->session->set_flashdata($res['error_type'],$res['error_msg']);
			redirect('pages/newsletter', '');
		}
		$this->load->view('view_subscribe_newsletter',$data);
	}
	
	public function join_newsletter(){
		$subscriber_name	      = $this->input->post('newsletter_name',TRUE);
		$subscriber_email       = $this->input->post('newsletter_email',TRUE);
				 
		$this->form_validation->set_rules('newsletter_name', 'Name', "trim|required|alpha|max_lenght[200]");
		$this->form_validation->set_rules('newsletter_email', 'Email ID', "trim|required|valid_email|max_lenght[80]");
		$this->form_validation->set_rules('newsletter_captcha','Verification code','trim|required|valid_captcha_code');
		
		if ($this->form_validation->run() == TRUE){
			$subscribe_me  =  $this->input->post('subscribe_me',TRUE);
			
			$posted_data = array('subscriber_name'=>$subscriber_name, 'subscriber_email'=>$subscriber_email, 'subscribe_me'=>$subscribe_me );					
			$result      =  $this->subscribe_newsletter($posted_data);
			if( $result ){
				//echo '<div style="color:#009900">'.$result.'</div>';
				$res = array('error_type'=>'sucess','error_msg'=>'<div style="color:#009900">'.$result.'</div>');
			}
		}
		else{
			//echo '<p style="color:#009900">'.validation_errors().'</p>';
				$res = array('error_type'=>'error','error_msg'=>validation_errors());
		}	
		
		echo json_encode($res);
		exit;		 
	}		
}
/* End of file pages.php */