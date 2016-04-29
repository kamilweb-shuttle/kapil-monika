<?php 
$this->load->view("top_application");
$values_posted_back=(is_array($this->input->post())) ? TRUE : FALSE; 
$is_same = $values_posted_back === TRUE ? $this->input->post('is_same') : ''; 
?>
  <section class="wrapper">
    <div class="inner_wrapper pt40">
      <div class="checkout_container">
        <div class="box1 fl">
          <div class="border2x">
            <p class="bg-green p10 white fs16 b">1. Email ID / Login!</p>
            <div class="shadow3" style="min-height:320px">
            	<?php 
							echo form_open('cart/checkout'); 
							echo error_message();
							?>
								<div class="check_login_l">
									<p class="b fs14">Enter Your Email Address</p>
									<div class="mt10">
										<input name="email" id="email" autocomplete="off" value="<?=get_cookie('userName')!="" ? get_cookie('userName'):set_value('email');?>" type="text" class="p7 w95">
                    <?php echo form_error('email');?>
									</div>

									<p class="b mt15 fs13">
										<input name="checkout_type" type="radio" value="Guest" class="mt2 fl mr7" checked onClick="$('.password_cont').slideUp('fast')">
										Continue as guest</p>
									<p class="fs11 ml20">(No password or registration required)</p>
									<p class="b mt15 fs13">
										<input name="checkout_type" id="checkout_type_user" type="radio" value="User" class="mt2 fl mr7" onClick="$('.password_cont').slideDown('fast')">
										I have a Telepoint account and password</p>
									<p class="fs11 ml20">(Sigh in to your account for a faster checkout)</p>
									<div class="password_cont dn">
										<p class="mt15 b">
											<label for="password">Password :</label>
										</p>
										<div class="mt3">
											<input name="password" id="password" type="password" value="<?=get_cookie('pwd')!="" ? get_cookie('pwd'):'';?>" class="p7 w95">
                      <?php echo form_error('password');?>
										</div>
										<p class="red mt10 fr fs12"><a href="<?=base_url();?>users/forgotten_password" class="uu">Password Password?</a></p>
										<p class="mt10 fs12">
											<label>
												<input type="checkbox" name="remember" id="remember" value="Y" class="fl mr5 mt3">
												Remember Me!</label>
										</p>
									</div>
									<p class="mt15">
										<input name="action" type="submit" class="btn2 shadow1 radius-3" value="Continue &gt;" />
									</p>
								</div>
              <?php echo form_close(); ?>  
              <img src="<?php echo theme_url(); ?>images/or.png" width="55" height="210" class="fl mt50 ml20 mob_hider" alt="">
              <div class="check_login_r">
                <p class="mt3 mb14">
                	<a href="javascript:void(0);" onclick="openLoginDialog('?action=login&type=facebook')"><img src="<?php echo theme_url(); ?>images/l_face.png" alt="" width="200" height="30" class="db shadow1"></a></p>
                <p><a href="javascript:void(0);" onclick="openLoginDialog('?action=login&type=google')"><img src="<?php echo theme_url(); ?>images/l_google.png" alt="" width="200" height="30" class="db shadow1"></a></p>
              </div>
              <div class="cb pb25"></div>
            </div>
          </div>
          <!-- slide 1 -->
          <div class="border2 mt10">
            <p class="bg-gray p10 black fs16 b">2. Delivery Information</p>
          </div>
          <!-- slide 2 -->
          <div class="border2 mt10">
            <p class="bg-gray p10 black fs16 b">3. Make Payment</p>
          </div>
          <!-- slide 2 --> 
        </div>
        <!-- left ends -->
        <?php $this->load->view('view_cart_right');?>
        <!-- right ends -->
        <div class="cb"></div>
      </div>
      <br>
    </div>
  </section>
	<?php 
	if($this->input->post('checkout_type') == 'User'){
		?>
    <script type="text/javascript" language="javascript">
      jQuery('#checkout_type_user').trigger('click');
    </script>
		<?php
  }
$this->load->view("bottom_application");?>