<?php

class Users extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('date', 'language', 'cookie', 'file'));
        $this->load->model(array('users/users_model', 'pages/pages_model'));
        $this->load->library(array('safe_encrypt', 'securimage_library', 'Auth', 'Dmailer','mailer', 'cart'));
        $this->form_validation->set_error_delimiters("<div class='required'>", "</div>");

        $rf_session = $this->session->userdata('ref');
        if ($rf_session == '' && $this->input->get('ref') != "") {
            $this->session->set_userdata(array('ref' => $this->input->get('ref')));
        }
    }

    public function index() {
       
        if ($this->auth->is_user_logged_in()) {
            redirect('members/', '');
        }
        //$condition       = array('friendly_url'=>'login','status'=>'1');			 
        //$content         = $this->pages_model->get_cms_page( $condition );				 
        //$data['page_content'] = $content;	
        $data['heading_title'] = "Login";
        $data['unq_section'] = "Login";
        $this->load->view('users_register', $data);
    }

    public function forgotten_password() {
        
        if ($this->input->post('forgotme') != "") {
            $email = $this->input->post('email', TRUE);
            $this->form_validation->set_rules('email', ' Email ID', 'required|valid_email');
            $this->form_validation->set_rules('verification_code', 'Verification code', 'trim|required|valid_captcha_code[forgot_pass]');
            if ($this->form_validation->run() == TRUE) {
               
                $condtion = array('field' => "user_name,password,first_name,last_name", 'condition' => "user_name ='" . $email . "' AND status ='1' ");
                $res = $this->users_model->find('wl_customers', $condtion);
               
                if (is_array($res) && !empty($res)) {
                      
                    $first_name = $res['first_name'];
                    //$last_name   = $res['last_name'];	
                    $username = $res['user_name'];
                    $password = $res['password'];
                    $password = $this->safe_encrypt->decode($password);
                    /* Send  mail to user */

                    $content = get_content('wl_auto_respond_mails', '2');
                    $subject = $content->email_subject;
                    $body = $content->email_content;

                     $verify_url = "<a href=" . base_url() . "users/register>Click here </a>";
               
                    $name = $first_name;
                    $body = str_replace('{mem_name}', $name, $body);
                    $body = str_replace('{username}', $username, $body);
                    $body = str_replace('{password}', $password, $body);
                    $body = str_replace('{admin_email}', $this->admin_info->admin_email, $body);
                    $body = str_replace('{site_name}', $this->config->item('site_name'), $body);
                    $body = str_replace('{url}', base_url(), $body);
                    $body = str_replace('{link}', $verify_url, $body);

                    $mail_conf = array(
                        'subject' => $subject,
                        'to_email' => $username,
                        'from_email' => $this->admin_info->admin_email,
                        'from_name' => $this->config->item('site_name'),
                        'body_part' => $body
                    );
                    
                    //$this->dmailer->mail_notify($mail_conf);
                    echo $this->mailer->sending_mail($mail_conf);die;
                    $this->session->set_userdata(array('msg_type' => 'success'));
                    $this->session->set_flashdata('success', $this->config->item('forgot_password_success'));
                    redirect('forgotten_password', '');
                } else {
                    $this->session->set_userdata(array('msg_type' => 'error'));
                    $this->session->set_flashdata('error', $this->config->item('email_not_exist'));
                    redirect('forgotten_password', '');
                }
            }
        }
        $data['heading_title'] = "Forgot Password";
        $this->load->view('users_forgot_password', $data);
    }

    public function direct_login() {
        if (!$this->auth->is_user_logged_in()) {
            //$this->form_validation->set_rules('login_username', 'Username','trim|required|valid_email');
            //$this->form_validation->set_rules('login_password', 'Password', 'trim|required|');			
            //$this->form_validation->set_rules('user', 'User', 'trim');
            //if ($this->form_validation->run() == TRUE){
            $username = $this->input->get_post('username');
            $password = $this->safe_encrypt->decode($this->input->get_post('mypass'));

            $this->auth->verify_user($username, $password);
            if ($this->auth->is_user_logged_in()) {

                $ref = $this->session->userdata('ref');
                $this->session->unset_userdata(array('ref' => 0));
                if ($ref != "") {
                    redirect($ref, '');
                } else {
                    redirect('members/myaccount', '');
                }
            } else {
                $this->session->set_flashdata('error', $this->config->item('login_failed'));
                redirect('login', '');
            }
            //}
            //$condition       = array('friendly_url'=>'login','status'=>'1');			 
            //$content         = $this->pages_model->get_cms_page( $condition );				 
            //$data['page_content'] = $content;	
            $data['heading_title'] = "Login";
            $this->load->view('users_login', $data);
        } else {
            redirect('members/myaccount', 'refresh');
        }
    }

    public function login() {
        if (!$this->auth->is_user_logged_in()) {
            $this->form_validation->set_rules('login_email', 'Email ID', 'trim|required|valid_email');
            $this->form_validation->set_rules('login_password', 'Password', 'trim|required|');
            //$this->form_validation->set_rules('user', 'User', 'trim');
            if ($this->form_validation->run() == TRUE) {
                $username = $this->input->post('login_email');
                $password = $this->input->post('login_password');
                $rember = ($this->input->post('remember') != "") ? TRUE : FALSE;
                if ($this->input->post('remember') == "Y") {
                    set_cookie('userName', $this->input->post('login_email'), time() + 60 * 60 * 24 * 30);
                    set_cookie('pwd', $this->input->post('login_password'), time() + 60 * 60 * 24 * 30);
                } else {
                    delete_cookie('userName');
                    delete_cookie('pwd');
                }
                $this->auth->verify_user($username, $password);
                if ($this->auth->is_user_logged_in()) {

                    /* Saving Login Ip Address */
                    $ip_array = array(
                        'member_id' => $this->session->userdata('user_id'),
                        'ip_address' => $_SERVER['REMOTE_ADDR'],
                    );
                    $insId = $this->users_model->safe_insert('wl_ip_details', $ip_array, FALSE);
                    /* End Here */

                    $ref = $this->session->userdata('ref');
                    $this->session->unset_userdata(array('ref' => 0));
                    if ($ref != "") {
                        
                       // redirect($ref, '');
                        echo 2;die;
                    } else {
                        //redirect('members/myaccount', '');
                        
                        echo 2;die;
                    }
                } else {
                    echo 3;die;
                   // $this->session->set_userdata(array('msg_type' => 'error'));
                   // $this->session->set_flashdata('error', $this->config->item('login_failed'));
                   // redirect('login', '');
                }
            }else{
                echo validation_errors();die;
            }
            //$condition       = array('friendly_url'=>'login','status'=>'1');			 
            //$content         = $this->pages_model->get_cms_page( $condition );				 
            //$data['page_content'] = $content;	
            $data['heading_title'] = "Login";
            $this->load->view('users_login', $data);
        } else {
            //redirect('members/myaccount', 'refresh');
            echo 4;
        }
    }

    public function logout() {
        $data2 = array(
            'shipping_id' => 0,
            'coupon_id' => 0,
            'discount_amount' => 0
        );
        $this->session->unset_userdata($data2);
        $this->session->unset_userdata(array("ref" => '0'));
        $this->cart->destroy();
        $this->auth->logout();
        
        //$this->session->set_userdata(array('msg_type'=>'success'));
        //$this->session->set_flashdata('success',$this->config->item('member_logout'));
       // redirect('login', '');
    }

    public function thanks() {
        $data['heading_title'] = "Thanks";
        $this->load->view('users_thanks', $data);
    }

    public function register() {
        
       if (!$this->auth->is_user_logged_in()) {
           
            //$is_same_bill_ship =   $this->input->post('is_same',TRUE);
            $this->form_validation->set_rules('email_address', 'Email ID', 'trim|required|valid_email|max_length[80]|callback_email_check');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[20]|valid_password');
            $this->form_validation->set_rules('c_password', 'Confirm passsword', 'required|matches[password]');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha|max_length[32]|xss_clean');
            $this->form_validation->set_rules('mobile_num', 'Mobile No', 'trim|required|numeric|max_length[10]|xss_clean');
            $this->form_validation->set_rules('terms', 'Terms & Conditions', 'required');
           
            if ($this->form_validation->run() == TRUE) {
                  //print_r($this->input->post());die;
                $registerId = $this->users_model->create_user();
                $first_name = $this->input->post('first_name', TRUE);
                //$last_name   = $this->input->post('last_name',TRUE);	
                $username = $this->input->post('email_address', TRUE);
                $password = $this->input->post('password', TRUE);
                if ($registerId != '') {
                    /* Send  mail to user */
                    $content = get_content('wl_auto_respond_mails', '1');
                    $subject = str_replace('{site_name}', $this->config->item('site_name'), $content->email_subject);
                    $body = $content->email_content;
                    $verify_url = "<a href=" . base_url() . "users/login>Click here </a>";
                    $name = " User ";
                    $body = str_replace('{mem_name}', $name, $body);
                    $body = str_replace('{username}', $username, $body);
                    $body = str_replace('{password}', $password, $body);
                    $body = str_replace('{admin_email}', $this->admin_info->admin_email, $body);
                    $body = str_replace('{site_name}', $this->config->item('site_name'), $body);
                    $body = str_replace('{url}', base_url(), $body);
                    $body = str_replace('{link}', $verify_url, $body);

                    $mail_conf = array(
                        'subject' => $subject,
                        'to_email' => $this->input->post('email_address'),
                        'from_email' => $this->admin_info->admin_email,
                        'from_name' => $this->config->item('site_name'),
                        'body_part' => $body
                    );
                    //$this->dmailer->mail_notify($mail_conf);
                      $this->mailer->sending_mail($mail_conf); 
                    /* End send  mail to user */
                    /* Send  mail to admin */
                    $subject = 'New member is registered';
                    $body = '<table border="0" style="width:100%">
				<tbody>
				<tr>
				<td colspan="2"><strong>Hi Admin,</strong></td>
				</tr>
				<tr>
				<td colspan="2">You have new member registered on {site_name} with the following details:</td>
				</tr>
				<tr>
				<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
				<td><strong>Email ID:</strong></td>
				<td>{username}</td>
				</tr>
				<tr>
				<td><strong>Password:</strong></td>
				<td>{password}</td>
                                </tr>
				<tr>
				<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
				<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
				<td colspan="2">Thank you.<br />
				{site_name} Customer Service<br />
				Email: {admin_email}</td>
				</tr>
				<tr>
				<td colspan="2" style="text-align:center">&copy; ' . date('Y') . ' {site_name}. All rights reserved.</td>
				</tr>
				</tbody>
                          </table>';


                    $body = str_replace('{username}', $username, $body);
                    $body = str_replace('{password}', $password, $body);
                    $body = str_replace('{admin_email}', $this->admin_info->admin_email, $body);
                    $body = str_replace('{site_name}', $this->config->item('site_name'), $body);
                    $body = str_replace('{url}', base_url(), $body);

                    $mail_conf = array(
                        'subject' => $subject,
                        'to_email' => $this->admin_info->admin_email,
                        'from_email' => $this->input->post('email_address'),
                        'from_name' => $this->config->item('site_name'),
                        'body_part' => $body
                    );

                    //$this->dmailer->mail_notify($mail_conf);
                      $this->mailer->sending_mail($mail_conf);
                    /* End send  mail to admin */
                }
                $this->auth->verify_user($username, $password);
                $message = $this->config->item('register_thanks');
                $message = str_replace('<site_name>', $this->config->item('site_name'), $message);
                // $this->session->set_userdata(array('msg_type'=>'success'));
                $this->session->set_flashdata('success', $message);
                $cart_items='';
                if ($cart_items != "" && $cart_items > 0) {
                    //redirect('cart', '');
                    echo 1;die;
                } else {
                   // redirect('members/myaccount', '');
                    echo 2;die;
                }
            }else{
               echo validation_errors();die;
            }

            $condition = array('friendly_url' => 'register', 'status' => '1');
            $content = $this->pages_model->get_cms_page($condition);
            $data['page_content'] = $content;
            $data['heading_title'] = "Register";
            $data['unq_section'] = "Register";
            $this->load->view('users_register', $data);
       } else {
           echo 2;die;
          // redirect('members/myaccount', 'refresh');
        }
    }

    public function email_check() {
        $email = $this->input->post('email_address');
        if ($this->users_model->is_email_exits(array('user_name' => $email))) {
            $this->form_validation->set_message('email_check', $this->config->item('exists_user_id'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function valid_captcha_code($verification_code) {
        if ($this->securimage_library->check($verification_code) == true) {
            return TRUE;
        } else {
            $this->form_validation->set_message('valid_captcha_code', 'The Word verification code you have entered is invalid.');
            return FALSE;
        }
    }

    public function verify() {
        $this->users_model->activate_account($this->uri->segment(3));
    }

}

/* End of file users.php */
/* Location: ./application/modules/users/controller/users.php */