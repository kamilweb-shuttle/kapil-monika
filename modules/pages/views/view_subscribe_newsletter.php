<?php $this->load->view("top_application");?>
  <div class="mob_hider"></div>
  <!-- HEADER ENDS -->
  
  <div class="breadcrumbs mob_hider">
    <div class="wrapper">
      <p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b><strong>Newsletter</strong></p>
    </div>
  </div>

  <section class="wrapper cms_area">
    <div class="p10 pt30">
      <h1 class="bb2 pb3">Newsletter</h1>
      <?php echo form_open('pages/join_newsletter','name="newsletter" id="chk_newsletter" onsubmit="return join_newsletter();" ') ;?>
        <div class="short_form">
          <h3 class="bb pb2 mb20">Subscribe for Email Alerts</h3>
          <div  id="my_newsletter_msg" class="mt5 ac p5 ft-18"></div>
          <fieldset class="pb15" style="border:0;">
            <p class="w36 pt8">
              <label for="name"> Name <b class="red">*</b> </label>
            </p>
            <p class="w62">
              <input name="newsletter_name" id="newsletter_name" type="text">
            </p>
            <div class="cb pb7"></div>
            <p class="w36 pt8">
              <label for="email"> Email ID <b class="red">*</b> </label>
            </p>
            <p class="w62">
              <input name="newsletter_email" id="newsletter_email" type="text">
            </p>
            <div class="cb pb7"></div>
            <div class="w62">
              <p class="mb10">
                <input name="verification_code" id="verification_code" type="text" placeholder="Word Verification *">
              </p>
              <img src="<?php echo site_url('captcha/normal');?>" id="captchaimage" alt="" class="vam"> <img src="<?php echo theme_url(); ?>images/ref.png" alt="" class="vam" onclick="document.getElementById('captchaimage1').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();" /> 
            </div>
            <div class="cb pb7"></div>
          </fieldset>
          <p class="w62">
            <input name="subscribe_me" type="submit" value="Subscribe" class="btn2 radius-3" onclick="return join_newsletter(event);" />
            <input name="unsubscribe_me" type="submit" value="Unsubscribe" class="btn3 radius-3" onclick="return join_newsletter(event);" />
          </p>
          <div class="cb"></div>
        </div>
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