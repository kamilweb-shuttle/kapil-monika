<?php $this->load->view('top_application'); ?>
  <div class="mob_hider"></div>
  <!-- HEADER ENDS -->
  
  <div class="breadcrumbs mob_hider">
    <div class="wrapper">
      <p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b><strong>Contact Us</strong></p>
    </div>
  </div>

  <section class="wrapper" style="min-height:600px">
    <div class="p10 pt30">
      <h1>Contact Us</h1> 
      <div class="mt10 contact_box">
        <?php echo $content;?>
        <div class="cb"></div>
        
        <a id="feedback"></a>
        <div class="mt15 contact_form_cont">
          <h3>Still need help? <b class="fs16 red">Just Fill the Below Information:</b></h3>
          <?php echo form_open('contactus');?>	
            <fieldset class="contact_form" style="border:none;">
              <div class="mt5">
                <input type="text" name="name" id="name" value="<?php echo set_value('name');?>" placeholder="Full Name *">
                <?php echo form_error('name');?>
              </div>
              <div class="mt5">
                <input type="text" name="email" id="email" value="<?php echo set_value('email');?>" placeholder="Email *">
                <?php echo form_error('email');?>
              </div>
              <div class="mt5">
                <input type="text" name="phone_number" id="phone_number" value="<?php echo set_value('phone_number');?>" placeholder="Phone Number">
                <?php echo form_error('phone_number');?>
              </div>
              <div class="mt5">
                <input type="text" name="mobile_number" id="mobile_number" value="<?php echo set_value('mobile_number');?>" placeholder="Mobile Number *">
                <?php echo form_error('mobile_number');?>
              </div>
              <div class="mt5">
                <textarea name="description" id="description" cols="45" rows="5" placeholder="Comment/Messsage *"><?php echo set_value('description');?></textarea>
                <?php echo form_error('description');?>
              </div>
              <div class="mt5">
                <input name="verification_code" id="verification_code1" type="text" placeholder="Word Verification *" class="vam" style="width:120px">
                <img src="<?php echo site_url('captcha/normal');?>" id="captchaimage1" alt="" class="vam"> <img src="<?php echo theme_url(); ?>images/ref.png" alt="" class="vam" onclick="document.getElementById('captchaimage1').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code1').focus(); document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random();" /> 
                <?php echo form_error('verification_code');?>
                <p class="grey pt5 fs11">Type the characters shown above.</p>
              </div>
              <div class="mt10">
                <input name="submit" type="submit"  value="Submit" class="btn2 radius-3" />
                <input name="reset" type="reset" value="Reset" class="btn3 radius-3" />
              </div>
            </fieldset>
          <?php echo form_close(); ?>  
        </div>
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
<?php $this->load->view('bottom_application'); ?>