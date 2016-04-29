<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setting_model extends MY_Model{

   public function __construct()
   {
   
     parent::__construct();
     
    }

	public function get_admin_info($id){
		
		$id = (int) $id;
		
		if($id!='' && is_numeric($id)){
			
		    $condtion = "admin_id = $id";			
			$fetch_config = array(
							  'condition'=>$condtion,							 					 
							  'debug'=>FALSE,
							  'return_type'=>"object"							  
							  );
			
			$result = $this->find('tbl_admin',$fetch_config);
			return $result;	
			
		}
		
	}
	
	
	
	public function update_info($old_pass,$id){
		
		 $cond = "admin_id =$id AND admin_password ='$old_pass' ";
		 $num_row = $this->findCount('tbl_admin',$cond);		
		
		if( $num_row > 0 ) { 
		
			$data     = array('admin_password'=>$this->input->post('new_pass'),
							  'admin_email'=>$this->input->post('admin_email'),
							   'address'=>$this->input->post('address'),
							 );	
			
			$where = "admin_id=".$id." ";
			$this->safe_update('tbl_admin',$data,$where,FALSE);		
			
			$this->load->library('email');
			$res_data =  $this->db->get_where('tbl_admin', array('admin_email' =>$this->input->post('admin_email',TRUE),'admin_id'=>'1' ))->row();
		
						if( is_object( $res_data ) )
						{ 
							/* Forgot  mail to user */			
							
							$mail_to      = $res_data->admin_email;
							$mail_subject = $this->config->item('site_name')." Change Password"; 
							$from_email   = $mail_to;
							$from_name    =  $this->config->item('site_name');
							$verify_url= "<a href=".base_url()."sitepanel/>Click here </a>";
							
							$body = " Dear Admin,<br />
							Your login details are as follows:<br />
							User name :  {username}<br />        
							Password:  {password}<br /> 
							Click here to login {link}<br />  <br />						   
							Thanks and Regards,<br />						   
							{site_name} Team  ";
							
							$body			=	str_replace('{username}',$res_data->admin_username,$body);
							$body			=	str_replace('{password}',$res_data->admin_password,$body);
							$body			=	str_replace('{site_name}',$this->config->item('site_name'),$body);
							$body			=	str_replace('{url}',base_url(),$body);
							$body           =	str_replace('{link}',$verify_url,$body);
									
							$this->email->from($from_email, $from_name);
							$this->email->to($mail_to);			
							$this->email->subject($mail_subject);				
							$this->email->message($body);
							$this->email->set_mailtype('html');
							$this->email->send();
							
							/* End Forgot mail to user */
						}
			
			
			$this->session->set_userdata('msg_type',"success" ); 
			$this->session->set_flashdata('success',lang('successupdate') ); 
		   
		
		 }else{			
			
		   $this->session->set_userdata(array('msg_type'=>'error'));
		   $this->session->set_flashdata('error',lang('password_incorrect'));		
			
		 }	
		 
	
	}
	
	
	
	

}
// model end here