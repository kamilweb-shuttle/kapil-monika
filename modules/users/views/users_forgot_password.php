<?php $this->load->view("top_application");?>

  <div class="mob_hider"></div>
  <!-- HEADER ENDS -->
  <div class="breadcrumbs mob_hider">
    <div class="wrapper">
      <p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b><strong>Forgot Password!</strong></p>
    </div>
  </div>
  <!--  MIDDLE STARTS -->
  <section class="wrapper cms_area">
    <div class="p10 pt30">
      <h1 class="bb2 pb3">Forgot Password!</h1>
      <?php 
      //echo validation_message(); 
      echo form_open('','name="forgot_frm" id="forgotFrm"');
      echo error_message();
      ?> 
        <div class="short_form">
          <h3 class="bb pb2 mb20">Password will be sent to your email ID</h3>
          <fieldset class="pb15" style="border:0;">
            <p class="w36 pt8">
              <label for="email"> Enter  Email ID <b class="red">*</b> </label>
            </p>
            <div class="w62">
             <input name="email" value="" autocomplete="off" id="email" type="text" placeholder="Email ID *" />
             <?php echo form_error('email');?>
            </div>
            <div class="cb pb7"></div>
            <div class="w62">
              <p class="mb10">
                <input name="verification_code" id="verification_code" value="" type="text" placeholder="Word Verification *">
              </p>
              <img src="<?php echo site_url('captcha/normal'); ?>/forgot_pass" alt="captchaimage" id="captchaimage" class="vam"> <img src="<?php echo theme_url(); ?>images/ref.png" onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/forgot_pass/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();" alt="" class="vam">
              <?php echo form_error('verification_code');?>
            </div>
            <div class="cb pb7"></div>
          </fieldset>
          <p class="w62">
            <input name="submit" type="submit" value="Submit" class="btn2 radius-3" />
            <input type="hidden" name="forgotme" value="post" />
          </p>
          <div class="cb"></div>
        </div>
        <br>
      <?php echo form_close();?>  
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