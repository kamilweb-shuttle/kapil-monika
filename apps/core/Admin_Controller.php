<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Controller extends MY_Controller
{
	
	public function __construct(){
		parent::__construct();			
		$this->load->library(array('sitepanel/jquery_pagination'));		
		$this->load->model(array('utils_model'));	
		$this->admin_lib->is_admin_logged_in(); 
	}
	
	public function update_status($table,$auto_field='id'){
		$action               = $this->input->post('status_action',TRUE);	
		$arr_ids              = $this->input->post('arr_ids',TRUE);
		$category_count       = $this->input->post('category_count',TRUE);
		$product_count        = $this->input->post('product_count',TRUE);	
		$gallery_count        = $this->input->post('gallery_count',TRUE);
		$controller					 	= $this->router->fetch_class(); 
		
		if( is_array($arr_ids) ){
			
			$str_ids = implode(',', $arr_ids);
			if($action=='Activate'){
				foreach($arr_ids as $k=>$v ){
					$total_category  = ( $category_count!='' )?count_category("AND parent_id='$v' AND status='0'"): '0';
					$total_product   = ( $product_count!='' )?count_products("AND category_id='$v' AND status='0'"): '0';
					$total_gallery   = ( $gallery_count!='' )?count_gallery("AND parent_id='$v' AND status='0'"): '0';
					
					if( $total_category>0 || $total_product > 0 || $total_gallery > 0){
						$this->session->set_userdata(array('msg_type'=>'error'));
						$this->session->set_flashdata('error',lang('child_to_activate'));
					}
					else{
						$data = array('status'=>'1');
						$where = "$auto_field ='$v'";					
						$this->utils_model->safe_update($table,$data,$where,FALSE);
						//echo_sql();								
						$this->session->set_userdata(array('msg_type'=>'success'));
						$this->session->set_flashdata('success',lang('activate') );
					}
				}	
			}
			if($action=='Deactivate'){
				foreach($arr_ids as $k=>$v ){
					
					if($controller == 'color'){
						$total_category = count_record ('wl_products',"FIND_IN_SET (".$v.", color_ids) AND status !='0'");
						$total_product = $total_gallery = $total_category;
					}
					elseif($controller == 'size'){
						$total_category = count_record ('wl_products',"FIND_IN_SET (".$v.", size_ids) AND status !='0'");
						$total_product = $total_gallery = $total_category;
					}
					else{
						$total_category  = ( $category_count!='' )?count_category("AND parent_id='$v' AND status='1'"):'0';
		   			$total_product   = ( $product_count!='' )?count_products("AND category_id='$v' AND status='1'"):'0';
						$total_gallery   = ( $gallery_count!='' )?count_gallery("AND parent_id='$v' AND status='1'"):'0';
					}
					
					if( $total_category>0 || $total_product > 0 || $total_gallery > 0){
						$this->session->set_userdata(array('msg_type'=>'error'));
						$this->session->set_flashdata('error',lang('child_to_deactivate'));
					}
					else{
						$data = array('status'=>'0');
						$where = "$auto_field ='$v'";					
						$this->utils_model->safe_update($table,$data,$where,FALSE);
						$this->session->set_userdata(array('msg_type'=>'success'));
						$this->session->set_flashdata('success',lang('deactivate') );
					}
				}	
			}
			if($action=='Delete'){
				foreach($arr_ids as $k=>$v ){
					if($controller == 'color'){
						$total_category = count_record ('wl_products',"FIND_IN_SET (".$v.", color_ids) AND status !='2'");
						$total_product = $total_gallery = $total_category;
					}
					elseif($controller == 'size'){
						$total_category = count_record ('wl_products',"FIND_IN_SET (".$v.", size_ids) AND status !='0'");
						$total_product = $total_gallery = $total_category;
					}
					else{
						$total_category  = ( $category_count!='' ) ?  count_category("AND parent_id='$v' ")     : '0';
						$total_product   = ( $product_count!='' )  ?  count_products("AND category_id='$v' ")   : '0';
						$total_gallery   = ( $gallery_count!='' )  ?  count_gallery("AND parent_id='$v' ")   : '0';
					}
					if( $total_category>0 || $total_product > 0  || $total_gallery > 0){
						$this->session->set_userdata(array('msg_type'=>'error'));
						$this->session->set_flashdata('error',lang('child_to_delete'));
					}
					else{
						$where = array($auto_field=>$v);
						$this->utils_model->safe_delete($table,$where,TRUE);
						$this->session->set_userdata(array('msg_type'=>'success'));
						$this->session->set_flashdata('success',lang('deleted') );
					}						  
				}	
			}			
			
			if($action=='Tempdelete'){
				
				$data = array('status'=>'2');
				$where = "$auto_field IN ($str_ids)";
				$this->utils_model->safe_update($table,$data,$where,FALSE);
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',lang('deleted'));	
			}				 			
		}
		redirect($_SERVER['HTTP_REFERER'], '');
	}
	
	
	public function set_as($table,$auto_field='id',$data=array()){
		$arr_ids               = $this->input->post('arr_ids',TRUE);
		if( is_array($arr_ids ) ){
			$str_ids = implode(',', $arr_ids);
			if( is_array($data) && !empty($data) ){
				$data = $data;
				$where = "$auto_field IN ($str_ids)";
				$this->utils_model->safe_update($table,$data,$where,FALSE);
				
				$current_controller    = $this->router->fetch_class();
				if($current_controller=="orders" && $this->input->post("ord_status")!="" && ($this->input->post("ord_status")!="Pending" && $this->input->post("ord_status")!="Closed")){
					$this->load->library("dmailer");
					$mail_subject =$this->config->item('site_name')." Order overview";
				  $from_email   = $this->admin_info->admin_email;
				  $from_name    = $this->config->item('site_name');
				  foreach($arr_ids as $key=>$val){
						$order=get_db_single_row("wl_order", '*', " order_id = ".$val);
						$courier_details="";
					  if($this->input->post("ord_status")=="Dispatched"){
						  if($order['courier_company_name']!=""){
							  $courier_details.="<br/>Courier Company Name: ".$order['courier_company_name'];
						  }
						  if($order['bill_number']!=""){
							  $courier_details.="<br/>Airway Bill Number: ".$order['bill_number'];
						  }
					  }
						$mail_to      = $order["email"];
						$body         = "Dear ".ucwords($order["first_name"]." ".$order["last_name"]);
						$body 					.=",<br /><br />";
						$body 					.="This is to notify you that your order is ".$this->input->post("ord_status")."  successfully .<br /><br />Here are the details<br /> Order Number: $order[invoice_number] <br/>".$this->input->post("ord_status")." Date/Time: ".date("d-m-Y h:i:s").$courier_details."<br /><br />Regards,<br />Customer Support Team<br />".$this->config->item('site_name');
						$mail_conf =  array(
						'subject'=>$this->config->item('site_name')." Order ".$this->input->post("ord_status"),
						'to_email'=>$mail_to,
						'from_email'=>$from_email,
						'from_name'=> $this->config->item('site_name'),
						'body_part'=>$body );
						//trace($mail_conf);
						//exit;
						$this->dmailer->mail_notify($mail_conf);
					}
				}
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',"Record has been updated/deleted successfully.");			
			}	
			
			redirect($_SERVER['HTTP_REFERER'], '');
		}
	}
	
	/*
	$tblname = name of table 
	$fldname = order column name  of table 
	$fld_id  =  auto increment column name of table
	*/	
	
	public function update_displayOrder($tblname,$fldname,$fld_id){
		$posted_order_data=$this->input->post('ord');
		while(list($key,$val)=each($posted_order_data)){
			if( $val!='' ){
				$val = (int) $val;
				$data = array($fldname=>$val);
				$where = "$fld_id=$key";
				$this->utils_model->safe_update($tblname,$data,$where,TRUE);			
			}
		}
		$this->session->set_userdata(array('msg_type'=>'success'));
		$this->session->set_flashdata('success',lang('order_updated'));		
		redirect($_SERVER['HTTP_REFERER'], '');
	}
}