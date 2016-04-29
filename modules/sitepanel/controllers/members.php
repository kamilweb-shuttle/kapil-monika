<?php
class Members extends Admin_Controller 
{
  public function __construct() 
  {
    parent::__construct();
    $this->load->model(array('members/members_model'));
    $this->load->library(array('safe_encrypt'));
    $this->config->set_item('menu_highlight','members management');	
  }
  
  public  function index()
  {
        $condtion               = array();	

        $pagesize               =  (int) $this->input->get_post('pagesize');

        $config['limit']	=  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');

        $offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	

        $base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));		

        $status			=   $this->input->get_post('status',TRUE);

        if($status!='')
        {
                $condtion['status']   = $status;
        }

        $res_array              = $this->members_model->get_members($config['limit'],$offset,$condtion);		//echo_sql();
        $total_record           = get_found_rows();			
        $data['page_links']     =  admin_pagination($base_url,$total_record,$config['limit'],$offset);
        $data['heading_title']  = 'Manage Members';
        $data['pagelist']       = $res_array; 	
        $data['total_rec']      = $total_record  ;

        if( $this->input->post('status_action')!='')
        {			
                $this->update_status('wl_customers','customers_id');			
        }
        //trace($this->input->post());
        $this->load->view('member/member_list_view',$data); 	

    }
	
	
	public function details()
	{
		
		$customers_id   = (int) $this->uri->segment(4);
		$mres           = $this->members_model->get_member_row($customers_id);		
		$res_bill       = $this->members_model->get_member_address_book($customers_id,'Bill');	
		$res_ship       = $this->members_model->get_member_address_book($customers_id,'Ship');
		
		$data['heading_title']  = 'Members Details';
		$data['res_bill']  = $res_bill[0];
		$data['res_ship']  = $res_ship[0];
		$data['mres']      = $mres;		
		$this->load->view('member/view_member_detail',$data); 
		
	}
	
	
	public function ip_details(){		
		$customers_id   = (int) $this->uri->segment(4);
		$mres = $this->db->query("select * from wl_ip_details where member_id = '".$customers_id."' ")->result_array();				
		$data['heading_title']  = 'Members Login Details';
		$data['mres']      = $mres;		
		$this->load->view('member/view_member_ip_detail',$data); 		
	}
  
	public  function support_ticket($page = NULL)
    {
		
      $post_per_page =  $this->input->post('per_page');
	
    if($post_per_page!='')
    {
      $post_per_page=applyFilter('NUMERIC_GT_ZERO',$post_per_page);
      if($post_per_page>0)
      {
        $config['per_page']		 = $post_per_page;
      }
      else
      {
        $config['per_page']		 = $this->config->item('per_page');
      }
    }
    else
    {
      $config['per_page']		     = $this->config->item('per_page');
    }
    
		$offset                 = $this->uri->segment(4,0);
		$res_array              = $this->members_model->get_support_ticket($offset,$config['per_page']);			
		$total_record           = get_found_rows();	
		
		if($this->input->post('delete_ticket')!='' && $this->input->post('delete_ticket')=='Delete')
		{
			   $arr_ids = $this->input->post('arr_ids');
			   $str_ids = implode(',', $arr_ids);
			   $where = "id IN( $str_ids)";
			   $this->members_model->delete_in('tbl_ticket_support',$where,FALSE);
		}
		
		
		$data['page_links']     = admin_pagination("members/support_ticket/pages/",$total_record,$config['per_page']);		
		$data['heading_title']  = 'Manage Support Ticket';
		$data['pagelist']       = $res_array; 	
		$data['total_rec'] = $total_record  ;
		$this->load->view('member/support_ticket_view',$data); 	
				
	}
	
	
	public function ticket_reply()
	{
		$rid =  $this->uri->segment(4);
		$res_data =  $this->db->get_where('tbl_ticket_support', array('id' =>$rid))->row();
	
		if( is_object( $res_data ) )
		{ 
			$this->form_validation->set_rules('subject', 'Subject', 'required|xss_clean');	
			$this->form_validation->set_rules('message', 'Message', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
			{
				$data['heading_title'] = "Send Reply";
				$data['res'] = $res_data;
				$this->load->view('member/support_ticket_reply_view',$data);
				
			}else
			{
				/* Reply  mail to user */
				
				$admin_email  = get_site_email();				
				$mail_to      = $res_data->email;
				$mail_subject = $this->input->post('subject'); 				
				$from_email   = $admin_email->admin_email;
				$from_name    =  $this->config->item('site_name');				
				$body = "Dear ".$res_data->name.",<br /><br />";						
				$body .= $this->input->post('message');				
				$body .= "<br /> <br />						   
									Thanks and Regards,<br />						   
									".$this->config->item('site_name')." Team ";		
							
				$this->email->from($from_email, $from_name);
				$this->email->to($mail_to);			
				$this->email->subject($mail_subject);				
				$this->email->message($body);
				$this->email->set_mailtype('html');
				$this->email->send();
				
				$this->db->where('id', $res_data->id);
				$this->db->update('tbl_ticket_support',array('replyed'=>'Y'));
				
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',lang('admin_mail_msg'));
					
					
				redirect('sitepanel/members/ticket_reply/'.$res_data->id, '');
				
				/* End reply mail to user */		
			}
		}
	}	
	
	
	
	
}
// End of controller