<?php $this->load->view("top_application");?>
  <div class="mob_hider"></div>
  <!-- HEADER ENDS -->
  <div class="breadcrumbs mob_hider">
    <div class="wrapper">
      <p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b><strong>Login!</strong></p>
    </div>
  </div>
	<!--  MIDDLE STARTS -->
  <section class="wrapper" style="min-height:450px">
    <div class="inner_wrapper pt50">
    	<div class="login_box">
      	
        <p class="login_link"><a href="javascript:void(0)" class="act">Login</a> <a href="<?php echo base_url(); ?>register">Register </a></p>
        <?php 
        echo form_open('','name="login_frm" id="logRegisFrm"'); 
				//echo validation_message();  
        ?>
          <div class="login_box1 fs13">
          	<?php 
						if(error_message()){
							echo error_message();
						}
						?>
            <p>
              <label for="email">Email ID :</label>
            </p>
            <p class="mt3">
              <input autocomplete="off" name="login_username" id="login_username" type="text" class="p7 w90" value="<?=get_cookie('userName')!="" ? get_cookie('userName'):set_value('login_username');?>" />
              <?php echo form_error('login_username');?>
            </p>
            <p class="mt10">
              <label for="password">Password :</label>
            </p>
            <p class="mt3">
              <input name="login_password" id="login_password" type="password" class="p7 w90" value="<?=get_cookie('pwd')!="" ? get_cookie('pwd'):'';?>" />
              <?php echo form_error('login_password');?>
            </p>
            <p class="mt10 mb10">
              <label>
                <input name="remember" id="remember" type="checkbox" value="Y" class="fl mr5 mt3" />
                Remember Me!</label>
            </p>
            <p>
              <input name="submit" type="submit" class="btn1 shadow1" value="Login" />
            </p>
            <p class="red mt10"><a href="<?=base_url();?>users/forgotten_password" class="uu">Forgot Your Password?</a></p>
          </div>
        <?php echo form_close(); ?>
          
        <div class="login_box2 fs13">
          <p class="oswald fs20"><b class="login_or">OR,</b> You Can</p>
          <p class="mt20 mb14"><a href="javascript:void(0);" onclick="openLoginDialog('?action=login&type=facebook')"><img src="<?php echo theme_url(); ?>images/l_face.png" class="db shadow1" alt=""></a></p>
          <p><a href="javascript:void(0);" onclick="openLoginDialog('?action=login&type=google')"><img src="<?php echo theme_url(); ?>images/l_google.png" class="db shadow1" alt=""></a></p>
          <p class="red mt35 b red ttu"><a href="<?php echo base_url(); ?>register" class="uu">Create a New TelePoint Account&gt;&gt;</a></p>
        </div>
        <div class="cb"></div>
      </div>
    </div>
  </section>
	<section class="wrapper pt15  bt1 mid_banner_cont">
  <?php 
		$cond = array();
		$cond['position'] = "Bottom Banner";
		banner_display($cond,330,182,'mid_banner', '<div class="mid_banner">', '</div>', "3");
		?>
  <div class="cb"></div>
	</section>
<?php $this->load->view("bottom_application");?>