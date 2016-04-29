<?php $this->load->view("top_application");?>
  <div class="mob_hider"></div>
  <div class="breadcrumbs mob_hider">
    <div class="wrapper">
      <p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b><strong>Register</strong></p>
    </div>
  </div>
  <section class="wrapper" style="min-height:450px">
    <div class="inner_wrapper pt50">
      <div class="login_box" style="background:none">
        <p class="login_link"><a href="<?php echo base_url(); ?>login">Login</a> <a href="javascript:void(0)" class="act">Register </a></p>
        
        <?php echo form_open('','name="login_frm" id="logRegisFrm"'); ?>
          <div class="login_box1 fs13">
            <p>
              <label for="email">Email ID : <b class="red">*</b> </label>
            </p>
            <p class="mt3">
              <input name="username" id="username" type="text" class="p7 w90" value="<?php echo set_value('username');?>" />
              <?php echo form_error('username');?>
            </p>
            <p class="mt10">
              <label for="password">Password : <b class="red">*</b></label>
            </p>
            <p class="mt3">
              <input name="password" id="password" type="password" class="p7 w90" />
              <?php echo form_error('password');?>
            </p>
            <p class="mt10">
              <label for="confirm_password">Confirm Password : <b class="red">*</b></label>
            </p>
            <p class="mt3">
              <input name="confirm_password" id="confirm_password" type="password" class="p7 w90" />
              <?php echo form_error('confirm_password');?>
            </p>
            <p class="mt10">
              <label for="name">Name : <b class="red">*</b></label>
            </p>
            <p class="mt3">
              <input name="first_name" id="first_name" type="text" class="p7 w90" value="<?php echo set_value('first_name');?>" />
              <?php echo form_error('first_name');?>
            </p>
            <p class="mt10">
              <label for="mobile">Mobile No. : <b class="red">*</b></label>
            </p>
            <p class="mt3">
              <input name="mobile_number" id="mobile_number" type="text" class="p7 w90" value="<?php echo set_value('mobile_number');?>" />
              <?php echo form_error('mobile_number');?>
            </p>
            <p class="mt10 mb25">
              <input name="terms" id="terms" type="checkbox" value="Y" checked="checked" class="fl mr5 mt3" />
              I have read and agreed to the <a href="<?php echo base_url(); ?>terms-conditions" target="_blank" class="uu">Terms &amp; Conditioins!</a>
              <?php echo form_error('terms');?>
              </p>
            <p>
              <input name="submit" type="submit" class="btn1 shadow1" value="Create My Account!" />
            </p>
          </div>
        <?php echo form_close(); ?>  
        
        <div class="login_box2 login_box2_line fs13 pb25">
          <p class="oswald fs20">Benefits of Registration</p>
          <?=$page_content['page_description'];?>
          <p class="mt35 b"><a href="<?php echo base_url(); ?>login" class="btn3 shadow1">Have a TelePoint Account?</a></p>
        </div>
        <div class="cb bb"></div>
      </div>
    </div>
  </section>
	<br>
	<br>
	<!-- MIDDLE ENDS -->
  <section class="wrapper pt15  bt1 mid_banner_cont">
    <?php 
		$cond = array();
		$cond['position'] = "Bottom Banner";
		banner_display($cond,330,182,'mid_banner', '<div class="mid_banner">', '</div>', "3");
		?>
    <div class="cb"></div>
  </section>
<?php $this->load->view("bottom_application");?>